<?php
include("include/repositories.php");

function searchstring($repositories) {
	$searches = [];
	foreach($repositories as $repository) {
		$searches[] = str_replace('apache/', '', $repository);
	}
	return implode($searches, ' ');
}

function output_searchlinks() {
	global $repositories;
	$all_searchstrings = [];
	foreach($repositories as $group => $categories) 
	{
        if(str_replace("Deprecated", "", $group) != $group || str_replace("Organization", "", $group) != $group) {
            continue;
        }

		echo "<h3>".$group."</h3>";
		echo "<ul>";
		
		if(isset($categories[0])) {
			$_repositories = $categories;
			$all_searchstrings[] = searchstring($_repositories);

			echo "<li><em>".$group."</em>:<br> ".searchstring($_repositories)."</li>";
		}
		else
		{
			$searchstrings = [];
			foreach($categories as $category => $_repositories) 
			{
                if(str_replace("Deprecated", "", $category) != $category) {
                    continue;
                }

				$searchstrings[] = searchstring($_repositories);
				$all_searchstrings[] = searchstring($_repositories);
				echo "<li><em>".$group." > ".$category."</em>:<br> ".searchstring($_repositories)."</li>";
			}
			echo "<li><em>".$group." (ALL)</em>:<br> ".implode($searchstrings, ' ')."</li>";
		}
		echo "</ul>";
	}
	$url = "http://prs.mozilla.io/apache:".urlencode(implode($all_searchstrings, ','));
	echo "(ALL):<br> ".implode($all_searchstrings, ' ')."";
}
?>

<table>
	<tr>
		<td><h2>Simple lists of repo names</h2></td>
	</tr>
	<tr>
		<td><?php output_searchlinks(); ?></td>
	</tr>
</table>