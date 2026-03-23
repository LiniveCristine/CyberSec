<?php

$pages_folder = __DIR__;

if(!isset($_GET['page'])){
    echo "Defina a page na query string";
    die();
}

//$page = basename($_GET['page']); -> Correção
$page = $_GET['page'];

require "{$pages_folder}/{$page}.php";
//Colocando .php hardcoded já limita o ataque a apenas arquivos php
