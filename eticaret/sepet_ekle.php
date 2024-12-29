<?php
include "../yonet/baglan.php";

//print_r($_POST);
if (isset($_POST['urun_id'], $_POST['beden'], $_POST['renk'], $_POST['miktar'])) {

    $sorgu = $db->prepare('SELECT stok_id FROM urun_stok 
        WHERE urun_id=? AND stok_renk=? AND stok_beden=? AND stok_adet>?');
    $sorgu->execute(array($_POST['urun_id'], $_POST['renk'], $_POST['beden'], $_POST['miktar']));
    //print_r($sorgu->errorInfo());

    if ($sorgu->rowCount() == 0) {
        echo "Yeterli Stok Yok";
        exit;
    }

    $stokID = $sorgu->fetch(PDO::FETCH_NUM)[0];

    //echo $stokID;

    $sorgu = $db->prepare('DELETE FROM sepet WHERE kullanici_id=? AND urun_id=? AND urun_stok_id=?');
    $sorgu->execute(array(1, $_POST['urun_id'], $stokID));

    $sorgu = $db->prepare('INSERT INTO sepet(kullanici_id,urun_id,urun_stok_id,sepet_miktar) 
    VALUES(?,?,?,?)');
    $sorgu->execute(array(1, $_POST['urun_id'], $stokID, $_POST['miktar']));

    $sorgu = $db->prepare('SELECT SUM(sepet_miktar) FROM sepet WHERE kullanici_id=?');
    $sorgu->execute(array(1));

    echo $sorgu->fetch(PDO::FETCH_NUM)[0];
}
