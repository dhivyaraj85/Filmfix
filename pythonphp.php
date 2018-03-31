<?php
$item='Everything is awesome!!';
$tmp = exec("hello.py");
echo $item;
echo $tmp;
echo "jj";
?>

<?php 
$output = shell_exec("python hello.py 12");
echo $output;
?>

