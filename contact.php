<?php include 'header.php'; ?>
<?php require_once('customerAbstractDAO.php'); ?>
<?php require_once('customerDAO.php'); ?>



                <div id="menuItems">
                </div>
            </nav>
            <div id="content" class="clearfix">
                <aside>
                        <h2>Mailing Address</h2>
                        <h3>1385 Woodroffe Ave<br>
                            Ottawa, ON K4C1A4</h3>
                        <h2>Phone Number</h2>
                        <h3>(613)727-4723</h3>
                        <h2>Fax Number</h2>
                        <h3>(613)555-1212</h3>
                        <h2>Email Address</h2>
                        <h3>info@wpeatery.com</h3>
                </aside>
                <div class="main">
                    <h1>Sign up for our newsletter</h1>
                    <p>Please fill out the following form to be kept up to date with news, specials, and promotions from the WP eatery!</p>
                    <form name="frmNewsletter" id="frmNewsletter" method="post" action="http://localhost:7331/Week12Lab/contact.php" enctype="multipart/form-data">
                        <table>
                        
                            <tr>
                                <td>Name:</td>
                                <td><input type="text" name="customerName" id="customerName" size='40'></td> 
                                <td>
                                <?php 
                                 if (isset($_POST['customerName'])&& 
                                empty($_POST['customerName'])){  //case user does not input Name
                                    echo "<span style=\"color: red;\" />Please insert customer name in order to submit</span>"; 
                                }
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Phone Number:</td>
                                <td><input type="text" name="phoneNumber" id="phoneNumber" size='40'></td>
                                <td>
                                <?php
                                 if(isset($_POST['phoneNumber']) &&
                                     empty($_POST['phoneNumber'])){ //case user does not input Phone Number
                                    echo "<span style=\"color: red;\" />Please insert a phone number in order to submit</span>"; 
                                 }
                                ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Email Address:</td>
                                <td><input type="text" name="emailAddress" id="emailAddress" size='40'>
                                <td>
                                <?php
                                   if(isset($_POST['emailAddress']) //case user does not input email
                                   && empty($_POST['emailAddress'])){
                                    echo "<span style=\"color: red;\" />Please insert email address in order to submit</span>"; 
                                   }

                                ?>
                                </td>
                            </tr>
                            <tr>
                                <td>How did you hear<br> about us?</td>
                                <td>Newspaper<input type="radio" name="referral" id="referralNewspaper" value="newspaper">
                                    Radio<input type="radio" name='referral' id='referralRadio' value='radio'>
                                    TV<input type='radio' name='referral' id='referralTV' value='TV'>
                                    Other<input type='radio' name='referral' id='referralOther' value='other'>
                                <td>
                                <?php
                                  if(isset($_POST['customerName']) &&
                                  isset($_POST['phoneNumber']) &&
                                  isset($_POST['emailAddress']) &&
                                  empty($_POST['referral'])){ //case user has not selected a referrer option
                                  echo "<span style=\"color: red;\" />Please select one of the referral options to continue</span>"; 
                                  }
                                ?>
                                </td>
                               
                            </tr>
                            <?php
                            if(!empty($_POST['customerName']) &&
                            !empty($_POST['phoneNumber']) &&
                            !empty($_POST['emailAddress']) &&
                            !empty($_POST['referral'])){            
                              $cDAO = new CustomerDAO();
                              $customer = new Customer( $_POST['customerName'], $_POST['phoneNumber'], $_POST['emailAddress'], $_POST['referral']);
                              $newCustomer = $cDAO->addCustomer($customer); //all user information  has been verified, thus input the information into the database
                                
                           }
                            ?>
                            <tr>
                            <td>Choose a file to upload:</td>
                            </tr>

                            <tr>
                             <td colspan='2'><input type="file" name="upload" id="upload">
                             </td>
                             </tr>
                            <tr>
                                <td colspan='2'><input type='submit' name='btnSubmit' id='btnSubmit' value='Sign up!'>&nbsp;&nbsp;<input type='reset' name="btnReset" id="btnReset" value="Reset Form"></td>
                            </tr>
                        </table>
                    </form>
                    <?php                    
                             if( !empty($_POST['customerName']) &&
                             !empty($_POST['phoneNumber']) &&
                             !empty($_POST['emailAddress']) &&
                             !empty($_POST['referral'])&&  
                             isset($_POST['btnSubmit'])) {
                                       $upload = $_FILES['upload']['name']; 
                                       $fileTmpName = $_FILES['upload']['tmp_name']; 
                                      $result= move_uploaded_file($fileTmpName, "files/".$upload);
                                      if ($result){
                                          echo "<span style=\"color: lime;\" />Your file has been successfully uploaded!</span>";
                                      }
                             } 
                             
                             ?>
                </div><!-- End Main -->
            </div><!-- End Content -->
            <?php include 'footer.php'; ?>
                                       
                             

                         
