<?php
include("include/repositories.php");
?>

<h1>Grouped list of Cordova repositories on Github with checkboxes as Markdown</h1>

<textarea style="width:100%; height:50%;">
<!-- This markdown was generated with http://cordova.betamo.de/cordova-github-repositories-checkboxes_markdown.php -->

<?php
function output_repositories($repositories) {
	#echo "\n";
	foreach($repositories as $repository) {
		echo "- [ ] ".str_replace("apache/", "", $repository)."\n";
	}
	#echo "\n";
}

foreach($repositories as $group => $categories) 
{	
	if(str_replace("Deprecated", "", $group) != $group || str_replace("Organization", "", $group) != $group) {
		continue;
	}

	echo "#### ".$group."\n";


	if(isset($categories[0])) {
		$repositories = $categories;
		output_repositories($repositories);
	}
	else
	{
		foreach($categories as $category => $repositories) 
		{
			if(str_replace("Deprecated", "", $category) != $category) {
				continue;
			}
			
			echo "##### ".$category."\n";
			output_repositories($repositories);
		}
	}
	echo "\n";
}
?>
</textarea>