<?php
/**
 * PRI Prime - Responsive Joomla! Template
 * @author Devpri - http://www.devpri.com
 * @copyright Copyright (c) 2010 - 2014 Devpri
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
 
 
 * Helix Framework Credit
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2001 - 2013 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
 */
//no direct accees
defined ('_JEXEC') or die ('resticted aceess'); 
class HelixFeatureParams{
	 private static $_instance;
        private $document;
        private $_less;

        //initialize 
        public function __construct(){

        }

        /**
        * making self object for singleton method
        * 
        */
        final public static function getInstance()
        {
            if( !self::$_instance ){
                self::$_instance = new self();
                self::getInstance()->getDocument();
				                self::getInstance()->getDocument()->HelixFeatureParams = self::getInstance();

            } 
            return self::$_instance;
        }


        /**
        * Get Document
        * 
        * @param string $key
        */
        public static function getDocument($key=false)
        {
            self::getInstance()->document = JFactory::getDocument();
            $doc = self::getInstance()->document;
            if( is_string($key) ) return $doc->$key;

            return $doc;
        }

        /**
        * Get Template name
        * 
        * @return string
        */
        public static function themeName()
        {
            //return self::getInstance()->getDocument()->template;
            return JFactory::getApplication()->getTemplate();
        }

        /**
        * Get Template name
        * @return string
        */
        public static function theme()
        {
            return self::getInstance()->themeName();
        }

		 private static function resetCookie($name)
        {
            if( JRequest::getVar('reset',  ''  , 'get')==1 )
                setcookie( $name, '', time() - 3600, '/');
        }
		/**
        * Add Inline CSS
        * 
        * @param mixed $code
        * @return self
        */
        public function addInlineCSS($code) {
            self::getInstance()->document->addStyleDeclaration($code);
            return self::getInstance();
        }
            
	 public function onHeader() {
			//layout Style
            if (self::getInstance()->LayoutStyle()=='boxed') {
				$box_width = self::getInstance()->Param('layout_width');
				$container_width = self::getInstance()->Param('layout_width') - 60;
                self::getInstance()->document->setMetaData('viewport', 'width=device-width, initial-scale=1.0');
                self::getInstance()->addInlineCSS('.body-innerwrapper{max-width:' . $box_width .  'px; margin:0 auto}');
				self::getInstance()->addInlineCSS('.container{max-width:' . $container_width .  'px;}');
				self::getInstance()->addInlineCSS('#sp-header-wrapper.sticky{max-width:' . $box_width .  'px;}');
            }
			//Menu Style
            if (self::getInstance()->MenuStyle()=='sticky') {
 		echo "
            <script type=\"text/javascript\">
			jQuery(document).ready(function($){
			var aboveHeight = $('#sp-topbar-wrapper').outerHeight();
			$(window).scroll(function(){
				if ($(window).scrollTop() > aboveHeight && window.innerWidth > 979){
				$('#sp-header-wrapper').addClass('sticky pri-menu animated').css('top','0');
				} else {
				$('#sp-header-wrapper').removeClass('sticky pri-menu animated');
				}
				});
     		});
            </script>
        	";
			}			
        }
 		/**
        * Get or set Template param. If value not setted params get and return, 
        * else set params
        *
        * @param string $name
        * @param mixed $value
        */
        public static function Param($name=true, $value=NULL)
        {

            // if $name = true, this will return all param data
            if( is_bool($name) and $name==true ){
                return JFactory::getApplication()->getTemplate(true)->params;
            }
            // if $value = null, this will return specific param data
            if( is_null($value) ) return JFactory::getApplication()->getTemplate(true)->params->get($name);
            // if $value not = null, this will set a value in specific name.

            $data = JFactory::getApplication()->getTemplate(true)->params->get($name);

            if( is_null($data) or !isset($data) ){
                JFactory::getApplication()->getTemplate(true)->params->set($name, $value);
                return $value;
            } else {
                return $data;
            }
        }

		/**
        * Set Layout Style
        * 
        */
        public static function LayoutStyle() {
            $name = self::getInstance()->theme() . '_layoutstyle';
            self::getInstance()->resetCookie($name);

            $require = JRequest::getVar('layoutstyle',  ''  , 'get');
            if( !empty( $require ) ){
                setcookie( $name, $require, time() + 3600, '/');
                $current = $require;
            } 
            elseif( empty( $require ) and  isset( $_COOKIE[$name] )) {
                $current = $_COOKIE[$name];
            } else {
                $current = self::getInstance()->Param('layout_style');
            }

            return $current;
        }

        public static function LayoutStyleParam($name) {
            return self::getInstance()->param( self::getInstance()->LayoutStyle().$name );
        }
		
		
		/**
        * Menu Style
        * 
        */
        public static function MenuStyle() {
            $name = self::getInstance()->theme() . '_menustyle';
            self::getInstance()->resetCookie($name);

            $require = JRequest::getVar('menustyle',  ''  , 'get');
            if( !empty( $require ) ){
                setcookie( $name, $require, time() + 3600, '/');
                $current = $require;
            } 
            elseif( empty( $require ) and  isset( $_COOKIE[$name] )) {
                $current = $_COOKIE[$name];
            } else {
                $current = self::getInstance()->Param('menu_style');
            }

            return $current;
        }
		public static function MenuStyleParam($name) {
            return self::getInstance()->param( self::getInstance()->MenuStyle().$name );
        }
}
