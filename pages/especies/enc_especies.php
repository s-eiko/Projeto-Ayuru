<?php
    session_start();

    $conexao = mysqli_connect("localhost", "root", "Fukuoka23.","ayuru") or die ("Falha na conexão");

    $esp = $_GET["esp"];

    $sql = "SELECT * FROM enc_especies WHERE especie=$esp";
    $tabela = mysqli_query($conexao, $sql);

    $especie = mysqli_query($conexao, "SELECT * FROM especies WHERE especie=$esp");
    $lin = mysqli_fetch_array($especie);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../style.css">
    <title><?php echo $esp;?></title>
</head>
<body>
    <nav>
        <div class="nav-pagina">
            <a href="<?php if ($lin["tipo"] == "flora") echo 'flora.php'; else echo 'fauna.php';?>">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8"/>
                </svg>
            </a>
        </div>
    </nav>
    <main>
        <?php
            while ($linha = mysqli_fetch_array($tabela, MYSQLI_ASSOC)) {
        ?>
            <div style="background-color: #325D2F; padding: 1rem; color: #F0F7DA; margin-bottom: 1rem;" href="enc_especies.php?esp=<?php echo   $linha['especie'];?>">
                <img src="<?php echo "../../images/".$linha["foto"];?>" style="width: 100%;">
                <p style="font-size: 1.5rem; margin: 0;"><?php echo $linha["especie"];?></p>
                <p style="margin: 0;">Encontrado em: <?php echo $linha["endereco"];?></p>
                <p style="margin: 0;"><?php echo $linha["latitude"]."; ".$linha["longitude"];?></p>
                <p style="margin: 0;"><?php echo $linha["data"]." ".$linha["hora"];?></p>
                <p style="margin: 0;"><?php echo $linha["descricao"];?></p>
                <?php
                    if (isset($_SESSION["validado"]) && $_SESSION["validado"] == true && $linha["usuario"] == $_SESSION["usuario"]) {
                ?>
                    <div style="text-align: right;">
                        <a href='../../crud.php?acao=A&post=especie&id=<?php echo $linha["id_enc"]?>' style="margin-right: .5rem;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16" style="color: #F0F7DA;">
                                <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.5.5 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11z"/>
                            </svg>
                        </a>
                        <a href='../../crud.php?acao=E&post=especie&id=<?php echo $linha["id_enc"]?>'>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16" style="color: #F0F7DA;">
                                <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0"/>
                            </svg>
                        </a>
                    </div>
                <?php
                    }
                ?>
            </div>
        <?php
            }
        ?>
    </main>
</body>
</html>
<?php
    mysqli_close($conexao);
?>