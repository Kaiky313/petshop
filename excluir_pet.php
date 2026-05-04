<?php
include("../includes/conexao.php");

$id = $_GET['id'];

$conn->query("DELETE FROM pets WHERE id=$id");

header("Location: ../pages/pets.php");
?>