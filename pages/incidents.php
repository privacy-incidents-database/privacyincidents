<?php
	include 'layout/header.html';
	include 'db.php';

	@mysql_connect(host,user,pw) or die('Could not connect to MySQL database. ');
	mysql_select_db(database);

	$incidents = mysql_query("SELECT `date_occurred`, `Descr`, `link`, `who_company`, `who_role`, `what_kind`, `Location`, `incident_root_cause` FROM `Privacy incidents` ORDER BY date_occurred DESC LIMIT 9");
	if (mysql_num_rows($incidents) == 0) {
		echo 'No incidents found!'; 
		die();
	}

?>

<div class="container">
	<div>
		<h2 id="incidents-title">Privacy Incidents</h2>
		<iframe src='//cdn.knightlab.com/libs/timeline3/latest/embed/index.html?source=1enCq3hewy7vr2_Jq6mHj1kkA0kLZ2DTNe-kSN1BhndI&font=Default&lang=en&initial_zoom=2&height=650' width='100%' height='650' frameborder='0'></iframe>
	</div>

<?php 
		echo '<div class="row incident-row">';
		for ($a = 1; $a <= 3; $a++) {
			while ($i = mysql_fetch_row($incidents)) {
				$date = $i[0];
				$descr = $i[1];
				$link = $i[2];
				$tags = $i[3] . $i[4] . $i[5] . $i[6] . $i[7];
				$tags = str_replace(',', '', $tags);
	
				echo '<div class="col-md-4 incident-content">';
				echo '<div class="top">';
				echo '<p class="date" style="text-align: right;"> Approx date of incident: ' . $date . '</p></div>';
	
				echo '<div class="mid"><p class="descr" style="text-align: center; margin: 10% 0% 10% 0%;">' . $descr. '</p></div>';
				echo '<div class="bottom"><p class="link" style="font-size: 11px; text-align: left;"><a href="' . $link . '">' . $link . '</a></p>';
				echo '<p class="tags" style="bottom: 0; text-align: left; margin-top: 15%;">' . $tags . '</p>';
	
				echo '</div></div>';
				if ($a%3 == 0) {
					break;
				}
			}
			echo '</div><div class="row incident-row">';
		}


	//echo $incidents; 
	
?>	

<!--
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
	</div>-->
<?php include 'layout/footer.html';?>