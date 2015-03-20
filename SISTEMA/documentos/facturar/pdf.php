<?php
include_once('../../fpdf153/fpdf.php');
require('fpdf_alpha.php'); 
class PDF extends FPDF
{
 function Footer(){
        $this->SetY(-15);
        $this->SetFont('Arial','I',8);
        $this->Cell(0,10,'Todo Textil, C.A.','T',0,'C');
    }
 
    function Header(){
        //Define tipo de letra a usar, Arial, Negrita, 15
        $this->SetFont('Arial','',9);
        /* Líneas paralelas
         * Line(x1,y1,x2,y2)
         * El origen es la esquina superior izquierda
         * Cambien los parámetros y chequen las posiciones
         * */
        // $this->Line(10,10,206,10);
        // $this->Line(10,35.5,206,35.5);
        /* Explicaré el primer Cell() (Los siguientes son similares)
         * 30 : de ancho
         * 25 : de alto
         * ' ' : sin texto
         * 0 : sin borde
         * 0 : Lo siguiente en el código va a la derecha (en este caso la segunda celda)
         * 'C' : Texto Centrado
         * $this->Image('images/logo.png', 152,12, 19) Método para insertar imagen
         *     'images/logo.png' : ruta de la imagen
         *         152 : posición X (recordar que el origen es la esquina superior izquierda)
         *         12 : posición Y
         *     19 : Ancho de la imagen <span class="wp-smiley emoji emoji-wordpress" title="(w)">(w)</span>
         *     Nota: Al no especificar el alto de la imagen (h), éste se calcula automáticamente
         * */	 //ancho-alto
        $this->Cell($this->Image('../../images/cabeceraFacJ.jpg', 10, 10, 130,45));
        $this->Cell($this->Image('../../images/rif.jpg', 160, 10, 30,9));
        $this->SetXY(150,20);
  		$this->Cell(0,16,'Forma Libre',120,120,'C');
  		$this->SetFont('Arial','B',11);
  		$this->SetXY(162,26);
		$this->Cell(0,16,utf8_decode('N° de control'));
        //Se da un salto de línea de 25
        // $this->Ln(5);
    }
       
    function cabecera($cabecera){
    	$x=15;
    	$this->SetXY($x,110);

        $this->SetFont('Arial','B',11);
        foreach($cabecera as $columna)
        {
        	if ($columna =='DESCRIPCION'){
        		$a=$a+45;
	        	$this->SetXY($a,110);
	        	$this->Cell(82,7,$columna,1, 2 , 'C' ) ;

        	}elseif ($columna =='P.U.'){
        		$b=$b+127;
	        	$this->SetXY($b,110);
	        	$this->Cell(30,7,$columna,1, 2 , 'C' ) ;

        	}elseif ($columna =='CANTIDAD'){
	        	$this->Cell(30,7,$columna,1, 2 , 'C' ) ;
	            $x=$x+53;
	        	$this->SetXY($x,110);
        	}elseif ($columna =='TOTAL'){
        		$x=$x+89;
	        	$this->SetXY($x,110);
	        	$this->Cell(30,7,$columna,1, 2 , 'C' ) ;

        	}

        }
    }

    // Cargar los datos de la tabla mysql
	function LoadData($idF)
	{
	//incluimos la conexion 
	  $bd_host = "localhost"; 
	  $bd_usuario = "root"; 
	  $bd_password = ""; 
	  $bd_base = "todotex"; 
	 
	$con = mysql_connect($bd_host, $bd_usuario, $bd_password); 
	mysql_select_db($bd_base, $con); 	//redactamos la consulta
	$q = "SELECT idproducto, cantidad, talla FROM facturadetalle WHERE idfactemp = '".$idF."' ";

	$stmt=mysql_query($q);
	while ($fac =mysql_fetch_row($stmt))
	{
		$fac['idproducto'];
	//vaciamos la data en un arreglo
	 $data[]=$fac;
	}
	return $data;
	 
	}
 
    function datos($datos){
 
        $this->SetXY(90,105);
        $this->SetFont('Arial','',12);
        foreach ($datos as $columna)
        {
            $this->Cell(65,7,utf8_decode($columna['Cantidad']),'TRB',2,'L' );
            $this->Cell(80,7,utf8_decode($columna['Descripcion']),'TRB',2,'L' );
            $this->Cell(65,7,utf8_decode($columna['P.U.']),'TRB',2,'L' );
            $this->Cell(65,7,utf8_decode($columna['TOTAL']),'TRB',2,'L' );
        }
    }
 
    //El método tabla integra a los métodos cabecera y datos
    function tabla($cabecera,$datos){
        $this->cabecera ($cabecera) ;
        $this->datos($datos);
    }
}
//fin clase PDF
?> 