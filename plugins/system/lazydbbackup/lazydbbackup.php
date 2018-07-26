<?php
/**
 * @package JDBautoBackup 
 * @author Robert Gastaud - Marc Studer
 * @link 
 * &licence GNU/GPL 
 * Fork of LazyBackup from Stefan Granholm
 * Portage Joomla 2.5 & internationalization
 *
 */
defined('_JEXEC') or die('Restricted access');

jimport('joomla.filesystem.folder'); // september 07 2012
jimport('joomla.filesystem.file'); // september 07 2012

// detect if plugin settings are applied
$pJform = JRequest::getVar('jform');
if(isset($pJform['params']['backupfreq'])){
	//$fname=array_pop(JFolder::files(JPATH_SITE.'/media','lazydbbackup_checkfile.*'));
	$fnames=(JFolder::files(JPATH_SITE.'/media','lazydbbackup_checkfile.*'));
  	$fname=array_pop($fnames);
	if($fname)unlink(JPATH_SITE.'/media/'.$fname);
	$dayssecs=$pJform['params']['backuptime'];
	$dayssecs=strtotime(date('Y-m-d').' '.$dayssecs);
	if(!$dayssecs)$dayssecs=0;else $dayssecs-=strtotime(date('Y-m-d'));
	$time=time();
	$round=strtotime(date('Y-m-d',$time));
	$backuptime=$round+$dayssecs;
	$xdays=(int)$pJform['params']['xdays'];
	if($xdays==0)$xdays=1;
	if($xdays==1){
		$interval=(int)$pJform['params']['backupfreq'];
		if($interval==0)$interval=86400;else $interval=(int)(86400/$interval);
		while($backuptime<$time){
			$backuptime+=$interval;
		}
	}else{
		$interval=$xdays*86400;
		if($backuptime<$time)$backuptime+=86400;
	}
	$fname=JPATH_SITE.'/media/lazydbbackup_checkfile.'.$backuptime;
	if(!touch($fname))return;
	$f=fopen($fname,'w');fputs($f,'w'.$interval);fclose($f);
}


function teste($s){
	echo print_r($s,true).' - ';
//	echo $s.' - ';
//	echo '<pre><span style="background-color:white;color:black">'.$s.'</span></pre>';	
}

/* Import library dependencies */
jimport('joomla.event.plugin');
jimport( 'joomla.registry.registry' );

class plgSystemLazyDbBackup extends JPlugin {
	
