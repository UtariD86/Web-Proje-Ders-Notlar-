  <?php
  include "ust.php";
  ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <div class="content pt-2">
      <div class="container-fluid">
        <div class="card card-primary card-outline">
          <div class="card-header">
            <h5 class="m-0"><i class="fas fa-cogs mr-2"></i>Ayarlar</h5>
          </div>
          <div class="card-body">

            <form action="ayar_kaydet.php" method="POST">
              <div class="form-group row">
                <label for="ayar_baslik" class="col-sm-2 col-form-label">Başlık</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="ayar_baslik" name="ayar_baslik" value="<?php echo $ayar['ayar_baslik'] ?>" placeholder="Web sayfanızın başlığını giriniz">
                </div>
              </div>

              <div class="form-group row">
                <label for="ayar_aciklama" class="col-sm-2 col-form-label">Açıklama</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="ayar_aciklama" name="ayar_aciklama" value="<?php echo $ayar['ayar_aciklama'] ?>" placeholder="Web sayfanızı tanıtan birkaç cümle giriniz">
                </div>
              </div>

              <div class="form-group row">
                <label for="ayar_anahtarkelime" class="col-sm-2 col-form-label">Anahtar Kelimeler</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="ayar_anahtarkelime" name="ayar_anahtarkelime" value="<?php echo $ayar['ayar_anahtarkelime'] ?>" placeholder="Web sayfanızın anahtar kelimelerini giriniz">
                </div>
              </div>

              <div class="form-group row">
                <label for="ayar_facebook" class="col-sm-2 col-form-label">Facebook</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="ayar_facebook" name="ayar_facebook" value="<?php echo $ayar['ayar_facebook'] ?>" placeholder="Varsa facebook adresini giriniz">
                </div>
              </div>

              <div class="form-group row">
                <label for="ayar_x" class="col-sm-2 col-form-label">X</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="ayar_x" name="ayar_x" value="<?php echo $ayar['ayar_x'] ?>" placeholder="Varsa X adresinizi giriniz">
                </div>
              </div>

              <div class="form-group row">
                <label for="ayar_instagram" class="col-sm-2 col-form-label">Instagram</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="ayar_instagram" name="ayar_instagram" value="<?php echo $ayar['ayar_instagram'] ?>" placeholder="Varsa Instagram adresinizi giriniz">
                </div>
              </div>

              <div class="form-group row">
                <label for="ayar_youtube" class="col-sm-2 col-form-label">YouTube</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="ayar_youtube" name="ayar_youtube" value="<?php echo $ayar['ayar_youtube'] ?>" placeholder="Varsa YouTube adresinizi giriniz">
                </div>
              </div>

              <div class="form-group row">
                <label for="ayar_msunucu" class="col-sm-2 col-form-label">Mail Sunucusu</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="ayar_msunucu" name="ayar_msunucu" value="<?php echo $ayar['ayar_msunucu'] ?>" placeholder="Mail sunucu adresini giriniz">
                </div>
              </div>

              <div class="form-group row">
                <label for="ayar_mport" class="col-sm-2 col-form-label">Sunucu Portu</label>
                <div class="col-sm-10">
                  <input type="number" class="form-control" id="ayar_mport" name="ayar_mport" value="<?php echo $ayar['ayar_mport'] ?>" placeholder="Mail Sunucu Portunu giriniz">
                </div>
              </div>

              <div class="form-group row">
                <label for="ayar_madres" class="col-sm-2 col-form-label">Mail Adresi</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="ayar_madres" name="ayar_madres" value="<?php echo $ayar['ayar_madres'] ?>" placeholder="Mail adresinizi giriniz">
                </div>
              </div>

              <div class="form-group row">
                <label for="ayar_msifre" class="col-sm-2 col-form-label">Şifre</label>
                <div class="col-sm-10">
                  <input type="password" class="form-control" id="ayar_msifre" name="ayar_msifre" placeholder="Mail şifrenizi giriniz">
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