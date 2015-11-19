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
	    $companyone = implode(',#', $_POST['which_company']);
	    if(isset($_POST['which_company_checkbox'])){
	    	$companyThree = $_POST['which_company_custom'];
	    	$companyTwo = ",#";
	    	$company= $companyone.$companyTwo.$companyThree;
	    } else {
	    	$company= $companyone;
	    }
	    $who_role = implode(',#', $_POST['which_role']);
	    $contributor_name = $_POST['Contributor_Name'];
	    $contributor_email = $_POST['Contributor_Email'];
	    echo '<tr>';
				echo '<td>' . $description . '</td>';
	
				echo '<td>' . $PublicLink. '</td>';
				echo '<td>' . $occurred_date. '</td>'; 
				echo '<td>' . $company. '</td>';
				echo '<td>' . $contributor_name. '</td>';
				echo '<td>' . $contributor_email. '</td>';
		echo '</tr>';
	    $query = mysql_query("INSERT INTO `Privacy incidents` (`date_submitted`,`Descr`,`link`,`date_occurred`,`who_company`,`contributor_name`,`Contributor_email`,`who_role`) 
	    	VALUES ('$today','$description','$PublicLink','$occurred_date','#$company','$contributor_name','$contributor_email','#$who_role')");
	    if (mysql_num_rows($query) != 0) {
		echo 'INSERT FAILURE!'; 
		die();
	}
?>
<?php include 'layout/footer.html';?>