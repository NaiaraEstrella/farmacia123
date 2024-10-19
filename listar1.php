<?php
require 'config1.php';

// Buscar informações do medicamento
$sql = "SELECT * FROM medicamentos";
$listaMedicamentos = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Lista de Medicamentos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Lista de Medicamentos</h2>
        
        <!-- Tabela de Medicamentos -->
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Preço de Custo</th>
                    <th>Preço de Venda</th>
                    <th>Quantidade</th>
                    <th>Categoria</th>
                    <th>Data de Validade</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($listaMedicamentos as $med): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($med['nome']); ?></td>
                        <td><?php echo htmlspecialchars($med['preco_custo']); ?></td>
                        <td><?php echo htmlspecialchars($med['preco_venda']); ?></td>
                        <td><?php echo htmlspecialchars($med['quantidade']); ?></td>
                        <td><?php echo htmlspecialchars($med['categoria']); ?></td>
                        <td><?php echo htmlspecialchars($med['data_validade']); ?></td>
                        <td>
                            <!-- Botão Editar -->
                            <a href="editar5.php?id=<?php echo $med['id']; ?>" class="btn btn-warning btn-sm">Editar</a>
                            <!-- Botão Excluir -->
                            <form action="excluir.php" method="POST" style="display:inline;">
                                <input type="hidden" name="id" value="<?php echo $med['id']; ?>">
                                <button type="submit" class="btn btn-danger btn-sm">Excluir</button><br><br><br>
                                <a href="menu.php" class="btn btn-default btn-lg active" role="button">Ir para o menu</a><br><br>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>