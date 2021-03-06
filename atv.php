<?php include("TwitterSearch.phps"); 

$term = $_GET['term'];
$what = $_GET['what'];

$search = new TwitterSearch($term);
$search->user_agent = 'phptwittersearch:rajarshi.guha@gmail.com';
$results = $search->rpp(50000)->results();

#print_r($results[0]);

if ($what == "text") {
  $ret = "";
  foreach ($results as $result) {
    $ret = $ret . " " . $result->{'text'};
  }

  # remove some common words - we do this here
  # as I can't see how to make the jQuery plugin
  # to this
  $needles = array(" RT ", " #ACS_Boston ", " Meeting ", "ACSNatlMtg", "OK",
		   "ACS", "Boston", "Visit", "Meeting", "Still", "Just", "Need",
		   "Want", "Attending", "Getting", "SADI", "Join", "Currently", "Meet",
		   "Everyone", "Hotel", "Seaport", "Ballroom", "June", "Guess", "Session",
		   "Follow", "First", "LeighJKBoerner", "Booth", "PM", "PSI", "Monday",
		   "Will", "Somewhere");
  foreach ($needles as $needle) {
    $ret = str_replace($needle, "", $ret);
  }

  echo $ret;
} else if ($what == "author") {
  $ret = array();
  foreach ($results as $result) {
    $author = $result->{'from_user'};
    if ($ret[$author] == NULL) $ret[$author] = 1;
    else $ret[$author] = $ret[$author]+1;
  }
  $cleanret = array();
  foreach ($ret as $key => $value) {
    if ($value > 1) {
      $cleanret[$key] = $value;
    }
  }
  $txt = "";
  foreach ($cleanret as $key => $value) $txt = $txt . $key . " " . $value . "\n";
  echo $txt;
}

?>

