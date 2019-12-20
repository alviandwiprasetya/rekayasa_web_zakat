<?php
	include 'helper.php';
	include 'koneksi.php';

	$koneksi = new Koneksi();
	$hitung_list = null;
	$hitung = null;

	if (!empty($_GET['kode_user'])){
		$hitung_list = $koneksi->getHitungByUser($_GET['kode_user']);
	} else {
		$hitung_list = $koneksi->getHitung();
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
	<?php elseif(!empty($hitung_list)):?>
	<table class="table table-striped table-advance table-hover" border="1">
        <tbody>
          <tr>
            <th><i class="fa fa-calendar-check-o"></i> Tanggal</th>
            <th><i class="fa fa-book"></i> Nama Zakat</th>
            <th><i class="fa fa-tasks"></i> Nama User</th>
            <th><i class="fa fa-money"></i> Kadar</th>
            <th><i class="fa fa-money"></i> Jumlah Harta</th>
            <th><i class="fa fa-percent"></i> Jumlah Zakat</th>
          </tr>
          <?php if(isset($hitung_list) && count($hitung_list)>0):?>
            <?php foreach ($hitung_list as $hitung) :?>
            <tr>
              <td><?=date('d M Y', strtotime($hitung['tanggal']))?></td>
              <td><?=$hitung['nama_zakat']?></td>
              <td><?=$hitung['nama_user']?></td>
              <td><?=$hitung['nama_kadar']?></td>
              <td align="right"><?=currencyFormat($hitung['jumlah_harta'])?></td>
              <td align="right"><?=currencyFormat($hitung['jumlah_zakat'])?></td>
            </tr>
            <?php endforeach?>
          <?php else: ?>
            <tr>
              <td colspan="6">Data Kosong</td>
            </tr>
          <?php endif ?>
        </tbody>
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