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
                                    <?php
                                        $counter = 0;
                                        foreach ($products as $key => $value) {
                                    ?>
                                        <div class="grid_1">
                                            <div class="indent">
                                                <div class="thinborder">
                                                    <h3><?=$value['pname']?></h3>
                                                    <figure class="p3"><img src="../images/products/<?=$value['pphoto']?>" alt="<?=$value['pphoto']?> image"></figure>
                                                    <div class="p2">
                                                        <hr>
                                                        <b>Cost:</b> $<?=$value['pcost']?>
                                                        <hr>
                                                        <b>Availability:</b> 
                                                        <?php
                                                            if ($value['pavailability'] == 1) {
                                                                echo "Availabile";
                                                            } else {
                                                                echo "Not Availabile";
                                                            }
                                                        ?>
                                                        <hr>
                                                        <b>Addingdate:</b> <?=$value['paddingdate']?>
                                                        <hr>
                                                        <b>Name:</b> <?=$value['mname']?>
                                                        <hr>
                                                        <b>Year:</b> <?=$value['myear']?>
                                                        <hr>
                                                        <b>Number of Likes:</b> <span id="numberoflikes<?=$value['pid']?>"><?=$value['numberoflikes']?></span>
                                                        <hr>
                                                    </div>
                                                    <?php if (!isset($_SESSION['customer'])) { ?>
                                                        <a class="button" href="controller.php?page=login">Like Me!!!</a>
                                                    <?php } else { ?>
                                                        <?php if ($customerinterests == null) { ?>
                                                            <div class="p2" id="likestatus<?=$value['pid']?>">
                                                                <hr>
                                                                <b>Like-Status:</b> Not-Liked
                                                                <hr>
                                                            </div>
                                                            <a class="button" id="<?=$value['pid']?>" href="controller.php?page=like" data-change="like">Like Me!!!</a>
                                                        <?php } else { ?>
                                                            <?php
                                                                $liked = false;
                                                                foreach ($customerinterests as $key2 => $value2) {
                                                                    if ($value['pid'] == $value2['pid']) {
                                                                        $liked = true;
                                                                        break;
                                                                    }
                                                                }
                                                            ?>
                                                            <?php if ($liked) { ?>
                                                                <div class="p2" id="likestatus<?=$value['pid']?>">
                                                                    <hr>
                                                                    <b>Like-Status:</b> Liked
                                                                    <hr>
                                                                </div>
                                                                <a class="button" id="<?=$value['pid']?>" href="controller.php?page=unlike" data-change="unlike">Un-Like :-(</a>
                                                            <?php } else { ?>
                                                                <div class="p2" id="likestatus<?=$value['pid']?>">
                                                                    <hr>
                                                                    <b>Like-Status:</b> Not-Liked
                                                                    <hr>
                                                                </div>
                                                                <a class="button" id="<?=$value['pid']?>" href="controller.php?page=like" data-change="like">Like Me!!!</a>
                                                            <?php } ?>
                                                        <?php } ?>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                            $counter++;
                                            if (($counter%3) == 0) {
                                                echo "<div class=\"clear\"></div><hr>";
                                            }
                                        }
                                    ?>
                                <?php } ?>
                            </div>
                        </div>
                        <?php include('../template/extrabodysection.php'); ?>
                    </div>
                </div>
                <div class="clear"></div>
            </div>
        </section>
        <script type="text/javascript">
            $(document).ready(function() {
                $('.button').click(function() {
                    var pid = $(this).attr('id');
                    var href = $(this).attr('href');
                    if (href.indexOf("login") >= 0) {
                        return true;
                    }
                    var data_change = $(this).attr('data-change');
                    $.ajax({
                        url: href,
                        data: {pid: pid},
                        type: 'post',
                        success: function(data) {
                            var parseddata = jQuery.parseJSON(data);
                            alert(parseddata.message);
                            if (data_change == 'like') {
                                $('#'+parseddata.pid).attr('href', 'controller.php?page=unlike');
                                $('#'+parseddata.pid).attr('data-change', 'unlike');
                                $('#'+parseddata.pid).html('Un-Like :-(');
                                $('#likestatus'+parseddata.pid).html('<hr><b>Like-Status:</b> Liked<hr>');
                                var numberoflikes = parseInt($('#numberoflikes'+parseddata.pid).html(), 10);
                                $('#numberoflikes'+parseddata.pid).html(numberoflikes+1);
                            } else {
                                $('#'+parseddata.pid).attr('href', 'controller.php?page=like');
                                $('#'+parseddata.pid).attr('data-change', 'like');
                                $('#'+parseddata.pid).html('Like Me!!!');
                                $('#likestatus'+parseddata.pid).html('<hr><b>Like-Status:</b> Not-Liked<hr>');
                                var numberoflikes = parseInt($('#numberoflikes'+parseddata.pid).html(), 10);
                                $('#numberoflikes'+parseddata.pid).html(numberoflikes-1);
                            }
                        }
                    });
                    return false;
                });
            });
        </script>