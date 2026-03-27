<?php
session_start();
include_once "../database.php";
include_once "../fungsi.php";
include_once "fpdf16/fpdf.php";

// Memeriksa login pengguna
if (!isset($_SESSION['apriori_id'])) {
    die("Pengguna tidak login.");
}

$id_process = $_REQUEST['id_process'];

// object database class
$db_object = new database();

$sql_que = "SELECT
            conf.*, log.start_date, log.end_date
            FROM
             confidence conf, process_log `log`
            WHERE conf.id_process = '$id_process' "
            . " AND conf.id_process = log.id "
            . " AND conf.lolos=1 "
            . " ORDER BY conf.from_itemset DESC";

$db_query = $db_object->db_query($sql_que) or die("Query gagal");

// Variabel untuk iterasi
$i = 0;
$cell = []; // Inisialisasi array cell

// memulai pengaturan output PDF
class PDF extends FPDF {

    // untuk pengaturan header halaman
    function Header() {
        // Pengaturan Font Header
        $this->SetFont('Times', 'B', 14);
        // untuk warna background Header
        $this->SetFillColor(255, 255, 255);
        // untuk warna text
        $this->SetTextColor(0, 0, 0);
    }
}

// pengaturan ukuran kertas L = Landscape
$pdf = new PDF('L', 'cm', 'A4');
$pdf->Open();
$pdf->AddPage();

// Variabel untuk menyimpan lebar teks maksimal
$max_text_width = 0; 

// Mengambil nilai dari query database dan menghitung lebar teks maksimal
while ($data = $db_object->db_fetch_array($db_query)) {
    $cell[$i][0] = price_format($data['confidence']);
    $cell[$i][1] = "Probabilitas sebesar " . $cell[$i][0] . "(%) untuk konsumen membeli " . $data['kombinasi1'] . " bersama " . $data['kombinasi2'];

    // Menghitung lebar teks untuk setiap baris
    $text_width = $pdf->GetStringWidth($cell[$i][1]);
    if ($text_width > $max_text_width) {
        $max_text_width = $text_width; // Simpan lebar teks maksimal
    }

    $i++;
}

// Tambahkan margin dan padding ke lebar teks maksimal
$max_text_width += 2; // Margin kiri-kanan 1 cm

// Menambahkan gambar di bagian kiri atas halaman tanpa margin dengan ukuran yang lebih besar
$image_width = 3.5; // Lebar gambar dalam cm (lebih besar)
$image_height = 3.5; // Tinggi gambar dalam cm (lebih besar)
$pdf->Image('../assets/images/Logo xyz.jpg', 0.5, 0.5, $image_width, $image_height); // Posisi kiri atas dengan sedikit margin

// Tambahkan jarak padding di atas teks 
$pdf->Ln(1); // Jarak 2 cm dari posisi sebelumnya

// Tambahkan teks "ACIAK MART PAUH"
$pdf->SetFont('Times', 'B', 16);
$pdf->Cell(28, 1, 'LAPORAN', 0, 1, 'C');

// Menghitung posisi X dan Y untuk menempatkan teks alamat
$alamat = 'Lorem';
$alamatWidth = $pdf->GetStringWidth($alamat);
$tabelX = 1; // Posisi X untuk tabel
$tabelY = $pdf->GetY(); // Posisi Y untuk tabel
$posX = $tabelX;
$posY = $tabelY + 1;

// Tambahkan teks alamat
$pdf->SetFont('Times', '', 14);
$pdf->SetXY($posX, $posY);
$pdf->MultiCell(28, 0.5, $alamat, 0, 'C');

$pdf->Ln(0.2);

// Menambahkan jarak sebelum garis horizontal
$pdf->Ln(0.5);

// Menggambar garis horizontal setelah teks alamat
$garis_x1 = 1; // Posisi X mulai (kiri)
$garis_y1 = $pdf->GetY(); // Posisi Y mulai (di bawah alamat)
$garis_x2 = 28; // Posisi X akhir (kanan)
$garis_y2 = $garis_y1; // Posisi Y akhir (garis horizontal)

// Menggambar garis
$pdf->Line($garis_x1, $garis_y1, $garis_x2, $garis_y2);

// Menambahkan jarak sebelum tabel dimulai
$pdf->Ln(0.5);

$pdf->SetFont('Times', 'B', 12);
$pdf->Cell(28, 1, 'Hasil Analisa', 'LRTB', 0, 'C');
$pdf->Ln();

// Lebar kolom untuk tabel
$col_width_no = 1; // Lebar kolom untuk nomor
$col_width_keterangan = 27; // Lebar kolom untuk keterangan, disesuaikan

// Header tabel
$pdf->Cell($col_width_no, 1, 'No', 'LRTB', 0, 'C');
$pdf->Cell($col_width_keterangan, 1, 'Keterangan', 'LRTB', 0, 'C');
$pdf->Ln();

// Konten tabel
$pdf->SetFont('Times', "", 10);
for ($j = 0; $j < $i; $j++) {
    $pdf->Cell($col_width_no, 1, $j + 1, 'LBTR', 0, 'C');
    $pdf->MultiCell($col_width_keterangan, 1, $cell[$j][1], 'LBTR', 'L');
}

// Menambahkan jarak setelah tabel
$pdf->Ln(1);

// Tambahkan teks "Tanggal Cetak" di bawah tabel
$pdf->SetFont('Times', 'I', 14);
$tanggal = date('d-m-Y');
$pdf->Cell(0, 1, 'Padang, ' . $tanggal, 0, 1, 'R');

// Tambahkan teks "Dicetak Oleh" di bawah "Tanggal Cetak"
$pdf->SetFont('Times', '', 14);
$pdf->Cell(0, 1, 'Dicetak Oleh', 0, 1, 'R');

// Tambahkan teks level user di bawah "Dicetak Oleh"
$level_text = ($_SESSION['apriori_level'] == 1) ? 'Admin' : 'Pimpinan';

//Menambahkan jarak setelah dicetak oleh
$pdf->Ln(2.5);

$pdf->Cell(0, 1,$level_text, 0, 0, 'R');

// menampilkan output berupa halaman PDF
$pdf->Output();
?>
