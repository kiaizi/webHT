<!doctype html>
  <html>
    <?php include('global/html_head.php'); ?>
	  <?php $a=5;?>
    <?php include('global/header.php'); ?>

<style>
  /* Prodcut and Service Client Deposit Page Banner & Title */
    #client-deposit .ctm-width{
      max-width: 1080px;
      margin: auto;
    }

    #client-deposit .title-bg{
      background-color: #F6F6F6;
    }

    #client-deposit .title-bg h3{
      font-size: 18px;
      font-weight: bold;
      display: inline-block;
      padding: 10px 0px 5px 10px;
    }

    #client-deposit span.square{
      border: 1px solid #D93A16;
      padding: 9px 4px;
      background-color: #D93A16;
      position: absolute;
      top: 10px;
      left: 0px;
    }

/* Prodcut and Service Client Deposit Page Content */
    #client-deposit .container.cd-content {
      max-width: 1080px;
      margin: auto;
    }

    #client-deposit .col-lg-12.col-12.cd-list-tb {
      margin-top: 50px;
      margin-bottom: 80px;
      padding: 0px;
    }

    #client-deposit .fa {
      float: left;
      margin-right: 10px;
      font-size: 16px !important;
      color: #D93A16;
    }

    #client-deposit h4.panel-title a {
      font-size: 14px;
      color: #797979! important;
      text-decoration: none;
      display: flow-root;
   
    }

    #client-deposit .panel-default {
    border: transparent;
    padding: 15px 0px;
    }


    #client-deposit h4.panel-title span {
      font-size: 14px;
      color: #797979! important;
      text-decoration: none;
      padding-left: 10px;
    }

    #client-deposit .panel-body {
      font-size: 14px;
      color: #797979;
      padding-bottom: 20px;
    }

  /* Prodcut and Service Client Deposit Page Content (table) */
    #client-deposit table.client-deposit {
      margin: 15px auto;
    }

  #client-deposit td.cd-tb-title {
    font-size: 14px;
    color: #333333;
    padding: 10px 10px;
    background: #F6F6F6;
    border: 1px solid;
    border-color: #D93A16 #D93A16 #ADADAD #D93A16;
  }

  #client-deposit td.cd-tb-content {
    font-size: 14px;
    color: #333;
    padding: 10px 10px;
    border: 1px solid #ADADAD;
  }

  /* Prodcut and Service Client Deposit Page Content (table - collapse control) */
    #client-deposit .cd-notes {
      padding-top: 20px;
    }

    #client-deposit span.note-square::before {
    border: 1px solid #D93A16;
    content: "";
    padding: 8px 4px;
    background-color: #D93A16;
    position: absolute;
    }

    #client-deposit span h5 {
      font-size: 18px;
      padding-left: 15px;
    }

    #client-deposit .cd-notes p {
      font-size: 14px;
      color: #797979;
      padding-left: 15px;
      padding-right: 0;
    }

    #client-deposit span.mailto a {
      color: #19457D;
      text-decoration: underline;
    }

    #client-deposit .backToTopBtn {
      display: none;
    }

    #client-deposit img.faq-icon {
      z-index: 9999;
      position: fixed;
      bottom: 0%;
      right: 2%;
    }

    #client-deposit ul.notes-list {
      font-size: 14px;
      color: #797979;
    }

    ul.notes-list a {
    color: #797979;
    text-decoration: none;
}

.col-lg-12.col-12.cd-list-tb h2 {
    font-size: 18px;
    font-weight: bold;
}
    

/* Mobile App */
@media only screen and (max-width: 767px){
  /* Banner & Title */
  #client-deposit span.square {
    padding: 8px 3px;
    position: absolute;
    top: 10px;
    left: 10px;
  }

  #client-deposit .title-bg h3 {
    font-size: 18px;
    padding: 10px 0px 5px 10px;
  }

  #client-deposit .col-lg-12.col-12.cd-list-tb {
    margin-top: 10px;
    margin-bottom: 50px;
    padding: 0px 10px;
  }

  #client-deposit h4.panel-title a {
    font-size: 14px;
    line-height: 26px;
}

#client-deposit h4.panel-title {
    padding-bottom: 5px;
    border-bottom: 1px solid #707070;
}


#client-deposit .fa {
    float: left;
    margin-right: 5px;
    font-size: 16px !important;
    color: #D93A16;
}

#client-deposit table.client-deposit {
    margin: 0px auto;
    width: 1000px;
}

#client-deposit .panel-body {
    overflow-x: scroll;
}

#client-deposit td.cd-tb-title {
    font-size: 14px;
}

#client-deposit td.cd-tb-content {
    font-size: 14px;
}

#client-deposit span h5 {
    font-size: 12px;
    padding-left: 15px;
}

#client-deposit .cd-notes p {
    font-size: 12px;
}

#client-deposit span.note-square::before {
    padding: 6px 3px;
}

#client-deposit .faq-img {
    position: absolute;
    right: 8px;
    width: 80px;
}

