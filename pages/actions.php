<?php
	include 'db.php';
	@mysql_connect(host,user,pw) or die('Could not connect to MySQL database. ');
	mysql_select_db(database);

?>
<?php
	    $description = $_POST['description'];
	    $PublicLink = $_POST['PublicLink'];
	    echo '<tr>';
				echo '<td>' . $description . '</td>';
	
				echo '<td>' . $PublicLink. '</td>';
	
		echo '</tr>';
	    $query = mysql_iquery("INSERT INTO `Privacy incidents` ('Descr',`link`) VALUES ('$description','$PublicLink')");
	    if (mysql_num_rows($query) == 0) {
		echo 'INSERT FAILURE!'; 
		die();
	}
?>
