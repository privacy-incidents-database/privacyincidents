<?php
	include 'db.php';
	@mysql_connect(host,user,pw) or die('Could not connect to MySQL database. ');
	mysql_select_db(database);

?>
<?php include 'layout/contribute.html';?>
<?php
	    $description = $_POST['description'];
	    $PublicLink = $_POST['PublicLink'];
	    $query = mysql_iquery("INSERT INTO `Privacy incidents` ('Descr',`link`) VALUES ('$description','$PublicLink')");
	    if (mysql_num_rows($query) == 0) {
		echo 'INSERT FAILURE!'; 
		die();
	}
?>
