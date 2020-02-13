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
    <title>Gado</title>
</head>
<body>
    <a href="index.php">< HOME</a><br><br>
    <form action="gado_acao.php" method="get">
        Nome do Gado: <input type="text" name="nome" required><br>
        Idade: <input type="num" name="idade" required><br>
        Peso: <input type="text" name="peso" required><br>
        Raça: <select name='raca'>
            <?php
            $sql = $pdo->query("SELECT * FROM raca;");
            while ($linha = $sql->fetch(PDO::FETCH_ASSOC)) {
                echo "<option value='".$linha['codigo']."'>".$linha['nome']."</option>";
            }
            ?>
            </select><br>
        Criador: <select name='criador'>
            <?php
            $sql = $pdo->query("SELECT * FROM criador;");
            while ($linha = $sql->fetch(PDO::FETCH_ASSOC)) {
                echo "<option value='".$linha['codigo']."'>".$linha['nome']."</option>";
            }
            ?>
            </select><br>
        <input type="hidden" name="acao" value="add">
        <input type="submit" value="ADICIONAR">
    </form>

    <br><br><br>


    <table border=1>
        <tr>
            <th>Código</th>
            <th>Nome</th>
            <th>Idade</th>
            <th>Peso</th>
            <th>Raça</th>
            <th>Criador</th>
            <th>Excluir</th>
            <th>Alterar</th>
        </tr>
        <?php
            $script = $pdo->query("SELECT * FROM gado;");
            while ($linha = $script->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";
                    echo "<td>".$linha['codigo']."</td>";
                    echo "<td>".$linha['nome']."</td>";
                    echo "<td>".$linha['idade']."</td>";
                    echo "<td>".$linha['peso']."</td>";
                    echo "<td>";
                    $sql = "SELECT * FROM raca where codigo=:cod";
                    $consulta = $pdo->prepare($sql);
                    $consulta->bindParam(':cod', $linha['raca_codigo']);
                    $consulta->execute();
                    while ($row = $consulta->fetch(PDO::FETCH_ASSOC)) {
                        echo $row['nome'];
                    }
                    echo "</td>";
                    echo "<td>";
                    $sql = "SELECT * FROM criador where codigo=:cod";
                    $consulta = $pdo->prepare($sql);
                    $consulta->bindParam(':cod', $linha['criador_codigo']);
                    $consulta->execute();
                    while ($row = $consulta->fetch(PDO::FETCH_ASSOC)) {
                        echo $row['nome'];
                    }
                    echo "</td>";
                    echo "<td>";
                    ?>
                    <a href="javascript:excluir('gado_acao.php?acao=excluir&excluir=
                    <?php echo $linha['codigo']; ?>
                    ')">Excluir</a>
                    <?php
                    echo "</td>";
                    echo "<td>";
                    ?>
                    <a href="gado_altera.php?acao=alterar&cod=
                    <?php echo $linha['codigo']; ?>
                    ')">Alterar</a>
                    <?php
                    echo "</td>";
                echo "</tr>";
            }
        ?>
    </table>
</body>
<script>
 function excluir(url) {
     if(confirm("Confirmar exclusão?")){
       location.href=url;
     }
 }
</script>
</html>