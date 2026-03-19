<?php

$files_folder = __DIR__; 

if(!isset($_GET['filename'])){
    echo "Por favor, informe o filename na query string";
    die();
}

//$filename = basename($_GET['filename']);// -> correção. 

$filename = $_GET['filename'];
$filepatch = "{$files_folder}/{$filename}"; //-> caminho completo para o arquivo

var_dump($filepatch);

//A busca vai ficar restringinda ao diretório definido em $files_folder

if (!file_exists($filepatch)){ 
    echo "file not found";
    die();

} 

$content = file_get_contents($filepatch);
echo $content;



