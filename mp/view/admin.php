        <section id="content">
            <div class="main_container">
                <div class="grid_2">
                    <div class="box">
                        <div class="box1">
                            <div class="wrapper">
                                <?php if (isset($successmessage)) { ?>
                                    <div class="general">
                                        <?=$successmessage?>
                                    </div>
                                    <hr>
                                <?php } ?>
                                <?php if (isset($_SESSION['admin'])) { ?>
                                    <div class="general">
                                        <h2>Details of the Registered Customers</h2>
                                        <div>
                                            <table>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Number of Liked Products</th>
                                                </tr>
                                                <?php foreach ($customers as $key => $value) { ?>
                                                    <tr>
                                                        <td><?=$value['cname']?></td>
                                                        <td><?=$value['cemail']?></td>
                                                        <td><?=$value['numberoflikedproducts']?></td>
                                                    </tr>
                                                <?php } ?>
                                            </table>
                                        </div>
                                        <a class="button" href="controller.php?page=adminlogout">Logout</a>
                                    </div>
                                <?php } ?>
                                <?php if ((!isset($successmessage)) && (!isset($_SESSION['admin']))) { ?>
                                    <div class="general">
                                        <form id="adminlogin" action="controller.php?page=adminlogin" method="post" accept-charset="UTF-8">
                                            <fieldset>
                                                <legend>Admin Login</legend>
                                                <hr>
                                                <table border="0">
                                                    <tr>
                                                        <td><label for="username">Username*: </label></td>
                                                        <td><input type="text" name="username" id="username" maxlength="50" required="required" placeholder="The Administrator Username" value="<?php if (isset($_POST['username'])) echo $_POST['username']; ?>"/></td>
                                                    </tr>
                                                    <tr>
                                                        <td><label for="password" >Password*: </label></td>
                                                        <td><input type="password" name="password" id="password" maxlength="50" required="required" placeholder="The Administrator Password"/></td>
                                                    </tr>
                                                </table>
                                                <input class="button" type="submit" name="submit" value="Submit" />
                                            </fieldset>
                                        </form>
                                        <?php if (isset($message)) { ?>
                                            <br><br><hr>
                                            <p><?=$message?></p>
                                        <?php } ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                        <?php include('../template/extrabodysection.php'); ?>
                    </div>
                </div>
                <div class="clear"></div>
            </div>
        </section>