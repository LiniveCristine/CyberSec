
<?php

class Pessoa {
    private $nome;
    private $idade;
    private $altura;

    public function __construct($nome, $idade, $altura){
        $this->nome = $nome;
        $this->idade = $idade;
        $this-> altura = $altura;

        echo "Seu nome é $nome. Você tem $idade anos e $altura m de altura\n";
    }
}

  $linive = new Pessoa("Linive", 29, 1.65);
