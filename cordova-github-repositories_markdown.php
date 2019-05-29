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
		$_repositories = $categories;
		output_repositories($_repositories);
	}
	else
	{
		foreach($categories as $category => $_repositories) 
		{
			echo "#### ".$category."\n";
			output_repositories($_repositories);
		}
	}
}
?>
</textarea>

Deprecated lists hidden behind &lt;details&gt;:
<textarea style="width:100%; height:50%;">
<!-- This markdown was generated with http://cordova.betamo.de/cordova-github-repositories_markdown.php -->

<?php
foreach($repositories as $group => $categories) 
{
	if(str_replace("Deprecated", "", $group) != $group || str_replace("Organization", "", $group) != $group) {
		echo "<details><summary>$group</summary>\n\n";
	}

	echo "### ".$group."\n";

	if(isset($categories[0])) {
		$_repositories = $categories;
		output_repositories($_repositories);
	}
	else
	{
		foreach($categories as $category => $_repositories) 
		{
			if(str_replace("Deprecated", "", $category) != $category) {
				echo "<details><summary>$category</summary>\n\n";
			}

			echo "#### ".$category."\n";
			output_repositories($_repositories);

			if(str_replace("Deprecated", "", $category) != $category) {
				echo "</details>\n\n";
			}
		}
	}

	if(str_replace("Deprecated", "", $group) != $group || str_replace("Organization", "", $group) != $group) {
		echo "</details>\n\n";
	}
}
?>
</textarea>