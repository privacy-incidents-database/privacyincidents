<?php
	include 'layout/header.html';
	include 'db.php';

	@mysql_connect(host,user,pw) or die('Could not connect to MySQL database. ');
	mysql_select_db(database);

?>
<?php include 'layout/contribute.html';?>
<?php include 'layout/footer.html';?>