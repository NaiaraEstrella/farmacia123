<?php
require 'config1.php';

// Definição de variáveis
//$busca = isset($_GET['busca']) ? $_GET['busca'] : '';
//$ordenar = isset($_GET['ordenar']) ? $_GET['ordenar'] : 'nome';

// refazer a conexao usando o pdo  e fazendo o select usando o PDO

// Query para buscar medicamentos
//$sql = "SELECT * FROM medicamentos WHERE nome LIKE '%$busca%' ORDER BY $ordenar";

$sql = $pdo ->query("SELECT * FROM medicamentos ");

$listaMedicamentos = [];

$listaMedicamentos = $sql->fetchAll(PDO::FETCH_ASSOC); // Codigo certo para chamar o SQL só não sei que a variavel esta correta

// Verifique se a consulta foi bem-sucedida
/*if (!$result) {
    die("Erro na consulta: " . $conn->error);
}*/

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Listar Medicamentos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Medicamentos Cadastrados</h2>
       <!-- > <form method="GET" class="row g-3 mb-3">
            <div class="col-md-4">
                <input type="text" class="form-control" name="busca" placeholder="Buscar por nome" value="<?php echo htmlspecialchars($busca); ?>">
            </div>
            <div class="col-md-4">
                <select class="form-select" name="ordenar">
                    <option value="nome" <?php if($listaMedicamentos == 'nome') echo 'selected'; ?>>Ordenar por Nome</option>
                    <option value="categoria" <?php if($listaMedicamentos == 'categoria') echo 'selected'; ?>>Ordenar por Categoria</option>
                    <option value="preco_venda" <?php if($listaMedicamentos == 'preco_venda') echo 'selected'; ?>>Ordenar por Preço de Venda</option>
                </select>
            </div>
            <div class="col-md-4">
                <button type="submit" class="btn btn-primary w-100">Aplicar</button>
            </div>
        </form> <!-->

        <table class="table table-striped table-responsive">
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
                <?php if($result->num_rows > 0):  ?>
                    <?php while($med = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($med['nome']); ?></td>
                            <td>R$ <?php echo number_format($med['preco_custo'], 2, ',', '.'); ?></td>
                            <td>R$ <?php echo number_format($med['preco_venda'], 2, ',', '.'); ?></td>
                            <td><?php echo $med['quantidade']; ?></td>
                            <td><?php echo htmlspecialchars($med['categoria']); ?></td>
                            <td><?php echo date('d/m/Y', strtotime($med['data_validade'])); ?></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="text-center">Nenhum medicamento encontrado.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        <a href="cadastrar_medicamento.php" class="btn btn-primary">Cadastrar Novo Medicamento</a>
    </div>
</body>
</html>
