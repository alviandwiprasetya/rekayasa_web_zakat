<?php
	include('helper.php');
	include('koneksi.php');

	$kode = null;

	if (isset($_GET['kode'])){
		$kode = $_GET['kode'];
	}

	$koneksi = new Koneksi();
	$kadars = $koneksi->getKadarByKode($kode);

	echo json_encode($kadars);
?>