<?
$ruta_a_joomla = "/../../Hdarien/";

define( '_JEXEC', 1 );
define( 'JPATH_BASE', realpath(dirname(__FILE__).$ruta_a_joomla ));
define( 'DS', DIRECTORY_SEPARATOR );

require_once ( JPATH_BASE .DS.'includes'.DS.'defines.php' );
require_once ( JPATH_BASE .DS.'includes'.DS.'framework.php' );
require_once ( JPATH_BASE .DS.'configuration.php' );
$mainframe =& JFactory::getApplication('site');
$mainframe->initialise();
$userx = &JFactory::getUser();
	$usuario= $userx->username;
if (JFactory::getUser()->usertype == NULL)
    JError::raiseError(1,"No puede acceder A esta Aplicación sin estar logueado... Consulte al Administrador....!!!");
$userx = JFactory::getUser();
?>
<?php require_once('Connections/conexion.php'); ?>
<script langiage="javascript" type="text/javascript">


function mano(a) { 
    if (navigator.appName=="Netscape") { 
        a.style.cursor='pointer'; 
    } else { 
        a.style.cursor='hand'; 
    } 
}

// RESALTAR LAS FILAS AL PASAR EL MOUSE
function ResaltarFila(id_fila) {
    document.getElementById(id_fila).style.backgroundColor = '#C0C0C0';
}
 
// RESTABLECER EL FONDO DE LAS FILAS AL QUITAR EL FOCO
function RestablecerFila(id_fila) {
    document.getElementById(id_fila).style.backgroundColor = '#FFFFFF';
}
 
// CONVERTIR LAS FILAS EN LINKS
function CrearEnlace(url) {
    location.href=url;
}
</script>
<?
@$vacuno=$_GET['vacuno'];
$date= date("d/m/Y");
$anoss= date("Y"); // Year (2003)


//	++++++++++++++++++++++++++++++					MACHOS				++++++++++++++++++++++++++++++++++++++++++++++++++++
//crias hembra enero
$enerm = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where  YEAR(fecha) = '$anoss' AND MONTH(fecha) = '01' AND concep = 'Egreso'",$conexion);
$row01m = mysql_fetch_array($enerm, MYSQL_ASSOC);
$cria_macho_enero= number_format ($row01m["total"]);
$cria_macho_enero1= $row01m["total"];


//crias hembra febrero
$febr = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where  YEAR(fecha) = '$anoss' AND MONTH(fecha) = '02' AND concep = 'Egreso' ",$conexion);
$row02 = mysql_fetch_array($febr, MYSQL_ASSOC);
$cria_macho_febrero= number_format ($row02["total"]);
$cria_macho_febrero1= $row02["total"];

//crias hembra marzo

$marz = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where  YEAR(fecha) = '$anoss' AND MONTH(fecha) = '03' AND concep = 'Egreso'",$conexion);
$row03 = mysql_fetch_array($marz, MYSQL_ASSOC);
$cria_macho_marzo= number_format ($row03["total"]);
$cria_macho_marzo1= $row03["total"];

//crias hembra abril

$abri = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where  YEAR(fecha) = '$anoss' AND MONTH(fecha) = '04' AND concep = 'Egreso'",$conexion);

$row04 = mysql_fetch_array($abri, MYSQL_ASSOC);
$cria_macho_abril= number_format ($row04["total"]);
$cria_macho_abril1= $row04["total"];

//crias hembra mayo

$mayo = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where  YEAR(fecha) = '$anoss' AND MONTH(fecha) = '05' AND concep = 'Egreso' ",$conexion);
$row05 = mysql_fetch_array($mayo, MYSQL_ASSOC);
$cria_macho_mayo= number_format ($row05["total"]);
$cria_macho_mayo1= $row05["total"];

//crias hembra junio

$juni = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where  YEAR(fecha) = '$anoss' AND MONTH(fecha) = '06' AND concep = 'Egreso' ",$conexion);
$row06 = mysql_fetch_array($juni, MYSQL_ASSOC);
$cria_macho_junio= number_format ($row06["total"]);
$cria_macho_junio1= $row06["total"];

//crias hembra julio

$juli = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where  YEAR(fecha) = '$anoss' AND MONTH(fecha) = '07' AND concep = 'Egreso' ",$conexion);
$row07 = mysql_fetch_array($juli, MYSQL_ASSOC);
$cria_macho_julio= number_format ($row07["total"]);
$cria_macho_julio1=($row07["total"]);

//crias hembra agosto

$agos = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where  YEAR(fecha) = '$anoss' AND MONTH(fecha) = '08' AND concep = 'Egreso' ",$conexion);
$row08 = mysql_fetch_array($agos, MYSQL_ASSOC);
$cria_macho_agosto= number_format ($row08["total"]);
$cria_macho_agosto1= ($row08["total"]);

//crias hembra septiembre

$sept = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where  YEAR(fecha) = '$anoss' AND MONTH(fecha) = '09' AND concep = 'Egreso' ",$conexion);
$row09 = mysql_fetch_array($sept, MYSQL_ASSOC);
$cria_macho_septi= number_format ($row09["total"]);
$cria_macho_septi1= ($row09["total"]);

//crias hembra octubre

$octu = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where  YEAR(fecha) = '$anoss' AND MONTH(fecha) = '10' AND concep = 'Egreso' ",$conexion);

$row10 = mysql_fetch_array($octu, MYSQL_ASSOC);
$cria_macho_octubre= number_format ($row10["total"]);
$cria_macho_octubre1=($row10["total"]);
//crias hembra noviembre

$novi = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where  YEAR(fecha) = '$anoss' AND MONTH(fecha) = '11' AND concep = 'Egreso' ",$conexion);
$row11 = mysql_fetch_array($novi, MYSQL_ASSOC);
$cria_macho_noviem= number_format ($row11["total"]);
$cria_macho_noviem1=($row11["total"]);
//crias hembra diciembre
$dici = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where  YEAR(fecha) = '$anoss' AND MONTH(fecha) = '12' AND concep = 'Egreso' ",$conexion);
$row12 = mysql_fetch_array($dici, MYSQL_ASSOC);
$cria_macho_dici= number_format ($row12["total"]);
$cria_macho_dici1=($row12["total"]);
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


//crias hembra enero
$ener = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where  YEAR(fecha) = '$anoss' AND MONTH(fecha) = '01' AND concep = 'Ingreso' ",$conexion);
$row01 = mysql_fetch_array($ener, MYSQL_ASSOC);
$cria_hembra_enero= number_format ($row01["total"]);
$cria_hembra_enero1= ($row01["total"]);

//crias hembra febrero
$febr = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where  YEAR(fecha) = '$anoss' AND MONTH(fecha) = '02' AND concep = 'Ingreso'",$conexion);
$row02 = mysql_fetch_array($febr, MYSQL_ASSOC);
$cria_hembra_febrero= number_format ($row02["total"]);
$cria_hembra_febrero1= ($row02["total"]);

//crias hembra marzo

$marz = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where  YEAR(fecha) = '$anoss' AND MONTH(fecha) = '03' AND concep = 'Ingreso' ",$conexion);
$row03 = mysql_fetch_array($marz, MYSQL_ASSOC);
$cria_hembra_marzo= number_format ($row03["total"]);
$cria_hembra_marzo1=($row03["total"]);

//crias hembra abril

$abri = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where  YEAR(fecha) = '$anoss' AND MONTH(fecha) = '04' AND concep = 'Ingreso' ",$conexion);

$row04 = mysql_fetch_array($abri, MYSQL_ASSOC);
$cria_hembra_abril= number_format ($row04["total"]);
$cria_hembra_abril1=($row04["total"]);

//crias hembra mayo

$mayo = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where  YEAR(fecha) = '$anoss' AND MONTH(fecha) = '05' AND concep = 'Ingreso'",$conexion);
$row05 = mysql_fetch_array($mayo, MYSQL_ASSOC);
$cria_hembra_mayo= number_format ($row05["total"]);
$cria_hembra_mayo1= ($row05["total"]);

//crias hembra junio

$juni = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where  YEAR(fecha) = '$anoss' AND MONTH(fecha) = '06' AND concep = 'Ingreso'",$conexion);
$row06 = mysql_fetch_array($juni, MYSQL_ASSOC);
$cria_hembrao_junio= number_format ($row06["total"]);
$cria_hembrao_junio1=($row06["total"]);

//crias hembra julio

$juli = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where  YEAR(fecha) = '$anoss' AND MONTH(fecha) = '07' AND concep = 'Ingreso'",$conexion);
$row07 = mysql_fetch_array($juli, MYSQL_ASSOC);
$cria_hembra_julio= number_format ($row07["total"]);
$cria_hembra_julio1= ($row07["total"]);

//crias hembra agosto

$agos = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where  YEAR(fecha) = '$anoss' AND MONTH(fecha) = '08' AND concep = 'Ingreso'",$conexion);
$row08 = mysql_fetch_array($agos, MYSQL_ASSOC);
$cria_hembra_agosto= number_format ($row08["total"]);
$cria_hembra_agosto1= ($row08["total"]);


//crias hembra septiembre

$sept = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where  YEAR(fecha) = '$anoss' AND MONTH(fecha) = '09' AND concep = 'Ingreso'",$conexion);
$row09 = mysql_fetch_array($sept, MYSQL_ASSOC);
$cria_hembra_septi= number_format ($row09["total"]);
$cria_hembra_septi1=  ($row09["total"]);

//crias hembra octubre

$octu = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where  YEAR(fecha) = '$anoss' AND MONTH(fecha) = '10' AND concep = 'Ingreso'",$conexion);

$row10 = mysql_fetch_array($octu, MYSQL_ASSOC);
$cria_hembra_octubre= number_format ($row10["total"]);
$cria_hembra_octubre1=($row10["total"]);
//crias hembra noviembre

$novi = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where  YEAR(fecha) = '$anoss' AND MONTH(fecha) = '11' AND concep = 'Ingreso'",$conexion);
$row11 = mysql_fetch_array($novi, MYSQL_ASSOC);
$cria_hembra_noviem= number_format ($row11["total"]);
$cria_hembra_noviem1= ($row11["total"]);
//crias hembra diciembre
$dici = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where  YEAR(fecha) = '$anoss' AND MONTH(fecha) = '12' AND concep = 'Ingreso'",$conexion);
$row12 = mysql_fetch_array($dici, MYSQL_ASSOC);
$cria_hembra_dici= number_format ($row12["total"]);
$cria_hembra_dici1=  ($row12["total"]);

//	++++++++++++++++++++++++++++++		RESTAURANTE COMPRAS	++++++++++++++++++++++++++++++++++++++++++++++++++++
//crias hembra enero
$enerr = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where  YEAR(fecha) = '$anoss' AND MONTH(fecha) = '01' AND concep = 'Egreso' and comen='Restaurante'",$conexion);
$row01r = mysql_fetch_array($enerr, MYSQL_ASSOC);
$cria_macho_eneror= number_format ($row01r["total"]);
$cria_macho_enero1r= $row01r["total"];

//crias hembra febrero
$febr = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where  YEAR(fecha) = '$anoss' AND MONTH(fecha) = '02' AND concep = 'Egreso'and comen='Restaurante' ",$conexion);
$row02 = mysql_fetch_array($febr, MYSQL_ASSOC);
$cria_macho_febreror= number_format ($row02["total"]);
$cria_macho_febrero1r= $row02["total"];

//crias hembra marzo

$marz = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where  YEAR(fecha) = '$anoss' AND MONTH(fecha) = '03' AND concep = 'Egreso'and comen='Restaurante'",$conexion);
$row03 = mysql_fetch_array($marz, MYSQL_ASSOC);
$cria_macho_marzor= number_format ($row03["total"]);
$cria_macho_marzo1r= $row03["total"];

//crias hembra abril

$abri = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where  YEAR(fecha) = '$anoss' AND MONTH(fecha) = '04' AND concep = 'Egreso' and comen='Restaurante'",$conexion);

$row04 = mysql_fetch_array($abri, MYSQL_ASSOC);
$cria_macho_abrilr= number_format ($row04["total"]);
$cria_macho_abril1r= $row04["total"];

//crias hembra mayo

$mayo = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where  YEAR(fecha) = '$anoss' AND MONTH(fecha) = '05' AND concep = 'Egreso' and comen='Restaurante' ",$conexion);
$row05 = mysql_fetch_array($mayo, MYSQL_ASSOC);
$cria_macho_mayor= number_format ($row05["total"]);
$cria_macho_mayo1r= $row05["total"];

//crias hembra junio

$juni = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where  YEAR(fecha) = '$anoss' AND MONTH(fecha) = '06' AND concep = 'Egreso' and comen='Restaurante'",$conexion);
$row06 = mysql_fetch_array($juni, MYSQL_ASSOC);
$cria_macho_junior= number_format ($row06["total"]);
$cria_macho_junio1r= $row06["total"];

