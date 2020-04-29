<?php include("../function/koneksi.php");?>
<?php include("../component/head.php");?>
<?php include("../component/navbar.php");?>
<?php 
$id = $_GET['id'];
$stmt = $db->query("SELECT * FROM kasus WHERE kasus_id = $id");
if($stmt->rowCount() > 0){
   while($row = $stmt->fetch(PDO::FETCH_OBJ)){
      $id = $row->kasus_id;
      $negara = $row->negara;
      $total_kasus = $row->total_kasus;
      $total_meninggal = $row->total_meninggal;
      $total_sembuh = $row->total_sembuh;
   }
}
?>

<body>
<div class="container" style="margin-top: 50px;">
<h1>Data Pesebaran COVID-19 <?php echo $negara?></h1> 
   <div class="row">
      <div class="col-lg-12">
         <div class="list-group">
            <li class="list-group-item">Negara: <?php echo $negara; ?></li>
            <li class="list-group-item">Jumlah kasus: <?php echo $total_kasus; ?></li>
            <li class="list-group-item">Jumlah yang meninggal: <?php echo $total_meninggal; ?></li>
            <li class="list-group-item">Jumlah yang sembuh: <?php echo $total_sembuh; ?></li> 
         </div>
      </div>
   </div>
</div>
<?php include("../component/script.php");?>
<?php include("../component/footer.php");?>

   
  
