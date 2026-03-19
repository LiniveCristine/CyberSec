<?php

$files_folder = __DIR__; //-> correção

if(!isset($_GET['filename'])){
    echo "Por favor, informe o filename na query string";
    die();
}
    
$filename = $_GET['filename'];
$filepatch = "{$files_folder}/{$filename}"; //-> correção

var_dump($filepatch);

//substituir por filepatch -> correção
if (!file_exists($filepatch)){ 
    echo "file not found";
    die();

} 
//A busca vai ficar restringinda ao diretório definido em $files_folder


$content = file_get_contents($filepatch);
echo $content;