//crias hembra julio

$juli = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where  YEAR(fecha) = '$anoss' AND MONTH(fecha) = '07' AND concep = 'Egreso' and comen='Restaurante' ",$conexion);
$row07 = mysql_fetch_array($juli, MYSQL_ASSOC);
$cria_macho_julior= number_format ($row07["total"]);
$cria_macho_julio1r=($row07["total"]);

//crias hembra agosto

$agos = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where  YEAR(fecha) = '$anoss' AND MONTH(fecha) = '08' AND concep = 'Egreso' and comen='Restaurante' ",$conexion);
$row08 = mysql_fetch_array($agos, MYSQL_ASSOC);
$cria_macho_agostor= number_format ($row08["total"]);
$cria_macho_agosto1r= ($row08["total"]);

//crias hembra septiembre

$sept = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where  YEAR(fecha) = '$anoss' AND MONTH(fecha) = '09' AND concep = 'Egreso' and comen='Restaurante'",$conexion);
$row09 = mysql_fetch_array($sept, MYSQL_ASSOC);
$cria_macho_septir= number_format ($row09["total"]);
$cria_macho_septi1r= ($row09["total"]);

//crias hembra octubre

$octu = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where  YEAR(fecha) = '$anoss' AND MONTH(fecha) = '10' AND concep = 'Egreso' and comen='Restaurante' ",$conexion);

$row10 = mysql_fetch_array($octu, MYSQL_ASSOC);
$cria_macho_octubrer= number_format ($row10["total"]);
$cria_macho_octubre1r=($row10["total"]);
//crias hembra noviembre

$novi = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where  YEAR(fecha) = '$anoss' AND MONTH(fecha) = '11' AND concep = 'Egreso' and comen='Restaurante'",$conexion);
$row11 = mysql_fetch_array($novi, MYSQL_ASSOC);
$cria_macho_noviemr= number_format ($row11["total"]);
$cria_macho_noviem1r=($row11["total"]);
//crias hembra diciembre
$dici = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where  YEAR(fecha) = '$anoss' AND MONTH(fecha) = '12' AND concep = 'Egreso' and comen='Restaurante'",$conexion);
$row12 = mysql_fetch_array($dici, MYSQL_ASSOC);
$cria_macho_dicir= number_format ($row12["total"]);
$cria_macho_dici1r=($row12["total"]);

////////////////////////////////////////////////RESTAURANTE VENTAS/////////////////////////////////////////////////////////////////////


//crias hembra enero
$enerrv = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where  YEAR(fecha) = '$anoss' AND MONTH(fecha) = '01' AND concep = 'Ingreso' and comen='Restaurante' ",$conexion);
$row01rv = mysql_fetch_array($enerrv, MYSQL_ASSOC);
$cria_hembra_enerorv= number_format ($row01rv["total"]);
$cria_hembra_enero1rv= ($row01rv["total"]);

//crias hembra febrero
$febrrv = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where  YEAR(fecha) = '$anoss' AND MONTH(fecha) = '02' AND concep = 'Ingreso' and comen='Restaurante'",$conexion);
$row02rv = mysql_fetch_array($febrrv, MYSQL_ASSOC);
$cria_hembra_febrerorv= number_format ($row02rv["total"]);
$cria_hembra_febrero1rv= ($row02rv["total"]);

//crias hembra marzo

$marzrv = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where  YEAR(fecha) = '$anoss' AND MONTH(fecha) = '03' AND concep = 'Ingreso' and comen='Restaurante'",$conexion);
$row03rv = mysql_fetch_array($marzrv, MYSQL_ASSOC);
$cria_hembra_marzorv= number_format ($row03rv["total"]);
$cria_hembra_marzo1rv=($row03rv["total"]);

//crias hembra abril

$abrirv = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where  YEAR(fecha) = '$anoss' AND MONTH(fecha) = '04' AND concep = 'Ingreso' and comen='Restaurante' ",$conexion);

$row04rv = mysql_fetch_array($abrirv, MYSQL_ASSOC);
$cria_hembra_abrilrv= number_format ($row04rv["total"]);
$cria_hembra_abril1rv=($row04rv["total"]);

//crias hembra mayo

$mayorv = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where  YEAR(fecha) = '$anoss' AND MONTH(fecha) = '05' AND concep = 'Ingreso' and comen='Restaurante'",$conexion);
$row05rv = mysql_fetch_array($mayorv, MYSQL_ASSOC);
$cria_hembra_mayorv= number_format ($row05rv["total"]);
$cria_hembra_mayo1rv= ($row05rv["total"]);

//crias hembra junio

$junirv = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where  YEAR(fecha) = '$anoss' AND MONTH(fecha) = '06' AND concep = 'Ingreso' and comen='Restaurante'",$conexion);
$row06rv = mysql_fetch_array($junirv, MYSQL_ASSOC);
$cria_hembrao_juniorv= number_format ($row06rv["total"]);
$cria_hembrao_junio1rv=($row06rv["total"]);

//crias hembra julio

$julirv = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where  YEAR(fecha) = '$anoss' AND MONTH(fecha) = '07' AND concep = 'Ingreso' and comen='Restaurante'",$conexion);
$row07rv = mysql_fetch_array($julirv, MYSQL_ASSOC);
$cria_hembra_juliorv= number_format ($row07rv["total"]);
$cria_hembra_julio1rv= ($row07rv["total"]);

//crias hembra agosto

$agosrv = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where  YEAR(fecha) = '$anoss' AND MONTH(fecha) = '08' AND concep = 'Ingreso' and comen='Restaurante'",$conexion);
$row08rv = mysql_fetch_array($agosrv, MYSQL_ASSOC);
$cria_hembra_agostorv= number_format ($row08rv["total"]);
$cria_hembra_agosto1rv= ($row08rv["total"]);


//crias hembra septiembre

$septrv = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where  YEAR(fecha) = '$anoss' AND MONTH(fecha) = '09' AND concep = 'Ingreso' and comen='Restaurante'",$conexion);
$row09rv = mysql_fetch_array($septrv, MYSQL_ASSOC);
$cria_hembra_septirv= number_format ($row09rv["total"]);
$cria_hembra_septi1rv=  ($row09rv["total"]);

//crias hembra octubre

$octurv = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where  YEAR(fecha) = '$anoss' AND MONTH(fecha) = '10' AND concep = 'Ingreso' and comen='Restaurante'",$conexion);

$row10rv = mysql_fetch_array($octurv, MYSQL_ASSOC);
$cria_hembra_octubrerv= number_format ($row10rv["total"]);
$cria_hembra_octubre1rv=($row10rv["total"]);
//crias hembra noviembre

$novirv = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where  YEAR(fecha) = '$anoss' AND MONTH(fecha) = '11' AND concep = 'Ingreso' and comen='Restaurante'",$conexion);
$row11rv = mysql_fetch_array($novirv, MYSQL_ASSOC);
$cria_hembra_noviemrv= number_format ($row11rv["total"]);
$cria_hembra_noviem1rv= ($row11rv["total"]);
//crias hembra diciembre
$dicirv = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where  YEAR(fecha) = '$anoss' AND MONTH(fecha) = '12' AND concep = 'Ingreso' and comen='Restaurante'",$conexion);
$row12rv = mysql_fetch_array($dicirv, MYSQL_ASSOC);
$cria_hembra_dicirv= number_format ($row12rv["total"]);
$cria_hembra_dici1rv=  ($row12rv["total"]);
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

//	++++++++++++++++++++++++++++++		HOTEL COMPRAS	++++++++++++++++++++++++++++++++++++++++++++++++++++
//crias hembra enero
$enerh = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where  YEAR(fecha) = '$anoss' AND MONTH(fecha) = '01' AND concep = 'Egreso' and comen='Hotel'",$conexion);
$row01h = mysql_fetch_array($enerh, MYSQL_ASSOC);
$cria_macho_eneroh= number_format ($row01h["total"]);
$cria_macho_enero1h= $row01h["total"];

//crias hembra febrero
$febh = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where  YEAR(fecha) = '$anoss' AND MONTH(fecha) = '02' AND concep = 'Egreso'and comen='Hotel' ",$conexion);
$row02h = mysql_fetch_array($febh, MYSQL_ASSOC);
$cria_macho_febreroh= number_format ($row02h["total"]);
$cria_macho_febrero1h= $row02h["total"];

//crias hembra marzo

$marzh = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where  YEAR(fecha) = '$anoss' AND MONTH(fecha) = '03' AND concep = 'Egreso'and comen='Hotel'",$conexion);
$row03h = mysql_fetch_array($marzh, MYSQL_ASSOC);
$cria_macho_marzoh= number_format ($row03h["total"]);
$cria_macho_marzo1h= $row03h["total"];

//crias hembra abril

$abrih = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where  YEAR(fecha) = '$anoss' AND MONTH(fecha) = '04' AND concep = 'Egreso' and comen='Hotel'",$conexion);

$row04h = mysql_fetch_array($abrih, MYSQL_ASSOC);
$cria_macho_abrilh= number_format ($row04h["total"]);
$cria_macho_abril1h= $row04h["total"];

//crias hembra mayo

$mayoh = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where  YEAR(fecha) = '$anoss' AND MONTH(fecha) = '05' AND concep = 'Egreso' and comen='Hotel' ",$conexion);
$row05h = mysql_fetch_array($mayoh, MYSQL_ASSOC);
$cria_macho_mayoh= number_format ($row05h["total"]);
$cria_macho_mayo1h= $row05h["total"];

//crias hembra junio

$junih = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where  YEAR(fecha) = '$anoss' AND MONTH(fecha) = '06' AND concep = 'Egreso' and comen='Hotel'",$conexion);
$row06h = mysql_fetch_array($junih, MYSQL_ASSOC);
$cria_macho_junioh= number_format ($row06h["total"]);
$cria_macho_junio1h= $row06h["total"];

//crias hembra julio

$julih = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where  YEAR(fecha) = '$anoss' AND MONTH(fecha) = '07' AND concep = 'Egreso' and comen='Hotel' ",$conexion);
$row07h = mysql_fetch_array($julih, MYSQL_ASSOC);
$cria_macho_julioh= number_format ($row07h["total"]);
$cria_macho_julio1h=($row07h["total"]);

//crias hembra agosto

$agosh = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where  YEAR(fecha) = '$anoss' AND MONTH(fecha) = '08' AND concep = 'Egreso' and comen='Hotel' ",$conexion);
$row08h = mysql_fetch_array($agosh, MYSQL_ASSOC);
$cria_macho_agostoh= number_format ($row08h["total"]);
$cria_macho_agosto1h= ($row08h["total"]);

//crias hembra septiembre

$septh = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where  YEAR(fecha) = '$anoss' AND MONTH(fecha) = '09' AND concep = 'Egreso' and comen='Hotel'",$conexion);
$row09h = mysql_fetch_array($septh, MYSQL_ASSOC);
$cria_macho_septih= number_format ($row09h["total"]);
$cria_macho_septi1h= ($row09h["total"]);

//crias hembra octubre

$octuh = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where  YEAR(fecha) = '$anoss' AND MONTH(fecha) = '10' AND concep = 'Egreso' and comen='Hotel' ",$conexion);

$row10h = mysql_fetch_array($octuh, MYSQL_ASSOC);
$cria_macho_octubreh= number_format ($row10h["total"]);
$cria_macho_octubre1h=($row10h["total"]);
//crias hembra noviembre

$novih = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where  YEAR(fecha) = '$anoss' AND MONTH(fecha) = '11' AND concep = 'Egreso' and comen='Hotel'",$conexion);
$row11h = mysql_fetch_array($novih, MYSQL_ASSOC);
$cria_macho_noviemh= number_format ($row11h["total"]);
$cria_macho_noviem1h=($row11h["total"]);
//crias hembra diciembre
$dicih = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where  YEAR(fecha) = '$anoss' AND MONTH(fecha) = '12' AND concep = 'Egreso' and comen='Hotel'",$conexion);
$row12h = mysql_fetch_array($dicih, MYSQL_ASSOC);
$cria_macho_dicih= number_format ($row12h["total"]);
$cria_macho_dici1h=($row12h["total"]);

////////////////////////////////////////////////HOTEL VENTAS/////////////////////////////////////////////////////////////////////


//crias hembra enero
$enerhv = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where  YEAR(fecha) = '$anoss' AND MONTH(fecha) = '01' AND concep = 'Ingreso' and comen='Hotel' ",$conexion);
$row01hv = mysql_fetch_array($enerhv, MYSQL_ASSOC);
$cria_hembra_enerohv= number_format ($row01hv["total"]);
$cria_hembra_enero1hv= ($row01hv["total"]);

