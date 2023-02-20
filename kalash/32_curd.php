<html>

<head>
    <title>Email Syntax and Validity Check</title>
</head>

<body>
    <form action="" method="post">
        <label for="email">Email:</label>
        <input type="text" name="email" id="email">
        <input type="submit" name="submit" value="Submit">
    </form>
    <?php

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
        echo $response;
        if ($format_valid = true) {
            echo "email is vaild";
        }
    }
    ?>
</body>

</html>