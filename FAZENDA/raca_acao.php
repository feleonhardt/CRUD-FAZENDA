<?php
include_once "assets/conf/default.inc.php";
require_once "assets/conf/Conexao.php";
$pdo = Conexao::getInstance();

// $field_novo = $GLOBALS['pdo']->query("SELECT * FROM {$tabela} WHERE codigo = {$codigo};");
//     $valores = array();
//     while ($linha = $field_novo->fetch(PDO::FETCH_ASSOC)) {
//       $valores = $linha;
//     }

    $acao = isset($_GET['acao']) ? $_GET['acao']:'';
    if ($acao == 'add') {
        $nome = isset($_GET['nome']) ? $_GET['nome']:'';

        $sql = "INSERT INTO raca (nome) VALUES (:nome);";
        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(':nome', $nome);

        $stmt->execute();

    }elseif ($acao == 'excluir') {
        $excluir = isset($_GET['excluir']) ? $_GET['excluir'] : null;
        // $tabela = isset($_GET['tabela']) ? $_GET['tabela'] : 'estados';
        if ($excluir != null) {
            $exclusao = $pdo->query("DELETE from raca where codigo = {$excluir};");
            $exclusao->execute();
        }
    }elseif ($acao == 'alterar') {
        $cod = isset($_GET['cod']) ? $_GET['cod']:'';
        $nome = isset($_GET['nome']) ? $_GET['nome']:'';

        $sql = "UPDATE raca SET nome = :nome WHERE codigo = :cod;";
        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(':cod', $cod);
        $stmt->bindParam(':nome', $nome);

        $stmt->execute();
    }
    header('location:raca.php');



?>