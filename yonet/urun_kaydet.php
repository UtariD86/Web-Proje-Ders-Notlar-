<?php
include "baglan.php";

if (isset(
    $_POST['urun_id'],
    $_POST['urun_kategori_id'],
    $_POST['urun_barkod'],
    $_POST['urun_adi'],
    $_POST['urun_fiyat'],
    $_POST['urun_indirim'],
    $_POST['urun_marka'],
    $_POST['urun_aciklama']
)) {
    //echo "Başarılı";
    $sorgu = ' urun SET 
    urun_kategori_id=:urun_kategori_id,
    urun_barkod=:urun_barkod,
    urun_adi=:urun_adi,
    urun_fiyat=:urun_fiyat,
    urun_indirim=:urun_indirim,
    urun_marka=:urun_marka,
    urun_aciklama=:urun_aciklama';

    $sorguArray = array(
        'urun_kategori_id' => $_POST['urun_kategori_id'],
        'urun_barkod' => $_POST['urun_barkod'],
        'urun_adi' => $_POST['urun_adi'],
        'urun_fiyat' => $_POST['urun_fiyat'],
        'urun_indirim' => $_POST['urun_indirim'],
        'urun_marka' => $_POST['urun_marka'],
        'urun_aciklama' => $_POST['urun_aciklama']
    );

    if ($_POST['urun_id'] > 0) {
        $sorgu = "UPDATE" . $sorgu . " WHERE urun_id=:urun_id";
        $sorguArray['urun_id'] = $_POST['urun_id'];
    } else {
        $sorgu = "INSERT INTO" . $sorgu;
    }
    $sorgu = $db->prepare($sorgu);
    $sonuc = $sorgu->execute($sorguArray);

    if ($_POST['urun_id'] == 0)
        $_POST['urun_id'] = $db->lastInsertId();

    //print_r($sorgu->errorInfo());
}
header("Location:urun_detay.php?id=" . $_POST['urun_id'] . "&sonuc=" . $sonuc);
/*else {
    echo "HATA";
}
echo "<pre>";
print_r($_POST);
echo "</pre>";
*/