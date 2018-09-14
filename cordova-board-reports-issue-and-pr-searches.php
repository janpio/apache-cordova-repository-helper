<?php
include("include/repositories.php");
?>

<h1>Search links for Cordova Board Reports to get Issue and PR numbers</h1>

Use these links to get the number of issues and PRs opened and closed in a quarter:
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
	$baseurl = (strpos($type, 'type:pr') !== false) ? "https://github.com/pulls?q=" : "https://github.com/issues?q=";
	
	$all_searchstrings = [];
	foreach($repositories as $group => $categories) 
	{
		#echo "<h3>".$group."</h3>";
		#echo "<ul>";
		
		if(isset($categories[0])) {
			$_repositories = $categories;
			$all_searchstrings[] = searchstring($_repositories);
			$url = $baseurl.urlencode($type . ' ' . searchstring($_repositories)).'&s=created&type=Issues';
			#echo "<li><a href='".$url."'>".$group."</a></li>";
		}
		else
		{
			$searchstrings = [];
			foreach($categories as $category => $_repositories) 
			{
				$searchstrings[] = searchstring($_repositories);
				$all_searchstrings[] = searchstring($_repositories);
				$url = $baseurl.urlencode($type . ' ' . searchstring($_repositories)).'&s=created&type=Issues';
				#echo "<li><a href='".$url."'>".$group." > ".$category."</a></li>";
			}
			$url = $baseurl.urlencode($type . ' ' . implode($searchstrings, ' ')).'&s=created&type=Issues';
			#echo "<li><a href='".$url."'>".$group." (ALL)</a></li>";
		}
		#echo "</ul>";
	}
	$url = $baseurl.urlencode($type . ' ' . implode($all_searchstrings, ' ')).'&s=created&type=Issues';
	echo "<a href='".$url."'>show</a>";
}


$dates = [
	'March 2018 (Q1)' => ['start' => '2017-12-01', 'end' => '2018-03-01'],
	'June 2018 (Q2)' => ['start' => '2018-03-01', 'end' => '2018-06-01'],
	'September 2018 (Q3)' => ['start' => '2018-06-01', 'end' => '2018-09-01'],
	'December 2018 (Q4)' => ['start' => '2018-09-01', 'end' => '2018-12-01'],
	'March 2019 (Q1)' => ['start' => '2018-12-01', 'end' => '2019-03-01'],
	'June 2019 (Q2)' => ['start' => '2019-03-01', 'end' => '2019-06-01'],
	'September 2019 (Q3)' => ['start' => '2019-06-01', 'end' => '2019-09-01'],
	'All Time' => ['start' => '1995-01-01', 'end' => '2100-01-01'],
];


foreach($dates as $q => $date) {
	$start = $date['start'];
	$end = $date['end'];
	$createdSearchString = "-created:<$start -created:>=$end";
	$closedSearchString = "-closed:<$start -closed:>=$end";
	$mergedSearchString = "-merged:<$start -merged:>=$end";

	
	echo "<h2>$q</h2>";
	
	echo "<ul>"; ?>
		<li>Issues created in quarter: <?php output_searchlinks("type:issue $createdSearchString"); ?> (displays individually how many of those still open and how many closed)</li>
		<li>Issues closed in quarter: <?php output_searchlinks("type:issue is:closed $closedSearchString"); ?></li>
		<li>PRs created in quarter: <?php output_searchlinks("type:pr $createdSearchString"); ?> (displays individually how many of those still open and how many closed/merged)</li>
		<li>PRs merged in quarter: <?php output_searchlinks("type:pr is:merged $mergedSearchString"); ?></li>
		<li>PRs closed in quarter: <?php output_searchlinks("type:pr is:closed is:unmerged $closedSearchString"); ?></li>
		<li>PRs closed or merged in quarter: <?php output_searchlinks("type:pr is:closed $closedSearchString"); ?></li>
	<?php echo "</ul>";
	
}
?>


