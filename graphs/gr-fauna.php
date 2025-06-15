<?php
    header ("Content-type: image/jpeg");

    // ---- PEGANDO DADOS ----

    $conexao = mysqli_connect("localhost", "root", "Fukuoka23.","ayuru") or die ("Falha na conexão");

    $esp = mysqli_query($conexao, "SELECT * FROM especies WHERE tipo = 'fauna'");
    $esp_mam = array(); $esp_anf = array(); $esp_rep = array(); $esp_aves = array(); $esp_pei = array(); $esp_ins = array(); $esp_ou = array();
    while ($linha_esp = mysqli_fetch_array($esp, MYSQLI_ASSOC)) {
        if ($linha_esp["tipo"] == "fauna") {
            if ($linha_esp["classificacao"] == "mamifero") array_push($esp_mam, $linha_esp["especie"]);
            else if ($linha_esp["classificacao"] == "anfibio") array_push($esp_anf, $linha_esp["especie"]);
            else if ($linha_esp["classificacao"] == "reptil") array_push($esp_rep, $linha_esp["especie"]);
            else if ($linha_esp["classificacao"] == "ave") array_push($esp_aves, $linha_esp["especie"]);
            else if ($linha_esp["classificacao"] == "peixe") array_push($esp_pei, $linha_esp["especie"]);
            else if ($linha_esp["classificacao"] == "inseto") array_push($esp_ins, $linha_esp["especie"]);
            else array_push($esp_ou, $linha_esp["especie"]);
        }
        
    }

    $mamiferos = 0; $anfibios = 0; $repteis = 0; $aves = 0; $peixes = 0; $insetos = 0; $outros = 0;
    $enc = mysqli_query($conexao, "SELECT * FROM enc_especies");
    while ($linha_enc = mysqli_fetch_array($enc, MYSQLI_ASSOC)) {
        if (in_array($linha_enc["especie"], $esp_mam)) $mamiferos++;
        else if (in_array($linha_enc["especie"], $esp_anf)) $anfibios++;
        else if (in_array($linha_enc["especie"], $esp_rep)) $repteis++;
        else if (in_array($linha_enc["especie"], $esp_aves)) $aves++;
        else if (in_array($linha_enc["especie"], $esp_pei)) $peixes++;
        else if (in_array($linha_enc["especie"], $esp_ins)) $insetos++;
        else $outros++;
    }

    // ---- CONFIGURANDO GRAFICO ----

    $width = 500;
    $height = 500;
    $image = imagecreatetruecolor($width, $height);

    $fundo = imagecolorallocate($image, 240, 247, 218);
    imagefill($image, 0, 0, $fundo);

    $colors = [
        imagecolorallocate($image, 249, 65, 68),
        imagecolorallocate($image, 243, 114, 44),
        imagecolorallocate($image, 248, 150, 30),
        imagecolorallocate($image, 249, 199, 79),
        imagecolorallocate($image, 144, 190, 109),
        imagecolorallocate($image, 67, 170, 139),
        imagecolorallocate($image, 87, 117, 144)
    ];

    $data = [$mamiferos, $anfibios, $repteis, $aves, $peixes, $insetos, $outros]; 

    $my_sum = array_sum($data);

    $start_angle = 0;
    $center_x = $width / 2;
    $center_y = $height / 2;
    $radius = 200;

    foreach ($data as $index => $value) {
        if ($value != 0) {
            $end_angle = $start_angle + ($value * 360 / $my_sum);

            imagefilledarc($image, $center_x, $center_y, 
                $radius * 2, $radius * 2, 
                $start_angle, $end_angle, $colors[$index], IMG_ARC_PIE);

            $start_angle = $end_angle;
        }
    }

    imagepng($image);
    imagedestroy($image);
?>