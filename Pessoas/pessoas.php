<?php

//DETECTAR A FUNCAÇÃO
include_once('config.php');
$tipo_de_operacao = "Cadastro";
if (isset($_GET['type'])) {
    $tipo_de_operacao = $_GET['type'];
}
//Editar
if ($tipo_de_operacao == "Editar") {
    if (!empty($_GET['id'])) {
        $sql = "SELECT * FROM `banco-de-dados`.`dado_pessoas` WHERE (`id` = '" . $_GET['id'] . "');";
        $result = $conn->query($sql);
    }
}
// EXCLUIR
if ($tipo_de_operacao == "Excluir") {
    if (!empty($_GET['id'])) {
        $sql = "DELETE FROM `banco-de-dados`.`dado_pessoas` WHERE (`id` = '" . $_GET['id'] . "');";
        $result = $conn->query($sql);
    }
}

// INSERT
if (isset($_POST['submit'])) {
    $cpf = $_POST['cpf'];
    $nome = $_POST['nome'];

    $inserirInfos = "INSERT INTO `banco-de-dados`.`dado_pessoas` (`id`, `nome`, `cpf`) VALUES ('','$nome', '$cpf');
        ";
    $inserir = $conn->query($inserirInfos);
}
// pesquisa

$condicao = "where 1 = 1";
if (isset($_POST['search'])) {
    $condicao .= " and nome = '" . $_POST['string'] . "'";
}

$sql = "SELECT * FROM dado_pessoas $condicao";
$result = $conn->query($sql);


?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Pessoas</title>

    <link rel="stylesheet" href="main.css">
    <link rel="stylesheet" href="button.css">
    <link rel="stylesheet" href="records.css">
    <link rel="stylesheet" href="modal.css">
    <script type="text/javascript" src="../js/app.js"></script>
</head>

<body>
    <header>
        <h1 class="titulo-topo">Cadastro de Pessoas</h1>
    </header>
    <main>
        <table class="records">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>CPF</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <div style="height: 25px;width:357px;margin: 4px auto;text-align: center;display: inline-block;position: relative;">
                    <form method="POST" id="pesquisaPessoa">
                        <label>Pesquisar:</label>
                        <input type="search" name="string" id="string" style="height: 25px;width: 423px">
                        <br><br>
                        <input type="submit" name="search" id="search">
                    </form>
                </div>
                <br><br>

                <button type="button" class="button blue" onclick="change()" name="cadastrarPessoa" id="cadastrarPessoa">Cadastrar Pessoa</button>
                <button class="button blue"><a href="pessoas.php" style="color: white;text-decoration: none;">Voltar</a></button>
                <?php
                while ($info_pessoas = mysqli_fetch_assoc($result)) {

                    echo "<tr>";
                    echo "<td>" . $info_pessoas['nome'] . "</td>";
                    echo "<td>" . $info_pessoas['cpf'] . "</td>";
                    echo "<td>" . '<a href="editar.php?id=' . $info_pessoas['id'] . '&type=Editar"><button type="button" class="button green">Editar</button></a>
                    <a href="pessoas.php?id=' . $info_pessoas['id'] . '&type=Excluir"> <button type="button" class="button red">Excluir</button></a>' . "</td>";
                }
                ?>
            </tbody>
        </table>
        <div class="modal" id="modal">
            <div class="modal-content">
                <header class="modal-header">
                    <h2 style="margin-right: 225px;">Nova Pessoa</h2>
                    <span class="modal-close" id="modalClose" onclick="closeModal()">&#10006;</span>
                </header>
                <form id="form1" class="modal-form" action="pessoas.php" method="POST">
                    <input type="text" name="nome" id="nome" class="modal-field" placeholder="Nome da Pessoa" required>
                    <input type="text" name="cpf" id="cpf" class="modal-field" placeholder="CPF" required>
                    <a href="pessoas.php?type=Salvar"><input type="submit" name="submit" onclick="submitForm()" id="submit" class="button green"></a>
                    <footer class="modal-footer">
                        <button class="button blue" onclick="closeModal()">Cancelar</button>
                    </footer>
                </form>

            </div>
        </div>

</body>

</html>