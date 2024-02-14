<?php

function conn(){
    $con = new mysqli('localhost', 'root', '', 'CMS');

    if($con->connect_error){
        die("Connection Failed!");
    }

    return $con;
}

$con = conn();

function cleanData($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data, ENT_QUOTES);
    return $data;
}