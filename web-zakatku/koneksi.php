<?php
	include('config.php');
/**
* Class Koneksi untuk menghubungkan ke database
*/
class Koneksi
{
	private $connect = null;
	function __construct()
	{
		$host = DB_HOST;
		$db_name = DB_NAME;
		$username = DB_USER;
		$password = DB_PASS;
		$this->connect = new PDO("mysql:host=$host;dbname=$db_name", $username, $password);
	}

	function getUser()
	{
		$sql = 'SELECT kode_user, nama, alamat, pekerjaan, email, jenis_user FROM user';
		$sth = $this->connect->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->execute();
		return $sth->fetchAll();
	}

	function getUserByKode($kode)
	{
		$sql = 'SELECT kode_user, nama, alamat, pekerjaan, email, jenis_user FROM user WHERE kode_user=:kode_user';
		$sth = $this->connect->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->bindParam(':kode_user', $kode);
		$sth->execute();
		return $sth->fetch();
	}

	function cekEmail($email)
	{
		$sql = 'SELECT kode_user, nama, alamat, pekerjaan, email, jenis_user FROM user WHERE email=:email';
		$sth = $this->connect->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->bindParam(':email', $email);
		$sth->execute();
		return $sth->fetch();
	}

	function addUser($nama, $alamat, $pekerjaan, $email, $password, $jenis_user)
	{
		$sql = 'INSERT INTO user (nama, alamat, pekerjaan, email, password, jenis_user) VALUES (:nama, :alamat, :pekerjaan, :email, :password, :jenis_user)';
		$sth = $this->connect->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->bindParam(':nama', $nama);
		$sth->bindParam(':alamat', $alamat);
		$sth->bindParam(':pekerjaan', $pekerjaan);
		$sth->bindParam(':email', $email);
		$sth->bindParam(':password', $password);
		$sth->bindParam(':jenis_user', $jenis_user);
		return $sth->execute();
	}

	function editUser($kode, $nama, $alamat, $pekerjaan, $email, $password, $jenis_user)
	{
		$sql = 'UPDATE user SET nama=:nama, alamat=:alamat, pekerjaan=:pekerjaan, email=:email, jenis_user=:jenis_user WHERE kode_user = :kode_user';
		$sth = $this->connect->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->bindParam(':nama', $nama);
		$sth->bindParam(':alamat', $alamat);
		$sth->bindParam(':pekerjaan', $pekerjaan);
		$sth->bindParam(':email', $email);
		$sth->bindParam(':jenis_user', $jenis_user);
		$sth->bindParam(':kode_user', $kode);
		return $sth->execute();
	}

	function getUserbyID($kode)
	{
		$sql = 'SELECT kode_user, nama, alamat, pekerjaan, email, jenis_user WHERE kode_user = :kode_user';
		$sth = $this->connect->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->bindParam(':kode_user', $kode);
		$sth->execute();
		return $sth->fetch();
	}

	function login($email, $password)
	{
		$sql = 'SELECT * FROM user WHERE email = :email AND password = :password';
		$sth = $this->connect->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->bindParam(':email', $email);
		$sth->bindParam(':password', $password);
		$sth->execute();
		return $sth->fetch();
	}

	function deleteUser($kode)
	{
		$sql = 'DELETE FROM user WHERE kode_user = :kode_user';
		$sth = $this->connect->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->bindParam(':kode_user', $kode);
		$sth->execute();
		return $sth->fetchAll();
	}

	function insert($table, $array){
		$this->connect->exec("set names utf8");
		$this->connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

		$sql = 'INSERT INTO `' . $table . '` ';

		$columns = array();
		$columns_bindings = array();
		foreach ($array as $column_name => $data) {
		    $columns[] = $column_name;
		    $columns_bindings[] = ':' . $column_name;
		}

		$sql = $sql . '(' . implode(', ', $columns) . ') VALUES (' . implode(', ', $columns_bindings) . ')';

		$stmt = $this->connect->prepare($sql);

		foreach ($array as $column_name => $data) {
		    $stmt->bindValue(":" . $column_name, $data);
		}
		$stmt->execute();
		return $this->connect->lastInsertId();
	}

