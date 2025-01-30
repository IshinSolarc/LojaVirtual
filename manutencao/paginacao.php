<?php

include '../bancoSQL.php';

function imprimirHeader() {
    $html = file_get_contents('./template/header.php');
    
    echo $html;
}

function imprimirNav(){
    $html = file_get_contents('./template/navbar.php');
    echo $html;
}