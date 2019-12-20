<?php include('header.php');
  $koneksi = new Koneksi();
  $zakats = $koneksi->getZakat(); ?>

    <!--main content start-->
    <section id="main-content">
      <section class="wrapper">
        <!--overview start-->
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
            <h3 class="page-header"><i class="fa fa-laptop"></i> Aplikasi Perhitungan Zakat Harta</h3>
            <ol class="breadcrumb">
              <li><i class="fa fa-home"></i><a href="index.php">Home</a></li>
            </ol>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
            <div class="info-box blue-bg">
              <i class="fa fa-cloud-download"></i>
              <div class="count">6.674</div>
              <div class="title">Download</div>
            </div>
            <!--/.info-box-->
          </div>
          <!--/.col-->

          <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
            <div class="info-box brown-bg">
              <i class="fa fa-shopping-cart"></i>
              <div class="count">7.538</div>
              <div class="title">Purchased</div>
            </div>
            <!--/.info-box-->
          </div>
          <!--/.col-->

          <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
            <div class="info-box dark-bg">
              <i class="fa fa-thumbs-o-up"></i>
              <div class="count">4.362</div>
              <div class="title">Order</div>
            </div>
            <!--/.info-box-->
          </div>
          <!--/.col-->

          <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
            <div class="info-box green-bg">
              <i class="fa fa-cubes"></i>
              <div class="count">1.426</div>
              <div class="title">Stock</div>
            </div>
            <!--/.info-box-->
          </div>
          <!--/.col-->

        </div>
        <!--/.row-->
        <div class="row">
          <div class="col-lg-12 col-md-12">
            <div class="panel panel-default">
              <div class="panel-heading">
                <h2><i class="fa fa-flag-o red"></i><strong>Zakat</strong></h2>
                <div class="panel-actions">
                  <a href="index.html#" class="btn-setting"><i class="fa fa-rotate-right"></i></a>
                  <a href="index.html#" class="btn-minimize"><i class="fa fa-chevron-up"></i></a>
                  <a href="index.html#" class="btn-close"><i class="fa fa-times"></i></a>
                </div>
              </div>
              <div class="panel-body">
                <table class="table bootstrap-datatable countries">
                  <thead>
                    <tr>
                      <th><i class="fa fa-book"></i> Nama Zakat</th>
                      <th><i class="fa fa-tasks"></i> Kadar</th>
                      <th><i class="fa fa-money"></i> Nishab</th>
                      <th><i class="fa fa-calendar-check-o"></i> Haul</th>
                      <th><i class="fa fa-percent"></i> Persentase Zakat</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php if(isset($zakats) && count($zakats)>0):?>
                    <?php foreach ($zakats as $zakat) :?>
                    <tr>
                      <td><?=$zakat['nama_zakat']?></td>
                      <td><?=$zakat['nama_kadar']?></td>
                      <td><?=$zakat['nishab']?> <?=$zakat['satuan']?></td>
                      <td><?=$zakat['haul']?></td>
                      <td><?=$zakat['persentase_zakat']?> %</td>
                    </tr>
                    <?php endforeach?>
                  <?php else: ?>
                    <tr>
                      <td colspan="5">Data Kosong</td>
                    </tr>
                  <?php endif ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <!-- statics end -->
        <?php if(empty($user) || (!empty($user) && $user['jenis_user']=='user')):?>
        <div class="row">
          <div class="col-lg-12">
            <section class="panel">
              <header class="panel-heading">
                Tambah Hitung
              </header>
              <div class="panel-body">
                <form class="form-horizontal" action="hitung_user_tambah_simpan.php" method="post">
                  <div class="form-group">
                    <label class="col-sm-2 control-label">Zakat</label>
                    <div class="col-sm-10">
                      <select class="form-control" name="kode_zakat" onchange="pilihZakat(this)" required>
                        <option value="">[Pilih Zakat]</option>
                        <?php if(isset($zakats) && count($zakats)>0):?>
                          <?php foreach($zakats as $zakat):?>
                          <option value="<?=$zakat['kode_zakat']?>"><?=$zakat['nama_zakat']?></option>
                          <?php endforeach?>
                        <?php endif?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label">Nama Kadar</label>
                    <div class="col-lg-10">
                      <p class="form-control-static" id="nama_kadar_static"></p>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label">Nishab</label>
                    <div class="col-lg-10">
                      <p class="form-control-static" id="nishab_static"></p>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label">Haul</label>
                    <div class="col-lg-10">
                      <p class="form-control-static" id="haul_static"></p>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label">Persentase Zakat</label>
                    <div class="col-lg-10">
                      <p class="form-control-static" id="persentase_zakat_static"></p>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label">Jumlah Harta</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" placeholder="Jumlah Harta" name="jumlah_harta" id="jumlah_harta" onkeyup="hitungZakat()" required>
                    </div>
                    <span class="col-sm-1" id="satuan_static" style="text-transform:capitalize;">Rp</span>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label">Jumlah Zakat</label>
                    <div class="col-lg-10">
                      <p class="form-control-static" id="jumlah_zakat_static">0</p>
                      <input type="hidden" name="jumlah_zakat" id="jumlah_zakat">
                      <input type="hidden" name="kode_user" id="kode_user" value="<?=$user['kode_user']?>">
                    </div>
                  </div>
                  <button type="submit" class="btn btn-primary">Submit</button>
                </form>
              </div>
            </section>
          </div>
        </div>
        <!-- Basic Forms & Horizontal Forms-->
        <?php else:?>

        <?php endif?>

      </section>
      <div class="text-right">
        <div class="credits">
          <!--
            All the links in the footer should remain intact.
            You can delete the links only if you purchased the pro version.
            Licensing information: https://bootstrapmade.com/license/
            Purchase the pro version form: https://bootstrapmade.com/buy/?theme=NiceAdmin
          -->
          Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
        </div>
      </div>
    </section>
    <!--main content end-->
