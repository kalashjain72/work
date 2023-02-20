<?php
$insret = false;
$servername = "localhost";
$username = "root";
$password = "";
$database = "inotes";


// Create a connection
$conn = mysqli_connect($servername, $username, $password, $database);
// Die if connection was not successful
if (!$conn) {
  die("Sorry we failed to connect: " . mysqli_connect_error());
}

if (($_SERVER["REQUEST_METHOD"] == "POST")) {

  $title = $_POST['Note_title'];
  $desc = $_POST['desc'];

  $sql = "INSERT INTO `curd` (`title`, `description`) VALUES ('$title', '$desc')";
  $result = mysqli_query($conn, $sql);


  if ($result) {

    $insret = true;
  }
}

?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>curd Application</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
</head>

<body>

  <!-- Edit Modal -->
  <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLabel">Edit this Note</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form action="/crud/index.php" method="POST">
          <div class="modal-body">
            <input type="hidden" name="snoEdit" id="snoEdit">
            <div class="form-group">
              <label for="title">Note Title</label>
              <input type="text" class="form-control" id="titleEdit" name="titleEdit" aria-describedby="emailHelp">
            </div>

            <div class="form-group">
              <label for="desc">Note Description</label>
              <textarea class="form-control" id="descriptionEdit" name="descriptionEdit" rows="3"></textarea>
            </div>
          </div>
          <div class="modal-footer d-block mr-auto">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#"><img src="/crud/logo.svg" height="28px" alt=""></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Contact Us</a>
        </li>

      </ul>
      <form class="form-inline my-2 my-lg-0">
        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
      </form>
    </div>
  </nav>

  <?php

  if ($insret) {
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Success!</strong> Your note has been inserted successfully
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>×</span>
    </button>
  </div>";
    // } else {
    //   echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
    //   <strong>failed!</strong> Your note has not been inserted successfully
    //   <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    //     <span aria-hidden='true'>×</span>
    //   </button>
    // </div>" . mysqli_error($conn) . " ";
  }

  ?>


  <div class="container my-3">
    <h2> Add a Note </h2>
    <form action="curd.php" method="post">
      <div class="mb-3">
        <label for="Note_title" class="form-label">Note Title</label>
        <input type="text" class="form-control" id="Note_title" name="Note_title">
      </div>
      <div class="form-group">
        <label for="desc">Note Discription</label>
        <textarea class="form-control" id="desc" name="desc" rows="3"></textarea>
      </div>
      <button type="submit" class="btn btn-primary my-2">Add Note</button>
    </form>
  </div>


  <?php

  ?>

  <div class="container">

    <table class="table my-4" id="myTable">
      <thead>
        <tr>
          <th scope="col">S.No</th>
          <th scope="col">Title</th>
          <th scope="col">Description</th>
          <th scope="col">Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php

        //$sql = "INSERT INTO `curd` (`s.no`, `title`, `description`, `timestamp`) VALUES (\'1\', \'first note\', \'this is first note \', current_timestamp());";
        $sql = "SELECT * FROM `curd` ";
        $result = mysqli_query($conn, $sql);
        $num = mysqli_num_rows($result);
        echo $num . " records found in the DataBase<br>";

        if ($num > 0) {
          $sno = 0;

          while (($row = mysqli_fetch_assoc($result)) != null) {
            $sno++;
            echo " <tr>
                 <th scope='row'>  " . $sno . "  </th>
                <td>" . $row['title'] . "</td>
                <td>" . $row['description'] . "</td>
                 <td> 
                 </td>  
                </tr>";
          }
        }
        ?>

      </tbody>
    </table>
    <hr>

  </div>





  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  <script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
  <script>
    $(document).ready(function() {
      $('#myTable').DataTable();

    });
  </script>
</body>

</html>