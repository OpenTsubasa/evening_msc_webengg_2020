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
                                <?php } else if (isset($_SESSION['customer'])) { ?>
                                    <div class="general">
                                        You are already a registered customer.
                                    </div>
                                <?php } ?>
                                <?php if ((!isset($successmessage)) && (!isset($_SESSION['customer']))) { ?>
                                    <div class="general">
                                        <form id="register" action="controller.php?page=processregistration" method="post" accept-charset="UTF-8">
                                            <fieldset>
                                                <legend>Register</legend>
                                                <hr>
                                                <table border="0">
                                                    <tr>
                                                        <td><label for="name">Your Name*: </label></td>
                                                        <td><input type="text" name="name" id="name" maxlength="50" required="required" placeholder="Your Full Name" value="<?php if (isset($_POST['name'])) echo $_POST['name']; ?>"/></td>
                                                    </tr>
                                                    <tr>
                                                        <td><label for="email">Email Address*: </label></td>
                                                        <td><input type="email" name="email" id="email" maxlength="50" required="required" placeholder="ex: abc@xyz.com" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>"/></td>
                                                    </tr>
                                                    <tr>
                                                        <td><label for="password" >Password*: </label></td>
                                                        <td><input type="password" name="password" id="password" maxlength="50" required="required" placeholder="A Strong Password"/></td>
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