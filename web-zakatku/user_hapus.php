<?php
	include('helper.php');
	include('koneksi.php');

	$kode = null;
	$user = [];

	if (isset($_POST['kode_user'])){
		$user['kode_user'] = $_POST['kode_user'];
	}

	$koneksi = new Koneksi();
	$cek = $koneksi->delete('user', $user);

	if ($cek) {
		setFlashData('status', 'success');
		setFlashData('message', 'Berhasil Menghapus User');
		header('Location: user.php');
	} else {
		setFlashData('status', 'danger');
		setFlashData('message', 'Gagal Menghapus User');
		header('Location: user.php');
	}