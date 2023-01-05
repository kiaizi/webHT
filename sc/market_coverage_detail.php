<!doctype html>
<html>
<!-- 业务覆盖-详情页-中文 editFiles-Henry-202301  -->
<?php


include_once('global/global_header.php');

define("ID", getRequestVar('id', 0));
$sql = "select trading_market.*, trading_market_desc.name as name, trading_market_desc.detail, trading_market_desc.detail2, trading_market_desc.name2, trading_market_desc.other_name1, trading_market_desc.other_name2, trading_market_desc.other_name3, trading_market_desc.other_name4, trading_market_desc.other_name5, trading_market_desc.other_name6, trading_market_desc.other_detail1, trading_market_desc.other_detail2, trading_market_desc.other_detail3, trading_market_desc.other_detail4, trading_market_desc.other_detail5, trading_market_desc.other_detail6, trading_market_desc.other3_detail, trading_market_desc.other3_name,  trading_market_desc.other3_name2, trading_market_desc.other3_name3, trading_market_desc.other3_name4, trading_market_desc.other3_name5, trading_market_desc.other3_name6, trading_market_desc.other3_name7, trading_market_desc.other3_name8, trading_market_desc.other2_name, trading_market_desc.other2_name2, trading_market_desc.other2_detail from " . TB_TRADING_MARKET . " as trading_market , " . TB_TRADING_MARKET_DESC . " as trading_market_desc ";
$sql .= " where ";
$sql .= " trading_market.id=trading_market_desc.trading_market_id ";
$sql .= " and trading_market_desc.language_id='" . CURRENT_LANG . "' ";
$sql .= " and trading_market.disabled='0' ";

$sql .= " and trading_market.id='" . ID . "' ";

define('THIS_PAGE_SQL', $sql);
$rows = $G_DB_CONNECT->query($sql);
if ($G_DB_CONNECT->affected_rows > 0) {
    while ($data = $G_DB_CONNECT->fetch_array($rows)) {
        $trading_market_id = $data['id'];
        $trading_market_name = $data['name'];
        $trading_market_category_id = $data['trading_market_category_id'];
        $trading_market_detail = displayHTML($data['detail']);
        $_REQUEST['date'] = $data['display_date'];

        //if($meta_title == ''){
        $meta_title = $trading_market_name;
        $arr_seo_info['meta_title'] = $meta_title;
        //}

        //if($meta_desc == ''){
        $meta_desc = formatSEOInfo($trading_market_detail);
        $arr_seo_info['meta_desc'] = $meta_desc;


        $seo_keyword = $data['seo_keyword'];;
        if ($seo_keyword != '') {
            $arr_seo_info['meta_keyword'] = $seo_keyword;
        }
        //}

    }
} else {
    include("index.php");
    exit();
}

define('CID', $trading_market_category_id);

$img = '';
$sql = "select img from " . TB_TRADING_MARKET_PHOTO;
$sql .= " where  ";
$sql .= " disabled='0' ";
$sql .= " and trading_market_id='" . ID . "' ";
//$sql .= " and language_id='".CURRENT_LANG."' ";
$sql .= " order by sort_order asc limit 0,1  ";
$rowsp = $G_DB_CONNECT->query($sql);
if ($G_DB_CONNECT->affected_rows > 0) {
    while ($datap = $G_DB_CONNECT->fetch_array($rowsp)) {
        $img = $datap['img'];
        $arr_data = getThumbPhotoPath($img, "thumb", 250, 250);

        $og_image = OUR_SERVER . $arr_data['img_path'];
    }
}


include_once('global/html_head.php');


?>

<?php $a = 3;
$b = 3; ?>
<body id="mc-SHFE">

<?php include('global/header.php'); ?>

