<!doctype html>
  <html>
    <?php include('global/html_head.php'); ?>
    <?php $a=3; $b=3; ?>
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
  @media only screen and (max-width:414px) { 
    
  #op_ac_step td, #collapse_1 td {
    font-size: 12px;
  }
  
  #shfe_collapse .btn-link {
    font-size: 14px;
  }
  #shfe_collapse .card-body {
    font-size: 12px;
  }
    
  }
  </style>


<!-- News PDF Page Banner & Title -->
  <div class="container-fluid contactus-container" style="padding: 0;">
    <img src="../images/market-bg.png" class="img-fluid" style="width: 100%;">
  </div>

<!-- News PDF Page Content -->
<div class="container">
  <div class="row">

    <!-- News PDF Page Content - Left Side -->
    <?php include('side_menu_market_coverage.php'); ?>

    <!-- News PDF Page Content - Right Side -->
      <div class="col-lg-9 col-12 pt-lg-3 pl-lg-5">
        <div class="col-12 mt-2 mb-2">
          <span class="head_sction_link">业务覆盖 > 中国市场 > <span style="border-bottom: 2px solid #D93A16;">上海期货交易所及能源中心</span></span>
        </div>
        <div class="col-12 pb-3">
            <div class="market_title_1">上海期货交易所及能源中心</div>
          
            <div class="box_st_line"></div>

            <div class="bsl-content">
              <div class="bsl-left">
                <p class="bsl-left-text-01">上海国际能源交易中心股份有限公司（以下简称上期能源）是经中国证监会批准，由上海期货交易所发起设立的、面向期货市场参与者的国际交易场所，根据《公司法》、《期货交易管理条例》和中国证监会等有关法律法规履行期货市场自律管理职能。2013年11月6日，上期能源注册于中国（上海）自由贸易试验区，经营范围包括组织安排期货、期权等衍生品上市交易、结算、交割及其相关活动，制定业务管理规则，实施自律管理，发布市场信息，提供技术、场所和设施服务。</p>
                <p class="bsl-left-text-02">华泰（香港）期货有限公司是上海能源交易中心批复的境外特殊经纪参与者（公示于2020年8月4日），可直接入场交易；亦作为中国领先的金融衍生品综合服务平台——华泰期货的子公司，可依托华泰期货丰富的行业资源及交割经验，委托华泰期货进行结算、交割。</p>
              </div>
              <div class="bsl-right">
                <img src="../images/mc-SHFE-img.jpg" alt="" class="mc-shfe-img">
              </div>
            </div>

        </div>
        <div class="col-12 pb-3">
          
          <div class="accordion" id="shfe_collapse">
  <div class="card">
    <div class="card-header mc-SHFE" id="headingOne">
      <h2 class="mb-0">
        <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapse_1" aria-expanded="false" aria-controls="collapse_1">
          原油产品合约细则
        </button>
      </h2>
    </div>

    <div id="collapse_1" class="collapse" aria-labelledby="headingOne" data-parent="#shfe_collapse">
      <div class="card-body">
        <table width="100%" cellpadding="0" cellspacing="0" border="0">
          <tr>
            <td width="120">交易品种</td>
            <td>中质含硫原油</td>
          </tr>
          <tr>
            <td>交易单位</td>
            <td>1000桶/手</td>
          </tr>
          <tr>
            <td>报价单位</td>
            <td>元（人民币）/桶（交易报价为不含税价格）</td>
          </tr>
          <tr>
            <td>最小变动单位</td>
            <td>0.1元（人民币）/桶</td>
          </tr>
          <tr>
            <td>涨跌停板幅度</td>
            <td>不超过上一交易日结算价±4%</td>
          </tr>
          <tr>
            <td>合约月份</td>
            <td>最近1-12个月为连续月份以及随后八个季月</td>
          </tr>
          <tr>
            <td>交易时间</td>
            <td>上午9:00 - 11:30，下午1:30 - 3:00以及上海国际能源交易中心规定 的其他交易时间</td>
          </tr>
          <tr>
            <td>最后交易日</td>
            <td>交割月份前第一月的最后一个交易日；上海国际能源交易中心有权根据国家法定节假日调整最后交易日</td>
          </tr>
          <tr>
            <td>最后交割日</td>
            <td>最后交易日后连续五个交易日</td>
          </tr>
          <tr>
            <td>交割等级</td>
            <td>中质含硫原油，基准品质为API度32.0，硫含量1.5%，具体可交割油种及升贴水由上海国际 能源交易中心另行规定</td>
          </tr>
          <tr>
            <td>交割地点</td>
            <td>上海国际能源交易中心指定交割仓库</td>
          </tr>
          <tr>
            <td>最低交易保证金</td>
            <td>合约价值的5%</td>
          </tr>
          <tr>
            <td>交割方式</td>
            <td>实物交割</td>
          </tr>
        </table>
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header  mc-SHFE" id="heading2">
      <h2 class="mb-0">
        <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapse2" aria-expanded="false" aria-controls="collapse2">
          原油产品介绍
        </button>
      </h2>
    </div>
    <div id="collapse2" class="collapse" aria-labelledby="heading2" data-parent="#shfe_collapse">
      <div class="card-body">
        世界原油消费主要集中在亚太、北美和欧洲及欧亚地区，而世界原油生产区域主要集中在中东、北美和欧洲及欧亚地区。根据《BP世界能源统计年鉴2019》，2018年全球石油的国际贸易量为7134.4万桶/天，总消费量为9984.3万桶/天，全球国际贸易占石油消费的71%左右。其中，超过一半的石油贸易量增长源自中国和印度。<br><br>
