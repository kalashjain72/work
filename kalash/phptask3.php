<?php
global $sum;
global $image;
$sum = $image = null;
if (isset($_POST['fname']) && isset($_POST['lname'])) {
    $sum = $_POST['fname'] . " " . $_POST['lname'];
}


if (!empty($_FILES['image'])) {

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
    <title>task 3</title>
</head>

<body>
    <form action="" method="post" enctype="multipart/form-data">
        <label for="fname">First name:</label>
        <input type="text" name="fname" required /><br /><br />
        <label for="lname">Last name:</label>
        <input type="text" name="lname" required /><br /><br />
        <label for="flname">full name:</label>
        <input type="text" name="flname" value="<?PHP echo $sum; ?>" disabled /><br /><br />
        <label for="image"> Insert Image </label>
        <input type="file" name="image" /><br /><br />
        <textarea name="marks" rows="10" cols="30"></textarea><br><br>
        <input type="submit" value="Submit" />
    </form>
</body>

</html>

<?php
if (isset($sum)) {
    echo "hello $sum <br /><br /> ";
}

if (!empty($image['name'])) {
    print "<img src='upload-images/$file_name'  style='height: auto;  width: 254px; '/>";
    echo "<br /> file Name: $file_name <br /><br /> ";
}

if (!empty($_POST['marks'])) {
?>
    <table border="1">
        <tr>
            <th>Subject</th>
            <th>Marks</th>
        </tr>
        <?php
        $marks = explode("\n", $_POST['marks']);
        foreach ($marks as $mark) {
            $mark_array = explode("|", $mark);
            echo "<tr>";
            echo "<td>" . $mark_array[0] . "</td>";
            echo "<td>" . $mark_array[1] . "</td>";
            echo "</tr>";
        }
        ?>
    </table>
<?php
} else {
}
?>