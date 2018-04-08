<?php
/**
 * Created by PhpStorm.
 * User: mishi
 * Date: 22/03/2018
 * Time: 10:46
 */

namespace AppBundle\Services;

class GenerateToken
{
    /**
     * @param $length
     * @return bool|string
     */
    public function random($length)
    {
        $alphabet = "azertyuiopqsdfghjklmwxcvbnAZERTYUIOPMLKJHGFDSQWXCVBN0123456789";
        $token = substr(str_shuffle(str_repeat($alphabet, $length)), 0, $length);
        return $token;
    }

}