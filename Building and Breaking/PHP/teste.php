
<?php



class Usuario{
    private $senha;

    public function setSenha($senha){
        $this->senha = $senha;
    }

    public function getSenha(){
        return $this->senha;
    }
}

$linive = new Usuario();
$linive->setSenha('123456');
echo $linive->getSenha();