	function update($table = '', $array = array(), $kode, $kode_key){
		$this->connect->exec("set names utf8");
		$this->connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

		$sql = 'UPDATE `' . $table . '` SET ';

		$columns = array();
		$columns_bindings = array();
		$columns_sets = array();
		foreach ($array as $column_name => $data) {
		    $columns[] = $column_name;
		    $columns_bindings[] = ':' . $column_name;
		    $columns_sets[] = "$column_name=:$column_name";
		}

		$sql .= implode(', ', $columns_sets) . " WHERE $kode_key=:$kode_key";
		echo $sql;

		$stmt = $this->connect->prepare($sql);

		foreach ($array as $column_name => $data) {
		    $stmt->bindValue(":" . $column_name, $data);
		}
		$stmt->bindValue(":$kode_key", $kode);
		return $stmt->execute();
	}

	function delete($table, $array){
		$this->connect->exec("set names utf8");
		$this->connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

		$sql = "DELETE FROM $table ";

		if ($array){
			$sql = $sql . ' WHERE ';
			$columns = array();
			$columns_bindings = array();
			$i = 0;
			foreach ($array as $column_name => $data) {
				$i++;
				$columns[] = $column_name;
				$columns_bindings[] = ':' . $column_name;
				$sql .= "$column_name=:$column_name";
				if( $i < sizeof($array) ){
					$sql .= ' AND ';
				}
			}
		}
		echo $sql;
		$stmt = $this->connect->prepare($sql);

		if ($array){
			foreach ($array as $column_name => $data) {
				$stmt->bindValue(":" . $column_name, $data);
			}
		}
		return $stmt->execute();
		// return null;
	}

	function getKadar()
	{
		$sql = 'SELECT kode_kadar, nama_kadar, harga, satuan FROM kadar';
		$sth = $this->connect->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->execute();
		return $sth->fetchAll();
	}

	function getKadarByKode($kode_kadar)
	{
		$sql = 'SELECT kode_kadar, nama_kadar, harga, satuan FROM kadar WHERE kode_kadar=:kode_kadar';
		$sth = $this->connect->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->bindValue(':kode_kadar', $kode_kadar);
		$sth->execute();
		return $sth->fetch();
	}

	function getZakat()
	{
		$sql = 'SELECT * FROM zakat z JOIN kadar k ON z.kode_kadar=k.kode_kadar';
		$sth = $this->connect->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->execute();
		return $sth->fetchAll();
	}

	function getZakatByKode($kode_zakat)
	{
		$sql = 'SELECT * FROM zakat z JOIN kadar k ON z.kode_kadar=k.kode_kadar WHERE kode_zakat=:kode_zakat';
		$sth = $this->connect->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->bindValue(':kode_zakat', $kode_zakat);
		$sth->execute();
		return $sth->fetch();
	}

	function getHitung()
	{
		$sql = 'SELECT *, u.nama as nama_user FROM hitung h 
				JOIN zakat z ON h.kode_zakat=z.kode_zakat
				JOIN kadar k ON z.kode_kadar=k.kode_kadar
				LEFT JOIN user u ON h.kode_user=u.kode_user
				';
		$sth = $this->connect->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->execute();
		return $sth->fetchAll();
	}

	function getHitungByKode($kode_hitung)
	{
		$sql = 'SELECT *, u.nama as nama_user FROM hitung h 
				JOIN zakat z ON h.kode_zakat=z.kode_zakat
				JOIN kadar k ON z.kode_kadar=k.kode_kadar
				LEFT JOIN user u ON h.kode_user=u.kode_user
				WHERE h.kode_hitung=:kode_hitung
				LIMIT 1';
		$sth = $this->connect->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->bindValue(':kode_hitung', $kode_hitung);
		$sth->execute();
		return $sth->fetch();
	}

	function getHitungByUser($kode_user)
	{
		$sql = 'SELECT *, u.nama as nama_user FROM hitung h 
				JOIN zakat z ON h.kode_zakat=z.kode_zakat
				JOIN kadar k ON z.kode_kadar=k.kode_kadar
				JOIN user u ON h.kode_user=u.kode_user
				WHERE u.kode_user=:kode_user
				';
		$sth = $this->connect->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->bindValue(':kode_user', $kode_user);
		$sth->execute();
		return $sth->fetchAll();
	}
}