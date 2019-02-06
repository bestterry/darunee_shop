<?php
// How to use same field name multiple times on form
// Process these fields in Javascript and PHP
// Must use "ID" in Javascript and "NAME" in PHP 
echo "<HTML>";
echo "<HEAD>";
?>
<script type="text/javascript">
function TestForm(form) {
// Loop through the HTML form field (TheId) that is returned as an array. 
// The form field has multiple (n) occurrences on the form, each which has the same name.
// This results in the return of an array of elements indexed from 0 to n-1.
// Use ID  in Javascript
var i = 0;
document.write("<P>Javascript responding to your button click:</P>");
for (i=0; i < form.TheId.length; i++) {
  document.write(form.TheId[i].value);
  document.write("<br>");
}  
}
</script>
<?php
echo "</HEAD>";
echo "<BODY>";
$DQ = '"';  # Constant for building string with double quotes in it.

if (isset($_POST["MyButton"])) {
  $TheNameArray = $_POST["TheName"];  # Use NAME in PHP
  echo "<P>Here are the names you submitted to server:</P>";
  for ($i = 0; $i <3; $i++) {   
    echo $TheNameArray[$i] . "<BR>";
  } 
}
echo "<P>Enter names and submit to server or Javascript</P>";
echo "<FORM NAME=TstForm METHOD=POST ACTION=" ;
echo $DQ . "TestArrayFormToJavascript2.php" . $DQ . "OnReset=" . $DQ . "return allowreset(this)" . $DQ . ">";
echo "<FORM>";
echo "<INPUT ID = TheId NAME=" . $DQ . "TheName[]" . $DQ . " VALUE=" . $DQ . "" . $DQ . ">";
echo "<INPUT ID = TheId NAME=" . $DQ . "TheName[]" . $DQ . " VALUE=" . $DQ . "" . $DQ . ">";
echo "<INPUT ID = TheId NAME=" . $DQ . "TheName[]" . $DQ . " VALUE=" . $DQ . "" . $DQ . ">";
echo "<P><INPUT TYPE=submit NAME=MyButton VALUE=" . $DQ . "Submit to server"    . $DQ . "></P>";
echo "<P><BUTTON onclick=" . $DQ . "TestForm(this.form)" . $DQ . ">Submit to Javascript</BUTTON></P>"; 
echo "</FORM>";
echo "</BODY>";
echo "</HTML>";