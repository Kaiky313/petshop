<?php
$conn = new mysqli("localhost", "root", "", "petshop", "3307");

if ($conn->connect_error) {
    die("Erro: " . $conn->connect_error);
}
?>