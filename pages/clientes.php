<?php include("../includes/auth.php"); ?>
<?php include("../includes/conexao.php"); ?>
<link rel="stylesheet" href="../css/style.css">

<div class="sidebar">
    <h2>🐶 PetCare</h2>
    <a href="dashboard.php">🏠 Dashboard</a>
    <a href="clientes.php">👤 Clientes</a>
    <a href="pets.php">🐕 Pets</a>
    <a href="servicos.php">🛠️ Serviços</a>
</div>

<div class="main">
    <div class="header">
        <h2>👤 Clientes</h2>
    </div>

    <div class="card">
        <form method="POST" action="../actions/inserir_cliente.php">
            <input type="text" name="nome" placeholder="Nome">
            <input type="text" name="telefone" placeholder="Telefone">
            <button>Salvar</button>
        </form>
    </div>

    <div class="card">
        <h3>Lista de Clientes</h3>

        <?php
        $res = $conn->query("SELECT * FROM clientes");
       while($c = $res->fetch_assoc()){
    echo "<div class='item'>";
    echo "<strong>".$c['nome']."</strong> - ".$c['telefone'];

    echo " <a style='color:red; margin-left:10px;' 
    href='../actions/excluir_cliente.php?id=".$c['id']."'>
    ❌ Excluir</a>";

    echo "</div>";
}
        ?>
    </div>
</div>