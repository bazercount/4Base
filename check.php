<?php session_start();
echo "print_r($_SESSION)";
echo '<pre>';var_dump($_SESSION);echo '</pre>';
// or
echo '<pre>';print_r($_SESSION);echo '</pre>';
?>

<?php
    session_start();
    echo "<h3> PHP List All Session Variables</h3>";
    foreach ($_SESSION as $key=>$val)
    echo $key." ".$val."<br/>";
?>

<?php
    session_start();
echo '<pre>';
var_dump($_SESSION);
echo '</pre>';
?>