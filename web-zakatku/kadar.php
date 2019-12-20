<?php include 'header.php'; 
  $user = getSessionData('user');
  if (!isset($user)){
    header('location: index.php');
  }

  $koneksi = new Koneksi();
  $kadars = $koneksi->getKadar();
?>

    <!--main content start-->
    <section id="main-content">
      <section class="wrapper">
        <div class="row">
          <div class="col-lg-12">
            <h3 class="page-header"><i class="fa fa-table"></i> Table</h3>
            <ol class="breadcrumb">
              <li><i class="fa fa-home"></i><a href="index.php">Home</a></li>
              <li><i class="fa fa-table"></i>Kadar</li>
            </ol>
          </div>
        </div>
        <!-- page start-->
        <?php if(!empty($message)):?>
        <div class="row">
          <div class="alert alert-<?=$status?> fade in">
            <button data-dismiss="alert" class="close close-sm" type="button">
                <i class="fa fa-times"></i>
            </button>
            <?=$message?>
          </div>
        </div>
        <?php endif?>
        <div class="row">
          <div class="col-lg-12">
            <section class="panel">
              <header class="panel-heading">
                Tabel Kadar

                      <div class="btn-group pull-right">
                        <a href="kadar_tambah.php" class="btn btn-primary btn-sm" alt="Tambah Kadar"><span class="icon_plus_alt2"></span></a>
                      </div>
              </header>

              <table class="table table-striped table-advance table-hover">
                <tbody>
                  <tr>
                    <th><i class="fa fa-book"></i> Nama</th>
                    <th><i class="fa fa-money"></i> Harga</th>
                    <th><i class="fa fa-balance-scale"></i> Satuan</th>
                    <th><i class="icon_cogs"></i> Action</th>
                  </tr>
                  <?php if(isset($kadars) && count($kadars)>0):?>
                    <?php foreach ($kadars as $kadar) :?>
                    <tr>
                      <td><?=$kadar['nama_kadar']?></td>
                      <td><?=$kadar['harga']?></td>
                      <td><?=$kadar['satuan']?></td>
                      <td>
                        <div class="btn-group">
                          <a class="btn btn-info" href="kadar_edit.php?kode=<?=$kadar['kode_kadar']?>"><i class="fa fa-edit"></i></a>
                          <btn class="btn btn-danger" onclick="konfirmasi(<?=$kadar['kode_kadar']?>)"><i class="icon_close_alt2"></i></btn>
                        </div>
                      </td>
                    </tr>
                    <?php endforeach?>
                  <?php else: ?>
                    <tr>
                      <td colspan="3">Data Kosong</td>
                    </tr>
                  <?php endif ?>
                </tbody>
              </table>
            </section>
          </div>
        </div>
        <!-- page end-->
      </section>
    </section>
    <!--main content end-->


    <div aria-hidden="true" aria-labelledby="KonfirmasiHapus" role="dialog" tabindex="-1" id="KonfirmasiHapus" class="modal">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button class="close" type="button" onclick="closeModal()">×</button>
            <h4 class="modal-title">Konfirmasi Hapus</h4>
          </div>
          <div class="modal-body">
            <p>Anda yakin ingin menghapus data?</p>
          </div>
          <div class="modal-footer">
            <form action="kadar_hapus.php" method="post">
              <input type="hidden" name="kode_kadar" id="kode_kadar">
              <button type="submit" class="btn btn-danger">Hapus</button>
            </form>
          </div>

        </div>
      </div>
    </div>
<?php include 'footer.php' ?>
<script type="text/javascript">
  function konfirmasi(id){
    $('#kode_kadar').val(id);
    $('#KonfirmasiHapus').show();
  }

  function closeModal(){
    $('#KonfirmasiHapus').hide();
  }
</script>