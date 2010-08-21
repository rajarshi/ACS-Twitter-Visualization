<?php include("TwitterSearch.phps"); 

$term = $_GET['term'];
$what = $_GET['what'];

$search = new TwitterSearch($term);
$search->user_agent = 'phptwittersearch:rajarshi.guha@gmail.com';
$results = $search->rpp(50000)->results();

$ret = "";
foreach ($results as $result) {
  if ($what == "text") {
    $ret = $ret . " " . $result->{'text'};
  }
}
echo $ret;
?>

