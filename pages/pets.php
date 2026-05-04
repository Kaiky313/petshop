<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

include("../includes/auth.php");
include("../includes/conexao.php");

/* =========================
   SALVAR NOVO PET
========================= */
if (isset($_POST['salvar'])) {
    $nome = $_POST['nome'];
    $tipo = $_POST['tipo'];

    $conn->query("INSERT INTO pets (nome, tipo) VALUES ('$nome', '$tipo')");
    header("Location: pets.php");
}

/* =========================
   ATUALIZAR PET
========================= */
if (isset($_POST['atualizar'])) {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $tipo = $_POST['tipo'];

    $conn->query("UPDATE pets SET nome='$nome', tipo='$tipo' WHERE id=$id");
    header("Location: pets.php");
}

/* =========================
   MODO EDIÇÃO
========================= */
$editando = false;
$nomeEdit = "";
$tipoEdit = "";

if (isset($_GET['editar'])) {
    $id = $_GET['editar'];
    $editando = true;

    $res = $conn->query("SELECT * FROM pets WHERE id=$id");
    $pet = $res->fetch_assoc();

    $nomeEdit = $pet['nome'];
    $tipoEdit = $pet['tipo'];
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
        <h2>🐕 Pets</h2>
    </div>

    <div class="card">

        <!-- FORMULÁRIO -->
        <form method="POST">
            <input type="text" name="nome" placeholder="Nome do Pet" value="<?php echo $nomeEdit; ?>" required>
            <input type="text" name="tipo" placeholder="Tipo" value="<?php echo $tipoEdit; ?>" required>

            <?php if($editando){ ?>
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <button name="atualizar">Atualizar</button>
            <?php } else { ?>
                <button name="salvar">Salvar</button>
            <?php } ?>
        </form>

    </div>

    <div class="card">
        <h3>Lista de Pets</h3>

        <?php
        $res = $conn->query("SELECT * FROM pets");

        while($p = $res->fetch_assoc()){
            echo "<div class='item'>";
            echo "<strong>".$p['nome']."</strong> - ".$p['tipo'];

            echo " <a style='margin-left:10px; color:blue;' 
            href='pets.php?editar=".$p['id']."'>✏️ Editar</a>";

            echo "</div>";
        }
        ?>
    </div>
</div>