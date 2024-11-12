create database farmacia;
use farmacia;

CREATE TABLE medicamentos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    preco_custo DECIMAL(10, 2) NOT NULL,
    preco_venda DECIMAL(10, 2) NOT NULL,
    quantidade INT NOT NULL,
    categoria VARCHAR(50) NOT NULL,
    data_validade DATE NOT NULL
);
