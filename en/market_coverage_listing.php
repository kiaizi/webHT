<!doctype html>
<html>
<!-- 业务覆盖-列表页面-EN editFiles-Henry-202301  -->
<?php include('global/html_head.php'); ?>

<body id="contact-us">
<?php include('global/header.php'); ?>

<!-- image-section -->

<?php
$banner = '';
$sql = "select img from " . TB_BANNER_PHOTO;
$sql .= " where  ";
$sql .= " disabled='0' ";
$sql .= " and banner_id=3 ";
//$sql .= " and language_id='".CURRENT_LANG."' ";
$sql .= " order by sort_order asc  limit 0,1 ";
$rowsp = $G_DB_CONNECT->query($sql);
if ($G_DB_CONNECT->affected_rows > 0) {
    while ($datap = $G_DB_CONNECT->fetch_array($rowsp)) {

        $banner = DIR_PATH . $datap['img'];
        $arr_data = getThumbPhotoPath($img, "img", 200, 200);
        $thumb = $arr_data['img_path'];
    }
}
?>


<img src="<?php echo $banner; ?>" width="100%" class="bottom_red_line">

<!-- 轉介紹業務-start -->
<!--ibBusi-part-->
<!--这部分需要设计，设计好了之后再进行展示-->
<div class="container">
    <div class="row">
        <div class="col-12 mt-5 mb-5">
            <div class="market_api_box">
                <div class="box_head" id="ibBusi">
                    <div class="box_head_title_1">Securities Interactive Brokers</div>

                </div>
                <?php

                //                $sql = "select trading_market.*, trading_market_desc.name as name, trading_market_desc.detail, trading_market_desc.name3 from " . TB_TRADING_MARKET . " as trading_market , " . TB_TRADING_MARKET_DESC . " as trading_market_desc ";
                $sql = "select trading_market.*, trading_market_desc.*, trading_market_desc.detail, trading_market_desc.name3 from " . TB_TRADING_MARKET . " as trading_market , " . TB_TRADING_MARKET_DESC . " as trading_market_desc ";
                $sql .= " where ";
                $sql .= " trading_market.id=trading_market_desc.trading_market_id ";
                $sql .= " and trading_market_desc.language_id='" . CURRENT_LANG . "' ";
                $sql .= " and trading_market.disabled='0' ";
                $sql .= " and trading_market.remark='ibBusi' ";
                $sql .= " and trading_market_category_id=4 ";
                $sql .= "  order by  trading_market.sort_order asc ";


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
                        //这里增加简介的内容，采用的是other2_detail的字段，对应到后台部分-开户文件内容 (簡)
//                        $trading_support_detail = displayHTML($data['detail']);
                        $trading_simple_detail = displayHTML($data['other_detail3']);
                        $link = 'market_coverage_detail.php?id=' . $trading_support_id;


                        ?>
                        <div class="box_content">
                            <!--                            <h2>--><?php //print_r($data); ?><!--</h2>-->
                        </div>

                        <div class="box_content">
                            <b><?php echo $trading_support_name; ?></b>
                            <div class="box_st_line"></div>
                            <!--                            --><?php //echo $trading_support_detail; ?>
                            <?php echo $trading_simple_detail; ?>
                        </div>

                        <div class="col-12 text-center p-3">
                            <a href="<?php echo $link; ?>">
                                <div class="know_more_btn_2">More&nbsp;&nbsp;<img
                                            src="../images/index/kw_more_arr.svg" height="25" class="img_mb_5"></div>
                            </a>
                        </div>


                        <?php
                    }
                }


                ?>


            </div>
        </div>
    </div>

</div>
<!-- 轉介紹業務-end -->


<div class="container">
    <div class="row">
        <div class="col-12 mt-5 mb-5">
            <div class="market_api_box">
                <div class="box_head" id="data">
                    <div class="box_head_title_1">Quantatitive & Program Trading</div>
                </div>


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

                        <div class="box_content">
                            <b><?php echo $trading_support_name; ?></b>
                            <div class="box_st_line"></div>
                            <?php echo $trading_support_detail2; ?>
                        </div>

                        <div class="col-12 text-center p-3">
                            <a href="market_coverage_API.php?id=<?php echo $trading_support_id; ?>">
                                <div class="know_more_btn_2">More&nbsp;&nbsp;<img src="../images/index/kw_more_arr.svg"
                                                                                  height="25" class="img_mb_5"></div>
                            </a>
                        </div>


                        <?php
                    }
                }


                ?>


            </div>
        </div>
    </div>

</div>

