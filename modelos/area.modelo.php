<?php

require_once "conexion.php";

class ModeloArea{

	/*============================================
	Mostrar todos los Registros
	============================================*/

	static public function index($tabla, $cantidad, $desde){

		if ($cantidad != null) {
			
			$stmt = Conexion::conectar()->prepare("SELECT $tabla.ID_AREA, $tabla.NOMBRE_AREA FROM $tabla LIMIT $desde, $cantidad");

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT $tabla.ID_AREA, $tabla.NOMBRE_AREA FROM $tabla");

		}

		$stmt -> execute();
		return $stmt -> fetchAll(PDO::FETCH_CLASS);
		$stmt -> close();
		$stmt = null;
	}

	/*============================================
				Crear Registro 
	============================================*/

	static public function create($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(NOMBRE_AREA) VALUES (:NOMBRE_AREA)");

		$stmt -> bindParam(":NOMBRE_AREA", $datos["NOMBRE_AREA"], PDO::PARAM_STR);
		
		
		if ($stmt -> execute()) {
				
			return "ok";

			}else{

				print_r(Conexion::conectar()->errorInfo());

			}

			$stmt-> close();
			$stmt= null;

	}
	/*============================================
	Mostrar un solo registro
	============================================*/

	static public function show($tabla, $id){

		$stmt = Conexion::conectar()->prepare("SELECT $tabla.ID_AREA, $tabla.NOMBRE_AREA FROM $tabla WHERE $tabla.ID_AREA = :ID_AREA");
		
		$stmt -> bindParam(":ID_AREA", $id, PDO::PARAM_INT);

		$stmt -> execute();
		return $stmt -> fetchAll(PDO::FETCH_CLASS);
		$stmt -> close();
		$stmt = null;
	}

	/*============================================
	Actualizacion de un registro
	============================================*/

	static public function update($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET NOMBRE_AREA = :NOMBRE_AREA WHERE ID_AREA = :ID_AREA");

		$stmt -> bindParam(":ID_AREA", $datos["ID_AREA"], PDO::PARAM_INT);
		$stmt -> bindParam(":NOMBRE_AREA", $datos["NOMBRE_AREA"], PDO::PARAM_STR);

			if ($stmt -> execute()) {
				
				return "ok";

			}else{

				print_r(Conexion::conectar()->errorInfo());

			}

			$stmt-> close();
			$stmt= null;

	}
	/*============================================
	Borrar registro
	============================================*/

	static public function delete($tabla, $id){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE ID_AREA = :ID_AREA");

		$stmt -> bindParam(":ID_AREA", $id, PDO::PARAM_INT);

			if ($stmt -> execute()) {
				
				return "ok";

			}else{

				print_r(Conexion::conectar()->errorInfo());

			}

		$stmt-> close();
		$stmt= null;

	}
}