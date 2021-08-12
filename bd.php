<?php

    $servername = "localhost";
    $database = "uploadimg";
    $username = "root";
    $passoword = "";

    $conn = mysqli_connect($servername, $username, $passoword, $database);

    //verificando conexão
    if(!$conn){
        die("falha na conexão" . mysqli_connect_error());
    }

?>