<!DOCTYPE html>
<?php
include_once "assets/conf/default.inc.php";
require_once "assets/conf/Conexao.php";
$pdo = Conexao::getInstance();
?>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alterar raca</title>
</head>
<body>
    <?php
        $acao = isset($_GET['acao']) ? $_GET['acao'] : '';
        if ($acao == 'alterar'){
            $cod = isset($_GET['cod']) ? $_GET['cod'] : '';
            $sql = "SELECT * FROM raca WHERE codigo = :cod;";
            $stmt = $pdo->prepare($sql);

            $stmt->bindParam(':cod', $cod);

            $stmt->execute();
            while ($linha = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<form action='raca_acao.php' method='get'>";
                    echo "<input type='hidden' name='cod' value='".$linha['codigo']."'>";
                    echo "<input type='hidden' name='acao' value='alterar'>";
                    echo "Raça: <input type='text' name='nome' value='".$linha['nome']."'><br>";
                    echo "<input type='submit' value='ALTERAR'>";
                echo "</form>";
            }
        }else{
            header('location:raca.php');
        }
    ?>
</body>
</html>