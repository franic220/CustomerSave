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
echo "Session AdminID = ", $authenticate->getAdminID(), "<br>";
echo "Last Login Date = ", $authenticate->getDate(), "<br>";
echo "Session ID = ",session_id();

if(isset($_SESSION['AdminID'])){
    if(!$_SESSION['AdminID']->isAuthenticated()){
       header('Location:userlogin.php'); 
    }
} else {
    header('Location:userlogin.php');
}
?>

<?php require_once('customerDAO.php');
$cD = new customerDAO();
$customers = $cD->getCustomers(); //retrieve all the customers contained in the database
?>
<!DOCTYPE html>
<html>
<head>
			<style>
				table {
				  margin-top:30px;
				}

		</style>
	</head>
     <title>
     <head> Display Customers </head>
     </title>

    <body>
      <form  name="listForm" id="listForm" method="post" action="">
        <div style="overflow-x:auto;">
        <table align="center" border="2px" style="width:900px; line-height:30px;">

            <t>
                <th> ID </th>
               <th> Customer Name </th>
               <th> Phone </th>
               <th width="60%"> Email</th>
               <th> Referrer </th>
               
               </t>
               <?php
        foreach($customers as $customer){ //enhanced for loop to read in and display all the customer information
            $viz = $customer->getCustomerId();
             echo"<tr>";
                 echo"<td><a href='process_customer.php?id=$viz'> $viz</a></td>"; //link each customer's id to process_customer.php, clicking the link signals a deletion request for the customer
                 echo"<td>". $customer->getCustomerName() . "</td>";
                 echo "<td>". $customer->getNumber() ."</td>";
                 echo"<td>". $customer->getEmail() ."</td>";
                 echo "<td>". $customer->getRefer() . "</td>";
        }
       
        ?>
        <tr><input type="submit"name="logout" id="logout" value="Logout"></tr>
        <?php
            if (isset($_POST['logout'])) { //user has clicked the Logout button
                header('Location:userlogout.php'); 
            }
        ?>
         
        </table>
        </div>
        </form>
        </body>
        <?php include 'footer.php'; ?>
        </html>



                 
   