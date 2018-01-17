<?php
    $servername = 'localhost';
	$username = 'root';
	$password = '';
	$dbname = 'email';
	try{
        $conn = new PDO("mysql:host=$servername;dbname=$dbname",$username,$password);
        $conn -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT useremail FROM email_list WHERE status = '0'";
        $connn= $conn->query($sql);
        // var_dump($connn);
        foreach ($connn as $row) {
            var_dump($row['useremail']);
        }


    }catch(Exception $e){
        echo $e->getMessage;

    }
?>