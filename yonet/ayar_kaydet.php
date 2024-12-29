<?php
include "baglan.php";

echo "<pre>";
print_r($_POST);
echo "</pre>";

if (isset(
    $_POST['ayar_baslik'],
    $_POST['ayar_aciklama'],
    $_POST['ayar_anahtarkelime'],
    $_POST['ayar_facebook'],
    $_POST['ayar_x'],
    $_POST['ayar_instagram'],
    $_POST['ayar_youtube'],
    $_POST['ayar_msunucu'],
    $_POST['ayar_mport'],
    $_POST['ayar_madres'],
    $_POST['ayar_msifre']
)) {
    $SQL = "UPDATE ayar SET
ayar_baslik=:ayar_baslik,
ayar_aciklama=:ayar_aciklama,
ayar_anahtarkelime=:ayar_anahtarkelime,
ayar_facebook=:ayar_facebook,
ayar_x=:ayar_x,
ayar_instagram=:ayar_instagram,
ayar_youtube=:ayar_youtube,
ayar_msunucu=:ayar_msunucu,
ayar_mport=:ayar_mport,
ayar_madres=:ayar_madres";

    $SQL_array = array(
        'ayar_baslik' => $_POST['ayar_baslik'],
        'ayar_aciklama' => $_POST['ayar_aciklama'],
        'ayar_anahtarkelime' => $_POST['ayar_anahtarkelime'],
        'ayar_facebook' => $_POST['ayar_facebook'],
        'ayar_x' => $_POST['ayar_x'],
        'ayar_instagram' => $_POST['ayar_instagram'],
        'ayar_youtube' => $_POST['ayar_youtube'],
        'ayar_msunucu' => $_POST['ayar_msunucu'],
        'ayar_mport' => $_POST['ayar_mport'],
        'ayar_madres' => $_POST['ayar_madres']
    );

    if ($_POST['ayar_msifre'] != "") {
        $SQL .= ",ayar_msifre=:ayar_msifre";
        $SQL_array['ayar_msifre'] = $_POST['ayar_msifre'];
    }
    $SQL .= " WHERE ayar_id=1";

    $sorgu = $db->prepare($SQL);
    $sonuc = $sorgu->execute($SQL_array);

    //print_r($sorgu->errorInfo());
}
header("Location:ayar.php?sonuc=" . $sonuc);
