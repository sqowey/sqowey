<?php
    file_put_contents('reports/report_site.csv', "Was passiert ist:".$_POST['fehler']."|Wie wir den Fehler reproduzieren können:".$_POST['reproduzieren']."|Was hätte passieren sollen:".$_POST['funktionsweise'] , FILE_APPEND | LOCK_EX);
?>