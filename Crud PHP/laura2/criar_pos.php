<?php
    include 'db.php';

    $nome = $_POST['nome'];
    $preco = $_POST['preco'];
    $quantidade = $_POST['quantidade'];

    $stmt = $conn->prepare("INSERT INTO produtos (nome, preco, quantidade) VALUES (?, ?, ?)");
    $stmt->bind_param("sdi", $nome, $preco, $quantidade);

    if ($stmt->execute()) {
        header("Location: index.php?status=adicionado");
    } else {
        header("Location: index.php?status=erro");
    }
?>
