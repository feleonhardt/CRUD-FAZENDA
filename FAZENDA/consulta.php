<!DOCTYPE html>
<?php
include_once "assets/conf/default.inc.php";
require_once "assets/conf/Conexao.php";
$pdo = Conexao::getInstance();
$gado_codigo = isset($_GET['gado_codigo']) ? $_GET['gado_codigo'] : '';
?>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta</title>
</head>
<body>
    <a href="index.php">< HOME</a><br><br>
    <form action="" method="get">
        Nome do Gado: <select name='gado_codigo'>
        <?php
        $sql = $pdo->query("SELECT * FROM gado;");
        while ($linha = $sql->fetch(PDO::FETCH_ASSOC)) {
            echo "<option value='".$linha['codigo']."'";
            if ($gado_codigo != '' and $gado_codigo==$linha['codigo']) {
                echo " selected";
            }
            echo ">".$linha['nome']."</option>";
        }
        ?>
        </select><br>
        <input type="submit" value="CONSULTAR">

    </form>

    <br><br><br>

    <?php
    if ($gado_codigo!='') {
        ?>

        <table border=1>
        <tr>
        <th>Gado</th>
        <th>Veterinário</th>
        <th>Última consulta</th>
        <th>Tratamento</th>
        <th>Excluir</th>
        <th>Alterar</th>
        </tr>
        <?php
        $sql = "SELECT * FROM gado_has_vet where gado_codigo = :cod;";
        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(':cod', $gado_codigo);
        $consulta->execute();
        while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
                echo "<td>";
                $sql = "SELECT * FROM gado where codigo = :cod;";
                $consulta = $pdo->prepare($sql);
                $consulta->bindParam(':cod', $linha['gado_codigo']);
                $consulta->execute();
                while ($row = $consulta->fetch(PDO::FETCH_ASSOC)) {
                    echo $row['nome'];
                }
                echo "</td>";
                echo "<td>";
                $sql = "SELECT * FROM veterinario where codigo = :cod;";
                $consulta = $pdo->prepare($sql);
                $consulta->bindParam(':cod', $linha['veterinario_codigo']);
                $consulta->execute();
                while ($row = $consulta->fetch(PDO::FETCH_ASSOC)) {
                    echo $row['nome'];
                }
                echo "</td>";
                echo "<td>".$linha['ultima_consulta']."</td>";
                echo "<td>".$linha['tratamento']."</td>";
                echo "<td>";
                    ?>
                    <a href="javascript:excluir('consulta_acao.php?acao=excluir&vet=
                    <?php echo $linha['veterinario_codigo']; ?>
                    &gado=
                    <?php echo $linha['gado_codigo']; ?>
                    ')">Excluir</a>
                    <?php
                    echo "</td>";
                    echo "<td>";
                    ?>
                    <a href="consulta_altera.php?acao=alterar&vet=
                    <?php echo $linha['veterinario_codigo']; ?>
                    &gado=
                    <?php echo $linha['gado_codigo']; ?>
                    ')">Alterar</a>
                    <?php
                    echo "</td>";
            echo "</tr>";
        }
        ?>
        <form action="consulta_acao.php" method="get">
        <input type="hidden" name="acao" value="add">
        <input type="hidden" name="gado_codigo" value="<?php echo $gado_codigo;?>">
        <tr>
        <td>
        <?php
            $sql = "SELECT * FROM gado where codigo = :cod;";
            $consulta = $pdo->prepare($sql);
            $consulta->bindParam(':cod', $gado_codigo);
            $consulta->execute();
            while ($row = $consulta->fetch(PDO::FETCH_ASSOC)) {
                echo $row['nome'];
            }
        ?>
        </td>
        <td>
            <select name='veterinario_codigo'>
            <?php
            $sql = $pdo->query("SELECT * FROM veterinario;");
            while ($linha = $sql->fetch(PDO::FETCH_ASSOC)) {
                echo "<option value='".$linha['codigo']."'>".$linha['nome']."</option>";
            }
            ?>
            </select>
        </td>
        <td>
            <input type="date" name="data" required>
        </td>
        <td>
            <input type="text" name="tratamento" required>
        </td>
        <td colspan=2>
            <input type="submit" value="ADICIONAR">
        </td>
        </tr>
        </form>
    </table>

<?php
}
?>

</body>
<script>
 function excluir(url) {
     if(confirm("Confirmar exclusão?")){
       location.href=url;
     }
 }
</script>
</html>