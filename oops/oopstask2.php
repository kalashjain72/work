<?php
class information{
    public $fn,$ln,$sum;

    function __construct(){
      $this->fn = $_POST['fname'];
      $this->ln= $_POST['lname'];
        $this->sum= $this->fn ." " . $this->ln;
    }
}

class image_info{
    public $file_name, $file_tmp, $image;
    function __construct(){
        $this->image = $_FILES['image'];
        $this->file_name = $_FILES['image']['name'];
        $this->file_tmp = $_FILES['image']['tmp_name'];
    
        move_uploaded_file($this->file_tmp, "upload-images/" . $this->file_name);
        
    }
}

?>


<?php
if (isset($_POST['fname']) && isset($_POST['lname'])) {
    $c1 = new information();
  
}

if(isset($_FILES['image'])){  
$i1 = new image_info();
}

    

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>task 2</title>
</head>

<body style="width: 383px; margin: auto;">
  <form action="" method="post" enctype="multipart/form-data">
    <br /><br /><label for="fname">First name:</label>
    <input type="text" name="fname" required /><br /><br />
    <label for="lname">Last name:</label>
    <input type="text" name="lname" required /><br /><br />
    <label for="flname">full name:</label>
    <input type="text" name="flname" value="<?PHP echo $c1->sum; ?>" disabled /><br /><br />
    <label for="image"> Insert Image </label>
        <input type="file" name="image" /><br /><br />
    <input type="submit" value="Submit" />
  </form>
</body>

</html>

<?php
if (isset($c1->sum)) {
  echo "<br>hello $c1->sum<br>";
}
 if (isset($_FILES['image'])) {
    print "<img src='upload-images/$i1->file_name '  style='height: auto;  width: 254px; '/>";
    echo "<br /> file Name: $i1->file_name <br /><br /> ";
}
?>