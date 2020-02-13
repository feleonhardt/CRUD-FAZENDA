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
        $crmv = isset($_GET['crmv']) ? $_GET['crmv']:'';
        $tel = isset($_GET['tel']) ? $_GET['tel']:'';

        $sql = "INSERT INTO veterinario (nome, CRMV, telefone) VALUES (:nome, :crmv, :tel);";
        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':crmv', $crmv);
        $stmt->bindParam(':tel', $tel);

        $stmt->execute();

    }elseif ($acao == 'excluir') {
        $excluir = isset($_GET['excluir']) ? $_GET['excluir'] : null;
        // $tabela = isset($_GET['tabela']) ? $_GET['tabela'] : 'estados';
        if ($excluir != null) {
            $exclusao = $pdo->query("DELETE from veterinario where codigo = {$excluir};");
            $exclusao->execute();
        }
    }elseif ($acao == 'alterar') {
        $cod = isset($_GET['cod']) ? $_GET['cod']:'';
        $nome = isset($_GET['nome']) ? $_GET['nome']:'';
        $crmv = isset($_GET['crmv']) ? $_GET['crmv']:'';
        $tel = isset($_GET['tel']) ? $_GET['tel']:'';

        $sql = "UPDATE veterinario SET nome = :nome, CRMV = :crmv, telefone = :telefone WHERE codigo = :cod;";
        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(':cod', $cod);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':crmv', $crmv);
        $stmt->bindParam(':telefone', $tel);

        $stmt->execute();
    }
    header('location:vet.php');



?>