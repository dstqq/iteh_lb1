<?php
include('connect.php');
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=\, initial-scale=1.0">
        <link rel="stylesheet" href="style.css">
        <title>Date</title>
    </head>
    <body>

        <?php
        $db = "iteh_lb1_v0";

        if (isset($_POST['FYear'])) $FYear = $_POST['FYear'];
        else $FYear = '1990';
        if (isset($_POST['SYear'])) $SYear = $_POST['SYear'];
        else $SYear = '2034';

        try {
            $sql = "SELECT $db.literature.name,$db.literature.year,$db.literature.literate FROM $db.literature WHERE year BETWEEN :FYear and :SYear";
            $sth = $dbh->prepare($sql);
            $sth->execute(array('FYear' => $FYear, 'SYear' => $SYear));
            $timetable = $sth->fetchAll(PDO::FETCH_NUM);
            print "<table border ='1'>";
            print " <tr><td><b>Назва</td><td><b>Рік</td><td><b>Вид</td></tr>";
            foreach ($timetable as $row) {
                print " <tr><td>$row[0]</td><td>$row[1]</td><td>$row[2]</td></tr>";
            }
        } catch (PDOException $e) {

            die("Error!:" . $e->getMessage() . "<br>");
        }
        ?>
        <input type="button" value="Повернутися" onclick="history.back();return false;" />
    </body>
</html>