<?php
include_once('db.php');
if(@$_REQUEST['insert']){
$name= @$_REQUEST['name'];
$age= @$_REQUEST['age'];
$address= @$_REQUEST['address'];
$contact_no= @$_REQUEST['contact_no'];
$gender= @$_REQUEST['gender'];
$grplist= @$_REQUEST['grplist'];
$bg_id= @$_REQUEST['bg_id'];
$gender_id= @$_REQUEST['gender_id'];
$gender= @$_REQUEST['gender'];
$blood_group= @$_REQUEST['blood_group'];
$str="insert into info(age,name,address,contact_no,bg_id,gender_id)values('$age','$name','$address', '$contact_no','$bg_id','$gender_id');";
header("Location: index.php");
}
@$result_str = @$mysqli->query(@$str);
@$view = "SELECT info.id,age,name,address,contact_no,blood_group,gender FROM info JOIN blood_groups ON info.bg_id=blood_groups.id JOIN genders ON info.gender_id=genders.id ORDER BY info.id";
@$result_view=@$mysqli->query(@$view);

?>
<?php
// Initialize the session
session_start();
 
// If session variable is not set it will redirect to login page
if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
  header("location: login.php");
  exit;
}
?>
<?php

@$sql = "SELECT id, blood_group FROM blood_groups";
@$sql_gender = "SELECT id, gender FROM genders";

@$result_gender = @$mysqli->query(@$sql_gender);
@$result = @$mysqli->query(@$sql);

?> 
<!DOCTYPE html>
<html>
<head>
<h1>Blood Donor Information</h1>
<style>
body{
background:skyblue;
}
h1{
text-align:center;
color:#8042f4;
}
table{
margin: auto;
text-align: center;
table-layout:fixed;
}
table,tr,th,td{
padding:2px;
color:white;
border: 1px;
border-collapse=collapse;
front-size:18px;
front-family: Arial;
background:linear-gradient(top,#3c3c3c 0%,#222222 100%);
background:-webkit-linear-gradient(top,#3c3c3c 0%,#222222 100%);
}
td:hover{
background:purple;
}
input[type=submit] {
    width: 15%;
    background-color: #4CAF50;
    color: white;
    padding: 10px 20px;
    margin: 6px 0;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}
input[type=text] {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    box-sizing: border-box;
	border: 2px solid red;
    border-radius: 4px;
}
input[type=number] {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    box-sizing: border-box;
	border: 2px solid red;
    border-radius: 4px;
}
a
{
	color:red;
}



</style>
</head>
<body>

	<table class= "table table-striped" width='90%' border=0>

	<tr bgcolor='#CCCCCC'>
		<th>ID</th>
		<th>Name</th>
		<th>Age</th>
		<th>Blood group</th>
		<th>Gender</th>
		<th>Address</th>
		<th>contact_no</th>
		<th>Update</th>
		<th>Delete</th>
	</tr>
	<?php 
	//while($res = mysql_fetch_array($result)) { // mysql_fetch_array is deprecated, we need to use mysqli_fetch_array 
	$serial=0;
	while($res = mysqli_fetch_array($result_view)) 
	
	{ 
	
		echo "<tr>";
		echo '<td>'.++$serial.'</td>';
		echo "<td>".$res['name']."</td>";
		echo "<td>".$res['age']."</td>";
		echo "<td>".$res['blood_group']."</td>";
        echo "<td>".$res['gender']."</td>";
        echo "<td>".$res['address']."</td>";
        echo "<td>".$res['contact_no']."</td>";
        echo "<td><a href=\"edit.php?id=$res[id]\" >Edit</a>";
        echo "<td><a href=\"delete.php?id=$res[id]\" onClick=\"return confirm('Are you sure you want to delete?')\">Delete</a></td>";		
		echo "</tr>";
	}
	?>
	</table>
	<br>
	<a href="search.php?id=<?php echo $row[id];?>">Search By Blood Group</a>
<form action="" method="post">

  Name: 
  <input type="text" pattern="[a-zA-Z ]+" name="name" placeholder = "name here" required><br><br>
  Age: 
  <input type="number" name="age" placeholder = "age here"><br><br>
  Adress:
  <input type="text" name="address" placeholder="address"><br><br>
  Contact no: 
  <input type="text" pattern ="[+0-9]+" name="contact_no" placeholder="contact"><br><br>
  
  Gender:
  
  
<?php 
  while(@$row_gender = @$result_gender->fetch_assoc()) {
        echo '<input name= "gender_id" type="radio" value="'.@$row_gender['id'].'" /> ' .@$row_gender['gender'];
    }
	@$mysqli->close();
	?>
 <br><br> 
  
  Blood Group:
  <select name="bg_id" required>
  <option value="">Select One</option>
<?php 
  while(@$row = $result->fetch_assoc()) {
        echo '<option value="'. @$row["id"] .'">'.@$row['blood_group'].'</option>';
    }
	@$mysqli->close();
	?>
  
</select>

<br>
<br>
<input name = "insert" type="submit" value="insert">
</form> 

</body>
</html>
