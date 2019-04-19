
<?php
include_once("db.php");
//header("Location: index.php");
//include_once("index.php");

@$search = $_REQUEST['bg_id_frpdwn'];
@$sql = "SELECT id, blood_group FROM blood_groups";

@$result = @$mysqli->query(@$sql);
@$var="SELECT info.id,age,name,address,contact_no,blood_group,gender FROM info JOIN blood_groups ON info.bg_id=blood_groups.id JOIN genders ON info.gender_id=genders.id WHERE info.bg_id = $search ORDER BY info.id ";
@$result1=@$mysqli->query(@$var);
@$view = "SELECT info.id,age,name,address,contact_no,blood_group,gender FROM info JOIN blood_groups ON info.bg_id=blood_groups.id JOIN genders ON info.gender_id=genders.id ORDER BY info.id";
@$result_view=@$mysqli->query(@$view);
?>
<html>
<style>
body{
background:#39ba62;
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
</style>
<head>	
	<title>Search Data</title>
</head>
<body>
<a href="index.php">Home</a>
<form action="" method="post">
  Blood Group:<br>
  <br><br>
	
<select name="bg_id_frpdwn">
<?php 
  while(@$row = $result->fetch_assoc()) {
        echo '<option value="'. @$row["id"] .'">'.@$row['blood_group'].'</option>';
    }
	@$mysqli->close();
	?>
	</select>
	<input type="submit" value="search">
	</form>
	</body>
</html>

<?php
if(mysqli_num_rows($result1)>0)
{
	?>
	<table width='80%' border=0>

	<tr bgcolor='#CCCCCC'>
		<th>ID</th>
		<th>Name</th>
		<th>Age</th>
		<th>Blood group</th>
		<th>Gender</th>
		<th>Address</th>
		<th>contact_no</th>
	</tr>
	
	<?php 
	//while($res = mysql_fetch_array($result)) { // mysql_fetch_array is deprecated, we need to use mysqli_fetch_array 
	while($res = mysqli_fetch_array($result1)) { 		
		echo "<tr>";
		echo "<td>".$res['id']."</td>";
		echo "<td>".$res['name']."</td>";
		echo "<td>".$res['age']."</td>";
		echo "<td>".$res['blood_group']."</td>";
        echo "<td>".$res['gender']."</td>";
        echo "<td>".$res['address']."</td>";
        echo "<td>".$res['contact_no']."</td>";
       	
		echo "</tr>";
	}}
else
	echo "no records found";
?>