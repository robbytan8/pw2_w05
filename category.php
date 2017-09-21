<?php
$command = filter_input(INPUT_GET, 'c', FILTER_SANITIZE_SPECIAL_CHARS);
if (isset($command) && $command == 'rem') {
    $urlId = filter_input(INPUT_GET, 'tod', FILTER_SANITIZE_SPECIAL_CHARS);
    deleteCategory($urlId);
}

$submitPressed = filter_input(INPUT_POST, "btnSubmit");
if (isset($submitPressed)) {
    $email = filter_input(INPUT_POST, "txtCatName", FILTER_SANITIZE_SPECIAL_CHARS);
    addNewCategory($email);
}
?>

<form action="" method="post">
    <fieldset>
        <legend>Category Form</legend>
        <label for="idTxtCatName">Category name</label>
        <input id="idTxtCatName" name="txtCatName" type="text" autofocus="" placeholder="New Category Name" required="">
        <br>
        <input type="submit" name="btnSubmit" value="Submit Data">
    </fieldset>
</form>

<?php
$result = getAllCategoryFromDb();
echo '<table id="tableId" class="display">';
echo '<thead>';
echo '<tr>';
echo '<th>ID</th>';
echo '<th>Name</th>';
echo '<th>Action</th>';
echo '</tr>';
echo '</thead>';
echo '<tbody>';
while ($row = mysqli_fetch_assoc($result)) {
    echo '<tr>';
    echo '<td>' . $row['id'] . '</td>';
    echo '<td>' . $row['name'] . '</td>';
    echo '<td>' . '<button onclick="sendToUpdate(\'' . $row['id'] . '\');"><img src="images/row_edit.png" alt="Update Image"></button>'
    . ' '
    . '<button onclick="sendToDelete(\'' . $row['id'] . '\');"><img src="images/row_delete.png" alt="Delete Image"></button>' . '</td>';
    echo '</tr>';
}
echo '</tbody>';
echo '</table>';
?>