<?php
header("Content-Type: application/json");
function msgWa(){
    require("config.php");
    $query =  mysqli_query($db, "SELECT * FROM trx_wa");
    $cek_pesan = mysqli_fetch_array($query);
    //$nomornya = $cek_pesan['nomor'];
    //$pesannya = $cek_pesan['pesan'];
    	$check_wa = mysqli_query($db, "SELECT * FROM trx_wa WHERE status = '0' ORDER BY id ASC LIMIT 10");
		$no = 1;
		while ($data_wa = mysqli_fetch_assoc($check_wa)) {
		    $idnya= $data_wa['id'];
		    $nomornya= $data_wa['nomor'];
		    $pesannya = $data_wa['pesan'];
		    $array[] = array('id' => "$idnya",'no' => "$nomornya",'msg' => "$pesannya");
		    $no++;
		}
    $arraylagi = array('status' => true,'data' => $array);
    return json_encode($arraylagi);
}

function updateWa($id){
    require("config.php");
    if (empty($id)){
        $msg = "id tidak ada";
    } else {
        $query =  mysqli_query($db, "UPDATE trx_wa SET status = '1' WHERE id = '$id'");
        if($query == TRUE){
            $msg = "success";
        } else {
            $msg = "failed";
        }
    }
    $arraylagi = array('status' => true,'data' => "$msg");
    return json_encode($arraylagi);
}

if ($_GET['status'] != null) {
    $post_status = $_GET['status'];
    $post_id = $_GET['id'];
    if ($post_status == 0) {
        print_r(msgWa());
    } else if ($post_status == 1 and $_GET['id'] != null) {
        print_r(updateWa($post_id));
    } else {
        $array = array('status' => false, 'msg' => "ada yang salah");
        print_r (json_encode($array));
    }
} else {
    $array = array('status' => false, 'msg' => "param salah");
    print_r (json_encode($array));
}