//crias hembra febrero
$febrhv = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where  YEAR(fecha) = '$anoss' AND MONTH(fecha) = '02' AND concep = 'Ingreso' and comen='Hotel'",$conexion);
$row02hv = mysql_fetch_array($febrhv, MYSQL_ASSOC);
$cria_hembra_febrerohv= number_format ($row02hv["total"]);
$cria_hembra_febrero1hv= ($row02hv["total"]);

//crias hembra marzo

$marzhv = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where  YEAR(fecha) = '$anoss' AND MONTH(fecha) = '03' AND concep = 'Ingreso' and comen='Hotel'",$conexion);
$row03hv = mysql_fetch_array($marzhv, MYSQL_ASSOC);
$cria_hembra_marzohv= number_format ($row03hv["total"]);
$cria_hembra_marzo1hv=($row03hv["total"]);

//crias hembra abril

$abrihv = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where  YEAR(fecha) = '$anoss' AND MONTH(fecha) = '04' AND concep = 'Ingreso' and comen='Hotel' ",$conexion);

$row04hv = mysql_fetch_array($abrihv, MYSQL_ASSOC);
$cria_hembra_abrilhv= number_format ($row04hv["total"]);
$cria_hembra_abril1hv=($row04hv["total"]);

//crias hembra mayo

$mayohv = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where  YEAR(fecha) = '$anoss' AND MONTH(fecha) = '05' AND concep = 'Ingreso' and comen='Hotel'",$conexion);
$row05hv = mysql_fetch_array($mayohv, MYSQL_ASSOC);
$cria_hembra_mayohv= number_format ($row05hv["total"]);
$cria_hembra_mayo1hv= ($row05hv["total"]);

//crias hembra junio

$junihv = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where  YEAR(fecha) = '$anoss' AND MONTH(fecha) = '06' AND concep = 'Ingreso' and comen='Hotel'",$conexion);
$row06hv = mysql_fetch_array($junihv, MYSQL_ASSOC);
$cria_hembrao_juniohv= number_format ($row06hv["total"]);
$cria_hembrao_junio1hv=($row06hv["total"]);

//crias hembra julio

$julihv = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where  YEAR(fecha) = '$anoss' AND MONTH(fecha) = '07' AND concep = 'Ingreso' and comen='Hotel'",$conexion);
$row07hv = mysql_fetch_array($julihv, MYSQL_ASSOC);
$cria_hembra_juliohv= number_format ($row07hv["total"]);
$cria_hembra_julio1hv= ($row07hv["total"]);

//crias hembra agosto

$agoshv = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where  YEAR(fecha) = '$anoss' AND MONTH(fecha) = '08' AND concep = 'Ingreso' and comen='Hotel'",$conexion);
$row08hv = mysql_fetch_array($agoshv, MYSQL_ASSOC);
$cria_hembra_agostohv= number_format ($row08hv["total"]);
$cria_hembra_agosto1hv= ($row08hv["total"]);


//crias hembra septiembre

$septhv = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where  YEAR(fecha) = '$anoss' AND MONTH(fecha) = '09' AND concep = 'Ingreso' and comen='Hotel'",$conexion);
$row09hv = mysql_fetch_array($septhv, MYSQL_ASSOC);
$cria_hembra_septihv= number_format ($row09hv["total"]);
$cria_hembra_septi1hv=  ($row09hv["total"]);

//crias hembra octubre

$octuhv = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where  YEAR(fecha) = '$anoss' AND MONTH(fecha) = '10' AND concep = 'Ingreso' and comen='Hotel'",$conexion);

$row10hv = mysql_fetch_array($octuhv, MYSQL_ASSOC);
$cria_hembra_octubrehv= number_format ($row10hv["total"]);
$cria_hembra_octubre1hv=($row10hv["total"]);
//crias hembra noviembre

$novihv = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where  YEAR(fecha) = '$anoss' AND MONTH(fecha) = '11' AND concep = 'Ingreso' and comen='Hotel'",$conexion);
$row11hv = mysql_fetch_array($novihv, MYSQL_ASSOC);
$cria_hembra_noviemhv= number_format ($row11hv["total"]);
$cria_hembra_noviem1hv= ($row11hv["total"]);
//crias hembra diciembre
$dicihv = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where  YEAR(fecha) = '$anoss' AND MONTH(fecha) = '12' AND concep = 'Ingreso' and comen='Hotel'",$conexion);
$row12hv = mysql_fetch_array($dicihv, MYSQL_ASSOC);
$cria_hembra_dicihv= number_format ($row12hv["total"]);
$cria_hembra_dici1hv=  ($row12hv["total"]);
//echo "Ventas".$cria_hembra_enerorv."-Compras".$cria_macho_eneror ."-Total".($cria_hembra_enero1rv + $cria_macho_enero1r);
//echo number_format ($cria_hembra_enero1rv +$cria_macho_enero1r;
//--------------------------------------------------------------------------------------------------------------------------------------
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

//	++++++++++++++++++++++++++++++		BEBIDAS COMPRAS	++++++++++++++++++++++++++++++++++++++++++++++++++++
//crias hembra enero
$enerb = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where  YEAR(fecha) = '$anoss' AND MONTH(fecha) = '01' AND concep = 'Egreso' and comen='Bebidas'",$conexion);
$row01b = mysql_fetch_array($enerb, MYSQL_ASSOC);
$cria_macho_enerob= number_format ($row01b["total"]);
$cria_macho_enero1b= $row01b["total"];

//crias hembra febrero
$febb = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where  YEAR(fecha) = '$anoss' AND MONTH(fecha) = '02' AND concep = 'Egreso'and comen='Bebidas' ",$conexion);
$row02b = mysql_fetch_array($febb, MYSQL_ASSOC);
$cria_macho_febrerob= number_format ($row02b["total"]);
$cria_macho_febrero1b= $row02b["total"];

//crias hembra marzo

$marzb = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where  YEAR(fecha) = '$anoss' AND MONTH(fecha) = '03' AND concep = 'Egreso'and comen='Bebidas'",$conexion);
$row03b = mysql_fetch_array($marzb, MYSQL_ASSOC);
$cria_macho_marzob= number_format ($row03b["total"]);
$cria_macho_marzo1b= $row03b["total"];

//crias hembra abril

$abrib = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where  YEAR(fecha) = '$anoss' AND MONTH(fecha) = '04' AND concep = 'Egreso' and comen='Bebidas'",$conexion);

$row04b = mysql_fetch_array($abrib, MYSQL_ASSOC);
$cria_macho_abrilb= number_format ($row04b["total"]);
$cria_macho_abril1b= $row04b["total"];

//crias hembra mayo

$mayob = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where  YEAR(fecha) = '$anoss' AND MONTH(fecha) = '05' AND concep = 'Egreso' and comen='Bebidas' ",$conexion);
$row05b = mysql_fetch_array($mayob, MYSQL_ASSOC);
$cria_macho_mayob= number_format ($row05b["total"]);
$cria_macho_mayo1b= $row05b["total"];

//crias hembra junio

$junib = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where  YEAR(fecha) = '$anoss' AND MONTH(fecha) = '06' AND concep = 'Egreso' and comen='Bebidas'",$conexion);
$row06b = mysql_fetch_array($junib, MYSQL_ASSOC);
$cria_macho_juniob= number_format ($row06b["total"]);
$cria_macho_junio1b= $row06b["total"];

//crias hembra julio

$julib = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where  YEAR(fecha) = '$anoss' AND MONTH(fecha) = '07' AND concep = 'Egreso' and comen='Bebidas' ",$conexion);
$row07b = mysql_fetch_array($julib, MYSQL_ASSOC);
$cria_macho_juliob= number_format ($row07b["total"]);
$cria_macho_julio1b=($row07b["total"]);

//crias hembra agosto

$agosb = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where  YEAR(fecha) = '$anoss' AND MONTH(fecha) = '08' AND concep = 'Egreso' and comen='Bebidas' ",$conexion);
$row08b = mysql_fetch_array($agosb, MYSQL_ASSOC);
$cria_macho_agostob= number_format ($row08b["total"]);
$cria_macho_agosto1b= ($row08b["total"]);

//crias hembra septiembre

$septb = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where  YEAR(fecha) = '$anoss' AND MONTH(fecha) = '09' AND concep = 'Egreso' and comen='Bebidas'",$conexion);
$row09b = mysql_fetch_array($septb, MYSQL_ASSOC);
$cria_macho_septib= number_format ($row09b["total"]);
$cria_macho_septi1b= ($row09b["total"]);

//crias hembra octubre

$octub = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where  YEAR(fecha) = '$anoss' AND MONTH(fecha) = '10' AND concep = 'Egreso' and comen='Bebidas' ",$conexion);

$row10b = mysql_fetch_array($octub, MYSQL_ASSOC);
$cria_macho_octubreb= number_format ($row10b["total"]);
$cria_macho_octubre1b=($row10b["total"]);
//crias hembra noviembre

$novib = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where  YEAR(fecha) = '$anoss' AND MONTH(fecha) = '11' AND concep = 'Egreso' and comen='Bebidas'",$conexion);
$row11b = mysql_fetch_array($novib, MYSQL_ASSOC);
$cria_macho_noviemb= number_format ($row11b["total"]);
$cria_macho_noviem1b=($row11b["total"]);
//crias hembra diciembre
$dicib = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where  YEAR(fecha) = '$anoss' AND MONTH(fecha) = '12' AND concep = 'Egreso' and comen='Bebidas'",$conexion);
$row12b = mysql_fetch_array($dicib, MYSQL_ASSOC);
$cria_macho_dicib= number_format ($row12b["total"]);
$cria_macho_dici1b=($row12b["total"]);

////////////////////////////////////////////////BEBIDAS VENTAS/////////////////////////////////////////////////////////////////////


//crias hembra enero
$enerbv = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where  YEAR(fecha) = '$anoss' AND MONTH(fecha) = '01' AND concep = 'Ingreso' and comen='Bebidas' ",$conexion);
$row01bv = mysql_fetch_array($enerbv, MYSQL_ASSOC);
$cria_hembra_enerobv= number_format ($row01bv["total"]);
$cria_hembra_enero1bv= ($row01bv["total"]);

//crias hembra febrero
$febrbv = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where  YEAR(fecha) = '$anoss' AND MONTH(fecha) = '02' AND concep = 'Ingreso' and comen='Bebidas'",$conexion);
$row02bv = mysql_fetch_array($febrbv, MYSQL_ASSOC);
$cria_hembra_febrerobv= number_format ($row02bv["total"]);
$cria_hembra_febrero1bv= ($row02bv["total"]);

//crias hembra marzo

$marzbv = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where  YEAR(fecha) = '$anoss' AND MONTH(fecha) = '03' AND concep = 'Ingreso' and comen='Bebidas'",$conexion);
$row03bv = mysql_fetch_array($marzbv, MYSQL_ASSOC);
$cria_hembra_marzobv= number_format ($row03bv["total"]);
$cria_hembra_marzo1bv=($row03bv["total"]);

//crias hembra abril

$abribv = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where  YEAR(fecha) = '$anoss' AND MONTH(fecha) = '04' AND concep = 'Ingreso' and comen='Bebidas' ",$conexion);

$row04bv = mysql_fetch_array($abribv, MYSQL_ASSOC);
$cria_hembra_abrilbv= number_format ($row04bv["total"]);
$cria_hembra_abril1bv=($row04bv["total"]);

//crias hembra mayo

$mayobv = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where  YEAR(fecha) = '$anoss' AND MONTH(fecha) = '05' AND concep = 'Ingreso' and comen='Bebidas'",$conexion);
$row05bv = mysql_fetch_array($mayobv, MYSQL_ASSOC);
$cria_hembra_mayobv= number_format ($row05bv["total"]);
$cria_hembra_mayo1bv= ($row05bv["total"]);

//crias hembra junio

$junibv = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where  YEAR(fecha) = '$anoss' AND MONTH(fecha) = '06' AND concep = 'Ingreso' and comen='Bebidas'",$conexion);
$row06bv = mysql_fetch_array($junibv, MYSQL_ASSOC);
$cria_hembrao_juniobv= number_format ($row06bv["total"]);
$cria_hembrao_junio1bv=($row06bv["total"]);

//crias hembra julio

$julibv = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where  YEAR(fecha) = '$anoss' AND MONTH(fecha) = '07' AND concep = 'Ingreso' and comen='Bebidas'",$conexion);
$row07bv = mysql_fetch_array($julibv, MYSQL_ASSOC);
$cria_hembra_juliobv= number_format ($row07bv["total"]);
$cria_hembra_julio1bv= ($row07bv["total"]);

//crias hembra agosto

$agosbv = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where  YEAR(fecha) = '$anoss' AND MONTH(fecha) = '08' AND concep = 'Ingreso' and comen='Bebidas'",$conexion);
$row08bv = mysql_fetch_array($agosbv, MYSQL_ASSOC);
$cria_hembra_agostobv= number_format ($row08bv["total"]);
$cria_hembra_agosto1bv= ($row08bv["total"]);


