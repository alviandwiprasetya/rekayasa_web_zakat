<?php
	include('helper.php');
	include('koneksi.php');

	$kode = null;
	$kadar = [];

	if (isset($_POST['kode_kadar'])){
		$kadar['kode_kadar'] = $_POST['kode_kadar'];
	}

	$koneksi = new Koneksi();
	$cek = $koneksi->delete('kadar', $kadar);

	if ($cek) {
		setFlashData('status', 'success');
		setFlashData('message', 'Berhasil Menghapus Kadar');
		header('Location: kadar.php');
	} else {
		setFlashData('status', 'danger');
		setFlashData('message', 'Gagal Menghapus Kadar');
		header('Location: kadar.php');
	}