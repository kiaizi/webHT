<!-- Header Page -->
  <style>
    /* Header Page - Top Nav */
    .container-fluid.bg_light.header-page {
      background-color: #F6F6F6;
    }

    .topnav.header-page {
      padding: 5px 80px;
    }

    .topnav.header-page a {
      padding: 0px 10px;
      padding-bottom: 5px;
    }

    .topnav a{
      color: #797979;
      text-align: center;
      padding: 10px 0px;
      text-decoration: none;
      font-size: 16px;
    }

    .topnav a.active {
      border-bottom: 2px solid #D93A16;
    }

    .topnav a:hover{
      border-bottom: 2px solid #D93A16;
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
      border-bottom: 1px solid #D93A16;
    }


    a.nav-link.active {
      border-bottom: 1px solid #D93A16;
    }

    nav.navbar.navbar-light.navbar-expand-md.bg-faded.justify-content-center.red-border {
    padding: 25px;
    border-bottom: 10px solid #D93A16;
}
@media only screen and (min-width:768px){
  .nav .fa {
    display: none;
    }

}



/* Mobile Page */
  /* Header Page - Top Nav */
    @media only screen and (max-width: 767px){
      .d-flex.justify-content-end.header-page {
        justify-content: flex-start!important;
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








    }





    
    


  
  </style>



<!-- Header Page html -->
  <!-- Header Page Top Nav -->
  <div class="container-fluid bg_light header-page">
    <div class="d-flex justify-content-end header-page">
      <div class="topnav header-page">
      
        <a class="btn btn-primary header-button active" data-toggle="modal" data-target="#exampleModal"><img src="../images/wechat_icon.svg" width="20" class="top-wechat-icon"></a>
        <a href="">简</a>
        <a href="">EN</a>
      </div>        
    </div>  
  </div>

  <!-- Header Page Header Navbar -->
    <nav class="navbar navbar-light navbar-expand-md bg-faded justify-content-center red-border">
      <a href="index.php" class="navbar-brand d-flex w-50 mr-auto pl-4">
        <img src="../images/logo.png"  class="company-logo header-page" width="100%" style="max-width: 400px;">
      </a>
    
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsingNavbar3">
        <span class="navbar-toggler-icon"></span>
      </button>
    
      <div class="navbar-collapse collapse w-100" id="collapsingNavbar3">
        <ul class="navbar-nav nav ml-auto w-100 justify-content-end" id="nav">
          <li class="nav-item">
            <a class="nav-link" href="index.php">首页 <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../sc/about_us.php">关于我们</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="" id="drop1" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <span class="menu-icon"><i onclick="myFunction(this)" class="fa fa-plus"></i></span>
              新闻中心
            </a>
            <div class="dropdown-menu" aria-labelledby="drop1">
              <a class="dropdown-item" href="../sc/news_list.php">华泰新闻</a>
              <a class="dropdown-item" href="../sc/news_pdf.php">重要通告</a>
            </div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="drop2" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <span class="menu-icon"><i onclick="myFunction(this)" class="fa fa-plus"></i></span>
              业务覆盖
            </a>
            <div class="dropdown-menu" aria-labelledby="drop2">
              <a class="dropdown-item" href="#">Action</a>
              <a class="dropdown-item" href="#">Another action</a>
              <a class="dropdown-item" href="#">Something else here</a>
            </div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="drop3" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <span class="menu-icon"><i onclick="myFunction(this)" class="fa fa-plus"></i></span>
              市场资讯
            </a>
            <div class="dropdown-menu" aria-labelledby="drop3">
              <a class="dropdown-item" href="#">Action</a>
              <a class="dropdown-item" href="#">Another action</a>
              <a class="dropdown-item" href="#">Something else here</a>
            </div>
          </li>
          <li class="nav-item dropdown">
           <a class="nav-link dropdown-toggle" href="../sc/product_and_service/php" id="drop4" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="menu-icon"><i onclick="myFunction(this)" class="fa fa-plus"></i></span>  
            产品及服务
            </a>
            <div class="dropdown-menu" aria-labelledby="drop4">
              <a class="dropdown-item" href="#">Action</a>
              <a class="dropdown-item" href="#">Another action</a>
              <a class="dropdown-item" href="#">Something else here</a>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/madcradle/Huatai/sc/contact_us.php">联系我们</a>
          </li>
        </ul>
      </div>
    </nav>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>

        <div class="modal-body"><img src="../images/wechat-qr-code.svg" alt="" class="wechat-qr-code" width="100%"></div>
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


