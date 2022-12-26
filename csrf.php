<?php     
    session_start();

    if (!isset($_COOKIE['csrf_token']) || !isset($_SESSION['csrf_token'])) {
        // Generate a random token and set it as a cookie and in the session
        $csrf_token = bin2hex(random_bytes(32));
        setcookie('csrf_token', $csrf_token, 0, '/');
        $_SESSION['csrf_token'] = $csrf_token;
    }
?>

<?php 
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (!isset($_POST['csrf_token']) || !isset($_COOKIE['csrf_token']) || $_POST['csrf_token'] !== $_COOKIE['csrf_token']) {
            exit('Invalid CSRF token');
        }
    }
    var_dump($_POST);
    // var_dump($_SESSION);
    // var_dump($_COOKIE);
    
?>

<form method="post">
    <input id="text" name="text" type="text">
    <label for="text">Enter something here</label>
    <br>
    <input type="hidden" name="csrf_token" id="csrf_token" value="<?php echo $_COOKIE['csrf_token']; ?>">
    <input type="submit" value="Submit">
</form>

