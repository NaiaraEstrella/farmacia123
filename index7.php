<?php
require 'config1.php';

// ARQUIVO REDENDANTE EXCLUIR ELE !!!!

// Buscar dados para exibir

$sql = $pdo ->query("SELECT * FROM medicamentos ");

$listaMedicamentos = [];

$listaMedicamentos = $sql->fetchAll(PDO::FETCH_ASSOC); // Codigo certo para chamar o SQL só não sei que a variavel esta correta

//$sql = "SELECT nome, quantidade, preco_custo, preco_venda FROM medicamentos";
//$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Quantidade no Estoque</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Estoque de Medicamentos</h2>
        <table class="table table-striped table-responsive">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Quantidade</th>
                    <th>Preço de Custo</th>
                    <th>Preço de Venda</th>
                </tr>
            </thead>
            <tbody>
                <?php if($result->num_rows > 0): ?>
                    <?php while($med = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($med['nome']); ?></td>
                            <td><?php echo $med['quantidade']; ?></td>
                            <td>R$ <?php echo number_format($med['preco_custo'], 2, ',', '.'); ?></td>
                            <td>R$ <?php echo number_format($med['preco_venda'], 2, ',', '.'); ?></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" class="text-center">Nenhum medicamento encontrado.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        <a href="login.php" class="btn btn-primary">Sair</a>
    </div>
</body>
</html>
