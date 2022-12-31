<style>
/* News PDF Testing Page Banner & Title */
  #news_pdf_testing .ctm-width {
    max-width: 1180px;
    margin: auto;
  }

  #news_pdf_testing .title-bg {
    background-color: #F6F6F6;
  }

  #news_pdf_testing .col-lg-12.ctm-width h3 {
    display: inline-block;
    font-size: 18px;
    color: #333333;
    padding: 10px 75px;
  }

  #news_pdf_testing span.square {
    border: 1px solid #D93A16;
    background-color: #D93A16;
    padding: 9px 5px;
    position: absolute;
    top: 9px;
    left: 70px;
  }

  /* News PDF Testing Page Content */
  #news_pdf_testing .container.news-pdf {
    max-width: 1025px;
    margin: 80px auto 100px auto;
    }

  /* News PDF Testing Page - Left Side */
    /* ~~~~~ Card Head ~~~~~ */
      #news_pdf_testing .card-header {
        padding: 0px;
        background-color: transparent;
        border: none;
      }

      #news_pdf_testing ul.left-side-link {
        font-size: 18px;
        color: #333;
        padding: 0px 0px;
        border-bottom: 1px solid #D93A16;
        padding-bottom: 3px;
      }

      ul.left-side-link::before {
        float: right;
        font-family: FontAwesome;
        content: "\f056";
        font-size: 18px;
        color: #D93A16;
      }

      #news_pdf_testing ul.left-side-link.collapsed::before {
        float: right !important;
        content:"\f055";
      }

    /* ~~~~~ Card Body ~~~~~ */
      #news_pdf_testing .card-body {
        padding: 0px;
      }

      #news_pdf_testing .list-group {
        border: 1px solid transparent;
        margin-top: -10px;
      }

      #news_pdf_testing .list-group-item {
      position: relative;
      display: block;
      border: none;
      color: #797979;
      font-size: 14px;
      padding: 3px 15px;
      }

      #news_pdf_testing .list-group-item.active::before {
        content: "";
        border: 1px solid #D93A16;
        background-color: #D93A16;
        padding: 0px 4px;
        margin-right: 5px;
      }

      #news_pdf_testing .list-group-item.active {
        z-index: 2;
        background-color: transparent;
        color: #797979;
        font-size: 14px;
        padding: 3px 0px 3px 0px;
      }
    
  /* News PDF Testing Page - Right Side */
      #news_pdf_testing .col-lg-9.col-12.right-side-list {
        padding: 70px 0px 15px 150px;
      }

      #news_pdf_testing .list-content {
        list-style: none;
        text-decoration: none;
        padding-bottom: 15px;
        padding-right: 15px;
      }

      #news_pdf_testing .list-c-text {
        border-bottom: 1px solid #707070;
        padding-bottom: 15px;
      }
      
      #news_pdf_testing span.rsl-text {
        font-size: 14px;
        color: #797979;
      }

      #news_pdf_testing span.rsl-red-text {
        font-size: 14px;
        color: #D93A16;
        float: right;
      }
      
      #news_pdf_testing img.rsl-img {
        padding-left: 10px;
        padding-right: 0px;
      }

  /* News PDF Testing Page - Overflow Scroll */
    #news_pdf_testing .tab-pane {
      overflow-y: scroll;
      height: 600px;
      border-radius: 20px;
    }

    /* ~~~~~ Overflow Scroll - Scrollbar ~~~~~ */
      #news_pdf_testing .tab-pane::-webkit-scrollbar {
        width: 5px;
      }
    
    /* ~~~~~ Overflow Scroll - Track ~~~~~ */
      #news_pdf_testing .tab-pane::-webkit-scrollbar-track {
        border: 1px solid #707070;
        background-clip: content-box;
        border-radius: 20px;
        background-color: #707070;
      }
    
    /* ~~~~~ Overflow Scroll - Track ~~~~~ */
    #news_pdf_testing .tab-pane::-webkit-scrollbar-thumb {
        background: #D93A16; 
        border-radius: 20px;
      }
















      







  


          
