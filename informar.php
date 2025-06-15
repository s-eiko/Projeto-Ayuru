<?php
    $conexao = mysqli_connect("localhost", "root", "Fukuoka23.","ayuru") or die ("Falha na conexão");

    $id = $_GET["id"];
    $post = $_GET["post"];

    if ($post == "especie") {
        $tabela = mysqli_query($conexao, "SELECT * FROM enc_especies WHERE id_enc = $id");
        $linha = mysqli_fetch_array($tabela);
        $foto = $linha["foto"];
    } else {
        $tabela = mysqli_query($conexao, "SELECT * FROM atropelamentos WHERE id_at = $id");
        $linha = mysqli_fetch_array($tabela);
        $foto = $linha["foto"];
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Informar espécie</title>
</head>
<body>
    <nav>
        <div class="nav-pagina">
            <a href="<?php if ($post == 'especie') echo 'pages/especies/especies.html'; else echo 'pages/atropelamentos/atropelamentos.php'?>">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8"/>
                </svg>
            </a>
        </div>
    </nav>
    <main>
        <h1>Informar espécie</h1>
        <p>Você reconhece a espécie a seguir? Digite o nome no campo disponível abaixo</p>
        <img src="images/<?php echo $foto?>" style="display: block; margin: auto; width: 100%;">
        <form action="informarConfirmar.php?post=<?php echo $post?>&id=<?php echo $id?>" method="post" style="display: flex; flex-direction: column; gap: 1rem; padding: 3rem;">
            <tr>
                <td><input type="text" name="especie" id="especie" maxlength="200" placeholder="Digite o nome da espécie" required/></td>
            </tr>
            <tr>
                <td><label for="tipo">Fauna ou Flora: </label></td>
                <select name="tipo" id="tipo" required>
                    <option value="fauna">Fauna</option>
                    <option value="flora">Flora</option>
                </select>
            </tr>
            <tr>
                <td><label for="classificacao">Classificação: </label></td>
                <select name="classificacao" id="classificacao">
                </select>
            </tr>
            <tr>
                <td><input type="submit" value="Informar" style="padding: 10px 24px; width: 100%;"></td>
            </tr>
        </form>
    </main>
</body>
</html>
<script>
    var tipo = document.getElementById("tipo");
    var classificacao = document.getElementById("classificacao");

    tipo.addEventListener('click', function() {
        if (tipo.value == "fauna") {
            classificacao.innerHTML = `
                <option value='mamifero'>Mamífero</option>
                <option value='anfibio'>Anfíbio</option>
                <option value='reptil'>Réptil</option>
                <option value='ave'>Ave</option>
                <option value='peixe'>Peixe</option>
                <option value='inseto'>Inseto</option>
                <option value='outro_fa'>Outro</option>
            `;
        } else {
            classificacao.innerHTML = `
                <option value='arvore'>Árvore</option>
                <option value='arbusto'>Arbusto</option>
                <option value='rasteira'>Rasteira</option>
                <option value='outro_fl'>Outro</option>
            `
        }
    });
</script>