<?php

	function conexion($bd_config){
		try{
			$conn = new PDO('mysql:host=localhost; dbname='.$bd_config['basedatos'] , $bd_config['user'] , $bd_config['pass']);
			return $conn;
		}catch(PDOException $e){
			return false;
		}
	}
	function limpiarDatos($datos){
		$datos = trim($datos);
		$datos = stripcslashes($datos);
		$datos = htmlspecialchars($datos);
		return $datos;
	}

	function pagina_actual(){
		return isset($_GET['p']) ? (int)$_GET['p']:1;
	}	
	
	function obtener_post($post_por_pagina,$conn){
		$inicio = (pagina_actual() > 1)? pagina_actual() * $post_por_pagina - $post_por_pagina : 0;
		$statement = $conn->prepare("SELECT SQL_CALC_FOUND_ROWS * FROM articulos LIMIT $inicio, $post_por_pagina");
		$statement->execute();
		$resultado = $statement->fetchAll();
		$statement = null;
		$conn = null;
		return $resultado ;
	}

	function numero_paginas($post_por_pagina,$conn){
		$total_post = $conn->prepare('SELECT FOUND_ROWS() as total');
		$total_post->execute();
		$total_post = $total_post->fetch()['total'];
		$numero_paginas = ceil($total_post / $post_por_pagina);
		$conn = null;
		$total_post = null;
		return $numero_paginas;
	}

	function id_articulo($id){
		return (int)limpiarDatos($id);
	}

	function obtener_post_por_id($conn , $id){
		$resultado = $conn->query("SELECT * FROM articulos WHERE id = $id LIMIT 1");
		$resultado = $resultado->fetchAll();
		$rpt = $resultado;
		$conn = null;
		$resultado = null;	
		return ($rpt) ? $rpt : false;
	};

	function fecha($fecha){
		$timeStamp = strtotime($fecha);
		$meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
		$dia=date('d',$timeStamp);
		$mes = date('m',$timeStamp) - 1;
		$year = date('Y',$timeStamp);
		$fecha = "$dia de ". $meses[$mes] ." del $year";
		return $fecha;
	}

	function comprobarSesion(){
		if(!isset($_SESSION['admin'])){
			header('Location: ../index.php');
		}
	}
?> 
