<?php
namespace App\Traits;

trait PreventEmpty
{
    public function prevent($data){
        // A utiliser cette partie en complement du reste du code,
       // si on veut être plus fin sur le traçage de l'endroit où est instancié la class
/*        $test = array_diff(scandir("src/Manager"), [".", "..", "BaseManager.php"]);

        $result = false;
        $debug = debug_backtrace();
        $lenMax = count($test) > count($debug) ? $test : $debug;
        $lenMin = count($test) <= count($debug) ? $test : $debug;
        foreach($lenMax as $element) {
            foreach ($lenMin as $min){
                if(isset($element['file'])) {
                    if (strpos($element['file'], $min)) {
                        $result = true;
                        break 2;
                    }
                }else{
                    if (strpos($min['file'], $element)) {
                        $result = true;
                        break 2;
                    }
                }
            }
        }*/
         foreach ($this as $key => $attribute) {
                if($key != "id" && $key != "created_at"){
                    if(empty($attribute)){
                        echo json_encode([
                            "error" => "Veuillez remplir le champ : $key",
                            "attribute" => $key
                        ]);
                        die;
                    }
                }
         }

    }
}