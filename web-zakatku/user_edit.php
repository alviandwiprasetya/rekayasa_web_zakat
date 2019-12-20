<?php include 'header.php'; 
  $user = getSessionData('user');
  if (!isset($user)){
    header('location: index.php');
  }
  $kode = null;
  if (isset($_GET['kode'])){
    $kode = $_GET['kode'];
  }
  $koneksi = new Koneksi();
  $user = $koneksi->getUserByKode($kode);
?>

    <!--main content start-->
    <section id="main-content">
      <section class="wrapper">
        <div class="row">
          <div class="col-lg-12">
            <h3 class="page-header"><i class="fa fa-file-text-o"></i> Form User</h3>
            <ol class="breadcrumb">
              <li><i class="fa fa-home"></i><a href="index.php">Home</a></li>
              <li><i class="icon_document_alt"></i><a href="user.php">User</a></li>
              <li><i class="fa fa-file-text-o"></i>Edit</li>
            </ol>
          </div>
        </div>
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
                Edit User
              </header>
              <div class="panel-body">
                <form class="form-horizontal" action="user_edit_simpan.php" method="post">
                  <div class="form-group">
                    <label class="col-sm-2 control-label">Jenis User</label>
                    <div class="col-sm-10">
                      <select class="form-control" name="jenis_user" required>
                        <option value="">[Pilih Jenis User]</option>
                        <option value="user" <?=$user['jenis_user']=='user'?'selected':''?>>User</option>
                        <option value="admin" <?=$user['jenis_user']=='admin'?'selected':''?>>Admin</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label">Nama</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" placeholder="Nama Lengkap" name="nama" value="<?=$user['nama']?>" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label">Email</label>
                    <div class="col-sm-10">
                      <input type="email" class="form-control" placeholder="Email" name="email" value="<?=$user['email']?>" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label">Pekerjaan</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" placeholder="Pekerjaan" name="pekerjaan" value="<?=$user['pekerjaan']?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label">Alamat</label>
                    <div class="col-sm-10">
                      <textarea class="form-control" placeholder="Alamat Lengkap" name="alamat"><?=$user['alamat']?></textarea>
                    </div>
                  </div>
                  <input type="hidden" name="kode" value="<?=$user['kode_user']?>">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </form>
              </div>
            </section>
          </div>
        </div>
        <!-- Basic Forms & Horizontal Forms-->
      </section>
    </section>
    <!--main content end-->
<?php include 'footer.php'?>