//crias hembra septiembre

$septbv = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where  YEAR(fecha) = '$anoss' AND MONTH(fecha) = '09' AND concep = 'Ingreso' and comen='Bebidas'",$conexion);
$row09bv = mysql_fetch_array($septbv, MYSQL_ASSOC);
$cria_hembra_septibv= number_format ($row09bv["total"]);
$cria_hembra_septi1bv=  ($row09bv["total"]);

//crias hembra octubre

$octubv = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where  YEAR(fecha) = '$anoss' AND MONTH(fecha) = '10' AND concep = 'Ingreso' and comen='Bebidas'",$conexion);

$row10bv = mysql_fetch_array($octubv, MYSQL_ASSOC);
$cria_hembra_octubrebv= number_format ($row10bv["total"]);
$cria_hembra_octubre1bv=($row10bv["total"]);
//crias hembra noviembre

$novibv = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where  YEAR(fecha) = '$anoss' AND MONTH(fecha) = '11' AND concep = 'Ingreso' and comen='Bebidas'",$conexion);
$row11bv = mysql_fetch_array($novibv, MYSQL_ASSOC);
$cria_hembra_noviembv= number_format ($row11bv["total"]);
$cria_hembra_noviem1bv= ($row11bv["total"]);
//crias hembra diciembre
$dicibv = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where  YEAR(fecha) = '$anoss' AND MONTH(fecha) = '12' AND concep = 'Ingreso' and comen='Bebidas'",$conexion);
$row12bv = mysql_fetch_array($dicibv, MYSQL_ASSOC);
$cria_hembra_dicibv= number_format ($row12bv["total"]);
$cria_hembra_dici1bv=  ($row12bv["total"]);

//--------------------------------------------------------------------------------------------------------------------------------------
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

//	++++++++++++++++++++++++++++++		ALMACEN COMPRAS	++++++++++++++++++++++++++++++++++++++++++++++++++++
//crias hembra enero
$enera = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where  YEAR(fecha) = '$anoss' AND MONTH(fecha) = '01' AND concep = 'Egreso' and comen='Almacen'",$conexion);
$row01a = mysql_fetch_array($enera, MYSQL_ASSOC);
$cria_macho_eneroa= number_format ($row01a["total"]);
$cria_macho_enero1a= $row01a["total"];

//crias hembra febrero
$feba = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where  YEAR(fecha) = '$anoss' AND MONTH(fecha) = '02' AND concep = 'Egreso'and comen='Almacen' ",$conexion);
$row02a = mysql_fetch_array($feba, MYSQL_ASSOC);
$cria_macho_febreroa= number_format ($row02a["total"]);
$cria_macho_febrero1a= $row02a["total"];

//crias hembra marzo

$marza = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where  YEAR(fecha) = '$anoss' AND MONTH(fecha) = '03' AND concep = 'Egreso'and comen='Almacen'",$conexion);
$row03a = mysql_fetch_array($marza, MYSQL_ASSOC);
$cria_macho_marzoa= number_format ($row03a["total"]);
$cria_macho_marzo1a= $row03a["total"];

//crias hembra abril

$abria = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where  YEAR(fecha) = '$anoss' AND MONTH(fecha) = '04' AND concep = 'Egreso' and comen='Almacen'",$conexion);

$row04a = mysql_fetch_array($abria, MYSQL_ASSOC);
$cria_macho_abrila= number_format ($row04a["total"]);
$cria_macho_abril1a= $row04a["total"];

//crias hembra mayo

$mayoa = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where  YEAR(fecha) = '$anoss' AND MONTH(fecha) = '05' AND concep = 'Egreso' and comen='Almacen' ",$conexion);
$row05a = mysql_fetch_array($mayoa, MYSQL_ASSOC);
$cria_macho_mayoa= number_format ($row05a["total"]);
$cria_macho_mayo1a= $row05a["total"];

//crias hembra junio

$junia = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where  YEAR(fecha) = '$anoss' AND MONTH(fecha) = '06' AND concep = 'Egreso' and comen='Almacen'",$conexion);
$row06a = mysql_fetch_array($junia, MYSQL_ASSOC);
$cria_macho_junioa= number_format ($row06a["total"]);
$cria_macho_junio1a= $row06a["total"];

//crias hembra julio

$julia = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where  YEAR(fecha) = '$anoss' AND MONTH(fecha) = '07' AND concep = 'Egreso' and comen='Almacen' ",$conexion);
$row07a = mysql_fetch_array($julia, MYSQL_ASSOC);
$cria_macho_julioa= number_format ($row07a["total"]);
$cria_macho_julio1a=($row07a["total"]);

//crias hembra agosto

$agosa = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where  YEAR(fecha) = '$anoss' AND MONTH(fecha) = '08' AND concep = 'Egreso' and comen='Almacen' ",$conexion);
$row08a = mysql_fetch_array($agosa, MYSQL_ASSOC);
$cria_macho_agostoa= number_format ($row08a["total"]);
$cria_macho_agosto1a= ($row08a["total"]);

//crias hembra septiembre

$septa = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where  YEAR(fecha) = '$anoss' AND MONTH(fecha) = '09' AND concep = 'Egreso' and comen='Almacen'",$conexion);
$row09a = mysql_fetch_array($septa, MYSQL_ASSOC);
$cria_macho_septia= number_format ($row09a["total"]);
$cria_macho_septi1a= ($row09a["total"]);

//crias hembra octubre

$octua = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where  YEAR(fecha) = '$anoss' AND MONTH(fecha) = '10' AND concep = 'Egreso' and comen='Almacen' ",$conexion);

$row10a = mysql_fetch_array($octua, MYSQL_ASSOC);
$cria_macho_octubrea= number_format ($row10a["total"]);
$cria_macho_octubre1a=($row10a["total"]);
//crias hembra noviembre

$novia = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where  YEAR(fecha) = '$anoss' AND MONTH(fecha) = '11' AND concep = 'Egreso' and comen='Almacen'",$conexion);
$row11a = mysql_fetch_array($novia, MYSQL_ASSOC);
$cria_macho_noviema= number_format ($row11a["total"]);
$cria_macho_noviem1a=($row11a["total"]);
//crias hembra diciembre
$dicia = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where  YEAR(fecha) = '$anoss' AND MONTH(fecha) = '12' AND concep = 'Egreso' and comen='Almacen'",$conexion);
$row12a = mysql_fetch_array($dicia, MYSQL_ASSOC);
$cria_macho_dicia= number_format ($row12a["total"]);
$cria_macho_dici1a=($row12a["total"]);

////////////////////////////////////////////////ALMACEN VENTAS/////////////////////////////////////////////////////////////////////


//crias hembra enero
$enerao = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where  YEAR(fecha) = '$anoss' AND MONTH(fecha) = '01' AND concep = 'Ingreso' and comen='Almacen' ",$conexion);
$row01av = mysql_fetch_array($enerao, MYSQL_ASSOC);
$cria_hembra_eneroav= number_format ($row01av["total"]);
$cria_hembra_enero1av= ($row01av["total"]);

//crias hembra febrero
$febrav = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where  YEAR(fecha) = '$anoss' AND MONTH(fecha) = '02' AND concep = 'Ingreso' and comen='Almacen'",$conexion);
$row02av = mysql_fetch_array($febrav, MYSQL_ASSOC);
$cria_hembra_febreroav= number_format ($row02av["total"]);
$cria_hembra_febrero1av= ($row02av["total"]);

//crias hembra marzo

$marzav = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where  YEAR(fecha) = '$anoss' AND MONTH(fecha) = '03' AND concep = 'Ingreso' and comen='Almacen'",$conexion);
$row03av = mysql_fetch_array($marzav, MYSQL_ASSOC);
$cria_hembra_marzoav= number_format ($row03av["total"]);
$cria_hembra_marzo1av=($row03av["total"]);

//crias hembra abril

$abriav = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where  YEAR(fecha) = '$anoss' AND MONTH(fecha) = '04' AND concep = 'Ingreso' and comen='Almacen' ",$conexion);

$row04av = mysql_fetch_array($abriav, MYSQL_ASSOC);
$cria_hembra_abrilav= number_format ($row04av["total"]);
$cria_hembra_abril1av=($row04av["total"]);

//crias hembra mayo

$mayoav = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where  YEAR(fecha) = '$anoss' AND MONTH(fecha) = '05' AND concep = 'Ingreso' and comen='Almacen'",$conexion);
$row05av = mysql_fetch_array($mayoav, MYSQL_ASSOC);
$cria_hembra_mayoav= number_format ($row05av["total"]);
$cria_hembra_mayo1av= ($row05av["total"]);

//crias hembra junio

$juniav = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where  YEAR(fecha) = '$anoss' AND MONTH(fecha) = '06' AND concep = 'Ingreso' and comen='Almacen'",$conexion);
$row06av = mysql_fetch_array($juniav, MYSQL_ASSOC);
$cria_hembrao_junioav= number_format ($row06av["total"]);
$cria_hembrao_junio1av=($row06av["total"]);

//crias hembra julio

$juliav = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where  YEAR(fecha) = '$anoss' AND MONTH(fecha) = '07' AND concep = 'Ingreso' and comen='Almacen'",$conexion);
$row07av = mysql_fetch_array($juliav, MYSQL_ASSOC);
$cria_hembra_julioav= number_format ($row07av["total"]);
$cria_hembra_julio1av= ($row07av["total"]);

//crias hembra agosto

$agosav = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where  YEAR(fecha) = '$anoss' AND MONTH(fecha) = '08' AND concep = 'Ingreso' and comen='Almacen'",$conexion);
$row08av = mysql_fetch_array($agosav, MYSQL_ASSOC);
$cria_hembra_agostoav= number_format ($row08av["total"]);
$cria_hembra_agosto1av= ($row08av["total"]);


//crias hembra septiembre

$septav = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where  YEAR(fecha) = '$anoss' AND MONTH(fecha) = '09' AND concep = 'Ingreso' and comen='Almacen'",$conexion);
$row09av = mysql_fetch_array($septav, MYSQL_ASSOC);
$cria_hembra_septiav= number_format ($row09av["total"]);
$cria_hembra_septi1av=  ($row09av["total"]);

//crias hembra octubre

$octuav = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where  YEAR(fecha) = '$anoss' AND MONTH(fecha) = '10' AND concep = 'Ingreso' and comen='Almacen'",$conexion);

$row10av = mysql_fetch_array($octuav, MYSQL_ASSOC);
$cria_hembra_octubreav= number_format ($row10av["total"]);
$cria_hembra_octubre1av=($row10av["total"]);
//crias hembra noviembre

$noviav = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where  YEAR(fecha) = '$anoss' AND MONTH(fecha) = '11' AND concep = 'Ingreso' and comen='Almacen'",$conexion);
$row11av = mysql_fetch_array($noviav, MYSQL_ASSOC);
$cria_hembra_noviemav= number_format ($row11av["total"]);
$cria_hembra_noviem1av= ($row11av["total"]);
//crias hembra diciembre
$diciav = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where  YEAR(fecha) = '$anoss' AND MONTH(fecha) = '12' AND concep = 'Ingreso' and comen='Almacen'",$conexion);
$row12av = mysql_fetch_array($diciav, MYSQL_ASSOC);
$cria_hembra_diciav= number_format ($row12av["total"]);
$cria_hembra_dici1av=  ($row12av["total"]);

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////77
///////////////////////////////////////////////////  ALMACEN VENTAS  //////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//crias hembra enero
$enera = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where  YEAR(fecha) = '$anoss' AND MONTH(fecha) = '01' AND concep = 'Egreso' and comen='Almacen'",$conexion);
$row01a = mysql_fetch_array($enera, MYSQL_ASSOC);
$cria_macho_eneroa= number_format ($row01a["total"]);
$cria_macho_enero1a= $row01a["total"];

//crias hembra febrero
$feba = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where  YEAR(fecha) = '$anoss' AND MONTH(fecha) = '02' AND concep = 'Egreso'and comen='Almacen' ",$conexion);
$row02a = mysql_fetch_array($feba, MYSQL_ASSOC);
$cria_macho_febreroa= number_format ($row02a["total"]);
$cria_macho_febrero1a= $row02a["total"];

//crias hembra marzo

$marza = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where  YEAR(fecha) = '$anoss' AND MONTH(fecha) = '03' AND concep = 'Egreso'and comen='Almacen'",$conexion);
$row03a = mysql_fetch_array($marza, MYSQL_ASSOC);
$cria_macho_marzoa= number_format ($row03a["total"]);
$cria_macho_marzo1a= $row03a["total"];

//crias hembra abril

$abria = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where  YEAR(fecha) = '$anoss' AND MONTH(fecha) = '04' AND concep = 'Egreso' and comen='Almacen'",$conexion);

