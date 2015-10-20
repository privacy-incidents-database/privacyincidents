<?php 
	include 'layout/header.html';
	include 'db.php';

	@mysql_connect(host,user,pw) or die('Could not connect to MySQL database. ');
	mysql_select_db(db);
?>	

<div class="container">
	<div>
		<h2 id="incidents-title">Privacy Incidents</h2>
	</div>
	<div class="row incident-content">
	  <div class="col-md-4">
	  	Incident content
	  </div>
	</div>
	<div class="row incident-content">
	  <div class="col-md-4">
	  	Incident content
	  </div>
	</div>
	<div class="row incident-content">
	  <div class="col-md-4">
	  	Incident content
	  </div>
	</div>
</div>
<?php include 'layout/footer.html';?>