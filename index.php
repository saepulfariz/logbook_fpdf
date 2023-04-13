<?php
require('fpdf.php');

class PDF extends FPDF
{
    function cellMultiColor($stringParts)
    {
        $currentPointerPosition = 87;
        // $this->Cell(10);
        foreach ($stringParts as $part) {
            // Set the pointer to the end of the previous string part
            $this->SetX($currentPointerPosition);

            // Get the color from the string part
            $this->SetTextColor($part['color'][0], $part['color'][1], $part['color'][2]);

            $this->Cell($this->GetStringWidth($part['text']), 5, $part['text'], 0, 0, 'C');

            // Update the pointer to the end of the current string part
            $currentPointerPosition += $this->GetStringWidth($part['text']);
        }
    }
    // Page header
    function Header()
    {
        // Logo
        $this->Image('unsub.png', 10, 6, 30);
        // Move to the right
        $this->Cell(70);
        // Title
        // $this->Cell(30, 10, 'Title', 1, 0, 'C');
        $this->SetFont('Times', '', 15);
        // Output justified text
        $this->MultiCell(0, 5, 'UNIVERSITAS SUBANG');
        // Line break
        $this->Ln(2);

        $this->Cell(10);
        $this->SetFont('Times', 'B', 19);
        // Output justified text
        $this->Cell(0, 5, 'FAKULTAS ILMU KOMPUTER', 0, 0, 'C');
        // Line break
        $this->Ln(6);

        $this->Cell(7);
        $this->SetFont('Times', 'B', 11);
        // Output justified text
        $this->Cell(0, 5, 'Akreditasi: B SK BAN PT No: 6453/SK/BAN-PT/Akred/S/X/2020', 0, 0, 'C');
        // Line break
        $this->Ln(6);

        $this->Cell(10);
        $this->SetFont('Times', '', 11);
        // Output justified text
        $this->Cell(0, 5, 'Jalan R.A Kartini KM 3 Telp (0260) 411415 Subang', 0, 0, 'C');
        // Line break
        $this->Ln(6);

        // $this->Cell(10);
        $this->SetFont('Times', '', 11);
        // Output justified text
        // $this->Cell(0, 5, 'E-Mail : fasilkom@unsub.ac.id', 0, 0, 'C');

        // $this->Cell(0, 5, 'E-Mail :', 0, 0, 'C');

        // $this->Cell(0, 5, , 0, 0, 'C');
        $this->SetX(100);
        $this->cellMultiColor([
            [
                'text' => 'Email :',
                'color' => [0, 0, 0],
            ],
            [
                'text' => 'fasilkom@unsub.ac.id',
                'color' => [0, 0, 255],
            ],
        ]);

        // $this->SetXY(10, 10);
        // $this->SetTextColor(0, 0, 255);
        // $this->Cell(0, 5, 'fasilkom@unsub.ac.id');

        // $this->Cell(5);
        // $this->Cell(0, 5, 'fasilkom@unsub.ac.id', 0, 0, '');
        $this->Link(0, 0, 0, 0, 'mailto:fasilkom@unsub.ac.id');

        $this->SetTextColor(0, 0, 0);

        // $coordXbase = 0;
        // $coordY = 0;

        // //Printing my cell      
        // $this->SetFont('Arial', 'B');
        // $this->Cell(55, 5, "Black Text ", 1, 0, 'C');
        // $this->SetXY($coordXbase, $coordY);

        // //Setting the text color to red
        // $this->SetTextColor(194, 8, 8);

        // //Printing another cell, over the other
        // $this->SetFont('Arial', 'B');
        // //Give some space from the left border, and print the red text after the black text that is in the cell behind this one.
        // $this->Cell(55, 5, "                        Red Text", 0, 0, 'C');
        // $this->SetXY($coordXbase, $coordY);

        // //Setting the text color back to back, in the next cells.
        // $this->SetTextColor(0, 0, 0);

        // Line break
        $this->Ln(6);

        $width = $this->GetPageWidth(); // Width of Current Page
        $height = $this->GetPageHeight(); // Height of Current Page

        $this->SetLineWidth(1);
        $this->Line(0, 43, $this->w, 43);

        // $this->Line(100, 0, 0, 0);
        // Line break
        $this->Ln(10);
    }