根据《BP世界能源统计年鉴2019》，截至2018年底，中国生产石油379.8万桶/天2，占世界石油产量的4%，是世界第八大石油生产国；中国石油消费量为1352.5万桶/天3，占世界消费量的13.5%，是世界第二大石油消费国。但随着亚太地区消费份额超过北美和欧洲，在全球原油价格体系中的影响力却较弱，亚太地区缺乏权威的原油贸易定价基准，此与消费的比例不相匹配；因此原油期货将有助于形成反映中国以及亚太地区石油市场供求关系的基准价格体系，提供有效价格风险管理工具。<br><br>
此外尽管欧美已有成熟的原油期货市场，WTI及布兰特原油分别代表北美和欧洲，地位已相当稳固，而亚太地区的价格普遍以迪拜阿曼原油作为原油贸易价格基准；2019年度中东地区原油进口占总进口量百分比为46%，是我国原油进口的最主要来源，因此上海能源交易中心（能源中心）在原油期货标的物的选取上，也是选择了我国从中东进口量最大的中质含硫原油。中国原油期货目的其实即着眼于形成一更直接反映中国乃至亚太地区原油市场供求关系基准价格。
      </div>
    </div>
  </div>
  
  <div class="card">
    <div class="card-header  mc-SHFE" id="heading-3">
      <h2 class="mb-0">
        <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapse3" aria-expanded="false" aria-controls="collapse3">
          产品特点
        </button>
      </h2>
    </div>
    <div id="collapse3" class="collapse" aria-labelledby="heading-3" data-parent="#shfe_collapse">
      <div class="card-body">
      Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
      </div>
    </div>
  </div>
  
  <div class="card">
    <div class="card-header  mc-SHFE" id="heading4">
      <h2 class="mb-0">
        <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapse_4" aria-expanded="false" aria-controls="collapse_4">
          能源中心原油产品开户流程
        </button>
      </h2>
    </div>
    <div id="collapse_4" class="collapse" aria-labelledby="heading4" data-parent="#shfe_collapse">
      <div class="card-body">
        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header  mc-SHFE" id="heading5">
      <h2 class="mb-0">
        <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapse_5" aria-expanded="false" aria-controls="collapse_5">
          低硫燃料油及20号胶合约细则
        </button>
      </h2>
    </div>
    <div id="collapse_5" class="collapse" aria-labelledby="heading5" data-parent="#shfe_collapse">
      <div class="card-body">
        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
      </div>
    </div>
  </div>
