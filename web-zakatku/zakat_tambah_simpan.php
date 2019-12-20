<?php
	include('helper.php');
	include('koneksi.php');

	$zakat = [];

	if (isset($_POST['kode_kadar'])){
		$zakat['kode_kadar'] = $_POST['kode_kadar'];
	}
	if (isset($_POST['nama_zakat'])){
		$zakat['nama_zakat'] = $_POST['nama_zakat'];
	}
	if (isset($_POST['nishab'])){
		$zakat['nishab'] = $_POST['nishab'];
	}
	if (isset($_POST['haul'])){
		$zakat['haul'] = $_POST['haul'];
	}
	if (isset($_POST['persentase_zakat'])){
		$zakat['persentase_zakat'] = $_POST['persentase_zakat'];
	}
	if (isset($_POST['satuan'])){
		$zakat['satuan'] = $_POST['satuan'];
	}

	$koneksi = new Koneksi();
	$cek = $koneksi->insert('zakat', $zakat);
	if ($cek) {
		setFlashData('status', 'success');
		setFlashData('message', 'Berhasil menambah Zakat');
		header('Location: zakat.php');
	} else {
		setFlashData('status', 'danger');
		setFlashData('message', 'Gagal menambah Zakat');
		header('Location: zakat_tambah.php');
	}