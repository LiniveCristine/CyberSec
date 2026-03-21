<?php

$pages_folder = __DIR__;

if(!isset($_GET['page'])){
    echo "Defina a page na query string";
    die();
}

$page = $_GET['page'];

require "{$pages_folder}/{$page}.php";

