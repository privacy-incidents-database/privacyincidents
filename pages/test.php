<?php
	include 'db.php';

	@mysql_connect(host,user,pw) or die('Could not connect to MySQL database. ');
	mysql_select_db(database);

	$incidents = mysql_query("SELECT `date_occurred`, `Descr`, `link`, `who_company`, `who_role`, `what_kind`, `Location`, `incident_root_cause` FROM `Privacy incidents` where review=1 ORDER BY date_occurred DESC limit 10");
	if (mysql_num_rows($incidents) == 0) {
		echo 'No incidents found!'; 
		die();
	}

	while ($i = mysql_fetch_row($incidents)) {
		$date = $i[0];
		$descr = $i[1];
		$link = $i[2];
		$tags = $i[3] . "&nbsp" . $i[4] . "&nbsp" . $i[5] . "&nbsp" . $i[6] . "&nbsp" . $i[7];

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

		//var_dump($newTags);

		$tags2 = implode("&nbsp", $newTags);
		
		echo '<tr>';
		echo '<td>' . $date . '</td>';
		echo '<td>' . $descr. '</td>';
		echo '<td><a href="' . $link . '" target=_blank>' . $link . '</a></td>';
		echo '<td>' . $tag2s . '</td>';
		echo '</tr>';		

	}



?>