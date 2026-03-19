<?php

//$files_folder = './codigos-vulneraveis'; -> correção

if(!isset($_GET['filename'])){
    echo "Por favor, informe o filename na query string";
    die();
}
    
$filename = $_GET['filename'];
//$filepatch = "{$files_folder}/{$filename}"; -> correção

//substituir por filepatch -> correção 
if (!file_exists($filename)){ //A busca vai ficar restringinda ao diretório definido em $files_folder
    echo "file not found";
    die();

} 

$content = file_get_contents($filename);
echo $content;