#client-deposit .backToTopBtn {
    display: block;
    position: absolute;
    right: 16px;
    bottom: -180px;
}

/* Scroll */
#client-deposit .scrollbar{
  width: 1000px;
  height: 30px;
}

#client-deposit .panel-body::-webkit-scrollbar {
  width: 20px; 
  height: 4px;
}

 #client-deposit .panel-body::-webkit-scrollbar-track {
  border: 1px solid #eeeeee;
  background-color: #eeeeee;
  border-radius: 5px;
 } 

#client-deposit .panel-body::-webkit-scrollbar-thumb {
  background-color: #D93A16;
  border-radius: 5px;
}

#client-deposit img.faq-icon {
     z-index: 9999;
    position: fixed;
    width: 75px;
    top: 60%;
    right: 0%;
}

#client-deposit ul.notes-list {
      font-size: 12px;
    }

    .col-lg-12.col-12.cd-list-tb h2 {
    padding-top: 20px;
}

}



</style>




<?php
	$banner = '';
	$sql = "select img from ".TB_BANNER_PHOTO;
	$sql .= " where  ";
	$sql .= " disabled='0' ";
	$sql .= " and banner_id=8 ";
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


<body id="client-deposit">
  <a href="" id="backToTopAchor"></a>

  <a href="../sc/pas_faq.php"><img src="../images/faq.svg" alt="" class="faq-icon"></a>

<!-- Prodcut and Service Client Deposit Page Banner & Title -->
  <div class="container-fluid contactus-container" style="padding: 0;">
    <img src="<?php echo $banner; ?>" class="img-fluid" style="width: 100%;">
  </div>

  <div class="contaniner-fluid">
    <div class="title-bg">
      <div class="col-lg-12 ctm-width"><span class="square"></span><h3>Fund Deposits & Withdrawal</h3></div>
    </div>
  </div>

<!-- Prodcut and Service Client Deposit Page Content -->




  
<?php

define('ID',1);
	
			$sql = "select deposit.*, deposit_desc.name as name, deposit_desc.detail, deposit_desc.detail2, deposit_desc.detail3, deposit_desc.detail4  from ".TB_DEPOSIT." as deposit , ".TB_DEPOSIT_DESC." as deposit_desc ";
			$sql .= " where ";
			$sql .= " deposit.id=deposit_desc.deposit_id ";
			$sql .= " and deposit_desc.language_id='".CURRENT_LANG."' ";
			$sql .= " and deposit.disabled='0' ";
			$sql .= " and id=".ID." ";
		 

		 
		 $sql .= "  order by  deposit.sort_order asc ";
			

		$rows = $G_DB_CONNECT->query($sql);
		$total_record = $G_DB_CONNECT->affected_rows;
		if($G_DB_CONNECT->affected_rows > 0){
			
			while($data = $G_DB_CONNECT->fetch_array($rows)){
			
					$deposit_id = $data['id'];
					$deposit_date = formatDate($data['display_date']);
				
					$deposit_name =$data['name'];
	
					$deposit_detail = displayHTML($data['detail']);
					$deposit_detail2 = displayHTML($data['detail2']);
					$deposit_detail3 = displayHTML($data['detail3']);
					$deposit_detail4 = displayHTML($data['detail4']);
					
}
}
				
?>





<div class="container cd-content">
  <div class="row">
    
    <div class="col-lg-12 col-12 cd-list-tb">
      <h2><?php echo $deposit_name; ?></h2>
      <!-- Product and Service Client Deposit Page << Accordion (Collapse) >> -->
        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
        
<?php
if($deposit_detail2 != ''){
?>
          <!-- Collapse One -->
            <div class="panel panel-default">
              <div class="panel-heading" role="tab" id="headingOne">
                <h4 class="panel-title">
                  <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                  <i onclick="myFunction(this)" class="accordion_icon fa fa-minus-circle"><span>中国银行(香港) - 香港交易所产品</span></i>
                  </a>
                </h4>
              </div>
          <!-- Collapse One (Body) -->
              <div id="collapseOne" class="panel-collapse collapse show" role="tabpanel" aria-labelledby="headingOne">
                <div class="panel-body">
                  <!-- Tables -->
                   <?php echo $deposit_detail2; ?>
                    </table>
                </div>
              </div>
            </div>
			
<?php
}
?>	
			
