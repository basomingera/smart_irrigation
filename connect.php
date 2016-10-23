<?php
# FileName="connect.php"
 $serverName = "localhost";
 $database="smart_irrigation_db";
 $userName="rob";
 $passwors="";
 
 function FormatErrors(){
 	echo "error occure";
	if( ($errors = mysqli_errors() ) != null)
		      {
		         foreach( $errors as $error)
		         {
		            echo "SQLSTATE: ".$error[ 'SQLSTATE']."\n";
		            echo "code: ".$error[ 'code']."\n";
		            echo "message: ".$error[ 'message']."\n";
		         }
		      }
}
?>
