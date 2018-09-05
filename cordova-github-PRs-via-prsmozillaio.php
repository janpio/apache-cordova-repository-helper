<?php
include("include/repositories.php");
?>

<h1>Github PR dashboard links for Cordova reporistories (via prs.mozilla.io)</h1>

(note the ALL link at the bottom)<br>
<br>

<?php
function searchstring($repositories) {
	$searches = [];
	foreach($repositories as $repository) {
		$searches[] = str_replace('apache/', '', $repository);
	}
	return implode($searches, ',');
}

function output_searchlinks() {
	global $repositories;
	$all_searchstrings = [];
	foreach($repositories as $group => $categories) 
	{
		echo "<h3>".$group."</h3>";
		echo "<ul>";
		
		if(isset($categories[0])) {
			$_repositories = $categories;
			$all_searchstrings[] = searchstring($_repositories);
			$url = "http://prs.mozilla.io/apache:".urlencode(searchstring($_repositories));
			echo "<li><a href='".$url."'>".$group."</a></li>";
		}
		else
		{
			$searchstrings = [];
			foreach($categories as $category => $_repositories) 
			{
				$searchstrings[] = searchstring($_repositories);
				$all_searchstrings[] = searchstring($_repositories);
				$url = "http://prs.mozilla.io/apache:".urlencode(searchstring($_repositories));
				echo "<li><a href='".$url."'>".$group." > ".$category."</a></li>";
			}
			$url = "http://prs.mozilla.io/apache:".urlencode(implode($searchstrings, ','));
			echo "<li><a href='".$url."'>".$group." (ALL)</a></li>";
		}
		echo "</ul>";
	}
	$url = "http://prs.mozilla.io/apache:".urlencode(implode($all_searchstrings, ','));
	echo "<a href='".$url."'>(ALL)</a>";
}
?>

<table>
	<tr>
		<td><h2>PRs</h2></td>
	</tr>
	<tr>
		<td><?php output_searchlinks(); ?></td>
	</tr>
</table>





