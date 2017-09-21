<?php
$submitPressed = filter_input(INPUT_POST, "btnSubmit");
if (isset($submitPressed)) {
    $email = filter_input(INPUT_POST, "txtEmail", FILTER_SANITIZE_EMAIL);
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $password = filter_input(INPUT_POST, "txtPassword",
                FILTER_SANITIZE_SPECIAL_CHARS);
        $password = md5($password);
        $arrResult = login($email, $password);
        if (!empty($arrResult)) {
            $_SESSION['approved_user'] = TRUE;
            $_SESSION['user_name'] = $arrResult['name'];
            $_SESSION['role'] = $arrResult['role'];
            header('location:index.php');
        } else {
            $errString = 'Invalid email or password';
        }
    } else {
        $errString = 'Invalid email format';
    }
}
?>

<div class="err_message">
<?php echo $errString; ?>
</div>

<form method="POST">
    <fieldset>
        <legend>Login Form</legend>
        <label for="txtEmailId">Email</label>
        <input id="txtEmailId" name="txtEmail" type="email" placeholder="Email" autofocus="" required="" >
        <br>
        <label for="txtPasswordId">Password</label>
        <input id="txtPasswordId" name="txtPassword" type="password" placeholder="Password" required="" >
        <br>
        <input name="btnSubmit" value="Login" type="submit" >
    </fieldset>
</form>