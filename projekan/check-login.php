<?php
    session_start();
    include 'config.php';

if (isset($_POST['username']) && isset($_POST['password'])) :

    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql_check = "SELECT username, level_user, id, status password FROM _user WHERE username=? AND password=? LIMIT 1";
    $check_log = $con->prepare($sql_check);
    $check_log->bind_param('ss',$username,$password);
    $check_log->execute();
    $check_log->store_result();   

    if ($check_log->num_rows == 1) :
        $check_log->bind_result($username, $level_user, $id, $status);

        while ($check_log->fetch()) :
            $_SESSION['user_login'] = $level_user;
            $_SESSION['sess_id'] = $id;
            $_SESSION['nama'] =$username;
            $_SESSION['status']=$status;
         endwhile;
       
        if($_SESSION['status'] == 'f') :
            $sql_status = "UPDATE _user SET status = 't' WHERE username =?";
            $check_status = $con->prepare($sql_status);
            $check_status->bind_param('s',$username);
            $check_status->execute();
            if ($level_user == "admin") :
                header("location: on-".$level_user."/testadmin.php");
            else :
                header("location: on-".$level_user);
                exit();
            endif;
            $check_status->close();
        else:
            header("location: login.php");
        endif;
    else :
        header("location: login.php?error=".base64_encode("Username dan Password Invalid!!!"));
        exit();
    endif;
        $check_log->close();
else :
    header("location: login.php");
    exit();
endif;
?>