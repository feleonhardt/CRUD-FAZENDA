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
    <title>Alterar gado</title>
</head>
<body>
    <?php
        $acao = isset($_GET['acao']) ? $_GET['acao'] : '';
        if ($acao == 'alterar'){
            $cod = isset($_GET['cod']) ? $_GET['cod'] : '';
            $sql = "SELECT * FROM gado WHERE codigo = :cod;";
            $stmt = $pdo->prepare($sql);

            $stmt->bindParam(':cod', $cod);

            $stmt->execute();
            while ($linha = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<form action='gado_acao.php' method='get'>";
                    echo "<input type='hidden' name='cod' value='".$linha['codigo']."'>";
                    echo "<input type='hidden' name='acao' value='alterar'>";
                    echo "Nome: <input type='text' name='nome' value='".$linha['nome']."'><br>";
                    echo "Idade: <input type='text' name='idade' value='".$linha['idade']."'><br>";
                    echo "Peso: <input type='text' name='peso' value='".$linha['peso']."'><br>";
                    echo "Raça: <select name='raca'>";
                    $sql = "SELECT * FROM raca";
                    $consulta = $pdo->prepare($sql);
                    $consulta->execute();
                    while ($row = $consulta->fetch(PDO::FETCH_ASSOC)) {
                        echo "<option value='".$row['codigo']."'";
                        if ($row['codigo'] == $linha['raca_codigo']) {
                            echo " selected";
                        }
                        echo ">".$row['nome']."</option>";
                    }
                    echo "</select><br>";
                    echo "Criador: <select name='criador'>";
                    $sql = "SELECT * FROM criador";
                    $consulta = $pdo->prepare($sql);
                    $consulta->execute();
                    while ($row = $consulta->fetch(PDO::FETCH_ASSOC)) {
                        echo "<option value='".$row['codigo']."'";
                        if ($row['codigo'] == $linha['criador_codigo']) {
                            echo " selected";
                        }
                        echo ">".$row['nome']."</option>";
                    }
                    echo "</select><br>";
                    echo "<input type='submit' value='ALTERAR'>";
                echo "</form>";
            }
        }else{
            header('location:gado.php');
        }
    ?>
</body>
</html>