<?php
namespace App\Helpers;

use App\Entity\User;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;


class JWTHelper
{
    public static function buildJWT(User $user): string
    {
        $payload = [
            "id" => $user->getId(),
            "username" => $user->getUsername(),
            "exp" => (new \DateTime("+ 20 minutes"))->getTimestamp()
        ];

        return JWT::encode($payload, "je_suis_presque_impossible_a_casser_:3", "HS256");
    }

    public static function decodeJWT(string $jwt): ?object
    {
        try {
            return JWT::decode($jwt, new Key("je_suis_presque_impossible_a_casser_:3", "HS256"));
        } catch (\Exception $exception) {
            return null;
        }
    }
    public static function CreateMailToken ($invitation): string
    {
        $payload = [
            "mail" => $invitation['mail'],
            "exp" => (new \DateTime("+ 20 minutes"))->getTimestamp(),

        ];
        return JWT::encode($payload, "je_suis_presque_impossible_a_casser_:3", "HS256");

    }

}