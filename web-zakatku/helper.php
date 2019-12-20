<?php
	session_start();
	include('config.php');

	function getSessionData($key){
		if (isset($_SESSION[APP_NAME]) && isset($_SESSION[APP_NAME][$key])){
			return $_SESSION[APP_NAME][$key];
		}
		return null;
	}

	function setSessionData($key, $value){
		$_SESSION[APP_NAME][$key] = $value;
		return $_SESSION[APP_NAME][$key];
	}

	function removeSessionData($key){
		if (isset($_SESSION[APP_NAME]) && isset($_SESSION[APP_NAME][$key])){
			unset($_SESSION[APP_NAME][$key]);
		}
	}

	function setFlashData($key, $value){
		return setSessionData($key, $value);
	}

	function getFlashData($key){
		if (isset($_SESSION[APP_NAME]) && isset($_SESSION[APP_NAME][$key])){
			$result = $_SESSION[APP_NAME][$key];
			unset($_SESSION[APP_NAME][$key]);
			return $result;
		}
		return null;
	}

	function uploadFile($post_name){
		$target_dir = "uploads/";
		$target_file = $target_dir . basename($_FILES[$post_name]["name"]);
		$uploadOk = true;
		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
		$status = null;
		$message = null;
		// Check if image file is a actual image or fake image
		if(isset($_POST["submit"])) {
		    $check = getimagesize($_FILES[$post_name]["tmp_name"]);
		    if($check !== false) {
		        $message = "File is an image - " . $check["mime"] . ".";
		        $uploadOk = true;
		    } else {
		        $message = "File is not an image.";
		        $uploadOk = false;
		    }
		}
		if (!mkdir($target_dir, 0777, true)) {
		    $message = "Failed to create directory";
		} else if (file_exists($target_file)) {
			// Check if file already exists
		    $message = "Sorry, file already exists.";
		    $uploadOk = false;
		} else if ($_FILES[$post_name]["size"] > 500000) {
			// Check file size
		    $message = "Sorry, your file is too large.";
		    $uploadOk = false;
		} else if(!in_array($imageFileType, ['jpg', 'png', 'jpeg', 'gif'])) {
			// Allow certain file formats
		    $message = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
		    $uploadOk = false;
		}
		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == false) {
			echo $message;
			setFlashData('status', 'warning');
			setFlashData('message', $message);
			return false;
		    // $message = "Sorry, your file was not uploaded.";
		// if everything is ok, try to upload file
		} else {
		    if (move_uploaded_file($_FILES[$post_name]["tmp_name"], $target_file)) {
		        echo "The file ". basename( $_FILES[$post_name]["name"]). " has been uploaded.";
		        return basename( $_FILES[$post_name]["name"]);
		    } else {
		        $message = "Sorry, there was an error uploading your file.";
				echo $message;
				setFlashData('status', 'warning');
				setFlashData('message', $message);
				return false;
		    }
		}
	}

	function currencyFormat($value){
		return number_format($value, 0, '.', ',');
	}
?>