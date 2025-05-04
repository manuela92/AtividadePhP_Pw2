<?php

include("conexao.php");

//pegamos os dados do formulário e verificamos se eles possuem algum valor
$usuario = $_POST['usuario'] ?? null;
$senha   = $_POST['senha']   ?? null;
$nome    = $_POST['nome']    ?? null;
$email   = $_POST['email']   ?? null;

//validamos que todos os campos sejam preenchidos
if (!$usuario || !$senha || !$nome || !$email) {
    echo "Preencha todos os campos.";
    exit;
}

//Código que fizemos na aula do dia 28/04
try {
    // Verificar se o nome de usuário já existe
    $varVerifica = $pdo->prepare("SELECT COUNT(*) FROM login WHERE usuario = :usuario");
    $varVerifica->bindParam(':usuario', $usuario);
    $varVerifica->execute();

    if ($varVerifica->fetchColumn() > 0) {
        echo "Usuário já está em uso.";
        exit;
    }

    $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

    $pdo->beginTransaction();

    $varLogin = $pdo->prepare("INSERT INTO login (usuario, senha) VALUES (:usuario, :senha)");
    $varLogin->bindParam(':usuario', $usuario);
    $varLogin->bindParam(':senha', $senha_hash);
    $varLogin->execute();

    $id_login = $pdo->lastInsertId();

    $varUsuario = $pdo->prepare("INSERT INTO usuario (nome, email, id_login) VALUES (:nome, :email, :id_login)");
    $varUsuario->bindParam(':nome', $nome);
    $varUsuario->bindParam(':email', $email);
    $varUsuario->bindParam(':id_login', $id_login);
    $varUsuario->execute();

    $pdo->commit();

    echo "Cadastro realizado com sucesso!";

    //caso o cadastro de erro, irá entrar no catch e exibir o erro.
} catch (Exception $e) {
    if ($pdo->inTransaction()) {
        $pdo->rollBack();
    }
    echo "Erro ao cadastrar: " . $e->getMessage();
}
?>
