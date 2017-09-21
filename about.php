<?php
$submitPressed = filter_input(INPUT_POST, "btnSubmit");
if ($submitPressed) {
    $email = filter_input(INPUT_POST, "txtName");
    echo 'Hello, ' . $email;
}
?>

<form action="" method="post">
    <label for="idTxtName">Your name</label>
    <input id="idTxtName" name="txtName" type="text" autofocus="" placeholder="Your Name" required="">
    <br>
    <input type="submit" name="btnSubmit" value="Submit Data">
</form>