<style>
    #mc-SHFE .bsl-content {
        display: flex;
    }

    #mc-SHFE .bsl-left {
        width: 60%;
        padding: 0px 15px 0px 0px;

    }

    #mc-SHFE .bsl-right {
        width: 40%;
    }

    #mc-SHFE img.mc-shfe-img {
        width: 100%;
    }


    #op_ac_step td, #collapse_1 td {
        padding: 5px 10px;
        border: 1px solid #ADADAD;
    }

    #shfe_collapse .btn-link {
        background-color: #ADADAD;
        border-radius: 25px;
        color: white;
        text-decoration: none;
        font-weight: bold;
        padding: 10px 20px;
    }

    #shfe_collapse .card-body {
        padding: 10px 20px;
        color: #797979;
    }

    #shfe_collapse .card {
        padding: 5px 0;
        border: 0px;
    }

    #shfe_collapse .btn-link:after {
        content: "\2212";
        color: white;
        font-weight: bold;
        float: right;
        margin-left: 5px;
        font-size: 20px;
        line-height: 20px;
    }

    #mc-SHFE .rtb-col {
        height: 94px;
        padding: 30px 0px;
    }

    span.text_bottom_line {
        color: #797979;
    }

    #market_hkex_table td {
        border: 1px solid #adadad;
        border-top: 0;
        padding: 10px 20px;
        color: #797979;
        font-size: 14px;
    }

    li {
        color: #797979;
    }


    @media only screen and (max-width: 767px) {
        #mc-SHFE .bsl-content {
            display: block;
        }

        #mc-SHFE .bsl-left {
            width: 100%;
            padding: 0px 15px 0px 0px;

        }

        #mc-SHFE .bsl-right {
            width: 100%;
        }

    }

    #shfe_collapse .btn-link.collapsed:after {
        content: '\002B';
    }

    @media only screen and (max-width: 767px) {
        .mc-SHFE-img-m {
            width: 80px;
        }

        .mc-SHFE-img-m2 {
            width: 90px;
        }

        #mc-SHFE th.mdtb-col-02 {
            top: 118px;
        }

        #mc-SHFE th.mdtb-col-03 {
            top: 188px;
        }

        #mc-SHFE th.mdtb-col-04 {
            top: 259px;
        }

        #mc-SHFE th.mdtb-col-05 {
            top: 330px;
        }


    }


    @media only screen and (max-width: 464px) {

        #op_ac_step td, #collapse_1 td {
            font-size: 12px;
        }

        #shfe_collapse .btn-link {
            font-size: 14px;
        }

        #shfe_collapse .card-body {
            font-size: 12px;
        }

        img.mc-SHFE-img-m {
            width: 85px;
        }

        img.mc-SHFE-img-m2 {
            width: 91px;
        }

        #mc-SHFE th.mdtb-col-01 {
            font-size: 12px;
            font-weight: normal;
            position: absolute;
            top: 51px;
        }

        #mc-SHFE th.mdtb-col-02 {
            font-size: 12px;
            font-weight: normal;
            position: absolute;
            top: 123px;
        }

        #mc-SHFE th.mdtb-col-03 {
            font-size: 12px;
            font-weight: normal;
            position: absolute;
            top: 198px;
        }

        #mc-SHFE th.mdtb-col-04 {
            font-size: 12px;
            font-weight: normal;
            position: absolute;
            top: 272px;
        }

        #mc-SHFE th.mdtb-col-05 {
            font-size: 12px;
            font-weight: normal;
            position: absolute;
            top: 346px;
        }

        #mc-SHFE th.mdtb-col-06 {
            font-size: 12px;
            font-weight: normal;
            position: absolute;
            top: 417px;
        }

        #mc-SHFE th.mdtb-col-07 {
            font-size: 12px;
            font-weight: normal;
            position: absolute;
            top: 489px;
        }

    }


    #normal_table td {
        padding: 5px 10px;
        border: 1px solid #ADADAD;
    }

    #normal_table td {
        font-size: 12px;
    }

</style>
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

<!-- News PDF Page Banner & Title -->
<div class="container-fluid contactus-container" style="padding: 0;">
    <img src="<?php echo $banner; ?>" class="img-fluid" style="width: 100%;">
</div>

