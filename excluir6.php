<?php

require 'config1.php';

// Obter o ID do medicamento
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Deletar o medicamento
$sql = "DELETE FROM medicamentos WHERE id = $id";

if ($conn->query($sql) === TRUE) {
    header("Location: listar4.php");
} else {
    echo "Erro ao deletar: " . $conn->error;
}
?>
