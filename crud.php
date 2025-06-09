<?php
    $conexao = mysqli_connect("localhost", "root", "Fukuoka23.", "ayuru") or die ("Falha na conexão");

    $acao = $_GET["acao"];
    $post = $_GET["post"];

    // crud.php?acao='P, A, E'&post='especie, atropelamento'

    if ($acao == "P") {
        if ($post == "especie") {
            $titulo = "Postar nova ocorrência de espécie";
            $tabela = mysqli_query($conexao, "SELECT * FROM enc_especies");
        } else if ($post == "atropelamento") {
            $titulo = "Postar nova ocorrência de atropelamento";
            $tabela = mysqli_query($conexao, "SELECT * FROM atropelamentos");
        }

        $qtde_linhas = mysqli_num_rows($tabela);
        $id = $qtde_linhas + 1;

        $botao = "Postar";
        $especie = "";
        $familia = "";
        $classe = "";
        $endereco = "";
        $latitude = "";
        $longitude = "";
        $descricao = "";
        $data = "";
        $hora = "";
        $foto = "";
        $classificacao = "";
        $tipo = "";
    } else {
        if ($acao == "A") {
            if ($post == "especie") {
                $titulo = "Alterar ocorrência de espécie";
            } else if ($post == "atropelamento") {
                $titulo = "Alterar ocorrência de atropelamento";
            }

            $botao = "Alterar";
        } else {
            if ($post == "especie") {
                $titulo = "Excluir ocorrência de espécie";
            } else if ($post == "atropelamento") {
                $titulo = "Excluir ocorrência de atropelamento";
            }

            $botao = "Excluir";
        }

        $id = $_GET["id"];

        if ($post == "especie") {
            $tabela_enc = mysqli_query($conexao, "SELECT * FROM enc_especies WHERE id_enc=$id");
            $linha_enc = mysqli_fetch_array($tabela_enc);

            $especie = $linha_enc['especie'];
            $tabela_esp = mysqli_query($conexao, "SELECT * FROM especies WHERE especie='$especie'");
            $linha_esp = mysqli_fetch_array($tabela_esp);

            $especie = $linha_enc["especie"];
            $familia = $linha_esp["familia"];
            $classe = $linha_esp["classe"];
            $endereco = $linha_enc["endereco"];
            $latitude = $linha_enc["latitude"];
            $longitude = $linha_enc["longitude"];
            $descricao = $linha_enc["descricao"];
            $data = $linha_enc["data"];
            $hora = $linha_enc["hora"];
            $foto = $linha_enc["foto"];
            $classificacao = $linha_esp["classificacao"];
            $tipo = $linha_esp["tipo"];
        } else {
            $tabela = mysqli_query($conexao, "SELECT * FROM atropelamentos WHERE id_at=$id");
            $linha = mysqli_fetch_array($tabela);

            $especie = $linha["especie"];
            $familia = $linha["familia"];
            $classe = $linha["classe"];
            $endereco = $linha["endereco"];
            $latitude = $linha["latitude"];
            $longitude = $linha["longitude"];
            $descricao = $linha["descricao"];
            $data = $linha["data"];
            $hora = $linha["hora"];
            $foto = $linha["foto"];
            $classificacao = $linha["classificacao"];
            $tipo = $linha["tipo"];
        }
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title><?php echo $botao?></title>
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
        <h1><?php echo $titulo?></h1>
        <form enctype="multipart/form-data" action="crudConfirmar.php?acao=<?php echo $acao; ?>&post=<?php echo $post?>&id=<?php echo $id; ?>" method="post" style="display: flex; flex-direction: column; gap: 1rem; padding: 3rem;">
            <tr >
                <td>Id: <?php echo $id;?></td>
            </tr>
            <tr>
                <td><label for="especie">Espécie: </label></td>
                <td><input type="text" name="especie" id="especie" maxlength="200" value="<?php echo $especie; ?>" <?php if ($acao == "E") echo "readonly"; ?> /></td>
                <td style="display: flex; flex-direction: row;"><div><input type="radio" id="ni_esp"><label>Não sei qual é a espécie</label></div></td>
            </tr>
            <tr>
                <td><label for="familia">Família: </label></td>
                <td><input type="text" name="familia" id="familia" maxlength="200" value="<?php echo $familia; ?>" <?php if ($acao == "E") echo "readonly"; ?> /></td>
                <td><div><input type="radio" id="ni_fam"><label>Não sei qual é a família</label></div></td>
            </tr>
            <tr>
                <td><label for="classe">Classe: </label></td>
                <td><input type="text" name="classe" id="classe" maxlength="200" value="<?php echo $classe; ?>" <?php if ($acao == "E") echo "readonly"; ?> /></td>
                <td><div><input type="radio" id="ni_clas"><label>Não sei qual é a classe</label></div></td>
            </tr>
            <tr>
                <td><label for="tipo">Fauna ou Flora: </label></td>
                <select name="tipo" id="tipo" required <?php if ($acao == "E") echo 'readonly';?>>
                    <option value="fauna" <?php if ($tipo == "fauna") echo 'selected';?>>Fauna</option>
                    <option value="flora" <?php if ($tipo == "flora") echo 'selected';?>>Flora</option>
                </select>
            </tr>
            <tr>
                <td><label for="classificacao">Classificação: </label></td>
                <select name="classificacao" id="classificacao" <?php if ($acao == "E") echo 'readonly';?>>
                </select>
            </tr>
            <tr>
                <td><label for="endereco">Endereço: </label></td>
                <td><input type="text" name="endereco" id="endereco" maxlength="200" value="<?php echo $endereco; ?>" <?php if ($acao == "E") echo "readonly"; ?> /></td>
                <td><div><input type="radio" id="np_end"><label>Não possui endereço formal</label></div></td>
            </tr>
            <tr>
                <td><label for="latitude">Latitude: </label></td>
                <td><input type="number" name="latitude" id="latitude" step="1" minlength="10" maxlength="12" required value="<?php echo $latitude; ?>" <?php if ($acao == "E") echo "readonly"; ?> /></td>
                <td><div><input type="radio" id="loc_lat"><label>Utilizar localização do dispositivo atual</label></div></td>
            </tr>
            <tr>
                <td><label for="longitude">Longitude: </label></td>
                <td><input type="number" name="longitude" id="longitude" step="1" minlength="10" maxlength="12" required value="<?php echo $longitude; ?>" <?php if ($acao == "E") echo "readonly"; ?> /></td>
                <td><div><input type="radio" id="loc_long"><label>Utilizar localização do dispositivo atual</label></div></td>
            </tr>
            <tr>
                <td><label for="descricao">Descrição: </label></td>
                <td><input type="text" name="descricao" id="descricao" maxlength="200" value="<?php echo $descricao; ?>" <?php if ($acao == "E") echo "readonly"; ?> /></td>
            </tr>
            <tr>
                <td><label for="data">Data: </label></td>
                <td><input type="date" name="data" id="data" required value="<?php echo $data; ?>" <?php if ($acao == "E") echo "readonly"; ?> /></td>
            </tr>
            <tr>
                <td><label for="hora">Horário: </label></td>
                <td><input type="time" name="hora" id="hora" required value="<?php echo $hora; ?>" <?php if ($acao == "E") echo "readonly"; ?> /></td>
            </tr>
            <tr>
                <td><label for="foto">Foto: (JPEG, JPG, PNG e WEBP)</label></td>
                <td><input enctype="multipart/form-data" type="file" name="foto" id="foto" required value="<?php echo "images/".$foto; ?>" <?php if ($acao == "E") echo "readonly"; ?> /></td>
            </tr>
            <tr>
                <td><input type="submit" value="<?php echo $botao; ?>" style="padding: 10px 24px; width: 100%;"></td>
            </tr>
        </form>
    </main>
</body>
</html>
<script>
    var ni_esp = document.getElementById("ni_esp");
    var especie = document.getElementById("especie");

    ni_esp.addEventListener('click', function() {
        especie.value = "Não identificado";  
    });

    var ni_fam = document.getElementById("ni_fam");
    var familia = document.getElementById("familia");

    ni_fam.addEventListener('click', function() {
        familia.value = "Não identificado";  
    });

    var ni_clas = document.getElementById("ni_clas");
    var classe = document.getElementById("classe");

    ni_clas.addEventListener('click', function() {
        classe.value = "Não identificado";  
    });

    var np_end = document.getElementById("np_end");
    var endereco = document.getElementById("endereco");

    var latitude = document.getElementById("latitude");
    var loc_lat = document.getElementById("loc_lat");

    loc_lat.addEventListener('click', function() {
        if (navigator.geolocation) {
               navigator.geolocation.getCurrentPosition(
                    function(position) {
                        latitude.value = position.coords.latitude;
                    },
                    function(error) {
                        console.error('Erro na obtenção da localização: ', error);
                        alert('Erro na obtenção da localização. Por favor, tente novamente.');
                    }
                );
            }
        }
    )

    var longitude = document.getElementById("longitude");
    var loc_long = document.getElementById("loc_long");

    loc_long.addEventListener('click', function() {
        if (navigator.geolocation) {
               navigator.geolocation.getCurrentPosition(
                    function(position) {
                        longitude.value = position.coords.longitude;
                    },
                    function(error) {
                        console.error('Erro na obtenção da localização: ', error);
                        alert('Erro na obtenção da localização. Por favor, tente novamente.');
                    }
                );
            }
        }
    )

    np_end.addEventListener('click', function() {
        endereco.value = "Não possui";  
    });

    var tipo = document.getElementById("tipo");
    var classificacao = document.getElementById("classificacao");

    tipo.addEventListener('click', function() {
        if (tipo.value == "fauna") {
            classificacao.innerHTML = `
                <option value='mamifero' <?php if ($classificacao == 'mamifero') echo 'selected';?>>Mamífero</option>
                <option value='anfibio' <?php if ($classificacao == 'anfibio') echo 'selected';?>>Anfíbio</option>
                <option value='reptil' <?php if ($classificacao == 'reptil') echo 'selected';?>>Réptil</option>
                <option value='ave' <?php if ($classificacao == 'ave') echo 'selected';?>>Ave</option>
                <option value='peixe' <?php if ($classificacao == 'peixe') echo 'selected';?>>Peixe</option>
                <option value='inseto' <?php if ($classificacao == 'inseto') echo 'selected';?>>Inseto</option>
                <option value='outro_fa' <?php if ($classificacao == 'outro_fa') echo 'selected';?>>Outro</option>
            `;
        } else {
            classificacao.innerHTML = `
                <option value='arvore' <?php if ($classificacao == 'arvore') echo 'selected';?>>Árvore</option>
                <option value='arbusto' <?php if ($classificacao == 'arbusto') echo 'selected';?>>Arbusto</option>
                <option value='rasteira' <?php if ($classificacao == 'rasteira') echo 'selected';?>>Rasteira</option>
                <option value='outro_fl' <?php if ($classificacao == 'outro_fl') echo 'selected';?>>Outro</option>
            `
        }
    });
</script>
