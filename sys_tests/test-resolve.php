/*

 test web server can resolve and fetch external resources

/*

<?php

$url = "http://ip.bmth.ac.uk";
$url = urlencode($url);
$contents = file_get_contents(urldecode($url));
echo $contents;

?>