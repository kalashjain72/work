<?php
class information{
    public $fn,$ln,$sum,$phone_error,$phone,$email;
    function __construct(){
      $this->fn = $_POST['fname'];
      $this->ln= $_POST['lname'];
        $this->sum= $this->fn ." " . $this->ln;
        $this->email = $_POST['email'];
    }
    function phonecheck(){
        if ( isset($_POST['phone'])){
            if(strlen($_POST['phone'])==10){
        
                $this->phone_error = false;
            }
            else{
                $this->phone_error;}
        }
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


class marks_info{
    public $marks;
    function __construct($marks){
        $this->marks = $marks;   
    }
    function extract(){
         return explode("\n", $this->marks);
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
  <title>task 5</title>
</head>

<body style="width: 383px; margin: auto;">
  <form action="" method="post" enctype="multipart/form-data">
    <br /><br /><label for="fname">First name:</label>
    <input type="text" name="fname" required /><br /><br />
    <label for="lname">Last name:</label>
    <input type="text" name="lname" required /><br /><br />
    <label for="flname">full name:</label>
    <input type="text" name="flname" value="<?PHP echo $c1->sum; ?>" disabled /><br /><br />
    <label for="phone">Phone Number:</label>
        <select>
            <option value="+91">+91</option>
        </select>
        <input type="text" name="phone"  value="<?PHP echo $c1->phone; ?>" required /><br /><br />
        
    <label for="image"> Insert Image </label>
    <input type="file" name="image" /><br /><br />
    <label for="email">Email:</label>
    <input type="text" name="email" id="email"> <br><br>
    <textarea name="marks" rows="10" cols="30"></textarea><br><br>
        
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

if (isset($_POST['phone'])) {
    $c1->phonecheck();
    if ($c1->phone_error == false) {
        $c1->phone = $_POST['phone'];
        echo "phone number: +91$c1->phone <br /><br />";
    }
    else{
        echo "phone number is not vailid<br /><br />";
    }
}
if (!empty($_POST['marks'])) {
?>
        <table border="1">
            <tr>
                <th>Subject</th>
                <th>Marks</th>
            </tr>
            <?php
            $m1 = new marks_info($_POST['marks']);

            $marks = $m1->extract();
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
if (isset($_POST['email'])) {
    echo var_dump($c1->email);

    $curl = curl_init();

    curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api.apilayer.com/email_verification/check?email=$c1->email",
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
    echo $response;
    
   echo var_dump($response);
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