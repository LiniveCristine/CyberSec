
<?php


abstract class carro{
	protected $motor = false;
	protected $velocidade = 0;

	abstract public function ligar();
	abstract public function acelerar();

}

class Fiat extends carro{
    public function ligar()
    {
        $this->motor=true;
        echo $this->motor;
    }

    public function acelerar()
    {
        $this->velocidade += 10;
        echo $this->velocidade;
    }
}

$meu_fiat = new Fiat();

$meu_fiat->acelerar();
