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
        $idade = isset($_GET['idade']) ? $_GET['idade']:'';
        $peso = isset($_GET['peso']) ? $_GET['peso']:'';
        $raca = isset($_GET['raca']) ? $_GET['raca']:'';
        $criador = isset($_GET['criador']) ? $_GET['criador']:'';

        $sql = "INSERT INTO gado (nome, idade, peso, raca_codigo, criador_codigo) VALUES (:nome, :idade, :peso, :raca, :criador);";
        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':idade', $idade);
        $stmt->bindParam(':peso', $peso);
        $stmt->bindParam(':raca', $raca);
        $stmt->bindParam(':criador', $criador);

        $stmt->execute();

    }elseif ($acao == 'excluir') {
        $excluir = isset($_GET['excluir']) ? $_GET['excluir'] : null;
        // $tabela = isset($_GET['tabela']) ? $_GET['tabela'] : 'estados';
        if ($excluir != null) {
            $exclusao = $pdo->query("DELETE from gado where codigo = {$excluir};");
            $exclusao->execute();
        }
    }elseif ($acao == 'alterar') {
        $cod = isset($_GET['cod']) ? $_GET['cod']:'';
        $nome = isset($_GET['nome']) ? $_GET['nome']:'';
        $idade = isset($_GET['idade']) ? $_GET['idade']:'';
        $peso = isset($_GET['peso']) ? $_GET['peso']:'';
        $raca = isset($_GET['raca']) ? $_GET['raca']:'';
        $criador = isset($_GET['criador']) ? $_GET['criador']:'';

        $sql = "UPDATE gado SET nome = :nome, idade = :idade, peso = :peso, raca_codigo = :raca, criador_codigo = :criador WHERE codigo = :cod;";
        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(':cod', $cod);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':idade', $idade);
        $stmt->bindParam(':peso', $peso);
        $stmt->bindParam(':raca', $raca);
        $stmt->bindParam(':criador', $criador);

        $stmt->execute();
    }
    header('location:gado.php');



?>