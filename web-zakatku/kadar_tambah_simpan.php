<?php
	include('helper.php');
	include('koneksi.php');

	$kadar = [];

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
	$cek = $koneksi->insert('kadar', $kadar);
	if ($cek) {
		setFlashData('status', 'success');
		setFlashData('message', 'Berhasil menambah Kadar');
		header('Location: kadar.php');
	} else {
		setFlashData('status', 'danger');
		setFlashData('message', 'Gagal menambah Kadar');
		header('Location: kadar_tambah.php');
	}
?>