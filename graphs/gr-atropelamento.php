<?php
    header ("Content-type: image/jpeg");

    $conexao = mysqli_connect("localhost", "root", "Fukuoka23.","ayuru") or die ("Falha na conexão");
    $tabela = mysqli_query($conexao, "SELECT * FROM atropelamentos");

    $mamiferos = 0; $anfibios = 0; $repteis = 0; $aves = 0; $peixes = 0; $insetos = 0; $outros = 0;

    while ($linha = mysqli_fetch_array($tabela, MYSQLI_ASSOC)) {
        if ($linha["classificacao"]) $mamiferos++;
        else if ($linha["classificacao"]) $anfibios++;
        else if ($linha["classificacao"]) $repteis++;
        else if ($linha["classificacao"]) $aves++;
        else if ($linha["classificacao"]) $peixes++;
        else if ($linha["classificacao"]) $insetos++;
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