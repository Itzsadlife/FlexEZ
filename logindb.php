<?php 
include "db.php";
session_start(); 

if (isset($_POST['uname']) && isset($_POST['password'])) {

	function validate($data){
       $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	}

	$uname = validate($_POST['uname']);
	$pass = validate($_POST['password']);

	if (empty($uname)) {
		header("Location: login.php?error=User Name is required");
	    exit();
	}else if(empty($pass)){
        header("Location: login.php?error=Password is required");
	    exit();
	}else{
		$sql = "SELECT * FROM employee WHERE employeeID='$uname' AND password='$pass'";

		$result = mysqli_query($db, $sql);

		if (mysqli_num_rows($result) === 1) {
			$row = mysqli_fetch_assoc($result);
			if($row['employeeID']=='H001' && $row['password']==$pass){
				$_SESSION['employeeID'] = $row['employeeID'];
            	$_SESSION['name'] = $row['name'];
                echo "<script>window.location.href='HRAdminDashBoard.php?id={$_SESSION['employeeID']}'</script>";
		        exit();
			}
            elseif ($row['employeeID'] === $uname && $row['password'] === $pass) {
            	$_SESSION['employeeID'] = $row['employeeID'];
            	$_SESSION['name'] = $row['name'];
				if(substr($_SESSION['employeeID'],0,1)=="S"){
					echo "<script>window.location.href='supervisorDashboard.php?id={$_SESSION['employeeID']}'</script>";

				}else
                	echo "<script>window.location.href='EmployeeHome.php?id={$_SESSION['employeeID']}'</script>";


		        exit();
            }else{
				header("Location: login.php?error=Incorect User name or password");
		        exit();
			}
		}else{
			header("Location: login.php?error=Incorect User name or password");
	        exit();
		}
	}
	
}else{
	header("Location: login.php");
	exit();
}

?>