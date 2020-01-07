<?php include 'header.php'; ?>
            <div id="content" class="clearfix">
                <aside>
                        <?php
                        date_default_timezone_set ( "Canada/Eastern"); //set timezone for date
                        ?>
                        <h2><?php echo date('l'); //display date according to current day of the week?>'s Specials</h2> 
                        <?php include 'menuItem.php'; 
                        $star="";
                        $options = Array(); // intialize new array
                        $i=0;
                        while($i < 4){
                            $star.="*";
                            if($i % 2 == 0){
                              $options[$i] = new menuItem("The WP Burger$star".($i+1), "Freshly made all-beef patty served up with homefries -", 14);
                               //use public getters to access private fields from menuItem class, initializes two instances
                              $option1 = $options[$i]->getItemName();
                              $option2 = $options[$i]->getDescription();
                              $option3 = $options[$i]->getPrice();
                            }
                             if ($i %2 > 0){
                                $options[$i] = new menuItem("WP Kebabs$star".($i+1), "Tender cuts of beef and chicken, served with your choice of side -", 17);
                                //use public getters to access private fields from menuItem class, initializes two instances
                               $options12 = $options[$i]->getItemName();
                               $options22 = $options[$i]->getDescription();
                               $options32 = $options[$i]->getPrice();
                           }
                         $i++;                                     
                        }
                        
                        ?>
                        <hr>
                        <img src="images/burger_small.jpg" alt="Burger" title="Monday's Special - Burger">
                        <h3>The WP Burger</h3>
                        <?php
                        //Display details of first object 
                         echo $options[0]->getItemName();
                         echo "<br>";
                         echo $options[0]->getDescription();
                         echo "<br>";
                         echo "$";
                         echo $options[0]->getPrice();
                         ?>

                        <hr>
                        <img src="images/kebobs.jpg" alt="Kebobs" title="WP Kebobs">
                        <h3>WP Kebabs</h3>
                        <?php
                        //display details of second object
                        echo $options[1]->getItemName();
                        echo "<br>";
                        echo $options[1]->getDescription();
                        echo "<br>";
                        echo "$";
                        echo $options[1]->getPrice();
                        ?>

                         <hr>
                        <img src="images/burger_small.jpg" alt="Burger" title="Monday's Special - Burger">
                        <h3>The WP Burger</h3>

                         <?php
                         echo "$option1 <br> $option2 <br>$$option3 <br>"; //display details of third object
                        ?>
                        <hr>
                        <img src="images/kebobs.jpg" alt="Kebobs" title="WP Kebobs">
                        <h3>WP Kebabs</h3>
                        <?php
                        echo "$options12 <br> $options22 $$options32 <br>"; //display details of fourth object 
                         ?>
                        <hr>
                    
                </aside>
                <div class="main">
                    <h1>Welcome</h1>
                    <img src="images/dining_room.jpg" alt="Dining Room" title="The WP Eatery Dining Room" class="content_pic">
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>
                    <h2>Book your Christmas Party!</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>
                </div><!-- End Main -->
            </div><!-- End Content -->
            <?php include 'footer.php'; ?>
