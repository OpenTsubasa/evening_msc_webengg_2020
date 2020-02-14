        <section id="content">
            <div class="main_container">
                <div class="grid_2">
                    <div class="box">
                        <div class="box1">
                            <div class="wrapper">
                                <?php if (isset($message)) { ?>
                                    <div class="general">
                                        <?=$message?>
                                    </div>
                                <?php } else { ?>
                                    <div class="general">
                                        <h2>Your Name</h2>
                                        <hr>
                                        <p><?=$_SESSION['customer']['cname']?></p>
                                        <br><br>
                                        <h2>Your Registered Email</h2>
                                        <hr>
                                        <p><?=$_SESSION['customer']['cemail']?></p>
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