<?php
require('config.php');
$query_cek =  mysqli_query($db, "SELECT * FROM wa_web");
$cekin = mysqli_fetch_assoc($query_cek);
$code = $cekin['qrcode'];
print_r($code);
?>