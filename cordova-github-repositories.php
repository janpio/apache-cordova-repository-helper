<?php
include("include/repositories.php");
?>

<h1>Grouped list of Cordova repositories on Github</h1>

<?php
function output_repositories($repositories) {
	echo "<ul>";
	foreach($repositories as $repository) {
		echo "<li>".$repository."</li>";
	}
	echo "</ul>";
}

foreach($repositories as $group => $categories) 
{
	echo "<h3>".$group."</h3>";

	if(isset($categories[0])) {
		$repositories = $categories;
		output_repositories($repositories);
	}
	else
	{
		foreach($categories as $category => $repositories) 
		{
			echo "<h4>".$category."</h4>";
			output_repositories($repositories);
		}
	}
}
?>