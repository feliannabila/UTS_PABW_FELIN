<?php
				
	require_once 'function/koneksi.php';
				
	session_start();

	if(!isset($_SESSION['user_login']))	//check unauthorize user not access in "welcome.php" page
	{
		header("location: index.php");
	}
				
	$id = $_SESSION['user_login'];
				
	$select_stmt = $db->prepare("SELECT * FROM user WHERE user_id=:uid");
	$select_stmt->execute(array(":uid"=>$id));
	
	$row=$select_stmt->fetch(PDO::FETCH_ASSOC);
		
?>
<?php include ('component/head.php')?>
<?php include ('component/navbar.php')?>
	<body>
	<div class="container" style="margin-top: 50px;">
		<center><h1>Data COVID-19</h1></center>
		<div class="clients-inner section-inner has-top-divider has-bottom-divider">
		<a href="edit/add.php" class="btn btn-primary" style="margin-bottom: 10px">Create Post</a>
			<table class="table table-dark table-bordered">
				<thead>
					<tr>
				    <th scope="col">Negara</th>
					<th scope="col">Total Kasus</th>
					<th scope="col">Total Kematian</th>
					<th scope="col">Total Sembuh</th>
					<th scope="col">Edit</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$stmt = $db->query('select * from kasus');
						if ($stmt->rowCount() > 0) {
							while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
					?>
						<tr class="table-active">
							<td><?php echo $row->negara; ?></td>
							<td><?php echo $row->total_kasus; ?></td>
							<td><?php echo $row->total_meninggal; ?></td>
							<td><?php echo $row->total_sembuh; ?></td>
							<td>
								<a href=edit/view.php?id=<?php echo $row->kasus_id; ?> class="btn btn-outline-primary">View</a>
								<a href=edit/edit.php?id=<?php echo $row->kasus_id; ?> class="btn btn-outline-success">Edit</a>
								<a href=edit/delete.php?id=<?php echo $row->kasus_id; ?> class="btn btn-outline-danger">Delete</a>
							</td>
						</tr>
					<?php
							}
						} else {
					?>
						<tr>No record Found!</tr>
					<?php
						}
					?>
				</tbody>
			</table>
		</div>
	</div>			
<?php include ('component/script.php')?>
</body>