$row04a = mysql_fetch_array($abria, MYSQL_ASSOC);
$cria_macho_abrila= number_format ($row04a["total"]);
$cria_macho_abril1a= $row04a["total"];

//crias hembra mayo

$mayoa = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where  YEAR(fecha) = '$anoss' AND MONTH(fecha) = '05' AND concep = 'Egreso' and comen='Almacen' ",$conexion);
$row05a = mysql_fetch_array($mayoa, MYSQL_ASSOC);
$cria_macho_mayoa= number_format ($row05a["total"]);
$cria_macho_mayo1a= $row05a["total"];

//crias hembra junio

$junia = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where  YEAR(fecha) = '$anoss' AND MONTH(fecha) = '06' AND concep = 'Egreso' and comen='Almacen'",$conexion);
$row06a = mysql_fetch_array($junia, MYSQL_ASSOC);
$cria_macho_junioa= number_format ($row06a["total"]);
$cria_macho_junio1a= $row06a["total"];

//crias hembra julio

$julia = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where  YEAR(fecha) = '$anoss' AND MONTH(fecha) = '07' AND concep = 'Egreso' and comen='Almacen' ",$conexion);
$row07a = mysql_fetch_array($julia, MYSQL_ASSOC);
$cria_macho_julioa= number_format ($row07a["total"]);
$cria_macho_julio1a=($row07a["total"]);

//crias hembra agosto

$agosa = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where  YEAR(fecha) = '$anoss' AND MONTH(fecha) = '08' AND concep = 'Egreso' and comen='Almacen' ",$conexion);
$row08a = mysql_fetch_array($agosa, MYSQL_ASSOC);
$cria_macho_agostoa= number_format ($row08a["total"]);
$cria_macho_agosto1a= ($row08a["total"]);

//crias hembra septiembre

$septa = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where  YEAR(fecha) = '$anoss' AND MONTH(fecha) = '09' AND concep = 'Egreso' and comen='Almacen'",$conexion);
$row09a = mysql_fetch_array($septa, MYSQL_ASSOC);
$cria_macho_septia= number_format ($row09a["total"]);
$cria_macho_septi1a= ($row09a["total"]);

//crias hembra octubre

$octua = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where  YEAR(fecha) = '$anoss' AND MONTH(fecha) = '10' AND concep = 'Egreso' and comen='Almacen' ",$conexion);

$row10a = mysql_fetch_array($octua, MYSQL_ASSOC);
$cria_macho_octubrea= number_format ($row10a["total"]);
$cria_macho_octubre1a=($row10a["total"]);
//crias hembra noviembre

$novia = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where  YEAR(fecha) = '$anoss' AND MONTH(fecha) = '11' AND concep = 'Egreso' and comen='Almacen'",$conexion);
$row11a = mysql_fetch_array($novia, MYSQL_ASSOC);
$cria_macho_noviema= number_format ($row11a["total"]);
$cria_macho_noviem1a=($row11a["total"]);
//crias hembra diciembre
$dicia = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where  YEAR(fecha) = '$anoss' AND MONTH(fecha) = '12' AND concep = 'Egreso' and comen='Almacen'",$conexion);
$row12a = mysql_fetch_array($dicia, MYSQL_ASSOC);
$cria_macho_dicia= number_format ($row12a["total"]);
$cria_macho_dici1a=($row12a["total"]);

////////////////////////////////////////////////  Otros          /////////////////////////////////////////////////////////////////////


//crias hembra enero
$enerao = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where  YEAR(fecha) = '$anoss' AND MONTH(fecha) = '01' AND concep = 'Egreso' and comen='Otros' ",$conexion);
$row01ao = mysql_fetch_array($enerao, MYSQL_ASSOC);
$cria_hembra_eneroao= number_format ($row01ao["total"]);
$cria_hembra_enero1ao= ($row01ao["total"]);

//crias hembra febrero
$febrao = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where  YEAR(fecha) = '$anoss' AND MONTH(fecha) = '02' AND concep = 'Egreso' and comen='Otros'",$conexion);
$row02ao = mysql_fetch_array($febrao, MYSQL_ASSOC);
$cria_hembra_febreroao= number_format ($row02ao["total"]);
$cria_hembra_febrero1ao= ($row02ao["total"]);

//crias hembra marzo

$marzao = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where  YEAR(fecha) = '$anoss' AND MONTH(fecha) = '03' AND concep = 'Egreso' and comen='Otros'",$conexion);
$row03ao = mysql_fetch_array($marzao, MYSQL_ASSOC);
$cria_hembra_marzoao= number_format ($row03ao["total"]);
$cria_hembra_marzo1ao=($row03ao["total"]);

//crias hembra abril

$abriao = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where  YEAR(fecha) = '$anoss' AND MONTH(fecha) = '04' AND concep = 'Egreso' and comen='Otros' ",$conexion);

$row04ao = mysql_fetch_array($abriao, MYSQL_ASSOC);
$cria_hembra_abrilao= number_format ($row04ao["total"]);
$cria_hembra_abril1ao=($row04ao["total"]);

//crias hembra mayo

$mayoao = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where  YEAR(fecha) = '$anoss' AND MONTH(fecha) = '05' AND concep = 'Egreso' and comen='Otros'",$conexion);
$row05ao = mysql_fetch_array($mayoao, MYSQL_ASSOC);
$cria_hembra_mayoao= number_format ($row05ao["total"]);
$cria_hembra_mayo1ao= ($row05ao["total"]);

//crias hembra junio

$juniao = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where  YEAR(fecha) = '$anoss' AND MONTH(fecha) = '06' AND concep = 'Egreso' and comen='Otros'",$conexion);
$row06ao = mysql_fetch_array($juniao, MYSQL_ASSOC);
$cria_hembrao_junioao= number_format ($row06ao["total"]);
$cria_hembrao_junio1ao=($row06ao["total"]);

//crias hembra julio

$juliao = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where  YEAR(fecha) = '$anoss' AND MONTH(fecha) = '07' AND concep = 'Egreso' and comen='Otros'",$conexion);
$row07ao = mysql_fetch_array($juliao, MYSQL_ASSOC);
$cria_hembra_julioao= number_format ($row07ao["total"]);
$cria_hembra_julio1ao= ($row07ao["total"]);

//crias hembra agosto

$agosao = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where  YEAR(fecha) = '$anoss' AND MONTH(fecha) = '08' AND concep = 'Egreso' and comen='Otros'",$conexion);
$row08ao = mysql_fetch_array($agosao, MYSQL_ASSOC);
$cria_hembra_agostoao= number_format ($row08ao["total"]);
$cria_hembra_agosto1ao= ($row08ao["total"]);


//crias hembra septiembre

$septao = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where  YEAR(fecha) = '$anoss' AND MONTH(fecha) = '09' AND concep = 'Egreso' and comen='Otros'",$conexion);
$row09ao = mysql_fetch_array($septao, MYSQL_ASSOC);
$cria_hembra_septiao= number_format ($row09ao["total"]);
$cria_hembra_septi1ao=  ($row09ao["total"]);

//crias hembra octubre

$octuao = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where  YEAR(fecha) = '$anoss' AND MONTH(fecha) = '10' AND concep = 'Egreso' and comen='Otros'",$conexion);

$row10ao = mysql_fetch_array($octuao, MYSQL_ASSOC);
$cria_hembra_octubreao= number_format ($row10ao["total"]);
$cria_hembra_octubre1ao=($row10ao["total"]);
//crias hembra noviembre

$noviao = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where  YEAR(fecha) = '$anoss' AND MONTH(fecha) = '11' AND concep = 'Egreso' and comen='Otros'",$conexion);
$row11ao = mysql_fetch_array($noviao, MYSQL_ASSOC);
$cria_hembra_noviemao= number_format ($row11ao["total"]);
$cria_hembra_noviem1ao= ($row11ao["total"]);
//crias hembra diciembre
$diciao = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where  YEAR(fecha) = '$anoss' AND MONTH(fecha) = '12' AND concep = 'Egreso' and comen='Otros'",$conexion);
$row12ao = mysql_fetch_array($diciao, MYSQL_ASSOC);
$cria_hembra_diciao= number_format ($row12ao["total"]);
$cria_hembra_dici1ao=  ($row12ao["total"]);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
<link href="SpryAssets/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<style type="text/css">
#fila_1 td {
	font-weight: bold;
}
</style>
</head>

<body>
<ul id="MenuBar1" class="MenuBarHorizontal">
<li><a href="dia_dia.php" >Registro Diario</a> </li>
  <li><a href="dia_dia_pendiente.php" >Facturas  Pendientes</a> </li>
  <li><a href="bus_detalle_dia_dia.php" >Reportes</a>  </li>
  <li><a href="dia_dia_histo.php" class="current" >Historial</a> </li>
</ul>
<p>&nbsp;</p>

<table width="100%" border="0" align="center" cellspacing="0">
  <tr>
    <td width="121" align="left" bgcolor="#f0f0f0">&nbsp;</td>
    <td width="121" align="left" bgcolor="#f0f0f0">&nbsp;</td>
    <td width="308" align="center" bgcolor="#f0f0f0">&nbsp;</td>
    <td width="239" align="right" bgcolor="#f0f0f0"><a href="javascript:imprSelec('seleccion')" ><img src="imprimir.png" alt="" width="36" height="35" border="0" align="right" /></a></td>
  </tr>
