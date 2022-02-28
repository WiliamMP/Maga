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
        $sql = "SELECT * FROM `banco-de-dados`.`dado_contato` WHERE (`id` = '" . $_GET['id'] . "');";
        $result = $conn->query($sql);
        
    }
        
    
}
// EXCLUIR
if ($tipo_de_operacao == "Excluir") {
    if (!empty($_GET['id'])) {
        $sql = "DELETE FROM `banco-de-dados`.`dado_contato` WHERE (`id` = '" . $_GET['id'] . "');";
        $result = $conn->query($sql);
    }
}

// INSERT
if (isset($_POST['submit'])) {
    $idPessoa = $_POST['idpessoa'];
    $tipo     = $_POST['tipoemail'];
    $desc     = $_POST['desc'];

    $inserirInfos = "INSERT INTO `banco-de-dados`.`dado_contato` (`id`, `tipo`, `desc`, `idPessoa`) VALUES ('','$tipo', '$desc', $idPessoa);
        ";
    $inserir = $conn->query($inserirInfos);
}

// pesquisa
$condicao = "where 1 = 1";
if (isset($_POST['search'])) {
    $condicao .= " and nome = '" . $_POST['string'] . "'";
}

$sql_contato = "SELECT dado_contato.id as id_contato, 
                       dado_pessoas.nome,
                       dado_contato.tipo,
                       dado_contato.desc
                  FROM dado_contato 
            INNER JOIN dado_pessoas ON dado_pessoas.id = dado_contato.idPessoa $condicao";
$oDadosContato = $conn->query($sql_contato);

$sql_pessoa = "SELECT * FROM dado_pessoas order by 1";
$oDadosPessoas = $conn->query($sql_pessoa);

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Contatos</title>

    <link rel="stylesheet" href="../css/main.css"> <!--main-->
    <link rel="stylesheet" href="../css/button.css"> <!--button-->
    <link rel="stylesheet" href="../css/records.css"> <!--records-->
    <link rel="stylesheet" href="../css/modal.css"> <!--modal-->
    <script type="text/javascript" src="../js/app.js"></script>
</head>

<body>
    <header>
        <a href="contato.php"><h1 class="titulo-topo" style="text-decoration: none; color: black;">Cadastro de Contato</h1></a>
    </header>
    <main>
        <button class="button blue"><a href="../index.html" style="color: white;text-decoration: none;">Home</a></button>
        <table class="records">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Tipo</th>
                    <th>Descrição</th>
                    <th>Ação</th>
                </tr>
            </thead>
            <tbody>
                <div style="height: 25px;width:357px;margin: 4px auto;text-align: center;display: inline-block;position: relative;">
                    <form method="POST" id="pesquisaPessoa">
                        <label>Pesquisar:</label>
                        <input type="search" name="string" id="string" style="height: 25px;width: 423px">
                        <br><br>
                        <input type="submit" name="search" id="search" class="button blue">
                    </form>
                </div>
                <br><br>

                <button type="button" class="button blue" onclick="change()" name="cadastrarPessoa" id="cadastrarPessoa">Cadastrar Contato</button>
                <?php
                while ($info_contatos = mysqli_fetch_assoc($oDadosContato)) {
                    echo "<tr>";

                    echo "<td>" . $info_contatos['nome'] . "</td>";
                    if(intval($info_contatos['tipo']) == 0){
                        echo "<td>Telefone</td>";
                        
                    } else {
                        echo "<td>E-mail</td>";                        
                    }
                    

                    echo "<td>" . $info_contatos['desc'] . "</td>";
                    echo "<td>" . '<a href="editar.php?id=' . $info_contatos['id_contato'] . '&type=Editar"><button type="button" class="button green">Editar</button></a>
                    <a href="contato.php?id=' . $info_contatos['id_contato'] . '&type=Excluir"> <button type="button" class="button red">Excluir</button></a> ' . "</td>";
                }
                ?>
            </tbody>
        </table>
        <div class="modal" id="modal">
            <div class="modal-content">
                <header class="modal-header">
                    <h2 style="margin-right: 225px;">Novo Contato</h2>
                    <span class="modal-close" id="modalClose" onclick="closeModal()">&#10006;</span>
                </header>
                <form id="form_contato" class="modal-form-2" action="contato.php?type=Salvar" method="POST">
                    <label for="idpessoa" style="float: right;">Pessoa:</label>
                    <select id="idpessoa" name="idpessoa">
                        <?php
                        while ($info_pessoas = mysqli_fetch_assoc($oDadosPessoas)) {
                            echo '<option value="' . $info_pessoas['id']  . '">' . $info_pessoas['nome'] .'</option>';
                        }
                        ?>
                    </select>

                    <br>

                    <label for="tipoemail">Tipo Contato:</label>
                    <select name="tipoemail" id="tipoemail">
                        <option value="0">Telefone</option>
                        <option value="1">Email</option>
                    </select>

                    <br>

                    <label>Contato:</label>
                    <input type="text" name="desc" id="desc" class="modal-field" placeholder="Descrição do contato" size="200" required />

                    <footer class="modal-footer">
                        <input type="submit" name="submit" onclick="submitForm()" id="submit" class="button green">
                        <button class="button blue" onclick="closeModal()">Cancelar</button>
                    </footer>
                </form>

            </div>
        </div>

</body>

</html>