<?php
$sum = $image = $k = $phone_error = null;
//this is to get first and last name and get their sum in $ sum variable
if (isset($_POST['fname']) && isset($_POST['lname'])) {
    $sum = $_POST['fname'] . " " . $_POST['lname'];
}


// this section store the information of image 
if (!empty($_FILES['image'])) {

    $image = $_FILES['image'];
    $file_name = $_FILES['image']['name'];
    $file_size = $_FILES['image']['size'];
    $file_tmp = $_FILES['image']['tmp_name'];
    $file_type = $_FILES['image']['type'];
    move_uploaded_file($file_tmp, "upload-images/" . $file_name);
}

//this is to validate the phonr number

if ( isset($_POST['phone'])){
    if(strlen($_POST['phone'])==10){

        $phone_error = false;
    }
    else{
    $phone_error = true;}
}

?>

<!DOCTYPE html>
<html lang="en">
<!-- html og the page -->

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>task 5</title>
</head>

<body style="width: 383px; margin: auto;">
    <form action="" method="post" enctype="multipart/form-data">
        <!-- input fields of html forms  -->
        <br /><br /><label for="fname">First name:</label>
        <input type="text" name="fname" required /><br /><br />
        <label for="lname">Last name:</label>
        <input type="text" name="lname" required /><br /><br />
        <label for="flname">full name:</label>
        <input type="text" name="flname" value="<?PHP echo $sum; ?>" disabled /><br /><br />
        <label for="phone">Phone Number:</label>
        <select>
            <option value="+91">+91</option>
        </select>
        <input type="text" name="phone"  value="<?PHP echo $k; ?>" required /><br /><br />

        <label for="image"> Insert Image </label>
        <input type="file" name="image" /><br /><br />
        <label for="email">Email:</label>
        <input type="text" name="email" id="email"> <br><br>

        <textarea name="marks" rows="10" cols="30"></textarea><br><br>

        <input type="submit" value="Submit" /><br /><br />
    </form>
</body>

</html>

<?php
// print the sum in and say hello
if (isset($sum)) {
    echo "hello $sum <br /><br /> ";
}

// to display the image 
if (!empty($image['name'])) {
    print "<img src='upload-images/$file_name'  style='height: auto;  width: 254px; '/>";
    echo "<br /> file Name: $file_name <br /><br /> ";
}
//to display phone number
if (isset($_POST['phone'])) {
    if ($phone_error == false) {
        $k = $_POST['phone'];
        echo "phone number: +91$k <br /><br />";
    }
    else{
        echo "phone number is not vailid<br /><br />";
    }
}


//print table of the marks and subject 
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
            echo "</tr> ";
        }
        ?>
    </table>
    <?php
    echo "<br /><br />";
    ?>
<?php
} else {
}
if (isset($_POST['email'])) {
    $email = $_POST['email'];
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.apilayer.com/email_verification/check?email=$email",
        CURLOPT_HTTPHEADER => array(
            "Content-Type: text/plain",
            "apikey: kWLWKs5aU0Mjn7dxRsLcfBXkwjvmVIED"
        ),
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET"
    ));

    $response = curl_exec($curl);

    curl_close($curl);

    $email_vaild = json_decode($response);

    if(isset($email_vaild->success)){
        echo "Email Format is not vaild";
    }
    else{
        

        if($email_vaild->smtp_check){
            echo "Email and its format is valid";
        }
        else{
            echo "Email is not vaild but format is correct";
        }
    }
}
?>