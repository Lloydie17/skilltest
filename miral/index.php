<?php 
    include('dbhelper.php');
    $table = 'record';
    $header = ['ISBN', 'Title', 'Copyright', 'Edition', 'Price', 'Quantity', 'TOTAL'];
    $isbn = '';
    $title = '';
    $copyright = '';
    $edition = '';
    $price = '';
    $qty = '';


    $row = array();

    $rows = getAllRecord($table);

    if (isset($_GET['ADD'])){
        $isbn = $_GET['isbn'];
        $title = $_GET['title'];

        $copyright = $_GET['copyright'];
        $edition = $_GET['edition'];
        $price = $_GET['price'];
        $qty = $_GET['qty'];

        $insert = insertRecord($table, $isbn, $title, $copyright, $edition, $price, $qty);
        $updateTotal = updateTotal($table);
        $rows = getAllRecord($table);
    }

    if (isset($_GET['DELETE'])){
        $isbn = $_GET['isbn'];

        $record = deleteRecord($table, $isbn);
        $updateTotal = updateTotal($table);
        $rows = getAllRecord($table);
    }

    if (isset($_GET['SEARCH'])){
        $isbn = $_GET['isbn'];

        $found = getRecord($table, $isbn);
        if ($found){
            $isbn = $found['isbn'];
            $title = $found['title'];
            $copyright = $found['copyright'];
            $edition = $found['edition'];
            $price = $found['price'];
            $qty = $found['qty'];
        }
    }

    if (isset($_GET['EDIT'])){
        $isbn = $_GET['isbn'];
        $title = $_GET['title'];
        $copyright = $_GET['copyright'];
        $edition = $_GET['edition'];
        $price = $_GET['price'];
        $qty = $_GET['qty'];

        $update = updateRecord($table, $isbn, $title, $copyright, $edition, $price, $qty);
        $updateTotal = updateTotal($table);
        $rows = getAllRecord($table);
    }


?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LIBRARY</title>
    
    <style>
        table {
            margin-top: 5%;
            width: 100%;
            border-collapse: collapse;
        }

        table td, table th {
            border: 1px solid #000000;
            padding: 8px;
        }

        table tr:nth-child(even){background-color: #f2f2f2;}

        table tr:hover {background-color: #ddd;}

        table th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #d5f4e6;
        }

        .container{
            margin: 20px 10px;
        }

    </style>
</head>
<body>
    <div class="container">
        <form action="index.php">
            <label for="isbn">ISBN #:</label>
            <input type="text" name="isbn" id="isbn" value='<?php echo $isbn?>'><br><br>
            <label for="title">Title:</label>
            <input type="text" name="title" id="title" value='<?php echo $title?>'><br><br>
            <label for="copyright">Copyright:</label>
            <input type="text" name="copyright" id="copyright" value='<?php echo $copyright?>'><br><br>
            <label for="edition">Edition:</label>
            <input type="text" name="edition" id="edition" value='<?php echo $edition?>'><br><br>
            <label for="price">Price:</label>
            <input type="text" name="price" id="price" value='<?php echo $price?>'><br><br>
            <label for="qty">Quantity:</label>
            <input type="text" name="qty" id="qty" value='<?php echo $qty?>'><br><br>
            <input type="submit" name='ADD' value='ADD'>
            <input type="submit" name='DELETE' value='DELETE'>
            <input type="submit" name='SEARCH' value='SEARCH'>
            <input type="submit" name='EDIT' value='EDIT'>
        </form>
        <table>
            <tr>
                <?php 
                    foreach($header as $head){
                        echo "<th>$head</th>";
                    }
                ?>
            </tr>
            <?php 
                foreach($rows as $row){
                    echo "<tr>";
                        foreach($row as $data){
                            echo "<td>$data</td>";
                        }
                    echo "</tr>";
                }
            ?>
        </table>
    </div>
</body>
</html>