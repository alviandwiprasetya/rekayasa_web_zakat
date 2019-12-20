<?php
	include('helper.php');
	include('koneksi.php');

	$kode = null;

	if (isset($_GET['kode'])){
		$kode = $_GET['kode'];
	}

	$koneksi = new Koneksi();
	$zakats = $koneksi->getZakatByKode($kode);

	echo json_encode($zakats);
?>