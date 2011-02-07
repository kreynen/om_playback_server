<?php
// $Id: missing_files_listener.php,v 1.1 2010/10/19 21:41:14 lkacenja Exp $ 
/**
  * Missing file report listener script writtern by Kreynen. Checks missing file report for TBD airings,
  * and then sends shows to the playback server. This is intended to live outside of your drupal install,
  * and to run on cron.
  */
  
// This part of the script will be sever set up specific. Make Server specific changes here:
$url = 'your path to missing file report';
$xml = simplexml_load_file($url);
$defaultfilepath = 'your path to file storage';
$importpath = 'your path to playback server';
print 'Missing Files Report: ' . $url . '<br />';
print 'Default: ' . $defaultfilepath . '<br />';
print 'Import: ' . $importpath;
// End server specific changes

$unique_shows = array();

foreach ($xml->content_file as $show) {
	$unique_shows[] = $show->filename;
}

$unique_shows = array_unique($unique_shows);
 
print '<h3>Copying shows</h3>';
 
foreach ($unique_shows as $show) {
 $filetomove = $defaultfilepath . $show;
 echo $filetomove . ' ' . $importpath . $show . "<br />\n";
 exec('copy ' . $filetomove . ' ' . $importpath);
} 
 
?>