<?php
$con = mysql_connect("localhost","root","");
if (!$con) 
{
    die('Could not connect: ' . mysql_error($con));
}

mysql_select_db("techmate15",$con);
?>