<?php
    include 'db.php';

    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $preco = $_POST['preco'];
    $quantidade = $_POST['quantidade'];

    $stmt = $conn->prepare("UPDATE produtos SET nome=?, preco=?, quantidade=? WHERE id=?");
    $stmt->bind_param("sdii", $nome, $preco, $quantidade, $id);

    if ($stmt->execute()) {
        header("Location: index.php?status=editado");
    } else {
        header("Location: index.php?status=erro");
    }
?>
