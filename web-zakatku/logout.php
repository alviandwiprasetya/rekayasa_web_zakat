<?php
	include('helper.php');
	include('koneksi.php');

	removeSessionData('user');
	setFlashData('status', 'success');
	setFlashData('message', 'Logout Berhasil');
	header('Location: login.php');