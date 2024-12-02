<?php
require_once('../config.php');
Class Maestro extends ConexionDB {
	private $configuracion;
	public function __construct(){
		global $_configuracion;
		$this->configuracion = $_configuracion;
		parent::__construct();
	}
	public function __destruct(){
		parent::__destruct();
	}
	function capturar_error(){
		if(!$this->conn->error)
			return false;
		else{
			$resp['estado'] = 'fallido';
			$resp['error'] = $this->conn->error;
			return json_encode($resp);
			exit;
		}
	}
	function guardar_categoria(){
		extract($_POST);
		$datos = "";
		foreach($_POST as $k =>$v){
			if(!in_array($k,array('id','descripcion'))){
				if(!empty($datos)) $datos .=",";
				$datos .= " `{$k}`='{$v}' ";
			}
		}
		if(isset($_POST['descripcion'])){
			if(!empty($datos)) $datos .=",";
				$datos .= " `descripcion`='".addslashes(htmlentities($descripcion))."' ";
		}
		$verificar = $this->conn->query("SELECT * FROM `categorias` where `categoria` = '{$categoria}' ".(!empty($id) ? " and id != {$id} " : "")." ")->num_rows;
		if($this->capturar_error())
			return $this->capturar_error();
		if($verificar > 0){
			$resp['estado'] = 'fallido';
			$resp['msg'] = "La categoría ya existe.";
			return json_encode($resp);
			exit;
		}
		if(empty($id)){
			$sql = "INSERT INTO `categorias` set {$datos} ";
			$guardar = $this->conn->query($sql);
		}else{
			$sql = "UPDATE `categorias` set {$datos} where id = '{$id}' ";
			$guardar = $this->conn->query($sql);
		}
		if($guardar){
			$resp['estado'] = 'exitoso';
			if(empty($id))
				$this->configuracion->set_flashdata('exito',"Nueva categoría guardada exitosamente.");
			else
				$this->configuracion->set_flashdata('exito',"Categoría actualizada exitosamente.");
		}else{
			$resp['estado'] = 'fallido';
			$resp['err'] = $this->conn->error."[{$sql}]";
		}
		return json_encode($resp);
	}
	function eliminar_categoria(){
		extract($_POST);
		$eliminar = $this->conn->query("DELETE FROM `categorias` where id = '{$id}'");
		if($eliminar){
			$resp['estado'] = 'exitoso';
			$this->configuracion->set_flashdata('exito',"Categoría eliminada exitosamente.");
		}else{
			$resp['estado'] = 'fallido';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);
	}
	function guardar_servicio(){
		extract($_POST);
		$datos = "";
		$_POST['descripcion'] = addslashes(htmlentities($descripcion));
		foreach($_POST as $k =>$v){
			if(!in_array($k,array('id'))){
				if(!empty($datos)) $datos .=","; 
				$datos .= " `{$k}`='{$v}' ";
			}
		}
		$verificar = $this->conn->query("SELECT * FROM `lista_servicios` where `servicio` = '{$servicio}' ".(!empty($id) ? " and id != {$id} " : "")." ")->num_rows;
		if($this->capturar_error())
			return $this->capturar_error();
		if($verificar > 0){
			$resp['estado'] = 'fallido';
			$resp['msg'] = "El servicio ya existe.";
			return json_encode($resp);
			exit;
		}
		if(empty($id)){
			$sql = "INSERT INTO `lista_servicios` set {$datos} ";
			$guardar = $this->conn->query($sql);
		}else{
			$sql = "UPDATE `lista_servicios` set {$datos} where id = '{$id}' ";
			$guardar = $this->conn->query($sql);
		}
		if($guardar){
			$resp['estado'] = 'exitoso';
			if(empty($id))
				$this->configuracion->set_flashdata('exito',"Nuevo servicio guardado exitosamente.");
			else
				$this->configuracion->set_flashdata('exito',"Servicio actualizado exitosamente.");
		}else{
			$resp['estado'] = 'fallido';
			$resp['err'] = $this->conn->error."[{$sql}]";
		}
		return json_encode($resp);
	}
	function eliminar_servicio(){
		extract($_POST);
		$eliminar = $this->conn->query("DELETE FROM `lista_servicios` where id = '{$id}'");
		if($eliminar){
			$resp['estado'] = 'exitoso';
			$this->configuracion->set_flashdata('exito',"Servicio eliminado exitosamente.");
		}else{
			$resp['estado'] = 'fallido';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);
	}
	function guardar_mecanico(){
		extract($_POST);
		$datos = "";
		foreach($_POST as $k =>$v){
			if(!in_array($k,array('id'))){
				if(!empty($datos)) $datos .=","; 
				$datos .= " `{$k}`='{$v}' ";
			}
		}
		$verificar = $this->conn->query("SELECT * FROM `lista_mecanicos` where `nombre` = '{$nombre}' ".(!empty($id) ? " and id != {$id} " : "")." ")->num_rows;
		if($this->capturar_error())
			return $this->capturar_error();
		if($verificar > 0){
			$resp['estado'] = 'fallido';
			$resp['msg'] = "El mecánico ya existe.";
			return json_encode($resp);
			exit;
		}
		if(empty($id)){
			$sql = "INSERT INTO `lista_mecanicos` set {$datos} ";
			$guardar = $this->conn->query($sql);
		}else{
			$sql = "UPDATE `lista_mecanicos` set {$datos} where id = '{$id}' ";
			$guardar = $this->conn->query($sql);
		}
		if($guardar){
			$resp['estado'] = 'exitoso';
			if(empty($id))
				$this->configuracion->set_flashdata('exito',"Nuevo mecánico guardado exitosamente.");
			else
				$this->configuracion->set_flashdata('exito',"Mecánico actualizado exitosamente.");
		}else{
			$resp['estado'] = 'fallido';
			$resp['err'] = $this->conn->error."[{$sql}]";
		}
		return json_encode($resp);
	}
	function eliminar_mecanico(){
		extract($_POST);
		$eliminar = $this->conn->query("DELETE FROM `lista_mecanicos` where id = '{$id}'");
		if($eliminar){
			$resp['estado'] = 'exitoso';
			$this->configuracion->set_flashdata('exito',"Mecánico eliminado exitosamente.");
		}else{
			$resp['estado'] = 'fallido';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);
	}
	function guardar_solicitud(){
		extract($_POST);
		$datos = "";
		foreach($_POST as $k=> $v){
			if(in_array($k,array('nombre','categoria_id','tipo_servicio','mecanico_id','estado'))){
				if(!empty($datos)){ $datos .= ", "; }
				$datos .= " `{$k}` = '{$v}'";
			}
		}
		if(empty($id)){
			$sql = "INSERT INTO `solicitudes_servicio` set {$datos} ";
		}else{
			$sql = "UPDATE `solicitudes_servicio` set {$datos} where id ='{$id}'";
		}
		$guardar = $this->conn->query($sql);
		if($guardar){
			$rid = empty($id) ? $this->conn->insert_id : $id ;
			$datos = "";
			foreach($_POST as $k=> $v){
				if(!in_array($k,array('id','nombre','categoria_id','tipo_servicio','mecanico_id','estado'))){
					if(!empty($datos)){ $datos .= ", "; }
					if(is_array($_POST[$k]))
					$v = implode(",",$_POST[$k]);
					$v = $this->conn->real_escape_string($v);
					$datos .= "('{$rid}','{$k}','{$v}')";
				}
			}
			$sql = "INSERT INTO `meta_solicitudes` (`solicitud_id`,`campo_meta`,`valor_meta`) VALUES {$datos} ";
			$this->conn->query("DELETE FROM `meta_solicitudes` where `solicitud_id` = '{$rid}' ");
			$guardar = $this->conn->query($sql);
			if($guardar){
				$resp['estado'] = 'exitoso';
				$resp['id'] = $rid;
			}else{
				$resp['estado'] = 'fallido';
				$resp['msg'] = $this->conn->error;
				$resp['sql'] = $sql;
			}
		}else{
			$resp['estado'] = 'fallido';
			$resp['msg'] = $this->conn->error;
			$resp['sql'] = $sql;
		}
		return json_encode($resp);
	}
	function eliminar_solicitud(){
		extract($_POST);
		$eliminar = $this->conn->query("DELETE FROM `solicitudes_servicio` where id = '{$id}'");
		if($eliminar){
			$resp['estado'] = 'exitoso';
			$this->configuracion->set_flashdata('exito',"Solicitud eliminada exitosamente.");
		}else{
			$resp['estado'] = 'fallido';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);
	}
}

$Maestro = new Maestro();
$accion = !isset($_GET['f']) ? 'ninguna' : strtolower($_GET['f']);
$configuracion_sistema = new ConfiguracionSistema();
switch ($accion) {
	case 'guardar_categoria':
		echo $Maestro->guardar_categoria();
	break;
	case 'eliminar_categoria':
		echo $Maestro->eliminar_categoria();
	break;
	case 'guardar_servicio':
		echo $Maestro->guardar_servicio();
	break;
	case 'eliminar_servicio':
		echo $Maestro->eliminar_servicio();
	break;
	case 'guardar_mecanico':
		echo $Maestro->guardar_mecanico();
	break;
	case 'eliminar_mecanico':
		echo $Maestro->eliminar_mecanico();
	break;
	case 'guardar_solicitud':
		echo $Maestro->guardar_solicitud();
	break;
	case 'eliminar_solicitud':
		echo $Maestro->eliminar_solicitud();
	break;
	default:
		// echo $configuracion_sistema->index();
		break;
}
?>
