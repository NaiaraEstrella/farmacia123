<?php
require 'config1.php';


$sql = $pdo ->query("SELECT * FROM medicamentos ");

$listaMedicamentos = [];

$listaMedicamentos = $sql->fetchAll(PDO::FETCH_ASSOC); // Codigo certo para chamar o SQL só não sei que a variavel esta correta



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
       
        <table class="table table-striped table-responsive">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Preço</th>
                    <th>Quantidade</th>
                    <th>Categoria</th>
                    <th>Data de Validade</th>
                </tr>
            </thead>
            <tbody>
               
            </tbody>
        </table>
        <a href="cadastrar3.php" class="btn btn-primary">Cadastrar Novo Medicamento</a>
    </div>
</body>
</html>
