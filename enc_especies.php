<?php
    $conexao = mysqli_connect("localhost", "root", "Fukuoka23.","ayuru") or die ("Falha na conexão");

    $esp = $_GET["esp"];

    $sql = "SELECT * FROM enc_especies WHERE especie=$esp";
    $tabela = mysqli_query($conexao, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title><?php echo $esp;?></title>
</head>
<body>
    <?php
        while ($linha = mysqli_fetch_array($tabela, MYSQLI_ASSOC)) {
    ?>
        <div style="background-color: #325D2F; padding: 1rem; color: #F0F7DA; margin-bottom: 1rem;" href="enc_especies.php?esp=<?php echo $linha['especie'];?>">
            <img src="<?php echo $linha["foto"];?>" style="width: 100%;">
            <p style="font-size: 1.5rem; margin: 0;"><?php echo $linha["especie"];?></p>
            <p style="margin: 0;">Encontrado em: <?php echo $linha["endereco"];?></p>
            <p style="margin: 0;"><?php echo $linha["latitude"]."; ".$linha["longitude"];?></p>
            <p style="margin: 0;"><?php echo $linha["data"]." ".$linha["hora"];?></p>
            <p style="margin: 0;"><?php echo $linha["descricao"];?></p>
        </div>
     <?php
        }
     ?>
</body>
</html>
<?php
    mysqli_close($conexao);
?>