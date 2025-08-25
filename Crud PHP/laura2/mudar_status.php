<?php
    include 'db.php';

    $id = $_GET['id'] ?? 0;

    $res = $conn->query("SELECT status FROM produtos WHERE id = $id");
    if ($res && $res->num_rows > 0) {
        $produto = $res->fetch_assoc();
        $novoStatus = ($produto['status'] == 'ativo') ? 'inativo' : 'ativo';

        $stmt = $conn->prepare("UPDATE produtos SET status = ? WHERE id = ?");
        $stmt->bind_param("si", $novoStatus, $id);

        if ($stmt->execute()) {
            header("Location: index.php?status=atualizado");
            exit;
        }
    }

header("Location: index.php?status=erro");