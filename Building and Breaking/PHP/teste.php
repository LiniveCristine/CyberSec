
<?php

class Pessoa{
    public $cansada = false;

    public function acordar(){
        $this -> cansada = true;
    }

    public function dormir(){

        $this-> cansada = false;
    }


    public function verificar_dosposicao(){
        
        if ($this -> cansada){
            echo "Tomar monster";
        } else{
            echo "Pessoa dormindo" ;
        }
            
    }

}

$linive = new Pessoa();
$linive ->acordar();

$linive->verificar_dosposicao();

