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
} //without any error connection stabalize

//Resulted 
//calling  delete  functions 
if (isset($_GET['delete'])) {  //Delete function
  $sno = $_GET['delete'];
  $delete = true;
  $sql = "DELETE FROM `origin` WHERE `origin_id` = $sno";
//EX
//$sql = "DELETE FROM `destination` WHERE `dest_id` = $sno";
  $result = mysqli_query($conn, $sql);
}
/*-------------Edit Error ------*/
if ($_SERVER['REQUEST_METHOD'] == 'POST') { //Edit method
  if (isset($_POST['snoEdit'])) {
    // Update the record
    $sno = $_POST["snoEdit"];
    $title = $_POST["titleEdit"];
    $desc = $_POST["descriptionEdit"];

    // Sql query to be executed//, `desc` = '$description'
    
  $sql="UPDATE `origin` SET `origin_id`='$sno',`origin_desc`='$title',`desc`='$desc' WHERE `origin`.`origin_id` = $sno";
    $result = mysqli_query($conn, $sql);
    //printing result record
    if ($result) {
      $update = true;
    } else {
      echo "We could not update the record successfully";
    }
  } else //Inserting Packing Data 
  {
    $title = $_POST["origin_desc"];
    $desc= $_POST["desc"];
    // Sql query to be executed
    $sql = "INSERT INTO `origin` (`origin_desc`,`desc`) VALUES ('$title','$desc')";
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
          <h5 class="modal-title" id="editModalLabel">Edit BusLocation Name</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form action="./loc.php" method="POST">
          <div class="modal-body">
            <input type="hidden" name="snoEdit" id="snoEdit">
            <div class="form-group">
              <label for="title">To Edit</label>
              <input type="text" class="form-control" id="titleEdit" name="titleEdit" aria-describedby="emailHelp">
            </div>

            <div class="form-group">
              <label for="desc">From Edit</label>
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

  <!-- Referencse colour -->
  <!-- <nav class="navbar navbar-inverse">
		<div class="container-fluid">
			<a class="navbar-brand" href="#">Online Ticketing Admin Panel</a>
			<ul class="nav navbar-nav">
				
            <!-- additional menu  features -->




  <?php require('nav_barAdmin.php'); //short navbarAdmin sp
  ?>
  <!-- NAv BAR  -->
  <!-- <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#"><img src="" height="28px" alt=""></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <!-- <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a> -->

  <!-- </li>
        
        <li class="nav-item">
          <a class="nav-link" href="./loc.php">Add Locations</a>
        </li>
        
        <li class="nav-item">
          <a class="nav-link" href="../reservation.php">Reserved</a>
        </li>

				<li ><a class="btn btn-outline-success my-2 my-sm-0" href="../transaction.php">Transaction</a>
      </li>
      </ul>
      <form class="form-inline my-2 my-lg-0">
        <!-- <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search"> -->
  <!-- <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
   
      </form>
    </div>
  </nav> -->
  <!-- NAv  End  -->



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
    <h2>Add New Bus Locations Schedule Area</h2>
    <form action="./loc.php" method="POST">
      <!-- there are two set create in frist origin set origin destinaiton -->
      <!-- first set 1 -->
      <div class="form-group">
        <label for="origin_desc"><b>Origin</b></label>
        <input type="text" class="form-control" id="origin_desc" name="origin_desc" aria-describedby="emailHelp">
      </div>
      <!-- end frist -->

      <!-- Error -->
      <!-- Second Destination -> Dest print -->
      <div class="form-group">
        <label for="desc"><b>Destinaiton</b></label>
        <textarea type="text" class="form-control" id="desc" name="desc" rows="3"></textarea>
      </div>
      <button type="submit" class="btn btn-primary">Add location</button>
    </form>
  </div>

  <!-- Now table showing  -->
  <div class="container my-4">
    <table class="table" id="myTable">
      <thead>
        <tr>
          <th scope="col">S.No</th>
          <th scope="col">Origin</th>
          <th scope="col">Destinaiton</th>
          <th scope="col">Actions</th>
        </tr>
      </thead>
      <tbody>

        <?php  //selecting And Display origin selection 
        // SELECT `origin_id`, `origin_desc` FROM `medallion`.`origin`
        $sql = "SELECT `origin_id`, `origin_desc`, `desc` FROM `medallion`.`origin`"; //database name connective
        $result = mysqli_query($conn, $sql);

        //displaying showing screen 
        //find the number of  record returned 
        //$num= mysqli_num_rows($result); //check number of rows 
        //echo $num;
        //echo  "<br>";
        //echo "I got found database ";
        //loop for loop 
        //echo "<br><br>";

         //   'dest_destination'
         // SELECT `dest_id`, `dest_destination` FROM `medallion`.`destination`
    //  $sql1 = "SELECT `dest_id`, `dest_destination` FROM `medallion`.`destination`"; //database name connective
    //  $result1 = mysqli_query($conn, $sql1);
    //  //find the number of  record returned 
    // $num= mysqli_num_rows($result1); //check number of rows 
    // echo $num;
    // echo  "<br>";
    // echo "I got found database ";
  //loop for loop 
//   echo "<br><br>";
// while()
// {$sno = 0; $s=0;

  //dest_id //dest_Destination
 
    
//     echo  $row1['dest_id']." Dest ".;
//     echo "<br>";
// }

        $sno = 0; $s=0;
      
        while ($row = mysqli_fetch_assoc($result))
        {
          $sno = $sno + 1;
      //    $s=$s+1;
          //	<td>". $row['desc'] . "</td> error Destination DELETE INSERT
          echo  "<tr>
	<th scope='row'>". $sno ."</th>
	<td>" . $row['origin_desc'] . "</td>
  <td>" . $row['desc'] . "</td>
  <td> <button class='edit btn btn-sm btn-primary' id=". $row['origin_id'] . ">Edit</button> <button class='delete btn btn-sm btn-primary' id=d" . $row['origin_id'].">Delete</button></td>
  </tr>";
	


        }  //  $sql2= "SELECT * FROM `destination`";
    //  $result2 = mysqli_query($conn, $sql2);
    //  $r=0;
    //  while($ow = mysqli_fetch_assoc($result2))
    //  { $r=$r+1;
    //    $ow['dest_destination'];
    //  }

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
          window.location = `./loc.php?delete=${sno}`;
          // TODO: Create a form and use post request to submit a form
        } else {
          console.log("no");
        }
      })
    })
  </script>

</body>

</html>