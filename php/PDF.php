<?php
require('fpdf/fpdf.php');
 
class PDF extends FPDF
{
    protected $fontName = 'Arial';

    function renderTitle($text) {
        $this->SetTextColor(0, 0, 0);
        $this->SetFont($this->fontName, 'B', 24);
        $this->Cell(100, 0, utf8_decode($text), 0, 1);
        $this->Ln();
    }

    function cabeceraHorizontal($cabecera)
    {
        $this->SetXY(20, 50);
        $this->SetFont('Arial','B',10);
        $this->SetFillColor(2,157,116);//Fondo verde de celda
        $this->SetTextColor(240, 255, 240); //Letra color blanco
        foreach($cabecera as $fila)
        {
            //Atención!! el parámetro true rellena la celda con el color elegido
            $ancho = 35;
            if($fila == 'Nombre'){
                $ancho = 50;
            }
            if($fila == 'Rol'){
                $ancho = 25;
            }
            if(($fila == 'Salon') || ($fila == 'Estado')){
                $ancho = 30;
            }
            $this->Cell($ancho,7, utf8_decode($fila),1, 0 , 'L', true);
        }
    }
 
    function datosHorizontal($datos)
    {
        $this->SetXY(20,57);
        $this->SetFont('Arial','',10);
        $this->SetFillColor(229, 229, 229); //Gris tenue de cada fila
        $this->SetTextColor(3, 3, 3); //Color del texto: Negro
        $bandera = false; //Para alternar el relleno
        $varCount=0;
        foreach($datos as $fila)
        {
            //El parámetro badera dentro de Cell: true o false
            //true: Llena  la celda con el fondo elegido
            //false: No rellena la celda
            if($varCount >= 30){
                $this->AddPage();
                $varCount=-2;
                $this->Image('../images/uts.jpg', null, null, 40);
            }
            $this->SetXY(20,57+($varCount*7));
            $this->Cell(35,7, utf8_decode($fila['fecha']),1, 0 , 'L', $bandera );
            $this->Cell(50,7, utf8_decode($fila['nombre']),1, 0 , 'L', $bandera );
            $this->Cell(25,7, utf8_decode($fila['rol']),1, 0 , 'L', $bandera );
            $this->Cell(30,7, utf8_decode($fila['salon']),1, 0 , 'L', $bandera );
            $this->Cell(30,7, utf8_decode($fila['estado']),1, 0 , 'L', $bandera );
            $this->Ln();//Salto de línea para generar otra fila
            $bandera = !$bandera;//Alterna el valor de la bandera
            $varCount++;
        }
    }
 
    function tablaHorizontal($cabeceraHorizontal, $datosHorizontal)
    {
        $this->cabeceraHorizontal($cabeceraHorizontal);
        $this->datosHorizontal($datosHorizontal);
    }
 
} // FIN Class PDF
?>