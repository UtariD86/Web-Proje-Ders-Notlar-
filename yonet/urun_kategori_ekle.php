  <?php
  include "ust.php";

  if (isset($_POST['kategori_adi'], $_POST['kategori_sira'])) {
    $sorgu = $db->prepare('INSERT INTO urun_kategori(kategori_ust_id,kategori_adi,kategori_sira)VALUES(?,?,?)');
    $sorgu->execute(array($_GET['ust_id'], $_POST['kategori_adi'], $_POST['kategori_sira']));

    header("Location:urun_kategori.php");
    exit;
  }
  ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <div class="content pt-2">
      <div class="container-fluid">
        <div class="card card-primary card-outline">
          <div class="card-header">
            <h5 class="m-0"><i class="fas fa-plus mr-2"></i>Kategori Ekle</h5>
          </div>
          <div class="card-body">

            <form method="POST">
              <div class="form-group row">
                <label for="kategori_adi" class="col-sm-2 col-form-label">Kategori Adı</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="kategori_adi" name="kategori_adi">
                </div>
              </div>

              <div class="form-group row">
                <label for="kategori_sira" class="col-sm-2 col-form-label">Kategori Sıra</label>
                <div class="col-sm-10">
                  <input type="number" class="form-control" id="kategori_sira" name="kategori_sira">
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