<?php
include ('calendar.php');
#buscar responsable
	if(isset($_GET['responsable'])){
		buscarResponsable();
	}

#buscar fechas con actividades
	if(isset($_GET['fecha']) and $usuario2!='general'){
		buscarEvento($_GET['fecha'],$usuario,$usuario2);
	}

	if(isset($_GET['fecha']) and $usuario2=='general'){
		buscarEventoSuper($_GET['fecha'],$usuario,$usuario2);
	}	

#registrar actividades
	if (isset($_GET['registrar'])){
		regitrarActividad($_GET['actividad'], $_GET['descripcion'],$_GET['hinicio'],$_GET['hfin'],$_GET["fecha_i"],$_GET['lugar'],$_GET['notas'],$_GET["destino"], $usuario, $_GET['responsable'],$_GET['lugar_re'],$email);
	}

#registrar actividades que se repiten
	if (isset($_GET['registrarRE'])){
		regitrarActividadRepetida($_GET['actividad'], $_GET['descripcion'],$_GET['hinicio'],$_GET['hfin'],$_GET["fecha_i"],$_GET['lugar'],$_GET['notas'],$_GET["destino"], $usuario, $_GET['responsable'],$_GET['lugar_re'], $_GET['codigo'],$email);
	}
#modificar actividades
	if (isset($_GET['modificar'])){
		modificarActividad($_GET['actividad_m'], $_GET['descripcion_m'],$_GET['hinicio_m'],$_GET['hfin_m'],$_GET["fecha_im"],$_GET['lugar_m'],$_GET['notas_m'],$_GET["destino_m"], $_GET["id_m"], $_GET["responsable_m"],$usuario, $_GET['lugar_mod'],$email);
	}

#aplazar feha u hora de una actividad
#modificar actividades
	if (isset($_GET['aplazar'])){
		aplazarActividad($_GET['hinicio_ac'],$_GET['hfin_ac'],$_GET["fecha_ac"],$_GET['notas_ac'],$_GET["id_ac"],$email);
	}	

#Buscar actividades
	if(isset($_GET['actividad'])){
		buscarActividad($_GET['actividad'],$usuario,$usuario2);
	}

#Mostrar actividades
	if(isset($_GET['verActividad'])){
		mostrarActividad($_GET['verActividad']);
	}	

#eliminar actividad
	if(isset($_GET['eliminar'])){
		eliminarActividad($_GET['eliminar'],$_GET['fechae']);
	}

#cambiar estado actividad
	if(isset($_GET['estado'])){
		cambiarEstado($_GET['estado']);
	}				

###################notas

#Registrar nota
	if(isset($_GET['registrar_not'])){
		regitrarNota($_GET['registrar_not'], $_GET['hora'],$_GET['fecha'],$usuario);
	}	

#buscar nota
	if(isset($_GET['buscar_nota'])){
		buscarNotas($_GET['buscar_nota'],$usuario,$usuario2);
	}		
#buscar contenido nota
	if(isset($_GET['contenido_nota'])){
		valorNota($_GET['contenido_nota'],$usuario);
	}	

#buscar modificar nota
	if(isset($_GET['modificar_nota'])){
		modificarNota($_GET['modificar_nota'],$_GET['comen'],$usuario);
	}		

#buscar eliminar nota
	if(isset($_GET['eliminar_nota'])){
		eliminarNota($_GET['eliminar_nota'],$usuario);
	}

##################################### historial de eventos
	#buscar lugar
	if(isset($_GET['buscarLugar'])){
		cargarLugar($usuario2);
	}


	#buscar historial
	if(isset($_GET['buscarHistorial'])){
		//echo $usuario2;
		validarUsuarioBuscar($usuario,$usuario2,$_GET['order'],$_GET['parmOrder'],$_GET['anio'],$_GET['mes'],$_GET['dia'],$_GET['lugar'],$_GET['repetido']);
	}

	#buscar cargar anio
	if(isset($_GET['cargarAnio'])){
		cargarAnio($usuario,$usuario2,$_GET['lugar']);
	}	

# buscar cargar meses
	if(isset($_GET['cargarMeses'])){
		cargarMeses($usuario,$usuario2,$_GET['lugar'],$_GET['repetido']);
	}		

# buscar cargar dias
	if(isset($_GET['cargarDias'])){
		cargarDias($usuario,$usuario2,$_GET['mes'],$_GET['lugar'],$_GET['repetido']);
	}	
?>