<?php

class ControladorArea{

	/*=============================
	MOSTRAR TODOS LOS REGISTROS
	=============================*/

	public function index($page){


		if ($page != null) {
			
			/*============================================
				  Mostrar registros con paginación
			============================================*/

			$cantidad = 10;
			$desde = ($page-1)*$cantidad;

			$area = ModeloArea::index("area", $cantidad, $desde);

				}else{

					/*============================================
					Mostrar todos los registros
					============================================*/

					$area = ModeloArea::index("area", null, null);
				}
				if (!empty($area)) {	

					$json = array(
						"status"=>200,
						"total_registros"=>count($area),
						"detalle"=> $area
					);

					echo json_encode($json, true);
					return;
				
				}else{
						$json = array(
							"status"=>200,
							"total_registros"=>0,
							"detalle"=> "No hay ningún registro"
						);
						echo json_encode($json, true);
						return;
				}
	}
	/*============================================
	Crear un registro
	============================================*/

	public function create($datos){
		
		/*============================================
		Validar Nombre
		============================================*/

		foreach ($datos as $key => $valueDatos) {
			if (isset($ValueDatos) && !preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$/', $ValueDatos)) {

				$json = array(
					"status"=>404,
					"detalle"=>"Error en el campo nombre".$key
				);
				echo json_encode($json, true);
				return;
			}
		}

		/*============================================
		Validar que el nombre no esté repetido
		============================================*/

		$area = ModeloArea::index("area", null, null);
		foreach ($area as $key => $value) {
			
			if ($value->NOMBRE_AREA == $datos["NOMBRE_AREA"]) {

				$json = array(
					"status"=>404,
					"detalle"=>"El nombre ya existe en la base de datos"
				);

				echo json_encode($json, true);
				return;
			}
			
		}

		/*============================================
		Llevar datos al modelo
		============================================*/

		$datos = array( "NOMBRE_AREA"=>$datos["NOMBRE_AREA"]);

		$create = ModeloArea::create("area", $datos);
			/*============================================
			Respuesta del modelo
			============================================*/

			if ($create == "ok") {

				$json = array(
					"status"=>200,
					"detalle"=>"Su registro ha sido guardado"
				);

				echo json_encode($json, true);
				return;
			}
	}
	/*============================================
	Mostrando un solo registro
	============================================*/

	public function show($id){
			
		/*============================================
		Mostrar todos los registro
		============================================*/

		$area = ModeloArea::show("area", $id);

		if (!empty($area)) {

			$json = array(
				"status"=>200,
				"detalle"=> $area
			);

			echo json_encode($json, true);
			return;
		}else{

			$json = array(
				"status"=>200,
				"total_registros"=>0,
				"detalle"=> "No hay ningún registro"
			);

			echo json_encode($json, true);
			return;
		}

	}
	/*============================================
	Editar un Registro
	============================================*/

	public function update($id, $datos){

		/*============================================
		Validar datos
		============================================*/

		foreach ($datos as $key => $valueDatos) {
	
			if (isset($ValueDatos) && !preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$/', $ValueDatos)) {

				$json = array(
					"status"=>404,
					"detalle"=>"Error en el campo nombre".$key
				);

				echo json_encode($json, true);
				return;
			}

			/*============================================
			Llevar datos al modelo
			============================================*/

			$datos = array( "ID_AREA"=>$id,
							"NOMBRE_AREA"=>$datos["NOMBRE_AREA"]
							);

			$update = ModeloArea::update("area", $datos);
			/*============================================
			Respuesta del modelo
			============================================*/

			if ($update == "ok") {

				$json = array(
					"status"=>200,
					"detalle"=>"Su registro ha sido actualizado"
				);

				echo json_encode($json, true);
				return;
			}
		}
	}
	/*============================================
	Borrar Registro
	============================================*/

	public function delete($id){

		/*============================================
		Llevar datos al modelo
		============================================*/

		$delete = ModeloArea::delete("area", $id);
		/*============================================
		Respuesta del modelo
		============================================*/

		if ($delete == "ok") {

			$json = array(
				"status"=>200,
				"detalle"=>"Se ha borrado con éxito"
			);

			echo json_encode($json, true);
			return;
		}
	}
}
