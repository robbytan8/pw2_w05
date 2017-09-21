<?php

function getAllCategoryFromDb() {
    $link = createMySQLConnection();
    $query = "SELECT * FROM category";
    $result = mysqli_query($link, $query) or die(mysqli_error($link));
    mysqli_close($link);
    return $result;
}

function getCategoryFromDb($id) {
    $link = createMySQLConnection();
    $query = "SELECT * FROM category WHERE id = ? LIMIT 1";
    if ($stmt = mysqli_prepare($link, $query)) {
        mysqli_stmt_bind_param($stmt, 'i', $id);
        mysqli_stmt_execute($stmt) or die(mysqli_error($link));
        mysqli_stmt_bind_result($stmt, $returnId, $returnName);
        mysqli_stmt_fetch($stmt);
        $result = array('id' => $returnId, 'name' => $returnName);
        mysqli_stmt_close($stmt);
    }
    mysqli_close($link);
    return $result;
}

function addNewCategory($name) {
    $link = createMySQLConnection();
    $query = "INSERT INTO category(name) VALUES(?)";
    if ($stmt = mysqli_prepare($link, $query)) {
        //  s for string, i for int, d for double, b for blob
        mysqli_stmt_bind_param($stmt, "s", $name);
        mysqli_stmt_execute($stmt) or die(mysqli_error($link));
        mysqli_commit($link);
        mysqli_stmt_close($stmt);
    }
    mysqli_close($link);
}

function deleteCategory($id) {
    $link = createMySQLConnection();
    $query = "DELETE FROM category WHERE id = ?";
    if ($stmt = mysqli_prepare($link, $query)) {
        //  s for string, i for int, d for double, b for blob
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt) or die(mysqli_error($link));
        mysqli_commit($link);
        mysqli_stmt_close($stmt);
    }
    mysqli_close($link);
}

function updateCategory($id, $name) {
    $link = createMySQLConnection();
    $query = "UPDATE category SET name = ? WHERE id = ?";
    if ($stmt = mysqli_prepare($link, $query)) {
        //  s for string, i for int, d for double, b for blob
        mysqli_stmt_bind_param($stmt, "si", $name, $id);
        mysqli_stmt_execute($stmt) or die(mysqli_error($link));
        mysqli_commit($link);
        mysqli_stmt_close($stmt);
    }
    mysqli_close($link);
}

function login($email, $password) {
    $link = createMySQLConnection();
    $query = "SELECT u.name, r.name AS role_name FROM user u JOIN role r WHERE u.email = ? AND u.password = PASSWORD(?) LIMIT 1";
    if ($stmt = mysqli_prepare($link, $query)) {
        mysqli_stmt_bind_param($stmt, 'ss', $email, $password);
        mysqli_stmt_execute($stmt) or die(mysqli_error($link));
        mysqli_stmt_bind_result($stmt, $returnName, $roleName);
        mysqli_stmt_fetch($stmt);
        $result = array('name' => $returnName, 'role' => $roleName);
        mysqli_stmt_close($stmt);
    }
    mysqli_close($link);
    return $result;
}
