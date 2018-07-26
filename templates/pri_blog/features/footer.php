<?php
/**
 * PRI Blog - Free Responsive Joomla! Blog Template
 * @author Devpri - http://www.devpri.com
 * @copyright Copyright (c) 2013 Devpri
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
 
 
 * Helix Framework Credit
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2001 - 2013 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
 */

//no direct accees
defined ('_JEXEC') or die('resticted aceess');

class HelixFeatureFooter {

	private $helix;

	public function __construct($helix){
		$this->helix = $helix;
	}

	public function onHeader(){

	}

	public function onFooter(){

	}

	public function Position(){
		return $this->helix->Param('footer_position');
	}

	public function onPosition()
	{
		ob_start();
		
		
		
		
		//Copyright
		if( $this->helix->Param('showcp', 1) ) {
			echo '<span class="copyright">' . str_ireplace('{year}',date('Y'), $this->helix->Param('copyright')) . '</span> ';
		}
		
		//Brand Link
		
			$devprilink = 'Designed by <a title="Sistemas Avanzados De Seguridad" class="pri-brand" target="_blank" href="http://www.idsolutions-group.com">ID Solutions</a>';			
			echo '<span class="designed-by">'. $devprilink .' </span> ';
		
		//Joomla Credit
		if ($this->helix->Param('jcredit', 1))
			echo '<span class="powered-by">' . JText::_('Powered by') . ' <a target="_blank" title="Joomla" href="http://www.joomla.org/">Joomla!</a></span> ';
			
		if( $this->helix->Param('validator', 0) )
			echo '<span class="validation-link">' . JText::_('Valid') . ' <a target="_blank" href="http://validator.w3.org/check/referer">XHTML</a> ' . JText::_('and') .' <a target="_blank" href="http://jigsaw.w3.org/css-validator/check/referer?profile=css3">CSS</a></span>';
		
		return ob_get_clean();
	}    
}