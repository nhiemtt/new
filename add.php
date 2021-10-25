<!DOCTYPE HTML>
<html>
    <head>
        <style>
            .error {color: #FF0000;}
        </style>
    </head>
    <body>
        <h2>Them Ho So Dich Te</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                Ma <input type="text" name="ma" value="<?php echo $ma;?>"><BR>
                Ho Ten <input type="text" name="hoten" value="<?php echo $hoten;?>"><BR>
		Loai <input type="text" name="loai" value="<?php echo $loai;?>"><BR>
		Dia chi <input type="text" name="diachi" value="<?php echo $diachi;?>"><BR>
                <input type="submit" name="submit" value="Submit">
        </form>
        <?php
            $ma=$_POST["ma"];
            $hoten=$_POST["hoten"];
	    $loai=$_POST["loai"];
	    $diachi=$_POST["diachi"];
            function pg_connection_string_from_database_url() {
                extract(parse_url($_ENV["DATABASE_URL"]));
                return "user=$user password=$pass host=$host dbname=" . substr($path, 1); # <- you may want to add sslmode=require there too
              }
                 $db = pg_connect(pg_connection_string_from_database_url() );
                 if(!$db){
                    echo "Error : Unable to open database\n";
                 } else {
                    echo "Opened database successfully\n";
                 }
                 
                 $sql = "INSERT INTO hhsdtb1709358 (ma, hoten, loai, diachi) VALUES ('$ma','$hoten', '$loai', '$diachi')";
              
                 print "<br>$sql<br>";
                 $ret = pg_query($db, $sql);
                 if(!$ret){
                    echo pg_last_error($db);
                 } else {
                    echo "Insert successfully\n";
                 }
                 pg_close($db);
        ?>
        <br><a href="index.php">HOME</a>
    </body>
</html>
