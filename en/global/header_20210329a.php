<!-- Header Page -->
  <style>
    /* Header Page Topbar */
      .container-fluid.bg_light.header-page {
        background-color: #F6F6F6;
        margin: auto;
      }

      .topnav {
        overflow: hidden;
        display: flex;
        justify-content: flex-end;
        padding: 0px 80px;
      }


      .topnav a{
        float: right;
        display: block;
        text-align: center;
        padding: 10px 16px;
        text-decoration: none;
        font-size: 14px;
        color: #707070;
      }

      .topnav .lag.a:hover{
        border-bottom: 2px solid #D93A16;
        background-color:  #F0F0F0;
      }

      .topnav a.active {
        border-bottom: 2px solid #D93A16;
      }

      a.modal-icon {
        padding-top: 10px;
      }
    
    /* Modal */
      .close:not(:disabled):not(.disabled) {
        cursor: pointer;
        opacity: 1;
      }

      img.close-btn {
        width: 40px;
        position: absolute;
        right: -20px;
        top: -20px;
      }

      


      

    
  
  /* Header Page Header Navbar */
    nav.navbar.navbar-light.navbar-expand-md.bg-faded.justify-content-center.red-border {
      padding: 25px;
    }

    img.company-logo.header-page {
      margin-left: 50px;
    }

    .dropdown-toggle::after{
      display: none;
    }

    .navbar-light .navbar-nav .nav-link{
      color: #333;
    }

    ul#nav {
      margin-right: 70px;
    }

    li.nav-item {
      padding: 5px;
    }

    a.nav-link:hover {
      border-bottom: 2px solid #D93A16;
    }


    a.nav-link.active {
      border-bottom: 2px solid #D93A16;
    }

    nav.navbar.navbar-light.navbar-expand-md.bg-faded.justify-content-center.red-border {
    padding: 25px;
    border-bottom: 10px solid #D93A16;
}

img.wechat-qr-code {
    display: block;
    margin: 30px auto;
}
@media only screen and (min-width:768px){
  

  .nav .fa {
    display: none;
    }

}

.dropdown-menu.show {
    display: block;
    text-align: center;
    font-size: 14px;
    color: #333333;
    padding: 20px 0px;
}

a.dropdown-item {
    padding: 10px;
}

.dropdown-menu {
    position: absolute;
    top: 88px;
    left: -30px;
    border-radius: 0px;
}

.wechat-qrcode-text {
    font-size: 18px;
    font-weight: 900;
    color: #1A1A1A;
    text-align: center;
    padding: 0px 0px 15px 0px;
}

.wechat-qrcode-text-02 {
    font-size: 16px;
    font-weight: 400;
    text-align: center;
    color: #B2B2B2;
    padding: 0px 0px 25px 0px;
}



/* Mobile Page */
  /* Header Page - Top Nav */
    @media only screen and (max-width: 767px){
      .topnav {
    overflow: hidden;
    display: flex;
    /*justify-content: flex-start !important;*/
    padding: 0px 0px;
}

      .topnav.header-page {
        padding: 5px 0px;
      }

      nav.navbar.navbar-light.navbar-expand-md.bg-faded.justify-content-center.red-border {
        padding: 10px 0px;
        border-bottom: 5px solid #D93A16;
      }

      img.company-logo.header-page {
        margin-left: -10px;
      }

      .navbar-light .navbar-toggler {
        color: transparent;
        border-color: transparent;
      }

      .navbar-light .navbar-toggler-icon {
        background-image: url("../images/group_2490.svg");
      }

      .navbar-light .navbar-toggler {
        border-color: transparent;
      }

      li.nav-item {
    border-bottom: 1px solid #707070;
}

    .navbar-light .navbar-nav .nav-link {
      color: #333;
      font-size: 12px;
      padding: 10px 10px;
    }
    a.nav-link:active {
      color: #333;
      border-bottom: 1px solid transparent;
    }

    .fa {
    display: block;
    float: right;
    color: #ADADAD;
    font-size: 12px;
    padding: 5px 5px;
}

li.nav-item.dropdown.show a:active {
    border-bottom: 1px solid transparent;
}

.navbar-nav .dropdown-menu {
    border: 1px solid transparent;
    background-color: #F6F6F6;
    border-radius: 0px;
    font-size: 12px;
    color: #333333;
    border-top: 1px solid #707070;
}

.dropdown-menu.show a {
    padding-left: 15px;
}

li.nav-item {
    padding: 0px;
}

a.nav-link {
    border-bottom: 1px solid transparent;
}

a#drop1, a#drop2, a#drop3, a#drop4 {
    border-bottom: 1px solid transparent;
}

.navbar-nav .nav-link.active {
    color: #D93A16 !important;
    border-bottom: none;
}








    }





    
    


  
  </style>

