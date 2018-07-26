<?php
/**
 * @version		$Id: coolfeed.php 100 2012-04-14 17:42:51Z trung3388@gmail.com $
 * @copyright	JoomAvatar.com
 * @author		Nguyen Quang Trung
 * @link		http://joomavatar.com
 * @license		License GNU General Public License version 2 or later
 * @package		Avatar Dream Framework Template
 * @facebook 	http://www.facebook.com/pages/JoomAvatar/120705031368683
 * @twitter	    https://twitter.com/#!/JoomAvatar
 * @support 	http://joomavatar.com/forum/
 */

// No direct access
defined('_JEXEC') or die;

/* The following line loads the MooTools JavaScript Library */
JHtml::_('behavior.framework', true);

/* The following line gets the application object for things like displaying the site name */
$app = JFactory::getApplication();
$template = $this->_jtemplate;
$posTop		 	= $template->countModules('top');
$posHeaderBottom= $template->countModules('header-bottom');
$posTopLeft 	= $template->countModules('top-left');
$posTopMiddle 	= $template->countModules('top-middle'); 
$posTopRight 	= $template->countModules('top-right');
		
$posPromoTopLeft 	= $template->countModules('promo-top-left');
$posPromoTopMiddle 	= $template->countModules('promo-top-middle');
$posPromoTopRight 	= $template->countModules('promo-top-right');

$posUser8 			= $template->countModules('user-8');
$posUser9 			= $template->countModules('user-9');
$posUser10 			= $template->countModules('user-10');

$posUser11 			= $template->countModules('user-11');
$posUser12			= $template->countModules('user-12');
$posUser13 			= $template->countModules('user-13');
$posUser14 			= $template->countModules('user-14');

$posContentTop 		= $template->countModules('content-top');
			 
$posLeftTop 	= $template->countModules('left-top');
$posLeftMiddle1 = $template->countModules('left-middle-1');
$posLeftMiddle2 = $template->countModules('left-middle-2');
$posLeftBottom 	= $template->countModules('left-bottom');
			 
$posUser1 = $template->countModules('user-1');
$posUser2 = $template->countModules('user-2');
			 
$posUser3 = $template->countModules('user-3');
$posUser4 = $template->countModules('user-4');
			 
$posRightTop 		= $template->countModules('right-top');
$posRightMiddle1 	= $template->countModules('right-middle-1');
$posRightMiddle2 	= $template->countModules('right-middle-2');
$posRightBottom 	= $template->countModules('right-bottom');
			 
$posPromoBottomLeft 	= $template->countModules('promo-bottom-left');
$posPromoBottomMiddle 	= $template->countModules('promo-bottom-middle');
$posPromoBottomRight 	= $template->countModules('promo-bottom-right');

$posUser5 		= $template->countModules('user-5');
$posUser6 		= $template->countModules('user-6');
$posUser7 		= $template->countModules('user-7');
$posUser15 		= $template->countModules('user-15');
$posUser16		= $template->countModules('user-16');
$posUser17 		= $template->countModules('user-17');
$posUser18 		= $template->countModules('user-18');
$posUser19 		= $template->countModules('user-19');
$posUser20 		= $template->countModules('user-20');
$posUser21 		= $template->countModules('user-21');
$posUser22 		= $template->countModules('user-22');

$posContentBottom = $template->countModules('content-bottom');

