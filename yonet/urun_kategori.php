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

            <a href="urun_kategori_ekle.php?ust_id=0"><i class="fas fa-plus"></i> Ana Kategori Ekle</a><br><br>
            <?php
            function KategoriListesiOlustur($UstID = 0, $ayrac = '> ')
            {
              global $db;
              $sorgu = $db->prepare('SELECT * FROM urun_kategori WHERE kategori_ust_id=? ORDER BY kategori_sira');
              $sorgu->execute(array($UstID));

              while ($satir = $sorgu->fetch(PDO::FETCH_ASSOC)) {
                echo $ayrac . $satir['kategori_adi'] .
                  '<a href="urun_kategori_ekle.php?ust_id=' . $satir['kategori_id'] . '">
                  <i class="fas fa-plus"></i></a><br>';

                KategoriListesiOlustur($satir['kategori_id'], '---' . $ayrac);
              }
            }

            KategoriListesiOlustur();
            ?>

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