</table>
<DIV ID="seleccion">
<table width="100%" border="1" align="center" cellspacing="0">
  <tr bgcolor="#4D68A2" style="color: #FFF">
    <th width="32" rowspan="2">Mes</th>
    <th colspan="3">Consolidado Anual Caja</th>
    <th colspan="3"><p>Restaurante</p></th>
    <th colspan="3">Hotel</th>
    <th colspan="3"><p>Bebidas</p></th>
    <th colspan="3"><p>Almacén</p></th>
    <th>Otros</th>
  </tr>
  <tr>
    <th bgcolor="#4D68A2" style="color: #FFF">Ventas</th>
    <th bgcolor="#4D68A2" style="color: #FFF">Comp</th>
    <th bgcolor="#4D68A2" style="color: #FFF">Saldo</th>
    <th bgcolor="#4D68A2" style="color: #FFF">Ventas</th>
    <th bgcolor="#4D68A2" style="color: #FFF">Comp</th>
    <th bgcolor="#4D68A2" style="color: #FFF">Saldo</th>
    <th bgcolor="#4D68A2" style="color: #FFF">Ventas</th>
    <th bgcolor="#4D68A2" style="color: #FFF">Comp</th>
    <th bgcolor="#4D68A2" style="color: #FFF">Saldo</th>
    <th bgcolor="#4D68A2" style="color: #FFF">Ventas</th>
    <th bgcolor="#4D68A2" style="color: #FFF">Comp</th>
    <th bgcolor="#4D68A2" style="color: #FFF">Saldo</th>
    <th bgcolor="#4D68A2" style="color: #FFF">Ventas</th>
    <th bgcolor="#4D68A2" style="color: #FFF">Comp</th>
    <th bgcolor="#4D68A2" style="color: #FFF">Saldo</th>
    <th bgcolor="#4D68A2" style="color: #FFF">Acpm</th>
  </tr>
 <tr align="center" id="fila_1" onMouseOver="ResaltarFila('fila_1');mano(this);"  onMouseOut="RestablecerFila('fila_1')" onClick="CrearEnlace('dia_dia_histo1.php?mes=01&repor=Enero');">
    <td style="font-weight: bold">Ene</td>
    <td width="74" bgcolor="#FFFF99" style="font-size: 14px"><? echo $cria_hembra_enero ?></td>
    <td width="104" bgcolor="#FFFF99" style="font-size: 14px"><? echo $cria_macho_enero ?></td>
    <td width="49" style="font-size: 14px"><? echo number_format ($cria_hembra_enero1 - abs($cria_macho_enero1)) ?></td>
    <td width="58" bgcolor="#00CCFF" style="font-size: 14px"><span style="font-weight: bold"><? echo $cria_hembra_enerorv ?></span></td>
    <td width="69" bgcolor="#00CCFF" style="font-size: 14px"><? echo $cria_macho_eneror ?></td>
    <td width="49" bgcolor="#00CCFF" style="font-size: 14px"><? echo number_format ($cria_hembra_enero1rv  -
	 abs($cria_macho_enero1r) )?></td>
    <td width="58" style="font-size: 14px"><span style="font-weight: bold"><? echo $cria_hembra_enerohv ?></span></td>
    <td width="69" style="font-size: 14px"><? echo $cria_macho_eneroh ?></td>
    <td width="49" style="font-size: 14px"><? echo number_format ($cria_hembra_enero1hv  +
	 $cria_macho_enero1h )?></td>
    <td width="58" bgcolor="#00CCFF" style="font-size: 14px"><span style="font-weight: bold"><? echo $cria_hembra_enerobv ?></span></td>
    <td width="69" bgcolor="#00CCFF" style="font-size: 14px"><? echo $cria_macho_enerob ?></td>
    <td width="49" bgcolor="#00CCFF" style="font-size: 14px"><? echo number_format ($cria_hembra_enero1bv  +
	 $cria_macho_enero1b )?></td>
    <td width="58" style="font-size: 14px"><span style="font-weight: bold"><? echo $cria_hembra_eneroav ?></span></td>
    <td width="69" style="font-size: 14px"><? echo $cria_macho_eneroa ?></td>
    <td width="55" style="font-size: 14px"><? echo number_format ($cria_hembra_enero1av  +
	 $cria_macho_enero1a )?></td>
    <td width="55" style="font-size: 14px"><? echo $cria_hembra_eneroao ?></td>
  </tr>
  <tr align="center" id="fila_2" onMouseOver="ResaltarFila('fila_2');mano(this);"  onMouseOut="RestablecerFila('fila_2')" onClick="CrearEnlace('dia_dia_histo1.php?mes=02&repor=Febrero');">
    <td  style="font-weight: bold">Feb</td>
    <td bgcolor="#FFFF99"  style="font-size: 14px"><? echo $cria_hembra_febrero ?></td>
    <td bgcolor="#FFFF99" style="font-size: 14px" ><? echo $cria_macho_febrero ?></td>
    <td style="font-size: 14px" ><? echo number_format ($cria_hembra_febrero1- abs($cria_macho_febrero1)) ?></td>
    <td bgcolor="#00CCFF" style="font-size: 14px" ><span style="font-weight: bold"><? echo $cria_hembra_febrerorv ?></span></td>
    <td bgcolor="#00CCFF" style="font-size: 14px" ><? echo $cria_macho_febreror ?></td>
    <td bgcolor="#00CCFF" style="font-size: 14px" ><? echo number_format ($cria_hembra_febrero1rv- abs($cria_macho_febrero1r)) ?></td>
    <td style="font-size: 14px" ><span style="font-weight: bold"><? echo $cria_hembra_febrerohv ?></span></td>
    <td style="font-size: 14px" ><? echo $cria_macho_febreroh ?></td>
    <td style="font-size: 14px" ><? echo number_format ($cria_hembra_febrero1hv- abs($cria_macho_febrero1h)) ?></td>
    <td bgcolor="#00CCFF" style="font-size: 14px" ><span style="font-weight: bold"><? echo $cria_hembra_febrerobv ?></span></td>
    <td bgcolor="#00CCFF" style="font-size: 14px" ><? echo $cria_macho_febrerob ?></td>
    <td bgcolor="#00CCFF" style="font-size: 14px" ><? echo number_format ($cria_hembra_febrero1bv- abs($cria_macho_febrero1b)) ?></td>
    <td style="font-size: 14px" ><span style="font-weight: bold"><? echo $cria_hembra_febreroav ?></span></td>
    <td style="font-size: 14px" ><? echo $cria_macho_febreroa ?></td>
    <td style="font-size: 14px" ><? echo number_format ($cria_hembra_febrero1av- abs($cria_macho_febrero1a)) ?></td>
    <td style="font-size: 14px" ><span style="font-weight: bold"><? echo $cria_hembra_febreroao ?></span></td>
  </tr>
 <tr align="center" id="fila_3" onMouseOver="ResaltarFila('fila_3');mano(this);"  onMouseOut="RestablecerFila('fila_3')" onClick="CrearEnlace('dia_dia_histo1.php?mes=03&repor=Marzo');">
    <td style="font-weight: bold">Mar</td>
    <td bgcolor="#FFFF99" style="font-size: 14px"><? echo $cria_hembra_marzo ?></td>
    <td bgcolor="#FFFF99" style="font-size: 14px"><? echo $cria_macho_marzo ?></td>
    <td style="font-size: 14px"><? echo number_format ($cria_hembra_marzo1 - abs($cria_macho_marzo1)) ?></td>
    <td bgcolor="#00CCFF" style="font-size: 14px"><span style="font-weight: bold"><? echo $cria_hembra_marzorv ?></span></td>
    <td bgcolor="#00CCFF" style="font-size: 14px"><? echo $cria_macho_marzor ?></td>
    <td bgcolor="#00CCFF" style="font-size: 14px"><? echo number_format ($cria_hembra_marzo1rv - abs($cria_macho_marzo1r)) ?></td>
    <td style="font-size: 14px"><span style="font-weight: bold"><? echo $cria_hembra_marzohv ?></span></td>
    <td style="font-size: 14px"><? echo $cria_macho_marzoh ?></td>
    <td style="font-size: 14px"><? echo number_format ($cria_hembra_marzo1hv - abs($cria_macho_marzo1h)) ?></td>
    <td bgcolor="#00CCFF" style="font-size: 14px"><span style="font-weight: bold"><? echo $cria_hembra_marzobv ?></span></td>
    <td bgcolor="#00CCFF" style="font-size: 14px"><? echo $cria_macho_marzob ?></td>
    <td bgcolor="#00CCFF" style="font-size: 14px"><? echo number_format ($cria_hembra_marzo1bv - abs($cria_macho_marzo1b)) ?></td>
    <td style="font-size: 14px"><span style="font-weight: bold"><? echo $cria_hembra_marzoav ?></span></td>
    <td style="font-size: 14px"><? echo $cria_macho_marzoa ?></td>
    <td style="font-size: 14px"><? echo number_format ($cria_hembra_marzo1av - abs($cria_macho_marzo1a)) ?></td>
    <td style="font-size: 14px"><span style="font-weight: bold"><? echo $cria_hembra_marzoao ?></span></td>
  </tr>
<tr align="center" id="fila_4" onMouseOver="ResaltarFila('fila_4');mano(this);"  onMouseOut="RestablecerFila('fila_4')" onClick="CrearEnlace('dia_dia_histo1.php?mes=04&repor=Abril');">
    <td  style="font-weight: bold">Abr</a></td>
    <td bgcolor="#FFFF99"  style="font-size: 14px"><? echo $cria_hembra_abril?></td>
    <td bgcolor="#FFFF99" style="font-size: 14px" ><? echo $cria_macho_abril ?></td>
    <td style="font-size: 14px" ><? echo number_format ($cria_hembra_abril1 - abs($cria_macho_abril1)) ?></td>
    <td bgcolor="#00CCFF" style="font-size: 14px" ><span style="font-weight: bold"><? echo $cria_hembra_abrilrv?></span></td>
    <td bgcolor="#00CCFF" style="font-size: 14px" ><? echo $cria_macho_abrilr ?></td>
    <td bgcolor="#00CCFF" style="font-size: 14px" ><? echo number_format ($cria_hembra_abril1rv - abs($cria_macho_abril1r)) ?></td>
    <td style="font-size: 14px" ><span style="font-weight: bold"><? echo $cria_hembra_abrilhv?></span></td>
    <td style="font-size: 14px" ><? echo $cria_macho_abrilh ?></td>
    <td style="font-size: 14px" ><? echo number_format ($cria_hembra_abril1hv - abs($cria_macho_abril1h)) ?></td>
    <td bgcolor="#00CCFF" style="font-size: 14px" ><span style="font-weight: bold"><? echo $cria_hembra_abrilbv?></span></td>
    <td bgcolor="#00CCFF" style="font-size: 14px" ><? echo $cria_macho_abrilb ?></td>
    <td bgcolor="#00CCFF" style="font-size: 14px" ><? echo number_format ($cria_hembra_abril1bv - abs($cria_macho_abril1b)) ?></td>
    <td style="font-size: 14px" ><span style="font-weight: bold"><? echo $cria_hembra_abrilav?></span></td>
    <td style="font-size: 14px" ><? echo $cria_macho_abrila ?></td>
    <td style="font-size: 14px" ><? echo number_format ($cria_hembra_abril1av - abs($cria_macho_abril1a)) ?></td>
    <td style="font-size: 14px" ><span style="font-weight: bold"><? echo $cria_hembra_abrilao?></span></td>
  </tr>
