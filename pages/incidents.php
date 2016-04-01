<?php
	include 'layout/header.html';
	include 'db.php';

	@mysql_connect(host,user,pw) or die('Could not connect to MySQL database. ');
	mysql_select_db(database);

	$incidents = mysql_query("SELECT `date_occurred`, `Descr`, `link`, `who_company`, `who_role`, `what_kind`, `Location`, `incident_root_cause`, `IncidentID` FROM `Privacy incidents` where review=1 ORDER BY date_occurred DESC");
	if (mysql_num_rows($incidents) == 0) {
		echo 'No incidents found!'; 
		die();
	}

?>

<div class="container container-fluid">
	<div>
		<h2 id="incidents-title">Privacy Incidents</h2>
	</div>
	<div>
		<table class="table table-striped">
			<thead>
				<tr>
					<th>Date </th>
					<th class="tags">Tags</th>
					<th class="descr">Description</th>
					<th class="resource">Resource</th>
					<th class="incidentID">ID</th>
				</tr>
			</thead>
			<tbody class="incidents-content">
		<?php 
			while ($i = mysql_fetch_row($incidents)) {		
				$date =  $i[0];
				$newDate = date("Y-m", strtotime($date));	
				$descr = $i[1];
				$link = $i[2];
				$link2 =parse_url($link, PHP_URL_HOST);
				// get host name from URL
				preg_match('@^(?:http://)?([^/]+)@i',
    				$link, $matches);
				$host = $matches[1];
				// get last two segments of host name
				preg_match('/[^.]+\.[^.]+$/', $host, $matches);
				$tags = $i[3] . "&nbsp" . $i[4] . "&nbsp" . $i[5] . "&nbsp" . $i[6] . "&nbsp" . $i[7];
				$incidentID = $i[8];
				$publication="";
				if (strcmp($link2,"www.nytimes.com" ) == 0){
					$publication = "New York Times";
				} else if (strcmp($link2, "arstechnica.com") == 0) {
					$publication = "Ars Technica";
				} else if (strcmp($link2, "www.ecns.cn")== 0){
					$publication = "CNS Wire";
				} else if (strcmp($link2, "www.reddit.com")== 0){
					$publication = "Reddit";
				} else if (strcmp($link2, "www.engadget.com")==0){
					$publication = "Engadget";
				} else if (strcmp($link2, "www.usatoday.com")==0){
					$publication = "USA Today";
				}
				else {
					$publication = $link2;
				}
				/*
				$who_company = $i[3];
				$who_role = $i[4];
				$what_kind = $i[5];
				$location = $i[6];
				$root_cause = $i[7];*/


				$tags = str_replace(", ", "&nbsp", $tags);
				$newTags = explode("&nbsp", $tags);

				foreach ($newTags as &$tag) {
					//Adds # symbol to beginning of tag if it's missing
					$firstLetter = substr($tag, 0, 1);
					if (!is_null($firstLetter) && strlen($firstLetter) != 0 && $firstLetter !== '#') {
						$newTag = "#" . $tag; 
						$tag = $newTag; 
					}

					//Removes the unnecessary comments in paranthesis
					if ($index = strpos($tag, "(select the country below)")) {
						$tag = substr($tag, 0, $index);
					}

					//Removes white space within a tag
					$tag = str_replace(' ', '', $tag);
				}

				$tags2 = implode("&nbsp", $newTags);
				
				echo '<tr>';
				echo '<td>' .$newDate. '</td>';
				echo '<td>' .$tags2. '</td>';
				echo '<td>' . $descr. '</td>';
				echo '<td><a href="' . $link . '" target=_blank>' . $publication. '</a></td>';
				echo '<td>' . $incidentID.'</td>';
				echo '</tr>';		

			}
		?>	

			</tbody>
		</table>
	</div>

<?php include 'layout/footer.html';?>
