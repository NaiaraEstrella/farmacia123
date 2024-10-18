
<?php
    require 'config1.php';

    $nome = $_POST['nome'];
    $preco_venda = $_POST['preco_venda'];
    $preco_custo = $_POST['preco_custo'];
    $quantidade = $_POST['quantidade'];
    $categoria = $_POST['categoria'];
    $data_validade = $_POST['data_validade'];

   // var_dump($categoria);
   

    $sql = $pdo->prepare("INSERT INTO medicamentos (nome, preco_venda, preco_custo, quantidade, categoria, data_validade) VALUES (:nome, :preco_venda, :preco_custo, :quantidade, :categoria, :data_validade)");
    $sql->bindValue(':nome', $nome);
    $sql->bindValue(':preco_venda', $preco_venda);
    $sql->bindValue(':preco_custo', $preco_custo);    
    $sql->bindValue(':quantidade', $quantidade);
    $sql->bindValue(':categoria', $categoria);
    $sql->bindValue(':data_validade', $data_validade);

    $sql->execute();

    header("Location:listar4.2.php");
?>