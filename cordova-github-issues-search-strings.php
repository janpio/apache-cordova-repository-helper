<?php
include("include/repositories.php");
?>

<h1>Github Issues search strings for Cordova repositories</h1>

Use these search strings to search for items on Github that are part of the Cordova repositories:<br>
(note the ALL link at the bottom)<br>
<br>

<?php
function searchstring($repositories) {
	$searches = [];
	foreach($repositories as $repository) {
		$searches[] = 'repo:'.$repository;
	}
	return implode($searches, ' ');
}

function output_searchlinks($type) {
	global $repositories;
	$all_searchstrings = [];
	foreach($repositories as $group => $categories) 
	{
		echo "<h3>".$group."</h3>";
		echo "<ul>";
		
		if(isset($categories[0])) {
			$_repositories = $categories;
			$all_searchstrings[] = searchstring($_repositories);
			$url = "https://github.com/issues?q=".urlencode($type . ' ' . searchstring($_repositories)).'&s=created&type=Issues';
			echo "<li><a href='".$url."'>".$group."</a></li>";
		}
		else
		{
			$searchstrings = [];
			foreach($categories as $category => $_repositories) 
			{
				$searchstrings[] = searchstring($_repositories);
				$all_searchstrings[] = searchstring($_repositories);
				$url = "https://github.com/issues?q=".urlencode($type . ' ' . searchstring($_repositories)).'&s=created&type=Issues';
				echo "<li><a href='".$url."'>".$group." > ".$category."</a></li>";
			}
			$url = "https://github.com/issues?q=".urlencode($type . ' ' . implode($searchstrings, ' ')).'&s=created&type=Issues';
			echo "<li><a href='".$url."'>".$group." (ALL)</a></li>";
		}
		echo "</ul>";
	}
	$url = "https://github.com/issues?q=".urlencode($type . ' ' . implode($all_searchstrings, ' ')).'&s=created&type=Issues';
	echo "<a href='".$url."'>(ALL)</a>";
}
?>

<table>
	<tr>
		<td><h2>Issues only</h2></td>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><h2>PRs only</h2></td>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><h2>Issues and PRs</h2></td>
	</tr>
	<tr>
		<td><?php output_searchlinks('type:issue'); ?></td>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><?php output_searchlinks('type:pr'); ?></td>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><?php output_searchlinks(''); ?></td>
	</tr>
</table>





