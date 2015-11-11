<?php
	include 'layout/header.html';
	include 'db.php';

	@mysql_connect(host,user,pw) or die('Could not connect to MySQL database. ');
	mysql_select_db(database);

	$incidents = mysql_query("SELECT `date_occurred`, `Descr`, `link`, `who_company`, `who_role`, `what_kind`, `Location`, `incident_root_cause` FROM `Privacy incidents` ORDER BY date_occurred DESC LIMIT 50");
	if (mysql_num_rows($incidents) == 0) {
		echo 'No incidents found!'; 
		die();
	}

?>

<!DOCTYPE html>
<html>
<head>
<title>Contribute</title>
</head>
<body>

<h1>Please contribute privacy incidents to our database!</h1>
<p>The Privacy community often speculates about the rate of privacy incidents and which companies are involved in the most privacy incidents. We don't know the answers to those questions because we don't have a database of incidents to analyze.<br>
<br>
We're building the Information Privacy Incident Database to answer those questions and more. Here is an example database entry:
<br>
<br>
Description: WHSmith accidentally emailed the personal details of customers completing a form to all the customers in their mailing list.
Tags: #9/2015, #UK, #WHSmith, #accident, #Pii-leak, #Citizens
<br>
<br>
The vision for the database is a crowd-sourced, collaborative environment like Wikipedia, but since we're starting from scratch, it's now a curated database with contributions by invitation.
<br>
<br>
We need your help! If you see or hear of a publicly known privacy incident, please enter what you know about it here. 
<br>
<br>
Thanks very much for your help!
Jessica Staddon,Linda Vue, Yuxu Yang.</p>
<br>
<form class="form-horizontal">
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
    <div class="col-sm-10">
      <input type="textarea" class="form-control" id="description" placeholder="tarea">
    </div>
  </div>
</form>
	 <?php
	    $descrId = ($_GET['description']);
	    $query = mysql_query("INSERT INTO `Privacy incidents`(`Descr`) VALUES ('$descrIds')")
	 ?>
</body>
</html>



<?php include 'layout/footer.html';?>