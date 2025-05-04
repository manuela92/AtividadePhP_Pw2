<?php
session_start(); // Inicia a sessão
$mensagem = "";

if (isset($_SESSION['usuario'])) {
    $mensagem = "Bem-vindo, " . $_SESSION['usuario'] . "!";
} else {
    echo "<script>
    alert('Usuário não autenticado! Volte e faça o login.');
</script>";
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" type="text/css" href="../css/home.css">
</head>
<body>

    <header class="barra">
        <div class="logo">
					<img src="../imagens/logo.jpg" alt="Logo" />
		</div>
        <nav class="links">
            <a href="../html/cadastro-produto.html">Cadastrar produtos</a>
            <a href="home.php">Voltar para a Home</a>
            <a href="../html/cadastro.html">Cadastre-se</a>
            <a href="../index.html">Login</a>
        </nav>   
    </header>

    <div class="container-principal">
        <h1><?php echo $mensagem; ?></h1>
        <br>
        <hr>
    </div>

</body>
</html>
