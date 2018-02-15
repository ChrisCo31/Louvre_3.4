1. Création de deux entites :
    - Reservation (inverse) :
        - $id (int/ column =id)
        - $email (string/ column = email/255/ nullable= false)
        - $dateVisit (dateTime/ column = dateVisit/ nullable= false)
        - $dateReservation (dateTime/ column = dateReservation/ nullable= false)
        - $duration (bool/column = duration)//journee entiere/demi journee
        - $nbTicket (int/column = nbTicket)
        - $token (string/ column=token/255/nullable false)
        - $priceToPay (string/ column = priceToPay/ nullable=false)
        - $stripe_return (boolcolumn=stripeReturn)
        - + $tickets (relation bidirectionnelles @orm\OTM(target..\Ticket, mappedBy="reservation"))
    - Ticket (proprietaire) :
        - $id
        - $firstName
        - $lastName
        - $birthDate
        - $country
        - $discount  
        - $price
        - +$reservation (MTO/target Reservation/ inversedBY="tickets/join:column nullable a false pas de ticket sans reservation)
        
 // Creation de la bdd qui correspond  
 
2. Deux repository
centralise tout ce qui touche à la recuperation des entites, requete SQL


3. création de Service :
    - service PriceCalculation (calcul le prix )
    - service ClosingDay (Gere toutes les problematiques liées aux jour de fermeture/feries)
    - service Token ( genere le code attache à l'email de recap)
    
4. utilisation de service :
    - doctrine
    - twig
    - form/form.factory
    - mailer
    - translator
    - validator 
    - service Stripe ?
    
5. views :
    - layout
    - email
    - Booking :
        - accueil (page 0)
        - Choix de la visite et des billets (page 1)
        - finalisation de la commande : identites des visiteurs (page 2)
        - recap final et paiement (page 3)
        - confirmation (page 4)
    - ticket
    
6. Formulaire :
 Se construit sur un objet existant et a pour objectif d'hydrater.
 un formulaire reservation /ticket ? + un formBuilder (dans le controller ReservationController.php/classReservationController/public function addaction)
        ->creation de l'objet reservation
        ->creation du FormBuilder grace au service form factory (creation d'une classe AdvertType avec la methode buildForm que l'on appellera dans addAction)
        ->Ajout des champs de notre formulaire
            -> methode add(ajout du champ, type de champ qui est represente pas une classe differente suivi de la constante class)
            ->add ('email', TextType::class)
            ->add ('dateVisit', DateType::class)    =>datepicker
            ->add ('dateReservation', DateType::class)
            ->add ('duration', CheckboxType::class)
            -> add('nbTicket', NumberType::class)
            -> etc..
            ->add('ajouter au panier', submitType::class)
        ->Generer le formulaire a partir du formBuilder
        ->Passer la methode createView() du formulaire à la vue 
        (return $this->render('AppBundle:Reservation:add.html.twig', array('form' => $form->createView(),)
        ->verifier que la requete est en POST (if($request->isMethod('POST'))
        ->verifier que les valeurs entrees sont correctes (if($form_>isValid)))
        ->enregistrement de l'objet en bdd (   $em = $this->getDoctrine()->getManager();
                                                    $em->persist($reservation);
                                                    $em->flush();
        ->Ajout d'un message flash
        ->redirection vers la page identification des visiteurs
)
            
 
7. Controller
    - indexAction
    

8. Router :
    - homepage = path : /
    - organisation = path : /organisation/{id...
    - identification = path :/identification/{id...
    - payment = path:/payment/{id...
    - confirmation = path:/ confirmation/{id...