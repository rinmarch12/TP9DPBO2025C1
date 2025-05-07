Janji
---
Saya Ririn Marchelina dengan NIM 2303662 mengerjakan Tugas Praktikum 9 dalam mata kuliah Desain dan Pemrograman Berorientasi Objek untuk keberkahanNya maka saya tidak melakukan kecurangan seperti yang telah dispesifikasikan. Aamiin.

---
Alur Program
---
1. Inisialisasi Data:
- Program dimulai dari satu file utama (index)lalu memanggil kelas tampilan untuk mengatur alur program selanjutnya.
- Kelas tampilan memeriksa parameter URL untuk menentukan aksi yang diminta
- Tanpa parameter → tampilkan daftar mahasiswa.
- ?add=1 → tampilkan form tambah.
- ?edit={id} → tampilkan form edit.
- ?delete={id} → proses penghapusan data.
2. Menampilkan Daftar Mahasiswa:
- Sistem mengambil seluruh data mahasiswa dari database.
- Data disusun menjadi tabel HTML secara dinamis.
- Setiap baris data dilengkapi dengan tombol edit dan tombol hapus
- Di atas tabel juga menampilkan tombol Tambah Mahasiswa
3. Menambah Data Mahasiswa:
- User mengklik tombol tambah data baru
- Sistem menampilkan form untuk input data
- User mengisi form dan submit
- Controller memproses data form dan menyimpannya ke database
- Form dikirim ke modul proses melalui metode POST.
- Modul proses nya yaitu membaca data dari form, membuat objek data baru., menyimpan data ke database.
4. Mengedit Data Mahasiswa:
- User mengklik tombol edit pada data tertentu
- Sistem mengambil data mahasiswa berdasarkan ID dari database.
- Form diisi otomatis dengan data yang ada sebelumnya.
- User mengubah data lalu menekan tombol Simpan.
- Modul proses nya yaitu mendeteksi adanya ID untuk diedit dan memperbarui data di database sesuai input baru.
5. Menghapus Data Mahasiswa:
- User mengklik tombol hapus pada data tertentu
- Sistem menerima ID mahasiswa yang dipilih.
- Proses penghapusan langsung dijalankan:
- Data mahasiswa dihapus dari database berdasarkan ID.
- Sebelum dihapus datanya akan ada konfirmasi "Apakah Anda yakin ingin menghapus data ini?"
6. Poses Simpan dan Update:
- Modul proses menangani dua aksi: tambah dan edit.
- Logika dibedakan berdasarkan ada tidaknya ID:
- ID kosong → data baru → lakukan INSERT.
- ID ada → data lama → lakukan UPDATE.\
- Setelah proses, sistem diarahkan kembali ke daftar mahasiswa.
7. Sistem Template:
- Template HTML digunakan sebagai kerangka tampilan yang terdiri dari dua jenis
- Template tabel (skin.html) untuk daftar mahasiswa.
- Template form (skinform.html) untuk tambah/edit data.

---
Dokumentasi
---
1. Beranda
---
![Tampilan Tabel](https://github.com/user-attachments/assets/3852a14b-c56f-43ff-b6e2-7734d294a421)
---
2. Add Data
---
![Form Add Data](https://github.com/user-attachments/assets/f60c5d9a-7880-4ea1-8f8e-aa8d1269b583)
---
3. Edit Data
---
![Form Edit Data](https://github.com/user-attachments/assets/782b768e-3d3c-49e6-9acb-1a409ca5ed38)
---
4. Delete
---
![Form Edit Data](https://github.com/user-attachments/assets/01388ead-55d7-4109-8e24-85917cf19900)




