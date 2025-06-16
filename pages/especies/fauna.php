<?php
    session_start();

    $conexao = mysqli_connect("localhost", "root", "Fukuoka23.", "ayuru") or die("Falha na conexão");
    $tabela =  mysqli_query($conexao, "SELECT * FROM especies");

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["clas"])) {
            $clas = $_POST["clas"];
            $tabela = mysqli_query($conexao, "SELECT * FROM especies WHERE classificacao = '$clas'");
        }
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../style.css">
    <title>Fauna</title>
</head>
<body>
    <nav>
        <div class="nav-pagina">
            <a href="../inicio.html">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-house-door" viewBox="0 0 16 16">
                    <path
                        d="M8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4.5a.5.5 0 0 0 .5-.5v-4h2v4a.5.5 0 0 0 .5.5H14a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293zM2.5 14V7.707l5.5-5.5 5.5 5.5V14H10v-4a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5v4z" />
                </svg>
                <span class="icons">Início</span>
            </a>
        </div>
        <div class="nav-pagina">
            <a href="especies.html">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bug"
                    viewBox="0 0 16 16">
                    <path
                        d="M4.355.522a.5.5 0 0 1 .623.333l.291.956A5 5 0 0 1 8 1c1.007 0 1.946.298 2.731.811l.29-.956a.5.5 0 1 1 .957.29l-.41 1.352A5 5 0 0 1 13 6h.5a.5.5 0 0 0 .5-.5V5a.5.5 0 0 1 1 0v.5A1.5 1.5 0 0 1 13.5 7H13v1h1.5a.5.5 0 0 1 0 1H13v1h.5a1.5 1.5 0 0 1 1.5 1.5v.5a.5.5 0 1 1-1 0v-.5a.5.5 0 0 0-.5-.5H13a5 5 0 0 1-10 0h-.5a.5.5 0 0 0-.5.5v.5a.5.5 0 1 1-1 0v-.5A1.5 1.5 0 0 1 2.5 10H3V9H1.5a.5.5 0 0 1 0-1H3V7h-.5A1.5 1.5 0 0 1 1 5.5V5a.5.5 0 0 1 1 0v.5a.5.5 0 0 0 .5.5H3c0-1.364.547-2.601 1.432-3.503l-.41-1.352a.5.5 0 0 1 .333-.623M4 7v4a4 4 0 0 0 3.5 3.97V7zm4.5 0v7.97A4 4 0 0 0 12 11V7zM12 6a4 4 0 0 0-1.334-2.982A3.98 3.98 0 0 0 8 2a3.98 3.98 0 0 0-2.667 1.018A4 4 0 0 0 4 6z" />
                </svg>
                <span class="icons">Espécies</span>
            </a>
        </div>
        <div class="nav-pagina">
            <a href="../atropelamentos/atropelamentos.php">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-car-front" viewBox="0 0 16 16">
                    <path
                        d="M4 9a1 1 0 1 1-2 0 1 1 0 0 1 2 0m10 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0M6 8a1 1 0 0 0 0 2h4a1 1 0 1 0 0-2zM4.862 4.276 3.906 6.19a.51.51 0 0 0 .497.731c.91-.073 2.35-.17 3.597-.17s2.688.097 3.597.17a.51.51 0 0 0 .497-.731l-.956-1.913A.5.5 0 0 0 10.691 4H5.309a.5.5 0 0 0-.447.276" />
                    <path
                        d="M2.52 3.515A2.5 2.5 0 0 1 4.82 2h6.362c1 0 1.904.596 2.298 1.515l.792 1.848c.075.175.21.319.38.404.5.25.855.715.965 1.262l.335 1.679q.05.242.049.49v.413c0 .814-.39 1.543-1 1.997V13.5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-1.338c-1.292.048-2.745.088-4 .088s-2.708-.04-4-.088V13.5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-1.892c-.61-.454-1-1.183-1-1.997v-.413a2.5 2.5 0 0 1 .049-.49l.335-1.68c.11-.546.465-1.012.964-1.261a.8.8 0 0 0 .381-.404l.792-1.848ZM4.82 3a1.5 1.5 0 0 0-1.379.91l-.792 1.847a1.8 1.8 0 0 1-.853.904.8.8 0 0 0-.43.564L1.03 8.904a1.5 1.5 0 0 0-.03.294v.413c0 .796.62 1.448 1.408 1.484 1.555.07 3.786.155 5.592.155s4.037-.084 5.592-.155A1.48 1.48 0 0 0 15 9.611v-.413q0-.148-.03-.294l-.335-1.68a.8.8 0 0 0-.43-.563 1.8 1.8 0 0 1-.853-.904l-.792-1.848A1.5 1.5 0 0 0 11.18 3z" />
                </svg>
                <span class="icons">Atropelamentos</span>
            </a>
        </div>
        <div class="nav-pagina">
            <a href="../mapa.php">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-map"
                    viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                        d="M15.817.113A.5.5 0 0 1 16 .5v14a.5.5 0 0 1-.402.49l-5 1a.5.5 0 0 1-.196 0L5.5 15.01l-4.902.98A.5.5 0 0 1 0 15.5v-14a.5.5 0 0 1 .402-.49l5-1a.5.5 0 0 1 .196 0L10.5.99l4.902-.98a.5.5 0 0 1 .415.103M10 1.91l-4-.8v12.98l4 .8zm1 12.98 4-.8V1.11l-4 .8zm-6-.8V1.11l-4 .8v12.98z" />
                </svg>
                <span class="icons">Mapa</span>
            </a>
        </div>
        <div class="nav-pagina">
            <a href="../cadastro.php">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person"
                    viewBox="0 0 16 16">
                    <path
                        d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z" />
                </svg>
                <span class="icons">Cadastro</span>
            </a>
        </div>
    </nav>
    <main>
        <h1>Fauna</h1>
        <div class="filtro">
            <form action="fauna.php" method="post">
                <select name="clas" id="clas">
                    <option value="mamifero">Mamíferos</option>
                    <option value="anfibio">Anfíbios</option>
                    <option value="reptil">Répteis</option>
                    <option value="ave">Aves</option>
                    <option value="peixe">Peixes</option>
                    <option value="inseto">Insetos</option>
                    <option value="outro_fa">Outros</option>
                </select>
                <input type="submit" value="Filtrar">
            </form>
        </div>
        <?php
            while ($linha = mysqli_fetch_array($tabela, MYSQLI_ASSOC)) {
                if (!isset($_POST["nid"])) {
                    if ($linha['tipo'] == 'fauna') {
        ?>
                <div class="post" style="background-color: #325D2F; padding: 1rem; color: #F0F7DA; margin-bottom: 1rem;">
                    <img src="<?php echo "../../images/".$linha["foto"];?>">
                    <div>
                        <p class="esp"><?php echo $linha["especie"];?></p>
                        <p><?php echo $linha["familia"];?></p>
                        <p><?php echo $linha["classe"];?></p>
                        <p><?php echo $linha["classificacao"];?></p>
                        <a href="enc_especies.php?esp='<?php echo $linha['especie'];?>'" style="color: #F0F7DA;">Ver todas as ocorrências</a>
                    </div>
                </div>
        <?php
                    }
                }
            }
        ?>
    </main>
    <?php 
        if (isset($_SESSION["validado"]) && $_SESSION["validado"] == true) echo
        "<a href='../../crud.php?acao=P&post=especie'>
        <svg xmlns='http://www.w3.org/2000/svg' fill='currentColor' class='bi bi-plus-circle-fill' viewBox='0 0 16 16' style='border: 3px solid     #F0F7DA; border-radius: 100px; background-color: #F0F7DA; width: 3rem; height: 3rem; color: #325D2F; position: fixed; right: 1rem;  bottom: 1rem;'>
            <path d='M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3z'/>
        </svg>
        </a>";
    ?>
</body>
</html>
<?php
    mysqli_close($conexao);
?>