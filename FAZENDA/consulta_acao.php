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
    $gcod='';
    if ($acao == 'add') {

        $gado_codigo = isset($_GET['gado_codigo']) ? $_GET['gado_codigo']:'';
        $veterinario_codigo = isset($_GET['veterinario_codigo']) ? $_GET['veterinario_codigo']:'';
        $data = isset($_GET['data']) ? $_GET['data']:'';
        $tratamento = isset($_GET['tratamento']) ? $_GET['tratamento']:'';

        $sql = "SELECT * from gado_has_vet where gado_codigo = :gado and veterinario_codigo = :vet;";
        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(':gado', $gado_codigo);
        $stmt->bindParam(':vet', $veterinario_codigo);

        $stmt->execute();
        $cont=0;
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $cont++;
        }
        if ($cont!=0) {
            $sql = "UPDATE gado_has_vet SET ultima_consulta = :ultima_consulta, tratamento = :tratamento WHERE gado_codigo = :gado and veterinario_codigo = :vet;";
            $stmt = $pdo->prepare($sql);
    
            $stmt->bindParam(':gado', $gado_codigo);
            $stmt->bindParam(':vet', $veterinario_codigo);
            $stmt->bindParam(':ultima_consulta', $data);
            $stmt->bindParam(':tratamento', $tratamento);
    
            $stmt->execute();
        }else {
            $sql = "INSERT INTO gado_has_vet (gado_codigo, veterinario_codigo, ultima_consulta, tratamento) VALUES (:gado, :vet, :consulta, :tratamento);";
            $consulta = $pdo->prepare($sql);

            $consulta->bindParam(':gado', $gado_codigo);
            $consulta->bindParam(':vet', $veterinario_codigo);
            $consulta->bindParam(':consulta', $data);
            $consulta->bindParam(':tratamento', $tratamento);

            $consulta->execute();
        }

        echo $cont;

        // $gado_codigo = isset($_GET['gado_codigo']) ? $_GET['gado_codigo']:'';
        // $veterinario_codigo = isset($_GET['veterinario_codigo']) ? $_GET['veterinario_codigo']:'';
        // $data = isset($_GET['data']) ? $_GET['data']:'';
        // $tratamento = isset($_GET['tratamento']) ? $_GET['tratamento']:'';

        // $sql = "INSERT INTO gado_has_vet (gado_codigo, veterinario_codigo, ultima_consulta, tratamento) VALUES (:gado, :vet, :consulta, :tratamento);";
        // $stmt = $pdo->prepare($sql);

        // $stmt->bindParam(':gado', $gado_codigo);
        // $stmt->bindParam(':vet', $veterinario_codigo);
        // $stmt->bindParam(':consulta', $data);
        // $stmt->bindParam(':tratamento', $tratamento);

        // $stmt->execute();

        

    }elseif ($acao == 'excluir') {
        $vet = isset($_GET['vet']) ? $_GET['vet'] : null;
        $gado = isset($_GET['gado']) ? $_GET['gado'] : null;
        // $tabela = isset($_GET['tabela']) ? $_GET['tabela'] : 'estados';
        if ($vet != null and $gado != null) {
            $exclusao = $pdo->query("DELETE from gado_has_vet where veterinario_codigo = {$vet} and gado_codigo = {$gado};");
            $exclusao->execute();
        }
        // $gcod='?gado_codigo='.$gado;
    }elseif ($acao == 'alterar') {
        $gado_codigo = isset($_GET['gado_codigo']) ? $_GET['gado_codigo']:'';
        $vet = isset($_GET['vet']) ? $_GET['vet']:'';
        $veterinario_codigo = isset($_GET['veterinario_codigo']) ? $_GET['veterinario_codigo']:'';
        $data = isset($_GET['data']) ? $_GET['data']:'';
        $tratamento = isset($_GET['tratamento']) ? $_GET['tratamento']:'';

        $sql = "UPDATE gado_has_vet SET veterinario_codigo = :veterinario_codigo, ultima_consulta = :ultima_consulta, tratamento = :tratamento WHERE gado_codigo = :gado and veterinario_codigo = :vet;";
        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(':gado', $gado_codigo);
        $stmt->bindParam(':vet', $vet);
        $stmt->bindParam(':veterinario_codigo', $veterinario_codigo);
        $stmt->bindParam(':ultima_consulta', $data);
        $stmt->bindParam(':tratamento', $tratamento);

        $stmt->execute();
        // $gcod='?gado_codigo='.$gado_codigo;
    }
    header('location:consulta.php'.$gcod);
    



?>