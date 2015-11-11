<?php
	include 'layout/header.html';
?>
<?php
	include 'db.php';
	@mysql_connect(host,user,pw) or die('Could not connect to MySQL database. ');
	mysql_select_db(database);

	    $description = $_POST['description'];
	    $PublicLink = $_POST['PublicLink'];
	    $occurred_Date = $_POST['Occurred_Date'];
	    $company = $_POST['which_company'];
	    $contributor_name = $_POST['Contributor_Name'];
	    $contributor_email = $_POST['Contributor_Email'];
	    echo '<tr>';
				echo '<td>' . $description . '</td>';
	
				echo '<td>' . $PublicLink. '</td>';
				
				echo '<td>' . $occurred_Date. '</td>'; 
				echo '<td>' . $company. '</td>';
				echo '<td>' . $contributor_name. '</td>';
				echo '<td>' . $contributor_email. '</td>';
		echo '</tr>';
	    $query = mysql_query("INSERT INTO `Privacy incidents` (`Descr`,`link`,`date_occurred`,`who_company`,`contributor_name`,`Contributor_email`) VALUES ('$description','$PublicLink','$occurred_date','$company','$contributor_name','$contributor_email')");
	    if (mysql_num_rows($query) != 0) {
		echo 'INSERT FAILURE!'; 
		die();
	}
?>
<?php include 'layout/footer.html';?>