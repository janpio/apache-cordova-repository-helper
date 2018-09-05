<?php
include("include/repositories.php");
?>

<h1>Grouped list of Cordova repositories on Github as Markdown</h1>

<textarea style="width:100%; height:80%;">
<!-- This markdown was generated with http://cordova.betamo.de/cordova-status_markdown.php -->

<?php
function output_repositories($repositories) {
	#echo "\n";
	foreach($repositories as $repository) {
		echo "| [".str_replace("apache/", "", $repository)."](https://github.com/".$repository.") ";
		echo "| [![Build Status](https://travis-ci.org/".$repository.".svg?branch=master)](https://travis-ci.org/".$repository.") ";
		echo "| ![Build status](https://ci.appveyor.com/api/projects/status/github/".$repository."?branch=master&svg=true) [#1](https://ci.appveyor.com/project/ApacheSoftwareFoundation/".str_replace("apache/", "", $repository)."/branch/master), [#2](https://ci.appveyor.com/project/Humbedooh/".str_replace("apache/", "", $repository)."/branch/master) ";
		echo "| [![codecov.io](https://codecov.io/github/".$repository."/coverage.svg?branch=master)](https://codecov.io/github/".$repository."?branch=master) ";
		echo "|\n";
	}
	#echo "\n";
}

foreach($repositories as $group => $categories) 
{	
	echo "| ".$group." | Travis CI | AppVeyor | Code Coverage |
| :--- | :---: | :---: | :---: |\n";

	if(isset($categories[0])) {
		$repositories = $categories;
		output_repositories($repositories);
	}
	else
	{
		foreach($categories as $category => $repositories) 
		{
			echo "| ".$category." |  |  |  |\n";
			output_repositories($repositories);
		}
	}
	echo "\n<hr>\n\n";
}
?>
</textarea>