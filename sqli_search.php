<?php 
    $mysqli = new mysqli("localhost","root","","test");

    function get_db(){
        global $mysqli;
        $prepare = $mysqli->prepare("SELECT * FROM data_table ORDER BY id DESC");
        $prepare->execute();
        $result = $prepare->get_result()->fetch_all(MYSQLI_ASSOC);
        return $result;
    }
    $movies = get_db();

    function search($name){
        global $mysqli;
        $prepare = $mysqli->prepare("SELECT * FROM data_table WHERE film_name LIKE ? ORDER BY id DESC");
        $name = "%$name%";
        $prepare->bind_param("s", $name);
        $prepare->execute();
        $result = $prepare->get_result()->fetch_assoc();
        return $result;
    }
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $result = search($mysqli->real_escape_string($_POST['search']));
        if ($result){
            echo $result['film_name'];
        }
        else{
            echo 'Error!';
        }
    }
?>

<form action="" method="POST">
    <input type="text" id="search" name="search">
    <input type="submit" value="Search">
</form>

<table>
  <tr>
    <th>ID</th>
    <th>Movie</th>
    <th>Duration</th>
    <th>Main Actor</th>
  </tr>
  <?php 
    $i = 0;
    foreach($movies as $movie){
        $i++;
  ?>
  <tr>
    <td><?php echo $i ?></td>
    <td><?php echo $movie['film_name'] ?></td>
    <td><?php echo $movie['duration'] ?></td>
    <td><?php echo $movie['actor'] ?></td>
  </tr>
  <?php } ?>
</table>

