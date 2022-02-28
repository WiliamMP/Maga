<?php
    include_once('config.php');

    if(isset($_POST['submit'])){

        echo "<pre>" . print_r($_POST, true)."</pre>";

//        return;

        $id       = $_POST['id'];
        $idPessoa = $_POST['idpessoa'];
        $tipo     = $_POST['tipoemail'];
        $desc     = $_POST['desc'];

        // so um min que tem alguem falando aqui comigo....

        $sqlUpdate = "UPDATE `banco-de-dados`.`dado_contato` SET
                             idPessoa = $idPessoa, 
                             tipo = $tipo, 
                             `desc` = '$desc' 
                       WHERE id = $id";

        $result = $conn->query($sqlUpdate);
    }
    header('Location: contato.php');
