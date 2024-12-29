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
            <h5 class="m-0"><i class="fas fa-list mr-2"></i>Ürün Listesi</h5>
          </div>
          <div class="card-body">

            <table id="example1" class="table table-striped">
              <thead>
                <tr>
                  <th>Kategori</th>
                  <th>Barkod</th>
                  <th>Ürün Adı</th>
                  <th>Fiyat</th>
                  <th>Marka</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $sorgu = $db->prepare('SELECT * FROM urun');
                $sorgu->execute();

                while ($satir = $sorgu->fetch(PDO::FETCH_ASSOC)) {
                  /*echo "<pre>";
              print_r($satir);
              echo "</pre>";*/
                ?>
                  <tr>
                    <td><?php echo $satir['urun_kategori_id'] ?></td>
                    <td><?php echo $satir['urun_barkod'] ?></td>
                    <td>
                      <a href="urun_detay.php?id=<?php echo $satir['urun_id'] ?>">
                        <?php echo $satir['urun_adi'] ?>
                      </a>
                    </td>
                    <td><?php echo $satir['urun_fiyat'] ?></td>
                    <td><?php echo $satir['urun_marka'] ?></td>
                  </tr>
                <?php
                }
                ?>
              </tbody>
            </table>
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