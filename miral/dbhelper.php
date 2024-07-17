<?php 
    $host = 'localhost';
    $user = 'root';
    $pass = '';
    $database = 'library';
    $conn;

    function connect(){
        global $host, $user, $pass, $database, $conn;

        $conn = mysqli_connect($host, $user, $pass, $database) or die('Connection Failed!');
    }

    function disconnect(){
        global $conn;

        mysqli_close($conn);
    }

    function getAllRecord($table){
        global $conn;
        $sql = "SELECT * FROM $table";
        connect();
        $query = mysqli_query($conn, $sql);
        $rows = mysqli_fetch_all($query);
        disconnect();
        return $rows;
        
    }

    function insertRecord($table, $isbn, $title, $copyright, $edition, $price, $qty){
        global $conn;
        $sql = "INSERT INTO $table(isbn, title, copyright, edition, price, qty) VALUES('$isbn', '$title', '$copyright', '$edition', '$price', '$qty')";
        connect();
        mysqli_query($conn, $sql);
        disconnect();
    }

    function updateTotal($table){
        global $conn;
        $sql = "UPDATE $table SET total = price * qty";
        connect();
        mysqli_query($conn, $sql);
        disconnect();
    }

    function deleteRecord($table, $isbn){
        global $conn;
        $sql = "DELETE FROM $table WHERE isbn = $isbn";
        connect();
        mysqli_query($conn, $sql);
        disconnect();
    }

    function getRecord($table, $isbn){
        global $conn;
        $sql = "SELECT isbn, title, copyright, edition, price, qty FROM $table WHERE isbn = $isbn";
        connect();
        $query = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($query);
        disconnect();
        return $row;
    }

    function updateRecord($table, $isbn, $title, $copyright, $edition, $price, $qty){
        global $conn;
        $sql = "UPDATE $table SET title = '$title', copyright = '$copyright', edition = '$edition', price = '$price', qty = '$qty' WHERE isbn = '$isbn'";
        connect();
        mysqli_query($conn, $sql);
        disconnect();
    }


    
?>