<?php include 'db.php'; ?>

<?php
    // Paginação
    $registrosPorPagina = 10;
    $pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
    $inicio = ($pagina - 1) * $registrosPorPagina;

    $totalRegistros = $conn->query("SELECT COUNT(*) AS total FROM produtos")->fetch_assoc()['total'];
    $totalPaginas = ceil($totalRegistros / $registrosPorPagina);

    $result = $conn->query("SELECT * FROM produtos ORDER BY NOME ASC LIMIT $inicio, $registrosPorPagina");
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Gestão de Produtos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
</head>
<body class="container mt-4">
    <h2>Lista de Produtos</h2>

    <?php if (isset($_GET['status'])): ?>
        <div id="alertBox" class="alert alert-success alert-dismissible fade show">
            <?php
                switch ($_GET['status']) {
                    case 'adicionado': echo "Produto adicionado com sucesso!"; break;
                    case 'editado': echo "Produto editado com sucesso!"; break;
                    case 'excluido': echo "Produto excluído com sucesso!"; break;
                    case 'atualizado': echo "Status atualizado com sucesso!"; break;
                    case 'erro': echo "Ocorreu um erro."; break;
                }
            ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <a href="criar.php" class="btn btn-success mb-3">Adicionar Produto</a>

    <table class="table table-bordered table-hover">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Preço</th>
                <th>Quantidade</th>
                <th>Status</th>
                <th>Opções</th>
            </tr>
        </thead>
        <tbody>
        <?php while($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= $row['nome'] ?></td>
                <td>R$ <?= number_format($row['preco'], 2, ',', '.') ?></td>
                <td><?= $row['quantidade'] ?></td>
                <td>
                    <span class="badge bg-<?= $row['status'] == 'ativo' ? 'success' : 'secondary' ?>">
                        <?= ucfirst($row['status']) ?>
                    </span>
                </td>
                <td>
                    <a href="editar.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Editar</a>
                    <a href="apagar.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm"
                       onclick="return confirm('Excluir este produto?')">Excluir</a>
                    <a href="mudar_status.php?id=<?= $row['id'] ?>" class="btn btn-outline-primary btn-sm"
                       onclick="return confirm('Alterar status do produto?')">
                       <?= $row['status'] == 'ativo' ? 'Inativar' : 'Ativar' ?>
                    </a>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>

    <!-- Parte referente à paginação -->
    <nav>
        <ul class="pagination">
            <?php for ($i = 1; $i <= $totalPaginas; $i++): ?>
                <li class="page-item <?= ($i == $pagina) ? 'active' : '' ?>">
                    <a class="page-link" href="?pagina=<?= $i ?>"><?= $i ?></a>
                </li>
            <?php endfor; ?>
        </ul>
    </nav>

    <script>
        setTimeout(() => {
            const alert = document.getElementById('alertBox');
            if (alert) alert.style.display = 'none';
        }, 4000);
    </script>
</body>
</html>