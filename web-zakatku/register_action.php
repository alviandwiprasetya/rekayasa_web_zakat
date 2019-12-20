<?php
	include('helper.php');
	include('koneksi.php');

	$koneksi = new koneksi();
	$email = null;
	$password = null;
	$email_terdaftar = false;

	$user = [];
	$user['jenis_user'] = 'user';
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
		$cek = $koneksi->cekEmail($_POST['email']);

		if (!empty($cek)){
			setFlashData('status', 'danger');
			setFlashData('message', 'Email sudah terdaftar');
			header('Location: register.php');
			$email_terdaftar = true;
		}
	}
	if (isset($_POST['password'])){
		$user['password'] = md5($_POST['password']);
	}

	// Jika email belum terdaftar
	if (!$email_terdaftar){
		$kode_user = $koneksi->insert('user', $user);

		if ($kode_user) {
			$user = $koneksi->getUserbyID($kode_user);
			setSessionData('user', $user);
			setFlashData('status', 'success');
			setFlashData('message', 'Berhasil Register');
			header('Location: index.php');
		} else {
			setFlashData('status', 'danger');
			setFlashData('message', 'Register Gagal');
			header('Location: register.php');
		}
	}
?>