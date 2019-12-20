<?php
	include('helper.php');
	include('koneksi.php');

	$user = [];

	if (isset($_POST['nama'])){
		$user['nama'] = $_POST['nama'];
	}
	if (isset($_POST['alamat'])){
		$user['alamat'] = $_POST['alamat'];
	}
	if (isset($_POST['pekerjaan'])){
		$user['pekerjaan'] = $_POST['pekerjaan'];
	}
	if (isset($_POST['email'])){
		$user['email'] = $_POST['email'];
	}
	if (isset($_POST['password'])){
		$user['password'] = md5($_POST['password']);
	}
	if (isset($_POST['jenis_user'])){
		$user['jenis_user'] = $_POST['jenis_user'];
	}

	$koneksi = new Koneksi();
	$cek = $koneksi->insert('user', $user);
	echo json_encode($cek);
	if ($cek) {
		setFlashData('status', 'success');
		setFlashData('message', 'Berhasil menambah User');
		header('Location: user.php');
	} else {
		setFlashData('status', 'danger');
		setFlashData('message', 'Gagal menambah User');
		header('Location: user_tambah.php');
	}