<!-- News PDF Page Content -->
<div class="container">
    <div class="row">

        <!-- News PDF Page Content - Left Side - 左侧边栏 -->
        <?php include('side_menu_market_coverage.php'); ?>


        <?php


        $rows = $G_DB_CONNECT->query(THIS_PAGE_SQL);
        if ($G_DB_CONNECT->affected_rows > 0) {
            while ($data = $G_DB_CONNECT->fetch_array($rows)) {
                $trading_market_id = $data['id'];
                $trading_market_name = $data['name'];
                $trading_market_name2 = $data['name2'];
                $trading_market_date = formatDate($data['display_date']);

                $trading_market_detail = (displayHTML($data['detail']));
                $trading_market_category_id = $data['trading_market_category_id'];
//                $trading_market_category_id = $data['trading_market_category_id'];
                //$trading_market_category_name = getLangName(TB_TRADING_MARKET_CATEGORY,"name",$trading_market_category_id,CURRENT_LANG);
                if ($trading_market_category_id == 1) {
                    $trading_market_category_name = '中国市场';
                } else if ($trading_market_category_id == 2) {
                    $trading_market_category_name = '香港及海外市场';
                }


                $trading_market_other3_detail = (displayHTML($data['other3_detail']));
                $trading_market_detail2 = (displayHTML($data['detail2']));


                $trading_market_other3_name = nl2br($data['other3_name']);

                $trading_market_other3_name2 = nl2br($data['other3_name2']);
                $trading_market_other3_name3 = nl2br($data['other3_name3']);
                $trading_market_other3_name4 = nl2br($data['other3_name4']);
                $trading_market_other3_name5 = nl2br($data['other3_name5']);
                $trading_market_other3_name6 = nl2br($data['other3_name6']);
                $trading_market_other3_name7 = nl2br($data['other3_name7']);
                $trading_market_other3_name8 = nl2br($data['other3_name8']);


                $trading_market_other2_name = nl2br($data['other2_name']);
                $trading_market_other2_name2 = nl2br($data['other2_name2']);
                $trading_market_other2_detail = (displayHTML($data['other2_detail']));


                $trading_market_other_name1 = nl2br($data['other_name1']);
                $trading_market_other_name2 = nl2br($data['other_name2']);
                $trading_market_other_name3 = nl2br($data['other_name3']);
                $trading_market_other_name4 = nl2br($data['other_name4']);
                $trading_market_other_name5 = nl2br($data['other_name5']);

                $trading_market_other_detail1 = displayHTML($data['other_detail1']);
                $trading_market_other_detail2 = displayHTML($data['other_detail2']);
                $trading_market_other_detail3 = displayHTML($data['other_detail3']);
                $trading_market_other_detail4 = displayHTML($data['other_detail4']);
                $trading_market_other_detail5 = displayHTML($data['other_detail5']);
            }
        }
        ?>


        <!-- News PDF Page Content - Right Side -->
        <div class="col-lg-9 col-12 pt-lg-3 pl-lg-5">
            <div class="col-12 mt-2 mb-2">
