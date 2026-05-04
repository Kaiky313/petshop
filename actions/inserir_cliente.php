<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

include("../includes/conexao.php");

if ($_POST) {
    $nome = $_POST['nome'];
    $telefone = $_POST['telefone'];

    $sql = "INSERT INTO clientes (nome, telefone) VALUES ('$nome','$telefone')";

    if ($conn->query($sql)) {
        header("Location: ../pages/clientes.php");
    } else {
        echo "Erro: " . $conn->error;
    }
}
?>