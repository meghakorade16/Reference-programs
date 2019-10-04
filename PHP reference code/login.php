
<html>
<head>
 <style>
 div {
    text-align:center;
    border: 2px solid black;
    padding: 10px 40px;
    background-color: linen;
    width: 500px;
    border-radius: 25px;
	margin-top:100px;

}
 body{text-align:center;}
 div1{ color:red;}
</style>
</head>
<body>


<center><div>
<form method = 'get' name='form1' id='form'>
<table cellspacing="3" cellpadding="2" border="0">
        <tr>
          <td align="left">
            <font size=4px><b>USERNAME:<b></font>
          </td>
		     <td>
            <input type="text" name="username" id="username" onblur="val1()"/> <span id = "uname1" name = "uname1">*<span>
          </td>
        </tr>
		<tr>
          <td align="left">
            <font size=4px><b>PASSWORD:<b></font>
          </td>
          <td>
            <input type="password" name="password" id="password" onblur="val3()"/> <span id = "pwd1" name = "pwd1">*<span>
          </td>
        </tr>
    </table>
<input type = 'button' value='VALIDATE' onclick='funct1()'/>
</form>
</div></center>
</body>
<script>
function val1()
{
	var x=document.getElementById("username").value;	
	if(x==null||x==""||(x.length<5))
	{
		var str = "Enter valid username";
		document.getElementById("uname1").innerHTML = str;
		return false;
	}
	else
	{
		var regex = /^[A-Za-z_.]+$/;
		if(!x.match(regex))
			{
				var str1 = "Enter only chars";
				document.getElementById("uname1").innerHTML = str1;
				return false;
			}
			else
			{
			document.getElementById("uname1").innerHTML = "";
			return true;
			}
	}
}
function val3()
{
z=0;
var x=document.getElementById("password").value;

	if(x==null||x=="")
	{
		var str = "Enter password";
		document.getElementById("pwd1").innerHTML = str;
		return false;
	}
	else
	{
	if(x.length<4)
	{
	 document.getElementById("pwd1").innerHTML = "Atleast 4 chars";
	 return false;
	}
	else
	{
	document.getElementById("pwd1").innerHTML = "";
	return true;
	}
	}
}
function funct1()
{
//alert("hello");
var un = document.getElementById("username").value;
var pwd = document.getElementById("password").value;
var event = document.getElementById("s1").value;

if((un=="CSIDBAteam") &&(pwd=="DbTeChMate15"))
{
window.location = "techmate15.php";	
}
else
{
	window.location = "login.php";
}
return false;
}
</script>
</html>
		 
