<!doctype html>
  <html>

  <?php include('global/html_head.php'); ?>

<style>
  /* Product and Service Software Page Banner and Title */
    #pas-software .col-lg-12.ctm-width {
      max-width: 980px;
      margin: auto;
    }
  
    #pas-software .title-bg {
      background-color: #F6F6F6;
    }

    #pas-software .title-bg h3 {
      display: inline-block;
      font-size: 18px;
      font-weight: bold;
      line-height: 18px;
      padding: 10px 0px 5px 10px;
    }

    #pas-software span.square {
      display: inline-block;
      border: 1px solid #D93A16;
      background-color: #D93A16;
      padding: 9px 5px;
      position: absolute;
      left: 0px;
      top: 9px;
    }

  /* Product and Service Software Page Content */
    #pas-software .container.pas-software-page {
      max-width: 980px;
      margin: 80px auto;
    }

    #pas-software .col-lg-12.col-12.top-column {
      padding: 0px;
    }

    #pas-software ul#pills-tab {
      display: flex;
      justify-content: space-evenly;
    }

    /* software Title */
      #pas-software .nav-pills .nav-link.active, .nav-pills .show>.nav-link {
        font-size: 14px;
        color: #333333;
        background-color: transparent;
        border: none;
        text-decoration: none;
      }

      #pas-software .nav-pills .nav-link {
        font-size: 14px;
        color: #333;
        border-radius: 0px;
        text-decoration: none;
      }

      #pas-software .pas-software-page .nav-link.active span {
        border-bottom: 2px solid #D93A16;
        padding-bottom: 3px;
        display: block;
        text-align: center;
        padding-top: 5px;
      }

      #pas-software .pas-software-page .nav-link span {
        padding-bottom: 3px;
        display: block;
        text-align: center;
        padding-top: 5px;
      }
/*
      #pas-software li.nav-item span {
        display: block;
        text-align: center;
        padding-top: 5px;
      }*/

      #pas-software a.nav-link:hover {
        border-bottom: none;
      }

  /* Tab Body - Title */
    #pas-software .pap-text {
      margin-bottom: 100px;
    }

    #pas-software h3.tp-text {
      font-size: 16px;
      color: #333;
      border-bottom: 1px solid #707070;
      padding-bottom: 5px;
    }

    #pas-software p.tp-sm-text {
      font-size: 14px;
      color: #797979;
    }

    #pas-software ul.tp-list {
      font-size: 14px;
      color: #797979;
      padding: 20px 0px 30px 0px;
      list-style-type: none;
      line-height: 30px;
    }

    /* Tab Body (MD-Page) */
      #pas-software p.md-qr-code {
        font-size: 14px;
        color: #333;
      }

      #pas-software p.mddf-text {
        font-size: 14px;
        color: #333333;
        padding: 30px 0px 0px 0px;
      }

      #pas-software .md-dl-file a {
        font-size: 14px;
        color: #D93A16;
        text-decoration: none;
      }
      
      #pas-software span.mddf-red-img {
        padding: 0px 0px 0px 5px;
      }

      #pas-software h3.tp-text-02 {
        font-size: 16px;
        color: #333;
        border-bottom: 1px solid #707070;
        padding: 80px 0px 5px 0px;
      }

      #pas-software p.mddf-red-text a {
        font-size: 14px;
        color: #D93A16;
        text-decoration: none;
      }
    
    /* MD Page Back to top button */
   

    /* MD Page FAQ Button */
    #pas-software img.faq-img-sm {
      position: fixed;
      right: 40px;
      bottom: 0px;
      z-index: 999;
    }
    
    
    #pas-software img.si-01 {
      width: 100%; 
      max-height:95px;
    }

    #pas-software img.si-02 {
      width: 100%; 
      max-height:95px;
    }

    #pas-software img.si-03 {
      width: 100%; 
      max-height:95px;
    }

    /*Back to top btn */
     #pas-software .backToTopBtn-01 {
    position: absolute;
    bottom: -20px;
    right: -390px;
}
  
