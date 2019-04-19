<?php
// including the database connection file
include_once("db.php");

if(isset($_POST['update']))
{	

	
	
	$age = mysqli_real_escape_string($mysqli, $_POST['age']);
	$name = mysqli_real_escape_string($mysqli, $_POST['name']);
	$address = mysqli_real_escape_string($mysqli, $_POST['address']);
	$contact_no = mysqli_real_escape_string($mysqli, $_POST['contact_no']);
	$bg_id = mysqli_real_escape_string($mysqli, $_POST['bg_id']);
	$gender_id = mysqli_real_escape_string($mysqli, $_POST['gender_id']);

	
	// checking empty fields
	if(empty($age) || empty($name) || empty($address)|| empty($contact_no)|| empty($bg_id)|| empty($gender_id)) {	
			
		
		if(empty($age)) {
			echo "<font color='red'>Name field is empty.</font><br/>";
		}
		
		if(empty($name)) {
			echo "<font color='red'>Age field is empty.</font><br/>";
		}
		
		if(empty($address)) {
			echo "<font color='red'>Email field is empty.</font><br/>";
		}
		if(empty($contact_no)) {
			echo "<font color='red'>Name field is empty.</font><br/>";
		}
		if(empty($bg_id)) {
			echo "<font color='red'>Name field is empty.</font><br/>";
		}
		if(empty($gender_id)) {
			echo "<font color='red'>Name field is empty.</font><br/>";
		}
		
	} else {	
		//updating the table
		$result = mysqli_query($mysqli, "UPDATE users SET name='$name',age='$age', address='$address' contact_no='$contact_no' bg_id='$bg_id' gender_id='$gender_id	WHERE id=$id");
		
		//redirectig to the display page. In our case, it is index.php
		header("Location: index.php");
	}
}
?>
<?php
//getting id from url
$id = $_GET['id'];

//selecting data associated with this particular id
$result = mysqli_query($mysqli, "SELECT * FROM users WHERE id=$id");

while($res = mysqli_fetch_array($result))
{
	$name = $res['name'];
	$age = $res['age'];
	$email = $res['email'];
}
?>
<html>
<head>	
	<title>Edit Data</title>
</head>

<body>
	
	
	<form name="form1" method="post" action="update.php">
		<table border="0">
			<tr> 
				<td>Name</td>
				<td><input type="text" name="name" value="<?php echo $name;?>"></td>
			</tr>
			<tr> 
				<td>Age</td>
				<td><input type="text" name="age" value="<?php echo $age;?>"></td>
			</tr>
			<tr> 
				<td>address</td>
				<td><input type="text" name="address" value="<?php echo $address;?>"></td>
			</tr>
			<tr> 
				<td>contact_no</td>
				<td><input type="text" name="contact_no" value="<?php echo $contact_no;?>"></td>
			</tr>
			<tr> 
				<td>bg_id</td>
				<td><input type="text" name="bg_id" value="<?php echo $bg_id;?>"></td>
			</tr>
			<tr> 
				<td>gender_id</td>
				<td><input type="text" name="gender_id" value="<?php echo $gender_id;?>"></td>
			</tr>
			<tr>
				<td><input type="hidden" name="id" value=<?php echo $_GET['id'];?>></td>
				<td><input type="submit" name="update" value="Update"></td>
			</tr>
		</table>
	</form>
</body>
</html>