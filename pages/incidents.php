<?php
	include 'layout/header.html';
	include 'db.php';

	@mysql_connect(host,user,pw) or die('Could not connect to MySQL database. ');
	mysql_select_db(database);

	$incidents = mysql_query("SELECT `date_occurred`, `Descr`, `link`, `who_company`, `who_role`, `what_kind`, `Location`, `incident_root_cause` FROM `Privacy incidents` ORDER BY date_occurred DESC");
	if (mysql_num_rows($incidents) == 0) {
		echo 'No incidents found!'; 
		die();
	}

?>

<div class="container container-fluid">
	<div>
		<h2 id="incidents-title">Privacy Incidents</h2>
	</div>

<?php 
     /* echo
      '<li><iframe src='//cdn.knightlab.com/libs/timeline3/latest/embed/index.html?source=1enCq3hewy7vr2_Jq6mHj1kkA0kLZ2DTNe-kSN1BhndI&font=Default&lang=en&initial_zoom=2&height=650' width='100%' height='650' frameborder='0'></iframe><li>';
	*/
?>

	<div>
		<table class="table table-striped">
			<thead>
				<tr>
					<th>Date Incident Acknowledged</th>
					<th class="descr">Description</th>
					<th class="resource">Resource</th>
					<th class="tags">Tags</th>
				</tr>
			</thead>
			<tbody class="incidents-content">
		<?php 
			while ($i = mysql_fetch_row($incidents)) {
				$date = $i[0];
				$descr = $i[1];
				$link = $i[2];
				$tags = $i[3] . $i[4] . $i[5] . $i[6] . $i[7];

				$tags = str_replace(", ", "&nbsp", $tags);
				$newTags = explode('#', $tags);

				foreach ($newTags as &$tag) {
					if ($index = strpos($tag, "countrygovernment") == 0) {
						$tag = substr($tag, 0, 17);
					}
				}
				$tags = implode(" #", $newTags);


				echo '<tr>';
				echo '<td>' . $date . '</td>';
	
				echo '<td>' . $descr. '</td>';
				echo '<td><a href="' . $link . '" target=_blank>' . $link . '</a></td>';
				echo '<td>' . $tags . '</td>';
	
				echo '</tr>';
			}
		?>	

			</tbody>
		</table>
	</div>

<?php include 'layout/footer.html';?>