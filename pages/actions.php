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
	    // this is the section help handle multiple company selection and the input data.
	    if(isset($_POST['which_company'])){
	    	$frontSY = "#";
	    } else {
	    	$frontSY = NULL;
	    }
	    $companyOriginal = implode(',#', $_POST['which_company']);
	    if(isset($_POST['which_company_checkbox'])){
	    		$companyThree = $_POST['which_company_custom'];
	    		if ($frontSY != NULL){
	    			$companyTwo = ",#";
	    		} else {
	    			$companyTwo = "#";
	    		}
	    		if($companyThree != NULL){
	    			$companycheckbox = $companyTwo.$companyThree;
	    		} else {
	    			$companycheckbox = NULL;
	    		}
	    } else {
	    	$companycheckbox = NULL;
	    }
	    $company = $frontSY.$companyOriginal.$companycheckbox;
	    // this section handle the who_role part for multiple selection.
	    if(isset($_POST['which_role'])){
	    	$frontroleSY = "#";
	    } else {
	    	$frontroleSY = NULL;
	    }
	    $which_roleOriginal = implode(',#', $_POST['which_role']);
	    if(isset($_POST['which_role_checkbox'])){
	    		$roleThree = $_POST['which_role_custom'];
	    		if ($frontroleSY != NULL){
	    			$roleTwo = ",#";
	    		} else {
	    			$roleTwo = "#";
	    		}
	    		if($roleThree != NULL){
	    			$rolecheckbox = $roleTwo.$roleThree;
	    		} else {
	    			$rolecheckbox = NULL;
	    		}
	    } else {
	    	$rolecheckbox = NULL;
	    }
	    $who_role = $frontroleSY.$which_roleOriginal.$rolecheckbox;
	    // this section handle the what_kind part of multiple selection.
	    if(isset($_POST['what_kind'])){
	    	$frontkindSY = "#";
	    } else {
	    	$frontkindSY = NULL;
	    }
	    $what_kindOriginal = implode(',#', $_POST['what_kind']);
	    if(isset($_POST['what_kind_checkbox'])){
	    		$kindThree = $_POST['what_kind_custom'];
	    		if ($frontkindSY != NULL){
	    			$kindTwo = ",#";
	    		} else {
	    			$kindTwo = "#";
	    		}
	    		if($kindThree != NULL){
	    			$kindCheckbox = $kindTwo.$kindThree;
	    		} else {
	    			$kindCheckbox = NULL;
	    		}
	    } else {
	    	$knidCheckbox = NULL;
	    }
	    $what_kind = $frontkindSY.$what_kindOriginal.$kindCheckbox;

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
	    $query = mysql_query("INSERT INTO `Privacy incidents` (`what_kind`,`date_submitted`,`Descr`,`link`,`date_occurred`,`who_company`,`contributor_name`,`Contributor_email`,`who_role`) 
	    	VALUES ('$what_kind','$today','$description','$PublicLink','$occurred_date','$company','$contributor_name','$contributor_email','$who_role')");
	    if (mysql_num_rows($query) != 0) {
		echo 'INSERT FAILURE!'; 
		die();
	}
?>
<?php include 'layout/footer.html';?>