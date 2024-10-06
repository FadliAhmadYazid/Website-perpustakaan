<?php
require_once "../../koneksi.php";
require_once('../../tcpdf/tcpdf.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $selectedUsers = isset($_POST['selected_users']) ? $_POST['selected_users'] : '';
    $query = "";

    if (!empty($selectedUsers)) {
        $ids = explode(',', $selectedUsers);
        $ids = array_map('intval', $ids); // Sanitize the IDs to be integers
        $query = "SELECT * FROM user WHERE id IN (" . implode(',', $ids) . ")";
    } else {
        $query = "SELECT * FROM user";
    }

    $result = mysqli_query($connect, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        // Create new PDF document with landscape orientation
        $pdf = new TCPDF('L', PDF_UNIT, 'A4', true, 'UTF-8', false);

        // Set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Your Name');
        $pdf->SetTitle('Data Pengguna');
        $pdf->SetSubject('TCPDF Tutorial');
        $pdf->SetKeywords('TCPDF, PDF, example, test, guide');

        // Set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // Set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        // Set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        // Set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // Add a page
        $pdf->AddPage();

        // Set font
        $pdf->SetFont('helvetica', '', 12);

        // HTML content with table styles
        $html = '<h2 style="text-align: center;">Data Pengguna</h2>';
        $html .= '<table border="1" cellspacing="0" cellpadding="4">';
        $html .= '<thead style="background-color:#f2f2f2;color:#000;">
                    <tr>
                        <th style="background-color:#d3d3d3;">No</th>
                        <th style="background-color:#d3d3d3;">Nama Lengkap</th>
                        <th style="background-color:#d3d3d3;">Alamat</th>
                        <th style="background-color:#d3d3d3;">Telepon</th>
                        <th style="background-color:#d3d3d3;">Username</th>
                        <th style="background-color:#d3d3d3;">Password</th>
                        <th style="background-color:#d3d3d3;">Email</th>
                        <th style="background-color:#d3d3d3;">Otoritas</th>
                        <th style="background-color:#d3d3d3;">Dibuat Pada</th>
                    </tr>
                  </thead>';
        $html .= '<tbody>';
        $no = 1;
        while ($row = mysqli_fetch_assoc($result)) {
            $html .= '<tr>';
            $html .= '<td>' . $no++ . '</td>';
            $html .= '<td>' . htmlspecialchars($row['nama_lengkap']) . '</td>';
            $html .= '<td>' . htmlspecialchars($row['alamat']) . '</td>';
            $html .= '<td>' . htmlspecialchars($row['telepon']) . '</td>';
            $html .= '<td>' . htmlspecialchars($row['username']) . '</td>';
            $html .= '<td>' . htmlspecialchars($row['password']) . '</td>';
            $html .= '<td>' . htmlspecialchars($row['email']) . '</td>';
            $html .= '<td>' . htmlspecialchars($row['otoritas']) . '</td>';
            $html .= '<td>' . date('d/m/Y H:i', strtotime($row['created_at'])) . '</td>';
            $html .= '</tr>';
        }
        $html .= '</tbody>';
        $html .= '</table>';

        // Output the HTML content
        $pdf->writeHTML($html, true, false, true, false, '');

        // Close and output PDF document
        $pdf->Output('data_pengguna.pdf', 'I');
    } else {
        echo "No users found.";
    }
} else {
    echo "Invalid request method.";
}
?>