	function onAfterInitialise() {
		jimport( 'joomla.filesystem.folder' ); // ???
		//$plugin =& JPluginHelper::getPlugin( 'system', 'lazydbbackup' );
		$plugin = JPluginHelper::getPlugin( 'system', 'lazydbbackup' );
//		$pluginParams = new JParameter( $plugin->params );
$pluginParams = new JRegistry( $plugin->params );
		$create=false;
		$fnames=JFolder::files(JPATH_SITE.'/media','lazydbbackup_checkfile.*');
		$fname=array_pop($fnames);
		//$fname=array_pop(JFolder::files(JPATH_SITE.'/media','lazydbbackup_checkfile.*'));
		if(!$fname)return;
		$backuptime=substr($fname,-10,10);
		$interval=file_get_contents(JPATH_SITE.'/media/'.$fname);
		//test("$interval");
		if($interval[0]=='w'){
			$interval=(int)substr($interval,1);
			$create=true;
		}
		
//test(date('Y-m-d H:i:s',$time));		
//test(date('Y-m-d H:i:s',$backuptime));		
// RRG 30/03/2013 added params for admin refresh backups
$admin_bkp=false;
if ( (($pluginParams->def('config_bkp',0)==1)&&(strpos(strtolower($_SERVER['REQUEST_URI']),'option=com_config')!==false)) || (($pluginParams->def('user_bkp',0)==1)&&(strpos(strtolower($_SERVER['REQUEST_URI']),'option=com_users')!==false))|| (($pluginParams->def('menu_bkp',0)==1)&&(strpos(strtolower($_SERVER['REQUEST_URI']),'option=com_menus')!==false)) || (($pluginParams->def('content_bkp',0)==1)&&(strpos(strtolower($_SERVER['REQUEST_URI']),'option=com_content')!==false)) || (($pluginParams->def('category_bkp',0)==1)&&(strpos(strtolower($_SERVER['REQUEST_URI']),'option=com_categories')!==false)) || (($pluginParams->def('installer_bkp',0)==1)&&(strpos(strtolower($_SERVER['REQUEST_URI']),'option=com_installer')!==false)) || (($pluginParams->def('module_bkp',0)==1)&&(strpos(strtolower($_SERVER['REQUEST_URI']),'option=com_modules')!==false)) || (($pluginParams->def('plugin_bkp',0)==1)&&(strpos(strtolower($_SERVER['REQUEST_URI']),'option=com_plugins')!==false)) || (($pluginParams->def('template_bkp',0)==1)&&(strpos(strtolower($_SERVER['REQUEST_URI']),'option=com_templates')!==false)) || (($pluginParams->def('language_bkp',0)==1)&&(strpos(strtolower($_SERVER['REQUEST_URI']),'option=com_languages')!==false)) ) {
	$admin_bkp=true;
}
//if((strpos(strtolower($_SERVER['REQUEST_URI']),'administrator')!==false)&&(strpos(strtolower($_SERVER['REQUEST_URI']),'option=com_plugins')!==false)){ // RRG 19/01/2012 backup not only for plugins
	// RRG 30/03/2013 added params for admin refresh backups
		//if((strpos(strtolower($_SERVER['REQUEST_URI']),'administrator')!==false) {
		if((strpos(strtolower($_SERVER['REQUEST_URI']),'administrator')!==false)&& ($admin_bkp==true)){
			//if($pluginParams->def('test',0)==1){
			$testsave = $pluginParams->def('test',0);
			if (($testsave)==1){
				$create=true;
			}
		}
		$time=time();
		if (($time>$backuptime)||$create) {
			unlink(JPATH_SITE.'/media/'.$fname);
			while($backuptime<$time)$backuptime+=$interval;
			$fname=JPATH_SITE.'/media/lazydbbackup_checkfile.'.$backuptime;
			if(!touch($fname))return;
			$f=fopen($fname,'w');fputs($f,$interval);fclose($f);

			$db = JFactory::getDBO();
			$config = JFactory::getConfig();
			$lb_abspath    = JPATH_SITE;
			$lb_host       = $config->get('host');
			$lb_user       = $config->get('user');
			$lb_password   = $config->get('password');
			$lb_db         = $config->get('db');
			$lb_mailfrom   = $config->get('mailfrom');
			$lb_fromname   = $config->get('fromname');
			//$lb_livesite   = JURI::root();    // 17/05/2013
			$mediapath=$lb_abspath.'/media';
			$checkfilename='lazydbbackup_checkfile';
			$today = date("Y-m-d");

			// create file name
			if(!$pluginParams->def( 'name_format', 0 )){
				$filename=$config->get('sitename').'.'.$today;
			}else{
				$filename=$today.'.'.$config->get('sitename');
			}
			$filename.='.'.str_pad(rand(0,999),3,'0',STR_PAD_LEFT);
			$filename.=($pluginParams->def('compress',0)?'.sql.gz':'.sql');
			//test("$filename");
			/* No need to do the require beforehand if not ok to continue, so we'll do it here to save an eeny weeny amount of time */
			require_once($lb_abspath.'/plugins/system/lazydbbackup/lazydbbackup/mysql_db_backup.class.php');
			/* Alternative location for Bot query  */
			$deletefile      = $pluginParams->def( 'deletefile', 1 );
			$compress      = $pluginParams->def( 'compress', 0 );
			$backuppath      = $pluginParams->def( 'backuppath', 0 );
			$sendmail		= $pluginParams->def( 'sendmail', 1 );

			/* Now we need to create the backup */
			$backup_obj = new LazyDbBackup_MySQL_DB_Backup();
			$result=$this->LazyDbBackupBackup($backup_obj,$lb_host,$lb_user,$lb_password,$lb_db,$pluginParams,$mediapath,$lb_fromname,$compress,$backuppath,$filename);
			$backupfile=$backup_obj->lazydbbackup_file_name;
//test("$backupFile");
			if($pluginParams->def('encrypt',0)){
				$password=$pluginParams->def('password',0);
				if(!empty($password)){
					if(strtoupper(substr(PHP_OS,0,3))==='WIN'){
						$zipcmd=$lb_abspath.'/plugins/system/lazydbbackup/lazydbbackup/zip.exe';		
						exec("$zipcmd -j -P $password \"$backupfile.zip\" \"$backupfile\"");
					}else{
						$zipcmd='zip';		
						exec("$zipcmd -j -P $password \"$backupfile.zip\" \"$backupfile\"");
					}
					unlink($backupfile);
					$backupfile.='.zip';
				}
			}

			if ($sendmail) {
				/* and email it to wherever */
				$emailresult=$this->LazyDbBackupEmail($pluginParams,$lb_mailfrom,$lb_fromname,$backupfile,$result['output'],$lb_livesite);
				if($deletefile=="1"&&!empty($backupfile)){
					unlink($backupfile);
				}
			}
			/* Job done */			
			return true;
		}
	}
	 