<!--                --><?php
//                } else {
//                    ?>
                <span class="head_sction_link">业务覆盖 > <?php echo $trading_market_category_name; ?> > <span
                            style="border-bottom: 2px solid #D93A16;"><?php echo $trading_market_name; ?></span></span>
            </div>
            <div class="col-12 pb-3">
                <div class="market_title_1"><?php echo $trading_market_name; ?></div>
                <?php
                if ($trading_market_name2 != '') {
                    ?>
                    <div class="market_title_1_sub"><?php echo $trading_market_name2; ?></div>
                    <?php
                }
                ?>
                <div class="box_st_line"></div>


                <?php
                $img = '';
                $sql = "select img from " . TB_TRADING_MARKET_PHOTO03;
                $sql .= " where  ";
                $sql .= " disabled='0' ";
                $sql .= " and trading_market_id='" . ID . "' ";
                //$sql .= " and language_id='".CURRENT_LANG."' ";
                $sql .= " order by sort_order asc  limit 0,1 ";
                $rowsp = $G_DB_CONNECT->query($sql);
                if ($G_DB_CONNECT->affected_rows > 0) {
                    while ($datap = $G_DB_CONNECT->fetch_array($rowsp)) {

                        $img = DIR_PATH . $datap['img'];

                    }
                }

                if ($img != '') {
                    ?>
                    <div class="bsl-content">
                        <div class="bsl-left">

                            <?php echo $trading_market_detail; ?>

                        </div>
                        <div class="bsl-right">
                            <?php
                            $img = '';
                            $sql = "select img from " . TB_TRADING_MARKET_PHOTO03;
                            $sql .= " where  ";
                            $sql .= " disabled='0' ";
                            $sql .= " and trading_market_id='" . ID . "' ";
                            //$sql .= " and language_id='".CURRENT_LANG."' ";
                            $sql .= " order by sort_order asc   ";
                            $rowsp = $G_DB_CONNECT->query($sql);
                            if ($G_DB_CONNECT->affected_rows > 0) {
                                while ($datap = $G_DB_CONNECT->fetch_array($rowsp)) {

                                    $img = DIR_PATH . $datap['img'];


                                    ?>

                                    <p><img src="<?php echo $img; ?>" alt="" class="mc-shfe-img"></p>


                                    <?php
                                }
                            }
                            ?>
                        </div>
                    </div>

                    <?php
                } else {
                    ?>

                    <div style="width: 100%; overflow-x: scroll;" class="pt-3 pb-3 second">
                        <?php echo $trading_market_detail; ?>

                    </div>

                    <?php
                }
                ?>


                <?php echo $trading_market_detail2; ?>

            </div>
            <div class="col-12 pb-3">

                <div class="accordion" id="shfe_collapse">

                    <?php
                    if ($trading_market_other_name1 != '') {
                        ?>
                        <div class="card">
                            <div class="card-header mc-SHFE" id="headingOne">
                                <h2 class="mb-0">
                                    <button class="btn btn-link btn-block text-left collapsed" type="button"
                                            data-toggle="collapse" data-target="#collapse_1" aria-expanded="false"
                                            aria-controls="collapse_1">
                                        <?php echo $trading_market_other_name1; ?>
                                    </button>
                                </h2>
                            </div>

                            <div id="collapse_1" class="collapse" aria-labelledby="headingOne"
                                 data-parent="#shfe_collapse">
                                <div class="card-body">
                                    <div style="width: 100%; overflow-x: scroll;">

                                        <?php echo $trading_market_other_detail1; ?>

                                    </div>

                                </div>
                            </div>
                        </div>

                        <?php
                    }
                    ?>
                    <?php
                    if ($trading_market_other_name2 != '') {
                        ?>
                        <div class="card">
                            <div class="card-header  mc-SHFE" id="heading2">
                                <h2 class="mb-0">
                                    <button class="btn btn-link btn-block text-left collapsed" type="button"
                                            data-toggle="collapse" data-target="#collapse2" aria-expanded="false"
                                            aria-controls="collapse2">
                                        <?php echo $trading_market_other_name2; ?>
                                    </button>
                                </h2>
                            </div>
                            <div id="collapse2" class="collapse" aria-labelledby="heading2"
                                 data-parent="#shfe_collapse">
                                <div class="card-body">
                                    <div style="width: 100%; overflow-x: scroll;">

                                        <?php echo $trading_market_other_detail2; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                    <?php
                    if ($trading_market_other_name3 != '') {
                        ?>
                        <div class="card">
                            <div class="card-header  mc-SHFE" id="heading-3">
                                <h2 class="mb-0">
                                    <button class="btn btn-link btn-block text-left collapsed" type="button"
                                            data-toggle="collapse" data-target="#collapse3" aria-expanded="false"
                                            aria-controls="collapse3">
                                        <?php echo $trading_market_other_name3; ?>
                                    </button>
                                </h2>
                            </div>
                            <div id="collapse3" class="collapse" aria-labelledby="heading-3"
                                 data-parent="#shfe_collapse">
                                <div class="card-body">
                                    <div style="width: 100%; overflow-x: scroll;">

                                        <?php echo $trading_market_other_detail3; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                    <?php
                    if ($trading_market_other_name4 != '') {
                        ?>
                        <div class="card">
                            <div class="card-header  mc-SHFE" id="heading4">
                                <h2 class="mb-0">
                                    <button class="btn btn-link btn-block text-left collapsed" type="button"
                                            data-toggle="collapse" data-target="#collapse_4" aria-expanded="false"
                                            aria-controls="collapse_4">
                                        <?php echo $trading_market_other_name4; ?>
                                    </button>
                                </h2>
                            </div>
                            <div id="collapse_4" class="collapse" aria-labelledby="heading4"
                                 data-parent="#shfe_collapse">
                                <div class="card-body">
                                    <div style="width: 100%; overflow-x: scroll;">

                                        <?php echo $trading_market_other_detail4; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                    <?php
                    if ($trading_market_other_name5 != '') {
                        ?>
                        <div class="card">
                            <div class="card-header  mc-SHFE" id="heading5">
                                <h2 class="mb-0">
                                    <button class="btn btn-link btn-block text-left collapsed" type="button"
                                            data-toggle="collapse" data-target="#collapse_5" aria-expanded="false"
                                            aria-controls="collapse_5">
                                        <?php echo $trading_market_other_name5; ?>
                                    </button>
                                </h2>
                            </div>
                            <div id="collapse_5" class="collapse" aria-labelledby="heading5"
                                 data-parent="#shfe_collapse">
                                <div class="card-body">
                                    <div style="width: 100%; overflow-x: scroll;">

                                        <?php echo $trading_market_other_detail5; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    ?>


                </div>


                <hr>


            </div>


            <?php
            if ($trading_market_other2_name != '') {
                ?>

                <div class="col-12 pb-3">
                    <div class="market_title_2"><?php echo $trading_market_other2_name; ?>：</div>
                    <p class="market_hkex_content_1"><?php echo $trading_market_other2_name2; ?></p>
                    <?php echo $trading_market_other2_detail; ?>
                </div>


                <?php
            }
            ?>



            <?php
            if ($trading_market_other3_name != '') {
                ?>

                <div class="col-12 pb-3">
                    <div class="market_title_2"><?php echo $trading_market_other3_name ?></div>
                    <div class="mc-SHFE-col">
                        <div class="mc-SHFE-col-01 col-lg-5">
                            <div class="ms-SHFE-left-tb">
                                <div class="ltb-col"><?php echo $trading_market_other3_name2 ?></div>
                                <div class="ltb-col"></div>
                                <div class="ltb-col"><?php echo $trading_market_other3_name4 ?></div>
                                <div class="ltb-col"></div>
                                <div class="ltb-col"><?php echo $trading_market_other3_name6 ?></div>
                                <div class="ltb-col"></div>
                                <div class="ltb-col"><?php echo $trading_market_other3_name8 ?></div>
                            </div>
                        </div>

                        <div class="mc-SHFE-col-02 col-lg-2">
                            <?php
                            if ($_GET['id'] == 3) {
                                ?>
                                <img src="../images/mc-SHFE-timeline.svg" class="mc-SHFE-img" width="120px">
                            <?php } else { ?>

                                <img src="../images/mc-SHFE-timeline-01.jpg" class="mc-SHFE-img" width="110px">

                            <?php } ?>

                        </div>

                        <div class="mc-SHFE-col-03 col-lg-5">
                            <div class="ms-SHFE-right-tb">
                                <div class="rtb-col"></div>
                                <div class="rtb-col"><?php echo $trading_market_other3_name3 ?></div>
                                <div class="rtb-col"></div>
                                <div class="rtb-col"><?php echo $trading_market_other3_name5 ?></div>
                                <div class="rtb-col"></div>
                                <div class="rtb-col"><?php echo $trading_market_other3_name7 ?></div>
                                <div class="rtb-col"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Mobile -->
                    <div class="mc-SHFE-col-md">
                        <table class="ms-SHFE-md-tb">
                            <tbody>
                            <tr>

                                <?php
                                if ($_GET['id'] == 3) {
                                    ?>
                                    <th rowspan="8" class="md-left-tb"><img src="../images/mc-SHFE-timeline.svg"
                                                                            class="mc-SHFE-img-m2"></th>
                                <?php } else { ?>

                                    <th rowspan="8" class="md-left-tb"><img src="../images/mc-SHFE-timeline-01.jpg"
                                                                            class="mc-SHFE-img-m"></th>
                                <?php } ?>


                                <th class="mdtb-col-01"><?php echo $trading_market_other3_name2 ?></th>
                            </tr>
                            <tr>
                                <th class="mdtb-col-02"><?php echo $trading_market_other3_name3 ?></th>
                            </tr>
                            <tr>
                                <th class="mdtb-col-03"><?php echo $trading_market_other3_name4 ?></th>
                            </tr>
                            <tr>
                                <th class="mdtb-col-04"><?php echo $trading_market_other3_name5 ?></th>
                            </tr>
                            <tr>
                                <th class="mdtb-col-05"><?php echo $trading_market_other3_name6 ?></th>
                            </tr>
                            <tr>
                                <th class="mdtb-col-06"><?php echo $trading_market_other3_name7 ?></th>
                            </tr>
                            <tr>
                                <th class="mdtb-col-07"><?php echo $trading_market_other3_name8 ?></th>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    </br>
                    <?php
                    if ($trading_market_other3_detail != '') {
                        ?>
                        <div class="mc-SHFE-link">
                            <?php echo $trading_market_other3_detail; ?>
                        </div>
                        <?php
                    }
                    ?>
                </div>
                <?php
            }
            ?>

        </div>

    </div>


    <!-- News PDF Page Content End -->
</div>
</div>


</body>

<?php include('global/footer.php'); ?>


</html>




