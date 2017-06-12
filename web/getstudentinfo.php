<?php
	 //$password=htmlspecialchars($password);
		$firstname=$_GET['firstname'];
		$lastname=$_GET['lastname'];
		$dbhost = "localhost";
		$dbuser = "root";
		$dbpass = "";
		$dbname = "fstc";
	    $conn = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname) or die("Cannot Connect to the Mysql Database. Please try again later!");
		$sql="SELECT * FROM students_info WHERE first_name='$firstname' && last_name='$lastname' ";
		$result = mysqli_query($conn, $sql)or die("Can not select from ");
		$row =  mysqli_fetch_assoc($result);
		if($row['schoolfee_status']=='Paid'){
			$color='green';
		}
		else{
			$color='red';
		}
		echo"
			<div class='col-lg-3'>
				<img id ='studentpicture'src='profilePics/{$row['picture']}'>
			</div>
			<div class='col-lg-9 studentinfo'>
				<div><span class='att'>firstname:&nbsp &nbsp &nbsp</span><span class='val'>{$row['first_name']}</span></div>
				<div><span class='att'>middlename:</span><span class='val'>{$row['middle_name']}</span></div>
				<div><span class='att'>lastname:&nbsp &nbsp &nbsp</span><span class='val'>{$row['last_name']}</</span></div>
				<div><span class='att'>department:&nbsp </span><span class='val'>{$row['department']}</span></div>
				<div><span class='att'>class:&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp </span><span class='val'>{$row['class']}</span></div>
				<div><span class='att'>school fees status:</span><span style='font-size:40px; background-color:{$color};'> {$row['schoolfee_status']}</span></div>
			</div>
		";
		mysqli_close($conn);
	
?>