	//function LazyDbBackupEmail($pluginParams,$lb_mailfrom,$lb_fromname,$attachment,$Body,$lb_livesite) {  17/05/2013
		function LazyDbBackupEmail($pluginParams,$lb_mailfrom,$lb_fromname,$attachment,$body) {
		$mail = JFactory::getMailer();
		$toemail       = $pluginParams->def( 'recipient', '' );
		$subject       = $pluginParams->def( 'subject', 'Mysql backup' );
		//$fromname       = $pluginParams->def( 'fromname', $lb_fromname ); /// 28/06/2013 not used
		
		
		if (empty($toemail) ) $toemail=$lb_mailfrom;
		// Thanks to Gerald Berger for correction on multiple email addresses
		if (strpos($toemail,"," )) {
        	//$ToEmail2 = split(",",$ToEmail ); // 19/04/2013 replace split
			$toemail2 = explode(",",$toemail );
        }else {
            $toemail2 = $toemail;
        }

		$mail->addAttachment($attachment);
		//$mail->addRecipient($ToEmail);
		// Thanks to Gerald Berger for correction on multiple email addresses
		$mail->addRecipient($toemail2);
		//$mail->setSubject($subject.' '.$lb_livesite);   // 17/05/2013
		// 16/05/2013
		$lb_addurl	   = $pluginParams->def( 'addurl', 1 );
		if ($lb_addurl) {
			$mail->setSubject($subject.' '.JURI::root());
		}else{
			$mail->setSubject($subject);
		}
		$mail->setBody($body);
		$mail->Send();
	}
	
	function LazyDbBackupBackup(&$backup_obj,$lb_host,$lb_user,$lb_password,$lb_db,$pluginParams,$mediapath,$lb_fromname,$compress,$backuppath,$filename='')
		 {
		 $body             = $pluginParams->def( 'body', 'Mysql backup from '.$lb_fromname );
		 $drop_tables       = $pluginParams->def( 'drop_tables', 1 );
		 $create_tables       = $pluginParams->def( 'create_tables', 1 );
		 $struct_only       = $pluginParams->def( 'struct_only', 1 );
		 $site_only       = $pluginParams->def( 'site_only', 1 );
		 $foreign_key       = $pluginParams->def( 'foreign_key', 1 );
		 $locks             = $pluginParams->def( 'locks', 1 );
		 $comments          = $pluginParams->def( 'comments', 1 );
		 if (!empty($backuppath) && is_dir($backuppath) && @is_writable($backuppath)  )
			$backup_dir       = $backuppath;
		 else
			$backup_dir       = $mediapath;
	
		 /* START - REQUIRED SETUP VARIABLES */
		 $backup_obj->server    = $lb_host;
		 $backup_obj->port       = 3306;
		 $backup_obj->username    = $lb_user;
		 $backup_obj->password    = $lb_password;
		 $backup_obj->database    = $lb_db;
		 /* Tables you wish to backup. All tables in the database will be backed up if this array is null. */
		 $backup_obj->tables = array();
		 /* END - REQUIRED SETUP VARIABLES */
		 
		 /* START - OPTIONAL PREFERENCE VARIABLES */
		 /* Add DROP TABLE IF EXISTS queries before CREATE TABLE in backup file. */
		 $backup_obj->drop_tables = $drop_tables;
		 /* No table structure will be backed up if false */
		 $backup_obj->create_tables = $create_tables;
		 /* Only site's tables will be backed up if true. */
		 $backup_obj->site_only = $site_only;
		 /* disable foreign key checks if true. */
		 $backup_obj->foreign_key = $foreign_key;
		 /* Add LOCK TABLES before data backup and UNLOCK TABLES after */
		 $backup_obj->struct_only = $struct_only;
		 /* Add LOCK TABLES before data backup and UNLOCK TABLES after */
		 $backup_obj->locks = $locks;
		 /* Include comments in backup file if true. */
		 $backup_obj->comments = $comments;
		 /* Directory on the server where the backup file will be placed. Used only if task parameter equals MSX_SAVE. */
		 $backup_obj->backup_dir = $backup_dir.'/';
		 /* Default file name format. */
		 $backup_obj->fname_format = 'd_m_Y';
		 /* Values you want to be intrerpreted as NULL */
		 $backup_obj->null_values = array( );
	
		 $savetask = MSX_SAVE;
		 /* Optional name of backup file if using 'MSX_APPEND', 'MSX_SAVE' or 'MSX_DOWNLOAD'. If nothing is passed, the default file name format will be used. */
//		 $filename = '';
		 /* END - REQUIRED EXECUTE VARIABLES */
		 $result_bk = $backup_obj->Execute($savetask, $filename, $compress);
		 if (!$result_bk)
			{
			$output = $backup_obj->error;
			}
		 else
			{
			$output = $body.': ' . strftime('%A  %d  %B  %Y    - %T  ') . ' ';
			}
		 return array('result'=>$result_bk,'output'=>$output);
		 }
}
?>