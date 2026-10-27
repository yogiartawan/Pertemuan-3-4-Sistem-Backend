// I GEDE PRADNYA YOGIARTAWAN (250030522/UG253)


<?php

// Class buku
class Buku {
    // Enkapsulasi: Properti dibuat private agar aman dari akses luar langsung
    private $judul;
    private $penulis;
    private $isbn;

    public function __construct($judul, $penulis, $isbn) {
        $this->judul = $judul;
        $this->penulis = $penulis;
        $this->isbn = $isbn;
    }

    // Getter dan Setter untuk Enkapsulasi
    public function getJudul() {
        return $this->judul;
    }

    public function setJudul($judul) {
        $this->judul = $judul;
    }

    public function getPenulis() {
        return $this->penulis;
    }

    public function getIsbn() {
        return $this->isbn;
    }

    // Method biasa
    public function getInfoBuku() {
        return "Buku: {$this->judul}, Penulis: {$this->penulis} (ISBN: {$this->isbn})";
    }
}


class BukuFisik extends Buku {
    private $jumlahHalaman;

    public function __construct($judul, $penulis, $isbn, $jumlahHalaman) {
        parent::__construct($judul, $penulis, $isbn);
        $this->jumlahHalaman = $jumlahHalaman;
    }

    // Polimorfisme: Melakukan overriding method getInfoBuku()
    public function getInfoBuku() {
        return parent::getInfoBuku() . " [Format: Buku Fisik, Halaman: {$this->jumlahHalaman}]";
    }
}


class BukuDigital extends Buku {
    private $ukuranFile; // dalam MB

    public function __construct($judul, $penulis, $isbn, $ukuranFile) {
        parent::__construct($judul, $penulis, $isbn);
        $this->ukuranFile = $ukuranFile;
    }

    // Polimorfisme: Melakukan overriding method getInfoBuku() dengan versi digital
    public function getInfoBuku() {
        return parent::getInfoBuku() . " [Format: Buku Digital, Ukuran: {$this->ukuranFile} MB]";
    }
}


//Class Anggota 
abstract class Anggota {
    protected $nama;
    protected $idAnggota;

    public function __construct($nama, $idAnggota) {
        $this->nama = $nama;
        $this->idAnggota = $idAnggota;
    }

    public function getNama() {
        return $this->nama;
    }

    public function getIdAnggota() {
        return $this->idAnggota;
    }

    // Abstract method: Wajib di-implementasikan oleh class turunannya (Polimorfisme)
    abstract public function getBatasMaksimalPinjam();
}

// Turunan Anggota 1: Mahasiswa
class Mahasiswa extends Anggota {
    private $jurusan;

    public function __construct($nama, $idAnggota, $jurusan) {
        parent::__construct($nama, $idAnggota);
        $this->jurusan = $jurusan;
    }

    public function getJurusan() {
        return $this->jurusan;
    }

    // Implementasi polimorfisme aturan pinjam mahasiswa
    public function getBatasMaksimalPinjam() {
        return 3; // Mahasiswa maksimal pinjam 3 buku
    }
}

// Turunan Anggota 2: Dosen
class Dosen extends Anggota {
    private $fakultas;

    public function __construct($nama, $idAnggota, $fakultas) {
        parent::__construct($nama, $idAnggota);
        $this->fakultas = $fakultas;
    }

    public function getFakultas() {
        return $this->fakultas;
    }

    // Implementasi polimorfisme aturan pinjam dosen
    public function getBatasMaksimalPinjam() {
        return 5; // Dosen maksimal pinjam 5 buku
    }
}


// Class pinjaman 
class Pinjaman {
    private Anggota $anggota; // Type hinting objek Anggota
    private Buku $buku;       // Type hinting objek Buku
    private $tanggalPinjam;

    public function __construct(Anggota $anggota, Buku $buku, $tanggalPinjam) {
        $this->anggota = $anggota;
        $this->buku = $buku;
        $this->tanggalPinjam = $tanggalPinjam;
    }

    public function prosesPinjam() {
        echo "========================================\n";
        echo "          STRUK PEMINJAMAN BUKU         \n";
        echo "========================================\n";
        echo "Nama Anggota  : " . $this->anggota->getNama() . " (ID: " . $this->anggota->getIdAnggota() . ")\n";
        echo "Batas Kuota   : " . $this->anggota->getBatasMaksimalPinjam() . " Buku\n";
        // Di bawah ini mendemonstrasikan Polymorphism saat method getInfoBuku() dipanggil
        echo "Detail Buku   : " . $this->buku->getInfoBuku() . "\n";
        echo "Tgl Pinjam    : " . $this->tanggalPinjam . "\n";
        echo "Status        : BERHASIL DIPINJAM\n";
        echo "========================================\n\n";
    }
}

// Contoh 

// Membuat Objek Buku (Menggunakan class turunan: BukuFisik & BukuDigital)
$buku1 = new BukuFisik("Belajar Pemrograman PHP", "Andi Prasetyo", "978-602-123", 320);
$buku2 = new BukuDigital("Mastering Object-Oriented PHP", "Siti Rahma", "978-602-456", 12.5);

// Membuat Objek Anggota (Menggunakan class turunan: Mahasiswa & Dosen)
$mhs = new Mahasiswa("Budi Santoso", "MHS-2026-001", "Teknik Informatika");
$dosen = new Dosen("Dr. Ahmad Fauzi, M.Kom.", "DSN-1980-005", "Ilmu Komputer");

// Melakukan Transaksi Peminjaman
$transaksi1 = new Pinjaman($mhs, $buku1, "2026-06-07");
$transaksi1->prosesPinjam();

$transaksi2 = new Pinjaman($dosen, $buku2, "2026-06-07");
$transaksi2->prosesPinjam();

$buku1 = new Buku("Pemrograman Web PHP", "Andi", "978-12345");


?>
