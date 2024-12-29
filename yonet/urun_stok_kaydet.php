<?php
include "baglan.php";

if (isset($_POST['urun_id'], $_POST['stok_id'], $_POST['stok_renk'], $_POST['stok_beden'], $_POST['stok_adet'])) {

    $sorgu = ' urun_stok SET 
    stok_renk=:stok_renk,
    stok_beden=:stok_beden,
    stok_adet=:stok_adet';

    $sorguArray = array(
        'stok_renk' => $_POST['stok_renk'],
        'stok_beden' => $_POST['stok_beden'],
        'stok_adet' => $_POST['stok_adet']
    );

    if ($_POST['stok_id'] > 0) {
        $sorgu = "UPDATE" . $sorgu . " WHERE stok_id=:stok_id";
        $sorguArray['stok_id'] = $_POST['stok_id'];
    } else {
        $sorgu = "INSERT INTO" . $sorgu . ",urun_id=:urun_id";
        $sorguArray['urun_id'] = $_POST['urun_id'];
    }
    $sorgu = $db->prepare($sorgu);
    $sonuc = $sorgu->execute($sorguArray);

    if ($_POST['stok_id'] == 0)
        $_POST['stok_id'] = $db->lastInsertId();
    if ($sonuc)
        echo "true";
    else
        echo "false";
} else
    echo "Yetkisiz erişim";
