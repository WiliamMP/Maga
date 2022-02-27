<?php



if (!empty($_GET['id'])) {
    include_once('config.php');

    $id = $_GET['id'];
    $sqlSelect = "SELECT * FROM `dado_pessoas` WHERE id=$id";
    $result = $conn->query($sqlSelect);

    if ($result->num_rows > 0) {

        while ($user_data = mysqli_fetch_assoc($result)) {
            $nome = $user_data['nome'];
            $cpf = $user_data['cpf'];
        }
    } else {
        header('Location: pessoas.php');
    }
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="text/javascript" src="../js/app.js"></script>
    <title>Editar</title>
</head>

<body>
    <form action="saveEdit.php?id='<?php $id ?>' " method="POST">
        <div>
            <label>Nome:</label>
            <input type="hidden" id="id" name="id" value="<?php echo $id ?>">
            <input type="text" id="nome" name="nome" value="<?php echo $nome ?>" required>
            <br><br>
            <label>CPF:</label>
            <input type="text" id="cpf" name="cpf" style="margin-left: 10px;" value="<?php echo $cpf ?>" required>
            <br><br>
            <input type="submit" id="submit" name="submit">
        </div>
    </form>
</body>

</html>