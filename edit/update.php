<?php include("../function/koneksi.php")?>

<?php 
if(isset($_POST['submit'])){
      $id = $_POST['id'];
      $negara = $_POST['negara'];
      $total_kasus = $_POST['total_kasus'];
      $total_meninggal = $_POST['total_meninggal'];
      $total_sembuh = $_POST['total_sembuh'];
     

      if($negara != "" && $total_kasus != "" && $total_meninggal !="" && $total_sembuh !=""){
        $sql = "UPDATE kasus SET negara='$negara', total_kasus='$total_kasus', total_meninggal='$total_meninggal', total_sembuh='$total_sembuh' WHERE kasus_id =$id";
     
       
         $stmt = $db->prepare($sql);
         if($stmt ->execute()){
               header("location: http://localhost/UTS_PABW_FELIN/home.php");
         } else {
               echo "Maaf, gagal mengupdate data";
         }
      } else {
            $error  = "Mohon isi semua data!";
      }
   
   }
   ?>
