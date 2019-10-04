<?php
//$q = intval($_GET['q']);
$flag = intval($_GET['flag']);
@$event = intval($_GET['event']);
@$csi_member=intval($_GET['csi_member']);
@$cost_from_db=intval($_GET['cost']);
@$paid=intval($_GET['paid']);
//echo$paid;
//echo $flag;
// echo $event;
// echo $csi_member;
include("connect.php");

$sql="SELECT * FROM costdb WHERE event_id='$event'";
$result = mysql_query($sql,$con);

// echo $event;

while($row = mysql_fetch_array($result)) 
{
	 // echo $csi_member;
    $event_name=$row['event_name'];
    $cost=$row['cost'];
	if(($csi_member==1)&&($event_name!="Search Engine Generation-rait")&&($event_name!="Search Engine Generation"))
	{
		$cost=$cost/2;
	}
    
	
}
if($flag==1)
{
	
echo $cost;
}
else 
{	if($flag==2)
	{
	
	 @$bal=$cost-$paid;
	 echo $bal;
	}
}

mysql_close($con);
?>