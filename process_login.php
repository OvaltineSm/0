<?php

$open_connect = 1;
require('connect.php');

if(isset($_POST['email_account']) && isset($_POST['password_account'])) {
    $email_account = htmlspecialchars(mysqli_real_escape_string($connect, $_POST['email_account']));
    $password_account = htmlspecialchars(mysqli_real_escape_string($connect, $_POST['password_account']));

    if(empty($email_account) || empty($password_account)) {
        die(header("Location: form_login.php?error=empty_fields"));
        exit;
    } else {
        $query_check_email = "SELECT * FROM account WHERE email_account = '$email_account'";
        $call_back_query_check_email = mysqli_query($connect, $query_check_email);
        
        if(mysqli_num_rows($call_back_query_check_email) == 1) {
            $result_check_account = mysqli_fetch_assoc($call_back_query_check_email);
            $hash = $result_check_account['password_account'];
            $password_account = $password_account . $result_check_account['salt_account'];

            if(password_verify($password_account, $hash)) {
                if($result_check_account['role_account'] == 'member') {
                    die(header("Location: member.php"));
                    exit;
                }else if($result_check_account['role_account'] == 'admin') {
                    die(header("Location: admin.php"));
                    exit;

                }
            } else {
                die(header("Location: form_login.php?error=incorrect_password"));
                exit;
            }
        } else {
            die(header("Location: form_login.php?error=email_not_found"));
            exit;
        }
    }
} else {
    header("Location: form_login.php");
    exit;
}
?>