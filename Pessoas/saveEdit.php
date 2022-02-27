<?php

    include_once('config.php');

    echo $_POST['nome'];
    echo $_POST['cpf'];

    if(isset($_POST['submit'])){
        $id = $_POST['id'];
        $nome = $_POST['nome'];
        $cpf = $_POST['cpf'];

        $sqlUpdate = "UPDATE `banco-de-dados`.`dado_pessoas` SET nome='$nome',cpf='$cpf' WHERE id='$id'";

        $result = $conn->query($sqlUpdate);
    }
    header('Location: pessoas.php');
?>