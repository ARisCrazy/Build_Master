<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "wp_project";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to generate invoice for a specific customer
function generateInvoice($conn, $customer_id) {
    // Retrieve customer's orders from the database
    $sql = "SELECT * FROM product_details WHERE userid='$customer_id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Initialize variables to store invoice content
        $invoice_content = "";

        // Format invoice content with order details
        while ($row = $result->fetch_assoc()) {
            // Format each order detail
            $order_detail = "Product: " . $row["model_name"] . ", Price: $" . $row["total_price"] . "\n";
            // Append order detail to invoice content
            $invoice_content .= $order_detail;
        }

        // Create PDF document using TCPDF or FPDF
        require_once('tcpdf/tcpdf.php');
        $pdf = new TCPDF();
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Your Company');
        $pdf->SetTitle('Invoice');
        $pdf->SetSubject('Invoice');
        $pdf->SetKeywords('Invoice, PDF');
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
        $pdf->SetFont('helvetica', '', 10);
        $pdf->AddPage();
        // Add invoice content to the PDF
        $pdf->writeHTML($invoice_content);
        // Output the PDF as a downloadable file
        $pdf->Output('invoice.pdf', 'D');
    } else {
        echo "No orders found for this customer.";
    }
}

// Call the function to generate invoice for a specific customer (replace 'CUSTOMER_ID' with the actual customer ID)
generateInvoice($conn, 'CUSTOMER_ID');

// Close the database connection
$conn->close();
?>
