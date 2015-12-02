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
	    $date = $_POST['Occurred_Date'];
	    $date2 = "-00";
	    $occurred_date = $date.$date2;
	    //echo '<td>' . $occurred_date . '</td>';
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
	    	$kindCheckbox = NULL;
	    }
	    $what_kind = $frontkindSY.$what_kindOriginal.$kindCheckbox;
	    //this section handle the incident_root_cause part of multple selection.
	    if(isset($_POST['incident_root_cause'])){
	    	$frontRootSY = "#";
	    } else {
	    	$frontRootSY = NULL;
	    }
	    $incident_root_causeOriginal = implode(',#', $_POST['incident_root_cause']);
	    if(isset($_POST['incident_root_cause_checkbox'])){
	    		$RootThree = $_POST['incident_root_cause_custom'];
	    		if ($frontRootSY != NULL){
	    			$RootTwo = ",#";
	    		} else {
	    			$RootTwo = "#";
	    		}
	    		if($RootThree != NULL){
	    			$RootCheckbox = $RootTwo.$RootThree;
	    		} else {
	    			$RootCheckbox = NULL;
	    		}
	    } else {
	    	$RootCheckbox = NULL;
	    }
	    $incident_root_cause = $frontRootSY.$incident_root_causeOriginal.$RootCheckbox;
	    // this section handle the Location part of multiple selection.
	    if(isset($_POST['where_Location'])){
	    	$frontLocationSY = "#";
	    } else {
	    	$frontLocationSY = NULL;
	    }
	    $where_LocationOriginal = implode(',#', $_POST['where_Location']);
	    if(isset($_POST['where_Location_checkbox'])){
	    		$LocationThree = $_POST['where_Location_custom'];
	    		if ($frontLocationSY != NULL){
	    			$LocationTwo = ",#";
	    		} else {
	    			$LocationTwo = "#";
	    		}
	    		if($LocationThree != NULL){
	    			$LocationCheckbox = $LocationTwo.$LocationThree;
	    		} else {
	    			$LocationCheckbox = NULL;
	    		}
	    } else {
	    	$LocationCheckbox = NULL;
	    }
	    $where_Location = $frontLocationSY.$where_LocationOriginal.$LocationCheckbox;
	    if(isset($_POST['include_contributor'])){
	    	$contributor_name = $_POST['Contributor_Name'];
	    	$contributor_email = $_POST['Contributor_Email'];
	    }
	    $query = mysql_query("INSERT INTO `Privacy incidents` (`Location`,`incident_root_cause`,`what_kind`,`date_submitted`,`Descr`,`link`,`date_occurred`,`who_company`,`contributor_name`,`Contributor_email`,`who_role`) 
	    	VALUES ('$where_Location','$incident_root_cause','$what_kind','$today','$description','$PublicLink','$occurred_date','$company','$contributor_name','$contributor_email','$who_role')");
	    if (mysql_num_rows($query) != 0) {
		echo 'INSERT FAILURE!'; 
		die();
		}
		if(isset($_POST['another_contribution'])){
	    	header('Location: contribute.php');   
	    }
?>
<html>
<div class="col-sm-offset-1 col-sm-10">
<h3>Thanks you for your contribution! </h3>
<h3>Do you have any suggestions for improving this form? If so, please click the Contact button on the right top.</h3>
</div>
</html>
<?php include 'layout/footer.html';?>