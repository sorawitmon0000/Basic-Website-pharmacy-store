<?php
session_start();

// initializing variables
$username = "";
$name = "";
$address = "";
$mobile = "";
$email = "";
$errors = array();

// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'blueshop');

// REGISTER USER
if (isset($_POST['reg_user'])) {
  // receive all input values from the form
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);
  $name = mysqli_real_escape_string($db, $_POST['name']);
  $address = mysqli_real_escape_string($db, $_POST['address']);
  $mobile = mysqli_real_escape_string($db, $_POST['mobile']);
  $email = mysqli_real_escape_string($db, $_POST['email']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array\
  if (empty($username)) {
    array_push($errors, "Username is required");
    $_SESSION['error'] = "Username is required";
  }
  if (empty($password_1)) {
    array_push($errors, "Password is required");
    $_SESSION['error'] = "Password is required";
  }
  if (empty($name)) {
    array_push($errors, "Username is required");
    $_SESSION['error'] = "Name is required";
  }
  if (empty($address)) {
    array_push($errors, "Username is required");
    $_SESSION['error'] = "Address is required";
  }
  if (empty($email)) {
    array_push($errors, "Username is required");
    $_SESSION['error'] = "Email is required";
  }
  if ($password_1 != $password_2) {
    array_push($errors, "The two passwords do not match");
    $_SESSION['error'] = "The two passwords do not match";
  }

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM member WHERE username='$username' OR email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);

  if ($user) { // if user exists
    if ($user['username'] == $username) {
      array_push($errors, "Username already exists");
      $_SESSION['error'] = "Username already exists";
    }

    if ($user['email'] == $email) {
      array_push($errors, "Email already exists");
      $_SESSION['error'] = "Email already exists";
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
    $password = $password_1;

    $query = "INSERT INTO member (username, password, name, address, mobile, email) 
  			  VALUES('$username', '$password', '$name', '$address', '$mobile', '$email')";
    mysqli_query($db, $query);
    header('location: login.php');
  }else{
    header("location: register.php");
  }
}

if (isset($_POST['login_user'])) {
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $password = mysqli_real_escape_string($db, $_POST['password']);

  if (count($errors) == 0) {
    $query = "SELECT * FROM member WHERE username='$username' AND password='$password'";
    $results = mysqli_query($db, $query);
    if (mysqli_num_rows($results) == 1) {
      $_SESSION['username'] = $username;
      setcookie(session_name(),'',time() + 3600,);
      header("location: index.php");
    } else {
      array_push($errors, "Wrong Username or Password");
      $_SESSION['error'] = "Wrong Username or Password!";
      header("location: login.php");
    }
  } else {
    array_push($errors, "Username & Password is required");
    $_SESSION['error'] = "Username & Password is required";
    header("location: login.php");
  }
}
