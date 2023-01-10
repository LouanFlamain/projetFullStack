<?php

namespace App\Traits;

trait Hydrator
{
    public function hydrate(array $data): void
    {
        // dans tableau tu recup clef valeur
        // ['code' => 999] => 'code' -> 999
        foreach ($data as $key => $value){
            
            // set + 1ereLettre en Maj($key)
            $method = 'set' . ucfirst($key);

            // cherche si setQqch existe dans la classe
            if (is_callable([$this, $method])){ // return true / false

                // class -> function ($value)
                $this->$method($value);
            }
        }
    }
}