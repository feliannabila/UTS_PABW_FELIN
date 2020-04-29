<?php include("../function/koneksi.php");?>
<?php 
   $id = $_GET['id'];
   $sql = "DELETE FROM kasus WHERE kasus_id = $id";
   $stmt = $db->prepare($sql);
   if($stmt->execute()){
 header("location: http://localhost/UTS_PABW_FELIN/home.php"");
   }
?>
