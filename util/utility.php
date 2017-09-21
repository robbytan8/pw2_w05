<?php

function createMySQLConnection() {
    $link = mysqli_connect("localhost", "robby_pwl20171", "robby_pwl20171",
            "pwl20171", "3306") or die(mysqli_connect_error());
    mysqli_autocommit($link, FALSE);
    return $link;
}
