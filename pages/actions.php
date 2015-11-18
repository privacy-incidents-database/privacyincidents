<?php
	include 'layout/header.html';
?>
<?php
	include 'db.php';
	@mysql_connect(host,user,pw) or die('Could not connect to MySQL database. ');
	mysql_select_db(database);
		date_default_timezone_set('NYC');
		$today = date("Y-m-d");
	    $description = $_POST['description'];
	    $PublicLink = $_POST['PublicLink'];
	    $occurred_date = $_POST['Occurred_Date'];
	    if(!empty($_POST['which_company'])) {
		// Counting number of checked checkboxes.
			$checked_count = count($_POST['which_company']);
			echo "You have selected following ".$checked_count." option(s): <br/>";
		// Loop to store and display values of individual checked checkbox.
			foreach($_POST['which_company'] as $selected) {
				echo "<p>".$selected ."</p>";
			}
	 	}	
	    $company = $_POST['which_company'];
	    $contributor_name = $_POST['Contributor_Name'];
	    $contributor_email = $_POST['Contributor_Email'];
	    $who_role = $_POST['which_role'];
	    echo '<tr>';
				echo '<td>' . $description . '</td>';
	
				echo '<td>' . $PublicLink. '</td>';
				
				echo '<td>' . $occurred_date. '</td>'; 
				echo '<td>' . $company. '</td>';
				echo '<td>' . $contributor_name. '</td>';
				echo '<td>' . $contributor_email. '</td>';
		echo '</tr>';
	    $query = mysql_query("INSERT INTO `Privacy incidents` (`date_submitted`,`Descr`,`link`,`date_occurred`,`who_company`,`contributor_name`,`Contributor_email`,`who_role`) 
	    	VALUES ('$today','$description','$PublicLink','$occurred_date','$company','$contributor_name','$contributor_email','$who_role')");
	    if (mysql_num_rows($query) != 0) {
		echo 'INSERT FAILURE!'; 
		die();
	}
?>
<?php include 'layout/footer.html';?>