<?php
header('Content-type: text/xml');
echo '<?xml version="1.0" encoding="UTF-8" standalone="yes"  ?>'; //these two lines are required when we want to write xml code for housekeeping
echo '<response>';
  $food= $_GET['food'];
  $foodarray= array('pizza','cake','cheeze','milkshake');
  if(in_array($food,$foodarray))
	  echo 'we do have'.$food.'!';
  elseif($food=='')
     echo 'enter food.';
  else 
	  echo 'we do not sell '.$food.'.';
  
  echo '</response>';

?>