<style>
/* About Us Page Background */
    #about-us .aboutus-container{
        background-image: url("../images/au-bg.png");
        background-repeat: no-repeat;
        background-size: cover;
        background-position: 50% 50%;
    }

/* About Us Page Top Button */
    #about-us .top-btn{
        display: flex;
        list-style-type: none;
        padding: 50px 10px;
    }

    #about-us ul.top-btn a {
        font-size: 18px;
        color: #797979;
        line-height: 50px;
        text-decoration: none;
    }

    @media only screen and (min-width: 677px) {
    #about-us li.btn-01{
        width: 150px;
        height: 50px;
        text-align: center;
        border: 1px solid #fff;
        border-radius: 10px 0px 0px 10px;
        background-color: #fff;
        border-right: 1px solid #eee; 
    }
    }
    #about-us li.btn-02{
        width: 150px;
        height: 50px;
        text-align: center;
        border: 1px solid #fff;
        border-radius: 0px 10px 10px 0px;
    }

    #about-us li.btn-02 a {
        color: #fff !important;
    }

/* About Us Page Content */
    #about-us .aboutus-content {
        max-width: 1150px;
        margin: auto;   
    }

    #about-us h5.au-title {
        font-size: 24px;
        font-weight: 900;
        color: #fff;
        padding-bottom: 20px;
    }

    #about-us .col-lg-12.col-sm-12 p {
        font-size: 14px;
        color: #fff;
        padding-bottom: 10px;
    }

    #about-us h5.au-title-02 {
        font-size: 24px;
        font-weight: 900;
        color: #fff;
        padding-top: 25px;
        padding-bottom: 20px;
    }

    #about-us .row.aboutus-wrapper {
        padding-bottom: 150px;
    }


/* Mobile Page */
    @media only screen and (max-width: 676px) {
        /* About Us Page Background */
        #about-us .aboutus-container{
            background-image: url("../images/au-m-bg.png");
            background-repeat: no-repeat;
            background-size: cover;
            background-position: 50% 50%;
        }

        #about-us li.btn-01{
            width: 97px;
            height: 30px;
            text-align: center;
            border: 1px solid #fff;
            border-radius: 10px 0px 0px 10px;
            background-color: #fff;
            border-right: 1px solid #eee;
        }

        #about-us li.btn-02 a {
        color: #fff !important;
        }

        #about-us li.btn-02{
            width: 97px;
            height: 30px;
            text-align: center;
            border: 1px solid #fff;
            border-radius: 0px 10px 10px 0px;
        }
        
        #about-us ul.top-btn a{
            line-height: inherit;
        }
        
        #about-us ul.top-btn a {
            font-size: 14px;
            color: #797979;
        }

        #about-us .top-btn {
            display: flex;
            list-style-type: none;
            padding: 25px 10px;
            padding-bottom: 10px;
        }

        #about-us h5.au-title {
            font-size: 14px;
            font-weight: 900;
            color: #fff;
            padding-bottom: 20px;
        }

        #about-us .col-lg-12.col-sm-12 p {
            font-size: 12px;
            color: #fff;
            padding-bottom: 0px;
        }

        #about-us .col-lg-12.col-sm-12 {
            padding: 0px 0px;
        }
        
        #about-us h5.au-title-02 {
            font-size: 12px;
            font-weight: 900;
            color: #fff;
            padding-top: 15px;
            padding-bottom: 10px;
        }

        #about-us .row.aboutus-wrapper {
            padding-bottom: 50px;
        }

    /* Full Page Padding */
        #about-us .row.aboutus-wrapper .col-lg-9.col-sm-12 {
            padding: 0px;
        }

        #about-us .col-lg-3.col-sm-12 {
            padding: 0px;
        }


    }

    

</style>

<!doctype html>
    <html>
        <?php include('global/html_head.php'); ?>

<body id="about-us">

<?php $au = 1;?>

        <?php include('global/header.php'); ?>


<!-- About Us Page Background & Top Button -->
    <div class="container-fluid aboutus-container">
        <div class="d-flex justify-content-center">
            <ul class="top-btn">
                <li class="btn-01"><a href="../sc/about_us.php">走进华泰</a></li>
                <li class="btn-02"><a href="../sc/about_us_02.php">集团公司介绍</a></li>
            </ul>
        </div>
<!-- About Us Page Content -->
    <div class="container aboutus-content">
        <div class="row aboutus-wrapper">
            <div class="col-lg-12 col-sm-12">
                <h5 class="au-title">华泰（香港）期货有限公司</h5>
                <p>华泰（香港）期货有限公司是华泰期货根据中国证监会批复，于2015年在香港特别行政区注册成立。于2016年9月14日，华泰（香港）期货获得香港证监会正式批核（中央编号为
                   BHE003），获准展开规管第2类（期货合约交易）及第5类（就期货合约提供意见）业务。</p>
                <p>华泰（香港）期货为个人、机构客户提供24小时不间断的全球市场交易服务，以专业人才团队为依托，为客户创造优质的服务，致力于
                   境内外业务互联互通模式探索，打造中资在港期货服务机构核心竞争优势。</p>
            </div>

            <div class="col-lg-12 col-sm-12">
                <h5 class="au-title-02">华泰期货有限公司</h5>
                <p>华泰期货有限公司成立于1994年3月28日，是华泰证券（股票代码：601688.SH，6886.HK）控股子公司，目前注册资本16.09亿元，主营业务为商品期货经纪、金融期货经纪、期货投资
                   咨询、资产管理、基金销售。华泰期货是中国首批成立的期货公司之一及全国首批获得投资咨询、资产管理、风险管理子公司业务创新试点的期货公司之一，是中国期货业协会理事会会员、
                   中国金融期货交易所全面结算会员、国内三大商品交易所会员以及上海国际能源交易中心的会员。</p>
                <p>华泰期货在全国设立了北京、上海、深圳、广州、成都、大连、郑州、杭州、南京9家分公司，41家营业部，同时依托华泰证券遍布全国各地的270家营业网点，形成了覆盖全国的服务网络。
                   旗下设立风险管理子公司华泰长城资本管理有限公司（注册资本6.5亿元）、华泰长城投资管理有限公司（注册资本5.5亿元），以及华泰长城国际贸易有限公司，华泰（香港）期货有限公司
                   ，华泰金融美国公司。 </p>
            </div>

        </div>
    </div>


</div>

    













  
</body>

<?php include('global/footer.php'); ?>

</html>