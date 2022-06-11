<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" type="text/css" href="/assets/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="/assets/css/bootstrap-theme.min.css">

  <!-- Bootstrap CSS -->

  <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous"> -->
  <link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">

  <!-- Custom CSS -->
  <link href="/assets/css/simple-sidebar.css" rel="stylesheet">
  <link href="/assets/css/dataTables.bootstrap.min.css" rel="stylesheet">

  <!-- <link rel="stylesheet" type="text/stylesheet" href="./style.css"> -->
  <style>
    ul {
      list-style-type: none;
      margin: 0;
      padding: 0;
      overflow: hidden;
      background-color: #333;
    }

    li {
      float: left;
    }

    li a,
    .dropbtn {
      display: inline-block;
      color: white;
      text-align: center;
      padding: 13px 16px;
      text-decoration: none;
    }

    li a:hover,
    .dropdown:hover .dropbtn {
      background-color: yellowgreen;
    }

    li.dropdown {
      display: inline-block;
    }

    .dropdown-content {
      display: none;
      position: absolute;
      background-color: #f9f9f9;
      min-width: 160px;
      box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
      z-index: 1;
    }

    .dropdown-content a {
      color: black;
      padding: 12px 16px;
      text-decoration: none;
      display: block;
      text-align: left;
    }

    .dropdown-content a:hover {
      background-color: #f1f1f1;
    }

    .dropdown:hover .dropdown-content {
      display: block;
    }
  </style>
</head>

<body>

  <!-- <ul>
  <li><a href="./loc.php">Add Locations</a></li>
  <li><a href="../reservation.php">Reserved</a></li>
  <li><a href="../transaction.php">Transaction</a>
<li><a  href="../logout.php">Logout</a>
</ul> -->

  <!-- NAv BAR  -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="./loc.php"><img src="" height="28px" alt="">Add New Schedules</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- class="nav-link" references -->
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">

          <a href="../index.php">Home <span class="sr-only">(current)</span></a>

        </li>

        <li class="nav-item">
          <a href="./loc.php">Add Schedule log</a>
        </li>

        <li class="nav-item">
          <a href="./buc.php">BusLocations</a>
        </li>


        <li class="nav-item">
          <a href="./reservation.php">Reserved</a>
        </li>

        <li>
          <a href="./transaction.php">Transaction</a>
        </li>
      </ul>

      <ul class="nav navbar-nav navbar-right">
        <a class="btn btn-outline-success my-2 my-sm-0" href="./logout.php">Logout</a>
      </ul>
    </div>
  </nav>

</body>

</html>