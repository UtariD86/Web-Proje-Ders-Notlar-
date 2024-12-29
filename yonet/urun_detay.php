  <?php
  include "ust.php";

  if (!isset($_GET['id'])) {
    $_GET['id'] = 0;
    $satir = array(
      'urun_id' => 0,
      'urun_kategori_id' => '',
      'urun_barkod' => '',
      'urun_adi' => '',
      'urun_fiyat' => '',
      'urun_indirim' => '',
      'urun_marka' => '',
      'urun_aciklama' => ''
    );
  } else {
    $sorgu = $db->prepare('SELECT * FROM urun WHERE urun_id=?');
    $sorgu->execute(array($_GET['id']));
    $satir = $sorgu->fetch(PDO::FETCH_ASSOC);
  }
  ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <div class="content pt-2">
      <div class="container-fluid">
        <div class="card card-primary card-outline">
          <div class="card-header">
            <h5 class="m-0">
              <i class="fas fa-cubes mr-2"></i>
              <?php echo ($satir['urun_id'] > 0 ? $satir['urun_adi'] : 'Yeni Ürün Ekle') ?>
            </h5>
          </div>
          <div class="card-body">

            <div class="card card-primary card-outline card-outline-tabs">
              <div class="card-header p-0 border-bottom-0">
                <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="custom-tabs-four-home-tab" data-toggle="pill" href="#custom-tabs-four-home" role="tab" aria-controls="custom-tabs-four-home" aria-selected="true">Genel Bilgiler</a>
                  </li>
                  <?php if ($satir['urun_id'] > 0) { ?>
                    <li class="nav-item">
                      <a class="nav-link" id="custom-tabs-four-profile-tab" data-toggle="pill" href="#custom-tabs-four-profile" role="tab" aria-controls="custom-tabs-four-profile" aria-selected="false">Stok Bilgileri</a>
                    </li>
                  <?php } ?>
                </ul>
              </div>
              <div class="card-body">
                <div class="tab-content" id="custom-tabs-four-tabContent">
                  <div class="tab-pane fade show active" id="custom-tabs-four-home" role="tabpanel" aria-labelledby="custom-tabs-four-home-tab">

                    <form action="urun_kaydet.php" method="POST">

                      <input type="hidden" name="urun_id" value="<?php echo $satir['urun_id'] ?>">

                      <div class="form-group row">
                        <label for="urun_kategori_id" class="col-sm-2 col-form-label">Kategori ID</label>
                        <div class="col-sm-10">
                          <select class="form-control" id="urun_kategori_id" name="urun_kategori_id">

                            <?php
                            function KategoriListesiOlustur($UstID = 0, $ayrac = '> ')
                            {
                              global $db, $VarolanKategoriID;
                              $sorgu = $db->prepare('SELECT * FROM urun_kategori WHERE kategori_ust_id=? ORDER BY kategori_sira');
                              $sorgu->execute(array($UstID));

                              while ($satir = $sorgu->fetch(PDO::FETCH_ASSOC)) {
                                echo $ayrac . $satir['kategori_adi'] .
                                  '<option value="' . $satir['kategori_id'] . '" ' .
                                  ($VarolanKategoriID == $satir['kategori_id'] ? 'selected' : '') . '>' .
                                  $ayrac . $satir['kategori_adi'] . '</option>';

                                KategoriListesiOlustur($satir['kategori_id'], '---' . $ayrac);
                              }
                            }
                            $VarolanKategoriID = $satir['urun_kategori_id'];
                            KategoriListesiOlustur();
                            ?>
                          </select>
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="urun_barkod" class="col-sm-2 col-form-label">Barkod</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="urun_barkod" name="urun_barkod" value="<?php echo $satir['urun_barkod'] ?>">
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="urun_adi" class="col-sm-2 col-form-label">Ürün Adı</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="urun_adi" name="urun_adi" value="<?php echo $satir['urun_adi'] ?>">
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="urun_fiyat" class="col-sm-2 col-form-label">Fiyatı</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="urun_fiyat" name="urun_fiyat" value="<?php echo $satir['urun_fiyat'] ?>">
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="urun_indirim" class="col-sm-2 col-form-label">İndirim (%)</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="urun_indirim" name="urun_indirim" value="<?php echo $satir['urun_indirim'] ?>">
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="urun_marka" class="col-sm-2 col-form-label">Marka</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="urun_marka" name="urun_marka" value="<?php echo $satir['urun_marka'] ?>">
                        </div>
                      </div>

                      <?php
                      if ($satir['urun_id'] > 0) {
                      ?>
                        <div class="form-group row">
                          <label for="urun_gorulmesayisi" class="col-sm-2 col-form-label">Görülme Sayısı</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" disabled id="urun_gorulmesayisi" value="<?php echo $satir['urun_gorulmesayisi'] ?>">
                          </div>
                        </div>

                        <div class="form-group row">
                          <label for="urun_eklemetarihi" class="col-sm-2 col-form-label">Ekleme Tarihi</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" disabled id="urun_eklemetarihi" value="<?php echo $satir['urun_eklemetarihi'] ?>">
                          </div>
                        </div>
                      <?php
                      }
                      ?>

                      <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
                      <div class="form-group row">
                        <label for="urun_aciklama" class="col-sm-2 col-form-label">Açıklama</label>
                        <div class="col-sm-12">
                          <textarea class="form-control" rows="15" id="urun_aciklama" name="urun_aciklama"><?php echo $satir['urun_aciklama'] ?></textarea>
                        </div>
                      </div>

                      <input type="submit" class="btn btn-outline-primary btn-block" value="Kaydet">
                    </form>

                  </div>
                  <?php if ($satir['urun_id'] > 0) { ?>
                    <div class="tab-pane fade" id="custom-tabs-four-profile" role="tabpanel" aria-labelledby="custom-tabs-four-profile-tab">

                      <table class="table">
                        <tr>
                          <th>#</th>
                          <th>Renk</th>
                          <th>Beden</th>
                          <th>Adet</th>
                          <th></th>
                        </tr>
                        <?php
                        $stoks = $db->prepare('SELECT * FROM urun_stok WHERE urun_id=? OR urun_id=0 ORDER BY stok_id DESC');
                        $stoks->execute(array($satir['urun_id']));
                        $sira = 0;
                        while ($stok = $stoks->fetch(PDO::FETCH_ASSOC)) {
                          //print_r($stok);
                        ?>
                          <tr>
                            <td><?php echo ++$sira ?></td>
                            <td><input type="text" id="stok_renk_<?php echo $stok['stok_id'] ?>" value="<?php echo $stok['stok_renk'] ?>"></td>
                            <td><input type="text" id="stok_beden_<?php echo $stok['stok_id'] ?>" value="<?php echo $stok['stok_beden'] ?>"></td>
                            <td><input type="text" id="stok_adet_<?php echo $stok['stok_id'] ?>" value="<?php echo $stok['stok_adet'] ?>"></td>
                            <td>
                              <button type="button" id="stok_btn_<?php echo $stok['stok_id'] ?>" onclick="StokKaydet(<?php echo $stok['stok_id'] ?>)" class="btn btn-block btn-outline-primary btn-sm">
                                <i class="fas fa-save"></i> Kaydet
                              </button>
                              <span id="StokKaydetSonuc_<?php echo $stok['stok_id'] ?>"></span>
                            </td>
                          </tr>
                        <?php
                        }
                        ?>
                      </table>
                      <script>
                        function StokKaydet(stok_id) {
                          var stok_renk = $('#stok_renk_' + stok_id).val();
                          var stok_beden = $('#stok_beden_' + stok_id).val();
                          var stok_adet = $('#stok_adet_' + stok_id).val();
                          console.log('stok_renk:' + stok_renk);
                          console.log('stok_beden:' + stok_beden);
                          console.log('stok_adet:' + stok_adet);
                          console.log(stok_id);

                          $('#stok_btn_' + stok_id).removeClass("btn-outline-primary");
                          $('#stok_btn_' + stok_id).removeClass("btn-success");
                          $('#stok_btn_' + stok_id).removeClass("btn-danger");

                          $.ajax({
                              method: "POST",
                              url: "urun_stok_kaydet.php",
                              data: {
                                stok_id: stok_id,
                                urun_id: <?php echo $satir['urun_id'] ?>,
                                stok_renk: stok_renk,
                                stok_beden: stok_beden,
                                stok_adet: stok_adet
                              }
                            })
                            .done(function(msg) {
                              //alert("Data Saved: " + msg);
                              if (msg == 'true')
                                $('#stok_btn_' + stok_id).addClass("btn-success");
                              else
                                $('#stok_btn_' + stok_id).addClass("btn-danger");
                            });

                        }
                      </script>
                    </div>
                  <?php } ?>
                </div>
              </div>
              <!-- /.card -->
            </div>

          </div>
        </div>
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <?php
  include "alt.php";
  ?>