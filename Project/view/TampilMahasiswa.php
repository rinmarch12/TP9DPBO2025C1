<?php

/******************************************
 Asisten Pemrogaman 13 & 14
******************************************/

include("KontrakView.php");
include("presenter/ProsesMahasiswa.php");

class TampilMahasiswa implements KontrakView
{
	private $prosesmahasiswa; // Presenter yang dapat berinteraksi langsung dengan view
	private $tpl;

	function __construct()
	{
		//konstruktor
		$this->prosesmahasiswa = new ProsesMahasiswa();
	}

	function tampil()
	{
		$data = null;
		$view = null;
		
		// Cek action yang dilakukan user
		if (isset($_GET['add'])) {
			// Tampilkan form tambah
			$this->tampilFormTambah();
		} elseif (isset($_GET['edit'])) {
			// Tampilkan form edit
			$this->tampilFormEdit($_GET['edit']);
		} elseif (isset($_GET['delete'])) {
			// Proses delete data
			$this->prosesmahasiswa->deleteMahasiswa($_GET['delete']);
			header("location:index.php");
		} elseif (isset($_POST['tambah'])) {
			// Proses tambah data
			$data = [
				'nim' => $_POST['nim'],
				'nama' => $_POST['nama'],
				'tempat' => $_POST['tempat'],
				'tl' => $_POST['tl'],
				'gender' => $_POST['gender'],
				'email' => $_POST['email'],
				'telp' => $_POST['telp']
			];
			
			$this->prosesmahasiswa->addMahasiswa($data);
			header("location:index.php");
		} elseif (isset($_POST['update'])) {
			// Proses update data
			$id = $_POST['id'];
			$data = [
				'nim' => $_POST['nim'],
				'nama' => $_POST['nama'],
				'tempat' => $_POST['tempat'],
				'tl' => $_POST['tl'],
				'gender' => $_POST['gender'],
				'email' => $_POST['email'],
				'telp' => $_POST['telp']
			];
			
			$this->prosesmahasiswa->updateMahasiswa($id, $data);
			header("location:index.php");
		} else {
			// Tampilkan daftar mahasiswa
			$this->tampilDaftarMahasiswa();
		}
	}
	
	function tampilDaftarMahasiswa()
	{
		$this->prosesmahasiswa->prosesDataMahasiswa();
		$data = null;

		//semua terkait tampilan adalah tanggung jawab view
		for ($i = 0; $i < $this->prosesmahasiswa->getSize(); $i++) {
			$no = $i + 1;
			$id = $this->prosesmahasiswa->getId($i);
			$data .= "<tr>
			<td>" . $no . "</td>
			<td>" . $this->prosesmahasiswa->getNim($i) . "</td>
			<td>" . $this->prosesmahasiswa->getNama($i) . "</td>
			<td>" . $this->prosesmahasiswa->getTempat($i) . "</td>
			<td>" . $this->prosesmahasiswa->getTl($i) . "</td>
			<td>" . $this->prosesmahasiswa->getGender($i) . "</td>
			<td>" . $this->prosesmahasiswa->getEmail($i) . "</td>
			<td>" . $this->prosesmahasiswa->getTelp($i) . "</td>
			<td>
				<a href='index.php?edit=" . $id . "' class='btn btn-warning btn-sm'><i class='fas fa-edit'></i> Edit</a> 
				<a href='index.php?delete=" . $id . "' class='btn btn-danger btn-sm' onclick=\"return confirm('Apakah Anda yakin ingin menghapus data ini?');\"><i class='fas fa-trash'></i> Hapus</a>
			</td>
			</tr>";
		}
		
		// Membaca template skin.html
		$this->tpl = new Template("templates/skin.html");

		// Mengganti kode Data_Tabel dengan data yang sudah diproses
		$this->tpl->replace("DATA_TABEL", $data);

		// Menampilkan ke layar
		$this->tpl->write();
	}
	
	function tampilFormTambah()
	{
		// Membaca template form
		$this->tpl = new Template("templates/skinform.html");
		
		// Mengganti kode template dengan data
		$this->tpl->replace("DATA_JUDUL", "TAMBAH DATA MAHASISWA");
		$this->tpl->replace("DATA_FORM_ACTION", "index.php");
		$this->tpl->replace("DATA_FORM_ID", ""); // hidden id kosong karena tambah data
		$this->tpl->replace("DATA_NIM", "");
		$this->tpl->replace("DATA_NAMA", "");
		$this->tpl->replace("DATA_TEMPAT", "");
		$this->tpl->replace("DATA_TL", "");
		$this->tpl->replace("DATA_SELECTED_LAKI", "");
		$this->tpl->replace("DATA_SELECTED_PEREMPUAN", "");
		$this->tpl->replace("DATA_EMAIL", "");
		$this->tpl->replace("DATA_TELP", "");
		$this->tpl->replace("DATA_SUBMIT_NAME", "tambah");
		
		// Menampilkan ke layar
		$this->tpl->write();
	}
	
	function tampilFormEdit($id)
	{
		// Mengambil data mahasiswa berdasarkan id
		$mahasiswa = $this->prosesmahasiswa->getMahasiswaById($id);
		
		if (!$mahasiswa) {
			echo "<script>alert('Data tidak ditemukan!');window.location='index.php';</script>";
			return;
		}
		
		// Menentukan gender yang dipilih
		$selectedLaki = ($mahasiswa->getGender() == "Laki-laki") ? "selected" : "";
		$selectedPerempuan = ($mahasiswa->getGender() == "Perempuan") ? "selected" : "";
		
		// Membaca template form
		$this->tpl = new Template("templates/skinform.html");
		
		// Mengganti kode template dengan data
		$this->tpl->replace("DATA_JUDUL", "EDIT DATA MAHASISWA");
		$this->tpl->replace("DATA_FORM_ACTION", "index.php");
		$this->tpl->replace("DATA_FORM_ID", "<input type='hidden' name='id' value='" . $mahasiswa->getId() . "'>");
		$this->tpl->replace("DATA_NIM", $mahasiswa->getNim());
		$this->tpl->replace("DATA_NAMA", $mahasiswa->getNama());
		$this->tpl->replace("DATA_TEMPAT", $mahasiswa->getTempat());
		$this->tpl->replace("DATA_TL", $mahasiswa->getTl());
		$this->tpl->replace("DATA_SELECTED_LAKI", $selectedLaki);
		$this->tpl->replace("DATA_SELECTED_PEREMPUAN", $selectedPerempuan);
		$this->tpl->replace("DATA_EMAIL", $mahasiswa->getEmail());
		$this->tpl->replace("DATA_TELP", $mahasiswa->getTelp());
		$this->tpl->replace("DATA_SUBMIT_NAME", "update");
		
		// Menampilkan ke layar
		$this->tpl->write();
	}
}