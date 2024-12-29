<?php
include "../yonet/baglan.php";
include "fonksiyon.php";

$ids = $_POST['KategoriID'];
function AltKategoriListGetir($KategoriID)
{
    global $db, $ids;
    $sorgu = $db->prepare('SELECT kategori_id FROM urun_kategori WHERE kategori_ust_id=?');
    $sorgu->execute(array($KategoriID));
    while ($satir = $sorgu->fetch(PDO::FETCH_NUM)) {
        $ids .= "," . $satir[0];
        AltKategoriListGetir($satir[0]);
    }
}

if (isset($_POST['KategoriID'])) {
    //echo $ids . "<br>";
    AltKategoriListGetir($_POST['KategoriID']);
    //echo $ids . "<br>";

    $sorgu = $db->prepare('SELECT * FROM urun WHERE urun_kategori_id IN (' . $ids . ') ORDER BY RAND() LIMIT 20');
    $sorgu->execute();

    while ($satir = $sorgu->fetch(PDO::FETCH_ASSOC)) {
        echo '<div class="col-lg-3 col-sm-6">';
        UrunListeKartiOlustur($satir);
        echo '</div>';
    }
}
