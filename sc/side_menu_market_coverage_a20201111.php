<div id="side-menu" class="col-lg-3 col-12 pt-lg-5">
  <div class="panel-group" id="accordionGroupOpen" role="tablist" aria-multiselectable="true">

  <!-- Panel One ~ Heading -->
  <div class="panel panel-default">
        <div class="panel-heading" role="tab" id="headingOne">
          <h4 class="panel-title">
          <a class="icon_change <?php if(($b!=1) && ($b!=2) && ($b!=3)) { ?>collapsed<?php } ?>" role="button" data-toggle="collapse" data-parent="#accordionGroupOpen" href="#collapseOpenOne" aria-expanded="false" aria-controls="collapOne">
              中国市场
            </a>
          </h4>
        </div>
      <!-- END ~~ Panel One Heading -->
        <div id="collapseOpenOne" class="panel-collapse collapse <?php if(($b==1) || ($b==2) || ($b==3)) { ?>show<?php } ?>" role="tabpanel" aria-labelledby="headingOne">
          <div class="panel-body">
          <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link <?php if($b==1) { ?>active<?php } ?>" href="#"><span>大连商品交易所</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php if($b==2) { ?>active<?php } ?>" href="#"><span>郑州商品交易所</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php if($b==3) { ?>active<?php } ?>" href="market_coverage_SHFE.php"><span>上海期货交易所及能源中心</span></a>
          </li>
        </ul>

          </div>
        </div>

      </div>
    <!-- Panel One END -->

    
    <!-- Panel Two ~ Heading -->
      <div class="panel panel-default">
        <div class="panel-heading" role="tab" id="headingTwo">
          <h4 class="panel-title">
            <a class="icon_change <?php if(($b!=5) && ($b!=6) && ($b!=7) && ($b!=8) && ($b!=9) && ($b!=10)) { ?>collapsed<?php } ?>" role="button" data-toggle="collapse" data-parent="#accordionGroupOpen" href="#collapseOpenTwo" aria-expanded="false" aria-controls="collapseTwo">
              香港及海外市场
            </a>
          </h4>
        </div>
      <!-- END ~~ Panel Two Heading -->
        <div id="collapseOpenTwo" class="panel-collapse collapse<?php if(($b==5) || ($b==6) || ($b==7) || ($b==8) || ($b==9) || ($b==10)) { ?>show<?php } ?>" role="tabpanel" aria-labelledby="headingTwo">
          <div class="panel-body">
          <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link <?php if($b==5) { ?>active<?php } ?>" href="#"><span>芝商所集团产品</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php if($b==6) { ?>active<?php } ?>" href="#"><span>伦敦金属交易所及欧洲交易所产品</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php if($b==7) { ?>active<?php } ?>" href="market_coverage_HKEX.php"><span>港交所产品</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php if($b==8) { ?>active<?php } ?>" href="#"><span>新加坡交易所产品</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php if($b==9) { ?>active<?php } ?>" href="#"><span>日本交易所集团产品</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php if($b==10) { ?>active<?php } ?>" href="#"><span>其它产品</span></a>
          </li>
        </ul>

          </div>
        </div>

      </div>
    <!-- Panel Two END -->


    <!-- Panel Three ~ Heading -->
    <div class="panel panel-default">
        <div class="panel-heading" role="tab" id="headingThree">
          <h4 class="panel-title">
          <a class="icon_change <?php if(($b!=11) && ($b!=12)) { ?>collapsed<?php } ?>" role="button" data-toggle="collapse" data-parent="#accordionGroupOpen" href="#collapseOpenThree" aria-expanded="false" aria-controls="collapseThree">
              量化及程序化交易支持
            </a>
          </h4>
        </div>
      <!-- END ~~ Panel Three Heading -->
        <div id="collapseOpenThree" class="panel-collapse collapse <?php if(($b==11) || ($b==12)) { ?>show<?php } ?>" role="tabpanel" aria-labelledby="headingThree">
          <div class="panel-body">
          <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link <?php if($b==11) { ?>active<?php } ?>" href="market_coverage_API_1.php"><span>API接入</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php if($b==12) { ?>active<?php } ?>" href="market_coverage_API_2.php"><span>历史及实时行情数据接口</span></a>
          </li>
        </ul>

          </div>
        </div>

      </div>
    <!-- Panel Three END -->











    

  </div>
</div>