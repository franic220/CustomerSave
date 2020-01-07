<?php include 'header.php'; ?>
<?php
    require_once('AdminUser.php');
    session_start();
    if(isset($_SESSION['AdminID'])){
        if($_SESSION['AdminID']->isAuthenticated()){
            session_write_close();
            header('Location:mailing_list.php');
        }
    }
    $missingFields = false;
    if(isset($_POST['submit'])){
        if(isset($_POST['username']) && isset($_POST['password'])){
            if($_POST['username'] == "" || $_POST['password'] == ""){
                $missingFields = true;
            } else {
                $adminID = new AdminUser();
                if(!$adminID->hasDbError()){
                    $username = $_POST['username'];
                    $password = $_POST['password'];
                    $adminID->adminAuthenticate($username, $password);
                    if($adminID->isAuthenticated()){
                        $_SESSION['AdminID'] = $adminID;

                        header('Location:mailing_list.php');
                    }
                    else {
                        echo "<span style=\"color: red;\" />Incorrect Username/Password, failed to authenticate!</span>"; 
                    }
                }
            }
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Week 12 Lecture</title>
    </head>
    <body>
        <!-- MESSAGES -->
        <?php
            
            if(isset($_POST['username']) //case user does not input password
            && empty($_POST['password'])){
             echo "<span style=\"color: red;\" />Please insert Password in order to login</span><br>"; 
            }
            
            if(empty($_POST['username']) //case user does not input username
            && isset($_POST['password'])){
             echo "<span style=\"color: red;\" />Please insert Username in order to login</span>"; 
            }
            //Authentication failed
            if(isset($websiteUser)){
                if(!$websiteUser->isAuthenticated()){
                    echo '<h3 style="color:red;">Login failed. Please try again.</h3>';
                }
            }
        ?>
        
        <form name="login" id="login" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
        <table>
            <tr>
                <td>Username:</td>
                <td><input type="text" name="username" id="username"></td>
            </tr>
            <tr>
                <td>Password:</td>
                <td><input type="password" name="password" id="password"></td>
            </tr>
            <tr>
                <td><input type="submit" name="submit" id="submit" value="Login"></td>
                <td><input type="reset" name="reset" id="reset" value="Reset"></td>
            </tr>
        </table>
        <?php include 'footer.php'; ?>
        </form>
    </body>
</html>