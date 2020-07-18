<?php

require'framework/fpdf/mc_table.php';

class LEB extends PDF_MC_Table {

    function Header() {
        if (file_exists('cpt.txt')) {
            $cpt = fopen('cpt.txt', 'r+');
            $nbre = fgets($cpt);
        } else {
            $cpt = fopen('cpt.txt', 'r+');
            $nbre = 0;
        }

        $nbre += 1;
        fseek($cpt, 0);
        fputs($cpt, $nbre);
        fclose($cpt);
        $nbre = "0000" . $nbre;

        $this->SetY(8);
        $this->SetFont("times", "B", 19);
        $this->Cell(80, 10, "29 HECTARES", 0, 1, "L");
        $this->SetFont("times", "B", 10);
        $y = $this->GetY();
        $this->SetXY(8, $y - 3);
        $this->Cell(80, 5, strtoupper(utf8_decode("entreprise immobiliÈre")), 0, 1, "L");
        $this->SetFont("times", "", 10);
        $y = $this->GetY();
        $this->SetXY(17, $y + 3);
        $this->Cell(80, 5, utf8_decode("ANNÉE D'EXERCICE: " . (intval(date('Y')) - 1) . " - " . date('Y')), 0, 0, "C");
        $this->Cell(80, 5, strtoupper(utf8_decode("REÇU N°: $nbre")), 0, 1, "L");
        $this->SetFont("times", "B", 8);
        $this->SetY($this->GetY() - 17);
        $this->SetX(150);
        $this->MultiCell(50, 5, utf8_decode("* Vente de Terrains\n* Vente de Maisons\n* Paiement par Échéance"));

        $this->SetFont("times", "", 8);
        $this->SetLineWidth(0.5);
        $this->Line(2, $this->GetY() + 3, 200, $this->GetY() + 3);
        $this->Ln();
    }

}

$pdf = new LEB();
$pdf->AddPage();
$pdf->SetTitle(utf8_decode("recu de paiement"), true);
$pdf->SetFont("times", "b", 20);
$pdf->SetLineWidth(1);
$pdf->Cell(180, 10, utf8_decode("REÇU DE PAIEMENT"), 1, 1, "C");
$y = $pdf->GetY();
$pdf->SetY($y + 2);
$pdf->SetLineWidth(0.1);
$pdf->SetFont("times", "B", 10);
$pdf->SetFillColor(58, 135, 228);
$pdf->SetTextColor(255, 255, 255);
$pdf->Cell(90, 7, utf8_decode(" IDENTIFICATION DU CLIENT"), 1, 1, "C", TRUE);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont("times", "", 10);
$y = $pdf->GetY();
$pdf->SetY($y + 2);

$pdf->SetY($pdf->GetY() + 2);
$pdf->Cell(25, 5, strtoupper("matricule :"), 0, 0, "L");
$pdf->SetX($pdf->GetX());
$pdf->Cell(40, 5, $matricule, 0, 0, "");
$x = $pdf->GetX();
$a1 = $x + 75;
$pdf->SetX($a1);
$pdf->Cell(35, 5, strtoupper("montant Total :"), 0, 0, "");
$pdf->SetX($pdf->GetX());
$pdf->Cell(30, 5, $prix, 0, 1, "");

$pdf->SetY($pdf->GetY() + 2);
$pdf->Cell(33, 5, strtoupper("Nom & Prenoms :"), 0, 0, "L");
$pdf->SetX($pdf->GetX());
$pdf->Cell(40, 5, utf8_decode(ucwords($nom_prenom)), 0, 0, "");
$x = $pdf->GetX();
$pdf->SetX($a1);
$pdf->Cell(35, 5, strtoupper(utf8_decode("PayÉ :")), 0, 0, "");
$pdf->SetX($pdf->GetX());
$pdf->Cell(30, 5, $verse, 0, 1, "");


$pdf->SetY($pdf->GetY() + 2);
$pdf->Cell(51, 5, strtoupper(utf8_decode("RÉfÉrence de commande :")), 0, 0, "L");
$pdf->SetX($pdf->GetX());
$pdf->Cell(40, 5, strtoupper(utf8_decode($numero_commande)), 0, 0, "");
$pdf->SetX($a1);
$pdf->Cell(35, 5, strtoupper(utf8_decode("Reste À Payer :")), 0, 0, "");
$pdf->SetX($pdf->GetX());
$pdf->Cell(30, 5, strtoupper(utf8_decode($reste)), 0, 1, "");

$pdf->Ln();
$pdf->SetFont("times", "I", "");
$pdf->Cell(30, 5, utf8_decode("Montant Payé (En toute lettre ) :"), 0, 1, "");
$pdf->SetLineWidth(0.1);
$pdf->SetFont("times", "B", "");
$pdf->SetDrawColor(58, 135, 228);
$pdf->SetFillColor(203, 214, 243);
$pdf->SetTextColor(255, 255, 255);
$pdf->Cell(190, 10, utf8_decode($enlettre->Conversion($verse)), "TB", 1, "C", TRUE);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetDrawColor(0, 0, 0);
$pdf->SetFont("times", "", 10);

$pdf->Ln();
$pdf->SetFont("times", "", 10);
$pdf->Cell(15, 5, utf8_decode("Objet :"), 0, 0, "");
$pdf->SetLineWidth(0.1);
$pdf->SetFont("times", "B", "");
$pdf->MultiCell(150, 4, utf8_decode("Possession de ".$type."\n".$details), 1, "C");
$pdf->SetFont("times", "", 10);

$pdf->Ln();
$pdf->SetFont("times", "I", "");
$pdf->Cell(190, 5, utf8_decode("Aucun remboursement n'est valable après payement."), 0, 1, 'C');
$pdf->Cell(190, 3, '........................................................................................................................................................................................', 0, 1, 'C');

$pdf->Output("", "recu_versement.pdf", true);
ob_end_flush();
?>