<?php

$homedir = str_replace("/public_html", "", $_SERVER['DOCUMENT_ROOT']);
$username = str_replace("/home/", "", $homedir);

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Log Viewer</title>
        <meta http-equiv="x-ua-compatible" content="IE=100">
            <!--[if lt IE 9]> <script type="text/javascript" src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
            <meta charset="UTF-8">
            <style>
    /* This CSS should ideally be in an external file but am keeping it 
       here so that only 1 file is required for the log viewer system */
    main, article, aside, details, figcaption, figure,  footer, header, hgroup, menu, nav, section, summary{ display: block; }

body{
    font-family: Tahoma, Arial, Verdana, sans-serif;
    font-size: 10pt;
}

h1{ font-size : 14pt; }

            ul#logLines{
                list-style-type: none;
margin: 0;
padding: 0;
clear: both;
padding-top: 10px;
}
            ul#logLines li{
                background: #e2e2e2;
                padding: 5px;
}
            ul#logLines li:nth-child(odd) {
                background: #FFFFDD;
                }

.errorsBox {
    background-color: #ff7979;
    border: 1px dashed #ffffff;

         -moz-border-radius-topleft: 5px;
    -webkit-border-top-left-radius: 5px;
     -moz-border-radius-topright: 5px;
     -webkit-border-top-right-radius: 5px;
     -moz-border-radius-bottomleft: 5px;
     -webkit-border-bottom-left-radius: 5px;
     -moz-border-radius-bottomright: 5px;
     -webkit-border-bottom-right-radius: 5px;

   width: 465px;
   padding: 5px;
   margin: 0 auto;
     margin-top: 5px;
 }

            #optionsContainer{
width: 870px;
margin: 0 auto;
}

            #sortDetails, #refreshLink{
padding: 5px;
float: left;
}

            #refreshLink{
margin: 0 50px;
}
        </style>
    </head>
    <body>
        <h1 style="text-align: center;">Log Viewer</h1>
                      <?php
              if (!empty($errors)) {
                              echo "<div class='errorsBox'>"
                                          . "<strong>Errors: </strong>"
                              . "<ul>";
                              foreach ($errors as $error) {
                                  echo "<li>" . $error . "</li>";
                              }
                                          echo "</ul>"
                              . "</div>";
              }

              /* tailCustom - Useful function for reading x lines from the end of 
               * a file. Created by Lorenzo Stanco
               * Source: https://gist.github.com/lorenzos/1711e81a9162320fde20
               * Related stack overflow discussion answer: https://gist.github.com/lorenzos/1711e81a9162320fde20 */

              function tailCustom($filepath, $lines = 1, $adaptive = true) {
                  // Open file
                  $f = @fopen($filepath, "rb");
                  if ($f === false) {
                      return false;
                  }

                  // Sets buffer size
                  if (!$adaptive) {
                      $buffer = 4096;
                  } else {
                      $buffer = ($lines < 2 ? 64 : ($lines < 10 ? 512 : 4096));
                  }

                  // Jump to last character
                  fseek($f, -1, SEEK_END);

                  // Read it and adjust line number if necessary (otherwise the
                  // result would be wrong if file doesn't end with a blank line)
                  if (fread($f, 1) != "\n") {
                      $lines -= 1;
                  }

                  // Start reading
                  $output = '';
                  $chunk = '';

                  // While we would like more
                  while (ftell($f) > 0 && $lines >= 0) {
                      // Figure out how far back we should jump
                      $seek = min(ftell($f), $buffer);
                      // Do the jump (backwards, relative to where we are)
                      fseek($f, -$seek, SEEK_CUR);
                      // Read a chunk and prepend it to our output
                      $output = ($chunk = fread($f, $seek)) . $output;
                      // Jump back to where we started reading
                      fseek($f, -mb_strlen($chunk, '8bit'), SEEK_CUR);
                      // Decrease our line counter
                      $lines -= substr_count($chunk, "\n");
                  }

                  // While we have too many lines (because of buffer size we
                  // might have read too many)
                  while ($lines++ < 0) {
                      // Find first newline and remove all text before that
                      $output = substr($output, strpos($output, "\n") + 1);
                  }
                  // Close file and return
                  fclose($f);
                  return trim($output);
              }

$linesChosen = filter_input(INPUT_GET, "lines", FILTER_SANITIZE_URL);
$lines = ((!empty($linesChosen)) && ($linesChosen > 0)) ? $linesChosen : 10;

// Read set amount of lines from the end of the log file using
// tailCustom function
$selectedLines = tailCustom("/home/".$username."/var/log/".$username."_bucomputing_uk-error.log", $lines);

if (!$selectedLines){
    echo "<p>Opening log file failed</p>";
}

// Convert string to array of lines (split on new line)
$selectedLinesArr = explode("\n", $selectedLines);

$order = filter_input(INPUT_GET, "order", FILTER_SANITIZE_ENCODED);

if (empty($order)){ $order = "desc"; } // If order hasn't been set
// make it descending, this seems most logical for displaying on
// a web page.
        ?>
        <div id="optionsContainer">
                <?php
    if ($order == "asc") {  // If they want lines in ascending order
        echo "<span id='sortDetails'>Lines are in ascending order, <a href='?order=desc&lines=" . $lines . "'>Sort Descending</a></span>\n";
    } else { // They must want descending order (as they didn't select ascending)
        krsort($selectedLinesArr); // Reverse the order of the array of lines
        echo "<span id='sortDetails'>Lines are in descending order, <a href='?order=asc&lines=" . $lines . "'>Sort Ascending</a></span>\n";
    }
            ?>
            <a href="<?php echo $_SERVER["REQUEST_URI"]; ?>" title='Refresh page' id="refreshLink">Refresh page to get the latest log entries</a>

                <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method='get' style="float: left; margin-right: 50px;">
                    <input name='order' type='hidden' value='<?php echo $order; ?>'>
                    <label for='lines'>Lines to show: </label>
                    <select id='lines' name='lines' onchange='this.form.submit()'>
    <option value='10'<?php if ($lines == 10) { echo " selected"; } ?>>10</option>
<option value='20'<?php if ($lines == 20) { echo " selected"; } ?>>20</option>
<option value='50'<?php if ($lines == 50) { echo " selected";} ?>>50</option>
<option value='100'<?php if ($lines == 100) { echo " selected"; } ?>>100</option>
<option value='200'<?php if ($lines == 200) { echo " selected"; } ?>>200</option>
<option value='500'<?php if ($lines == 500) { echo " selected"; } ?>>500</option>
                </select>
            </form>
        </div>
<?php
if (!empty($selectedLinesArr)) {
    echo "<ul id='logLines'>\n";
    foreach ($selectedLinesArr as $line) {
        $line = trim($line);
        if (!empty($line)) {
            echo "<li>" . $line . "</li>\n";
        } else {
            echo "<li>Nothing found on this line</li>\n";
        }
    }
    echo "</ul>\n";
} else {
    echo "<p>Nothing found in log file</p>\n";
}
?>
    </body>
</html>