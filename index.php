<?php
// INSERT INTO `notes` (`sno`, `title`, `description`) VALUES (NULL, '1', '1');
// connecting database

// INSERT INTO `notes` (`sno`, `title`, `description`) VALUES (NULL, '2', '2');


$insert = false;
$delete = false;
$update = false;
// connecting database
$server = "localhost";
$username = "root";
$password = "";
$database = "notes";

// create connection
$conn = mysqli_connect($server, $username, $password, $database);

// die if not connected

if (!$conn) {

  die("sorry! failed to connect" . mysqli_connect_error());
}

// delete notes  condition start
if (isset($_GET['delete'])) {
  $sno = $_GET['delete'];
  $delete = true;
  $sql = "DELETE FROM `notes` WHERE `sno` = $sno";
  $result = mysqli_query($conn, $sql);
}
// delete notes  condition end
if ($_SERVER['REQUEST_METHOD'] == 'POST') {


  // to see if the update is working?

// edit notes  condition
  if (isset($_POST['snoEdit'])) {
    // echo "yyy";
    // update the note
    $sno = $_POST['snoEdit'];
    $title = $_POST['titleEdit'];
    $description = $_POST['descriptionEdit'];

    $sql = "UPDATE `notes` SET `title` = '$title' , `description` = '$description' WHERE `notes`.`sno` = $sno";

    $result = mysqli_query($conn, $sql);
   

    if($result){
      $update = true;
    
    }else{
      echo"not updated";
    }


  } else {
    $title = $_POST['title'];
    $description = $_POST['description'];

    // sql query

    $sql = "INSERT INTO `notes` (`sno`, `title`, `description`) VALUES (NULL, '$title', '$description')";
    $result = mysqli_query($conn, $sql);

    if ($result) {

      // echo "succefully added";
      $insert = true;
    } else {
      echo "error" . mysqli_error($conn);
    }
    // exit();
  }
}
// edit notes  condition
?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

  <title>Crud</title>
  <link rel="stylesheet" href="//cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">

  <script>



  </script>

</head>

<body>

  <!-- modal -->

  <!-- Button trigger modal -->
  <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editModal">
  Edit Modal
</button> -->

  <!-- Modal -->
  <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLabel">Edit Note</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <!-- modal form -->
          <form action="/creative/crud/index.php" method="POST">
            <input type="hidden" name="snoEdit" id="snoEdit">
            <div class="form-group">
              <label for="title">Title</label>
              <input type="text" class="form-control" name="titleEdit" id="titleEdit" placeholder="Enter title">

            </div>
            <div class="form-group">
              <label for="description">description</label>
              <textarea class="form-control" name="descriptionEdit" id="descriptionEdit" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
          </form>
          <!-- modal form -->
        </div>

      </div>
    </div>
  </div>



  <!-- modal -->
  <!-- nav bar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="#">about </a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="#">contact</a>
        </li>



      </ul>
      <form class="form-inline my-2 my-lg-0">
        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
      </form>
    </div>

  </nav>
  <!-- nav bar -->

  <!-- alert -->
  <?php
  if ($insert) {
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>WOW!</strong> You should check in notes added.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
  }


  ?>
  <?php
  if ($update) {
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>UPDATED!</strong> You should check in notes.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
  }


  ?>
  <?php
  if ($delete) {
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>DELETED!</strong> You should check in notes.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
  }


  ?>
  <!-- alert -->


  <!-- form -->
  <div class="container my-4">


    <form action="/creative/crud/index.php" method="POST">
      <div class="form-group">
        <label for="exampleInputEmail1">Title</label>
        <input type="text" class="form-control" name="title" id="title" placeholder="Enter title">

      </div>
      <div class="form-group">
        <label for="description">description textarea</label>
        <textarea class="form-control" name="description" id="description" rows="3"></textarea>
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>

  </div>


  <!-- table container -->

  <div class="container">

    <!--  -->
    <!-- table -->

    <table class="table" id="myTable">
      <thead>
        <tr>
          <th scope="col">Sno</th>
          <th scope="col">Title</th>
          <th scope="col">description</th>
          <th scope="col">Date</th>
        </tr>
      </thead>
      <tbody>


        <?php

        $sql = "SELECT * FROM `notes`";
        $result = mysqli_query($conn, $sql);
        $sno = 0;
        while ($row = mysqli_fetch_assoc($result)) {
          $sno = $sno + 1;
          echo "<tr>
  <th scope='row'>" . $sno . "</th>
  <td>" . $row['title'] . "</td>
  <td>" . $row['description'] . "</td>
  <td>   
   <button ' class='edit btn btn-sm btn-primary' id=" . $row['sno'] . ">Edit</button>
   <button  class='delete btn btn-sm btn-primary mx-1' id=d" . $row['sno'] . ">Delete</button>
  </td>
</tr>";
          // echo $row['sno'] . "Title" . $row['title'] . "description is". $row['description'];
          // echo"<br>";
        }


        ?>




      </tbody>
    </table>

    <!-- table -->

  </div>
  <!-- form -->

  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>



  <script src="//cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>




  <script>
    $(document).ready(function() {
      $('#myTable').DataTable();
    });
  </script>
  <!-- edit modal script -->
  <script>
    // edit modal script
    edits = document.getElementsByClassName('edit');
    Array.from(edits).forEach((element) => {
      element.addEventListener("click", (e) => {
        console.log("edit ", );
        tr = e.target.parentNode.parentNode;
        title = tr.getElementsByTagName('td')[0].innerText;
        description = tr.getElementsByTagName('td')[1].innerText;
        console.log(title, description);
        titleEdit.value = title;
        descriptionEdit.value = description;
        snoEdit.value = e.target.id;
        console.log(e.target.id);
        $('#editModal').modal('toggle')

      })
    })
    // end edit script


    // delete script
    deletes = document.getElementsByClassName('delete');
    Array.from(deletes).forEach((element) => {
      element.addEventListener("click", (e) => {
        console.log("delete ", );
        sno = e.target.id.substr(1.)

        // tr = e.target.parentNode.parentNode;
        // title = tr.getElementsByTagName('td')[0].innerText;
        // description = tr.getElementsByTagName('td')[1].innerText;
        if (confirm("Are you sure you want to delete the selected note!")) {
          console.log("YES");
          window.location = `/creative/crud/index.php?delete=${sno}`;
        } else {
          console.log("NO");
        }
        // console.log(title, description);
        // titleEdit.value = title;
        // descriptionEdit.value = description;
        // snoEdit.value = e.target.id;
        // console.log(e.target.id);
        // $('#editModal').modal('toggle')

      })
    })
    // delete script
  </script>
</body>

</html>