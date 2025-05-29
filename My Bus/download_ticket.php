<?php
require("./includes/db.php");
require('fpdf/fpdf.php'); // Make sure you have FPDF installed in your project

if (!isset($_GET['id'])) {
    die("Invalid request");
}

$id = $_GET['id'];
$stmt = $conn->prepare("SELECT * FROM booking WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    die("Ticket not found");
}

$ticket = $result->fetch_assoc();

// Create a PDF
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(190, 10, "Bus Ticket", 1, 1, 'C');
$pdf->Ln(10);
$pdf->SetFont('Arial', '', 12);

$pdf->Cell(50, 10, "Passenger Name:", 1);
$pdf->Cell(140, 10, $ticket['passenger_name'], 1);
$pdf->Ln();

$pdf->Cell(50, 10, "Bus Number:", 1);
$pdf->Cell(140, 10, $ticket['bus_number'], 1);
$pdf->Ln();

$pdf->Cell(50, 10, "Seat Number:", 1);
$pdf->Cell(140, 10, $ticket['seat_number'], 1);
$pdf->Ln();

$pdf->Cell(50, 10, "Email:", 1);
$pdf->Cell(140, 10, $ticket['email'], 1);
$pdf->Ln();

$pdf->Cell(50, 10, "Phone:", 1);
$pdf->Cell(140, 10, $ticket['phone'], 1);
$pdf->Ln();

$pdf->Cell(50, 10, "Total Amount:", 1);
$pdf->Cell(140, 10, "$" . $ticket['total_amount'], 1);
$pdf->Ln();

$pdf->Output("D", "Bus_Ticket.pdf"); // Forces download

?>
