<?php
require 'config.php';

// Buscar informações do medicamento
$sql = "SELECT * FROM medicamentos";
try {
    $listaMedicamentos = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Erro ao buscar medicamentos: " . htmlspecialchars($e->getMessage());
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Informações dos Medicamentos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Informações dos Medicamentos</h2>
        
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
                </tr>
            </thead>
            <tbody>
                <?php if (empty($listaMedicamentos)): ?>
                    <tr>
                        <td colspan="6" class="text-center">Nenhum medicamento encontrado.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($listaMedicamentos as $med): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($med['nome']); ?></td>
                            <td><?php echo htmlspecialchars(number_format($med['preco_custo'], 2, ',', '.')); ?></td>
                            <td><?php echo htmlspecialchars(number_format($med['preco_venda'], 2, ',', '.')); ?></td>
                            <td><?php echo htmlspecialchars($med['quantidade']); ?></td>
                            <td><?php echo htmlspecialchars($med['categoria']); ?></td>
                            <td><?php echo htmlspecialchars($med['data_validade']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>

        <!-- Botão para voltar ao menu -->
        <a href="menu.php" class="btn btn-secondary btn-lg active" role="button">Ir para o menu</a><br><br>
    </div>
</body>
</html>