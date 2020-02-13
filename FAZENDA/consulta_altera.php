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
    <title>Alterar consulta</title>
</head>
<body>
    <?php
        $acao = isset($_GET['acao']) ? $_GET['acao'] : '';
        if ($acao == 'alterar'){
            $vet = isset($_GET['vet']) ? $_GET['vet'] : '';
            $gado = isset($_GET['gado']) ? $_GET['gado'] : '';
            $sql = "SELECT * FROM gado_has_vet WHERE gado_codigo = :gado and veterinario_codigo = :vet;";
            $stmt = $pdo->prepare($sql);

            $stmt->bindParam(':gado', $gado);
            $stmt->bindParam(':vet', $vet);

            $stmt->execute();
            while ($linha = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<form action='consulta_acao.php' method='get'>";
                    echo "<input type='hidden' name='gado_codigo' value='".$linha['gado_codigo']."'>";
                    echo "<input type='hidden' name='vet' value='".$vet."'>";
                    echo "<input type='hidden' name='acao' value='alterar'>";
                    echo "Veterinário:";
                    echo "<select name='veterinario_codigo'>";
                    $sql = $pdo->query("SELECT * FROM veterinario;");
                    while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
                        echo "<option value='".$row['codigo']."'";
                        if ($row['codigo']==$linha['veterinario_codigo']) {
                            echo " selected";
                        }
                        echo ">".$row['nome']."</option>";
                    }
                    echo "</select><br>";
                    echo "Ultima consulta: <input type='date' name='data' value='".$linha['ultima_consulta']."'><br>";
                    echo "Tratamento: <input type='text' name='tratamento' value='".$linha['tratamento']."'><br>";
                    echo "<input type='submit' value='ALTERAR'>";
                echo "</form>";
            }
        }else{
            header('location:consulta.php');
        }
    ?>
</body>
</html>