<?php include 'header.php'; 
  $user = getSessionData('user');
  if (!isset($user)){
    header('location: index.php');
  }

  $koneksi = new Koneksi();
  $hitungs = $koneksi->getHitungByUser($user['kode_user']);
?>

    <!--main content start-->
    <section id="main-content">
      <section class="wrapper">
        <div class="row">
          <div class="col-lg-12">
            <h3 class="page-header"><i class="fa fa-table"></i> Table</h3>
            <ol class="breadcrumb">
              <li><i class="fa fa-home"></i><a href="index.php">Home</a></li>
              <li><i class="fa fa-table"></i>Hitung</li>
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
                Tabel Hitung
                <div class="btn-group pull-right">
                  <a href="hitung_user_cetak.php" class="btn btn-primary btn-sm" alt="Cetak Hitung"><span class="icon_printer"></span></a>
                </div>
              </header>

              <table class="table table-striped table-advance table-hover">
                <tbody>
                  <tr>
                    <th><i class="fa fa-book"></i> Nama Zakat</th>
                    <th><i class="fa fa-tasks"></i> Nama User</th>
                    <th><i class="fa fa-money"></i> Kadar</th>
                    <th><i class="fa fa-calendar-check-o"></i> Tanggal</th>
                    <th><i class="fa fa-money"></i> Jumlah Harta</th>
                    <th><i class="fa fa-percent"></i> Jumlah Zakat</th>
                    <th><i class="icon_cogs"></i> Action</th>
                  </tr>
                  <?php if(isset($hitungs) && count($hitungs)>0):?>
                    <?php foreach ($hitungs as $hitung) :?>
                    <tr>
                      <td><?=$hitung['nama_zakat']?></td>
                      <td><?=$hitung['nama_user']?></td>
                      <td><?=$hitung['nama_kadar']?></td>
                      <td><?=date('d M Y', strtotime($hitung['tanggal']))?></td>
                      <td><?=currencyFormat($hitung['jumlah_harta'])?></td>
                      <td><?=currencyFormat($hitung['jumlah_zakat'])?></td>
                      <td>
                        <div class="btn-group">
                          <a class="btn btn-info" href="hitung_user_cetak_detail.php?kode=<?=$hitung['kode_hitung']?>" alt="Cetak"><i class="icon_printer"></i></a>
                          <btn class="btn btn-danger" onclick="konfirmasi(<?=$hitung['kode_hitung']?>)"><i class="icon_close_alt2"></i></btn>
                        </div>
                      </td>
                    </tr>
                    <?php endforeach?>
                  <?php else: ?>
                    <tr>
                      <td colspan="7">Data Kosong</td>
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
            <form action="hitung_hapus.php" method="post">
              <input type="hidden" name="kode_hitung" id="kode_hitung">
              <button type="submit" class="btn btn-danger">Hapus</button>
            </form>
          </div>

        </div>
      </div>
    </div>
<?php include 'footer.php' ?>
<script type="text/javascript">
  function konfirmasi(id){
    $('#kode_hitung').val(id);
    $('#KonfirmasiHapus').show();
  }

  function closeModal(){
    $('#KonfirmasiHapus').hide();
  }
</script>