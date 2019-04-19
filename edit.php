<?php
// including the database connection file
include_once("db.php");


function selected($first, $second)
{
    if (strcmp($first, $second) == 0)
        echo 'selected="selected"';
}
function checked($first, $second)
{
    if (strcmp($first, $second) == 0)
        echo 'checked="checked"';
}

if(isset($_POST['update']))
{	

	$id = mysqli_real_escape_string($mysqli, $_POST['id']);
	$name = mysqli_real_escape_string($mysqli, $_POST['name']);
	$age = mysqli_real_escape_string($mysqli, $_POST['age']);
	$gender_id = mysqli_real_escape_string($mysqli, $_POST['gender_id']);	
	$contact_no = mysqli_real_escape_string($mysqli, $_POST['contact_no']);	
	$bg_id = mysqli_real_escape_string($mysqli, $_POST['bg_id']);	
	$address = mysqli_real_escape_string($mysqli, $_POST['address']);	
	
	// checking empty fields
	if(empty($name) || empty($age)) {	
			
		if(empty($name)) {
			echo "<font color='red'>Name field is empty.</font><br/>";
		}
		
		if(empty($age)) {
			echo "<font color='red'>Age field is empty.</font><br/>";
		}
			
	} else {	
		//updating the table
		echo $result = mysqli_query($mysqli, "UPDATE info SET name='$name',age='$age',address='$address', gender_id='$gender_id', bg_id='$bg_id', contact_no='$contact_no' WHERE id=$id");
		
		//redirectig to the display page. In our case, it is index.php
		header("Location: index.php");
	}
}
?>
<?php
//getting id from url
@$id = $_GET['id'];

//selecting data associated with this particular id
$result = mysqli_query($mysqli, "SELECT * FROM info WHERE id=$id");

while($res = mysqli_fetch_array($result))
{
	$name = $res['name'];
	$age = $res['age'];
	$gender_id = $res['gender_id'];
	$contact_no = $res['contact_no'];
	$bg_id = $res['bg_id'];
	$address = $res['address'];
}
?>

<?php

@$sql = "SELECT id, blood_group FROM blood_groups";
@$sql_gender = "SELECT id, gender FROM genders";

@$result_gender = @$mysqli->query(@$sql_gender);
@$result = @$mysqli->query(@$sql);

?> 
<html>
<head>	
	<title>Edit Data</title>
	<style>
	body{
		background:skyblue;
	}
	input[type=submit] {
    width: 45%;
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

	</style>
</head>

<body>
	<a href="index.php">Home</a>
	<br/><br/>
	
  
  Blood Group:<br>
  <br><br>
	
	<form name="form1" method="post" action="edit.php">
		<table border="0">
			<tr> 
				<td>Name</td>
				<td><input type="text" name="name" value="<?php echo $name;?>"></td>
			</tr>
			<tr> 
				<td>Age</td>
				<td><input type="number" name="age" value="<?php echo $age;?>"></td>
			</tr>
			<tr> 
				<td>Adress</td>
				<td><input type="text" name="address" value="<?php echo $address;?>"></td>
			</tr>
			<tr> 
				<td>Contact no</td>
				<td><input type="text" name="contact_no" value="<?php echo $contact_no;?>"></td>
			</tr>
			<tr> 
				<td>Gender</td>
				<td><?php 
					  while(@$row_gender = @$result_gender->fetch_assoc()) {
							echo '<input name= "gender_id" type="radio"';
							echo checked(@$row_gender["id"],@$gender_id);
							echo ' value="'.@$row_gender['id'].'" /> ' .@$row_gender['gender'];
						}
						@$mysqli->close();
						?>
	</td>
			</tr><tr> 
				<td>Blood Group</td>
				<td>
				<select name="bg_id">
				<?php 
				  while(@$row = $result->fetch_assoc()) {
						echo '<option value="'. @$row["id"].'"';
						echo  selected(@$row["id"],@$bg_id);
						echo '>'.@$row['blood_group']. '</option>';
					}
					@$mysqli->close();
					?>
				</select>
				</td>
			</tr>
			<tr>
				<td><input type="hidden" name="id" value=<?php echo $_GET['id'];?>></td>
				<td><input type="submit" name="update" value="Update"></td>
			</tr>
		</table>
	</form>
</body>
</html>
