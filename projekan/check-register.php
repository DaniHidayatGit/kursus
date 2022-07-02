<?php
    session_start();
    include 'config.php';
    
    $username = $_POST['username'];
    $nama_depan = $_POST['first_name'];
    $nama_belakang = $_POST['last_name'];
    $email = $_POST['email'];
    $password1 = $_POST['password1'];
    $password2 = $_POST['password2'];
    
    if ($username == "admin") :
        $level_user = "admin";
    else :
        $level_user = "user";
    endif;

    $cek_ada_username = mysqli_num_rows(mysqli_query($con, "SELECT * FROM _user WHERE username = '$username' "));


    if ($cek_ada_username == 0) :
        if ($password1 != $password2) : 
            header("location: register.php");
        else :
            $check_username = "INSERT INTO data_user (username) VALUES ('$username')";
            $check_data = $con->prepare($check_username);
            
            $check_username1 = "INSERT INTO data_nilai (username) VALUES ('$username')";
            $check_data1 = $con->prepare($check_username1);

            $sql_check = "INSERT INTO _user (nama_depan, nama_belakang, username, password, email) VALUES ('$nama_depan', '$nama_belakang', '$username','$password1', '$email')";
            $check_log = $con->prepare($sql_check);

            $check = "SELECT username FROM _user WHERE username = '$username'";
            $check_reg = $con->prepare($check);

                    $check_reg->execute();
                            
                        if ($check_reg->fetch() != NULL) :
                            header("location: register.php");
                        else :
                            $check_data->execute();
                            $check_data1->execute();
                            $cek = $check_log->execute();
                            if ( $cek == true) :
                                $_SESSION['user_login'] = $level_user;
                                $_SESSION['nama'] = $username;
                                header("location: on-".$level_user);
                            endif;
                        endif;
        endif;  
    else :
        header("location: register.php");
    endif;
?>