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
    <title>Criador</title>
</head>
<body>
    <a href="index.php">< HOME</a><br><br>
    <form action="criador_acao.php" method="get">
        Nome do Criador: <input type="text" name="nome" required><br>
        Nome da Propriedade: <input type="text" name="propriedade" required><br>
        <input type="hidden" name="acao" value="add">
        <input type="submit" value="ADICIONAR">
    </form>

    <br><br><br>


    <table border=1>
        <tr>
            <th>Código</th>
            <th>Nome</th>
            <th>Propriedade</th>
            <th>Excluir</th>
            <th>Alterar</th>
        </tr>
        <?php
            $sql = $pdo->query("SELECT * FROM criador;");
            while ($linha = $sql->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";
                    echo "<td>".$linha['codigo']."</td>";
                    echo "<td>".$linha['nome']."</td>";
                    echo "<td>".$linha['nomePropriedade']."</td>";
                    echo "<td>";
                    ?>
                    <a href="javascript:excluir('criador_acao.php?acao=excluir&excluir=
                    <?php echo $linha['codigo']; ?>
                    ')">Excluir</a>
                    <?php
                    echo "</td>";
                    echo "<td>";
                    ?>
                    <a href="criador_altera.php?acao=alterar&cod=
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