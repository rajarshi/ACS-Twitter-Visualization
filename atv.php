<?php include("TwitterSearch.phps"); 

$search = new TwitterSearch("#acs_boston");
$search->user_agent = 'phptwittersearch:rajarshi.guha@gmail.com';
$results = $search->rpp(50000)->results();

$txt = "";
foreach ($results as $result) {
$txt = $txt . " " . $result->{'text'};
}
echo $txt;
#print_r($results[0]);
?>

