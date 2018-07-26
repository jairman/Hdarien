<?php
/**
 *
 * head view
 *
 * @version             1.0.0
 * @package             Joomlike Framework
 * @copyright			Copyright (C) 2012 vonfio.de. All rights reserved.
 *               
 */
 
// No direct access
defined('_JEXEC') or die;

// Getting params from template
$params = JFactory::getApplication()->getTemplate(true)->params;
$tpn		= $this->template;

// load Mootools (in head) or JQuery (in head or at the end)
// removes Mootools only if not logged in
// always loaded: /media/system/js/core.js
/*$user = JFactory::getUser();
if ($user->get('guest') == 1) {
  
  $head = $this->getHeadData();
    
	JHtml::_('behavior.keepalive', false);
	reset($head['scripts']);
	unset($head['scripts'][$this->baseurl.'/media/system/js/mootools-core.js']);
	unset($head['scripts'][$this->baseurl.'/media/system/js/mootools-more.js']);
	unset($head['scripts'][$this->baseurl.'/media/system/js/caption.js']);
	//unset($head['scripts'][$this->baseurl.'/media/jui/js/jquery.min.js']);
	//unset($head['scripts'][$this->baseurl.'/media/jui/js/jquery-noconflict.js']);
	//unset($head['scripts'][$this->baseurl.'/media/jui/js/jquery-migrate.min.js']);
	
	$head['script']['text/javascript'] = ''; // removes JTooltips depending on Tips in More
	$this->setHeadData($head);
			
} */

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>" > 

<head>
	
  <jdoc:include type="head" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">

	<link rel="shortcut icon" href="<?php echo $this->baseurl; ?>/templates/<?php echo $tpn; ?>/favicon.ico" />

<?php
	$itemid			= JRequest::getVar('Itemid');
	$menu				= JFactory::getApplication()->getMenu();
	$active			= $menu->getItem($itemid);
	$pageclass	= $menu->getParams($itemid);
	$pageclass	= $pageclass->get( 'pageclass_sfx' );
	
  $doc = JFactory::getDocument();
  
  // Javascript  
  $doc->addScript('templates/joomlike/javascript/joomlike.js');
  
  // CSS
	if ($this->params->get('bootstrap')) {
	$doc->addStyleSheet('templates/'.$tpn.'/css/bootstrap.min.css'); }
	$doc->addStyleSheet('templates/'.$tpn.'/css/template.css');
	$doc->addStyleSheet('templates/'.$tpn.'/css/menu.css');
	if ($this->direction == 'rtl') {
	$doc->addStyleSheet('templates/'.$tpn.'/css/template_rtl.css'); }
	$doc->addStyleSheet('templates/'.$tpn.'/css/style_'.$this->params->get('colorVariation').'.css');
	$doc->addStyleSheet('templates/'.$tpn.'/css/typo.css');
	
	// Google Font
	if ($this->params->get('googleFont')) {
	$googleFontFamily =	str_replace('+', ' ', $this->params->get('googleFontFamily'));
	$doc->addStyleSheet('//fonts.googleapis.com/css?family='. $googleFontFamily);
	}
	
	require_once 'templates/joomlike/lib/modules.php' ;
?>

<link rel="stylesheet" href="<?php echo $this->baseurl; ?>/templates/<?php echo $tpn; ?>/css/responsive.css" type="text/css" />
<link rel="stylesheet" href="<?php echo $this->baseurl; ?>/templates/<?php echo $tpn; ?>/css/custom.css" type="text/css" />

<!--[if lte IE 6]><style type="text/css">#jl_content_in {width: 98%;}</style><![endif]-->
<!--[if lte IE 7]><style type="text/css">.jl_user_4 { width: 24.979%; }</style><![endif]-->

</head>

<?php if(count($app->getMessageQueue())) : ?>
<jdoc:include type="message" />
<?php endif; ?>