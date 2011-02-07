<?php 

//START CONFIGURATION
//Path to native directory on server running this script
$path = "I:\\import\\native";
//RETURN URL IS USED IN THE MESSAGE DISPLAYED IN DRUPAL
$return_url = 'http://<YOUR SERVER>/';
//END CONFIGURATION

$csv = $_GET['csv'];
$nid = $_GET['nid'];

if($csv){

  $csv_header = "Output,Date,Time,Type,Source ID,Source Name,Offset,Duration,Output Name,Program Code,Episode Code,Program,Title,Episode,Description,Preroll,Postroll,OSD,OSD Path,OSD File,Include In Guide,Track Content Attributes,Overlay Alpha Blend,Overlay Chroma Key,Overlay X Coordinate,Overlay Y Coordinate,Overlay Width,Overlay Height,Program Number,Switch Command\n";
  
  $csv_output = $csv_header . $csv;
  
  $myFile = $path . '\om_playback_servers_' . time() . '.csv';
  $output = $output . 'Schedule file written to ' . $myFile;
  $fh = fopen($myFile, 'w') or die("can't open file");
  fwrite($fh, $csv);
  fclose($fh);
  $output = $output . '<p>Your show has been successfully scheduled!  The next airing should already appear on the <a href="' . $return_url . '/node/' . $nid .'">show\'s page</a>.  Start telling people when they can tune in!'  ;
  
  print $output;
} else {
 print 'no csv';
}
?>