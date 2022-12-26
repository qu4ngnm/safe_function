<form action="" method="post">
    <input id="userinput" name="input" type="text">
    <label for="userinput">Enter Something</label>
</form>
<?php
    $input = htmlspecialchars($_POST['input']);
    echo $input;
?>