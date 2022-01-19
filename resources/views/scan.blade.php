<?php
    session_start();
    include 'connect.php';
?>

<html>
<head>
	<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/app.css">
    <link rel="stylesheet" href="./css/style.css">
	<title>Login Warunk</title>
	<style>
		.dropdown-menu{ width: 350px; margin:auto; padding: 10px}
		.camera{ width: 610px; margin:0px; }
	</style>
	<script src="js/jquery-3.4.1.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <!-- scanner -->
    <script src="scanner/vendor/modernizr/modernizr.js"></script>
    <script src="scanner/vendor/vue/vue.min.js"></script>
</head>
<body>
<div class="container">
  <div class="logo">
    <img src="./gambar/logo.png" alt="">
  </div>
    <div class="text-main">
        <h2 class="text-center fw-bold">Scan QR Code</h2>
    </div>
	  <!-- scan -->
  <div id="app" class="row box">
    
      <!--form scan -->
       <form action="" method="POST" id="myForm">
          <fieldset class="scheduler-border">
            <legend class="scheduler-border"> Form Scan </legend>
            <input type="text" name="qrcode" id="code" autofocus>
          </fieldset>
        </form>

        <?php

        if(!empty($_POST['qrcode'])){

            $qrcode= $_POST['qrcode'];
            $arr = explode('|', $qrcode);

            $user = $arr[1];
            $pass = $arr[2];

            $sql = "SELECT * FROM customer WHERE user = '$user' AND password = '$pass' AND IsActive=1";
            
            $resultSQL = mysqli_query($con, $sql);

            $result = mysqli_fetch_array($resultSQL);

            if (mysqli_num_rows($resultSQL) > 0 ){
                
                $_SESSION['user']=$result['user'];
                $_SESSION['IsActive']= TRUE;
                
                header("location:home.php");
            }
        }
        ?>
    
    <div class="col-lg-12 col-md-12 col-12 preview-container camera">
        <video id="preview" class="thumbnail"></video>
    </div>
    <div class="col-md-12 col-md-offset-12 col-sm-12 col-12 cam">
      <div class="dropdown">
    <button class="btn btn-primary text-center dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
     Pilih Kamera
    </button>
      <div class="col-md-4 col-md-offset-4 dropdown-menu" aria-labelledby="dropdownMenuButton">
      <ul class="dropdown-item" style="list-style:none;">
        <li v-if="cameras.length === 0" class="empty">No cameras found</li>
        <li v-for="camera in cameras">
          <span v-if="camera.id == activeCameraId" :title="formatName(camera.name)" class="active"><input type="radio" class="align-middle mr-1" checked> {{ formatName(camera.name) }}</span>
          <span v-if="camera.id != activeCameraId" :title="formatName(camera.name)">
            <a @click.stop="selectCamera(camera)"> <input type="radio" class="align-middle mr-1">{{ formatName(camera.name) }}</a>
          </span>
        </li>
      </ul>
      </div>
      </div>
      </div>
      <div class="clearfix"></div>
      </div>
    </div>
   </div>
   <!-- scanner -->
    <script src="scanner/js/app.js"></script>
    <script src="scanner/vendor/instascan/instascan.min.js"></script>
    <script src="scanner/js/scanner.js"></script>
  
 </body>
</html>