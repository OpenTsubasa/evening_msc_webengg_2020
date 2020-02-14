        <section id="content">
            <div class="main_container">
                <div class="grid_2">
                    <div class="box">
                        <div class="box1">
                            <div class="wrapper">
                                <div>
                                    <blockquote>
                                        <h1>Movie Trivia</h1>
                                        <hr>
                                        <p><?= $movie_trivia['movie-trivia'] ?></p>
                                    </blockquote>
                                </div>
                                <?php if (isset($_SESSION['customer'])) { ?>
                                    <div class="general">
                                        Welcome <b><?=$_SESSION['customer']['cname']?></b>!!!
                                        <hr>
                                    </div>
                                <?php } ?>
                                <div class="general">
                                    <h1>Movie Props</h1>
                                    <h3 class="green-accent">The world's leading vendor of original movie props &amp; costumes.</h3>
                                    <p>With our inventory of literally thousands of these unique artifacts, we're proud to offer you the chance to own the ultimate movie collectable - something that was actually used in the production of your favorite films.</p>
                                    <p>Come inside and see the wonders that await.</p>
                                    <p><a href="controller.php?page=aboutus"><b>Read more about us</b></a></p>
                                </div>
                            </div>
                        </div>
                        <?php include('../template/extrabodysection.php'); ?>
                    </div>
                </div>
                <div class="clear"></div>
            </div>
        </section>