<?php include('footer.php') ?>

<script type="text/javascript">
  var kadar = null;
  var zakat = null;
  function pilihZakat(select){
    console.log(select.value);
    var kode = select.value;
    $.get('get_zakat.php?kode='+kode, function( data ) {
      zakat = JSON.parse(data);
      console.log(data, zakat);

      if (zakat) {
        $('#nama_kadar_static').html(zakat.nama_kadar + ' ('+formatMoney(zakat.harga) + '/' + zakat.satuan+')');
        $('#nishab_static').html(zakat.nishab + ' ' + zakat.satuan + ' ('+formatMoney(zakat.nishab * zakat.harga)+')');
        $('#haul_static').html(zakat.haul + ' bulan');
        $('#persentase_zakat_static').html(zakat.persentase_zakat + ' %');
        $('#satuan_static').html(zakat.satuan);
      } else {
        $('#nama_kadar_static').html('');
        $('#nishab_static').html('');
        $('#haul_static').html('');
        $('#persentase_zakat_static').html('');
        $('#satuan_static').html('');
      }
      hitungZakat();
    });
  }

  function hitungZakat(){
    $('#jumlah_zakat_static').html('');
    $('#jumlah_zakat').val('');
    if (zakat) {
      var jumlah_harta = parseFloat($('#jumlah_harta').val());
      var satuan = zakat.satuan;
      // var jumlah_nishab = zakat.nishab * zakat.harga;
      var jumlah_nishab = zakat.nishab;
      var persentase_zakat = zakat.persentase_zakat;

      if (jumlah_harta >= jumlah_nishab){
        var jumlah_zakat = jumlah_harta * persentase_zakat / 100;
        if (satuan == 'rp'){
          $('#jumlah_zakat_static').html(capitalize(satuan)+' ' +formatMoney(jumlah_zakat));
        } else {
          $('#jumlah_zakat_static').html(formatMoney(jumlah_zakat) + ' '+satuan);
        }
        
        $('#jumlah_zakat').val(jumlah_zakat);
      } else {
        $('#jumlah_zakat_static').html('Belum Mencapai Nishab');
      }
      console.log(zakat, jumlah_harta, jumlah_nishab);
    }
  }

  function formatMoney(n, c, d, t) {
    var c = isNaN(c = Math.abs(c)) ? 2 : c,
      d = d == undefined ? "." : d,
      t = t == undefined ? "," : t,
      s = n < 0 ? "-" : "",
      i = String(parseInt(n = Math.abs(Number(n) || 0).toFixed(c))),
      j = (j = i.length) > 3 ? j % 3 : 0;

    return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
  };

  function capitalize(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
  }

</script>