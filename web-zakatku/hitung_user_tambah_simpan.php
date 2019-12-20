<?php
	include('helper.php');
	include('koneksi.php');

	$hitung = [];
	$hitung['tanggal'] = date('Y-m-d 00:00:00');

	if (isset($_POST['kode_zakat'])){
		$hitung['kode_zakat'] = $_POST['kode_zakat'];
	}
	if (!empty($_POST['kode_user'])){
		$hitung['kode_user'] = $_POST['kode_user'];
	}
	if (isset($_POST['tanggal'])){
		$hitung['tanggal'] = $_POST['tanggal'];
	}
	if (isset($_POST['jumlah_harta'])){
		$hitung['jumlah_harta'] = $_POST['jumlah_harta'];
	}
	if (isset($_POST['jumlah_zakat'])){
		$hitung['jumlah_zakat'] = $_POST['jumlah_zakat'];
	}

	$koneksi = new Koneksi();
	$cek = $koneksi->insert('hitung', $hitung);
	if ($cek) {
		setFlashData('status', 'success');
		setFlashData('message', 'Berhasil menambah Hitung');
		header('Location: index.php');
	} else {
		setFlashData('status', 'danger');
		setFlashData('message', 'Gagal menambah Hitung');
		header('Location: index.php');
	}
?>