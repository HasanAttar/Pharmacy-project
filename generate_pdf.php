<?php
session_start();

require_once('connection.php');
if (isset($_SESSION['pharmacy_name'], $_SESSION['region'], $_SESSION['mobile'])) {
    // Assign session variables to local variables
    $pharmacy_name = $_SESSION['pharmacy_name'];
    $region = $_SESSION['region'];
    $mobileNumber = $_SESSION['mobile'];

    // Proceed with your database query and PDF generation here

    require_once('TCPDF-main/tcpdf.php'); // Include TCPDF library
    // Create new TCPDF instance
    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
    // ob_start();
    
    // Set document information
    $pdf->SetCreator('Your Name');
    $pdf->SetAuthor('Your Name');
    $pdf->SetTitle('Medicine List PDF');
    $pdf->SetSubject('Medicine List');
    $pdf->SetKeywords('Medicine, List, PDF');

    // Add a page
    $pdf->AddPage();

    // Output the table content from the database
    $html = '<h1>Medicine List</h1>';
    $html .= '<table border="1">
                <tr>
                    <th>Name</th>
                    <th>Expiration Date</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Discount</th>
                </tr>';

    // Fetch data from the database
    $result = mysqli_query($con, "SELECT * FROM criticalmedicines WHERE pharmacy_name = '$pharmacy_name' AND Region = '$region' AND pharmacist_mobile = '$mobileNumber'");
    while ($row = mysqli_fetch_assoc($result)) {
        $html .= '<tr>';
        $html .= '<td>' . $row['Name'] . '</td>';
        $html .= '<td>' . $row['Expirationdate'] . '</td>';
        $html .= '<td>' . $row['Quantity'] . '</td>';
        $html .= '<td>' . $row['Price'] . '</td>';
        $html .= '<td>' . $row['Discount'] . '</td>';
        $html .= '</tr>';
    }

    $html .= '</table>';

    // Write the HTML content to PDF
    $pdf->writeHTML($html, true, false, true, false, '');

    // Close and output PDF
    $pdfContent = $pdf->Output('medicine_list.pdf', 'S'); // Output as string
    header('Content-Type: application/pdf'); // Set Content-Type header
    header('Content-Disposition: inline; filename="medicine_list.pdf"'); // Set filename
    echo $pdfContent; // Output PDF content
} else {
    // Handle case where session variables are not set
    echo "Session variables are not set.";
}
// ob_end_clean();
?>
