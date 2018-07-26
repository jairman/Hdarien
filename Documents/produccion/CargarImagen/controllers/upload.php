<?php

if ( !empty( $_FILES ) ) {

    $tempPath = $_FILES[ 'file' ][ 'tmp_name' ];
    // $uploadPath = 'dirname( __FILE__ ) '. DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . $_FILES[ 'file' ][ 'name' ];
 	$uploadPath = '..\uploads' . DIRECTORY_SEPARATOR . $_FILES[ 'file' ][ 'name' ];

 	if (file_exists($uploadPath)){
 		$answer = 'No se puede Guardar archivo ya existe';

 	}
 	else{
	    move_uploaded_file( $tempPath, $uploadPath );

	    $answer =  'File transfer completed';
 	}

    $json = json_encode( $answer );

    echo $json; 	

} else {

    echo 'No files';

}

?>