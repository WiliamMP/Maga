<?php

if (!empty($_GET['id'])) {
    include_once('config.php');

    $id = $_GET['id'];
    $sqlSelect = "SELECT * FROM `dado_contato` WHERE id = $id";
    $result = $conn->query($sqlSelect);

    if ($result->num_rows > 0) {
        if ($user_data = mysqli_fetch_assoc($result)) {
            $id       = $user_data['id'];
            $idPessoa = $user_data['idPessoa'];
            $tipo     = $user_data['tipo'];
            $desc     = $user_data['desc'];
        }

        // Pega os dados das pessoas
        $sql_pessoa = "SELECT * FROM dado_pessoas order by 1";
        $oDadosPessoas = $conn->query($sql_pessoa);

    } else {
        header('Location: contato.php');
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="main.css">
    <link rel="stylesheet" href="button.css">
    <link rel="stylesheet" href="records.css">
    <link rel="stylesheet" href="modal.css">

    <script type="text/javascript" src="../js/app.js"></script>
    <title>Editar</title>
</head>

<body>
    <form action="saveEdit.php?id='<?php $id ?>' " method="POST" class="modal-form-2">
        <label for="idpessoa" style="float: right;">Pessoa:</label>
        <input type="hidden" id="id" name="id" value="<?php echo $id ?>">
        <select id="idpessoa" name="idpessoa">
            <?php
            while ($info_pessoas = mysqli_fetch_assoc($oDadosPessoas)) {
                // Se a for a pessoa do contato atual, marca ele como selecionado
                if(intval($info_pessoas['id']) == intval($idPessoa)){
                    echo '<option value="' . $info_pessoas['id']  . '" selected>' . $info_pessoas['nome'] .'</option>';
                } else {
                    echo '<option value="' . $info_pessoas['id']  . '">' . $info_pessoas['nome'] .'</option>';
                }
            }
            ?>
        </select>

        <br><br>

        <label for="tipoemail">Tipo Contato:</label>
        <select name="tipoemail" id="tipoemail">
            <?php
                if(intval($tipo) == 0){
                    echo '<option value="1">Email</option>';
                    echo '<option value="0" selected>Telefone</option>';
                } else {
                    echo '<option value="1" selected>Email</option>';
                    echo '<option value="0">Telefone</option>';
                }
            ?>
        </select>

        <br>

        <label>Contato:</label>
        <input type="text"
               name="desc"
               id="desc" class="modal-field" placeholder="Descrição do contato" size="200"
               value="<?php echo $desc ?>" required />

        <br><br>
        <input type="submit" id="submit" name="submit">
    </form>
</body>

</html>