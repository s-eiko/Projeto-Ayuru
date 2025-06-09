<?php
    session_start();

    $conexao = mysqli_connect("localhost", "root", "Fukuoka23.","ayuru") or die ("Falha na conexão");

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $usuario = $_POST["usuario"];
        $senha = $_POST["senha"];

        $sql = "SELECT *
                FROM usuarios
                WHERE usuario='$usuario' AND senha='$senha'";

        $tabela = mysqli_query($conexao, $sql);
        
        $qtde_linhas = mysqli_num_rows($tabela);

        if ($qtde_linhas == 0) {
            $_SESSION["validado"] = false;

            $resposta = "Usuário ou senha incorretos";
        } else {
            $_SESSION["validado"] = true;
            $linha = mysqli_fetch_array($tabela);
            $_SESSION["usuario"] = $linha["usuario"];
        }
    }
?>