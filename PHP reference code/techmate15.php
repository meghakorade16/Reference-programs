<script>

		
function member()
{	
	var event = document.getElementById('event').value;
	var paid = document.getElementById('paid').value;
	if(document.getElementById('csi_member').checked)
	{
		var csi_member=document.getElementById('csi_member').value;
	}
	//alert(event);
    
	
	if(event!="")
	{   var flag=1; 
		if (window.XMLHttpRequest) 
		{	
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        }
		xmlhttp.onreadystatechange = function() 
		{
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
			{	
		// alert("2");
                document.getElementById("cost").innerHTML = xmlhttp.responseText;
				
            }
        }
		
		if(document.getElementById('csi_member').checked)
		{
			// alert();
		xmlhttp.open("GET","db.php?event="+event+"&paid="+paid+"&csi_member="+csi_member+"&flag="+flag,true);}
		else
			xmlhttp.open("GET","db.php?event="+event+"&paid="+paid+"&flag="+flag,true);

			xmlhttp.send();
	}		

		if(paid!="")
	{
		var flag=2;
		if (window.XMLHttpRequest) 
		{
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp1 = new XMLHttpRequest();
        }
		xmlhttp1.onreadystatechange = function() 
		{
            if (xmlhttp1.readyState == 4 && xmlhttp1.status == 200) 
			{	//alert("2");
				if(Number(xmlhttp1.responseText)<0)
				{	document.getElementById("balance").innerHTML ="Check Paid amount";
					
				}
				else
                document.getElementById("balance").innerHTML = xmlhttp1.responseText;
				
            }
        }
		
		if(document.getElementById('csi_member').checked)
			xmlhttp1.open("GET","db.php?event="+event+"&paid="+paid+"&csi_member="+csi_member+"&flag="+flag,true);
		else
			xmlhttp1.open("GET","db.php?event="+event+"&paid="+paid+"&flag="+flag,true);

			xmlhttp1.send();
	}	
    
}		

</script>


<title> TECHMATE</title>
<center>
<div class="title" width="100px" height="50px">
<h1>
<font color="blue">
<b><u> TECHMATE15 </u></b>

</font>
</h1>
</div>
</center>



<?php 
//fetching values
@$receipt_no=$_REQUEST['receipt_no'];
@$participant_name=$_REQUEST['name'];
@$event=$_REQUEST['event'];
@$college=$_REQUEST['college'];
@$year=$_REQUEST['year'];
@$phone_no=$_REQUEST['phone_no'];
@$email=$_REQUEST['email'];
@$paid=$_REQUEST['paid'];
@$csi_member=$_REQUEST['csi_member'];

// echo$event."<br>".$balance."<br>".$cost_entered."<br>";

include("connect.php");			
$sql="SELECT * FROM `entries` WHERE 1";
					$res=mysql_query($sql,$con);
					$count=mysql_num_rows($res);
