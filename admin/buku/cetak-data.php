<?php
require_once('../../tcpdf/tcpdf.php');

class MYPDF extends TCPDF {

    //Page header
    public function Header() {
        // Logo
        $image_file = K_PATH_IMAGES . 'Buku.png';
        $this->Image($image_file, 10, 10, 15, '', 'jpg', '', 'T', false, 300, '', false, false, 0, false, false, false);
        // Set font
        $this->SetFont('times', 'B', 20);

        $this->Ln(10); // Add empty line with margin top (10)

        // Title
        $this->Cell(0, 15, 'Data Buku', 0, false, 'C', 0, '', 0, false, 'M', 'M');
    }

    // Page footer
    public function Footer() {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('times', 'I', 8);
        // Page number
        $this->Cell(0, 10, 'Page ' . $this->getAliasNumPage() . '/' . $this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }
}

// create new PDF document
$pdf = new MYPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Kelompok 13');
$pdf->SetTitle('Data Buku');
$pdf->SetSubject('Data Buku');
$pdf->SetKeywords('TCPDF, PDF, data, buku');

// set default header data
$pdf->setHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
    require_once(dirname(__FILE__) . '/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// set font
$pdf->SetFont('times', '', 12);

// add a page
$pdf->AddPage();

// Connect to the database
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'website_perpustakaan';
$connect = mysqli_connect($host, $user, $password, $database);

// Memeriksa koneksi
if (!$connect) {
    die("Connection failed: " . mysqli_connect_error());
}

// Membuat kueri SQL untuk mengambil data buku
$query = "SELECT * FROM buku";
$result = mysqli_query($connect, $query);

// Memeriksa hasil kueri
if (!$result) {
    die("Query failed: " . mysqli_error($connect));
}

// Membuat tabel untuk data buku
$html = '<table border="1" cellpadding="5" cellspacing="0">
            <thead>
                <tr bgcolor="#0E46A3" color="#FFFFFF">
                    <th>No</th>
                    <th>Judul Buku</th>
                    <th>Penulis</th>
                    <th>Penerbit</th>
                    <th>Tahun Terbit</th>
                    <th>Image</th>
                    <th>Di Input Pada</th>
                </tr>
            </thead>
            <tbody>';
$rowNumber = 1;
while ($row = mysqli_fetch_array($result)) {
    $html .= '<tr>
                <td>' . $rowNumber . '</td>
                <td>' . $row['judul_buku'] . '</td>
                <td>' . $row['penulis'] . '</td>
                <td>' . $row['penerbit'] . '</td>
                <td>' . $row['tahun_terbit'] . '</td>
                <td><img src="../../uploaded_img/' . $row['image'] . '" alt="image" width="50"></td>
                <td>' . date('d/m/Y H:i', strtotime($row['created_at'])) . '</td>
            </tr>';
    $rowNumber++;
}
$html .= '</tbody></table>';

// Menambahkan tabel ke halaman PDF
$pdf->writeHTML($html, true, false, true, false, '');

// Menutup koneksi database
mysqli_close($connect);

// Menutup dokumen dan mengirim ke browser
$pdf->Output('Data_Buku.pdf', 'I');
?>
