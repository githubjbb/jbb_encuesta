<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reportes extends CI_Controller {
	
    public function __construct() {
        parent::__construct();
		$this->load->model("reportes_model");
		$this->load->library('PHPExcel.php');
    }
	
	/**
	 * Generate Reportes in XLS
     * @since 28/06/2021
     * @author BMOTTAG
	 */
	public function generaReservaFechaXLS()
	{				
			$bandera = $this->input->post('bandera');
			if($bandera == 1 )
			{
				$data['fecha'] = $this->input->post('fecha');
				$fechaEncabezado = 'Fecha: ' . ucfirst(strftime("%b %d, %G",strtotime($data['fecha'])));
				$nombreArchivo = 'encuesta_satisfaccion_' . $data['fecha'] . '.xls';
				$arrParam = array(
					'fecha' => $this->input->post('fecha')
				);
			} else {
				$data['from'] = $this->input->post('from');
				$data['to'] = $this->input->post('to');
				$fechaEncabezado = 'Rango Fechas: ' . ucfirst(strftime("%b %d, %G",strtotime($data['from']))) . ' - ' . ucfirst(strftime("%b %d, %G",strtotime($data['to'])));
				$nombreArchivo = 'encuesta_satisfaccion_' . $data['from'] . '-' . $data['to'] . '.xls';
				$from = $data['from'];
				//le sumo un dia al dia final para que ingrese ese dia en la consulta
				$to = date('Y-m-d',strtotime ( '+1 day ' , strtotime ( $data['to']) ) );
				$arrParam = array(
					'from' => $from,
					'to' => $to
				);
			}
			$listaEncuestas = $this->reportes_model->get_encuesta($arrParam);
			// Create new PHPExcel object	
			$objPHPExcel = new PHPExcel();
			// Set document properties
			$objPHPExcel->getProperties()->setCreator("JBB APP")
										 ->setLastModifiedBy("JBB APP")
										 ->setTitle("Report")
										 ->setSubject("Report")
										 ->setDescription("JBB Report")
										 ->setKeywords("office 2007 openxml php")
										 ->setCategory("Report");
			// Create a first sheet
			$objPHPExcel->setActiveSheetIndex(0);
			$objPHPExcel->getActiveSheet()->setCellValue('A1', 'REGISTROS ENCUESTA DE SATISFACCIÓN - ' . $fechaEncabezado);
			$objPHPExcel->getActiveSheet()->setCellValue('A3', 'ID')
										->setCellValue('B3', 'Fecha')
										->setCellValue('C3', 'Nombre del Servidor Público')
										->setCellValue('D3', 'Rango de edad del encuestado')
										->setCellValue('E3', 'Población - Condición de discapacidad')
										->setCellValue('F3', 'Población - Desplazado')
										->setCellValue('G3', 'Población - Víctima de conflicto')
										->setCellValue('H3', 'Población - Rom')
										->setCellValue('I3', 'Población - Indígena')
										->setCellValue('J3', 'Población - Raizal')
										->setCellValue('K3', 'Población - Ninguna')
										->setCellValue('L3', 'Género')
										->setCellValue('M3', 'Nacionalidad')
										->setCellValue('N3', 'Localidad')
										->setCellValue('O3', 'Barrio')
										->setCellValue('P3', '¿Qué servicio utilizó durante su visita o llamada realizada?')
										->setCellValue('Q3', 'Página Web')
										->setCellValue('R3', 'Volante/Plegable')
										->setCellValue('S3', 'Televisión')
										->setCellValue('T3', 'Redes Sociales')
										->setCellValue('U3', 'Amigo/Familiar')
										->setCellValue('V3', 'Correo electrónico')
										->setCellValue('W3', 'Prensa')
										->setCellValue('X3', 'Radio')
										->setCellValue('Y3', 'Otro')
										->setCellValue('Z3', 'Conocimiento del tema')
										->setCellValue('AA3', 'Amabilidad y disposición de servicio')
										->setCellValue('AB3', 'Tiempo de espera')
										->setCellValue('AC3', 'Estado de la infraestructura e instalaciones')
										->setCellValue('AD3', '¿Cuál es su percepción frente al servicio?');
			$j=4; 
			if($listaEncuestas){
				foreach ($listaEncuestas as $lista):
					$rangoEdad = '';
                    switch ($lista['rango_edad']) {
                        case 1:
                            $rangoEdad = 'Menor a 26 años ';
                            break;
                        case 2:
                            $rangoEdad = '27 a 59 años';
                            break;
                        case 3:
                            $rangoEdad = 'Mayor de 60 años';
                            break;
                    }
                    $discapacidad = "";
                    $desplazado = "";
                    $victima = "";
                    $rom = "";
                    $indigena = "";
                    $raizal = "";
                    $ninguna = "";
                    if($lista['poblacion_discapacidad'] == 1){
                    	$discapacidad = 'X';
                    }
                    if($lista['poblacion_desplazado'] == 1){
                    	$desplazado = 'X';
                    }
                    if($lista['poblacion_victima'] == 1){
                    	$victima = 'X';
                    }
                    if($lista['poblacion_rom'] == 1){
                    	$rom = 'X';
                    }
                    if($lista['poblacion_indigena'] == 1){
                    	$indigena = 'X';
                    }
                    if($lista['poblacion_raizal'] == 1){
                    	$raizal = 'X';
                    }
                    if($lista['poblacion_ninguna'] == 1){
                    	$ninguna = 'X';
                    }
                    $genero = '';
                    switch ($lista['genero']) {
                        case 1:
                        	$genero = 'Hombre';
                            break;
                        case 2:
                            $genero = 'Mujer';
                            break;
                        case 3:
                            $genero = 'No responde';
                            break;
                        case 4:
                            $genero = 'Otro - ' . $lista['genero_otro'];
                            break;
                    }
                    $nacionalidad = 'Colombiano';
                    if($lista['nacionalidad']==2){
                    	$nacionalidad = 'Extranjero';
                    }
                    $servicio_pagina_web = "";
                    $servicio_volante = "";
                    $servicio_television = "";
                    $servicio_redes = "";
                    $servicio_amigo = "";
                    $servicio_correo = "";
                    $servicio_prensa = "";
                    $servicio_radio = "";
                    $servicio_otro = "";
                    if($lista['servicio_pagina_web'] == 1){
                    	$servicio_pagina_web = 'X';
                    }
                    if($lista['servicio_volante'] == 1){
                    	$servicio_volante = 'X';
                    }
                    if($lista['servicio_television'] == 1){
                    	$servicio_television = 'X';
                    }
                    if($lista['servicio_redes'] == 1){
                    	$servicio_redes = 'X';
                    }
                    if($lista['servicio_amigo'] == 1){
                    	$servicio_amigo = 'X';
                    }
                    if($lista['servicio_correo'] == 1){
                    	$servicio_correo = 'X';
                    }
                    if($lista['servicio_prensa'] == 1){
                    	$servicio_prensa = 'X';
                    }
                    if($lista['servicio_radio'] == 1){
                    	$servicio_radio = 'X';
                    }
                    if($lista['servicio_otro'] == 1){
                    	$servicio_otro = $lista['servicio_cual'];
                    }
					$objPHPExcel->getActiveSheet()->getStyle('A'.$j.':AD'.$j)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
					$objPHPExcel->getActiveSheet()->setCellValue('A'.$j, $lista['id_formulario'])
												  ->setCellValue('B'.$j, $lista['fecha'])
												  ->setCellValue('C'.$j, $lista['nombre_servidor'])
												  ->setCellValue('D'.$j, $rangoEdad)
												  ->setCellValue('E'.$j, $discapacidad)
												  ->setCellValue('F'.$j, $desplazado)
												  ->setCellValue('G'.$j, $victima)
												  ->setCellValue('H'.$j, $rom)
												  ->setCellValue('I'.$j, $indigena)
												  ->setCellValue('J'.$j, $raizal)
												  ->setCellValue('K'.$j, $ninguna)
												  ->setCellValue('L'.$j, $genero)
												  ->setCellValue('M'.$j, $nacionalidad)
												  ->setCellValue('N'.$j, $lista['localidad'])
												  ->setCellValue('O'.$j, $lista['barrio'])
												  ->setCellValue('P'.$j, $lista['servicio'])
												  ->setCellValue('Q'.$j, $servicio_pagina_web)
												  ->setCellValue('R'.$j, $servicio_volante)
												  ->setCellValue('S'.$j, $servicio_television)
												  ->setCellValue('T'.$j, $servicio_redes)
												  ->setCellValue('U'.$j, $servicio_amigo)
												  ->setCellValue('V'.$j, $servicio_correo)
												  ->setCellValue('W'.$j, $servicio_prensa)
												  ->setCellValue('X'.$j, $servicio_radio)
												  ->setCellValue('Y'.$j, $servicio_otro)
												  ->setCellValue('Z'.$j, $lista['calificacion_1'])
												  ->setCellValue('AA'.$j, $lista['calificacion_2'])
												  ->setCellValue('AB'.$j, $lista['calificacion_3'])
												  ->setCellValue('AC'.$j, $lista['calificacion_5'])
												  ->setCellValue('AD'.$j, $lista['percepcion']);
					$j++;
				endforeach;
			}
			// Set column widths							  
			$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
			$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(13);
			$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
			$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(30);
			$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(38);
			$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(35);
			$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(38);
			$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(30);
			$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(35);
			$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(35);
			$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(30);
			$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(15);
			$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(20);
			$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(30);
			$objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(30);
			$objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(70);
			$objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(17);
			$objPHPExcel->getActiveSheet()->getColumnDimension('R')->setWidth(20);
			$objPHPExcel->getActiveSheet()->getColumnDimension('S')->setWidth(17);
			$objPHPExcel->getActiveSheet()->getColumnDimension('T')->setWidth(18);
			$objPHPExcel->getActiveSheet()->getColumnDimension('U')->setWidth(18);
			$objPHPExcel->getActiveSheet()->getColumnDimension('V')->setWidth(22);
			$objPHPExcel->getActiveSheet()->getColumnDimension('W')->setWidth(13);
			$objPHPExcel->getActiveSheet()->getColumnDimension('X')->setWidth(13);
			$objPHPExcel->getActiveSheet()->getColumnDimension('Y')->setWidth(22);
			$objPHPExcel->getActiveSheet()->getColumnDimension('Z')->setWidth(42);
			$objPHPExcel->getActiveSheet()->getColumnDimension('AA')->setWidth(35);
			$objPHPExcel->getActiveSheet()->getColumnDimension('AB')->setWidth(35);
			$objPHPExcel->getActiveSheet()->getColumnDimension('AC')->setWidth(40);
			$objPHPExcel->getActiveSheet()->getColumnDimension('AD')->setWidth(45);
			// Set fonts	
			$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
			$objPHPExcel->getActiveSheet()->getStyle('A2')->getFont()->setBold(true);
			$objPHPExcel->getActiveSheet()->getStyle('A3:AD3')->getFont()->setBold(true);
			$objPHPExcel->getActiveSheet()->getStyle('A3:AD3')->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_WHITE);
			$objPHPExcel->getActiveSheet()->getStyle('A3:AD3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$objPHPExcel->getActiveSheet()->getStyle('A3:AD3')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
			$objPHPExcel->getActiveSheet()->getStyle('A3:AD3')->getFill()->getStartColor()->setARGB(PHPExcel_Style_Color::COLOR_BLUE);
			// Set header and footer. When no different headers for odd/even are used, odd header is assumed.
			$objPHPExcel->getActiveSheet()->getHeaderFooter()->setOddHeader('&L&BPersonal cash register&RPrinted on &D');
			$objPHPExcel->getActiveSheet()->getHeaderFooter()->setOddFooter('&L&B' . $objPHPExcel->getProperties()->getTitle() . '&RPage &P of &N');
			// Set page orientation and size
			$objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_PORTRAIT);
			$objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);
			// Rename worksheet
			$objPHPExcel->getActiveSheet()->setTitle('Enc. Satisfación');
			// Set active sheet index to the first sheet, so Excel opens this as the first sheet
			$objPHPExcel->setActiveSheetIndex(0);
			// redireccionamos la salida al navegador del cliente (Excel2007)
			header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			header('Content-Disposition: attachment;filename=' . $nombreArchivo);
			header('Cache-Control: max-age=0');
			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
			$objWriter->save('php://output');
    }

	/**
	 * Generate Reportes Enuesta de Percepcion in XLS
     * @since 29/11/2021
     * @author BMOTTAG
	 */
	public function generaEncuestaPercepcionFechaXLS()
	{				
			$bandera = $this->input->post('bandera');
			if($bandera == 1 )
			{
				$data['fecha'] = $this->input->post('fecha');
				$fechaEncabezado = 'Fecha: ' . ucfirst(strftime("%b %d, %G",strtotime($data['fecha'])));
				$nombreArchivo = 'encuesta_percepcion_' . $data['fecha'] . '.xls';
				$arrParam = array(
					'fecha' => $this->input->post('fecha')
				);
			} else {
				$data['from'] = $this->input->post('from');
				$data['to'] = $this->input->post('to');
				$fechaEncabezado = 'Rango Fechas: ' . ucfirst(strftime("%b %d, %G",strtotime($data['from']))) . ' - ' . ucfirst(strftime("%b %d, %G",strtotime($data['to'])));
				$nombreArchivo = 'encuesta_percepcion_' . $data['from'] . '-' . $data['to'] . '.xls';
				$from = $data['from'];
				//le sumo un dia al dia final para que ingrese ese dia en la consulta
				$to = date('Y-m-d',strtotime ( '+1 day ' , strtotime ( $data['to']) ) );
				$arrParam = array(
					'from' => $from,
					'to' => $to
				);
			}
			$listaEncuestas = $this->reportes_model->get_enc_percepcion($arrParam);
			// Create new PHPExcel object
			$objPHPExcel = new PHPExcel();
			// Set document properties
			$objPHPExcel->getProperties()->setCreator("JBB APP")
										 ->setLastModifiedBy("JBB APP")
										 ->setTitle("Report")
										 ->setSubject("Report")
										 ->setDescription("JBB Report")
										 ->setKeywords("office 2007 openxml php")
										 ->setCategory("Report");
			// Create a first sheet
			$objPHPExcel->setActiveSheetIndex(0);
			$objPHPExcel->getActiveSheet()->setCellValue('A1', 'REGISTROS ENCUESTA DE PERCEPCIÓN SOBRE LA GESTIÓN DEL JARDÍN BOTÁNICO DE BOGOTÁ JOSÉ CELESTINO MUTIS - ' . $fechaEncabezado);
			$objPHPExcel->getActiveSheet()->setCellValue('A3', 'No.')
										->setCellValue('B3', 'Fecha')
										->setCellValue('C3', 'Autoriza el tratamiento de datos personales')
										->setCellValue('D3', 'Localidad donde vive')
										->setCellValue('E3', 'Estrato')
										->setCellValue('F3', 'Género')
										->setCellValue('G3', 'Grupo étnico')
										->setCellValue('H3', 'Rango de edad')
										->setCellValue('I3', '¿Qué tanto conoce el Jardín Botánico?')
										->setCellValue('J3', '¿Cuál es su grado de satisfacción con la gestión del Jardín Botánico?')
										->setCellValue('K3', '¿Qué tanto confía en el Jardín Botánico?')
										->setCellValue('L3', '¿Qué imagen tiene del JBB?')
										->setCellValue('M3', 'Agricultura urbana y periurbana')
										->setCellValue('N3', 'Arborización urbana')
										->setCellValue('O3', 'Educación, cultura y participación ambiental')
										->setCellValue('P3', 'Investigación científica')
										->setCellValue('Q3', 'Agricultura urbana y periurbana')
										->setCellValue('R3', 'Arborización urbana')
										->setCellValue('S3', 'Educación, cultura y participación ambiental')
										->setCellValue('T3', 'Investigación científica')
										->setCellValue('U3', '¿Cuál es su grado de satisfacción con la cantidad de árboles en Bogotá?');
			$j=4;
			$x=0;
			if($listaEncuestas){
				foreach ($listaEncuestas as $lista):
					$x++;
					$tratamiento_datos = '';
					if($lista['tratamiento_datos']){
						switch ($lista['tratamiento_datos']) {
							case 1:
								$tratamiento_datos = 'Si';
								break;
							case 2:
								$tratamiento_datos = 'No';
								break;
						}
					}
                    $pregunta_5 = '';
					if($lista['pregunta_5']){
						switch ($lista['pregunta_5']) {
							case 1:
								$pregunta_5 = 'Muy poca';
								break;
							case 2:
								$pregunta_5 = 'Poca';
								break;
							case 3:
								$pregunta_5 = 'Moderada';
								break;
							case 4:
								$pregunta_5 = 'Mucha';
								break;
						}
					}
                    $pregunta_6 = '';
					if($lista['pregunta_6']){
						switch ($lista['pregunta_6']) {
							case 1:
								$pregunta_6 = 'Muy poca';
								break;
							case 2:
								$pregunta_6 = 'Poca';
								break;
							case 3:
								$pregunta_6 = 'Moderada';
								break;
							case 4:
								$pregunta_6 = 'Mucha';
								break;
						}
					}
                    $pregunta_7 = '';
					if($lista['pregunta_7']){
						switch ($lista['pregunta_7']) {
							case 1:
								$pregunta_7 = 'Muy poca';
								break;
							case 2:
								$pregunta_7 = 'Poca';
								break;
							case 3:
								$pregunta_7 = 'Moderada';
								break;
							case 4:
								$pregunta_7 = 'Mucha';
								break;
						}
					}
                    $pregunta_8 = '';
					if($lista['pregunta_8']){
						switch ($lista['pregunta_8']) {
							case 1:
								$pregunta_8 = 'Muy poca';
								break;
							case 2:
								$pregunta_8 = 'Poca';
								break;
							case 3:
								$pregunta_8 = 'Moderada';
								break;
							case 4:
								$pregunta_8 = 'Mucha';
								break;
						}
					}
                    $pregunta_9 = '';
					if($lista['pregunta_9']){
						switch ($lista['pregunta_9']) {
							case 1:
								$pregunta_9 = 'Muy bajo';
								break;
							case 2:
								$pregunta_9 = 'Bajo';
								break;
							case 3:
								$pregunta_9 = 'Moderado';
								break;
							case 4:
								$pregunta_9 = 'Alto';
								break;
							case 5:
								$pregunta_9 = 'Muy alto';
								break;
						}
					}
                    $pregunta_10 = '';
					if($lista['pregunta_10']){
						switch ($lista['pregunta_10']) {
							case 1:
								$pregunta_10 = 'Muy bajo';
								break;
							case 2:
								$pregunta_10 = 'Bajo';
								break;
							case 3:
								$pregunta_10 = 'Moderado';
								break;
							case 4:
								$pregunta_10 = 'Alto';
								break;
							case 5:
								$pregunta_10 = 'Muy alto';
								break;
						}
					}
                    $pregunta_11 = '';
					if($lista['pregunta_11']){
						switch ($lista['pregunta_11']) {
							case 1:
								$pregunta_11 = 'Muy bajo';
								break;
							case 2:
								$pregunta_11 = 'Bajo';
								break;
							case 3:
								$pregunta_11 = 'Moderado';
								break;
							case 4:
								$pregunta_11 = 'Alto';
								break;
							case 5:
								$pregunta_11 = 'Muy alto';
								break;
						}
					}
                    $pregunta_12 = '';
					if($lista['pregunta_12']){
						switch ($lista['pregunta_12']) {
							case 1:
								$pregunta_12 = 'Muy bajo';
								break;
							case 2:
								$pregunta_12 = 'Bajo';
								break;
							case 3:
								$pregunta_12 = 'Moderado';
								break;
							case 4:
								$pregunta_12 = 'Alto';
								break;
							case 5:
								$pregunta_12 = 'Muy alto';
								break;
						}
					}
                    $pregunta_2 = $lista['pregunta_2']==9?'X':$lista['pregunta_2'];
					$objPHPExcel->getActiveSheet()->getStyle('A'.$j.':AD'.$j)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
					$objPHPExcel->getActiveSheet()->setCellValue('A'.$j, "$x")
												  ->setCellValue('B'.$j, $lista['fecha_registro'])
												  ->setCellValue('C'.$j, $tratamiento_datos)
												  ->setCellValue('D'.$j, $lista['localidad'])
												  ->setCellValue('E'.$j, $lista['estrato'])
												  ->setCellValue('F'.$j, $lista['genero'])
												  ->setCellValue('G'.$j, $lista['grupo_etnico'])
												  ->setCellValue('H'.$j, $lista['rango_edades'])
												  ->setCellValue('I'.$j, $lista['pregunta_1'])
												  ->setCellValue('J'.$j, $pregunta_2)
												  ->setCellValue('K'.$j, $lista['pregunta_3'])
												  ->setCellValue('L'.$j, $lista['pregunta_4'])
												  ->setCellValue('M'.$j, $pregunta_5)
												  ->setCellValue('N'.$j, $pregunta_6)
												  ->setCellValue('O'.$j, $pregunta_7)
												  ->setCellValue('P'.$j, $pregunta_8)
												  ->setCellValue('Q'.$j, $pregunta_9)
												  ->setCellValue('R'.$j, $pregunta_10)
												  ->setCellValue('S'.$j, $pregunta_11)
												  ->setCellValue('T'.$j, $pregunta_12)
												  ->setCellValue('U'.$j, $lista['pregunta_13']);
					$j++;
				endforeach;
			}
			// Set column widths							  
			$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
			$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(13);
			$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(50);
			$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(25);
			$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
			$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
			$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(25);
			$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(25);
			$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(35);
			$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(50);
			$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(35);
			$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(30);
			$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(40);
			$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(30);
			$objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(40);
			$objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(35);
			$objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(35);
			$objPHPExcel->getActiveSheet()->getColumnDimension('R')->setWidth(20);
			$objPHPExcel->getActiveSheet()->getColumnDimension('S')->setWidth(45);
			$objPHPExcel->getActiveSheet()->getColumnDimension('T')->setWidth(25);
			$objPHPExcel->getActiveSheet()->getColumnDimension('U')->setWidth(65);
			// Set fonts	
			$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
			$objPHPExcel->getActiveSheet()->getStyle('A2')->getFont()->setBold(true);
			$objPHPExcel->getActiveSheet()->getStyle('A3:U3')->getFont()->setBold(true);
			$objPHPExcel->getActiveSheet()->getStyle('A3:U3')->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_WHITE);
			$objPHPExcel->getActiveSheet()->getStyle('A3:U3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$objPHPExcel->getActiveSheet()->getStyle('A3:U3')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
			$objPHPExcel->getActiveSheet()->getStyle('A3:U3')->getFill()->getStartColor()->setARGB(PHPExcel_Style_Color::COLOR_BLUE);
			// Set header and footer. When no different headers for odd/even are used, odd header is assumed.
			$objPHPExcel->getActiveSheet()->getHeaderFooter()->setOddHeader('&L&BPersonal cash register&RPrinted on &D');
			$objPHPExcel->getActiveSheet()->getHeaderFooter()->setOddFooter('&L&B' . $objPHPExcel->getProperties()->getTitle() . '&RPage &P of &N');
			// Set page orientation and size
			$objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_PORTRAIT);
			$objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);
			// Rename worksheet
			$objPHPExcel->getActiveSheet()->setTitle('Enc. Percepción');
			// Set active sheet index to the first sheet, so Excel opens this as the first sheet
			$objPHPExcel->setActiveSheetIndex(0);
			// redireccionamos la salida al navegador del cliente (Excel2007)
			header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			header('Content-Disposition: attachment;filename=' . $nombreArchivo);
			header('Cache-Control: max-age=0');
			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
			$objWriter->save('php://output');
    }

    /**
	 * Generate Reportes Formulario Atencion al Ciudadano in XLS
     * @since 21/05/2023
     * @author AOCUBILLOSA
	 */
	public function generaFormularioAtencionFechaXLS()
	{
			$bandera = $this->input->post('bandera');
			if($bandera == 1 )
			{
				$data['fecha'] = $this->input->post('fecha');
				$fechaEncabezado = 'Fecha: ' . ucfirst(strftime("%b %d, %G",strtotime($data['fecha'])));
				$nombreArchivo = 'formulario_atencion_' . $data['fecha'] . '.xls';
				$arrParam = array(
					'fecha' => $this->input->post('fecha')
				);
			} else {
				$data['from'] = $this->input->post('from');
				$data['to'] = $this->input->post('to');
				$fechaEncabezado = 'Rango Fechas: ' . ucfirst(strftime("%b %d, %G",strtotime($data['from']))) . ' - ' . ucfirst(strftime("%b %d, %G",strtotime($data['to'])));
				$nombreArchivo = 'formulario_atencion_' . $data['from'] . '-' . $data['to'] . '.xls';
				$from = $data['from'];
				//le sumo un dia al dia final para que ingrese ese dia en la consulta
				$to = date('Y-m-d',strtotime ( '+1 day ' , strtotime ( $data['to']) ) );
				$arrParam = array(
					'from' => $from,
					'to' => $to
				);
			}
			$listaEncuestas = $this->reportes_model->get_info_form_atencion($arrParam);
			// Create new PHPExcel object
			$objPHPExcel = new PHPExcel();
			// Set document properties
			$objPHPExcel->getProperties()->setCreator("JBB APP")
										 ->setLastModifiedBy("JBB APP")
										 ->setTitle("Report")
										 ->setSubject("Report")
										 ->setDescription("JBB Report")
										 ->setKeywords("office 2007 openxml php")
										 ->setCategory("Report");
			// Create a first sheet
			$objPHPExcel->setActiveSheetIndex(0);
			$objPHPExcel->getActiveSheet(0)->setCellValue('A1', 'REGISTROS FORMULARIO ATENCIÓN AL CIUDADANO - ' . $fechaEncabezado);
			$objPHPExcel->getActiveSheet()
									->setCellValue('A3', 'No.')
									->setCellValue('B3', 'Fecha')
									->setCellValue('C3', 'Autoriza el Tratamiento de Datos Personales')
									->setCellValue('D3', 'Tipo de Persona')
									->setCellValue('E3', 'Tipo de Identificación')
									->setCellValue('F3', 'Tipo de Entidad')
									->setCellValue('G3', 'Tipo de Empresa/Sociedad')
									->setCellValue('H3', 'Número de Documento')
									->setCellValue('I3', 'Genero')
									->setCellValue('J3', 'Fecha de Nacimiento')
									->setCellValue('K3', 'Quien Realiza Acompañamiento')
									->setCellValue('L3', 'Edad')
									->setCellValue('M3', 'Nombres')
									->setCellValue('N3', 'Apellidos')
									->setCellValue('O3', 'Razón Social')
									->setCellValue('P3', 'Teléfono')
									->setCellValue('Q3', 'Condición')
									->setCellValue('R3', 'Pertenece a una Entidad Distrital')
									->setCellValue('S3', 'Asunto')
									->setCellValue('T3', 'Archivo Adjunto')
									->setCellValue('U3', 'Tipo de Petición')
									->setCellValue('V3', 'Palabra Clave')
									->setCellValue('W3', 'Tema')
									->setCellValue('X3', 'Correo Electrónico')
									->setCellValue('Y3', 'Localidad')
									->setCellValue('Z3', 'UPZ')
									->setCellValue('AA3', 'Barrio')
									->setCellValue('AB3', 'Dirección')
									->setCellValue('AC3', 'Estrato')
									->setCellValue('AD3', 'Código Postal')
									->setCellValue('AE3', 'Certifica Información');
			$j=4;
			$x=0;
			if($listaEncuestas){
				foreach ($listaEncuestas as $lista):
					$x++;
					$autoriza = '';
					if($lista['autoriza']){
						switch ($lista['autoriza']) {
							case 1:
								$autoriza = 'Si';
								break;
							case 2:
								$autoriza = 'No';
								break;
						}
					}
					$entidad_distrital = '';
					if($lista['entidad_distrital']){
						switch ($lista['entidad_distrital']) {
							case 1:
								$entidad_distrital = 'Si';
								break;
							case 2:
								$entidad_distrital = 'No';
								break;
						}
					}
					$confirmar = '';
					if(!empty($lista['confirmar'])){
						switch ($lista['confirmar']) {
							case 1:
								$confirmar = 'Si';
								break;
							case 2:
								$confirmar = 'No';
								break;
						}
					}
					$objPHPExcel->getActiveSheet()->getStyle('A'.$j.':C'.$j)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
					$objPHPExcel->getActiveSheet()->getStyle('H'.$j.':J'.$j)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
					$objPHPExcel->getActiveSheet()->getStyle('L'.$j)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
					$objPHPExcel->getActiveSheet()->getStyle('P'.$j)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
					$objPHPExcel->getActiveSheet()->getStyle('R'.$j)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
					$objPHPExcel->getActiveSheet()->getStyle('T'.$j)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
					$objPHPExcel->getActiveSheet()->getStyle('AC'.$j.':AE'.$j)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
					$objPHPExcel->getActiveSheet()->setCellValue('A'.$j, "$x")
											->setCellValue('B'.$j, $lista['fecha_registro'])
											->setCellValue('C'.$j, $autoriza)
											->setCellValue('D'.$j, $lista['tipo_persona'])
											->setCellValue('E'.$j, $lista['tipo_identificacion'])
											->setCellValue('F'.$j, $lista['tipo_entidad'])
											->setCellValue('G'.$j, $lista['tipo_sociedad'])
											->setCellValue('H'.$j, $lista['numero_documento'])
											->setCellValue('I'.$j, $lista['genero'])
											->setCellValue('J'.$j, $lista['fecha_nacimiento'])
											->setCellValue('K'.$j, $lista['tipo_acompanamiento'])
											->setCellValue('L'.$j, $lista['edad'])
											->setCellValue('M'.$j, $lista['nombres'])
											->setCellValue('N'.$j, $lista['apellidos'])
											->setCellValue('O'.$j, $lista['razon_social'])
											->setCellValue('P'.$j, $lista['telefono'])
											->setCellValue('Q'.$j, $lista['condicion'])
											->setCellValue('R'.$j, $entidad_distrital)
											->setCellValue('S'.$j, $lista['asunto'])
											->setCellValue('T'.$j, $lista['archivo'])
											->setCellValue('U'.$j, $lista['tipo_atencion'])
											->setCellValue('V'.$j, $lista['palabra_clave'])
											->setCellValue('W'.$j, $lista['tema'])
											->setCellValue('X'.$j, $lista['email'])
											->setCellValue('Y'.$j, $lista['localidad'])
											->setCellValue('Z'.$j, $lista['upz'])
											->setCellValue('AA'.$j, $lista['barrio'])
											->setCellValue('AB'.$j, $lista['direccion'])
											->setCellValue('AC'.$j, $lista['estrato'])
											->setCellValue('AD'.$j, $lista['codigo_postal'])
											->setCellValue('AE'.$j, $confirmar);
					$j++;
				endforeach;
			}
			// Set column widths							  
			$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
			$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(12);
			$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(40);
			$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(25);
			$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(30);
			$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(45);
			$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(25);
			$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(18);
			$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(10);
			$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(20);
			$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(30);
			$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(10);
			$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(30);
			$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(30);
			$objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(30);
			$objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(12);
			$objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(16);
			$objPHPExcel->getActiveSheet()->getColumnDimension('R')->setWidth(30);
			$objPHPExcel->getActiveSheet()->getColumnDimension('S')->setWidth(50);
			$objPHPExcel->getActiveSheet()->getColumnDimension('T')->setWidth(20);
			$objPHPExcel->getActiveSheet()->getColumnDimension('U')->setWidth(35);
			$objPHPExcel->getActiveSheet()->getColumnDimension('V')->setWidth(20);
			$objPHPExcel->getActiveSheet()->getColumnDimension('W')->setWidth(40);
			$objPHPExcel->getActiveSheet()->getColumnDimension('X')->setWidth(30);
			$objPHPExcel->getActiveSheet()->getColumnDimension('Y')->setWidth(20);
			$objPHPExcel->getActiveSheet()->getColumnDimension('Z')->setWidth(30);
			$objPHPExcel->getActiveSheet()->getColumnDimension('AA')->setWidth(30);
			$objPHPExcel->getActiveSheet()->getColumnDimension('AB')->setWidth(50);
			$objPHPExcel->getActiveSheet()->getColumnDimension('AC')->setWidth(10);
			$objPHPExcel->getActiveSheet()->getColumnDimension('AD')->setWidth(15);
			$objPHPExcel->getActiveSheet()->getColumnDimension('AE')->setWidth(20);
			// Set fonts	
			$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
			$objPHPExcel->getActiveSheet()->getStyle('A2')->getFont()->setBold(true);
			$objPHPExcel->getActiveSheet()->getStyle('A3:AE3')->getFont()->setBold(true);
			$objPHPExcel->getActiveSheet()->getStyle('A3:AE3')->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_WHITE);
			$objPHPExcel->getActiveSheet()->getStyle('A3:AE3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$objPHPExcel->getActiveSheet()->getStyle('A3:AE3')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
			$objPHPExcel->getActiveSheet()->getStyle('A3:AE3')->getFill()->getStartColor()->setARGB(PHPExcel_Style_Color::COLOR_BLUE);
			// Set header and footer. When no different headers for odd/even are used, odd header is assumed.
			$objPHPExcel->getActiveSheet()->getHeaderFooter()->setOddHeader('&L&BPersonal cash register&RPrinted on &D');
			$objPHPExcel->getActiveSheet()->getHeaderFooter()->setOddFooter('&L&B' . $objPHPExcel->getProperties()->getTitle() . '&RPage &P of &N');
			// Set page orientation and size
			$objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_PORTRAIT);
			$objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);
			// Rename worksheet
			$objPHPExcel->getActiveSheet()->setTitle('Enc. Satisfación');
			// Set active sheet index to the first sheet, so Excel opens this as the first sheet
			$objPHPExcel->setActiveSheetIndex(0);
			// redireccionamos la salida al navegador del cliente (Excel2007)
			header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			header('Content-Disposition: attachment;filename=' . $nombreArchivo);
			header('Cache-Control: max-age=0');
			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
			$objWriter->save('php://output');
    }
}