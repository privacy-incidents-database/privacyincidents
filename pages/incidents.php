<?php
	include 'layout/header.html';
	include 'db.php';

	@mysql_connect(host,user,pw) or die('Could not connect to MySQL database. ');
	mysql_select_db(database);

	$incidents = mysql_query("SELECT `date_occurred`, `Descr`, `link`, `who_company`, `who_role`, `what_kind`, `Location`, `incident_root_cause`, `IncidentID`, `case study` FROM `Privacy incidents` where review=1 ORDER BY date_occurred DESC");
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
		<table class="table table-striped table-bordered">
			<thead>
				<tr>
					<th class ="col-md-1">Date </th>
					<th class="tags col-md-4">Tags</th>
					<th class="descr">Description</th>
					<th class="resource col-md-1">Resource</th>
					<th class="incidentID col-md-2">ID</th>
				</tr>
			</thead>
			<tbody class="incidents-content">
		<?php 
			$numbers = mysql_num_rows($incidents);
			echo "Number of Entries: $numbers";
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
				$caseStudy = $i[9];
				$publication="";
				$incidentID1 =$incidentID;
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
				else {  $str = file_get_contents($link2);
				       
				        //$tg2 = implode("", $title); 
				        // $publication= $tg2 ;
				        if(strlen($str)>0){
                                             $str = trim(preg_replace('/\s+/', ' ', $str)); // supports line breaks inside <title>
                                             preg_match("/\<title\>(.*)\<\/title\>/i",$str,$title); // ignore case
                                             $publication= $title[1] ;}
                                        else
                                             $publication= "none" ;
                                      

				}
				// adding changes to remove ID when no case study exists
				if ($caseStudy == "" ){
				        $incidentID1="" ;
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
                                // changes the way the tags are displayed 
				$tags2 = implode(" , ", array_filter($newTags));
				
				echo '<tr>';
				echo '<td>' .$newDate. '</td>';
				echo '<td>' .$tags2. '</td>';
				echo '<td>' . $descr. '</td>';
				echo '<td><a href="' . $link . '" target=_blank>' . $publication. '</a></td>';
				echo '<td><a href= "'. $caseStudy. '" target=_blank>'.$incidentID1. '</a></td>';
				echo '</tr>';		

			}
		?>	

			</tbody>
		</table>
	</div>

<?php include 'layout/footer.html';?>
