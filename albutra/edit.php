<?php
	
	require 'db.php';

	$id = $_GET['id'];

	$show = "SELECT * FROM record WHERE isbn = $id";
	$result0 = mysqli_query($conn, $show);


 if (isset($_POST['change'])) {
	 $isbn = $_POST['isbn'];
     $title = $_POST['title'];
     $copyright = $_POST['copyright'];
     $edition = $_POST['edition'];
     $price = $_POST['price'];
     $quantity = $_POST['quantity'];

	 $edit = "UPDATE record SET title='$title', copyright='$copyright', edition='$edition', price='$price', qty='$quantity' WHERE isbn='$isbn'";
     $queryUpdate = mysqli_query($conn, $edit);
     $message = "RECORD SUCCESSFULLY UPDATED!";
     header("location:index.php");



    }
?>

<!DOCTYPE html>
<html>
	<head></head>

	<body>

		<div>
			<?php 
				if (mysqli_num_rows($result0) > 0) {

					while($row = mysqli_fetch_assoc($result0)) {



						$isbn = $row['isbn'];
						$title = $row['title'];
						$copyright = $row['copyright'];
						$edition = $row['edition'];
						$price = $row['price'];
						$quantity = $row['qty'];
				
			?>


					<form method="POST">

						<input type="text" name="isbn" value="<?php echo $isbn; ?>" readonly/><br />
						<input type="text" name="title" value="<?php echo $title; ?>" /><br />
						<input type="text" name="copyright" value="<?php echo $copyright; ?>" /><br />
						<input type="text" name="edition" value="<?php echo $edition; ?>" /><br />
						<input type="text" name="price" value="<?php echo $price; ?>" /><br />
						<input type="text" name="quantity" value="<?php echo $quantity; ?>" /><br /><br />
						<input type="submit" name="change" value="UPDATE" />
 					</form>

 					<div>
 						<a href="index.php" href="_self">Back to Main</a>
 					</div>
			

			<?php
					} // end of while

				} // end of num rows

			?>
		</div>

	</body>

</html>


