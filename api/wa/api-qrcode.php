<?php
header("Access-Control-Allow-Origin: *");
function generateQR($text){
    $gambar_satu      = "https://chart.googleapis.com/chart?cht=qr&chld=H|1&chs=350x350&chl=".urlencode($text);
    //print_r($gambar_satu);
    //die();
    $gambar_dua       = ""; // gapake kosongin aja
    if(empty($gambar_dua)){
        $o_gambar_satu    = imagecreatefrompng($gambar_satu);
    } else {
        $o_gambar_satu    = imagecreatefrompng($gambar_satu);
        $o_gambar_dua     = imagecreatefrompng($gambar_dua);
        $o_gambar_duaX = imagesx($o_gambar_dua);
        $o_gambar_duaY = imagesy($o_gambar_dua);
        //melakukan merging $filedekode1, $filedekode2, koordinat kiri, koordinat atas, jarak geser kiri, jarak geser kanan, koordinat kanan, koordinat bawah, persen transparansi
        imagecopymerge( $o_gambar_satu, $o_gambar_dua, 50, 100, 0, 0, $o_gambar_duaX, $o_gambar_duaY, 70 );
    }
    
header('Content-type: image/png');
    imagepng($o_gambar_satu);
    imagedestroy($o_gambar_satu);
}
if ($_GET['key'] != null and $_GET['text'] != null) {
    $post_key = $_GET['key'];
    $post_text = $_GET['text'];
    if ($post_key == "tester") {
        echo '<img src="'.generateQR($post_text).'">';
    } else {
        $array_baru = array("salimseal" => array("status" => false, "message" => "Apikey Salah", "data" => null));
        print_r(json_encode($array_baru, JSON_PRETTY_PRINT) . "\n");
    }
} else {
    $array_baru = array("salimseal" => array("status" => false, "message" => "Parameter Salah", "data" => null));
    print_r(json_encode($array_baru, JSON_PRETTY_PRINT) . "\n");
}
?>