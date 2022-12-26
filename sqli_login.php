<?php
$mysqli = new mysqli('localhost', 'root', '', 'test');

function login($username, $password) {
  global $mysqli;

  $prepares = $mysqli->prepare('SELECT * FROM test WHERE username = ? AND password = ?');
  $prepares->bind_param('ss', $username, $password);
  $prepares->execute();
  $result = $prepares->get_result();
  
  if ($result->num_rows > 0) {
    return true;
  } else {
    return false;
  }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  global $mysqli;
  $username = $mysqli->real_escape_string($_POST['username']);
  $password = $mysqli->real_escape_string($_POST['password']);

  if (login($username, $password)) {
    echo "Welcome, $username!";
  } else {
    echo "Invalid username or password.";
  }
}
?>

<form action="" method="POST">
    <label for="username">Username:</label>
    <input type="text" name="username" id="username">
    <br>
    <label for="password">Password:</label>
    <input type="password" name="password" id="password">
    <br>
    <input type="submit" value="Log in">
</form>