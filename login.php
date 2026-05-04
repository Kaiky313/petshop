<?php
session_start();
include("includes/conexao.php");

if ($_POST) {
    $user = $_POST['usuario'];
    $pass = $_POST['senha'];

    $sql = "SELECT * FROM usuarios WHERE usuario='$user' AND senha='$pass'";
    $res = $conn->query($sql);

    if ($res->num_rows > 0) {
        $_SESSION['usuario'] = $user;
        header("Location: pages/dashboard.php");
    } else {
        echo "Login inválido";
    }
}
?>

<link rel="stylesheet" href="css/style.css">

<div class="container">
    <div class="card">
        <h2>Login PetCare</h2>
        <form method="POST">
            <input type="text" name="usuario" placeholder="Usuário"><br><br>
            <input type="password" name="senha" placeholder="Senha"><br><br>
            <button>Entrar</button>
        </form>
    </div>
</div>