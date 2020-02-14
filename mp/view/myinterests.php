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
                                    <div>
                                        <table>
                                            <tr>
                                                <th>Name</th>
                                                <th>Cost</th>
                                                <th>Availability</th>
                                                <th>Date Liked</th>
                                            </tr>
                                            <?php foreach ($customerinterests as $key => $value) { ?>
                                                <tr>
                                                    <td><?=$value['pname']?></td>
                                                    <td>$<?=$value['pcost']?></td>
                                                    <td>
                                                        <?php
                                                            if ($value['pavailability'] == 1) {
                                                                echo "Availabile";
                                                            } else {
                                                                echo "Not Availabile";
                                                            }
                                                        ?>
                                                    </td>
                                                    <td><?=$value['pcdate']?></td>
                                                </tr>
                                            <?php } ?>
                                        </table>
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