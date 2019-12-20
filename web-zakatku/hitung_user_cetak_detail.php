<?php
	include 'helper.php';
	include 'koneksi.php';

	$koneksi = new Koneksi();
	$hitung_list = null;
	$hitung = null;

	if (!empty($_GET['kode'])){
		$hitung = $koneksi->getHitungByKode($_GET['kode']);
	} else {
		header('Location: index.php');
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Cetak Hitung Zakat</title>
  <link rel="shortcut icon" href="img/icon-zakat.png">

	<!-- Bootstrap CSS -->
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<!-- bootstrap theme -->
	<link href="css/bootstrap-theme.css" rel="stylesheet">
	<!--external css-->
	<!-- font icon -->
	<link href="css/font-awesome.min.css" rel="stylesheet" />
	<!-- Custom styles -->
	<link href="css/jquery-ui-1.10.4.min.css" rel="stylesheet">
</head>
<body style="padding: 0px 50px">
	<h1 class="text-center">Hasil Perhitungan Zakat</h1>
	<?php if(!empty($hitung)):?>
    <table border="0" width="60%" align="center" class="table table-bordered">
      <tr>
        <td width="20%">Tanggal</td>
        <td width="5%">:</td>
        <td><?=date('d M Y', strtotime($hitung['tanggal']))?></td>
      </tr>
      <tr>
        <td>Zakat</td>
        <td>:</td>
        <td><?=$hitung['nama_zakat']?></td>
      </tr>
      <?php if(!empty($hitung['nama_user'])):?>
      <tr>
        <td>Nama User</td>
        <td>:</td>
        <td><?=$hitung['nama_user']?></td>
      </tr>
      <?php endif?>
      <tr>
        <td>Kadar</td>
        <td>:</td>
        <td><?=$hitung['nama_kadar']?></td>
      </tr>
      <tr>
        <td>Jumlah Harta</td>
        <td>:</td>
        <td>
          <?php
            if ($hitung['satuan'] == 'rp'){
              echo ucfirst($hitung['satuan']) . ' ' . currencyFormat($hitung['jumlah_harta']);
            } else {
              echo $hitung['jumlah_harta'] . ' ' . ucfirst($hitung['satuan']);
            }
          ?>
        </td>
      </tr>
      <tr>
        <td>Jumlah Zakat</td>
        <td>:</td>
        <td>
          <?php
            if ($hitung['satuan'] == 'rp'){
              echo ucfirst($hitung['satuan']) . ' ' . currencyFormat($hitung['jumlah_zakat']);
            } else {
              echo $hitung['jumlah_zakat'] . ' ' . ucfirst($hitung['satuan']);
            }
          ?>
        </td>
      </tr>
    </table>
    <button class="fa fa-print" onclick="window.print();"> Cetak</button>
    
	<?php endif?>

	<!-- javascripts -->
  <script src="js/jquery.js"></script>
  <script src="js/jquery-ui-1.10.4.min.js"></script>
  <script src="js/jquery-1.8.3.min.js"></script>
  <!-- bootstrap -->
  <script src="js/bootstrap.min.js"></script>
  <!-- nice scroll -->
  <!-- charts scripts -->

</body>
</html>