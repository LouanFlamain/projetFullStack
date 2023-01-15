<?php
namespace App\Helpers;

use App\Entity\User;
use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;


class JWTHelper
{
    public static function buildJWT(User $user): string
    {
        $payload = [
            "id" => $user->getId(),
            "username" => $user->getUsername(),
            "role" => $user->getRole(),
            "exp" => (new \DateTime("+ 120 minutes"))->getTimestamp()
        ];

        return JWT::encode($payload, "je_suis_presque_impossible_a_casser_:3", "HS256");
    }

    public static function decodeJWT(string $jwt)
    {
        try 
        {
            $expired = false;
            echo json_encode([
                "expired" => $expired
            ]);
            return JWT::decode($jwt, new Key("je_suis_presque_impossible_a_casser_:3", "HS256"));
        } 
        catch (\Exception $exception) 
        {
            if($exception->getMessage() == "Expired token")
            {
                $expired = true;
                echo json_encode([
                    "expired" => $expired
                ]);
            }
        }
    }

    public static function CreateMailToken ($invitation): string
    {
        $payload = [
            "mail" => $invitation->getMail(),
            "rental_id" => $invitation->getRental_Id(),
            "exp" => (new \DateTime("+ 120 minutes"))->getTimestamp(),
        ];
        return JWT::encode($payload, "je_suis_presque_impossible_a_casser_:3", "HS256");
    }

    public static function decodeMailToken(string $token)
    {
        try
        {
            $expired = true;
            echo json_encode([
                "expired" => $expired
            ]);
            return JWT::decode($token, new Key("je_suis_presque_impossible_a_casser_:3", "HS256"));

        }
        catch(Exception $e)
        {
            $expired = false;
            echo json_encode([
                "expired" => $expired
            ]);
        }
    }
}