</div>
          
         
<hr>          
          
          
        </div>
        <div class="col-12 pb-3">
          <div class="market_title_2">开户文件：</div>
          <p class="market_hkex_content_1">个人账户开户指引</p>
          <table width="96%" cellpadding="0" cellspacing="0" border="0" id="op_ac_step">
            <tr>
              <td colspan="2">开户所需文件</td>
            </tr>
            <tr>
              <td rowspan="3" align="left" valign="top" width="100">准备文件</td>
              <td align="left" valign="top">身份证明文件</td>
            </tr>
            <tr>
              <td align="left" valign="top">3个月内住址证明文件</td>
            </tr>
            <tr>
              <td align="left" valign="top">银行证明文件</td>
            </tr>
            <tr>
              <td rowspan="9" align="left" valign="top">填写表格</td>
              <td align="left" valign="top">账户开户表格连同客户协议书-条款及条件</td>
            </tr>
            <tr>
              <td align="left" valign="top">客户款项常设授权</td>
            </tr>
            <tr>
              <td align="left" valign="top">实时市场数据条款</td>
            </tr>
            <tr>
              <td align="left" valign="top">非美国人免扣除美国所得税声明书</td>
            </tr>
            <tr>
              <td align="left" valign="top">手续费申请单</td>
            </tr>
            <tr>
              <td align="left" valign="top">CRS自我证明表格（个人）</td>
            </tr>
            <tr>
              <td align="left" valign="top">*委托授权书（如适用）</td>
            </tr>
            <tr>
              <td align="left" valign="top">*香港证监会持牌人雇主同意信（如适用）</td>
            </tr>
            <tr>
              <td align="left" valign="top">*申请邮寄结单服务（如适用）</td>
            </tr>
            <tr>
              <td colspan="2" align="left" valign="top">交易“上海国际能源交易中心原油期货”需填写至之表格及准备材料</td>
            </tr>
            <tr>
              <td rowspan="3" align="left" valign="top">准备文件</td>
              <td align="left" valign="top">依交易者类型检附影像数据采集要求 (如下图)</td>
            </tr>
            <tr>
              <td align="left" valign="top">原油期货基础知识测试/客户承诺书</td>
            </tr>
            <tr>
              <td align="left" valign="top">关于交易者符合相关期货交易所交易者适当性制度要求的证明</td>
            </tr>
            <tr>
              <td align="left" valign="top">填写表格</td>
              <td align="left" valign="top">境外个人交易者交易编码申请表</td>
            </tr>
          </table>
          <p class="sm-text">注：如填写语言为英文，除提供原件扫描件之外，开户个人必须提供翻译为中文的版本并加盖公章。</p>
        </div>
        
        <div class="col-12 pb-3">
          <div class="market_title_2">开户流程</div>
            <div class="mc-SHFE-col">
              <div class="mc-SHFE-col-01 col-lg-5">
                <div class="ms-SHFE-left-tb">
                  <div class="ltb-col">客户填写开户数据，并通过适当性审查</div>
                  <div class="ltb-col"></div>
                  <div class="ltb-col">华泰（香港）期货协助审核交易编码</div>
                  <div class="ltb-col"></div>
                  <div class="ltb-col">保证金监控中心分配交易编码</div>
                  <div class="ltb-col"></div>
                  <div class="ltb-col">完成开户</div>
                </div>
              </div>

              <div class="mc-SHFE-col-02 col-lg-2"><img src="../images/mc-SHFE-timeline.svg" clss="mc-SHFE-img" width="120px"></div>

              <div class="mc-SHFE-col-03 col-lg-5">
                <div class="ms-SHFE-right-tb">
                  <div class="rtb-col"></div>
                  <div class="rtb-col">华泰（香港）期货进行文件审核、资料留存并处理开户</div>
                  <div class="rtb-col"></div>
                  <div class="rtb-col">保证金监控中心检查开户数据</div>
                  <div class="rtb-col"></div>
                  <div class="rtb-col">客户获得交易编码</div>
                  <div class="rtb-col"></div>
                </div>
              </div>
            </div>

            <!-- Mobile -->
            <div class="mc-SHFE-col-md">
              <table class="ms-SHFE-md-tb">
                <tbody>
                  <tr>
                    <th rowspan="8" class="md-left-tb"><img src="../images/mc-SHFE-timeline.svg" clss="mc-SHFE-img" width="90px"></th>
                    <th class="mdtb-col-01">客户填写开户数据，并通过适当性审查</th>
                  </tr>
                  <tr>
                    <th class="mdtb-col-02">华泰（香港）期货进行文件审核、资料留存并处理开户</th>
                  </tr>
                  <tr>
                    <th class="mdtb-col-03">华泰（香港）期货协助审核交易编码</th>
                  </tr>
                  <tr>
                    <th class="mdtb-col-04">保证金监控中心检查开户数据</th>
                  </tr>
                  <tr>
                    <th class="mdtb-col-05">保证金监控中心分配交易编码</th>
                  </tr>
                  <tr>
                    <th class="mdtb-col-06">客户获得交易编码</th>
                  </tr>
                  <tr>
                    <th class="mdtb-col-07">完成开户</th>
                  </tr>
                </tbody>
              </table>
            </div>
      </br>
        <div class="mc-SHFE-link">
          <p>资料详情：<a href="http://www.ine.cn/upload/20200415/1586917808092.pdf">http://www.ine.cn/upload/20200415/1586917808092.pdf</a></p>
        </div>
      </div>
 
        
      </div>
    
      </div>
        


    

<!-- News PDF Page Content End -->
  </div>
</div>





</body>

<?php include('global/footer.php'); ?>



</html>




