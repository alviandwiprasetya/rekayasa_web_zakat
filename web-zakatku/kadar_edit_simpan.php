<?php
	include('helper.php');
	include('koneksi.php');

	$kode = null;
	$kadar = [];

	if (isset($_POST['kode'])){
		$kode = $_POST['kode'];
	}
	if (isset($_POST['nama_kadar'])){
		$kadar['nama_kadar'] = $_POST['nama_kadar'];
	}
	if (isset($_POST['harga'])){
		$kadar['harga'] = $_POST['harga'];
	}
	if (isset($_POST['satuan'])){
		$kadar['satuan'] = $_POST['satuan'];
	}

	$koneksi = new Koneksi();
	$cek = $koneksi->update('kadar', $kadar, $kode, 'kode_kadar');
	if ($cek) {
		setFlashData('status', 'success');
		setFlashData('message', 'Berhasil mengubah Kadar');
		header('Location: kadar.php');
	} else {
		setFlashData('status', 'danger');
		setFlashData('message', 'Gagal mengubag Kadar');
		header('Location: kadar.php');
	}
?>