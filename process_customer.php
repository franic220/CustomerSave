<?php include 'header.php'; ?>
<?php 
require_once('AdminUser.php');
session_start();
session_regenerate_id(false);
$admin = new AdminUser();
$authenticate=$admin;
date_default_timezone_set ( "Canada/Eastern");
$authenticate->updateLoginDate(date('Y-m-d')); 
$id = 1;
$authenticate->adminID($id);

if(isset($_SESSION['AdminID'])){
    if(!$_SESSION['AdminID']->isAuthenticated()){
       header('Location:userlogin.php'); 
    }
} else {
    header('Location:userlogin.php');
}
?>


<?php require_once('customerDAO.php');
 include 'header.php'; 
$cc = new customerDAO();
$id = $_GET['id']; //retrieve the customer id from the URL passed by the mailing_list.php page
$customer = $cc->getCustomer($id); //locate a single customer in the database
if ($customer){
?>

<!DOCTYPE html>
<html>
     <body>

     <h2> Delete Customer </h2>

     <form method="post" action="">
         <?php echo "<h5>Customer ID : ", $customer->getCustomerId(), "</h5>" ?>
         <?php echo "<h5>Customer Name : ", $customer->getCustomerName(), "</h5>" ?>
         <?php echo "<h4>Please select Delete in order to remove " , $customer->getCustomerName(), " from the database.</h4>";?>
         <input type="submit" name="delete" value="Delete">
         <br><br>
         </form>
         <?php

        if (isset($_POST['delete'])) {
            $cc->deleteCustomer($id); //provide the id as a parameter to the delete method
            echo $customer->getCustomerName(), " has been deleted from the database!<br><br>";
        }
    }else{
        echo "Error! Customer not found";
    }
    ?> 
          <h2> Update Customer </h2> 
          <?php echo "<h5>Customer ID : ", $customer->getCustomerId(), "</h5>" ?>
         <?php echo "<h5>Customer Name : ", $customer->getCustomerName(), "</h5>" ?>
         <?php echo "<h5>Customer Phone Number: ", $customer->getNumber(), "</h5>" ?>
         <?php echo "<h5>Customer Email Address : ", $customer->getEmail(), "</h5>" ?>
         <?php echo "<h5>Referrer : ", $customer->getRefer(), "</h5>" ?>
          <?php echo "<h4>Please select Update in order to alter " , $customer->getCustomerName(), " 's information in the database.</h4>";?>
        <form method="post" action="">
           Name:  <input type="text" name="name" size='40'><br>
           Phone: <input type="text" name="number" size='40'><br>
           Email : <input type="text" name="email" size='40'><br>
           <br>
           <tr>
                                <td>How did you hear<br> about us?</td>
                                <td>Newspaper<input type="radio" name="referrer" id="referralNewspaper" value="newspaper">
                                    Radio<input type="radio" name='referrer' id='referralRadio' value='radio'>
                                    TV<input type='radio' name='referrer' id='referralTV' value='TV'>
                                    Other<input type='radio' name='referrer' id='referralOther' value='other'> <br>
                                </td>
                </tr>                 
           <input type="submit" name="update" value="Confirm Update">&nbsp;&nbsp;<input type='reset' name="btnReset" id="btnReset" value="Reset Form"><br><br><br>
           <tr><input type="submit"name="logout" id="logout" value="Logout"></tr>
           <br><br>

            <a href="index.php">Back to main page</a>
            <br><br>
         </form>
         
         <?php
         //cases for updating customer info, error checking implemented if commmand does not execute
                        if(!empty($_POST['name']) &&
                            !empty($_POST['number']) &&
                            !empty($_POST['email']) &&
                            !empty($_POST['referrer'])&&
                            isset($_POST['update'])){
                               $result= $cc->editCustomer($customer->getCustomerId(), $_POST['name'], $_POST['number'], $_POST['email'], $_POST['referrer']);
                               if ($result == 1){
                                   echo "<span style=\"color: lime;\" />Update request successful!</span>";
                                   
                               } else {
                                echo "<span style=\"color: red;\" />Error! Faled to update customer information</span>"; 
                               }
                            }

                        if(!empty($_POST['name']) &&
                            empty($_POST['number']) &&
                            empty($_POST['email']) &&
                            empty($_POST['referrer'])&&
                            isset($_POST['update'])){
                               $result= $cc->editName($customer->getCustomerId(), $_POST['name']);
                               if ($result == 1){
                                   echo "<span style=\"color: lime;\" />Name update request successful!</span>";
                               } else {
                                echo "<span style=\"color: red;\" />Error! Faled to update customer name</span>"; 
                               }
                            }

                        if(empty($_POST['name']) &&
                            !empty($_POST['number']) &&
                            empty($_POST['email']) &&
                            empty($_POST['referrer'])&&
                            isset($_POST['update'])){
                               $result= $cc->editPhone($customer->getCustomerId(), $_POST['number']);
                               if ($result == 1){
                                   echo "<span style=\"color: lime;\" />Phone Number update request successful!</span>";
                               } else {
                                echo "<span style=\"color: red;\" />Error! Faled to update Phone Number</span>"; 
                               }
                            }

                        if(empty($_POST['name']) &&
                            empty($_POST['number']) &&
                            !empty($_POST['email']) &&
                            empty($_POST['referrer'])&&
                            isset($_POST['update'])){
                               $result= $cc->editEmail($customer->getCustomerId(), $_POST['email']);
                               if ($result == 1){
                                   echo "<span style=\"color: lime;\" />Email Address update request successful!</span>";
                               } else {
                                echo "<span style=\"color: red;\" />Error! Faled to update Email Address</span>"; 
                               }
                            }

                        if(empty($_POST['name']) &&
                            empty($_POST['number']) &&
                            empty($_POST['email']) &&
                            !empty($_POST['referrer'])&&
                            isset($_POST['update'])){
                               $result= $cc->editReferrer($customer->getCustomerId(), $_POST['referrer']);
                               if ($result == 1){
                                   echo "<span style=\"color: lime;\" />Referrer update request successful!</span>";
                               } else {
                                echo "<span style=\"color: red;\" />Error! Faled to update Referrer</span>"; 
                               }
                            }


                        if(!empty($_POST['name']) &&
                            !empty($_POST['number']) &&
                            empty($_POST['email']) &&
                            empty($_POST['referrer'])&&
                            isset($_POST['update'])){
                               $result= $cc->editNamePhone($customer->getCustomerId(), $_POST['name'], $_POST['number']);
                               if ($result == 1){
                                   echo "<span style=\"color: lime;\" />Update request successful!</span>";
                               } else {
                                echo "<span style=\"color: red;\" />Error! Faled to update customer information</span>"; 
                               }
                            }

                        if(!empty($_POST['name']) &&
                            empty($_POST['number']) &&
                            !empty($_POST['email']) &&
                            empty($_POST['referrer'])&&
                            isset($_POST['update'])){
                               $result= $cc->editNameEmail($customer->getCustomerId(), $_POST['name'], $_POST['email']);
                               if ($result == 1){
                                   echo "<span style=\"color: lime;\" />Update request successful!</span>";
                               } else {
                                echo "<span style=\"color: red;\" />Error! Faled to update customer information</span>"; 
                               }
                            }

                        if(!empty($_POST['name']) &&
                            empty($_POST['number']) &&
                            empty($_POST['email']) &&
                            !empty($_POST['referrer'])&&
                            isset($_POST['update'])){
                               $result= $cc->editNameReferrer($customer->getCustomerId(), $_POST['name'], $_POST['referrer']);
                               if ($result == 1){
                                   echo "<span style=\"color: lime;\" />Update request successful!</span>";
                               } else {
                                echo "<span style=\"color: red;\" />Error! Faled to update customer information</span>"; 
                               }
                            }

                        if(empty($_POST['name']) &&
                            !empty($_POST['number']) &&
                            !empty($_POST['email']) &&
                            empty($_POST['referrer'])&&
                            isset($_POST['update'])){
                               $result= $cc->editPhoneEmail($customer->getCustomerId(), $_POST['number'], $_POST['email']);
                               if ($result == 1){
                                   echo "<span style=\"color: lime;\" />Update request successful!</span>";
                               } else {
                                echo "<span style=\"color: red;\" />Error! Faled to update customer information</span>"; 
                               }
                            }

                        if(empty($_POST['name']) &&
                            !empty($_POST['number']) &&
                            empty($_POST['email']) &&
                            !empty($_POST['referrer'])&&
                            isset($_POST['update'])){
                               $result= $cc->editPhoneReferrer($customer->getCustomerId(), $_POST['number'], $_POST['referrer']);
                               if ($result == 1){
                                   echo "<span style=\"color: lime;\" />Update request successful!</span>";
                               } else {
                                echo "<span style=\"color: red;\" />Error! Faled to update customer information</span>"; 
                               }
                            }

                        if(empty($_POST['name']) &&
                            empty($_POST['number']) &&
                            !empty($_POST['email']) &&
                            !empty($_POST['referrer'])&&
                            isset($_POST['update'])){
                               $result= $cc->editEmailReferrer($customer->getCustomerId(), $_POST['email'], $_POST['referrer']);
                               if ($result == 1){
                                   echo "<span style=\"color: lime;\" />Update request successful!</span>";
                               } else {
                                echo "<span style=\"color: red;\" />Error! Faled to update customer information</span>"; 
                               }
                            }

                        if(!empty($_POST['name']) &&
                            !empty($_POST['number']) &&
                            !empty($_POST['email']) &&
                            empty($_POST['referrer'])&&
                            isset($_POST['update'])){
                               $result= $cc->editNamePhoneEmail($customer->getCustomerId(), $_POST['name'], $_POST['number'], $_POST['email']);
                               if ($result == 1){
                                   echo "<span style=\"color: lime;\" />Update request successful!</span>";
                               } else {
                                echo "<span style=\"color: red;\" />Error! Faled to update customer information</span>"; 
                               }
                            }

                        if(!empty($_POST['name']) &&
                            !empty($_POST['number']) &&
                            empty($_POST['email']) &&
                            !empty($_POST['referrer'])&&
                            isset($_POST['update'])){
                               $result= $cc->editNamePhoneReferrer($customer->getCustomerId(), $_POST['name'], $_POST['number'], $_POST['referrer']);
                               if ($result == 1){
                                   echo "<span style=\"color: lime;\" />Update request successful!</span>";
                               } else {
                                echo "<span style=\"color: red;\" />Error! Faled to update customer information</span>"; 
                               }
                            }

                        if(!empty($_POST['name']) &&
                            empty($_POST['number']) &&
                            !empty($_POST['email']) &&
                            !empty($_POST['referrer'])&&
                            isset($_POST['update'])){
                               $result= $cc->editNameEmailReferrer($customer->getCustomerId(), $_POST['name'], $_POST['email'], $_POST['referrer']);
                               if ($result == 1){
                                   echo "<span style=\"color: lime;\" />Update request successful!</span>";
                               } else {
                                echo "<span style=\"color: red;\" />Error! Faled to update customer information</span>"; 
                               }
                            }

                        if(empty($_POST['name']) &&
                            !empty($_POST['number']) &&
                            !empty($_POST['email']) &&
                            !empty($_POST['referrer'])&&
                            isset($_POST['update'])){
                               $result= $cc->editPhoneEmailReferrer($customer->getCustomerId(), $_POST['number'], $_POST['email'], $_POST['referrer']);
                               if ($result == 1){
                                   echo "<span style=\"color: lime;\" />Update request successful!</span>";
                               } else {
                                echo "<span style=\"color: red;\" />Error! Faled to update customer information</span>"; 
                               }
                            }



                        if(empty($_POST['name']) &&
                            empty($_POST['number']) &&
                            empty($_POST['email']) &&
                            empty($_POST['referrer'])&&
                            isset($_POST['update'])){
                             echo "<span style=\"color: red;\" />Error! Faled to update customer information</span> <br>"; 
                             echo "Please select one of the provided fields to update ", $customer->getCustomerName(), "'s records <br> <br>";

                            }

                        if (isset($_POST['logout'])) { //user has clicked the Logout button
                                header('Location:userlogout.php'); 
                            }

            ?>  
        <br><br><br><br>
    </body>
    <?php include 'footer.php'; ?>
</html>

