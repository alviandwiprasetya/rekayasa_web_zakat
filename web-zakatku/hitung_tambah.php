<?php include 'header.php'; 
  $user = getSessionData('user');
  if (!isset($user)){
    header('location: index.php');
  }
  $koneksi = new Koneksi();
  $zakats = $koneksi->getZakat();
?>

    <!--main content start-->
    <section id="main-content">
      <section class="wrapper">
        <div class="row">
          <div class="col-lg-12">
            <h3 class="page-header"><i class="fa fa-file-text-o"></i> Form Hitung</h3>
            <ol class="breadcrumb">
              <li><i class="fa fa-home"></i><a href="index.php">Home</a></li>
              <li><i class="icon_document_alt"></i><a href="hitung.php">Hitung</a></li>
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
                Tambah Hitung
              </header>
              <div class="panel-body">
                <form class="form-horizontal" action="hitung_tambah_simpan.php" method="post">
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