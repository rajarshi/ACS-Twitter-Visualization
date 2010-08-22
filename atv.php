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
  $ret = str_replace(" RT ", "", $ret);
  $ret = str_replace(" Boston ", "", $ret);
  $ret = str_replace(" ACS ", "", $ret);
  $ret = str_replace(" #ACS_Boston ", "", $ret);


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

