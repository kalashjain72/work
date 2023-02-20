<?php
global $sum;
$sum = $image = null;
if (isset($_POST['fname']) && isset($_POST['lname'])) {
    $sum = $_POST['fname'] . " " . $_POST['lname'];
}
if (isset($_FILES['image'])) {

    $image = $_FILES['image'];
    $file_name = $_FILES['image']['name'];
    $file_size = $_FILES['image']['size'];
    $file_tmp = $_FILES['image']['tmp_name'];
    $file_type = $_FILES['image']['type'];
    move_uploaded_file($file_tmp, "upload-images/" . $file_name);
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
        <input type="text" name="flname" value="<?PHP echo $sum; ?>" disabled /><br /><br />
        <label for="image"> Insert Image </label>
        <input type="file" name="image" /><br /><br />
        <input type="submit" value="Submit" />
    </form>
</body>

</html>

<?php
if (isset($sum)) {
    echo "<br>hello $sum <br /><br /> ";
}
if (isset($_FILES['image'])) {
    print "<img src='/kalash/upload-images/$file_name '  style='height: auto;  width: 254px; '/>";
    echo "<br /> file Name: $file_name <br /><br /> ";
}
?>