$date = date('Y-m-d');
if($event&&$participant_name&&$receipt_no&&$phone_no&&$paid)
{ 					//echo"1";
					
					$sql="SELECT * FROM `entries` WHERE 1";
					$res=mysql_query($sql,$con);
					$count=mysql_num_rows($res);
					$sql1="SELECT * FROM `costdb` WHERE `event_id`=$event";
					$res1=mysql_query($sql1);
					$row=mysql_fetch_array($res1);
					
					@$event_name=$row['event_name'];
					@$group=$row['group'];
					@$cost=$row['cost'];
					if(($csi_member==1)&&($event_name!="Search Engine Generation-rait")&&($event_name!="Search Engine Generation"))
						{
							$cost=$cost/2;
						}
					$balance=$cost-$paid;
					
if($balance==0)
{
	$balance_status=0;
	// echo"1.1 ";
}
else if($balance>0)
{
	if($balance==($cost-$paid))
	{$balance_status=1;
	 // echo"1.2 ";
	}
	
}
	
	if($balance>=0)
	{		
			$sql2="INSERT INTO 
				`entries`(`reciept_no`, `event_id`, `cost`, `paid`, 
				`balance`, `balance_status`, `balance_entered_by`, `client_name`, `entered_by`,
				`payed_at`, `balance_payed_at`, `mobile_no`, `c_email`, `college_name`,
				`c_year`, `event_name`, `group`) 
				VALUES ('$receipt_no','$event','$cost','$paid','$balance','$balance_status','0','$participant_name',
				'1','$date','0000-00-00','$phone_no','$email','$college','$year','$event_name','$group')";
			
			$res2=mysql_query($sql2,$con);
	
			if($res2)
				{
					// echo"3.1.2 ";
					$sql="SELECT * FROM `entries` WHERE 1";
					$res=mysql_query($sql,$con);
					$count=mysql_num_rows($res);
					echo '<div width="50px" height="50px" align="left" margin_top="50px">'.
						 '<b><font color="green">TOTAL COUNT:'.$count.'</font></b></div>';
					echo"<marquee><h3><font color='green'>DATA ENTERED SUCCESSFULLY</font></h3></marquee>";
		
				}
			else
				{	
					// echo"3.1.3 ";
					echo '<div width="50px" height="50px" align="left" margin_top="50px">'.
						 '<b><font color="red">TOTAL COUNT:'.$count.'</font></b></div>';
					echo"<h3><font color='red'>DATA NOT ENTERED.DUPLICATE ENTRY FOR RECEIPT NUMBER.</font></h3>";
				}
	}
	else
	{
		
		echo '<div width="50px" height="50px" align="left" margin_top="50px">'.
		 '<b><font color="red">TOTAL COUNT:'.$count.'</font></b></div>';
		echo"<h3><font color='red'>DATA NOT ENTERED.NEGATIVE BALANCE</font></h3>";
	}
}
else
{
	// echo"4 ";
	echo '<div width="50px" height="50px" align="left" margin_top="50px">'.
		 '<b><font color="red">TOTAL COUNT:'.$count.'</font></b></div>';
	echo"<h3><font color='red'>DATA NOT ENTERED</font></h3>";
	
}
?>






<body>
<center>

<form name="f1" action="techmate15.php" method="post">
	<table border="0" cellspacing="5" cellpadding="5">
		<tr>
			<td>RECEIPT NO:</td>
			<td>
				<input type="text" name="receipt_no" id="receipt_no">
			</td>
		</tr>
		
		<tr>
			<td>NAME</td>
			
			<td>
				<input type="text" name="name" id="name" size="45" maxlength="50">
			</td>
		</tr>

		<tr>
			<td>COLLEGE</td>
			
			<td>
				<input type="text" name="college" id="college" size="20" maxlength="20">
			</td>

			<td>
				<input type="checkbox" name="csi_member" value="1" id="csi_member" onchange="member()">CSI MEMBER
			</td>
		</tr>

		<tr>
			
			
			<td>YEAR</td>
			<td>
				<input type="text" name="year" id="year">
			</td>
		</tr>

		<tr>
			<td>PHONE NO:</td>
			
			<td>
				<input type="number" name="phone_no" id= "phone_no"size="10">
				<span name="s1" id="s1">*</span>
			</td>
		</tr>
		
		<tr>
			<td>EMAIL</td>
			
			<td>
						<input type="text" name="email" id="email" size="20">
				
			</td>
		</tr>
		
		<tr>
				<td>EVENTS :</td> 
				
				<td>
					<select name="event" id="event" onchange="member()">
						<option value="">Select</option>
						
						<?php
						include("connect.php");
						$query = "SELECT * FROM costdb ORDER BY event_id";
						$result = mysql_query($query) or die(mysql_error()."[".$query."]");
						while ($row = mysql_fetch_array($result))
						{
						echo "<option value='".$row['event_id']."'>".$row['event_name']."\t group of \t".$row['group']."</option>";
						}
						?>        
					</select>
						
					
				</td>
				
				<td> Total Cost </td>
				
				<td>
					<span name="cost" id="cost" >*</span>
				</td>
		</tr>
		
		<tr>
			<td>AMOUT PAID:</td>
			
			<td>
				<input type="text" name="paid" id ="paid" size="5" onchange="member()"/>
			</td>
		</tr>
		
		<tr>
			<td>BALANCE</td>
			
			<td>
				<span name="balance" id="balance">*</span>
			</td>
		</tr>

	</table>

	<input type='submit' value='SUBMIT'>
</form>