<div class="grey_bg">
    <div class="container" style="max-width: 90%;">

        <div class="tab row">
            <div class="col-lg-6 offset-lg-3 col-12 text-center mb-lg-5 mb-3 d-lg-block d-flex" id="mark_list">
                <button class="tablinks market_tab_title" onclick="openCity(event, 'market_all')"
                        <?php if ($_GET{'mcl'} == "") { ?>id="defaultOpen"<?php } ?>>All
                </button>
                <button class="tablinks market_tab_title" onclick="openCity(event, 'market_china')"
                        <?php if ($_GET{'mcl'} == "cn") { ?>id="defaultOpen"<?php } ?>>China Market
                </button>
                <button class="tablinks market_tab_title" onclick="openCity(event, 'market_hknothers')"
                        <?php if ($_GET{'mcl'} == "hk") { ?>id="defaultOpen"<?php } ?>>Hong Kong & Global Market
                </button>
            </div>
        </div>

        <div id="market_all" class="tabcontent">
            <div class="row">


                <?php


                $sql = "select trading_market.*, trading_market_desc.name as name, trading_market_desc.detail, trading_market_desc.name3 from " . TB_TRADING_MARKET . " as trading_market , " . TB_TRADING_MARKET_DESC . " as trading_market_desc ";
                $sql .= " where ";
                $sql .= " trading_market.id=trading_market_desc.trading_market_id ";

                $sql .= " and trading_market_desc.language_id='" . CURRENT_LANG . "' ";
                $sql .= " and trading_market.disabled='0' ";
                // ibBusi-part
                $sql .= " and trading_market.remark!='ibBusi' ";
                //$sql .= " and trading_market_category_id=1 ";


                $sql .= "  order by  trading_market.sort_order asc ";


                $rows = $G_DB_CONNECT->query($sql);
                $total_record = $G_DB_CONNECT->affected_rows;
                if ($G_DB_CONNECT->affected_rows > 0) {
                    ?>

                    <?php

                    while ($data = $G_DB_CONNECT->fetch_array($rows)) {

                        $trading_market_id = $data['id'];
                        $trading_market_date = formatDate($data['display_date']);

                        $trading_market_name = $data['name'];
                        $trading_market_name3 = nl2br($data['name3']);
                        $trading_market_detail = displayHTML($data['detail']);
                        $trading_market_detail = draftText2(200, $data['detail']);
                        $link = 'market_coverage_detail.php?id=' . $trading_market_id;

                        ?>

                        <?php
                        $img = '';
                        $sql = "select img from " . TB_TRADING_MARKET_PHOTO02;
                        $sql .= " where  ";
                        $sql .= " disabled='0' ";
                        $sql .= " and trading_market_id='" . $trading_market_id . "' ";
                        //$sql .= " and language_id='".CURRENT_LANG."' ";
                        $sql .= " order by sort_order asc  limit 0,1 ";
                        $rowsp = $G_DB_CONNECT->query($sql);
                        if ($G_DB_CONNECT->affected_rows > 0) {
                            while ($datap = $G_DB_CONNECT->fetch_array($rowsp)) {

                                $img = DIR_PATH . $datap['img'];
                                $arr_data = getThumbPhotoPath($img, "img", 200, 200);
                                $thumb = $arr_data['img_path'];
                            }
                        }
                        ?>
                        <div class="col-lg-4 col-6 text-center mb-lg-3 p-lg-2 p-1">
                            <a href="<?php echo $link; ?>">
                                <img src="<?php echo $img; ?>" width="100%">
                                <div class="market_tab_text"><?php echo $trading_market_name; ?></div>
                            </a>
                        </div>

                        <?php

                    }
                    ?>

                    <?php

                }
                ?>


            </div>
        </div>

        <div id="market_china" class="tabcontent">
            <div class="row">


                <?php


                $sql = "select trading_market.*, trading_market_desc.name as name, trading_market_desc.detail, trading_market_desc.name3 from " . TB_TRADING_MARKET . " as trading_market , " . TB_TRADING_MARKET_DESC . " as trading_market_desc ";
                $sql .= " where ";
                $sql .= " trading_market.id=trading_market_desc.trading_market_id ";
                $sql .= " and trading_market_desc.language_id='" . CURRENT_LANG . "' ";
                $sql .= " and trading_market.disabled='0' ";
                // ibBusi-part
                $sql .= " and trading_market.remark!='ibBusi' ";
                $sql .= " and trading_market_category_id=1 ";


                $sql .= "  order by  trading_market.sort_order asc ";


                $rows = $G_DB_CONNECT->query($sql);
                $total_record = $G_DB_CONNECT->affected_rows;
                if ($G_DB_CONNECT->affected_rows > 0) {
                    ?>

                    <?php

                    while ($data = $G_DB_CONNECT->fetch_array($rows)) {

                        $trading_market_id = $data['id'];
                        $trading_market_date = formatDate($data['display_date']);

                        $trading_market_name = $data['name'];
                        $trading_market_name3 = nl2br($data['name3']);
                        $trading_market_detail = displayHTML($data['detail']);
                        $trading_market_detail = draftText2(200, $data['detail']);
                        $link = 'market_coverage_detail.php?id=' . $trading_market_id;

                        ?>

                        <?php
                        $img = '';
                        $sql = "select img from " . TB_TRADING_MARKET_PHOTO02;
                        $sql .= " where  ";
                        $sql .= " disabled='0' ";
                        $sql .= " and trading_market_id='" . $trading_market_id . "' ";
                        //$sql .= " and language_id='".CURRENT_LANG."' ";
                        $sql .= " order by sort_order asc  limit 0,1 ";
                        $rowsp = $G_DB_CONNECT->query($sql);
                        if ($G_DB_CONNECT->affected_rows > 0) {
                            while ($datap = $G_DB_CONNECT->fetch_array($rowsp)) {

                                $img = DIR_PATH . $datap['img'];
                                $arr_data = getThumbPhotoPath($img, "img", 200, 200);
                                $thumb = $arr_data['img_path'];
                            }
                        }
                        ?>
                        <div class="col-lg-4 col-6 text-center mb-lg-3 p-lg-2 p-1">
                            <a href="<?php echo $link; ?>">
                                <img src="<?php echo $img; ?>" width="100%">
                                <div class="market_tab_text"><?php echo $trading_market_name; ?></div>
                            </a>
                        </div>

                        <?php

                    }
                    ?>

                    <?php

                }
                ?>
            </div>
        </div>

        <div id="market_hknothers" class="tabcontent">
            <div class="row">


                <?php


                $sql = "select trading_market.*, trading_market_desc.name as name, trading_market_desc.detail, trading_market_desc.name3 from " . TB_TRADING_MARKET . " as trading_market , " . TB_TRADING_MARKET_DESC . " as trading_market_desc ";
                $sql .= " where ";
                $sql .= " trading_market.id=trading_market_desc.trading_market_id ";
                $sql .= " and trading_market_desc.language_id='" . CURRENT_LANG . "' ";
                $sql .= " and trading_market.disabled='0' ";
                $sql .= " and trading_market_category_id=2 ";


                $sql .= "  order by  trading_market.sort_order asc ";


                $rows = $G_DB_CONNECT->query($sql);
                $total_record = $G_DB_CONNECT->affected_rows;
                if ($G_DB_CONNECT->affected_rows > 0) {
                    ?>

                    <?php

                    while ($data = $G_DB_CONNECT->fetch_array($rows)) {

                        $trading_market_id = $data['id'];
                        $trading_market_date = formatDate($data['display_date']);

                        $trading_market_name = $data['name'];
                        $trading_market_name3 = nl2br($data['name3']);
                        $trading_market_detail = displayHTML($data['detail']);
                        $trading_market_detail = draftText2(200, $data['detail']);
                        $link = 'market_coverage_detail.php?id=' . $trading_market_id;

                        ?>

                        <?php
                        $img = '';
                        $sql = "select img from " . TB_TRADING_MARKET_PHOTO02;
                        $sql .= " where  ";
                        $sql .= " disabled='0' ";
                        $sql .= " and trading_market_id='" . $trading_market_id . "' ";
                        //$sql .= " and language_id='".CURRENT_LANG."' ";
                        $sql .= " order by sort_order asc  limit 0,1 ";
                        $rowsp = $G_DB_CONNECT->query($sql);
                        if ($G_DB_CONNECT->affected_rows > 0) {
                            while ($datap = $G_DB_CONNECT->fetch_array($rowsp)) {

                                $img = DIR_PATH . $datap['img'];
                                $arr_data = getThumbPhotoPath($img, "img", 200, 200);
                                $thumb = $arr_data['img_path'];
                            }
                        }
                        ?>
                        <div class="col-lg-4 col-6 text-center mb-lg-3 p-lg-2 p-1">
                            <a href="<?php echo $link; ?>">
                                <img src="<?php echo $img; ?>" width="100%">
                                <div class="market_tab_text"><?php echo $trading_market_name; ?></div>
                            </a>
                        </div>

                        <?php

                    }
                    ?>

                    <?php

                }
                ?>


            </div>
        </div>

    </div>
</div>


<?php include('global/footer.php'); ?>


<script>
    function openCity(evt, cityName) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }
        document.getElementById(cityName).style.display = "block";
        evt.currentTarget.className += " active";
    }

    // Get the element with id="defaultOpen" and click on it
    document.getElementById("defaultOpen").click();
</script>
</body>

</html>