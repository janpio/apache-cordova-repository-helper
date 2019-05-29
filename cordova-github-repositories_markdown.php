<?php
include("include/repositories.php");
?>

<h1>Grouped list of Cordova repositories on Github as Markdown</h1>

<textarea style="width:100%; height:50%;">
<!-- This markdown was generated with http://cordova.betamo.de/cordova-github-repositories_markdown.php -->

<?php
function output_repositories($repositories) {
	echo "\n";
	foreach($repositories as $repository) {
		echo "- [".$repository."](https://github.com/".$repository.")\n";
	}
	echo "\n";
}

foreach($repositories as $group => $categories) 
{
	echo "### ".$group."\n";

	if(isset($categories[0])) {
		$repositories = $categories;
		output_repositories($repositories);
	}
	else
	{
		foreach($categories as $category => $repositories) 
		{
			echo "#### ".$category."\n";
			output_repositories($repositories);
		}
	}
}
?>
</textarea>