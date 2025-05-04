<?php

include("conexao.php");

$produto    = $_POST['produto']    ?? null;
$preco      = $_POST['preco']      ?? null;
$tamanho    = $_POST['tamanho']    ?? null;
$categoria  = $_POST['categoria']  ?? null;
$descricao  = $_POST['descricao']  ?? null;
$marca      = $_POST['marca']      ?? null;
$quantidade = $_POST['quantidade'] ?? null;
$ativo      = $_POST['ativo']      ?? 0;

if (!$produto || !$preco || !$tamanho || !$categoria || !$descricao || !$quantidade) {
    echo "Preencha todos os campos obrigatórios.";
    exit;
}

try {
    $varVerifica = $pdo->prepare(
        "SELECT COUNT(*) FROM produto WHERE nome_produto = :produto"
    );
    $varVerifica->bindParam(':produto', $produto);
    $varVerifica->execute();

    if ($varVerifica->fetchColumn() > 0) {
        echo "Produto já cadastrado";
        exit;
    }

    $pdo->beginTransaction();

    $varProduto = $pdo->prepare(
        "INSERT INTO produto
            (nome_produto, preco, tamanho, descricao, marca, categoria, quantidade, ativo)
         VALUES
            (:produto, :preco, :tamanho, :descricao, :marca, :categoria, :quantidade, :ativo)"
    );
    $varProduto->bindParam(':produto',    $produto);
    $varProduto->bindParam(':preco',      $preco);
    $varProduto->bindParam(':tamanho',    $tamanho);
    $varProduto->bindParam(':descricao',  $descricao);
    $varProduto->bindParam(':marca',      $marca);
    $varProduto->bindParam(':categoria',  $categoria);
    $varProduto->bindParam(':quantidade', $quantidade, PDO::PARAM_INT);
    $varProduto->bindParam(':ativo',      $ativo,     PDO::PARAM_INT);
    $varProduto->execute();

    $pdo->commit();

    echo "Cadastro realizado com sucesso!";

} catch (Exception $e) {
    if ($pdo->inTransaction()) {
        $pdo->rollBack();
    }
    echo "Erro ao cadastrar: " . $e->getMessage();
}
?>
