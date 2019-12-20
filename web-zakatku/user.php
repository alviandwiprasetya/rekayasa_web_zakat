<?php include 'header.php'; 
  $user = getSessionData('user');
  if (!isset($user)){
    header('location: index.php');
  }

  $koneksi = new Koneksi();
  $users = $koneksi->getUser();
?>

    <!--main content start-->
    <section id="main-content">
      <section class="wrapper">
        <div class="row">
          <div class="col-lg-12">
            <h3 class="page-header"><i class="fa fa-table"></i> Table</h3>
            <ol class="breadcrumb">
              <li><i class="fa fa-home"></i><a href="index.php">Home</a></li>
              <li><i class="fa fa-table"></i>User</li>
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
                Tabel User
                  <div class="btn-group pull-right">
                    <a href="user_tambah.php" class="btn btn-primary btn-sm" alt="Tambah User"><span class="icon_plus_alt2"></span></a>
                  </div>
              </header>

              <table class="table table-striped table-advance table-hover">
                <tbody>
                  <tr>
                    <th><i class="icon_profile"></i> Full Name</th>
                    <th><i class="fa fa-users"></i> Jenis User</th>
                    <th><i class="icon_mail_alt"></i> Email</th>
                    <th><i class="icon_pin_alt"></i> Alamat</th>
                    <th><i class="fa fa-user-md"></i> Pekerjaan</th>
                    <th><i class="icon_cogs"></i> Action</th>
                  </tr>
                  <?php if(isset($users) && count($users)>0):?>
                    <?php foreach ($users as $u) :?>
                    <tr>
                      <td><?=$u['nama']?></td>
                      <td><?=ucfirst($u['jenis_user'])?></td>
                      <td><?=$u['email']?></td>
                      <td><?=$u['alamat']?></td>
                      <td><?=$u['pekerjaan']?></td>
                      <td>
                        <div class="btn-group">
                          <a class="btn btn-info" href="user_edit.php?kode=<?=$u['kode_user']?>"><i class="fa fa-edit"></i></a>
                          <?php if($u['kode_user'] != $user['kode_user']):?>
                          <btn class="btn btn-danger" onclick="konfirmasi(<?=$u['kode_user']?>)"><i class="icon_close_alt2"></i></btn>
                        <?php endif ?>
                        </div>
                      </td>
                    </tr>
                    <?php endforeach?>
                  <?php else: ?>
                    <tr>
                      <td colspan="6">Data Kosong</td>
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
            <form action="user_hapus.php" method="post">
              <input type="hidden" name="kode_user" id="kode_user">
              <button type="submit" class="btn btn-danger">Hapus</button>
            </form>
          </div>

        </div>
      </div>
    </div>
<?php include 'footer.php' ?>
<script type="text/javascript">
  function konfirmasi(id){
    $('#kode_user').val(id);
    $('#KonfirmasiHapus').show();
  }

  function closeModal(){
    $('#KonfirmasiHapus').hide();
  }
</script>