    // Page footer
    function Footer()
    {
        // Position at 1.5 cm from bottom
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial', 'I', 8);
        // Page number
        $this->Cell(0, 10, 'Page ' . $this->PageNo() . '/{nb} | By Saepulfariz', 0, 0, 'C');
    }

    // Better table
    function ImprovedTable($header, $data)
    {
        // Column widths
        $w = array(7, 20, 15, 15, 110, 20);
        $h = 15;
        // Header
        for ($i = 0; $i < count($header); $i++) {

            $this->SetFont('Times', 'B');
            $this->Cell($w[$i], $h, $header[$i], 1, 0, 'C');
        }
        $this->SetFont('Times', '');
        $this->Ln();
        // Data

        $h = 15;

        $line_height = 5;
        foreach ($data as $row) {
            $this->Cell($w[0], $h, $row[0], 'LRTB', 0, 'C');
            $this->Cell($w[1], $h, $row[1], 'LRTB', 0, 'C');
            $this->Cell($w[2], $h, $row[2], 'LRTB', 0, 'C');
            $this->Cell($w[3], $h, $row[3], 'LRTB', 0, 'C');
            $this->Cell($w[4], $h, $row[4], 'LRTB', 0, 'C');
            $this->Cell($w[5], $h, $row[5], 'LRTB', 0, 'C');

            // $height = (ceil(($this->GetStringWidth($row[0]) / $w[0])) * $line_height);
            // $this->Cell($w[0], $height, $row[0], 'LRTB', 0, 'C');

            // $height = (ceil(($this->GetStringWidth($row[1]) / $w[1])) * $line_height);
            // $this->Cell($w[1], $height, $row[1], 'LRTB', 0, 'C');

            // $height = (ceil(($this->GetStringWidth($row[2]) / $w[2])) * $line_height);
            // $this->Cell($w[2], $height, $row[2], 'LRTB', 0, 'C');

            // $height = (ceil(($this->GetStringWidth($row[3]) / $w[3])) * $line_height);
            // $this->Cell($w[3], $height, $row[3], 'LRTB', 0, 'C');

            // $height = (ceil(($this->GetStringWidth($row[4]) / $w[4])) * $line_height);
            // $this->Cell($w[4], $height, $row[4], 'LRTB', 0, 'C');

            // $height = (ceil(($this->GetStringWidth($row[5]) / $w[5])) * $line_height);
            // $this->Cell($w[5], $height, $row[5], 'LRTB', 0, 'C');

            // $this->CellFit(30,20,"This is long string message.",1,0,'C',0,'',1,0);
            $this->Ln();
        }
        // Closing line
        $this->Cell(array_sum($w), 0, '', 'T');
    }

    // Simple table
    function BasicTable($header, $data)
    {
        // Header
        $width = 30;
        foreach ($header as $col)
            $this->Cell($width, 7, $col, 1);
        $this->Ln();
        // Data
        foreach ($data as $row) {
            foreach ($row as $col)
                $this->Cell($width, 6, $col, 1);
            $this->Ln();
        }
    }


    // Load data
    function LoadData($file)
    {
        // Read file lines
        $lines = file($file);
        $data = array();
        foreach ($lines as $line)
            $data[] = explode(';', trim($line));
        return $data;
    }


    protected $B = 0;
    protected $I = 0;
    protected $U = 0;
    protected $HREF = '';

