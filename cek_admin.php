<?php  session_start(); include 'sambungkan.php'; 


if (isset($_POST['submit'])) {
    $username = htmlspecialchars($_POST['username'], ENT_QUOTES);   
    $password = (htmlspecialchars($_POST['password'], ENT_QUOTES)); 
	$sqlAdministrator = "SELECT * FROM user WHERE username='$username' AND password ='$password'";
	// $sqlAdministrator = "SELECT * FROM 2230511037_t_user WHERE username='$username' AND password ='$password'";   
 echo 	$sqlAdministrator;
		$result = mysqli_query($conn, $sqlAdministrator);
		if (mysqli_num_rows($result) > 0) { 
			$row = mysqli_fetch_assoc($result); 
			$_SESSION['isLogin'] = true;
			$_SESSION['id'] = $row['id'];   							
			$_SESSION['username'] = $row['username'];
			$_SESSION['password'] = $row['password']; 				
			$_SESSION['role'] = $row['role'];						
			
			header("Location: hewan.php");
		 	//  header("Location: hewan.php?page=dashboard");
		} else {
				$_SESSION['eror'] ="Username atau password anda salah. Silahkan coba lagi";
				header("Location: login1.html");
				} 
}else{
    header("Location: login1.html"); 
	} 
?>