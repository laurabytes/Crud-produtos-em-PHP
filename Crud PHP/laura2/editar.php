<?php
    include 'db.php';
    $id = $_GET['id'];
    $result = $conn->query("SELECT * FROM produtos WHERE id = $id");
    $produto = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Produto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">
    <h2>Editar Produto</h2>
    <form action="atualizar.php" method="post">
        <input type="hidden" name="id" value="<?= $produto['id'] ?>">
        <div class="mb-3">
            <label>Nome</label>
            <input type="text" name="nome" class="form-control" value="<?= $produto['nome'] ?>" required>
        </div>
        <div class="mb-3">
            <label>Preço</label>
            <input type="number" step="0.01" name="preco" class="form-control" value="<?= $produto['preco'] ?>" required>
        </div>
        <div class="mb-3">
            <label>Quantidade</label>
            <input type="number" name="quantidade" class="form-control" value="<?= $produto['quantidade'] ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Atualizar</button>
        <a href="index.php" class="btn btn-secondary">Cancelar</a>
    </form>
</body>
</html>