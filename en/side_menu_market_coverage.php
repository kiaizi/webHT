<style>
    div#side-menu button.btn.btn-link.collapsed {
        padding: 5px 0px 5px 0px;
        text-align: left;
    }

    div#side-menu button.btn.btn-link {
        text-align: left;
    }

</style>
<!-- 业务覆盖-侧边栏-EN editFiles-Henry-202301  -->

<div id="side-menu" class="col-lg-3 col-12 pt-lg-5">
    <div class="accordion" id="accordionExample">

        <!-- One -->
        <div class="card">
            <div class="card-header" id="headingOne">
                <h2 class="mb-0">
                    <button class="btn btn-link <?php if ($trading_market_category_id == 1) { ?>collapsed<?php } ?>"
                            type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false"
                            aria-controls="collapseOne">
                        China Market
                    </button>
                </h2>
            </div>

            <!-- One ~ Body -->
            <div id="collapseOne" class="collapse <?php if ($trading_market_category_id == 1) { ?>show<?php } ?>"
                 aria-labelledby="headingOne" data-parent="#accordionExample">
                <div class="card-body">
                    <ul class="nav flex-column">


                        <?php

                        $sql = "select trading_market.*, trading_market_desc.name as name, trading_market_desc.detail, trading_market_desc.detail2  from " . TB_TRADING_MARKET . " as trading_market , " . TB_TRADING_MARKET_DESC . " as trading_market_desc ";
                        $sql .= " where ";
                        $sql .= " trading_market.id=trading_market_desc.trading_market_id ";
                        $sql .= " and trading_market_desc.language_id='" . CURRENT_LANG . "' ";
                        $sql .= " and trading_market.disabled='0' ";
                        // ibBusi-part
                        $sql .= " and trading_market.remark!='ibBusi' ";
                        $sql .= " and trading_market.trading_market_category_id='1' ";
                        $sql .= "  order by  trading_market.sort_order asc";


                        $rows2 = $G_DB_CONNECT->query($sql);
                        $total_record = $G_DB_CONNECT->affected_rows;
                        if ($G_DB_CONNECT->affected_rows > 0) {
                            ?>
                            <?php
                            $k = 0;
                            while ($data = $G_DB_CONNECT->fetch_array($rows2)) {
                                $k++;
                                $trading_market_id = $data['id'];
                                $trading_market_name = nl2br($data['name']);
                                $trading_market_detail = displayHTML($data['detail']);
                                $trading_market_detail2 = displayHTML($data['detail2']);


                                $link = 'market_coverage_detail.php?id=' . $trading_market_id;


                                ?>
                                <li class="nav-item">
                                    <a class="nav-link <?php if ($trading_market_id == ID) { ?>active<?php } ?>"
                                       href="<?php echo $link; ?>"><span><?php echo $trading_market_name; ?></span></a>
                                </li>
                                <?php

                            }
                            ?>
                            <?php
                        }


                        ?>

                    </ul>
                </div>
            </div>
        </div>

        <!-- Two -->
        <div class="card">
            <div class="card-header" id="headingTwo">
                <h2 class="mb-0">
                    <button class="btn btn-link <?php if ($trading_market_category_id == 2) { ?>collapsed<?php } ?>"
                            type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false"
                            aria-controls="collapseTwo">
                        Hong Kong & Global<br>Market
                    </button>
                </h2>
            </div>

            <!-- Two ~ Body -->
            <div id="collapseTwo" class="collapse <?php if ($trading_market_category_id == 2) { ?>show<?php } ?>"
                 aria-labelledby="headingTwo" data-parent="#accordionExample">
                <div class="card-body">
                    <ul class="nav flex-column">


                        <?php

                        $sql = "select trading_market.*, trading_market_desc.name as name, trading_market_desc.detail, trading_market_desc.detail2  from " . TB_TRADING_MARKET . " as trading_market , " . TB_TRADING_MARKET_DESC . " as trading_market_desc ";
                        $sql .= " where ";
                        $sql .= " trading_market.id=trading_market_desc.trading_market_id ";
                        $sql .= " and trading_market_desc.language_id='" . CURRENT_LANG . "' ";
                        $sql .= " and trading_market.disabled='0' ";
                        $sql .= " and trading_market.trading_market_category_id='2' ";
                        $sql .= "  order by  trading_market.sort_order asc";


                        $rows2 = $G_DB_CONNECT->query($sql);
                        $total_record = $G_DB_CONNECT->affected_rows;
                        if ($G_DB_CONNECT->affected_rows > 0) {
                            ?>
                            <?php
                            $k = 0;
                            while ($data = $G_DB_CONNECT->fetch_array($rows2)) {
                                $k++;
                                $trading_market_id = $data['id'];
                                $trading_market_name = nl2br($data['name']);
                                $trading_market_detail = displayHTML($data['detail']);
                                $trading_market_detail2 = displayHTML($data['detail2']);


                                $link = 'market_coverage_detail.php?id=' . $trading_market_id;


                                ?>
                                <li class="nav-item">
                                    <a class="nav-link <?php if ($trading_market_id == ID) { ?>active<?php } ?>"
                                       href="<?php echo $link; ?>"><span><?php echo $trading_market_name; ?></span></a>
                                </li>
                                <?php

                            }
                            ?>
                            <?php
                        }


                        ?>


                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Three -->
        <div class="card">
            <div class="card-header" id="headingThree">
                <h2 class="mb-0">
                    <button class="btn btn-link <?php if (IN_API == 1) { ?>collapsed<?php } ?>" type="button"
                            data-toggle="collapse" data-target="#collapseThree" aria-expanded="true"
                            aria-controls="collapseThree">
                        Quantatitive & Program Trading
                    </button>
                </h2>
            </div>

            <!-- Two ~ Body -->
            <div id="collapseThree" class="collapse <?php if (IN_API == 1) { ?>show<?php } ?>"
                 aria-labelledby="headingThree" data-parent="#accordionExample">
                <div class="card-body">
                    <ul class="nav flex-column">


                        <?php

                        $sql = "select trading_support.*, trading_support_desc.name as name, trading_support_desc.detail, trading_support_desc.detail2  from " . TB_TRADING_SUPPORT . " as trading_support , " . TB_TRADING_SUPPORT_DESC . " as trading_support_desc ";
                        $sql .= " where ";
                        $sql .= " trading_support.id=trading_support_desc.trading_support_id ";
                        $sql .= " and trading_support_desc.language_id='" . CURRENT_LANG . "' ";
                        $sql .= " and trading_support.disabled='0' ";

                        $sql .= "  order by  trading_support.sort_order asc";


                        $rows2 = $G_DB_CONNECT->query($sql);
                        $total_record = $G_DB_CONNECT->affected_rows;
                        if ($G_DB_CONNECT->affected_rows > 0) {
                            ?>
                            <?php
                            $k = 0;
                            while ($data = $G_DB_CONNECT->fetch_array($rows2)) {
                                $k++;
                                $trading_support_id = $data['id'];
                                $trading_support_name = nl2br($data['name']);
                                $trading_support_detail = displayHTML($data['detail']);
                                $trading_support_detail2 = displayHTML($data['detail2']);


                                ?>
                                <li class="nav-item">
                                    <a class="nav-link <?php if ($trading_support_id == ID) { ?>active<?php } ?>"
                                       href="market_coverage_API.php?id=<?php echo $trading_support_id; ?>"><span><?php echo $trading_support_name; ?></span></a>
                                </li>


                                <?php

                            }
                            ?>
                            <?php
                        }


                        ?>


                    </ul>
                </div>
            </div>
        </div>
        <!-- Four ibBusi-->
        <div class="card">
            <div class="card-header" id="headingFour">
                <h2 class="mb-0">
                    <button class="btn btn-link <?php if ($trading_market_category_id == 4) { ?>collapsed<?php } ?>"
                            type="button" style="padding-right: 6px;" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false"
                            aria-controls="collapseFour">
                        Securities Interactive Brokers
                    </button>
                </h2>
            </div>

            <!-- Four ~ Body -->
            <div id="collapseFour" class="collapse <?php if ($trading_market_category_id == 4) { ?>show<?php } ?>"
                 aria-labelledby="headingFour" data-parent="#accordionExample">
                <div class="card-body">
                    <ul class="nav flex-column">
                        <?php

                        $sql = "select trading_market.*, trading_market_desc.name as name, trading_market_desc.detail, trading_market_desc.detail2  from " . TB_TRADING_MARKET . " as trading_market , " . TB_TRADING_MARKET_DESC . " as trading_market_desc ";
                        $sql .= " where ";
                        $sql .= " trading_market.id=trading_market_desc.trading_market_id ";
                        $sql .= " and trading_market_desc.language_id='" . CURRENT_LANG . "' ";
                        $sql .= " and trading_market.disabled='0' ";
                        // ibBusi-part
                        $sql .= " and trading_market.remark='ibBusi' ";
                        //                        $sql .= " and trading_market.trading_market_category_id='4' ";
                        $sql .= "  order by  trading_market.sort_order asc";


                        $rows2 = $G_DB_CONNECT->query($sql);
                        $total_record = $G_DB_CONNECT->affected_rows;
                        if ($G_DB_CONNECT->affected_rows > 0) {
                            ?>
                            <?php
                            $k = 0;
                            while ($data = $G_DB_CONNECT->fetch_array($rows2)) {
                                $k++;
                                $trading_market_id = $data['id'];
                                $trading_market_name = nl2br($data['name']);
                                $trading_market_detail = displayHTML($data['detail']);
                                $trading_market_detail2 = displayHTML($data['detail2']);


                                $link = 'market_coverage_detail.php?id=' . $trading_market_id;


                                ?>
                                <li class="nav-item">
                                    <a class="nav-link <?php if ($trading_market_id == ID) { ?>active<?php } ?>"
                                       href="<?php echo $link; ?>"><span><?php echo $trading_market_name; ?></span></a>
                                </li>
                                <?php

                            }
                            ?>
                            <?php
                        }


                        ?>

                    </ul>
                </div>
            </div>
        </div>

    </div>
</div>