<tr align="center" id="fila_5" onMouseOver="ResaltarFila('fila_5');mano(this);"  onMouseOut="RestablecerFila('fila_5')" onClick="CrearEnlace('dia_dia_histo1.php?mes=05&repor=Mayo');">
    <td style="font-weight: bold">May</a></td>
    <td bgcolor="#FFFF99" style="font-size: 14px"><? echo $cria_hembra_mayo ?></td>
    <td bgcolor="#FFFF99" style="font-size: 14px"><? echo $cria_macho_mayo ?></td>
    <td style="font-size: 14px"><? echo number_format ($cria_hembra_mayo1 - abs($cria_macho_mayo1)) ?></td>
    <td bgcolor="#00CCFF" style="font-size: 14px"><span style="font-weight: bold"><? echo $cria_hembra_mayorv ?></span></td>
    <td bgcolor="#00CCFF" style="font-size: 14px"><? echo $cria_macho_mayor ?></td>
    <td bgcolor="#00CCFF" style="font-size: 14px"><? echo number_format ($cria_hembra_mayo1rv - abs($cria_macho_mayo1r)) ?></td>
    <td style="font-size: 14px"><span style="font-weight: bold"><? echo $cria_hembra_mayohv ?></span></td>
    <td style="font-size: 14px"><? echo $cria_macho_mayoh ?></td>
    <td style="font-size: 14px"><? echo number_format ($cria_hembra_mayo1hv - abs($cria_macho_mayo1h)) ?></td>
    <td bgcolor="#00CCFF" style="font-size: 14px"><span style="font-weight: bold"><? echo $cria_hembra_mayobv ?></span></td>
    <td bgcolor="#00CCFF" style="font-size: 14px"><? echo $cria_macho_mayob ?></td>
    <td bgcolor="#00CCFF" style="font-size: 14px"><? echo number_format ($cria_hembra_mayo1bv - abs($cria_macho_mayo1b)) ?></td>
    <td style="font-size: 14px"><span style="font-weight: bold"><? echo $cria_hembra_mayoav ?></span></td>
    <td style="font-size: 14px"><? echo $cria_macho_mayoa ?></td>
    <td style="font-size: 14px"><? echo number_format ($cria_hembra_mayo1av - abs($cria_macho_mayo1a)) ?></td>
    <td style="font-size: 14px"><span style="font-weight: bold"><? echo $cria_hembra_mayoao ?></span></td>
  </tr>
   <tr align="center" id="fila_6" onMouseOver="ResaltarFila('fila_6');mano(this);"  onMouseOut="RestablecerFila('fila_6')" onClick="CrearEnlace('dia_dia_histo1.php?mes=06&repor=Junio');">
    <td  style="font-weight: bold">Jun</a></td>
    <td bgcolor="#FFFF99"  style="font-size: 14px"><? echo $cria_hembrao_junio?></td>
    <td bgcolor="#FFFF99" style="font-size: 14px" ><? echo $cria_macho_junio ?></td>
    <td style="font-size: 14px" ><? echo number_format ($cria_hembrao_junio1 - abs($cria_macho_junio1)) ?></td>
    <td bgcolor="#00CCFF" style="font-size: 14px" ><span style="font-weight: bold"><? echo $cria_hembrao_juniorv?></span></td>
    <td bgcolor="#00CCFF" style="font-size: 14px" ><? echo $cria_macho_junior ?></td>
    <td bgcolor="#00CCFF" style="font-size: 14px" ><? echo number_format ($cria_hembrao_junio1rv - abs($cria_macho_junio1r)) ?></td>
    <td style="font-size: 14px" ><span style="font-weight: bold"><? echo $cria_hembrao_juniohv?></span></td>
    <td style="font-size: 14px" ><? echo $cria_macho_junioh ?></td>
    <td style="font-size: 14px" ><? echo number_format ($cria_hembrao_junio1hv - abs($cria_macho_junio1h)) ?></td>
    <td bgcolor="#00CCFF" style="font-size: 14px" ><span style="font-weight: bold"><? echo $cria_hembrao_juniobv?></span></td>
    <td bgcolor="#00CCFF" style="font-size: 14px" ><? echo $cria_macho_juniob ?></td>
    <td bgcolor="#00CCFF" style="font-size: 14px" ><? echo number_format ($cria_hembrao_junio1bv - abs($cria_macho_junio1b)) ?></td>
    <td style="font-size: 14px" ><span style="font-weight: bold"><? echo $cria_hembrao_junioav?></span></td>
    <td style="font-size: 14px" ><? echo $cria_macho_junioa ?></td>
    <td style="font-size: 14px" ><? echo number_format ($cria_hembrao_junio1av - abs($cria_macho_junio1a)) ?></td>
    <td style="font-size: 14px" ><span style="font-weight: bold"><? echo $cria_hembrao_junioao?></span></td>
  </tr>
   <tr align="center" id="fila_7" onMouseOver="ResaltarFila('fila_7');mano(this);"  onMouseOut="RestablecerFila('fila_7')" onClick="CrearEnlace('dia_dia_histo1.php?mes=07&repor=Julio');">
    <td style="font-weight: bold">Jul</td>
    <td bgcolor="#FFFF99" style="font-size: 14px"><? echo $cria_hembra_julio ?></td>
    <td bgcolor="#FFFF99" style="font-size: 14px"><? echo $cria_macho_julio ?></td>
    <td style="font-size: 14px"><? echo number_format ($cria_hembra_julio1 - abs($cria_macho_julio1)) ?></td>
    <td bgcolor="#00CCFF" style="font-size: 14px"><span style="font-weight: bold"><? echo $cria_hembra_juliorv ?></span></td>
    <td bgcolor="#00CCFF" style="font-size: 14px"><? echo $cria_macho_julior ?></td>
    <td bgcolor="#00CCFF" style="font-size: 14px"><? echo number_format ($cria_hembra_julio1rv - abs($cria_macho_julio1r)) ?></td>
    <td style="font-size: 14px"><span style="font-weight: bold"><? echo $cria_hembra_juliohv ?></span></td>
    <td style="font-size: 14px"><? echo $cria_macho_julioh ?></td>
    <td style="font-size: 14px"><? echo number_format ($cria_hembra_julio1hv - abs($cria_macho_julio1h)) ?></td>
    <td bgcolor="#00CCFF" style="font-size: 14px"><span style="font-weight: bold"><? echo $cria_hembra_juliobv ?></span></td>
    <td bgcolor="#00CCFF" style="font-size: 14px"><? echo $cria_macho_juliob ?></td>
    <td bgcolor="#00CCFF" style="font-size: 14px"><? echo number_format ($cria_hembra_julio1bv - abs($cria_macho_julio1b)) ?></td>
    <td style="font-size: 14px"><span style="font-weight: bold"><? echo $cria_hembra_julioav ?></span></td>
    <td style="font-size: 14px"><? echo $cria_macho_julioa ?></td>
    <td style="font-size: 14px"><? echo number_format ($cria_hembra_julio1av - abs($cria_macho_julio1a)) ?></td>
    <td style="font-size: 14px"><span style="font-weight: bold"><? echo $cria_hembra_julioao ?></span></td>
  </tr>
  <tr align="center" id="fila_8" onMouseOver="ResaltarFila('fila_8');mano(this);"  onMouseOut="RestablecerFila('fila_8')" onClick="CrearEnlace('dia_dia_histo1.php?mes=08&repor=Agosto');">
    <td  style="font-weight: bold">Ago</td>
    <td bgcolor="#FFFF99"  style="font-size: 14px"><? echo $cria_hembra_agosto?></td>
    <td bgcolor="#FFFF99" style="font-size: 14px" ><? echo $cria_macho_agosto ?></td>
    <td style="font-size: 14px" ><? echo number_format ($cria_hembra_agosto1 - abs($cria_macho_agosto1)) ?></td>
    <td bgcolor="#00CCFF" style="font-size: 14px" ><span style="font-weight: bold"><? echo $cria_hembra_agostorv?></span></td>
    <td bgcolor="#00CCFF" style="font-size: 14px" ><? echo $cria_macho_agostor ?></td>
    <td bgcolor="#00CCFF" style="font-size: 14px" ><? echo number_format ($cria_hembra_agosto1rv - abs($cria_macho_agosto1r)) ?></td>
    <td style="font-size: 14px" ><span style="font-weight: bold"><? echo $cria_hembra_agostohv?></span></td>
    <td style="font-size: 14px" ><? echo $cria_macho_agostoh ?></td>
    <td style="font-size: 14px" ><? echo number_format ($cria_hembra_agosto1hv - abs($cria_macho_agosto1h)) ?></td>
    <td bgcolor="#00CCFF" style="font-size: 14px" ><span style="font-weight: bold"><? echo $cria_hembra_agostobv?></span></td>
    <td bgcolor="#00CCFF" style="font-size: 14px" ><? echo $cria_macho_agostob ?></td>
    <td bgcolor="#00CCFF" style="font-size: 14px" ><? echo number_format ($cria_hembra_agosto1bv - abs($cria_macho_agosto1b)) ?></td>
    <td style="font-size: 14px" ><span style="font-weight: bold"><? echo $cria_hembra_agostoav?></span></td>
    <td style="font-size: 14px" ><? echo $cria_macho_agostoa ?></td>
    <td style="font-size: 14px" ><? echo number_format ($cria_hembra_agosto1av - abs($cria_macho_agosto1a)) ?></td>
    <td style="font-size: 14px" ><span style="font-weight: bold"><? echo $cria_hembra_agostoao?></span></td>
  </tr>
 <tr align="center" id="fila_9" onMouseOver="ResaltarFila('fila_9');mano(this);"  onMouseOut="RestablecerFila('fila_9')" onClick="CrearEnlace('dia_dia_histo1.php?mes=09&repor=Septiembre');">
    <td style="font-weight: bold">Sep</td>
    <td bgcolor="#FFFF99" style="font-size: 14px"><? echo $cria_hembra_septi?></td>
    <td bgcolor="#FFFF99" style="font-size: 14px"><? echo $cria_macho_septi ?></td>
    <td style="font-size: 14px"><? echo number_format ($cria_hembra_septi1 - abs($cria_macho_septi1)) ?></td>
    <td bgcolor="#00CCFF" style="font-size: 14px"><span style="font-weight: bold"><? echo $cria_hembra_septirv?></span></td>
    <td bgcolor="#00CCFF" style="font-size: 14px"><? echo $cria_macho_septir ?></td>
    <td bgcolor="#00CCFF" style="font-size: 14px"><? echo number_format ($cria_hembra_septi1rv - abs($cria_macho_septi1r)) ?></td>
    <td style="font-size: 14px"><span style="font-weight: bold"><? echo $cria_hembra_septihv?></span></td>
    <td style="font-size: 14px"><? echo $cria_macho_septih ?></td>
    <td style="font-size: 14px"><? echo number_format ($cria_hembra_septi1hv - abs($cria_macho_septi1h)) ?></td>
    <td bgcolor="#00CCFF" style="font-size: 14px"><span style="font-weight: bold"><? echo $cria_hembra_septibv?></span></td>
    <td bgcolor="#00CCFF" style="font-size: 14px"><? echo $cria_macho_septib ?></td>
    <td bgcolor="#00CCFF" style="font-size: 14px"><? echo number_format ($cria_hembra_septi1bv - abs($cria_macho_septi1b)) ?></td>
    <td style="font-size: 14px"><span style="font-weight: bold"><? echo $cria_hembra_septiav?></span></td>
    <td style="font-size: 14px"><? echo $cria_macho_septia ?></td>
    <td style="font-size: 14px"><? echo number_format ($cria_hembra_septi1av - abs($cria_macho_septi1a)) ?></td>
    <td style="font-size: 14px"><span style="font-weight: bold"><? echo $cria_hembra_septiao?></span></td>
  </tr>
<tr align="center" id="fila_10" onMouseOver="ResaltarFila('fila_10');mano(this);"  onMouseOut="RestablecerFila('fila_10')" onClick="CrearEnlace('dia_dia_histo1.php?mes=10&repor=Octubre');">
    <td  style="font-weight: bold">Oct</td>
    <td bgcolor="#FFFF99"  style="font-size: 14px"><? echo $cria_hembra_octubre ?></td>
    <td bgcolor="#FFFF99" style="font-size: 14px" ><? echo $cria_macho_octubre?></td>
    <td style="font-size: 14px" ><? echo number_format ($cria_hembra_octubre1 - abs($cria_macho_octubre1)) ?></td>
    <td bgcolor="#00CCFF" style="font-size: 14px" ><span style="font-weight: bold"><? echo $cria_hembra_octubrerv ?></span></td>
    <td bgcolor="#00CCFF" style="font-size: 14px" ><? echo $cria_macho_octubrer?></td>
    <td bgcolor="#00CCFF" style="font-size: 14px" ><? echo number_format ($cria_hembra_octubre1rv - abs($cria_macho_octubre1r)) ?></td>
    <td style="font-size: 14px" ><span style="font-weight: bold"><? echo $cria_hembra_octubrehv ?></span></td>
    <td style="font-size: 14px" ><? echo $cria_macho_octubreh?></td>
    <td style="font-size: 14px" ><? echo number_format ($cria_hembra_octubre1hv - abs($cria_macho_octubre1h)) ?></td>
    <td bgcolor="#00CCFF" style="font-size: 14px" ><span style="font-weight: bold"><? echo $cria_hembra_octubrebv ?></span></td>
    <td bgcolor="#00CCFF" style="font-size: 14px" ><? echo $cria_macho_octubreb?></td>
    <td bgcolor="#00CCFF" style="font-size: 14px" ><? echo number_format ($cria_hembra_octubre1bv - abs($cria_macho_octubre1b)) ?></td>
    <td style="font-size: 14px" ><span style="font-weight: bold"><? echo $cria_hembra_octubreav ?></span></td>
    <td style="font-size: 14px" ><? echo $cria_macho_octubrea?></td>
    <td style="font-size: 14px" ><? echo number_format ($cria_hembra_octubre1av - abs($cria_macho_octubre1a)) ?></td>
    <td style="font-size: 14px" ><span style="font-weight: bold"><? echo $cria_hembra_octubreao ?></span></td>
  </tr>
   <tr align="center" id="fila_11" onMouseOver="ResaltarFila('fila_11');mano(this);"  onMouseOut="RestablecerFila('fila_11')" onClick="CrearEnlace('dia_dia_histo1.php?mes=11&repor=Noviembre');">
    <td style="font-weight: bold">Nov</a></td>
    <td bgcolor="#FFFF99" style="font-size: 14px"><? echo $cria_hembra_noviem?></td>
    <td bgcolor="#FFFF99" style="font-size: 14px"><? echo $cria_macho_noviem ?></td>
    <td style="font-size: 14px"><? echo number_format ($cria_hembra_noviem1 - abs($cria_macho_noviem1)) ?></td>
    <td bgcolor="#00CCFF" style="font-size: 14px"><span style="font-weight: bold"><? echo $cria_hembra_noviemrv?></span></td>
    <td bgcolor="#00CCFF" style="font-size: 14px"><? echo $cria_macho_noviemr ?></td>
    <td bgcolor="#00CCFF" style="font-size: 14px"><? echo number_format ($cria_hembra_noviem1rv - abs($cria_macho_noviem1r)) ?></td>
    <td style="font-size: 14px"><span style="font-weight: bold"><? echo $cria_hembra_noviemhv?></span></td>
    <td style="font-size: 14px"><? echo $cria_macho_noviemh ?></td>
    <td style="font-size: 14px"><? echo number_format ($cria_hembra_noviem1hv - abs($cria_macho_noviem1h)) ?></td>
    <td bgcolor="#00CCFF" style="font-size: 14px"><span style="font-weight: bold"><? echo $cria_hembra_noviembv?></span></td>
    <td bgcolor="#00CCFF" style="font-size: 14px"><? echo $cria_macho_noviemb ?></td>
    <td bgcolor="#00CCFF" style="font-size: 14px"><? echo number_format ($cria_hembra_noviem1bv - abs($cria_macho_noviem1b)) ?></td>
    <td style="font-size: 14px"><span style="font-weight: bold"><? echo $cria_hembra_noviemav?></span></td>
    <td style="font-size: 14px"><? echo $cria_macho_noviema ?></td>
    <td style="font-size: 14px"><? echo number_format ($cria_hembra_noviem1av - abs($cria_macho_noviem1a)) ?></td>
    <td style="font-size: 14px"><span style="font-weight: bold"><? echo $cria_hembra_noviemao?></span></td>
  </tr>
  <!--<tr align="center">-->
  
   <tr align="center" id="fila_12" onMouseOver="ResaltarFila('fila_12');mano(this);"  onMouseOut="RestablecerFila('fila_12')" onClick="CrearEnlace('dia_dia_histo1.php?mes=12&repor=Diciembre');">
   <td  style="font-weight: bold">Dic</td>
    <td bgcolor="#FFFF99"  style="font-size: 14px"><? echo  $cria_hembra_dici?></td>
    <td bgcolor="#FFFF99" style="font-size: 14px" ><? echo $cria_macho_dici ?></td>
    <td style="font-size: 14px" ><? echo number_format ($cria_hembra_dici1 - abs($cria_macho_dici1)) ?></td>
    <td bgcolor="#00CCFF" style="font-size: 14px" ><span style="font-weight: bold"><? echo  $cria_hembra_dicirv?></span></td>
    <td bgcolor="#00CCFF" style="font-size: 14px" ><? echo $cria_macho_dicir ?></td>
    <td bgcolor="#00CCFF" style="font-size: 14px" ><? echo number_format ($cria_hembra_dici1rv - abs($cria_macho_dici1r)) ?></td>
    <td style="font-size: 14px" ><span style="font-weight: bold"><? echo  $cria_hembra_dicihv?></span></td>
    <td style="font-size: 14px" ><? echo $cria_macho_dicih ?></td>
    <td style="font-size: 14px" ><? echo number_format ($cria_hembra_dici1hv - abs($cria_macho_dici1h)) ?></td>
    <td bgcolor="#00CCFF" style="font-size: 14px" ><span style="font-weight: bold"><? echo  $cria_hembra_dicibv?></span></td>
    <td bgcolor="#00CCFF" style="font-size: 14px" ><? echo $cria_macho_dicib ?></td>
    <td bgcolor="#00CCFF" style="font-size: 14px" ><? echo number_format ($cria_hembra_dici1bv - abs($cria_macho_dici1b)) ?></td>
    <td style="font-size: 14px" ><span style="font-weight: bold"><? echo  $cria_hembra_diciav?></span></td>
    <td style="font-size: 14px" ><? echo $cria_macho_dicia ?></td>
    <td style="font-size: 14px" ><? echo number_format ($cria_hembra_dici1av - abs($cria_macho_dici1a)) ?></td>
    <td style="font-size: 14px" ><span style="font-weight: bold"><? echo  $cria_hembra_diciao?></span></td>
  </tr>
   <tr align="center" onMouseOver="ResaltarFila('fila_12');mano(this);"  onMouseOut="RestablecerFila('fila_12')" onClick="CrearEnlace('dia_dia_histo1.php?mes=12&repor=Diciembre');">
     <td  style="font-weight: bold">T.A</td>
     <td bgcolor="#FFFF99"  style="font-size: 14px"><? 
