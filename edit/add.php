<?php include("../function/koneksi.php");?>
<?php include("../component/head.php");?>
<?php include("../component/navbar.php");?>
<?php
if (isset($_POST['submit'])) {
   $negara = $_POST['negara'];
   $total_kasus = $_POST['total_kasus'];
   $total_meninggal = $_POST['total_meninggal'];
   $total_sembuh= $_POST['total_sembuh'];
   if ($negara != "" && $total_kasus != "" && $total_meninggal != "" && $total_sembuh != "") {
      $sql = "INSERT INTO kasus(negara, total_kasus, total_meninggal, total_sembuh) VALUES('$negara','$total_kasus','$total_meninggal','$total_sembuh')";

      $stmt = $db->prepare($sql);
      if ($stmt->execute()) {
         header("location: http://localhost/UTS_PABW_FELIN/home.php");
      } else {
         echo "Maaf, gagal menambahkan data";
      }
   } else {
      $error  = "Mohon isi semua data!";
   }
}
?>
<body>
<div class="container" style="margin-top: 50px">
   <h1>Tambah Data</h1>
   <hr>
   <div>
      <form class="form-horizontal" action="add.php" method="POST">
         <fieldset>
            <?php if (isset($_POST['submit'])) : ?>
               <div class="alert alert-dissmissible alert-warning">
                  <p><?php echo $error; ?></p>
               </div>
            <?php endif; ?>
            <div class="form-group">
               <label class="col-sm-5">Negara</label>
               <div class="col-sm-5">
                  <input type="text" name="negara" class="form-control">
               </div>
            </div>
            <div class="form-group">
               <label class="col-sm-5">Total Kasus</label>
               <div class="col-sm-5">
                  <input type="text" name="total_kasus" class="form-control">
               </div>
            </div>
            <div class="form-group">
               <label class="col-sm-5">Total Kematian</label>
               <div class="col-sm-5">
                  <input type="text" name="total_meninggal" class="form-control">
               </div>
            </div>
            <div class="form-group">
               <label class="col-sm-5">Total Sembuh</label>
               <div class="col-sm-5">
                  <input type="text" name="total_sembuh" class="form-control">
               </div>
            </div>
            <div class="form-group">
               <div class="col-sm-5">
                  <button type="submit" class="btn btn-primary" name="submit">Submit</button>
               </div>
            </div>
         </fieldset>
      </form>

   </div>
</div>
<?php include("../component/script.php");?>
</body>
<?php include("../component/footer.php");?>
