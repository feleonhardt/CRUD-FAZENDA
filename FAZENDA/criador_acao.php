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
        $propriedade = isset($_GET['propriedade']) ? $_GET['propriedade']:'';

        $sql = "INSERT INTO criador (nome, nomePropriedade) VALUES (:nome, :propriedade);";
        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':propriedade', $propriedade);

        $stmt->execute();

    }elseif ($acao == 'excluir') {
        $excluir = isset($_GET['excluir']) ? $_GET['excluir'] : null;
        // $tabela = isset($_GET['tabela']) ? $_GET['tabela'] : 'estados';
        if ($excluir != null) {
            $exclusao = $pdo->query("DELETE from criador where codigo = {$excluir};");
            $exclusao->execute();
        }
    }elseif ($acao == 'alterar') {
        $cod = isset($_GET['cod']) ? $_GET['cod']:'';
        $nome = isset($_GET['nome']) ? $_GET['nome']:'';
        $propriedade = isset($_GET['propriedade']) ? $_GET['propriedade']:'';

        $sql = "UPDATE criador SET nome = :nome, nomePropriedade = :propriedade WHERE codigo = :cod;";
        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(':cod', $cod);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':propriedade', $propriedade);

        $stmt->execute();
    }
    header('location:criador.php');



?>