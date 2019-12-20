<?php include 'header.php'; 
  $user = getSessionData('user');
  if (!isset($user)){
    header('location: index.php');
  }
?>

    <!--main content start-->
    <section id="main-content">
      <section class="wrapper">
        <div class="row">
          <div class="col-lg-12">
            <h3 class="page-header"><i class="fa fa-file-text-o"></i> Form Kadar</h3>
            <ol class="breadcrumb">
              <li><i class="fa fa-home"></i><a href="index.php">Home</a></li>
              <li><i class="icon_document_alt"></i><a href="kadar.php">Kadar</a></li>
              <li><i class="fa fa-file-text-o"></i>Tambah</li>
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
                Tambah Kadar
              </header>
              <div class="panel-body">
                <form class="form-horizontal" action="kadar_tambah_simpan.php" method="post">
                  <div class="form-group">
                    <label class="col-sm-2 control-label">Nama Kadar</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" placeholder="Nama Kadar" name="nama_kadar" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label">Harga</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" placeholder="Harga" name="harga" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label">Satuan</label>
                    <div class="col-sm-10">
                      <select class="form-control" placeholder="Cth: kg,gram,dll" name="satuan" required>
                        <option value="">[Pilih Satuan]</option>
                        <option value="gram">Gram</option>
                        <option value="kg">Kilogram</option>
                        <option value="liter">Liter</option>
                        <option value="rp">Rupiah</option>
                      </select>
                    </div>
                  </div>
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