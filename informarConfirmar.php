<?php
    $conexao = mysqli_connect("localhost", "root", "Fukuoka23.","ayuru") or die ("Falha na conexão");

    $id = $_GET["id"];
    $post = $_GET["post"];

    $especie = $_POST["especie"];
    $tipo = $_POST["tipo"];
    $classificacao = $_POST["classificacao"];

    mysqli_query($conexao, "INSERT INTO sugestoes
                            (post, id, especie)
                            VALUES
                            ('$post', '$id', '$especie')");
    
    $ocorrencias = mysqli_query($conexao, "SELECT * FROM sugestoes WHERE post='$post' AND id='$id' AND especie='$especie'");
    $qtde_linhas = mysqli_num_rows($ocorrencias);

    if ($qtde_linhas > 5) {
        if ($post = "especie") {
            $tabela = mysqli_query($conexao, "SELECT * FROM enc_especies WHERE id_enc = $id");
            $linha = mysqli_fetch_array($tabela);
            $foto = $linha["foto"];

            $sql1 = "UPDATE enc_especies SET 
                    especie = '$especie'
                    WHERE id_enc = '$id'";
            $query1 = mysqli_query($conexao, $sql1);
            
            $oc = mysqli_query($conexao, "SELECT * FROM especies WHERE especie = '$especie'");
            $linhas = mysqli_num_rows($oc);

            if ($linhas == 0) {
                $sql2 = "INSERT INTO especies
                        (especie, familia, classe, tipo, foto, classificacao)
                        VALUES
                        ('$especie', 'Não identificado', 'Não identificado', '$tipo', '$foto', '$classificacao')";
                $query2 = mysqli_query($conexao, $sql2);
            }
        } else {
            $sql = "UPDATE atropelamentos SET 
                    especie = '$especie'
                    WHERE id_at = '$id'";  
            $query = mysqli_query($conexao, $sql);
        }
    }

    mysqli_close($conexao);
    header("Location: pages/inicio.html");
    exit();
?>