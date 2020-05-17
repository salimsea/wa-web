<?php 
require('config.php');
header("Content-Type: application/json");
$nomor = $_REQUEST['nomor'];
$pesan = $_REQUEST['pesan'];
$server = $_REQUEST['server'];

$trim_nomor = rtrim($nomor, ",");
$explode = explode(',',$trim_nomor);

$trim_pesan = rtrim($pesan, "|");
$explodeP = explode('|',$trim_pesan);
if (empty($nomor) || empty($pesan)){
    $msg = "Terjadi Kesalahan";
}else{
    foreach ($explode as $k=>$v){
        $post_nomor = $v;
        $cari = preg_match('/|/',$trim_pesan, $chek);
        if($cari == TRUE){
            $itung = count($explodeP);
            if($itung > 1){
                $post_pesan = $explodeP[$k];
            } else {
                $post_pesan = $explodeP[0];
            }
            
        }else {
                $post_pesan = $explodeP[0]."~0 ".$cari;
        }
        
        $sql = mysqli_query($db, "INSERT INTO trx_wa (nomor, pesan, status, server) VALUES ('$post_nomor','$post_pesan','0','$server')");
    
    }
    if($sql){
        $msg = "Sukses";
    } else {
        $msg = "Terjadi Kesalahan 2";
    }
    print_r($msg);
}