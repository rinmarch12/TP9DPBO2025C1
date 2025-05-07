<?php

include("KontrakPresenter.php");

/******************************************
 Asisten Pemrogaman 13 & 14
******************************************/

class ProsesMahasiswa implements KontrakPresenter
{
	private $tabelmahasiswa;
	private $data = [];

	function __construct()
	{
		// Konstruktor
		try {
			$db_host = "localhost"; // host 
			$db_user = "root"; // user
			$db_password = ""; // password
			$db_name = "mvp_php"; // nama basis data
			$this->tabelmahasiswa = new TabelMahasiswa($db_host, $db_user, $db_password, $db_name); // instansi TabelMahasiswa
			$this->data = array(); // instansi list untuk data Mahasiswa
		} catch (Exception $e) {
			echo "yah error" . $e->getMessage();
		}
	}

	function prosesDataMahasiswa()
	{
		try {
			// mengambil data di tabel Mahasiswa
			$this->tabelmahasiswa->open();
			$this->tabelmahasiswa->getMahasiswa();

			while ($row = $this->tabelmahasiswa->getResult()) {
				// ambil hasil query
				$mahasiswa = new Mahasiswa(); // instansiasi objek mahasiswa untuk setiap data mahasiswa
				$mahasiswa->setId($row['id']); // mengisi id
				$mahasiswa->setNim($row['nim']); // mengisi nim
				$mahasiswa->setNama($row['nama']); // mengisi nama
				$mahasiswa->setTempat($row['tempat']); // mengisi tempat
				$mahasiswa->setTl($row['tl']); // mengisi tl
				$mahasiswa->setGender($row['gender']); // mengisi gender
				$mahasiswa->setEmail($row['email']); // mengisi email
				$mahasiswa->setTelp($row['telp']); // mengisi telp

				$this->data[] = $mahasiswa; // tambahkan data mahasiswa ke dalam list
			}
			// Tutup koneksi
			$this->tabelmahasiswa->close();
		} catch (Exception $e) {
			// memproses error
			echo "yah error part 2" . $e->getMessage();
		}
	}
	
	function getId($i)
	{
		// mengembalikan id mahasiswa dengan indeks ke i
		return $this->data[$i]->getId();
	}
	function getNim($i)
	{
		// mengembalikan nim mahasiswa dengan indeks ke i
		return $this->data[$i]->getNim();
	}
	function getNama($i)
	{
		// mengembalikan nama mahasiswa dengan indeks ke i
		return $this->data[$i]->getNama();
	}
	function getTempat($i)
	{
		// mengembalikan tempat mahasiswa dengan indeks ke i
		return $this->data[$i]->getTempat();
	}
	function getTl($i)
	{
		// mengembalikan tanggal lahir(TL) mahasiswa dengan indeks ke i
		return $this->data[$i]->getTl();
	}
	function getGender($i)
	{
		// mengembalikan gender mahasiswa dengan indeks ke i
		return $this->data[$i]->getGender();
	}
	function getEmail($i)
	{
		// mengembalikan email mahasiswa dengan indeks ke i
		return $this->data[$i]->getEmail();
	}
	function getTelp($i)
	{
		// mengembalikan telepon mahasiswa dengan indeks ke i
		return $this->data[$i]->getTelp();
	}
	function getSize()
	{
		return sizeof($this->data);
	}
	
	function getMahasiswaById($id)
	{
		$this->tabelmahasiswa->open();
		$this->tabelmahasiswa->getMahasiswaById($id);
		$this->tabelmahasiswa->close();
		
		$data = null;
		$row = $this->tabelmahasiswa->getResult();
		
		if ($row) {
			$data = new Mahasiswa();
			$data->setId($row['id']);
			$data->setNim($row['nim']);
			$data->setNama($row['nama']);
			$data->setTempat($row['tempat']);
			$data->setTl($row['tl']);
			$data->setGender($row['gender']);
			$data->setEmail($row['email']);
			$data->setTelp($row['telp']);
		}
		
		return $data;
	}
	
	function addMahasiswa($data)
	{
		try {
			$nim = $data['nim'];
			$nama = $data['nama'];
			$tempat = $data['tempat'];
			$tl = $data['tl'];
			$gender = $data['gender'];
			$email = $data['email'];
			$telp = $data['telp'];
			
			$this->tabelmahasiswa->open();
			$this->tabelmahasiswa->addMahasiswa($nim, $nama, $tempat, $tl, $gender, $email, $telp);
			$this->tabelmahasiswa->close();
			
			return true;
		} catch (Exception $e) {
			echo "Error add: " . $e->getMessage();
			return false;
		}
	}
	
	function updateMahasiswa($id, $data)
	{
		try {
			$nim = $data['nim'];
			$nama = $data['nama'];
			$tempat = $data['tempat'];
			$tl = $data['tl'];
			$gender = $data['gender'];
			$email = $data['email'];
			$telp = $data['telp'];
			
			$this->tabelmahasiswa->open();
			$this->tabelmahasiswa->updateMahasiswa($id, $nim, $nama, $tempat, $tl, $gender, $email, $telp);
			$this->tabelmahasiswa->close();
			
			return true;
		} catch (Exception $e) {
			echo "Error update: " . $e->getMessage();
			return false;
		}
	}
	
	function deleteMahasiswa($id)
	{
		try {
			$this->tabelmahasiswa->open();
			$this->tabelmahasiswa->deleteMahasiswa($id);
			$this->tabelmahasiswa->close();
			
			return true;
		} catch (Exception $e) {
			echo "Error delete: " . $e->getMessage();
			return false;
		}
	}
}