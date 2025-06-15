<?php
    session_start();

    $conexao = mysqli_connect("localhost", "root", "Fukuoka23.","ayuru") or die ("Falha na conexão");

    $usuario = $_SESSION["usuario"];

    $acao = $_GET["acao"];
    $post = $_GET["post"];
    $id = $_GET["id"];

    if ($acao == "E") {
        if ($post == "especie") {
            mysqli_query($conexao, "DELETE FROM enc_especies WHERE id_enc = $id");
            $especie = $_POST["especie"];
            $ocorrencias = mysqli_query($conexao, "SELECT * FROM enc_especies WHERE especie='$especie'");
            if (mysqli_num_rows($ocorrencias) == 0) {
                mysqli_query($conexao, "DELETE FROM especies WHERE especie='$especie'");
            }
        } else {
            mysqli_query($conexao, "DELETE FROM atropelamentos WHERE id_at = '$id'");
        }
        mysqli_close($conexao);
        header("Location: pages/inicio.html");
        exit();
    }

    $especie = $_POST["especie"];
    $familia = $_POST["familia"];
    $classe = $_POST["classe"];
    $endereco = $_POST["endereco"];
    $latitude = $_POST["latitude"];
    $longitude = $_POST["longitude"];
    $descricao = $_POST["descricao"];
    $data = $_POST["data"];
    $hora = $_POST["hora"];
    $tipo = $_POST["tipo"];

    if ($acao == "A") {
        if ($post == "especie") {
            $ocorrencias = mysqli_query($conexao, "SELECT * FROM enc_especies WHERE especie='$especie'");
            $qtde_linhas = mysqli_num_rows($ocorrencias);
            if ($qtde_linhas == 0) {
                $sql =  "UPDATE especies SET 
                    especie = '$especie',
                    familia = '$familia',
                    classe = '$classe',
                    tipo = '$tipo'
                    WHERE especie = '$especie'";
                    $query1 = mysqli_query($conexao, $sql);
            }
            $sql2 = "UPDATE enc_especies SET 
                    usuario = '$usuario',
                    especie = '$especie',
                    endereco = '$endereco',
                    latitude = '$latitude',
                    longitude = '$longitude',
                    descricao = '$descricao',
                    data = '$data',
                    hora = '$hora'
                    WHERE id_enc = $id";
            $query2 = mysqli_query($conexao, $sql2);
        } else {
            $sql = "UPDATE atropelamentos SET 
                    usuario = '$usuario',
                    especie = '$especie',
                    familia = '$familia',
                    classe = '$classe',
                    endereco = '$endereco',
                    latitude = '$latitude',
                    longitude = '$longitude',
                    descricao = '$descricao',
                    data = '$data',
                    hora = '$hora',
                    tipo = '$tipo'
                    WHERE id_at = '$id'";
            $query = mysqli_query($conexao, $sql);
        }
        mysqli_close($conexao);
        header("Location: pages/inicio.html");
        exit();
    }

    $classificacao = $_POST["classificacao"];

    $foto_nome = $_FILES["foto"]["name"];
    $ext = pathinfo($foto_nome, PATHINFO_EXTENSION);
    $ext_perm = array("jpg", "png", "jpeg", "webp");
    $nome_temp = $_FILES["foto"]["tmp_name"];
    $pasta_arq = "images/".$foto_nome;

    if (in_array($ext, $ext_perm)) {
        if (move_uploaded_file($nome_temp, $pasta_arq)) {
            if ($post == "especie") {
                $ocorrencias = mysqli_query($conexao, "SELECT * FROM enc_especies WHERE especie='$especie'");
                $qtde_linhas = mysqli_num_rows($ocorrencias);

                if ($especie != "Não identificado" && $qtde_linhas == 0) {
                    $sql =  "INSERT INTO especies
                        (especie, familia, classe, tipo, foto, classificacao)
                        VALUES
                        ('$especie', '$familia', '$classe', '$tipo', '$foto_nome', '$classificacao')";
                    $query1 = mysqli_query($conexao, $sql);
                }
                $sql2 = "INSERT INTO enc_especies
                        (id_enc, usuario, especie, endereco, latitude, longitude, descricao, data, hora, foto)
                        VALUES
                        ('$id', '$usuario', '$especie', '$endereco', '$latitude', '$longitude', '$descricao', '$data', '$hora', '$foto_nome')";
                $query2 = mysqli_query($conexao, $sql2);
            } else {
                $sql =  "INSERT INTO atropelamentos
                        (id_at, usuario, especie, familia, classe, endereco, latitude, longitude, descricao, data, hora, foto, classificacao, tipo)
                        VALUES
                        ('$id', '$usuario', '$especie', '$familia', '$classe', '$endereco', '$latitude', '$longitude', '$descricao', '$data', '$hora', '$foto_nome', '$classificacao', '$tipo')";
                $query = mysqli_query($conexao, $sql);
            }
        } else {
            echo "Erro ao carregar arquivo";
        }
            mysqli_close($conexao);
            header("Location: pages/inicio.html");
            exit();
    }
?>