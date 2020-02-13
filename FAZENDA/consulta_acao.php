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
        $gado_codigo = isset($_GET['gado_codigo']) ? $_GET['gado_codigo']:'';
        $veterinario_codigo = isset($_GET['veterinario_codigo']) ? $_GET['veterinario_codigo']:'';
        $data = isset($_GET['data']) ? $_GET['data']:'';
        $tratamento = isset($_GET['tratamento']) ? $_GET['tratamento']:'';

        $sql = "INSERT INTO gado_has_vet (gado_codigo, veterinario_codigo, ultima_consulta, tratamento) VALUES (:gado, :vet, :consulta, :tratamento);";
        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(':gado', $gado_codigo);
        $stmt->bindParam(':vet', $veterinario_codigo);
        $stmt->bindParam(':consulta', $data);
        $stmt->bindParam(':tratamento', $tratamento);

        $stmt->execute();

        header('location:consulta.php?gado_codigo='.$gado_codigo);

    }elseif ($acao == 'excluir') {
        $vet = isset($_GET['vet']) ? $_GET['vet'] : null;
        $gado = isset($_GET['gado']) ? $_GET['gado'] : null;
        // $tabela = isset($_GET['tabela']) ? $_GET['tabela'] : 'estados';
        if ($vet != null and $gado != null) {
            $exclusao = $pdo->query("DELETE from gado_has_vet where veterinario_codigo = {$vet} and gado_codigo = {$gado};");
            $exclusao->execute();
        }
    }elseif ($acao == 'alterar') {
        $cod = isset($_GET['cod']) ? $_GET['cod']:'';
        $nome = isset($_GET['nome']) ? $_GET['nome']:'';
        $crmv = isset($_GET['crmv']) ? $_GET['crmv']:'';
        $tel = isset($_GET['tel']) ? $_GET['tel']:'';

        $sql = "UPDATE gado_has_vet SET nome = :nome, CRMV = :crmv, telefone = :telefone WHERE gado_codigo = :gado and vaterinario_codigo = :vet;";
        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(':cod', $cod);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':crmv', $crmv);
        $stmt->bindParam(':telefone', $tel);

        $stmt->execute();
    }
    header('location:consulta.php');



?>