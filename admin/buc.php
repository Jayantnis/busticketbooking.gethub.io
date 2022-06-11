<?php //seelct data and fatch data 

// INSERT INTO `notes` (`sno`, `title`, `description`, `tstamp`) VALUES (NULL, 'But Books', 'Please buy books from Store', current_timestamp());
$insert = false;
$update = false;
$delete = false;

//Connectivite succussfully         basic connection connectivite

$servername = "localhost";
$username = "root";
$password = "";
$database = "medallion"; //database working stable s


//connnect my sqli stable 
$conn = mysqli_connect($servername, $username, $password, $database);
//Die if connection user not succsfull

if (!$conn) {
  die("Sorry we field to connect : " . mysqli_connect_error());
}
//Resulted 
//calling  delete  functions 
if (isset($_GET['delete'])) {  //Delete function
  $sno = $_GET['delete'];
  $delete = true;
  $sql = "DELETE FROM `destination` WHERE `dest_id` = $sno";
  //EX
  //$sql = "DELETE FROM `destination` WHERE `dest_id` = $sno";
  $result = mysqli_query($conn, $sql);
}
/*-------------Edit Error ------*/
if ($_SERVER['REQUEST_METHOD'] == 'POST') { //Edit method
  if (isset($_POST['snoEdit'])) {
    // Update the record
    $sno = $_POST["snoEdit"];
    $dest_id = $_POST["titleEdit"];
    $dest_destination = $_POST["descriptionEdit"];
    // Sql query to be executed//, `desc` = '$description'

    $sql = "UPDATE `destination` SET `dest_id`='$dest_id',`dest_destination`='$dest_destination'  WHERE `destination`.`dest_id` = $sno";
    $result = mysqli_query($conn, $sql);
    //printing result record
    if ($result) {
      $update = true;
    } else {
      echo "We could not update the record successfully";
    }
  } else //Inserting Packing Data 
  {

    $title = $_POST["dest_destination"];
    //$desc= $_POST["dest_destination"];
    // Sql query to be executed
    $sql = "INSERT INTO `destination` (`dest_destination`) VALUES ('$title')";
    $result = mysqli_query($conn, $sql);
    //printing result record
    if ($result) {
      $insert = true;
    } else {
      echo "The record was not inserted successfully because of this error ---> " . mysqli_error($conn);
    }
  }
}
?>


<!DOCTYPE html>
<html lang="">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Bus Locations</title>

  <!-- Bootstrap CSS -->

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">

</head>

<body>

<style>
 body {
        background-image: url("../img/pho.jpg");
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-size: cover;
		/* position: center; */
	/* //	background-position--y: 1000px; */
      }
      
	</style>
  <!-- Edit Modal -->
  <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLabel">Edit location Destination Name</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form action="./buc.php" method="POST">
          <div class="modal-body">
            <input type="hidden" name="snoEdit" id="snoEdit">
            <div class="form-group">
              <label for="titleEdit">Record No. Edit</label>
              <input type="text" class="form-control" id="titleEdit" name="titleEdit" aria-describedby="emailHelp">
            </div>

            <div class="form-group">
              <label for="desc">Destination Edit</label>
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
  <!-- Edit Button panel END'S -->

  <!-- Edit Button panel END'S -->



  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#"><img src="" height="28px" alt=""></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
     
      <li class="nav-item">
          <a class="nav-link" href="./buc.php">Add DestinationLocation</a>
        </li>
     
        <li class="nav-item active">
          <a class="nav-link" href="./index.php">Home <span class="sr-only"></span></a>

        </li>

        <li class="nav-item">
          <a class="nav-link" href="./loc.php">Add OriginLocation</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="./reservation.php">Reserved</a>
        </li>

        <li><a class="nav-link" href="./transaction.php">Transaction</a>
        </li>
      </ul>
      <form class="form-inline my-2 my-lg-0">
      <li><a class="btn btn-outline-success my-2 my-sm-0" href="./logout.php">Logout</a>
        </li>
      </form>
    </div>
  </nav>
  <!-- NAv  End 



  <!-- alter part hidder -->
  <?php
  if ($insert) {
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Success!</strong> Your note has been inserted successfully
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>×</span>
    </button>
  </div>";
  }
  ?>
  <?php
  if ($delete) {
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Success!</strong> Your note has been deleted successfully
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>×</span>
    </button>
  </div>";
  }
  ?>

  <?php
  if ($update) {
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Success!</strong> Your note has been updated successfully
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>×</span>
    </button>
  </div>";
  }
  ?>
  <!-- Addition formate -->
  <!-- Orign -> origin_desc -->
  <div class="container my-4">
    <h2>Add New Bus Locations Log Area</h2>
    <form action="./buc.php" method="POST">
      <!-- there are two set create in frist origin set origin destinaiton -->
      <!-- first set 1 -->
      <div class="form-group">
        <label for="dest_destination"><b>Destination</b></label>
        <input type="text" class="form-control" id="dest_destination" name="dest_destination" aria-describedby="emailHelp">
      </div>
      <!-- end frist -->

      <!-- Error -->
      <!-- Second Destination -> Dest print -->
      <!--   -->
      <button type="submit" class="btn btn-primary">Add Destnation</button>
    </form>
  </div>


  <!-- Now table showing  -->
  <div class="container my-4">
    <table class="table" id="myTable">
      <thead>
        <tr>
          <th scope="col">S.No</th>
          <th scope="col">RecordNo</th>
          <th scope="col">Destinaiton</th>
          <th scope="col">Actions</th>
        </tr>
      </thead>
      <tbody>

        <?php  //selecting And Display origin selection 
        // SELECT `origin_id`, `origin_desc` FROM `medallion`.`origin`
        //database name connective
        $sql = "SELECT `dest_id`, `dest_destination` FROM `medallion`.`destination`";
        $result = mysqli_query($conn, $sql);

        $sn = 0;
        $s = 0;

        while ($ro = mysqli_fetch_assoc($result)) {
          $sn = $sn + 1;

          echo  "<tr>
	<th scope='row'>" . $sn . "</th>
	<td>" . $ro['dest_id'] . "</td>
  <td>" . $ro['dest_destination'] . "</td>
  <td> <button class='edit btn btn-sm btn-primary' id=" . $ro['dest_id'] . ">Edit</button> <button class='delete btn btn-sm btn-primary' id=d" . $ro['dest_id'] . ">Delete</button></td>
  </tr>";
        }
        ?>

      </tbody>
    </table>
  </div>
  <hr>

  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  <script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
  <script>
    $(document).ready(function() {
      $('#myTable').DataTable();

    });
  </script>
  <script>
    edits = document.getElementsByClassName('edit');
    Array.from(edits).forEach((element) => {
      element.addEventListener("click", (e) => {
        console.log("edit ");
        tr = e.target.parentNode.parentNode;
        title = tr.getElementsByTagName("td")[0].innerText;
        description = tr.getElementsByTagName("td")[1].innerText;
        console.log(title, description);
        titleEdit.value = title;
        descriptionEdit.value = description;
        snoEdit.value = e.target.id;
        console.log(e.target.id)
        $('#editModal').modal('toggle');
      })
    })

    deletes = document.getElementsByClassName('delete');
    Array.from(deletes).forEach((element) => {
      element.addEventListener("click", (e) => {
        console.log("edit ");
        sno = e.target.id.substr(1);

        if (confirm("Are you sure you want to delete this note!")) {
          console.log("yes");
          window.location = `./buc.php?delete=${sno}`;
          // TODO: Create a form and use post request to submit a form
        } else {
          console.log("no");
        }
      })
    })
  </script>

</body>

</html>