<?php
if($deposit_detail3 != ''){
?>
          <!-- Collapse Two -->
            <div class="panel panel-default">
              <div class="panel-heading" role="tab" id="headingTwo">
                <h4 class="panel-title">
                  <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    <i onclick="myFunction(this)" class="accordion_icon fa fa-minus-circle"><span>中国银行(香港) - 非香港交易所产品</span></i>
                  </a>
                </h4>
              </div>
            <!-- Collapse Two (Body) -->
              <div id="collapseTwo" class="panel-collapse collapse show" role="tabpanel" aria-labelledby="headingTwo">
                <div class="panel-body">
                    <!-- Tables -->
                       <?php echo $deposit_detail3; ?>
                </div>
              </div>
            </div>

<?php
}
?>
<?php
if($deposit_detail4 != ''){
?>
          <!-- Collapse Three -->
            <div class="panel panel-default">
              <div class="panel-heading" role="tab" id="headingThree">
                <h4 class="panel-title">
                  <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    <i onclick="myFunction(this)" class="accordion_icon fa fa-minus-circle"><span>中国工商银行(亚洲) - 非香港交易所产品</span></i>
                  </a>
                </h4>
              </div>
            <!-- Collapse Three (Body) -->
              <div id="collapseThree" class="panel-collapse collapse show" role="tabpanel" aria-labelledby="headingThree">
                <div class="panel-body">
                  <!-- Tables -->
                    <?php echo $deposit_detail4; ?>
                </div>
              </div>
            </div>
			
<?php
}
?>
			
			
			
        </div>
      
      <!-- Product and Service Client Deposit Page << Notes >> -->
	  <?php
	  if($deposit_detail != ''){
	  ?>
      <div class="cd-notes">
          <span class="note-square"><h5>Note：</h5></span>
          <div class="note-text"><?php echo $deposit_detail; ?></div>
      </div>
  <?php
	  }
	  ?>
	  
	  
	  
<?php

define('ID2',2);
	
			$sql = "select deposit.*, deposit_desc.name as name, deposit_desc.detail, deposit_desc.detail2, deposit_desc.detail3, deposit_desc.detail4  from ".TB_DEPOSIT." as deposit , ".TB_DEPOSIT_DESC." as deposit_desc ";
			$sql .= " where ";
			$sql .= " deposit.id=deposit_desc.deposit_id ";
			$sql .= " and deposit_desc.language_id='".CURRENT_LANG."' ";
			$sql .= " and deposit.disabled='0' ";
			$sql .= " and id=".ID2." ";
		 

		 
		 $sql .= "  order by  deposit.sort_order asc ";
			

		$rows = $G_DB_CONNECT->query($sql);
		$total_record = $G_DB_CONNECT->affected_rows;
		if($G_DB_CONNECT->affected_rows > 0){
			
			while($data = $G_DB_CONNECT->fetch_array($rows)){
			
					$deposit_id = $data['id'];
					$deposit_date = formatDate($data['display_date']);
				
					$deposit_name =$data['name'];
	
					$deposit_detail = displayHTML($data['detail']);
					$deposit_detail2 = displayHTML($data['detail2']);
					$deposit_detail3 = displayHTML($data['detail3']);
					$deposit_detail4 = displayHTML($data['detail4']);
					
}
}		
?>

	  
	  
      <div class="col-lg-12 col-12 cd-list-tb">
        <h2><?php echo $deposit_name; ?></h2>

        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
<?php
if($deposit_detail2 != ''){
?>
          <!-- Collapse Four -->
            <div class="panel panel-default">
              <div class="panel-heading" role="tab" id="headingFour">
                <h4 class="panel-title">
                  <a data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
                  <i onclick="myFunction(this)" class="accordion_icon fa fa-minus-circle"><span>中国银行(香港)</span></i>
                  </a>
                </h4>
              </div>
          <!-- Collapse Four (Body) -->
              <div id="collapseFour" class="panel-collapse collapse show" role="tabpanel" aria-labelledby="headingFour">
                <div class="panel-body">
                  <!-- Tables -->
                    <?php echo $deposit_detail2; ?>
                </div>
              </div>
            </div>
<?php
}
?>

<?php
if($deposit_detail3 != ''){
?>
          <!-- Collapse Five -->
          <div class="panel panel-default">
              <div class="panel-heading" role="tab" id="headingFive">
                <h4 class="panel-title">
                  <a data-toggle="collapse" data-parent="#accordion" href="#collapseFive" aria-expanded="true" aria-controls="collapseFive">
                  <i onclick="myFunction(this)" class="accordion_icon fa fa-minus-circle"><span>中国工商银行（亚洲）</span></i>
                  </a>
                </h4>
              </div>
          <!-- Collapse Five (Body) -->
		  
		  
              <div id="collapseFive" class="panel-collapse collapse show" role="tabpanel" aria-labelledby="headingFive">
                <div class="panel-body">
                  <!-- Tables -->
                     <?php echo $deposit_detail3; ?>
                </div>
              </div>
			  
			  
			  
            </div>

<?php
}
?>

	  <?php
	  if($deposit_detail != ''){
	  ?>
      <div class="cd-notes">
          <span class="note-square"><h5>Note：</h5></span>
          <div class="note-text"><?php echo $deposit_detail; ?></div>
      </div>
  <?php
	  }
	  ?>
	  
            
        </div>
      </div>

      

      <!-- Back To Top Button -->
          <a id="button" class="backToTopBtn" href="#backToTopAchor"><img src="../images/group_2743.png" alt=""></a>
    </div>
  </div>  
</div>








</body>

<?php include('global/footer.php'); ?>


<script>





// fa-fa-icon

function myFunction(x) {
  x.classList.toggle("fa-minus-circle");
  x.classList.toggle("fa-plus-circle");
}







</script>

</html>




