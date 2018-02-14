# P4_Louvre : développement d'un backend pour un client

Le musée du Louvre vous a missionné pour un projet ambitieux : créer un nouveau système de réservation et de gestion des tickets en ligne pour diminuer les longues files d’attente et tirer parti de l’usage croissant des smartphones.

Cahier des charges :

  - Design responsive.
  - Fonctionnelle, claire et rapide avant tout. (permettre aux visiteurs d’acheter un billet rapidement)

2 types de billets : 

  - le billet « Journée »,
  - le billet « Demi-journée » (il ne permet de rentrer qu’à partir de 14h00). 
  
Le musée est ouvert tous les jours sauf le mardi (et fermé les 1er mai, 1er novembre et 25 décembre).

Types de tarifs :

    - Un tarif « normal » à partir de 12 ans à 16 €
    - Un tarif « enfant » à partir de 4 ans et jusqu’à 12 ans, à 8 € (l’entrée est gratuite pour les enfants de moins de 4 ans)
    - Un tarif « senior » à partir de 60 ans pour 12  €
    - Un tarif « réduit » de 10 € accordé dans certaines conditions (étudiant, employé du musée, d’un service du Ministère de la Culture, militaire…)

Pour commander, on doit sélectionner :

Le jour de la visite
Le type de billet (Journée, Demi-journée…). 
On peut commander un billet pour le jour même mais on ne peut plus commander de billet « Journée » une fois 14h00 passées.

Limites :

  - Pas possible de réserver pour les jours passés (!), 
  - Pas possible les dimanches, les jours fériés,
  - Max 1000 billets par jour
  
Mentions :

  - Nom,
  - Prénom, 
  - Pays,
  - Date de naissance. 
  
Si la personne dispose du tarif réduit, elle doit simplement cocher la case « Tarif réduit ». Le site doit indiquer qu’il sera nécessaire de présenter sa carte d’étudiant, militaire ou équivalent lors de l’entrée pour prouver qu’on bénéficie bien du tarif réduit.

Récupèration de l’e-mail du visiteur afin de lui envoyer les billets. 
Pas de création de compte pour commander.
Payer avec la solution Stripe par carte bancaire.
Gérer le retour du paiement. 
Gerer l'erreur :En cas d’erreur, il invite à recommencer l’opération. Si tout s’est bien passé, la commande est enregistrée et les billets sont envoyés au visiteur.
Vous utiliserez les environnements de test fournis par Stripe pour simuler la transaction.

La création d'un back-office pour lister les clients et commandes n'est pas demandée. Seule l'interface client est nécessaire ici.

Le billet = l'email

Le mail doit indiquer:

Le nom et le logo du musée
La date de la réservation
Le tarif
Le nom de chaque visiteur
Le code de la réservation (un ensemble de lettres et de chiffres) 

Livrables attendus

Document de présentation de la solution pour le client, incluant la note de cadrage (PDF)
Code source complet du projet versionné avec Git, développé avec le framework PHP Symfony
Quelques (4-5) tests unitaires et fonctionnels que l’on peut exécuter
