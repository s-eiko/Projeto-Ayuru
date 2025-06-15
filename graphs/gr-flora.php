<?php
    header ("Content-type: image/jpeg");

    $conexao = mysqli_connect("localhost", "root", "Fukuoka23.","ayuru") or die ("Falha na conexão");

    $esp = mysqli_query($conexao, "SELECT * FROM especies WHERE tipo = 'flora'");
    $esp_arv = array(); $esp_arb = array(); $esp_ras= array(); $esp_ou = array();
    while ($linha_esp = mysqli_fetch_array($esp, MYSQLI_ASSOC)) {
        if ($linha_esp["tipo"] == "fauna") {
            if ($linha_esp["classificacao"] == "arvore") array_push($esp_arv, $linha_esp["especie"]);
            else if ($linha_esp["classificacao"] == "arbusto") array_push($esp_arb, $linha_esp["especie"]);
            else if ($linha_esp["classificacao"] == "rasteira") array_push($esp_ras, $linha_esp["especie"]);
            else array_push($esp_ou, $linha_esp["especie"]);
        }
        
    }

    $arvores = 0; $arbustos = 0; $rasteiras = 0; $outros = 0;
    $enc = mysqli_query($conexao, "SELECT * FROM enc_especies");
    while ($linha_enc = mysqli_fetch_array($enc, MYSQLI_ASSOC)) {
        if (in_array($linha_enc["especie"], $esp_arv)) $arvores++;
        else if (in_array($linha_enc["especie"], $esp_arb)) $arbustos++;
        else if (in_array($linha_enc["especie"], $esp_ras)) $rasteiras++;
        else $outros++;
    }

    $width = 500;
    $height = 500;
    $image = imagecreatetruecolor($width, $height);

    $fundo = imagecolorallocate($image, 240, 247, 218);
    imagefill($image, 0, 0, $fundo);

    $colors = [
        imagecolorallocate($image, 249, 65, 68),
        imagecolorallocate($image, 243, 114, 44),
        imagecolorallocate($image, 248, 150, 30),
        imagecolorallocate($image, 249, 199, 79)
    ];

    $data = [$arvores, $arbustos, $rasteiras, $outros]; 

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