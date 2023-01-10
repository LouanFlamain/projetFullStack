<?php

namespace App\Helpers;

class Utilitaire
{

    static public function redirect(string $url): void
    {
        header("Location: /$url");
    }

}