<?php
include "baglan.php";

if (isset($_POST['stok_id'], $_POST['stok_renk'], $_POST['stok_beden'], $_POST['stok_adet'])) {
    echo "veriler geldi";
} else
    echo "Yetkisiz erişim";
