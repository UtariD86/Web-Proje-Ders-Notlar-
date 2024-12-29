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

            <form action="urun_kaydet.php" method="POST">

              <input type="hidden" name="urun_id" value="<?php echo $satir['urun_id'] ?>">

              <div class="form-group row">
                <label for="urun_kategori_id" class="col-sm-2 col-form-label">Kategori ID</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="urun_kategori_id" name="urun_kategori_id" value="<?php echo $satir['urun_kategori_id'] ?>">
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
        </div>
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <?php
  include "alt.php";
  ?>