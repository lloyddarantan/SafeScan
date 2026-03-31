<?php
require_once __DIR__ . '/../lib/fpdf186/fpdf.php';

class PDFService extends FPDF {

    function header() {
        $logoPath = __DIR__ . '/../../public/assets/img/logo.jpg';
            if (file_exists($logoPath)) {
                $this->Image($logoPath, 10, 8, 20);
            }
        $this->SetX(35);
        $this->SetFont('Arial', 'B', 14);
        $this->Cell(0, 10, 'SafeScan Report', 0, 1, 'C');

        $this->Ln(10);
    }

    function footer() {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Page ' . $this->PageNo(), 0, 0, 'C');
    }

    function usersTable($users) {
        $this->SetFont('Arial', 'B', 10);

        $this->Cell(50, 8, 'Name', 1);
        $this->Cell(30, 8, 'Role', 1);
        $this->Cell(50, 8, 'Location', 1);
        $this->Cell(40, 8, 'Joined', 1);
        $this->Ln();

        $this->SetFont('Arial', '', 9);

        foreach ($users as $u) {
            $this->Cell(50, 8, $u['name'], 1);
            $this->Cell(30, 8, $u['role'], 1);
            $this->Cell(50, 8, $u['loc'], 1);
            $this->Cell(40, 8, $u['joined'], 1);
            $this->Ln();
        }
    }

    function appliancesTable($apps) {
        $this->SetFont('Arial', 'B', 10);

        $this->Cell(40, 8, 'Brand', 1);
        $this->Cell(40, 8, 'Type', 1);
        $this->Cell(30, 8, 'Category', 1);
        $this->Cell(30, 8, 'Watt', 1);
        $this->Cell(50, 8, 'Consumption', 1);
        $this->Ln();

        $this->SetFont('Arial', '', 9);

        foreach ($apps as $a) {
            $this->Cell(40, 8, $a['brand'], 1);
            $this->Cell(40, 8, $a['type'], 1);
            $this->Cell(30, 8, $a['category'], 1);
            $this->Cell(30, 8, $a['watt'], 1);
            $this->Cell(50, 8, $a['cons'], 1);
            $this->Ln();
        }
    }
}