<?php
class information{
    public $fn,$ln,$sum;

    function __construct(){
      $this->fn = $_POST['fname'];
      $this->ln= $_POST['lname'];
        $this->sum= $this->fn ." " . $this->ln;  
    }
}
?>


<?php
if (isset($_POST['fname']) && isset($_POST['lname'])) {
    $c1 = new information();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>task 1</title>
</head>

<body style="width: 383px; margin: auto;">
  <form action="" method="post">
    <br /><br /><label for="fname">First name:</label>
    <input type="text" name="fname" required /><br /><br />
    <label for="lname">Last name:</label>
    <input type="text" name="lname" required /><br /><br />
    <label for="flname">full name:</label>
    <input type="text" name="flname" value="<?PHP echo $c1->sum; ?>" disabled /><br /><br />
    <input type="submit" value="Submit" />
  </form>
</body>

</html>

<?php
if (isset($c1->sum)) {
  echo "<br>hello $c1->sum<br>";
}
?>