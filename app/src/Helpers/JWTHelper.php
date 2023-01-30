<?php
namespace App\Helpers;

use App\Entity\User;
use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;


class JWTHelper
{
    private static string $key = "je_suis_presque_impossible_a_casser_:3";
    private static string $alg = "HS256";

    public static function buildJWT(User $user): string
    {
        $payload = [
            "id" => $user->getId(),
            "username" => $user->getUsername(),
            "mail" => $user->getMail(),
            "role" => $user->getRole(),
            "exp" => (new \DateTime("+ 120 minutes"))->getTimestamp()
        ];

        return JWT::encode($payload, static::$key, static::$alg);
    }

    public static function decodeJWT(string $jwt)
    {
        try 
        {
            return JWT::decode($jwt, new Key(static::$key, static::$alg));
        } 
        catch (\Exception $exception) 
        {
            if($exception->getMessage() == "Expired token")
            {
                echo json_encode([
                    "expired" => true
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
        return JWT::encode($payload, static::$key, static::$alg);

    }

    public static function decodeMailToken(string $token)
    {
        try
        {
            $expired = true;
            echo json_encode([
                "expired" => $expired
            ]);
            return JWT::decode($token, new Key(static::$key, static::$alg));

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