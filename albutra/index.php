<?php

    require 'db.php';
    $message = '';
    $searchTerm = '';

    if (isset($_POST['add']))   {
        
        

        $isbn = $_POST['isbn'];
        $title = $_POST['title'];
        $copyright = $_POST['copyright'];
        $edition = $_POST['edition'];
        $price = $_POST['price'];
        $quantity = $_POST['quantity'];

        $insert= "INSERT INTO record (isbn, title, copyright, edition, price, qty) VALUES('$isbn', '$title', '$copyright', '$edition', '$price', '$quantity')";

        $result = mysqli_query($conn, $insert);

        if (!$result) {

        }

        else {

                $message = 'RECORD SUCCESSFULLY SAVED!';
        }


      
    }

    if (isset($_POST['search']))   {
            
     $searchTerm = $_POST['isbn'];
     $message = 'ITEM FOUND!';



    }

    $search = "SELECT * FROM record WHERE isbn LIKE '%$searchTerm%'";
    $result1 = mysqli_query($conn, $search);

   
 if (isset($_POST['delete']))   {
 
    $id = $_POST['isbn'];
    $delete = "DELETE FROM record WHERE isbn = '$id'";
    $result3 = mysqli_query($conn, $delete);
    $message = 'RECOR SUCCESSFULLY DELETED!';  
    } 

     
 if (isset($_POST['edit'])) {
    $id = $_POST['isbn'];
    header("location: edit.php?id=$id");
 }

    // display normal list

    $show = "SELECT * FROM record";
    $result2 = mysqli_query($conn, $show);
    
?>


<!DOCTYPE html>

<html>
    <head><title>Libray</title></head>
        <style>

            body {
                background-color: #f9f9f9;
            }

            .row {
                padding: 5% 1%;
            }

            .form-ui {
                background-color: #fff;
                width: 900px;
                margin: 0 auto;
                box-shadow: 0px 7px 29px 0px rgba(100, 100, 111, 0.2);
                padding: 2% 4%;
                border: 1px solid #3333;

            }

           

            .prompt-box {
                border: 1px dashed #333;
                padding: 10px 20px;
                margin-top: 20px;
            }


            /** Forms **/

            input[type="text"] {
                border: 1px solid #e1e1e1;
                padding: 10px 20px;
                margin-bottom: 5px;
                box-sizing: border-box;
            }
        </style>
    <body>
        <div class="container">
            <div class="row">

            <div class="form-ui">
                    
                  
                        <form method="post">
                                <input type="hidden" name="id" value="<?php echo $row['isbn']; ?>" />
                            <div class="col-1">
                                <label>ISBN #:
                                    <input type="text" name="isbn" placeholder="ISBN #" />
                                </label><br />
                                <label>Title #:
                                    <input type="text" name="title" placeholder="Title" />
                                </label><br />
                                <label>Copyright #:
                                    <input type="text" name="copyright" placeholder="Copyright" />
                                </label><br />
                                <label>Edition #:
                                        <input type="text" name="edition" placeholder="Edition" />
                                </label><br />
                                <label>Price #:
                                    <input type="text" name="price" placeholder="Price" /> 
                                </label><br />
                                 <label>Quantity #:
                                    <input type="text" name="quantity" placeholder="Quantity" /> 
                                </label><br />
                            </div>

                            <div class="col-2">

                                <div style="margin-bottom: 10px;"></div>
                                <span><input type="submit" name="search" value="SEARCH" /></span>
                                <span><input type="submit" name="edit" value="EDIT" /></span>
                                <div style="margin-bottom: 10px;"></div>
                                <span><input type="submit" name="delete" value="DELETE" /></span>
                                <span><input type="submit" name="add" value="ADD" /></span>

                                <div class="prompt-box">
                                        <?php echo $message; ?>
                                </div>

                            </div>                       
                        </form>
                    



                        <div class="record-list">

                                <table>

                                    <tr>
                                        <th>ISBN</th>
                                        <th>Title</th>
                                        <th>Copyright</th>
                                        <th>Edition</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>TOTAL</th>
                                    </tr>


                                    <?php 

                                        if (isset($_POST['search'])) {

                                         if (mysqli_num_rows($result1) > 0) {


                                            while($row = mysqli_fetch_assoc($result1))  {

                                                    $total = $row['price'] * $row['qty'];
                                                    $id = $row['isbn'];

                                                    echo "<tr>";
                                                    echo "<td>" . $row['isbn'] . "</td>";
                                                    echo "<td>" . $row['title'] . "</td>";
                                                    echo "<td>" . $row['copyright'] . "</td>";
                                                    echo "<td>" . $row['edition'] . "</td>";
                                                    echo "<td>" . $row['price'] . "</td>";
                                                    echo "<td>" . $row['qty'] . "</td>";
                                                    echo "<td>" . $total . "</td>";
                                                    echo "</tr>";
                                            }
                                        }

                                    }

                                          else {


                                         if (mysqli_num_rows($result2) > 0) {


                                            while($row = mysqli_fetch_assoc($result2))  {

                                                    $total = $row['price'] * $row['qty'];

                                                    echo "<tr>";
                                                    echo "<td>" . $row['isbn'] . "</td>";
                                                    echo "<td>" . $row['title'] . "</td>";
                                                    echo "<td>" . $row['copyright'] . "</td>";
                                                    echo "<td>" . $row['edition'] . "</td>";
                                                    echo "<td>" . $row['price'] . "</td>";
                                                    echo "<td>" . $row['qty'] . "</td>";
                                                    echo "<td>" . $total . "</td>";
                                                    echo "</tr>";
                                            }
                                        }
                                        }


                                       
                       
                                    ?>

                                </table>

                        </div>


                </div>

            </div>
        </div>

    </body>

</html>