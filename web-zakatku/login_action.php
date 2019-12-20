<?php
	include('helper.php');
	include('koneksi.php');

	$email = null;
	$password = null;

	if (isset($_POST['email'])){
		$email = $_POST['email'];
	}

	if (isset($_POST['password'])){
		$password = md5($_POST['password']);
	}

	$koneksi = new koneksi();
	$user = $koneksi->login($email, $password);

	if ($user) {
		setSessionData('user', $user);
		setFlashData('status', 'success');
		setFlashData('message', 'Login Berhasil');
		header('Location: index.php');
	} else {
		setFlashData('status', 'danger');
		setFlashData('message', 'Login Gagal');
		header('Location: login.php');
	}
?>