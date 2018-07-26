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
 
class HelixFeatureBackTotop {

	private $pri;

	public function __construct($pri){
		$this->pri = $pri;
	}

	public function onHeader()
	{

	}

	public function onFooter()
	{
		
	ob_start();
	?>
    <a id="pri-totop" class="backtotop" href="#"><i class="icon-chevron-up"></i></a>

    <script type="text/javascript">
        jQuery(".backtotop").addClass("hidden-top");
			jQuery(window).scroll(function () {
			if (jQuery(this).scrollTop() === 0) {
				jQuery(".backtotop").addClass("hidden-top")
			} else {
				jQuery(".backtotop").removeClass("hidden-top")
			}
		});

		jQuery('.backtotop').click(function () {
			jQuery('body,html').animate({
					scrollTop:0
				}, 1200);
			return false;
		});
    </script>
<?php

	$data = ob_get_contents();
	
	ob_end_clean();
	
	if( $this->pri->Param('showtop')  ) return $data;

	}

	public function Position()
	{
		
	}


	public function onPosition()
	{        
		 
	}    
}