    function WriteHTML($html)
    {
        // HTML parser
        $html = str_replace("\n", ' ', $html);
        $a = preg_split('/<(.*)>/U', $html, -1, PREG_SPLIT_DELIM_CAPTURE);
        foreach ($a as $i => $e) {
            if ($i % 2 == 0) {
                // Text
                if ($this->HREF)
                    $this->PutLink($this->HREF, $e);
                else
                    $this->Write(5, $e);
            } else {
                // Tag
                if ($e[0] == '/')
                    $this->CloseTag(strtoupper(substr($e, 1)));
                else {
                    // Extract attributes
                    $a2 = explode(' ', $e);
                    $tag = strtoupper(array_shift($a2));
                    $attr = array();
                    foreach ($a2 as $v) {
                        if (preg_match('/([^=]*)=["\']?([^"\']*)/', $v, $a3))
                            $attr[strtoupper($a3[1])] = $a3[2];
                    }
                    $this->OpenTag($tag, $attr);
                }
            }
        }
    }

    function OpenTag($tag, $attr)
    {
        // Opening tag
        if ($tag == 'B' || $tag == 'I' || $tag == 'U')
            $this->SetStyle($tag, true);
        if ($tag == 'A')
            $this->HREF = $attr['HREF'];
        if ($tag == 'BR')
            $this->Ln(5);
    }

    function CloseTag($tag)
    {
        // Closing tag
        if ($tag == 'B' || $tag == 'I' || $tag == 'U')
            $this->SetStyle($tag, false);
        if ($tag == 'A')
            $this->HREF = '';
    }

    function SetStyle($tag, $enable)
    {
        // Modify style and select corresponding font
        $this->$tag += ($enable ? 1 : -1);
        $style = '';
        foreach (array('B', 'I', 'U') as $s) {
            if ($this->$s > 0)
                $style .= $s;
        }
        $this->SetFont('', $style);
    }

    function PutLink($URL, $txt)
    {
        // Put a hyperlink
        $this->SetTextColor(0, 0, 255);
        $this->SetStyle('U', true);
        $this->Write(5, $txt, $URL);
        $this->SetStyle('U', false);
        $this->SetTextColor(0);
    }
}

// Instanciation of inherited class
$pdf = new PDF();
$pdf->SetTitle('LOGBOOK PROYEK INDEPENDEN BY SAEPULFARIZ', true);
$pdf->SetAuthor('Saepulfariz', true);
$pdf->SetCreator('Saepulfariz', true);
$pdf->SetSubject('Logbook Gabut By saepulfariz', true);
$pdf->AliasNbPages();
$pdf->AddPage();

// $pdf->Cell(-);
// Title
$pdf->SetX(155);
$pdf->SetFont('Times', 'B');
$pdf->Cell(25, 7, 'FORM', 1, 0, 'C');
$pdf->Cell(25, 7, 'PI-01', 1, 0, 'C');
$pdf->Ln(15);

$pdf->SetFont('Times', 'B', 11);
$pdf->Cell(0, 5, 'LOGBOOK AKTIVITAS HARIAN PROYEK STUDI/PROYEK INDEPENDEN', 0, 0, 'C');
$pdf->Ln(10);
$pdf->SetFont('Times', '', 11);
$pdf->Cell(65, 5, 'NAMA ', 0, 0, 'L');
$pdf->Cell(0, 5, ': ................................................................................................', 0, 0, 'L');
$pdf->Ln(7);
$pdf->SetFont('Times', '', 11);
$pdf->Cell(65, 5, 'NPM ', 0, 0, 'L');
$pdf->Cell(0, 5, ': ................................................................................................', 0, 0, 'L');
$pdf->Ln(15);

// Column headings
$header = array('No', 'Tanggal', 'Mulai', 'Selesai', 'Penjelasan Kegiatan', 'Paraf');
// Data loading
$data = $pdf->LoadData('mahasiswa.txt');
$pdf->ImprovedTable($header, $data);


$pdf->WriteHTML('<table border="1"><thead><tr><td>Test</td></tr></thead><tbody></tbody></table>');
// // for ($i = 1; $i <= 40; $i++)
// //     $pdf->Cell(0, 10, 'Printing line number ' . $i, 0, 1);
$pdf->Output();
