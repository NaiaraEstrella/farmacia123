<?php
//session_start();
require 'config1.php';

//$stmt = $pdo->prepare($sql);
//$med = $stmt->fetch(PDO::FETCH_ASSOC);



// Verificar se o formulário foi enviado para atualizar
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Captura o ID do medicamento que você deseja atualizar
    $id = $_POST['id']; //  garantir que o ID esteja sendo enviado no formulário

    $nome = $_POST['nome'];
    $preco_custo = $_POST['preco_custo'];
    $preco_venda = $_POST['preco_venda'];
    $quantidade = $_POST['quantidade'];
    $categoria = $_POST['categoria'];
    $data_validade = $_POST['data_validade'];

    // Atualizar no banco de dados usando consultas preparadas
    $sql = "UPDATE medicamentos SET 
                nome = :nome, 
                preco_custo = :preco_custo, 
                preco_venda = :preco_venda, 
                quantidade = :quantidade, 
                categoria = :categoria, 
                data_validade = :data_validade 
            WHERE id = :id";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':preco_custo', $preco_custo);
    $stmt->bindParam(':preco_venda', $preco_venda);
    $stmt->bindParam(':quantidade', $quantidade);
    $stmt->bindParam(':categoria', $categoria);
    $stmt->bindParam(':data_validade', $data_validade);
    $stmt->bindParam(':id', $id);

    if ($stmt->execute()) {
        $sucesso = "Medicamento atualizado com sucesso!";
        // Atualizar as variáveis para exibir na página
        $med['nome'] = $nome;
        $med['preco_custo'] = $preco_custo;
        $med['preco_venda'] = $preco_venda;
        $med['quantidade'] = $quantidade;
        $med['categoria'] = $categoria;
        $med['data_validade'] = $data_validade;
    } else {
        $erro = "Erro: " . $stmt->errorInfo()[2]; // Mostra o erro da execução da consulta
    }
}

// Buscar informações do medicamento
$sql = "SELECT * FROM medicamentos";
$listaMedicamentos = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Medicamento</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Editar Medicamento</h2>
        <?php if(isset($sucesso)): ?>
            <div class="alert alert-success"><?php echo $sucesso; ?></div>
        <?php endif; ?>
        <?php if(isset($erro)): ?>
            <div class="alert alert-danger"><?php echo $erro; ?></div>
        <?php endif; ?>
        <form method="POST">
            <div class="mb-3">
                <label for="nome" class="form-label">Nome do Medicamento</label>
                <input type="text" class="form-control" id="nome" name="nome" value="<?php echo htmlspecialchars($med['nome']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="preco_custo" class="form-label">Preço de Custo</label>
                <input type="number" step="0.01" class="form-control" id="preco_custo" name="preco_custo" value="<?php echo $med['preco_custo']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="preco_venda" class="form-label">Preço de Venda</label>
                <input type="number" step="0.01" class="form-control" id="preco_venda" name="preco_venda" value="<?php echo $med['preco_venda']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="quantidade" class="form-label">Quantidade em Estoque</label>
                <input type="number" class="form-control" id="quantidade" name="quantidade" value="<?php echo $med['quantidade']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="categoria" class="form-label">Categoria</label>
                <select class="form-select" id="categoria" name="categoria" required>
                    <option value="">Selecione uma categoria</option>
                    <option <?php if($med['categoria'] == 'Analgésico') echo 'selected'; ?>>Analgésico</option>
                    <option <?php if($med['categoria'] == 'Antibiótico') echo 'selected'; ?>>Antibiótico</option>
                    <option <?php if($med['categoria'] == 'Anti-inflamatório') echo 'selected'; ?>>Anti-inflamatório</option>
                    <option <?php if($med['categoria'] == 'Antivirais') echo 'selected'; ?>>Antivirais</option>
                    <option <?php if($med['categoria'] == 'Antitérmicos') echo 'selected'; ?>>Antitérmicos</option>
                    <option <?php if($med['categoria'] == 'Antialérgicos') echo 'selected'; ?>>Antialérgicos</option>
                    <option <?php if($med['categoria'] == 'Vitaminas e Suplementos') echo 'selected'; ?>>Vitaminas e Suplementos</option>
                    <option <?php if($med['categoria'] == 'Antigripais') echo 'selected'; ?>>Antigripais</option>
                    <option <?php if($med['categoria'] == 'Antifúngicos') echo 'selected'; ?>>Antifúngicos</option>
                    <option <?php if($med['categoria'] == 'Higiene Pessoal') echo 'selected'; ?>>Higiene Pessoal</option>
                    <option <?php if($med['categoria'] == 'Dermatologicos') echo 'selected'; ?>>Dermatologicos</option>
                    <option <?php if($med['categoria'] == 'Primeiros Socorros') echo 'selected'; ?>>Primeiros Socorros</option>
                    <option <?php if($med['categoria'] == 'antidepressivos') echo 'selected'; ?>>Antidepressivos</option>
                   <!-- <option <?php if($med['categoria'] == '') echo 'selected'; ?>></option> -->
                    
                </select>
            </div>
            <div class="mb-3">
                <label for="data_validade" class="form-label">Data de Validade</label>
                <input type="date" class="form-control" id="data_validade" name="data_validade" value="<?php echo $med['data_validade']; ?>" required>
            </div>
            <button type="submit" class="btn btn-success">Atualizar</button>
            <a href="listar4.2.php" class="btn btn-primary">Voltar</a>
        </form>
    </div>
</body>
</html>
