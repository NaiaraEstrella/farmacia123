<?php
require 'config.php';

// Obter o ID do medicamento de forma segura
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Verificar se o ID é válido
if ($id > 0) {
    // Deletar o medicamento usando uma consulta preparada
    $sql = "DELETE FROM medicamentos WHERE id = ?";
    $stmt = $conn->prepare($sql);
    
    if ($stmt->execute([$id])) {
        header("Location: listar1.php");
        exit; // Adiciona exit após header para evitar execução adicional
    } else {
        echo "Erro ao deletar: " . htmlspecialchars($stmt->errorInfo()[2]);
    }
} else {
    echo "ID inválido.";
}
?>