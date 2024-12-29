<?php

include "../yonet/baglan.php";

if (isset($_POST['sepetID'], $_POST['miktar'])) {
    $sorgu = $db->prepare('UPDATE sepet SET sepet_miktar=? WHERE sepet_id=? AND kullanici_id=?');
    $sorgu->execute(array($_POST['miktar'], $_POST['sepetID'], 1));

    $sorgu = $db->prepare('SELECT sepet.sepet_miktar*urun.urun_fiyat*(100-urun.urun_indirim)/100
        FROM sepet LEFT JOIN urun ON urun.urun_id=sepet.urun_id WHERE sepet_id=? AND kullanici_id=?');
    $sorgu->execute(array($_POST['sepetID'], 1));

    echo $sorgu->fetch(PDO::FETCH_NUM)[0] . "*";

    $sorgu = $db->prepare('SELECT SUM(sepet.sepet_miktar*urun.urun_fiyat*(100-urun.urun_indirim)/100), 
    SUM(sepet_miktar)
    FROM sepet LEFT JOIN urun ON urun.urun_id=sepet.urun_id WHERE kullanici_id=?');
    $sorgu->execute(array(1));

    $satir = $sorgu->fetch(PDO::FETCH_NUM);
    echo $satir[0] . "*";
    echo $satir[1];
}
