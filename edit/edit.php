<?php include("../function/koneksi.php");?>
<?php include("../component/head.php");?>
<?php include("../component/navbar.php");?>
<?php
$id = $_GET['id'];
$stmt = $db->query("SELECT * FROM kasus WHERE kasus_id = $id");
if ($stmt->rowCount() > 0) {
   while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
      $id = $row->kasus_id;
      $negara = $row->negara;
      $total_kasus = $row->total_kasus;
      $total_meninggal = $row->total_meninggal;
      $total_meninggal = $row->total_meninggal;
      $total_sembuh = $row->total_sembuh;
   }
}
?>
<body>
<div class="container" style="margin-top: 50px;">
   <h1>Edit Post</h1>
   <hr>
   <div>
      <form class="form-horizontal" action="update.php" method="POST">
         <fieldset>
            <?php if (isset($_POST['submit'])) : ?>
               <div class="alert alert-dissmissible alert-warning">
                  <p><?php echo $error; ?></p>
               </div>
            <?php endif; ?>
            <input type="hidden" name="id" value=<?php echo $id; ?>>
            <div class="form-group">
               <label class="col-sm-5">Negara</label>
               <div class="col-sm-5">
                  <input type="text" name="negara" class="form-control" value=<?php echo $negara; ?>>
               </div>
            </div>
            <div class="form-group">
               <label class="col-sm-5">Total Kasus</label>
               <div class="col-sm-5">
                  <input type="text" name="total_kasus" class="form-control" value=<?php echo $total_kasus ?>>
               </div>
            </div>
            <div class="form-group">
               <label class="col-sm-5">Total Kematian</label>
               <div class="col-sm-5">
                  <input type="text" name="total_meninggal" class="form-control" value=<?php echo $total_meninggal ?>>
               </div>
            </div>
            <div class="form-group">
               <label class="col-sm-5">Total Sembuh</label>
               <div class="col-sm-5">
                  <input type="text" name="total_sembuh" class="form-control" value=<?php echo $total_sembuh ?>>
               </div>
            </div>
            <div class="form-group">
               <div class="col-sm-20">
                  <button type="submit" class="btn btn-primary" name="submit" style="margin-left : 15px;">Submit</button>
               </div>
            </div>
         </fieldset>
      </form>

   </div>
</div>
<?php include("../component/script.php");?>
</body>
<?php include("../component/footer.php");?>
