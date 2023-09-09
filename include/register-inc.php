<?php
	if (isset($_POST['submit'])) {
		require 'database.php';
		session_start();
		// Make the first letter of each word capital using ucwords
		$firstName = ucwords($_POST['firstName']);
		$lastName = ucwords($_POST['lastName']);
		$email = $_POST['email'];
		$password = $_POST['password'];
		$birthday = date("Y-m-d", strtotime($_POST['birthday']));
		$sex = $_POST['sex'];
		$address = ucwords($_POST['address']);
		$mobileNumber = $_POST['mobileNumber'];
		$hasEmptyField = empty($firstName) || empty($lastName) || empty($email) || empty($password) || empty($birthday) || empty($sex) || empty($address) || empty($mobileNumber);
		$thereIsAnError = false;

		function pregMatch($input) {
			$safePost = filter_input(INPUT_POST, $input , FILTER_SANITIZE_SPECIAL_CHARS);
			if (preg_match('/[^A-Za-z]/', $safePost)) 
				return false; 
			else
				return true;
		}

		$dataSql = "SELECT emailAddress, password, mobileNumber FROM tbl_customer";
		$dataStmt = $conn->prepare($dataSql);
		$dataStmt->execute();
		$dataResult = $dataStmt->get_result();

		// To prevent duplicated value in password, mobile number and email
		if (!empty($dataResult)) {
			while ($row = $dataResult->fetch_assoc()) {
				if ($email == $row['emailAddress']) {
					$_SESSION['message'][] = "Error = Email Already Taken";
					$_SESSION['messageType'] = "danger";
					$thereIsAnError = true;
				} if (md5($password) == $row['password']) {
					$_SESSION['message'][] = "Error = Password Already Taken";
					$_SESSION['messageType'] = "danger";
					$thereIsAnError = true;
				} if ($mobileNumber == $row['mobileNumber']) {
					$_SESSION['message'][] = "Error = Mobile Number Already Taken";
					$_SESSION['messageType'] = "danger";
					$thereIsAnError = true;					
				}
			}
		}

		if ($hasEmptyField) {
			$_SESSION['message'][] = "Error = Empty Fields";
			$_SESSION['messageType'] = "danger";
			$thereIsAnError = true;
		}
		// Validate if username does have invalid characters
		if (pregMatch($firstName) === false || pregMatch($lastName) === false) {
			$_SESSION['message'][] = "Error = Invalid Name Input";
			$_SESSION['messageType'] = "danger";
			$thereIsAnError = true;
		} 
		if ($thereIsAnError) {
			header("Location: ../register.php");
			exit();
		}
		$hashPass = md5($password);

		$sql = "INSERT INTO tbl_customer (firstName, lastName, emailAddress, password, birthday, sex, address, mobileNumber) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
		$stmt = $conn->prepare($sql);
		$stmt->bind_param("ssssssss", $firstName, $lastName, $email, $hashPass, $birthday, $sex, $address, $mobileNumber);

		if ($stmt->execute()) {
			$_SESSION['message'][] = "Success = Account Registered";
			$_SESSION['messageType'] = "success";
			header("Location: ../register.php");
		} else {
			$_SESSION['message'][] = "Error = SQL Error";
			$_SESSION['messageType'] = "danger";
			header("Location: ../register.php");
		}
		$stmt->close();
		$conn->close();
	}
	