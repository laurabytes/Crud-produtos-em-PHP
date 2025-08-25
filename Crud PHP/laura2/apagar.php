<?php
    include 'db.php';
    $id = $_GET['id'];

    $stmt = $conn->prepare("DELETE FROM produtos WHERE id=?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: index.php?status=excluido");
    } else {
        header("Location: index.php?status=erro");
    }
?>
