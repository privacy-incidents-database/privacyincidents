<?php
	include 'layout/header.html';
?>
<?php
	include 'db.php';
	@mysql_connect(host,user,pw) or die('Could not connect to MySQL database. ');
	mysql_select_db(database);

	    $description = $_POST['description'];
	    $PublicLink = $_POST['PublicLink'];
	    $Occurred_Date = $_POST['Occurred_Date'];
	    $Company = $_POST['which_company'];
	    $Contributor_Name = $_POST['Contributor_Name'];
	    $Contributor_Email = $_POST['Contributor_Email'];
	   /* echo '<tr>';
				echo '<td>' . $description . '</td>';
	
				echo '<td>' . $PublicLink. '</td>';
	
		echo '</tr>';*/
	    $query = mysql_query("INSERT INTO `Privacy incidents` (`Descr`,`link`,`date_occurred`, 
	    	`who_company`,`contributor_name`,`Contributor_email`) VALUES ('$description','$PublicLink',
	    	'Occurred_Date','Company','Contributor_Name','Contributor_Email')");
	    if (mysql_num_rows($query) != 0) {
		echo 'INSERT FAILURE!'; 
		die();
	}
?>
<?php include 'layout/footer.html';?>