$posFooter	 		= $template->countModules('footer');
$posFooterLeft 		= $template->countModules('footer-left');
$posFooterMiddle 	= $template->countModules('footer-middle');
$posFooterRight 	= $template->countModules('footer-right');
$posFooter1 = $template->countModules('footer-1');
$posFooter2 = $template->countModules('footer-2');
$posFooter3 = $template->countModules('footer-3');
$posFooter4 = $template->countModules('footer-4');
$posFooter5 = $template->countModules('footer-5');
$posFooter6 = $template->countModules('footer-6');
?>
<?php echo $this->getDoctype(); ?>
<!-- <?php echo Avatar::getTemplateInfo(); ?> -->
<html lang="<?php echo $template->language; ?>" dir="<?php echo $template->direction; ?>" >
	<head>
		<?php 
			echo $this->addHead();
			
			$posTopMiddleWidth = '100';
			
			if ($posTopLeft || $posTopMiddle || $posTopRight) {
				$posTopMiddleWidth = 100 - $template->params->get('top_left') - $template->params->get('top_right');
			}
			
			$posFooterMiddleWidth = '100';
			
			if ($posFooterLeft || $posFooterMiddle || $posFooterRight) {
				$posFooterMiddleWidth = 100 - $template->params->get('footer_left') - $template->params->get('footer_right');
			}
			
			$posPromoTopMiddleWidth = '100';
			
			if ($posPromoTopLeft || $posPromoTopMiddle || $posPromoTopRight) {
				$posPromoTopMiddleWidth = 100 - $template->params->get('promo_top_left') - $template->params->get('promo_top_right');
			}
			
			$posPromoBottomMiddleWidth = '100';
			
			if ($posPromoBottomLeft || $posPromoBottomMiddle || $posPromoBottomRight) {
				$posPromoBottomMiddleWidth = 100 - $template->params->get('promo_bottom_left') - $template->params->get('promo_bottom_right');
			}
			
			$avatarMainContentWidth = '100';
			
			if ($template->countModules('inner-right')) {
				$avatarMainContentWidth = $avatarMainContentWidth - $template->params->get('inner_right');
			}
			
			if ($template->countModules('inner-left')) {
				$avatarMainContentWidth = $avatarMainContentWidth - $template->params->get('inner_left');
			}
			
			$avatarContentWidth = '100';
			
			if ($posLeftTop || $posLeftMiddle1 || $posLeftMiddle2 || $posLeftBottom) {
				$avatarContentWidth = $avatarContentWidth - $template->params->get('left');
			}
			
			if ($posRightTop || $posRightMiddle1 || $posRightMiddle2 || $posRightBottom) {
				$avatarContentWidth = $avatarContentWidth - $template->params->get('right');
			}
		?>
		<style type="text/css">
			.avatar-wrapper{
				width: <?php echo $template->params->get('template_width'); ?>;
				margin: auto;
			}
			
			#avatar-pos-top-left {
				width: <?php echo $template->params->get('top_left'); ?>%;
			}
			#avatar-pos-top-middle {
				width: <?php echo $posTopMiddleWidth; ?>%;
			}
			#avatar-pos-top-right {
				width: <?php echo $template->params->get('top_right'); ?>%;
			}
			
			#avatar-pos-footer-left {
				width: <?php echo $template->params->get('footer_left'); ?>%;
			}
			#avatar-pos-footer-middle {
				width: <?php echo $posFooterMiddleWidth; ?>%;
			}
			#avatar-pos-footer-right {
				width: <?php echo $template->params->get('footer_right'); ?>%;
			}
			
			#avatar-pos-promo-top-left {
				width: <?php echo $template->params->get('promo_top_left'); ?>%;
			}
			#avatar-pos-promo-top-middle {
				width: <?php echo $posPromoTopMiddleWidth; ?>%;
			}
			#avatar-pos-promo-top-right {
				width: <?php echo $template->params->get('promo_top_right'); ?>%;
			}
			
			#avatar-pos-promo-bottom-left {
				width: <?php echo $template->params->get('promo_bottom_left'); ?>%;
			}
			#avatar-pos-promo-bottom-middle {
				width: <?php echo $posPromoBottomMiddleWidth; ?>%;
			}
			#avatar-pos-promo-bottom-right {
				width: <?php echo $template->params->get('promo_bottom_right'); ?>%;
			}
			
			#avatar-left {
				width: <?php echo $template->params->get('left'); ?>%;
			}
			#avatar-right {
				width: <?php echo $template->params->get('right'); ?>%;
			}
			#avatar-content {
				width: <?php echo $avatarContentWidth; ?>%;
			}
			#avatar-pos-inner-left {
				width: <?php echo $template->params->get('inner_left'); ?>%;
			}
			#avatar-pos-inner-right {
				width: <?php echo $template->params->get('inner_right'); ?>%;
			}
			
			#avatar-main-content{
				width: <?php echo $avatarMainContentWidth; ?>%;
			}
			<?php if ($template->params->get('go_to_top') && $template->params->get('go_to_top_css')): ?>
				#avatat-go-to-top {
					<?php echo $template->params->get('go_to_top_css');?>
				}
			<?php endif; ?>
		</style>
		
		<?php echo $this->addGoogleAnalytics(); ?>
	</head>
	<body id="avatar-template" class="<?php echo ($this->_responsive) ? 'avatar-responsive' : ''; echo ($template->params->get('css3_effect')) ? ' css3-effect ' : ''; echo ' '.$this->getMenuClass(); ?>">
		<jdoc:include type="message" />
		<jdoc:include type="component" />
	</body>
</html>