</style>

<!doctype html>
  <html>
    <?php include('global/html_head.php'); ?>

<body id="news_pdf_testing">

    <?php include('global/header.php'); ?>




<!-- News PDF Page Banner & Title -->
  <div class="container-fluid contactus-container" style="padding: 0;">
    <img src="../images/news_bg.jpg" class="img-fluid" style="width: 100%;">
  </div>

  <div class="contaniner-fluid">
    <div class="title-bg">
      <div class="col-lg-12 ctm-width"><span class="square"></span><h3>重要通告</h3></div>
    </div>
  </div>


<!-- News PDF Page Content -->
<div class="container news-pdf">
  <div class="row">

    <!-- News PDF Page Content - Left Side -->
        <div class="col-lg-3 col-12 left-side-list">
          <div class="accordion" id="accordionExample">

            <div class="card-header" id="headingOne">
                <ul class="left-side-link" type="" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                  新闻类别
                </ul>
            </div>

            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
              <div class="card-body">
                <div class="list-group" id="list-tab" role="tablist">
                  <a class="list-group-item list-group-item-action active" id="list-product-list" data-toggle="list" href="#list-product" role="tab" aria-controls="product"><span>新产品通告</span></a>
                  <a class="list-group-item list-group-item-action" id="list-exchange-list" data-toggle="list" href="#list-exchange" role="tab" aria-controls="exchange"><span>交易所通告</span></a>
                  <a class="list-group-item list-group-item-action" id="list-quotes-list" data-toggle="list" href="#list-quotes" role="tab" aria-controls="quotes"><span>行情通告</span></a>
                  <a class="list-group-item list-group-item-action" id="list-company-list" data-toggle="list" href="#list-company" role="tab" aria-controls="company"><span>公司通告</span></a>
                </div>
              </div>
            </div>

          </div>
        </div>

    <!-- News PDF Page Content - Right Side -->
      <div class="col-lg-9 col-12 right-side-list">
        <div class="tab-content" id="nav-tabContent">

        <!-- News PDF Page Content - Left Side - Column 1 ~ 新产品通告 -->
          <div class="tab-pane fade show active" id="list-product" role="tabpanel" aria-labelledby="list-product-list">
            <div class="list-content">
              <div class="list-c-text">
                <li><a href="..//pdf/20y2.pdf" download="20y2" ><span class="rsl-text">关于MSCI新产品上线通知</span><span class="rsl-red-text">点击此处下载<img src="../images/download.svg" alt="" class="rsl-img"></span></a></li>
              </div>
            </div>

            <div class="list-content">
              <div class="list-c-text">
                <li><a href="" download="" ><span class="rsl-text">关于MSCI新产品上线通知</span><span class="rsl-red-text">点击此处下载<img src="../images/download.svg" alt="" class="rsl-img"></span></a></li>
              </div>
            </div>

            <div class="list-content">
              <div class="list-c-text">
                <li><a href="" download="" ><span class="rsl-text">关于MSCI新产品上线通知</span><span class="rsl-red-text">点击此处下载<img src="../images/download.svg" alt="" class="rsl-img"></span></a></li>
              </div>
            </div>

            <div class="list-content">
              <div class="list-c-text">
                <li><a href="" download="" ><span class="rsl-text">关于MSCI新产品上线通知</span><span class="rsl-red-text">点击此处下载<img src="../images/download.svg" alt="" class="rsl-img"></span></a></li>
              </div>
            </div>

            <div class="list-content">
              <div class="list-c-text">
                <li><a href="" download="" ><span class="rsl-text">关于MSCI新产品上线通知</span><span class="rsl-red-text">点击此处下载<img src="../images/download.svg" alt="" class="rsl-img"></span></a></li>
              </div>
            </div>

            <div class="list-content">
              <div class="list-c-text">
                <li><a href="" download="" ><span class="rsl-text">关于MSCI新产品上线通知</span><span class="rsl-red-text">点击此处下载<img src="../images/download.svg" alt="" class="rsl-img"></span></a></li>
              </div>
            </div>

            <div class="list-content">
              <div class="list-c-text">
                <li><a href="" download="" ><span class="rsl-text">关于MSCI新产品上线通知</span><span class="rsl-red-text">点击此处下载<img src="../images/download.svg" alt="" class="rsl-img"></span></a></li>
              </div>
            </div>

            <div class="list-content">
              <div class="list-c-text">
                <li><a href="" download="" ><span class="rsl-text">关于MSCI新产品上线通知</span><span class="rsl-red-text">点击此处下载<img src="../images/download.svg" alt="" class="rsl-img"></span></a></li>
              </div>
            </div>

            <div class="list-content">
              <div class="list-c-text">
                <li><a href="" download="" ><span class="rsl-text">关于MSCI新产品上线通知</span><span class="rsl-red-text">点击此处下载<img src="../images/download.svg" alt="" class="rsl-img"></span></a></li>
              </div>
            </div>

            <div class="list-content">
              <div class="list-c-text">
                <li><a href="" download="" ><span class="rsl-text">关于MSCI新产品上线通知</span><span class="rsl-red-text">点击此处下载<img src="../images/download.svg" alt="" class="rsl-img"></span></a></li>
              </div>
            </div>

            <div class="list-content">
              <div class="list-c-text">
                <li><a href="" download="" ><span class="rsl-text">关于MSCI新产品上线通知</span><span class="rsl-red-text">点击此处下载<img src="../images/download.svg" alt="" class="rsl-img"></span></a></li>
              </div>
            </div>

            <div class="list-content">
              <div class="list-c-text">
                <li><a href="" download="" ><span class="rsl-text">关于MSCI新产品上线通知</span><span class="rsl-red-text">点击此处下载<img src="../images/download.svg" alt="" class="rsl-img"></span></a></li>
              </div>
            </div>

            <div class="list-content">
              <div class="list-c-text">
                <li><a href="" download="" ><span class="rsl-text">关于MSCI新产品上线通知</span><span class="rsl-red-text">点击此处下载<img src="../images/download.svg" alt="" class="rsl-img"></span></a></li>
              </div>
            </div>

            <div class="list-content">
              <div class="list-c-text">
                <li><a href="" download="" ><span class="rsl-text">关于MSCI新产品上线通知</span><span class="rsl-red-text">点击此处下载<img src="../images/download.svg" alt="" class="rsl-img"></span></a></li>
              </div>
            </div>

            <div class="list-content">
              <div class="list-c-text">
                <li><a href="" download="" ><span class="rsl-text">关于MSCI新产品上线通知</span><span class="rsl-red-text">点击此处下载<img src="../images/download.svg" alt="" class="rsl-img"></span></a></li>
              </div>
            </div>

            <div class="list-content">
              <div class="list-c-text">
                <li><a href="" download="" ><span class="rsl-text">关于MSCI新产品上线通知</span><span class="rsl-red-text">点击此处下载<img src="../images/download.svg" alt="" class="rsl-img"></span></a></li>
              </div>
            </div>

            <div class="list-content">
              <div class="list-c-text">
                <li><a href="" download="" ><span class="rsl-text">关于MSCI新产品上线通知</span><span class="rsl-red-text">点击此处下载<img src="../images/download.svg" alt="" class="rsl-img"></span></a></li>
              </div>
            </div>

            <div class="list-content">
              <div class="list-c-text">
                <li><a href="" download="" ><span class="rsl-text">关于MSCI新产品上线通知</span><span class="rsl-red-text">点击此处下载<img src="../images/download.svg" alt="" class="rsl-img"></span></a></li>
              </div>
            </div>

            <div class="list-content">
              <div class="list-c-text">
                <li><a href="" download="" ><span class="rsl-text">关于MSCI新产品上线通知</span><span class="rsl-red-text">点击此处下载<img src="../images/download.svg" alt="" class="rsl-img"></span></a></li>
              </div>
            </div>

            <div class="list-content">
              <div class="list-c-text">
                <li><a href="" download="" ><span class="rsl-text">关于MSCI新产品上线通知</span><span class="rsl-red-text">点击此处下载<img src="../images/download.svg" alt="" class="rsl-img"></span></a></li>
              </div>
            </div>
          </div>
    <!-- END OF !!!!!!!! News PDF Page Content - Left Side - Column 1 ~ 新产品通告 --> 


        <!-- News PDF Page Content - Left Side - Column 2 ~ 交易所通告 -->
          <div class="tab-pane fade" id="list-exchange" role="tabpanel" aria-labelledby="list-exchange-list">
            <div class="list-content">
              <div class="list-c-text">
                <li><a href="..//pdf/20y2.pdf" download="20y2" ><span class="rsl-text">关于MSCI新产品上线通知</span><span class="rsl-red-text">点击此处下载<img src="../images/download.svg" alt="" class="rsl-img"></span></a></li>
              </div>
            </div>

            <div class="list-content">
              <div class="list-c-text">
                <li><a href="" download="" ><span class="rsl-text">关于MSCI新产品上线通知</span><span class="rsl-red-text">点击此处下载<img src="../images/download.svg" alt="" class="rsl-img"></span></a></li>
              </div>
            </div>

            <div class="list-content">
              <div class="list-c-text">
                <li><a href="" download="" ><span class="rsl-text">关于MSCI新产品上线通知</span><span class="rsl-red-text">点击此处下载<img src="../images/download.svg" alt="" class="rsl-img"></span></a></li>
              </div>
            </div>

            <div class="list-content">
              <div class="list-c-text">
                <li><a href="" download="" ><span class="rsl-text">关于MSCI新产品上线通知</span><span class="rsl-red-text">点击此处下载<img src="../images/download.svg" alt="" class="rsl-img"></span></a></li>
              </div>
            </div>

            <div class="list-content">
              <div class="list-c-text">
                <li><a href="" download="" ><span class="rsl-text">关于MSCI新产品上线通知</span><span class="rsl-red-text">点击此处下载<img src="../images/download.svg" alt="" class="rsl-img"></span></a></li>
              </div>
            </div>

            <div class="list-content">
              <div class="list-c-text">
                <li><a href="" download="" ><span class="rsl-text">关于MSCI新产品上线通知</span><span class="rsl-red-text">点击此处下载<img src="../images/download.svg" alt="" class="rsl-img"></span></a></li>
              </div>
            </div>

            <div class="list-content">
              <div class="list-c-text">
                <li><a href="" download="" ><span class="rsl-text">关于MSCI新产品上线通知</span><span class="rsl-red-text">点击此处下载<img src="../images/download.svg" alt="" class="rsl-img"></span></a></li>
              </div>
            </div>

            <div class="list-content">
              <div class="list-c-text">
                <li><a href="" download="" ><span class="rsl-text">关于MSCI新产品上线通知</span><span class="rsl-red-text">点击此处下载<img src="../images/download.svg" alt="" class="rsl-img"></span></a></li>
              </div>
            </div>

            <div class="list-content">
              <div class="list-c-text">
                <li><a href="" download="" ><span class="rsl-text">关于MSCI新产品上线通知</span><span class="rsl-red-text">点击此处下载<img src="../images/download.svg" alt="" class="rsl-img"></span></a></li>
              </div>
            </div>

            <div class="list-content">
              <div class="list-c-text">
                <li><a href="" download="" ><span class="rsl-text">关于MSCI新产品上线通知</span><span class="rsl-red-text">点击此处下载<img src="../images/download.svg" alt="" class="rsl-img"></span></a></li>
              </div>
            </div>

            <div class="list-content">
              <div class="list-c-text">
                <li><a href="" download="" ><span class="rsl-text">关于MSCI新产品上线通知</span><span class="rsl-red-text">点击此处下载<img src="../images/download.svg" alt="" class="rsl-img"></span></a></li>
              </div>
            </div>

            <div class="list-content">
              <div class="list-c-text">
                <li><a href="" download="" ><span class="rsl-text">关于MSCI新产品上线通知</span><span class="rsl-red-text">点击此处下载<img src="../images/download.svg" alt="" class="rsl-img"></span></a></li>
              </div>
            </div>

            <div class="list-content">
              <div class="list-c-text">
                <li><a href="" download="" ><span class="rsl-text">关于MSCI新产品上线通知</span><span class="rsl-red-text">点击此处下载<img src="../images/download.svg" alt="" class="rsl-img"></span></a></li>
              </div>
            </div>

            <div class="list-content">
              <div class="list-c-text">
                <li><a href="" download="" ><span class="rsl-text">关于MSCI新产品上线通知</span><span class="rsl-red-text">点击此处下载<img src="../images/download.svg" alt="" class="rsl-img"></span></a></li>
              </div>
            </div>

            <div class="list-content">
              <div class="list-c-text">
                <li><a href="" download="" ><span class="rsl-text">关于MSCI新产品上线通知</span><span class="rsl-red-text">点击此处下载<img src="../images/download.svg" alt="" class="rsl-img"></span></a></li>
              </div>
            </div>

            <div class="list-content">
              <div class="list-c-text">
                <li><a href="" download="" ><span class="rsl-text">关于MSCI新产品上线通知</span><span class="rsl-red-text">点击此处下载<img src="../images/download.svg" alt="" class="rsl-img"></span></a></li>
              </div>
            </div>

            <div class="list-content">
              <div class="list-c-text">
                <li><a href="" download="" ><span class="rsl-text">关于MSCI新产品上线通知</span><span class="rsl-red-text">点击此处下载<img src="../images/download.svg" alt="" class="rsl-img"></span></a></li>
              </div>
            </div>

            <div class="list-content">
              <div class="list-c-text">
                <li><a href="" download="" ><span class="rsl-text">关于MSCI新产品上线通知</span><span class="rsl-red-text">点击此处下载<img src="../images/download.svg" alt="" class="rsl-img"></span></a></li>
              </div>
            </div>

            <div class="list-content">
              <div class="list-c-text">
                <li><a href="" download="" ><span class="rsl-text">关于MSCI新产品上线通知</span><span class="rsl-red-text">点击此处下载<img src="../images/download.svg" alt="" class="rsl-img"></span></a></li>
              </div>
            </div>

            <div class="list-content">
              <div class="list-c-text">
                <li><a href="" download="" ><span class="rsl-text">关于MSCI新产品上线通知</span><span class="rsl-red-text">点击此处下载<img src="../images/download.svg" alt="" class="rsl-img"></span></a></li>
              </div>
            </div>
          </div>
    <!-- END OF !!!!!!!! News PDF Page Content - Left Side - Column 2 ~ 交易所通告 -->


    <!-- News PDF Page Content - Left Side - Column 3 ~ 交易所通告 -->     
      <div class="tab-pane fade" id="list-quotes" role="tabpanel" aria-labelledby="list-quotes-list">
            <div class="list-content">
              <div class="list-c-text">
                <li><a href="..//pdf/20y2.pdf" download="20y2" ><span class="rsl-text">关于MSCI新产品上线通知</span><span class="rsl-red-text">点击此处下载<img src="../images/download.svg" alt="" class="rsl-img"></span></a></li>
              </div>
            </div>

            <div class="list-content">
              <div class="list-c-text">
                <li><a href="" download="" ><span class="rsl-text">关于MSCI新产品上线通知</span><span class="rsl-red-text">点击此处下载<img src="../images/download.svg" alt="" class="rsl-img"></span></a></li>
              </div>
            </div>

            <div class="list-content">
              <div class="list-c-text">
                <li><a href="" download="" ><span class="rsl-text">关于MSCI新产品上线通知</span><span class="rsl-red-text">点击此处下载<img src="../images/download.svg" alt="" class="rsl-img"></span></a></li>
              </div>
            </div>

            <div class="list-content">
              <div class="list-c-text">
                <li><a href="" download="" ><span class="rsl-text">关于MSCI新产品上线通知</span><span class="rsl-red-text">点击此处下载<img src="../images/download.svg" alt="" class="rsl-img"></span></a></li>
              </div>
            </div>

            <div class="list-content">
              <div class="list-c-text">
                <li><a href="" download="" ><span class="rsl-text">关于MSCI新产品上线通知</span><span class="rsl-red-text">点击此处下载<img src="../images/download.svg" alt="" class="rsl-img"></span></a></li>
              </div>
            </div>

            <div class="list-content">
              <div class="list-c-text">
                <li><a href="" download="" ><span class="rsl-text">关于MSCI新产品上线通知</span><span class="rsl-red-text">点击此处下载<img src="../images/download.svg" alt="" class="rsl-img"></span></a></li>
              </div>
            </div>

            <div class="list-content">
              <div class="list-c-text">
                <li><a href="" download="" ><span class="rsl-text">关于MSCI新产品上线通知</span><span class="rsl-red-text">点击此处下载<img src="../images/download.svg" alt="" class="rsl-img"></span></a></li>
              </div>
            </div>

            <div class="list-content">
              <div class="list-c-text">
                <li><a href="" download="" ><span class="rsl-text">关于MSCI新产品上线通知</span><span class="rsl-red-text">点击此处下载<img src="../images/download.svg" alt="" class="rsl-img"></span></a></li>
              </div>
            </div>

            <div class="list-content">
              <div class="list-c-text">
                <li><a href="" download="" ><span class="rsl-text">关于MSCI新产品上线通知</span><span class="rsl-red-text">点击此处下载<img src="../images/download.svg" alt="" class="rsl-img"></span></a></li>
              </div>
            </div>

            <div class="list-content">
              <div class="list-c-text">
                <li><a href="" download="" ><span class="rsl-text">关于MSCI新产品上线通知</span><span class="rsl-red-text">点击此处下载<img src="../images/download.svg" alt="" class="rsl-img"></span></a></li>
              </div>
            </div>

            <div class="list-content">
              <div class="list-c-text">
                <li><a href="" download="" ><span class="rsl-text">关于MSCI新产品上线通知</span><span class="rsl-red-text">点击此处下载<img src="../images/download.svg" alt="" class="rsl-img"></span></a></li>
              </div>
            </div>

            <div class="list-content">
              <div class="list-c-text">
                <li><a href="" download="" ><span class="rsl-text">关于MSCI新产品上线通知</span><span class="rsl-red-text">点击此处下载<img src="../images/download.svg" alt="" class="rsl-img"></span></a></li>
              </div>
            </div>

            <div class="list-content">
              <div class="list-c-text">
                <li><a href="" download="" ><span class="rsl-text">关于MSCI新产品上线通知</span><span class="rsl-red-text">点击此处下载<img src="../images/download.svg" alt="" class="rsl-img"></span></a></li>
              </div>
            </div>

            <div class="list-content">
              <div class="list-c-text">
                <li><a href="" download="" ><span class="rsl-text">关于MSCI新产品上线通知</span><span class="rsl-red-text">点击此处下载<img src="../images/download.svg" alt="" class="rsl-img"></span></a></li>
              </div>
            </div>

            <div class="list-content">
              <div class="list-c-text">
                <li><a href="" download="" ><span class="rsl-text">关于MSCI新产品上线通知</span><span class="rsl-red-text">点击此处下载<img src="../images/download.svg" alt="" class="rsl-img"></span></a></li>
              </div>
            </div>

            <div class="list-content">
              <div class="list-c-text">
                <li><a href="" download="" ><span class="rsl-text">关于MSCI新产品上线通知</span><span class="rsl-red-text">点击此处下载<img src="../images/download.svg" alt="" class="rsl-img"></span></a></li>
              </div>
            </div>

            <div class="list-content">
              <div class="list-c-text">
                <li><a href="" download="" ><span class="rsl-text">关于MSCI新产品上线通知</span><span class="rsl-red-text">点击此处下载<img src="../images/download.svg" alt="" class="rsl-img"></span></a></li>
              </div>
            </div>

            <div class="list-content">
              <div class="list-c-text">
                <li><a href="" download="" ><span class="rsl-text">关于MSCI新产品上线通知</span><span class="rsl-red-text">点击此处下载<img src="../images/download.svg" alt="" class="rsl-img"></span></a></li>
              </div>
            </div>

            <div class="list-content">
              <div class="list-c-text">
                <li><a href="" download="" ><span class="rsl-text">关于MSCI新产品上线通知</span><span class="rsl-red-text">点击此处下载<img src="../images/download.svg" alt="" class="rsl-img"></span></a></li>
              </div>
            </div>

            <div class="list-content">
              <div class="list-c-text">
                <li><a href="" download="" ><span class="rsl-text">关于MSCI新产品上线通知</span><span class="rsl-red-text">点击此处下载<img src="../images/download.svg" alt="" class="rsl-img"></span></a></li>
              </div>
            </div>
          </div>     
    <!-- END OF !!!!!!!! News PDF Page Content - Left Side - Column 3 ~ 交易所通告 -->


    <!-- News PDF Page Content - Left Side - Column 4 ~ 公司通告 -->
    <div class="tab-pane fade" id="list-company" role="tabpanel" aria-labelledby="list-company-list">
            <div class="list-content">
              <div class="list-c-text">
                <li><a href="..//pdf/20y2.pdf" download="20y2" ><span class="rsl-text">关于MSCI新产品上线通知</span><span class="rsl-red-text">点击此处下载<img src="../images/download.svg" alt="" class="rsl-img"></span></a></li>
              </div>
            </div>

            <div class="list-content">
              <div class="list-c-text">
                <li><a href="" download="" ><span class="rsl-text">关于MSCI新产品上线通知</span><span class="rsl-red-text">点击此处下载<img src="../images/download.svg" alt="" class="rsl-img"></span></a></li>
              </div>
            </div>

            <div class="list-content">
              <div class="list-c-text">
                <li><a href="" download="" ><span class="rsl-text">关于MSCI新产品上线通知</span><span class="rsl-red-text">点击此处下载<img src="../images/download.svg" alt="" class="rsl-img"></span></a></li>
              </div>
            </div>

            <div class="list-content">
              <div class="list-c-text">
                <li><a href="" download="" ><span class="rsl-text">关于MSCI新产品上线通知</span><span class="rsl-red-text">点击此处下载<img src="../images/download.svg" alt="" class="rsl-img"></span></a></li>
              </div>
            </div>

            <div class="list-content">
              <div class="list-c-text">
                <li><a href="" download="" ><span class="rsl-text">关于MSCI新产品上线通知</span><span class="rsl-red-text">点击此处下载<img src="../images/download.svg" alt="" class="rsl-img"></span></a></li>
              </div>
            </div>

            <div class="list-content">
              <div class="list-c-text">
                <li><a href="" download="" ><span class="rsl-text">关于MSCI新产品上线通知</span><span class="rsl-red-text">点击此处下载<img src="../images/download.svg" alt="" class="rsl-img"></span></a></li>
              </div>
            </div>

            <div class="list-content">
              <div class="list-c-text">
                <li><a href="" download="" ><span class="rsl-text">关于MSCI新产品上线通知</span><span class="rsl-red-text">点击此处下载<img src="../images/download.svg" alt="" class="rsl-img"></span></a></li>
              </div>
            </div>

            <div class="list-content">
              <div class="list-c-text">
                <li><a href="" download="" ><span class="rsl-text">关于MSCI新产品上线通知</span><span class="rsl-red-text">点击此处下载<img src="../images/download.svg" alt="" class="rsl-img"></span></a></li>
              </div>
            </div>

            <div class="list-content">
              <div class="list-c-text">
                <li><a href="" download="" ><span class="rsl-text">关于MSCI新产品上线通知</span><span class="rsl-red-text">点击此处下载<img src="../images/download.svg" alt="" class="rsl-img"></span></a></li>
              </div>
            </div>

            <div class="list-content">
              <div class="list-c-text">
                <li><a href="" download="" ><span class="rsl-text">关于MSCI新产品上线通知</span><span class="rsl-red-text">点击此处下载<img src="../images/download.svg" alt="" class="rsl-img"></span></a></li>
              </div>
            </div>

            <div class="list-content">
              <div class="list-c-text">
                <li><a href="" download="" ><span class="rsl-text">关于MSCI新产品上线通知</span><span class="rsl-red-text">点击此处下载<img src="../images/download.svg" alt="" class="rsl-img"></span></a></li>
              </div>
            </div>

            <div class="list-content">
              <div class="list-c-text">
                <li><a href="" download="" ><span class="rsl-text">关于MSCI新产品上线通知</span><span class="rsl-red-text">点击此处下载<img src="../images/download.svg" alt="" class="rsl-img"></span></a></li>
              </div>
            </div>

            <div class="list-content">
              <div class="list-c-text">
                <li><a href="" download="" ><span class="rsl-text">关于MSCI新产品上线通知</span><span class="rsl-red-text">点击此处下载<img src="../images/download.svg" alt="" class="rsl-img"></span></a></li>
              </div>
            </div>

            <div class="list-content">
              <div class="list-c-text">
                <li><a href="" download="" ><span class="rsl-text">关于MSCI新产品上线通知</span><span class="rsl-red-text">点击此处下载<img src="../images/download.svg" alt="" class="rsl-img"></span></a></li>
              </div>
            </div>

            <div class="list-content">
              <div class="list-c-text">
                <li><a href="" download="" ><span class="rsl-text">关于MSCI新产品上线通知</span><span class="rsl-red-text">点击此处下载<img src="../images/download.svg" alt="" class="rsl-img"></span></a></li>
              </div>
            </div>

            <div class="list-content">
              <div class="list-c-text">
                <li><a href="" download="" ><span class="rsl-text">关于MSCI新产品上线通知</span><span class="rsl-red-text">点击此处下载<img src="../images/download.svg" alt="" class="rsl-img"></span></a></li>
              </div>
            </div>

            <div class="list-content">
              <div class="list-c-text">
                <li><a href="" download="" ><span class="rsl-text">关于MSCI新产品上线通知</span><span class="rsl-red-text">点击此处下载<img src="../images/download.svg" alt="" class="rsl-img"></span></a></li>
              </div>
            </div>

            <div class="list-content">
              <div class="list-c-text">
                <li><a href="" download="" ><span class="rsl-text">关于MSCI新产品上线通知</span><span class="rsl-red-text">点击此处下载<img src="../images/download.svg" alt="" class="rsl-img"></span></a></li>
              </div>
            </div>

            <div class="list-content">
              <div class="list-c-text">
                <li><a href="" download="" ><span class="rsl-text">关于MSCI新产品上线通知</span><span class="rsl-red-text">点击此处下载<img src="../images/download.svg" alt="" class="rsl-img"></span></a></li>
              </div>
            </div>

            <div class="list-content">
              <div class="list-c-text">
                <li><a href="" download="" ><span class="rsl-text">关于MSCI新产品上线通知</span><span class="rsl-red-text">点击此处下载<img src="../images/download.svg" alt="" class="rsl-img"></span></a></li>
              </div>
            </div>
          </div>      
<!-- END OF !!!!!!!!  News PDF Page Content - Left Side - Column 4 ~ 公司通告 -->
    
      </div>
    </div>

<!-- END OF !!!!!!!!  News PDF Page Content -->
  </div>
</div>





</body>

<?php include('global/footer.php'); ?>


<script>

</script>

</html>




