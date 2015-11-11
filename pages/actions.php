<?php
	include 'db.php';
	@mysql_connect(host,user,pw) or die('Could not connect to MySQL database. ');
	mysql_select_db(database);

	    $description = $_POST['description'];
	    $PublicLink = $_POST['PublicLink'];
	   /* echo '<tr>';
				echo '<td>' . $description . '</td>';
	
				echo '<td>' . $PublicLink. '</td>';
	
		echo '</tr>';*/
		$query = "INSERT INTO `Privacy incidents` (`Descr`,`link`) VALUES ('$description','$PublicLink')"
	    $result = mysql_query($query);
	    if (!$result) {
		   echo 'INSERT FAILURE!'; 
		die();
	}
?>
