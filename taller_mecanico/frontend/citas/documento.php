<?php 
session_start();
require '../../backend/fpdf/fpdf.php';
date_default_timezone_set('America/Lima');
class PDF extends FPDF
{
    // Cabecera de página
   

    function Header()
{

    $this->setY(12);
    $this->setX(10);
    $this->Image('../../backend/img/ico.png',25,5,33);
    $this->SetFont('times', 'B', 13);
    $this->Text(75, 15, utf8_decode('Taller Mecanico'));
    $this->Text(75, 20, utf8_decode('Mecanico): '.$_SESSION['name'].''));
    $this->Text(75,25, utf8_decode('Tel: 7785-8223'));
    $this->Text(75,30, utf8_decode('CentroReparaciones@gmail.com'));
    
    
    $this->Image('../../backend/img/neu.png',160,5,33);


//información de # de factura

 // Agregamos los datos del cliente
    $this->SetFont('Arial','B',10);    
    $this->Text(10,48, utf8_decode('Fecha:'));
    $this->SetFont('Arial','',10);    
    $this->Text(25,48, date('d/m/Y'));


    // Agregamos los datos de la factura
    $this->SetFont('Arial','B',10);    
    $this->Text(10,54, utf8_decode('Mécanico'));
    $this->SetFont('Arial','',10);    
    $this->Text(30,54, $_SESSION['name']);



    
    $this->Ln(50);


       
}

function Footer()
{
     $this->SetFont('helvetica', 'B', 8);
        $this->SetY(-15);
        $this->Cell(95,5,utf8_decode('Página ').$this->PageNo().' / {nb}',0,0,'L');
        $this->Cell(95,5,date('d/m/Y | g:i:a') ,00,1,'R');
        $this->Line(10,287,200,287);
        $this->Cell(0,5,utf8_decode("TallerMecanico © Todos los derechos reservados."),0,0,"C");
        
}

}
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();

$pdf->SetAutoPageBreak(true, 20);
$pdf->SetTopMargin(15);
$pdf->SetLeftMargin(10);
$pdf->SetRightMargin(10);

$pdf->setY(60);$pdf->setX(135);
    $pdf->Ln();
 // En esta parte estan los encabezados
 
   

$pdf->SetFont('Arial','B',10);
    
    $pdf->Cell(70, 7, utf8_decode('Especialidad'),1,0,'C',0);
    $pdf->Cell(55, 7, utf8_decode('Cliente'),1,0,'C',0);

    $pdf->Cell(70, 7, utf8_decode('Fecha'),1,1,'C',0);
   
    $pdf->SetFont('Arial','',10);

    //Aqui inicia el for con todos los productos

    


    require '../../backend/bd/Conexion.php';
    $id = $_GET['id'];
    $stmt = $connect->prepare("SELECT citas.id, citas.title, clientes.idpa, clientes.numhs,clientes.nompa, clientes.apepa, mecanicos.idodc, mecanicos.ceddoc, mecanicos.nodoc, mecanicos.apdoc, especialidades.idlab, especialidades.nomlab, citas.start, citas.end, citas.color, citas.state,citas.chec,citas.monto FROM citas INNER JOIN clientes ON citas.idpa = clientes.idpa INNER JOIN mecanicos ON citas.idodc = mecanicos.idodc INNER JOIN especialidades ON citas.idlab = especialidades.idlab WHERE citas.id= '$id'");
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$stmt->execute();

while($row = $stmt->fetch()){


    $pdf->Cell(70, 7, utf8_decode($row['title']),1,0,'L',0);
    $pdf->Cell(55, 7, utf8_decode($row['nompa']),1,0,'L',0);

    $pdf->Cell(70, 7, utf8_decode($row['start'] ."\n".  $row['end']),1,1,'R',0);
    
   



}

    $pdf->Output('boleta.pdf', 'D');
 ?>