/* Mobile Page */
@media only screen and (max-width: 767px) {
  #pas-software span.square {
    padding: 8px 4px;
    left: 15px;
  }

  #pas-software .title-bg h3 {
    padding: 10px 0px 5px 18px;
  }

  #pas-software .container.pas-software-page {
    margin: 30px 0px;
  }

  #pas-software .col-lg-12.col-12.top-column {
    padding: 0px 15px;
  }

  /* img */
    #pas-software .pap-text {
      text-align: center;
      margin-bottom: 45px;
    }
    
    #pas-software img.si-01 {
      width: auto; 
      max-height: 40px;
    }

    #pas-software img.si-02 {
      width: auto; 
      max-height: 40px;
    }

    #pas-software img.si-03 {
      width: auto; 
      max-height: 40px;
    }

    #pas-software li.nav-item {
      padding: 0px;
      border-bottom: none;
    }

    #pas-software h3.tp-text {
      font-size: 14px;
    }

    #pas-software p.tp-sm-text {
      font-size: 12px;
    }

    #pas-software ul.tp-list {
      font-size: 12px;
      padding: 10px 0px 20px 0px;
      list-style-type: none;
      line-height: 24px;
    }

    #pas-software p.md-qr-code {
      font-size: 12px;
    }

    #pas-software p.mddf-text {
      font-size: 12px;
      padding-top: 0px
    }

    #pas-software h3.tp-text-02 {
      font-size: 14px;
      padding: 40px 0px 5px 0px;
    }

    #pas-software p.mddf-red-text a {
      font-size: 12px;
      text-decoration: none;
    }

    

    #pas-software img.faq-img-sm {
      position: fixed;
      right: 7px;
      top: 510px;
      width: 75px;
      z-index: 999;
    }

    #pas-software .md-dl-file {
      padding: 30px 0px;
    }

    #pas-software .atp-dl-file {
      padding: 30px 0px;
    }

    #pas-software .col-lg-3.col-6.empty-div {
      display: none;
    }

    #pas-software .backToTopBtn-01 {
    position: absolute;
    bottom: 0px;
    right: 30px;
}



}
  

</style>


<body id="pas-software">
  <a href="" id="backToTopAchor"></a>

    <?php include('global/header.php'); ?>

      <?php
        $banner = '';
        $sql = "select img from ".TB_BANNER_PHOTO;
        $sql .= " where  ";
        $sql .= " disabled='0' ";
        $sql .= " and banner_id=9 ";
        //$sql .= " and language_id='".CURRENT_LANG."' ";
        $sql .= " order by sort_order asc  limit 0,1 ";
        $rowsp = $G_DB_CONNECT->query($sql);
        if($G_DB_CONNECT->affected_rows > 0){	
            while($datap = $G_DB_CONNECT->fetch_array($rowsp)){
            
              $banner = DIR_PATH.$datap['img'];
                    $arr_data = getThumbPhotoPath($img,"img",200,200);
          $thumb = $arr_data['img_path'];
            }
        }
          
      ?>

<!-- Product and Service Software Page Banner and Title -->
  <div class="container-fluid contactus-container" style="padding: 0;">
    <img src="<?php echo $banner; ?>" class="img-fluid" style="width: 100%;">
  </div>

  <div class="contaniner-fluid">
    <div class="title-bg">
      <div class="col-lg-12 ctm-width"><span class="square"></span><h3>软件下载</h3></div>
    </div>
  </div>



<!-- FAQ Icon -->
  <div class="faq-img"><a href="../sc/pas_faq.php"><img src="../images/faq.svg" alt="" class="faq-img-sm" width="100px"></a></div>


