<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

include("../includes/auth.php");
include("../includes/conexao.php");

/* =========================
   SALVAR SERVIÇO
========================= */
if (isset($_POST['salvar'])) {
    $descricao = $_POST['descricao'];
    $preco = $_POST['preco'];

    $conn->query("INSERT INTO servicos (descricao, preco) VALUES ('$descricao', '$preco')");
    header("Location: servicos.php");
}

/* =========================
   ATUALIZAR SERVIÇO
========================= */
if (isset($_POST['atualizar'])) {
    $id = $_POST['id'];
    $descricao = $_POST['descricao'];
    $preco = $_POST['preco'];

    $conn->query("UPDATE servicos SET descricao='$descricao', preco='$preco' WHERE id=$id");
    header("Location: servicos.php");
}

/* =========================
   MODO EDIÇÃO
========================= */
$editando = false;
$descricaoEdit = "";
$precoEdit = "";

if (isset($_GET['editar'])) {
    $id = $_GET['editar'];
    $editando = true;

    $res = $conn->query("SELECT * FROM servicos WHERE id=$id");
    $servico = $res->fetch_assoc();

    $descricaoEdit = $servico['descricao'];
    $precoEdit = $servico['preco'];
}
?>

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
        <h2>🛠️ Serviços</h2>
    </div>

    <div class="card">

        <!-- FORMULÁRIO -->
        <form method="POST">
            <input type="text" name="descricao" placeholder="Descrição" value="<?php echo $descricaoEdit; ?>" required>
            <input type="number" step="0.01" name="preco" placeholder="Preço" value="<?php echo $precoEdit; ?>" required>

            <?php if($editando){ ?>
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <button name="atualizar">Atualizar</button>
            <?php } else { ?>
                <button name="salvar">Salvar</button>
            <?php } ?>
        </form>

    </div>

    <div class="card">
        <h3>Lista de Serviços</h3>

        <?php
        $res = $conn->query("SELECT * FROM servicos");

        while($s = $res->fetch_assoc()){
            echo "<div class='item'>";
            echo "<strong>".$s['descricao']."</strong> - R$ ".$s['preco'];

            echo " <a style='margin-left:10px; color:blue;' 
            href='servicos.php?editar=".$s['id']."'>✏️ Editar</a>";

            echo "</div>";
        }
        ?>
    </div>
</div>