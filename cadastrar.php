
<?php

function conectarBanco() {
    $host = 'localhost';
    $db = 'farmacia'; 
    $user = 'root'; 
    $pass = 'cimatec'; 

    try {
        $conn = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch (PDOException $e) {
        echo "Erro na conexão: " . $e->getMessage();
        exit;
    }
}






// CADASTRAR MEDicamentos
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['cadastrar'])) {
    $nome = $_POST['nome'];
    $preco = $_POST['preco'];
    $quantidade = $_POST['quantidade'];
    $categoria = $_POST['categoria'];
    $validade = $_POST['validade'];

    $conn = conectarBanco();
    $sql = "INSERT INTO medicamentos (nome, preco, quantidade, categoria, validade) VALUES (:nome, :preco, :quantidade, :categoria, :validade)";
    
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':preco', $preco);
    $stmt->bindParam(':quantidade', $quantidade);
    $stmt->bindParam(':categoria', $categoria);
    $stmt->bindParam(':validade', $validade);
    
    try {
        $stmt->execute();
        echo "<div class='alert alert-success'>Medicamento cadastrado com sucesso!</div>";
    } catch (PDOException $e) {
        echo "<div class='alert alert-danger'>Erro ao cadastrar medicamento: " . $e->getMessage() . "</div>";
    }
}



//TABELA MEDICAMENTO/LISTAGEM
function listarMedicamentos() {
    $conn = conectarBanco();
    $sql = "SELECT * FROM medicamentos ORDER BY nome ASC"; 
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

$medicamentos = listarMedicamentos();
?>




<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Medicamento</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Cadastrar Medicamento</h2>
        <?php if(isset($sucesso)): ?>
            <div class="alert alert-success"><?php echo htmlspecialchars($sucesso); ?></div>
        <?php endif; ?>
        <?php if(isset($erro)): ?>
            <div class="alert alert-danger"><?php echo htmlspecialchars($erro); ?></div>
        <?php endif; ?>
        <form action="listar1.php" method="POST">
            <div class="mb-3">
                <label for="nome" class="form-label">Nome do Medicamento</label>
                <input type="text" class="form-control" id="nome" name="nome" required>
            </div>
            <div class="mb-3">
                <label for="preco_custo" class="form-label">Preço de Custo</label>
                <input type="number" step="0.01" class="form-control" id="preco_custo" name="preco_custo" required>
            </div>
            <div class="mb-3">
                <label for="preco_venda" class="form-label">Preço de Venda</label>
                <input type="number" step="0.01" class="form-control" id="preco_venda" name="preco_venda" required>
            </div>
            <div class="mb-3">
                <label for="quantidade" class="form-label">Quantidade em Estoque</label>
                <input type="number" class="form-control" id="quantidade" name="quantidade" required>
            </div>
            <div class="mb-3">
                <label for="categoria" class="form-label">Categoria</label>
                <select class="form-select" id="categoria" name="categoria" required>
                    <option value="">Selecione uma categoria</option>                    
                    <option value="Analgésico">Analgésico</option>
                    <option value="Antibiotico">Antibiotico</option>
                    <option value="Antidepressivos">Antidepressivos</option>
                    <option value="Antivirais">Antivirais</option>
                    <option value="Antitérmicos">Antitérmicos</option>
                    <option value="Anti-inflamatórios">Anti-inflamatórios</option>
                    <option value="Antialérgicos">Antialérgicos</option>                    
                    <option value="Antigripais">Antigripais</option>
                    <option value="Antifúngicos">Antifúngicos</option>
                    <option value="Higiene Pessoal">Higiene Pessoal</option>
                    <option value="Dermatologicos">Dermatologicos</option>
                    <option value="Primeiros Socorros">Primeiros Socorros</option>                    
                    <option value="Vitaminas e Suplementos">Vitaminas e Suplementos</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="data_validade" class="form-label">Data de Validade</label>
                <input type="date" class="form-control" id="data_validade" name="data_validade" required>
            </div>
            <button type="submit" class="btn btn-success">Cadastrar</button>
            <a href="listar1.php" class="btn btn-primary">Ver Medicamentos</a><br><br><br>
            <a href="menu.php" class="btn btn-secondary active" role="button">Ir para o menu</a><br><br>
        </form>
    </div>
</body>
</html>
