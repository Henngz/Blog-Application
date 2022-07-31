<!------------------

    connect.php
    Name: Yuheng Zhu
    Date: 2022-07-28
    Description: The php file is used to create a connect to the database.
   
-------------------->
<?php
     define('DB_DSN','mysql:host=localhost;dbname=serverside;charset=utf8');
     define('DB_USER','serveruser');
     define('DB_PASS','gorgonzola7!');

     // Create a PDO object called $db.
     try {
        $db = new PDO(DB_DSN, DB_USER, DB_PASS);
     } catch (PDOException $e) {
        print "Error: " . $e->getMessage();
        die(); 
     }
?>