$talAnual= number_format ($cria_hembra_enero1 + $cria_hembra_febrero1 + $cria_hembra_marzo1 + $cria_hembra_abril1 + $cria_hembra_mayo1 + $cria_hembrao_junio1 + $cria_hembra_julio1 + $cria_hembra_agosto1 + $cria_hembra_septi1 + $cria_hembra_octubre1 + $cria_hembra_noviem1 + $cria_hembra_dici1);
 
  echo  $talAnual;   
	 
	 ?></td>
     <td bgcolor="#FFFF99" style="font-size: 14px" ><?
$totalDeduc =number_format ($cria_macho_enero1 + $cria_macho_febrero1 + $cria_macho_marzo1 + $cria_macho_abril1 + $cria_macho_mayo1 + $cria_macho_junio1 + $cria_macho_julio1 + $cria_macho_agosto1 + $cria_macho_septi1 + $cria_macho_octubre1 + $cria_macho_noviem1 + $cria_macho_dici1);
    echo $totalDeduc; 
	 ?></td>
     <td style="font-size: 14px" ><? echo number_format (($cria_hembra_enero1 - abs($cria_macho_enero1)+($cria_hembra_febrero1- abs($cria_macho_febrero1))+ ($cria_hembra_marzo1 - abs($cria_macho_marzo1))+($cria_hembra_abril1 - abs($cria_macho_abril1))+($cria_hembra_mayo1 - abs($cria_macho_mayo1))+($cria_hembrao_junio1 - abs($cria_macho_junio1))+($cria_hembra_julio1 - abs($cria_macho_julio1))+($cria_hembra_agosto1 - abs($cria_macho_agosto1))+($cria_hembra_septi1 - abs($cria_macho_septi1))+($cria_hembra_octubre1 - abs($cria_macho_octubre1))+($cria_hembra_noviem1 - abs($cria_macho_noviem1))+($cria_hembra_dici1 - abs($cria_macho_dici1))   ) )?></td>
     <th bgcolor="#00CCFF" style="font-size: 14px" ><? 
$talAnualrv= number_format ($cria_hembra_enero1rv + $cria_hembra_febrero1rv + $cria_hembra_marzo1rv + $cria_hembra_abril1rv + $cria_hembra_mayo1rv + $cria_hembrao_junio1rv + $cria_hembra_julio1rv + $cria_hembra_agosto1rv + $cria_hembra_septi1rv + $cria_hembra_octubre1rv + $cria_hembra_noviem1rv + $cria_hembra_dici1rv);
 
  echo  $talAnualrv;   
	 
	 ?></th>
     <th bgcolor="#00CCFF" style="font-size: 14px" ><?
$totalDeducr =number_format ($cria_macho_enero1r + $cria_macho_febrero1r + $cria_macho_marzo1r + $cria_macho_abril1r + $cria_macho_mayo1r + $cria_macho_junio1r + $cria_macho_julio1r + $cria_macho_agosto1r + $cria_macho_septi1r + $cria_macho_octubre1r + $cria_macho_noviem1r + $cria_macho_dici1r);
    echo $totalDeducr; 
	 ?></th>
     <th bgcolor="#00CCFF" style="font-size: 14px" ><? echo number_format (($cria_hembra_enero1rv +($cria_macho_enero1r)+($cria_hembra_febrero1rv+ ($cria_macho_febrero1r))+ ($cria_hembra_marzo1rv + ($cria_macho_marzo1r))+($cria_hembra_abril1rv + ($cria_macho_abril1r))+($cria_hembra_mayo1rv + ($cria_macho_mayo1r))+($cria_hembrao_junio1rv + ($cria_macho_junio1r))+($cria_hembra_julio1rv + ($cria_macho_julio1r))+($cria_hembra_agosto1rv + ($cria_macho_agosto1r))+($cria_hembra_septi1rv + ($cria_macho_septi1r))+($cria_hembra_octubre1rv + ($cria_macho_octubre1r))+($cria_hembra_noviem1rv + ($cria_macho_noviem1r))+($cria_hembra_dici1rv + ($cria_macho_dici1r))   ) )?></th>
     <th style="font-size: 14px" ><? 
$talAnualhv= number_format ($cria_hembra_enero1hv + $cria_hembra_febrero1hv + $cria_hembra_marzo1hv + $cria_hembra_abril1hv + $cria_hembra_mayo1hv + $cria_hembrao_junio1hv + $cria_hembra_julio1hv + $cria_hembra_agosto1hv + $cria_hembra_septi1hv + $cria_hembra_octubre1hv + $cria_hembra_noviem1hv + $cria_hembra_dici1hv);
 
  echo  $talAnualhv;   
	 
	 ?></th>
     <th style="font-size: 14px" ><?
$totalDeduch =number_format ($cria_macho_enero1h + $cria_macho_febrero1h + $cria_macho_marzo1h + $cria_macho_abril1h + $cria_macho_mayo1h + $cria_macho_junio1h + $cria_macho_julio1h + $cria_macho_agosto1h + $cria_macho_septi1h + $cria_macho_octubre1h + $cria_macho_noviem1h + $cria_macho_dici1h);
    echo $totalDeduch; 
	 ?></th>
     <td style="font-size: 14px" ><? echo number_format (($cria_hembra_enero1hv +($cria_macho_enero1h)+($cria_hembra_febrero1hv+ ($cria_macho_febrero1h))+ ($cria_hembra_marzo1hv + ($cria_macho_marzo1h))+($cria_hembra_abril1hv + ($cria_macho_abril1h))+($cria_hembra_mayo1hv + ($cria_macho_mayo1h))+($cria_hembrao_junio1hv + ($cria_macho_junio1h))+($cria_hembra_julio1hv + ($cria_macho_julio1h))+($cria_hembra_agosto1hv + ($cria_macho_agosto1h))+($cria_hembra_septi1hv + ($cria_macho_septi1h))+($cria_hembra_octubre1hv + ($cria_macho_octubre1h))+($cria_hembra_noviem1hv + ($cria_macho_noviem1h))+($cria_hembra_dici1hv + ($cria_macho_dici1h))   ) )?></td>
     <th bgcolor="#00CCFF" style="font-size: 14px" ><? 
$talAnualbv= number_format ($cria_hembra_enero1bv + $cria_hembra_febrero1bv + $cria_hembra_marzo1bv + $cria_hembra_abril1bv + $cria_hembra_mayo1bv + $cria_hembrao_junio1bv + $cria_hembra_julio1bv + $cria_hembra_agosto1bv + $cria_hembra_septi1bv + $cria_hembra_octubre1bv + $cria_hembra_noviem1bv + $cria_hembra_dici1bv);
 
  echo  $talAnualbv;   
	 
	 ?></th>
     <th bgcolor="#00CCFF" style="font-size: 14px" ><?
$totalDeducb =number_format ($cria_macho_enero1b + $cria_macho_febrero1b + $cria_macho_marzo1b + $cria_macho_abril1b + $cria_macho_mayo1b + $cria_macho_junio1b + $cria_macho_julio1b + $cria_macho_agosto1b + $cria_macho_septi1b + $cria_macho_octubre1b + $cria_macho_noviem1b + $cria_macho_dici1b);
    echo $totalDeducb; 
	 ?></th>
     <th bgcolor="#00CCFF" style="font-size: 14px" ><? echo number_format (($cria_hembra_enero1bv +($cria_macho_enero1b)+($cria_hembra_febrero1bv+ ($cria_macho_febrero1b))+ ($cria_hembra_marzo1bv + ($cria_macho_marzo1b))+($cria_hembra_abril1bv + ($cria_macho_abril1b))+($cria_hembra_mayo1bv + ($cria_macho_mayo1b))+($cria_hembrao_junio1bv + ($cria_macho_junio1b))+($cria_hembra_julio1bv + ($cria_macho_julio1b))+($cria_hembra_agosto1bv + ($cria_macho_agosto1b))+($cria_hembra_septi1bv + ($cria_macho_septi1b))+($cria_hembra_octubre1bv + ($cria_macho_octubre1b))+($cria_hembra_noviem1bv + ($cria_macho_noviem1b))+($cria_hembra_dici1bv + ($cria_macho_dici1b))   ) )?></th>
     <th style="font-size: 14px" ><? 
$talAnualav= number_format ($cria_hembra_enero1av + $cria_hembra_febrero1av + $cria_hembra_marzo1av + $cria_hembra_abril1av + $cria_hembra_mayo1av + $cria_hembrao_junio1av + $cria_hembra_julio1av + $cria_hembra_agosto1av + $cria_hembra_septi1av + $cria_hembra_octubre1av + $cria_hembra_noviem1av + $cria_hembra_dici1av);
 
  echo  $talAnualav;   
	 
	 ?></th>
     <th style="font-size: 14px" ><?
$totalDedua =number_format ($cria_macho_enero1a + $cria_macho_febrero1a + $cria_macho_marzo1a + $cria_macho_abril1a + $cria_macho_mayo1a + $cria_macho_junio1a + $cria_macho_julio1a + $cria_macho_agosto1a + $cria_macho_septi1a + $cria_macho_octubre1a + $cria_macho_noviem1a + $cria_macho_dici1a);
    echo $totalDedua; 
	 ?></th>
     <th style="font-size: 14px" ><? echo number_format (($cria_hembra_enero1av +($cria_macho_enero1a)+($cria_hembra_febrero1av+ ($cria_macho_febrero1a))+ ($cria_hembra_marzo1av + ($cria_macho_marzo1a))+($cria_hembra_abril1av + ($cria_macho_abril1a))+($cria_hembra_mayo1av + ($cria_macho_mayo1a))+($cria_hembrao_junio1av + ($cria_macho_junio1a))+($cria_hembra_julio1av + ($cria_macho_julio1a))+($cria_hembra_agosto1av + ($cria_macho_agosto1a))+($cria_hembra_septi1av + ($cria_macho_septi1a))+($cria_hembra_octubre1av + ($cria_macho_octubre1a))+($cria_hembra_noviem1av + ($cria_macho_noviem1a))+($cria_hembra_dici1av + ($cria_macho_dici1a))   ) )?></th>
     <th style="font-size: 14px" ><? 
$talAnualao= number_format ($cria_hembra_enero1ao + $cria_hembra_febrero1ao + $cria_hembra_marzo1ao + $cria_hembra_abril1ao + $cria_hembra_mayo1ao + $cria_hembrao_junio1ao + $cria_hembra_julio1ao + $cria_hembra_agosto1ao + $cria_hembra_septi1ao + $cria_hembra_octubre1ao + $cria_hembra_noviem1ao + $cria_hembra_dici1ao);
 
  echo  $talAnualao;   
	 
	 ?></th>
   </tr>
</table>

</body>
</html>
</DIV> 

<script language="Javascript">

  function imprSelec(nombre)

  {

  var ficha = document.getElementById(nombre);

  var ventimp = window.open(' ', 'popimpr');

  ventimp.document.write( ficha.innerHTML );

  ventimp.document.close();

  ventimp.print( );

  ventimp.close();

  } 

</script> 



