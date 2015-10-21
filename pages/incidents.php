<?php 
	include 'layout/header.html';
	include 'db.php';
	echo 'test';
	/*
	@mysql_connect(host,user,pw) or die('Could not connect to MySQL database. ');
	mysql_select_db(db);*/
?>	

<div class="container">
	<div>
		<h2 id="incidents-title">Privacy Incidents</h2>
	</div>

	<div class="row incident-row">
	  <div class="col-md-4 incident-content">
	  	Incident content
	  </div>
	  <div class="col-md-4 incident-content">
	  	Incident content
	  </div> 
	  <div class="col-md-4 incident-content">
	  	Incident content
	  </div>
	</div>
	<div class="row incident-row">
	  <div class="col-md-4 incident-content">
	  	Incident content
	  </div>
	  <div class="col-md-4 incident-content">
	  	Incident content
	  </div> 
	  <div class="col-md-4 incident-content">
	  	Incident content
	  </div>
	</div>
	<div class="row incident-row">
	  <div class="col-md-4 incident-content">
	  	Incident content
	  </div>
	  <div class="col-md-4 incident-content">
	  	Incident content
	  </div> 
	  <div class="col-md-4 incident-content">
	  	Incident content
	  </div>
	</div>	

<?php include 'layout/footer.html';?>