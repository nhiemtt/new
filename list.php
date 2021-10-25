<!DOCTYPE HTML>
<html>
    <head>
        <style>
            .error {color: #FF0000;}
        </style>
    </head>
    <body>
        <?php
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
            
            $sql ="Select * from hhsdtb1709358";

            print "<br>$sql<br>";
            $ret = pg_query($db, $sql);
            if(!$ret){
                echo pg_last_error($db);
                exit();
            } 
        ?>

        <table border="1" cellspacing="2" cellpadding="2">
            <tr><td>Ma</td><td>Ho ten</td><TD>Loai</TD><td>Dia chi</td></tr>
            <?php
                while($myrow = pg_fetch_assoc($ret)){
                    printf("<tr><td>%s</td><td>%s</td><td>%s</td><td>%s</td></tr>", $myrow['ma'], $myrow['hoten'],$myrow['loai'],$myrow['diachi']);
                }
                pg_close($db);
            ?>
        </table>
        <br><a href="index.php">HOME</a>
    </body>
</html>
