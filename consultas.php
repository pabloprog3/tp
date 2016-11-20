<?php

include 'Conexion.php';

class Consultas
{


	public static function cargarUsuarios()
	{	
		$rows = null;

		$objPDO = new AccesoPDO();
 		$conexion = $objPDO->getConexion();
 		$sql = "select * from usuarios";

 		$statementPDO = $conexion->prepare($sql);
 		$statementPDO->execute();

 		while ($resultado = $statementPDO->fetch()) 
 		{
 			$rows[]= $resultado;
 		}

 		return $rows;
	}


	public static function insertarUsuarios($correo, $clave, $perfil)
	{	
		$PDO = new AccesoPDO();
		$conexion = $PDO->getConexion();

		$sql = "insert into usuarios (correo, clave, perfil) values (:unCorreo, :unaClave, :unPerfil)";

		$statementPDO = $conexion->prepare($sql);
		$statementPDO->bindParam(':unCorreo', $correo);
		$statementPDO->bindParam(':unaClave', $clave);
		$statementPDO->bindParam(':unPerfil', $perfil);

		if (!$statementPDO) 
		{
			return "Error al crear el registro";	
		}
		else
		{
			$statementPDO->execute();
			return "Registro creado con exito";
		}

	}

	public static function traerUsuario($id)
	{
		$rows = null;

		$PDO = new AccesoPDO();
		$conexion = $PDO->getConexion();

		$sql = "select * from usuarios where id_usuario = :id";
	
		$statementPDO = $conexion->prepare($sql);

		$statementPDO->bindParam(':id', $id);

		$statementPDO->execute();

 		while ($resultado = $statementPDO->fetch()) 
 		{
 			$rows[]= $resultado;
 		} 

 		return $rows;
		
	}


	public static function modificarUsuario($idusuario, $correo, $clave, $perfil)
	{	
		$PDO = new AccesoPDO();
		$conexion = $PDO->getConexion();

		$sql = "update usuarios set correo=:correo, clave=:clave, perfil=:perfil where id_usuario=:id";

		$statementPDO = $conexion->prepare($sql);
		$statementPDO->bindParam(':correo', $correo);
		$statementPDO->bindParam(':clave', $clave);
		$statementPDO->bindParam(':perfil', $perfil);
		$statementPDO->bindParam(':id', $idusuario);

		if (!$statementPDO) 
		{
			return "Error al modificar el registro";	
		}
		else
		{
			$statementPDO->execute();
			return "Registro modificado con exito";
		}

	}



	public static function sacarUsuario($id)
	{
		$PDO = new AccesoPDO();
		$conexion = $PDO->getConexion();
		$sql = "delete from usuarios where id_usuario = :id";
		$statementPDO = $conexion->prepare($sql);
		$statementPDO->bindParam(":id", $id);

		if (!$statementPDO) 
		{
			return "Se produjo un error al sacar la Patente. Avise a su Administrador";
		}
		else
		{
			$statementPDO->execute();
		}
	}




	public function insertarPatente($patente)
	{
		$fecha = date("Y-m-d H:i:s");
		$PDO = new AccesoPDO();
		$conexion = $PDO->getConexion();
		$patente = strtoupper($patente);

		$sql = "insert into autos (patente, ingreso) values (:patente, :fecha)";

		$statementPDO = $conexion->prepare($sql);
		$statementPDO->bindParam(':patente', $patente);
		$statementPDO->bindParam(':fecha', $fecha);

		if (!$statementPDO) 
		{
			return "Error al crear el registro";	
		}
		else
		{
			$statementPDO->execute();
			return "Registro creado con exito";
		}

	}



	public static function cargarPatentes()
	{
		$rows=null;
		$PDO = new AccesoPDO();
		$conexion = $PDO->getConexion();
		$sql = "select id_patente as ID, patente as PATENTE, ingreso as INGRESO from autos";
		$statementPDO = $conexion->prepare($sql);
		$statementPDO->execute();

		while ($resultado = $statementPDO->fetch()) 
		{
			$rows[] = $resultado;
		}

		//return $rows;
		if(count($rows) >= 1)
		{
			return $rows;
		}
		else
			return -1;
	}


	public static function sacarPatente($patente)
	{
		//$fechaEgreso = time();

		$PDO = new AccesoPDO();
		$conexion = $PDO->getConexion();
		$sql = "delete from autos where id_patente = :patente";
		$statementPDO = $conexion->prepare($sql);
		$statementPDO->bindParam(":patente", $patente);

		if (!$statementPDO) 
		{
			return "Se produjo un error al sacar la Patente. Avise a su Administrador";
		}
		else
		{
			$statementPDO->execute();
		}
	}

	public static function traerFecha($id)
	{
		
		$PDO = new AccesoPDO();
		$conexion = $PDO->getConexion();
		$sql = "select ingreso from autos where id_patente = :idPatente";
		$resultado;

		$statementPDO = $conexion->prepare($sql);
		$statementPDO->bindParam(":idPatente", $id);

		$statementPDO->execute();

		return $resultado[] = $statementPDO->fetch();

	}


	public static function traerPatente($patente)
	{
		$PDO = new AccesoPDO();
		$conexion = $PDO->getConexion();
		$sql = "select patente from autos where id_patente = :idPatente";

		$statementPDO = $conexion->prepare($sql);
		$statementPDO->bindParam(":idPatente", $patente);
		$statementPDO->execute();

		 $resultado = $statementPDO->fetch();

		 if(count($resultado) >= 1)
		{
			return 1;
		}
		else
			return -1;
	}




}









?>