<!-- Header Page html -->
  <!-- Header Page Top Nav -->
    <div class="container-fluid bg_light header-page">
      <div class="top">
        <div class="topnav">

          <a class="modal-icon" data-toggle="modal" data-target="#exampleModal" style="cursor: pointer;"><img src="../images/wechat_icon.svg" width="20" class="top-wechat-icon"></a>
          <a class="lag  btn_lang" href="#" from="<?php echo CURRENT_LANG_DIR;?>" to="sc">简</a>
          <a class="lag active btn_lang" href="#" from="<?php echo CURRENT_LANG_DIR;?>" to="en">EN</a>
          
          
        </div>
      </div>      
    </div>

  


  <!-- Header Page Header Navbar -->
    <nav class="navbar navbar-light navbar-expand-md bg-faded justify-content-center red-border">
      <a href="index.php" class="navbar-brand mr-auto pl-4">
        <img src="../images/logo.png" class="logo_w">
      </a>
    
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsingNavbar3">
        <span class="navbar-toggler-icon"></span>
      </button>
    
      <div class="navbar-collapse collapse w-100" id="collapsingNavbar3">
        <ul class="navbar-nav nav ml-auto w-100 justify-content-end" id="nav">
          <li class="nav-item">
            <a class="nav-link<?php if($a==0){?> active <?php } ?>" href="index.php">首页 <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link<?php if($a==1){?> active <?php } ?>" href="about_us.php">关于我们</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle<?php if($a==2){?> active <?php } ?>" href="" id="drop1" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <span class="menu-icon"><i onclick="myFunction(this)" class="fa fa-plus"></i></span>
              新闻中心
            </a>
            <div class="dropdown-menu" aria-labelledby="drop1">
              <a class="dropdown-item" href="news_list.php">华泰新闻</a>
              <a class="dropdown-item" href="news_pdf.php">重要通告</a>
              <!--a class="dropdown-item" href="news_investment.php">投资研究</a-->
            </div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle<?php if($a==3){?> active <?php } ?>" href="market_coverage_listing.php" id="drop2" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <span class="menu-icon"><i onclick="myFunction(this)" class="fa fa-plus"></i></span>
              业务覆盖
            </a>
            <div class="dropdown-menu" aria-labelledby="drop2">
              <a class="dropdown-item" href="market_coverage_listing.php?mcl=cn#mark_list">中国市场</a>
              <a class="dropdown-item" href="market_coverage_listing.php?mcl=hk#mark_list">香港及海外市场</a>
              <a class="dropdown-item" href="market_coverage_listing.php#data">量化及程序化交易支持</a>
            </div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle<?php if($a==4){?> active <?php } ?>" href="#" id="drop3" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <span class="menu-icon"><i onclick="myFunction(this)" class="fa fa-plus"></i></span>
              产品资讯
            </a>
            <div class="dropdown-menu" aria-labelledby="drop3">
              <a class="dropdown-item" href="pas_reg_pnb.php">产品及保证金</a>
              <a class="dropdown-item" href="calendar_holidays.php">交易所假期通知</a>
              <a class="dropdown-item" href="calendar_futures.php">期货和期权产品最后交易日</a>
            </div>
          </li>
          <li class="nav-item dropdown">
           <a class="nav-link dropdown-toggle<?php if($a==5){?> active <?php } ?>" href="#" id="drop4" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="menu-icon"><i onclick="myFunction(this)" class="fa fa-plus"></i></span>  
            客户服务
            </a>
            <div class="dropdown-menu" aria-labelledby="drop4">
              <a class="dropdown-item" href="pas_reg_ac.php">账户开立</a>
              <a class="dropdown-item" href="pas_client_deposit.php">资金存取</a>
              <a class="dropdown-item" href="pas_software.php">软件下载</a>
              <a class="dropdown-item" href="pas_form.php">表单下载</a>
              <a class="dropdown-item" href="pas_faq.php">常见问题</a>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link<?php if($a==6){?> active <?php } ?>" href="contact_us.php">联系我们</a>
          </li>
        </ul>
      </div>
    </nav>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"><img src="../images/close-btn.svg" alt="" class="close-btn"></span>
        </button>
		
<?php
	$img = '';
	$sql = "select img from ".TB_WEBPAGE_PHOTO;
	$sql .= " where  ";
	$sql .= " disabled='0' ";
	$sql .= " and webpage_id=40";
//	$sql .= " and language_id='".CURRENT_LANG."' ";
	$sql .= " order by sort_order asc limit 0,1 ";
	$rowsp = $G_DB_CONNECT->query($sql);
	if($G_DB_CONNECT->affected_rows > 0){	
			while($datap = $G_DB_CONNECT->fetch_array($rowsp)){
				$img = DIR_PATH.$datap['img'];
			}
	}
	
?>

        <div class="modal-body"><img src="<?php echo $img; ?>" alt="" class="wechat-qr-code" width="70%">
		
		
		
          <div class="wechat-qrcode-text"><?php echo getLangName(TB_WEBPAGE,"name2",40,CURRENT_LANG); ?></div>
          <div class="wechat-qrcode-text-02"><?php echo getLangName(TB_WEBPAGE,"name3",40,CURRENT_LANG); ?></div>
        </div>
      </div>
    </div>

      

        
      
    </div>
  </div>
</div>

<script>



  function myFunction(x) {
  x.classList.toggle("fa-minus");
}
</script>


