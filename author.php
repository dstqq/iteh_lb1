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
        <title>Document</title>
    </head>
    <body>
        <?php
        $db = "iteh_lb1_v0";
        $author = $_POST['author'];
        try {
            $sql = "SELECT $db.literature.name FROM $db.literature INNER JOIN $db.book_authors ON $db.book_authors.FID_Book=$db.literature.ID_Book INNER JOIN $db.authors ON $db.book_authors.FID_Authors=$db.authors.ID_Authors WHERE $db.authors.name=:author";
            $sth = $dbh->prepare($sql);
            $sth->execute(array(':author' => $author));
            $timetable = $sth->fetchAll(PDO::FETCH_NUM);
            print "<table border ='1'>";
            print " <tr><td><b>Назва</td></tr>";
            foreach ($timetable as $row) {
                print " <tr><td>$row[0]</td></tr>";
            }
        } catch (PDOException $e) {
            die("Error!:" . $e->getMessage() . "<br>");
        }
        ?>
        <input type="button" value="Back" onclick="history.back();return false;" />
    </body>
</html>