<!-- Product and Service Software Page Content -->
<div class="container pas-software-page">
  <div class="row psp-content">
    <div class="col-lg-12 col-12 top-column">

      <!--Tab Column -->
      <div class="pap-text">
          <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
            <li class="nav-item">
              
              <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true"><div class="pap-img-01"><img src="../images/software-01.png" alt="" class="si-01"></div><span>易盛交易系统</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false"><div class="pap-img-02"><img src="../images/software-02.png" alt="" class="si-02"></div><span>ATP交易系统</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false"><div class="pap-img-03"><img src="../images/software-03.png" alt="" class="si-03"></div><span>TT交易系统</span></a>
            </li>
          </ul>
      </div>

      <!--Tab One -->
      <a id="button" class="backToTopBtn-01" href="#backToTopAchor"><img src="../images/group_2743.png" alt=""></a>

      <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">

              <?php

            
                $sql = "select download_software.*, download_software_desc.name as name, download_software_desc.detail  from ".TB_DOWNLOAD_SOFTWARE." as download_software , ".TB_DOWNLOAD_SOFTWARE_DESC." as download_software_desc ";
                $sql .= " where ";
                $sql .= " download_software.id=download_software_desc.download_software_id ";
                $sql .= " and download_software_desc.language_id='".CURRENT_LANG."' ";
                $sql .= " and download_software.disabled='0' ";
                $sql .= " and download_software_category_id=1 ";
              

              
              $sql .= "  order by  download_software.sort_order asc ";
                

                $rows = $G_DB_CONNECT->query($sql);
                $total_record = $G_DB_CONNECT->affected_rows;
                if($G_DB_CONNECT->affected_rows > 0){
                
                  while($data = $G_DB_CONNECT->fetch_array($rows)){
                
                      $download_software_id = $data['id'];
                      $download_software_date = formatDate($data['display_date']);
                  
                      $download_software_name =$data['name'];
            
                      $download_software_detail = displayHTML($data['detail']);
                    

                  
              ?>
            
                <h3 class="tp-text"><?php echo $download_software_name; ?></h3> 
                  <?php echo $download_software_detail; ?>

                      <div class="qr-code">
                        <div class="row">
                    
                        <?php
                          $sql = "select * from ".TB_DOWNLOAD_SOFTWARE_PHOTO02;
                          $sql .= " where download_software_id='".$download_software_id."' and disabled=0";
                          $sql .= " order by sort_order asc ";
                          $rows2 = $G_DB_CONNECT->query($sql);
                          if($G_DB_CONNECT->affected_rows > 0){
                              while($data2 = $G_DB_CONNECT->fetch_array($rows2)){
                                $title = nl2br($data2['title_'.CURRENT_LANG_DIR]);
                                $img = DIR_PATH.$data2['img'];
                        ?>
                        
                        <div class="col-lg-12 col-6 pb-3">
                            <span class="md-qr-code"><?php echo $title; ?></span><br>
                            <span class="md-qrc-img"><img src="<?php echo $img; ?>" alt="" style="max-width:100px;"></span>
                        </div>	  
                      
                        <?php
                            }
                          }
                        ?>	
                
                        </div>
                      </div>

                      <div class="atp-dl-file">
                        <div class="row">

                          <?php
                            $sql = "select * from ".TB_DOWNLOAD_SOFTWARE_PHOTO;
                            $sql .= " where download_software_id='".$download_software_id."' and disabled=0";
                            $sql .= " order by sort_order asc ";
                            $rows2 = $G_DB_CONNECT->query($sql);
                            if($G_DB_CONNECT->affected_rows > 0){
                                while($data2 = $G_DB_CONNECT->fetch_array($rows2)){
                                  $title_text = ($data2['title_'.CURRENT_LANG_DIR]);
                                  $title = nl2br($data2['title_'.CURRENT_LANG_DIR]);
                                  $img = DIR_PATH.$data2['img'];
                                  $file = DIR_PATH.$data2['img2'];
                          ?>
                      
                        <div class="col-lg-4 col-6">
                          <p class="mddf-text"><?php echo $title ?><br></p>
                          <p class="mddf-img"><img src="<?php echo $img ; ?>" style="max-height:80px;"></p>
                          <p class="mddf-red-text"><a href="<?php echo $file ; ?>" download="<?php echo $title_text ; ?>">点击此处下载<span class="mddf-red-img"><img src="../images/download.svg" alt=""></span></a></p>
                        </div>

                        <?php
                              }
                          }
                        ?>	
                

                        </div> 
                      </div>

                        <?php
                          }
                            }
                        ?>
            </div>
      <!-- End of Tab One -->

      <!-- Tab Two -->
      <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">

          <?php

            
                $sql = "select download_software.*, download_software_desc.name as name, download_software_desc.detail  from ".TB_DOWNLOAD_SOFTWARE." as download_software , ".TB_DOWNLOAD_SOFTWARE_DESC." as download_software_desc ";
                $sql .= " where ";
                $sql .= " download_software.id=download_software_desc.download_software_id ";
                $sql .= " and download_software_desc.language_id='".CURRENT_LANG."' ";
                $sql .= " and download_software.disabled='0' ";
                $sql .= " and download_software_category_id=2 ";
              

              
              $sql .= "  order by  download_software.sort_order asc ";
                

              $rows = $G_DB_CONNECT->query($sql);
              $total_record = $G_DB_CONNECT->affected_rows;
              if($G_DB_CONNECT->affected_rows > 0){
                
                while($data = $G_DB_CONNECT->fetch_array($rows)){
                
                    $download_software_id = $data['id'];
                    $download_software_date = formatDate($data['display_date']);
                  
                    $download_software_name =$data['name'];
            
                    $download_software_detail = displayHTML($data['detail']);
                    

                  
          ?>

            <h3 class="tp-text"><?php echo $download_software_name; ?></h3> 
            <?php echo $download_software_detail; ?>

            <div class="qr-code">
              <div class="row">
            
                <?php
                  $sql = "select * from ".TB_DOWNLOAD_SOFTWARE_PHOTO02;
                  $sql .= " where download_software_id='".$download_software_id."' and disabled=0";
                  $sql .= " order by sort_order asc ";
                  $rows2 = $G_DB_CONNECT->query($sql);
                  if($G_DB_CONNECT->affected_rows > 0){
                      while($data2 = $G_DB_CONNECT->fetch_array($rows2)){
                        $title = nl2br($data2['title_'.CURRENT_LANG_DIR]);
                        $img = DIR_PATH.$data2['img'];
                ?>
                
                  <div class="col-lg-12 col-6 pb-3">
                    <span class="md-qr-code"><?php echo $title; ?></span><br>
                    <span class="md-qrc-img"><img src="<?php echo $img; ?>" alt="" style="max-width:100px;"></span>
                  </div>	  
        
                    <?php
                          }
                      }
                    ?>	

              </div>
            </div>

            <div class="atp-dl-file">
              <div class="row">
          
                  <?php
                    $sql = "select * from ".TB_DOWNLOAD_SOFTWARE_PHOTO;
                    $sql .= " where download_software_id='".$download_software_id."' and disabled=0";
                    $sql .= " order by sort_order asc ";
                    $rows2 = $G_DB_CONNECT->query($sql);
                    if($G_DB_CONNECT->affected_rows > 0){
                        while($data2 = $G_DB_CONNECT->fetch_array($rows2)){
                          $title_text = ($data2['title_'.CURRENT_LANG_DIR]);
                          $title = nl2br($data2['title_'.CURRENT_LANG_DIR]);
                          $img = DIR_PATH.$data2['img'];
                          $file = DIR_PATH.$data2['img2'];
                  ?>

                <div class="col-lg-4 col-6">
                  <p class="mddf-text"><?php echo $title ?><br></p>
                  <p class="mddf-img"><img src="<?php echo $img ; ?>" style="max-height:80px;"></p>
                  <p class="mddf-red-text"><a href="<?php echo $file ; ?>" download="<?php echo $title_text ; ?>">点击此处下载<span class="mddf-red-img"><img src="../images/download.svg" alt=""></span></a></p>
                </div>

                <?php
                      }
                  }
                ?>	

              </div> 
            </div>

              <?php

                    }
                  }
                        

                      
              ?>
      </div>
      <!-- End of Tab Two -->

      <!-- Tab Three -->
      <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">

              <?php

              
                  $sql = "select download_software.*, download_software_desc.name as name, download_software_desc.detail  from ".TB_DOWNLOAD_SOFTWARE." as download_software , ".TB_DOWNLOAD_SOFTWARE_DESC." as download_software_desc ";
                  $sql .= " where ";
                  $sql .= " download_software.id=download_software_desc.download_software_id ";
                  $sql .= " and download_software_desc.language_id='".CURRENT_LANG."' ";
                  $sql .= " and download_software.disabled='0' ";
                  $sql .= " and download_software_category_id=3 ";
                

                
                $sql .= "  order by  download_software.sort_order asc ";
                  

                $rows = $G_DB_CONNECT->query($sql);
                $total_record = $G_DB_CONNECT->affected_rows;
                if($G_DB_CONNECT->affected_rows > 0){
                  
                  while($data = $G_DB_CONNECT->fetch_array($rows)){
                  
                      $download_software_id = $data['id'];
                      $download_software_date = formatDate($data['display_date']);
                    
                      $download_software_name =$data['name'];
              
                      $download_software_detail = displayHTML($data['detail']);
                      

                    
              ?>

                <h3 class="tp-text"><?php echo $download_software_name; ?></h3> 
                <?php echo $download_software_detail; ?>

            <div class="qr-code">
              <div class="row">

                  <?php
                    $sql = "select * from ".TB_DOWNLOAD_SOFTWARE_PHOTO02;
                    $sql .= " where download_software_id='".$download_software_id."' and disabled=0";
                    $sql .= " order by sort_order asc ";
                    $rows2 = $G_DB_CONNECT->query($sql);
                    if($G_DB_CONNECT->affected_rows > 0){
                        while($data2 = $G_DB_CONNECT->fetch_array($rows2)){
                          $title = nl2br($data2['title_'.CURRENT_LANG_DIR]);
                          $img = DIR_PATH.$data2['img'];
                  ?>
                
                  <div class="col-lg-12 col-6 pb-3">
                    <span class="md-qr-code"><?php echo $title; ?></span><br>
                    <span class="md-qrc-img"><img src="<?php echo $img; ?>" alt="" style="max-width:100px;"></span>
                  </div>	  
              
                    <?php
                          }
                      }
                    ?>	

              </div>
            </div>

                <div class="atp-dl-file">
                  <div class="row">
                    <?php
                      $sql = "select * from ".TB_DOWNLOAD_SOFTWARE_PHOTO;
                      $sql .= " where download_software_id='".$download_software_id."' and disabled=0";
                      $sql .= " order by sort_order asc ";
                      $rows2 = $G_DB_CONNECT->query($sql);
                      if($G_DB_CONNECT->affected_rows > 0){
                          while($data2 = $G_DB_CONNECT->fetch_array($rows2)){
                            $title_text = ($data2['title_'.CURRENT_LANG_DIR]);
                            $title = nl2br($data2['title_'.CURRENT_LANG_DIR]);
                            $img = DIR_PATH.$data2['img'];
                            $file = DIR_PATH.$data2['img2'];
                    ?>

                    <div class="col-lg-4 col-6">
                      <p class="mddf-text"><?php echo $title ?><br></p>
                      <p class="mddf-img"><img src="<?php echo $img ; ?>" style="max-height:80px;"></p>
                      <p class="mddf-red-text"><a href="<?php echo $file ; ?>" download="<?php echo $title_text ; ?>">点击此处下载<span class="mddf-red-img"><img src="../images/download.svg" alt=""></span></a></p>
                    </div>

                    <?php
                      }
                        }
                    ?>	
          

                  </div> 
                </div>
            
                <?php

                    }
                  }	
                ?>

      </div>

      </div>
  
    </div>
  </div>
</div>


    







  
  
  
  
  
  







  
    





</body>

<?php include('global/footer.php'); ?>


<script>
/* $(document).ready(function(){
  $('nav ul li').click(function(){
    $('nav ul li').removeClass("active");
    $(this).addClass("active");
});
}); */


</script>

</html>




