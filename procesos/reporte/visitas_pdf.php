<?php
include("../conexion.php");

require_once('TCPDF/tcpdf.php'); 

class MYPDF extends TCPDF {


    public function Header() {
        // Logo
        $image_file = "../assets/images/ico.png";
        $this->Image($image_file, 20, 5, 170, 21, 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        
    }

    // Page footer
    // public function Footer() {
    //     // Logo
    //     $image_file = "../images/footer.png";
    //     // Position at 15 mm from bottom
    //     $this->SetY(-15);
    //     // Set font
    //     $this->Image($image_file, 20,  $this->SetY(-40), 180, 30, 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        
    // }
}

$pdf = new MYPDF('P', 'mm', 'A4');

$margin = 15;
$pdf->SetAutoPageBreak(true, $margin);
$pdf->SetMargins(15, $margin);
$pdf->SetHeaderMargin($margin);

$pdf->AddPage(); 

    $fechai = $_REQUEST['fechai'];
    $fechaf = $_REQUEST['fechaf'];

$pdf->SetFont('helvetica', '', 10); 
$html = ' ';
$html .= '<table cellpadding="2">';
$html .= '<tr>';
$html .= '<th colspan="2" style="text-align: center; border: 1px solid black;"><strong>REPORTE DE CLIENTES</strong></th>';
$html .= '</tr>';

$pdf->SetFont('helvetica', '', 8); 
    // $html .= '<tr>';
    // $html .= '<th colspan="2"style="text-align: right;"><strong>Tipo habitacion: </strong>'.$tiponombre.'</th>';
    // $html .= '</tr>';

    // $html .= '<tr>';
    // $html .= '<th colspan="2"style="text-align: right;"><strong>Tipo de reserva : </strong>'.$tiporeserva.'</th>';
    // $html .= '</tr>';

    // $html .= '<tr>';
    // $html .= '<th colspan="2"style="text-align: right;"><strong>Fecha reserva desde: </strong>'.$fechai.'</th>';
    // $html .= '</tr>';
    // $html .= '<tr>';
    // $html .= '<th colspan="2"style="text-align: right;"><strong>Fecha reserva hasta: </strong>'.$fechaf.'</th>';
    // $html .= '</tr>';


$html .= '</table>';
$html .= '<br>';
$html .= '<br>';

$html .= '<table cellpadding="2" style="text-align: center; border: 1px solid black;">';
$html .= '<tr>';
$html .= '<th><strong>Cedula</strong></th>';
$html .= '<th><strong>Cliente</strong></th>';
$html .= '<th><strong>Telefono</strong></th>';
$html .= '<th><strong>Nro. Visitas</strong></th>';
$html .= '</tr>';

        $sql = "SELECT CONCAT(c.tipo_cliente, '', c.cedula) as 
                cedula, CONCAT(c.nombre, ' ', c.apellido) as cliente, c.telefono, 
                count(r.id_cliente) as visitas FROM reservacion r 
                JOIN cliente c ON c.id = r.id_cliente WHERE 1";

        if($fechai != '' && $fechaf != ''){
            $sql .= " AND (DATE_FORMAT(r.fecha_reserva, '%d/%m/%Y') BETWEEN DATE_FORMAT('$fechai', '%d/%m/%Y') AND DATE_FORMAT('$fechaf', '%d/%m/%Y'))";
        }

        $sql.= " GROUP BY r.id_cliente ORDER BY visitas";


        $result = $mysqli->query($sql);
        while($row = $result->fetch_assoc()){
            $html .= '<tr>';
            $html .= '<th>'.$row['cedula'].'</th>';
            $html .= '<th>'.$row['cliente'].'</th>';
            $html .= '<th>'.$row['telefono'].'</th>';
            $html .= '<th>'.$row['visitas'].'</th>';
            
            $html .= '</tr>';

        }

$html .= '</table>';
$html .= '<br>';
$pdf->writeHTML($html, true, 0, true, 0); 
 

$pdf->Output('reporte_reservas.pdf', 'I');


?>