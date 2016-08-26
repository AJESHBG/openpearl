
<?php
/*
mysql_connect("localhost","root","");
$conn=mysql_select_db("db1"); */

$conn = mysqli_connect("localhost","root","","db1");
if($conn)
{
echo "connected";
}
else
{echo " not connected";
}
?>
<script>

function refres()
{

  window.parent.location.href='employee.php';
}
function Display()
{
//alert("ajeesh");
 window.parent.location.href='employee.php?display=1';
}
</script>
<?php
if(isset($_POST['submit']))
{
$name=$_POST['name'];
$age=$_POST['age'];
$desg=$_POST['desg'];
$regdate=$_POST['regdate'];

 echo $date = date('Y-m-d',strtotime($regdate));
$temp_image=$_FILES['image']['tmp_name'];
$image=mysqli_escape_string($conn,file_get_contents($temp_image));
$query=mysqli_query($conn,"insert into employee(name,age,designation,image,regdate)values('$name','$age','$desg','$image','$date' )");
if($query>0)
{
echo"saved sucessfully";
}
}


?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>

<form action="" id="employee"method="post" enctype="multipart/form-data" name="employee">
<fieldset style="width:20"><legend>employee</legend>

<table align="center" width="200" border="0">
  <tr>
    <td>NAME</td>
    <td><input name="name" id="name" type="text" size="15" required /></td>
  </tr>
  <tr>
    <td>AGE</td>
    <td><input name="age" id="age" type="text" size="15" required/></td>
  </tr>
  <tr>
    <td>DESIGNATION</td>
  <td><input name="desg" id="desg" type="text" size="15" required /></td>
  </tr>
    <tr>
    <td>REG.DATE</td>
     <td><input name="regdate" id="regdate" type="date" size="15"  required /></td>
  </tr>
    <tr>
    <td>IMAGE</td>
    <td><input name="image" type="file" size="15" required/></td>
  </tr>
  <tr>
  </tr>
  
  <tr>
 <td>
 <input name="submit"id="submit"  type="submit" value="save"/>
 </td>
  <td>
  <input name="refresh"id="refresh"  type="submit" value="refresh" style="align="center"" onClick="refres();" />
  </td>
   <td>
  <input name="display"id="display"  type="button" value="display" style="align="center"" onClick="Display();" />
  </td>
  </tr>
  
</table>
</fieldset>


</form>
<?php
if(isset($_GET['display']))
{
echo "haiiii";
$query=mysqli_query($conn,"select * from employee");
?>
<table>

<tr>
<td><?php echo "NAME"; ?> </td>
<td><?php echo "AGE"; ?> </td>
<td><?php echo "PHOTO"; ?> </td>

<tr>
<?php
while($row=mysqli_fetch_array($query))
{
//$dateold=$row['regdate'];
//$date=date('d-m-Y',strtotime($dateold));
?>
<tr>
<td><?php echo $row['name']; ?> </td>
<td><?php echo $row['age']; ?> </td>
<td><img width="100" height="100" src="data:image/jpeg;base64,<?php echo base64_encode($row['image']);?>" /></td>

<tr>
<?php
}
?>
</table>
<?php
}
?>

</body>
</html>
