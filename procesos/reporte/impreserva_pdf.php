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

$reserva = $_REQUEST['reserva'];

$pdf->SetFont('helvetica', '', 11); 
$html = ' ';
$html .= '<table cellpadding="2">';
$html .= '<tr>';
$html .= '<th colspan="2" style="text-align: center; border: 1px solid black;"><strong>RESERVA</strong></th>';
$html .= '</tr>'; 
$html .= '</table>';
$html .= '<br>';
$html .= '<br>';


    $sql = "SELECT CONCAT(c.nombre, ' ', c.apellido) as cliente, CONCAT(c.tipo_cliente, c.cedula) as cedula, 
        h.numero, t.nombre as tipohabitacion, r.precio_total, r.tipo_reserva, v.placa, v.modelo, c.telefono,
        DATE_FORMAT(r.fecha_reserva, '%d/%m/%Y') as fecha_reserva, 
        DATE_FORMAT(r.fecha_finalizacion, '%d/%m/%Y') as fecha_finalizacion, h.maxpersona
        FROM reservacion r
        JOIN cliente c ON c.id = r.id_cliente
        LEFT JOIN vehiculo v ON v.id = c.id
        JOIN habitacion h ON h.id = r.id_habitacion
        JOIN tipo_habitacion t ON t.id = h.id_tipo_habitacion
        WHERE r.id=$reserva";

        $result = $mysqli->query($sql);
        while($row = $result->fetch_assoc()){
            $html .= '<table cellpadding="2" style="border: 1px solid black;">';
            $html .= '<tr>';
            $html .= '<th><strong>Habitacion:</strong> #'.$row['numero'].'</th>';
            $html .= '<th><strong>Nombre cliente:</strong> '.$row['cliente'].'</th>';
            $html .= '</tr>';
            $html .= '<tr>';
            $html .= '<th><strong>Tipo habitacion:</strong> '.$row['tipohabitacion'].'</th>';
            $html .= '<th><strong>Cedula cliente:</strong> '.$row['cedula'].'</th>';
            $html .= '</tr>';

            $html .= '<tr>';
            $html .= '<th><strong>Tipo reserva:</strong> '.$row['tipo_reserva'].'</th>';
            $html .= '<th><strong>Telefono cliente:</strong> '.$row['telefono'].'</th>';
            $html .= '</tr>';

            $html .= '<tr>';
            $html .= '<th><strong>Fecha reserva: </strong>'.$row['fecha_reserva'].'</th>';
            $html .= '<th><strong>¿Tiene vehiculo? </strong>'.(!empty($row['placa']) ? 'SI': 'NO').'</th>';
            $html .= '</tr>';

            $html .= '<tr>';
            $html .= '<th><strong>Fecha finalizacion: </strong>'.$row['fecha_finalizacion'].'</th>';
            $html .= '<th><strong>Placa: </strong>'.(!empty($row['placa']) ? $row['placa']: '---').'</th>';
            $html .= '</tr>';

            $html .= '<tr>';
            $html .= '<th><strong>Maximo de personas: </strong>'.$row['maxpersona'].'</th>';
            $html .= '<th><strong>Modelo: </strong>'.(!empty($row['modelo']) ? $row['modelo']: '---').'</th>';
            $html .= '</tr>';

            $html .= '<tr>';
            $html .= '<th></th>';
            $html .= '<th style="text-align: right;"><strong>Subtotal: </strong>'.number_format(($row['precio_total']-$row['precio_total']*0.16), 2).' Bs.</th>';
            $html .= '</tr>';

            $html .= '<tr>';
            $html .= '<th></th>';
            $html .= '<th style="text-align: right;"><strong>IVA (16%): </strong>'.number_format($row['precio_total']*0.16, 2).' Bs.</th>';
            $html .= '</tr>';

            $html .= '<tr>';
            $html .= '<th></th>';
            $html .= '<th style="text-align: right;"><strong>Total : </strong>'.number_format($row['precio_total'], 2).' Bs.</th>';
            $html .= '</tr>';
            
            $html .= '</table>';
            

        }

        $html .= '<br>';
        $html .= '<br>';
        $html .= '<table cellpadding="2">';
        $html .= '<tr>';
        $html .= '<th colspan="2" style="text-align: center; border: 1px solid black;"><strong>ACOMPAÑANTES</strong></th>';
        $html .= '</tr>'; 
        $html .= '</table>';
        $html .= '<br>';
        $html .= '<br>';

        $sql = "SELECT * FROM acompanante WHERE id_reserva=$reserva";

        $result = $mysqli->query($sql);
         $html .= '<table style="text-align: center; border: 1px solid black;">';
            $html .= '<tr>';
            $html .= '<th><strong>#</strong></th>';
            $html .= '<th><strong>Nombre</strong></th>';
            $html .= '<th><strong>Apellido</strong></th>';
            $html .= '<th><strong>Telefono</strong></th>';
            $html .= '</tr>';
            
        while($row = $result->fetch_assoc()){
            $cont = 1;
            $html .= '<tr>';
            $html .= '<td>'.$cont.'</td>';
            $html .= '<td>'.$row['nombre'].'</td>';
            $html .= '<td>'.$row['apellido'].'</td>';
            $html .= '<td>'.$row['telefono'].'</td>';
            $html .= '</tr>';
            $cont++;

        }
        $html .= '</table>';  


    

$html .= '<br>';
$pdf->writeHTML($html, true, 0, true, 0); 
 

$pdf->Output('reporte_reservas.pdf', 'I');


?>