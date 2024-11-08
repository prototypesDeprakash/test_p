Php all man

<h1>Welcome to the home page</h1>


<h2>Login as student </h2> 
<form action="student.php">
<label>Enter as student</label>
<input type ="submit">
</form>
<h2>Login as admin</h2>
<form action="check.php" method="post">
<input type="password" id="passwords" name="passwords"></input>
<input type ="submit">
</form>
--------------------------------------------------------------------------------------
<?php

if (isset($_POST['passwords'])){
$password = htmlspecialchars($_POST['passwords']);
if($password==="123"){
	header("Location: admin.php");
	exit();
	echo "hello";
	
}
else{
	echo "fuck you";
}

}
?>
-----------------------------------------------------------------------------------------
<?php

$hostname = 'localhost';
$username='root';
$password='';
$databse = 'test';

$conn = new mysqli($hostname,$username,$password,$databse);
if(!$conn->connect_error){
	echo "successful";
}
else{
	echo "fuck not connected";
}




//insert function 
function insert($conn){
	$statement1= $conn->prepare("Insert into mytable values(?,?)");
	$name = htmlspecialchars($_POST['name']);
	$age = htmlspecialchars($_POST['age']);
	$statement1->bind_param("ss",$name,$age);
	$statement1->execute();
	
	echo "\ndata inserted\n";
	
	
}



//delete function 
function delete($conn){
	$statement2= $conn->prepare("delete from mytable where name =?");
	$name2 = htmlspecialchars($_POST['name2']);
	$statement2->bind_param("s",$name2);
	$statement2->execute();
	
	echo "\n data Deleted \n";
	
}
function update($conn){
	echo"into update";
	$statement3 = $conn->prepare("update mytable set age=? where name =?");
	$ageu =htmlspecialchars($_POST['age3']);
	$nameu= htmlspecialchars($_POST['name3']);
	$statement3->bind_param("ss",$ageu,$nameu);
	 if ($statement3->execute()) {
        echo "Record updated successfully.";
    } else {
        echo "Error updating record: " . $statement3->error;
    }
	
}

//calling respective functions functions

if($_SERVER['REQUEST_METHOD']=='POST'){
	if(isset($_POST['insert'])){
		
		insert($conn);
	}
}
if($_SERVER['REQUEST_METHOD']=='POST'){
	if(isset($_POST['delete'])){
		delete($conn);
	}
	
}
if($_SERVER['REQUEST_METHOD']=='POST'){
	if(isset($_POST['Update'])){
		update($conn);
	}
}


?>

<h1>Insert Items</h1>
<form method="post">
<input type="text" name ="name" id="name" placeholder="enter name ">
<input type="text" name ="age" id="age" placeholder="enter age ">
<input type="submit" name="insert" value="insert">
</form>

<h1>Delete Items</h1>
<form method="post">
<input type="text" name ="name2" id="name2" placeholder="enter name ">
<input type="submit" name="delete" value="delete">
</form>


<h1>Update Items</h1>
<form method="post">
<input type="text" name ="name3" id="name3" placeholder="enter name to update">
<input type="text" name ="age3" id="age3" placeholder="enter age to update">
<input type="submit" name="Update" value="update">
</form>
------------------------------------------------------------------------------------------------------------------------------------------------------
