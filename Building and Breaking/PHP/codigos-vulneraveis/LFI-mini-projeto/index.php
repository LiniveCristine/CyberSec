<?php

//VULNERÁVEL LFR E PATH TRANSVERSAL

$arquivos = scandir('./notas');
$arquivos =array_splice($arquivos, 2);

if(isset($_GET['filename'])){

    //$nome_nota = basename($_GET['filename']);// -> retirar path trnasversal. 
    $nome_nota = $_GET['filename'];

    $file_path = __DIR__."/notas/{$nome_nota}";

    if(file_exists($file_path)){
        require $file_path;
        //echo file_get_contents($file_path); //-> evita LFI
        die();
    }

}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $random_number = rand(1000, 9999);

    $texto_nota = $_POST['note'];
    $texto_nota = $texto_nota."\n";

    $file_path = "./notas/anotacao_{$random_number}.txt";

    file_put_contents($file_path,$texto_nota, FILE_APPEND);
}

?>


<!DOCTYPE html>
<html lang="pt">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Notas</title>
    </head>
    <body>
        <div>
            <h2>Notas salvas</h2>
            <ul>
                <?php foreach($arquivos as $arquivo): ?>
                    <li>
                        <a href="/index.php?filename=<?= $arquivo?>"><?= $arquivo?></a>     
                    </li>
                <?php endforeach;?>
            </ul>
        </div>
        <form action="/index.php" method="post">
            <label for="note">Escreva sua nota</label><br>
            <textarea name="note" id="note" rows="4" cols="50"></textarea><br>
            <button type="submit">Salvar nota</button>
        </form>
    </body>
</html>
