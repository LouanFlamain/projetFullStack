<?php

namespace App\Utilitaire;

class Utilitaire
{

    static public function redirect(string $url): void
    {
        header("Location: /$url");
    }

}