<style>
/* Product & Service FAQ Banner and Title (pas-faq) */
  #pas-faq .ctm-width{
    max-width: 1200px;
    margin: auto;
  }

  #pas-faq .title-bg {
    background-color: #F6F6F6;
    padding: 15px 0;
  }

  #pas-faq .title-bg h3 {
    font-size: 18px;
    font-weight: bold;
    display: inline-block;
    margin: 0 80px;
  }

  #pas-faq span.square {
    border: 1px solid #D93A16;
    padding: 9px 4px;
    background-color: #D93A16;
    position: absolute;
    top: 0px;
    left: 75px;
  }

  #pas-faq .backToTopBtn {
    display: none;
}



/* Product & Service FAQ Content (pas-faq) */
#pas-faq .container.pas-faq {
    max-width: 1085px;
    margin: auto;
    padding: 50px 0px 50px 0px;
  }

  #pas-faq .card {
    border: none;
  }

  #pas-faq .card-header {
    background-color: transparent;
    padding: 15px 10px 5px 15px;
    border: transparent;
}

#pas-faq span.mb-0-text {
    font-size: 14px;
    color: #797979;
    padding-left: 5px;
}

  #pas-faq .mb-0 {
    border-bottom: 1px solid #ADADAD;
    padding: 5px 0px 5px 0px;
  }

  #pas-faq .panel-text {
    display: inline-flex;
    font-size: 14px;
    color: #797979;
    padding-left: 10px;
}

#pas-faq button.btn.btn-link.collapsed {
    padding: 5px 0px 5px 0px;
}

#pas-faq .btn-link:hover {
    color: #797979;
    text-decoration: none;
    padding: 5px 0px 5px 0px;
}

  #pas-faq button.btn.btn-link.collapsed:before {
    content: "\f055";
    font-family: "FontAwesome";
    font-size: 16px;
    color: #D93A16;
    text-decoration: none;
  }

  #pas-faq button.btn.btn-link:before {
    content: "\f056";
    font-family: 'FontAwesome';
    font-size: 16px;
    color: #D93A16;
    text-decoration: none;
  }

/* Question info */
#pas-faq .card-body {
  padding: 15px 40px 15px 40px;
}

#pas-faq h4.panel-title span {
    font-size: 14px;
    color: #797979;
    padding-left: 10px;
}

#pas-faq button.btn.btn-link {
    padding: 5px 0px 5px 0px;
}

#pas-faq .panel-heading {
    border-bottom: 1px solid #ADADAD;
    padding-bottom: 15px;
}

#pas-faq .panel-text {
    position: absolute;
}

#pas-faq .faq-question {
    padding: 1px 25px 10px 10px;
}

#pas-faq .btn-link {
  color: #797979;
  text-decoration: none;
}

#pas-faq i.fa.fa-plus-circle {
    font-size: 16px;
    color: #D93a16;
}

#pas-faq i.fa.fa-minus-circle {
    font-size: 16px;
    color: #D93a16;
}


#pas-faq .panel-body p {
    font-size: 14px;
    color: #797979;
    padding: 10px 30px 0px 30px;
}

#pas-faq .panel.panel-default {
    padding: 10px 0px 10px 0px;
}

#pas-faq .panel-text {
    font-family: arial;
}




/* Mobile Page */
@media only screen and (max-width: 767px){
  /* Title */
  #pas-faq span.square {
    padding: 7px 4px;
    left: 25px;
    top: 2px;
    }

  #pas-faq .title-bg h3 {
    margin: 0 30px;
}

  #pas-faq .col-lg-12.col-12.pas-faq-col {
    padding: 0px;
}

#pas-faq .container.pas-faq {
    max-width: 340px;
    padding: 5px 0px 30px 0px;
}

#pas-faq .card-header {
    padding: 10px 20px 10px 20px;
}

#pas-faq i.fa.fa-plus-circle {
  display: inline-flex;
  float: left;
  }

  #pas-faq .card-body {
    padding: 0px 40px 15px 40px;
}

#pas-faq .panel-heading {
    padding-bottom: 75px;
}

#pas-faq i.fa.fa-minus-circle {
    display: inline-flex;
    float: left;
}

}



   

  







    
    

</style>

<!doctype html>
  <html>
    <?php include('global/html_head.php'); ?>
<a href="" id="backToTopAchor"></a>
<body id="pas-faq">

    <?php include('global/header.php'); ?>



<?php
	$banner = '';
	$sql = "select img from ".TB_BANNER_PHOTO;
	$sql .= " where  ";
	$sql .= " disabled='0' ";
	$sql .= " and banner_id=11 ";
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


<!-- Back To Top Button -->
  <a id="button" class="backToTopBtn" href="#backToTopAchor"><img src="../images/group_2743.png" alt=""></a>

<!-- Product & Service FAQ Banner and Title -->
  <div class="container-fluid contactus-container" style="padding: 0;">
    <img src="<?php echo $banner; ?>" class="img-fluid" style="width: 100%;">
  </div>

  <div class="contaniner-fluid">
    <div class="title-bg">
      <div class="col-lg-12 ctm-width"><span class="square"></span><h3>FAQs</h3></div>
    </div>
  </div>

<!-- Product & Service FAQ Content -->
  <div class="container pas-faq">
    <div class="row">
      <div class="col-lg-12 col-12 pas-faq-col">




        <!-- Accordion One -->
          <div class="accordion" id="accordionExample">
		  
		  
		  





<?php

	
			$sql = "select faq_category.*, faq_category_desc.name as name, faq_category_desc.detail  from ".TB_FAQ_CATEGORY." as faq_category , ".TB_FAQ_CATEGORY_DESC." as faq_category_desc ";
			$sql .= " where ";
			$sql .= " faq_category.id=faq_category_desc.faq_category_id ";
			$sql .= " and faq_category_desc.language_id='".CURRENT_LANG."' ";
			$sql .= " and faq_category.disabled='0' ";


		 
		 $sql .= "  order by  faq_category.sort_order asc ";
			

		$rows3 = $G_DB_CONNECT->query($sql);
		$total_record = $G_DB_CONNECT->affected_rows;
		if($G_DB_CONNECT->affected_rows > 0){
			
			while($data3 = $G_DB_CONNECT->fetch_array($rows3)){
			
					$faq_category_id = $data3['id'];
				
					$faq_category_name =$data3['name'];
	
				
?>
  
		  
		  
            <div class="card">
              <div class="card-header" id="headingOne<?php echo $faq_category_name; ?>">
                <h2 class="mb-0">
                  <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseOne<?php echo $faq_category_name; ?>" aria-expanded="false" aria-controls="collapseOne<?php echo $faq_category_name; ?>">
                    <span class="mb-0-text"><?php echo $faq_category_name ?></span>
                  </button>
                </h2>
              </div>

              <div id="collapseOne<?php echo $faq_category_name; ?>" class="collapse" aria-labelledby="headingOne<?php echo $faq_category_name; ?>" data-parent="#accordionExample">
                <div class="card-body">
              
			  
			  
<?php

	
			$sql = "select faq.*, faq_desc.name as name, faq_desc.detail  from ".TB_FAQ." as faq , ".TB_FAQ_DESC." as faq_desc ";
			$sql .= " where ";
			$sql .= " faq.id=faq_desc.faq_id ";
			$sql .= " and faq_desc.language_id='".CURRENT_LANG."' ";
			$sql .= " and faq.disabled='0' ";
			$sql .= " and faq_category_id='$faq_category_id' ";
		 

		 
		 $sql .= "  order by  faq.sort_order asc ";
			

		$rows = $G_DB_CONNECT->query($sql);
		$total_record = $G_DB_CONNECT->affected_rows;
		if($G_DB_CONNECT->affected_rows > 0){
			
			while($data = $G_DB_CONNECT->fetch_array($rows)){
			
					$faq_id = $data['id'];
					$faq_date = formatDate($data['display_date']);
				
					$faq_name =$data['name'];
	
					$faq_detail = displayHTML($data['detail']);
					

				
?>
  
                <!-- Question 1-->
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $faq_id;?>" class="fa-icon">
                        <i class="fa fa-plus-circle faq-fa-icon" aria-hidden="true" onclick="myFunction(this)">
                          <div class="panel-text">
                            <div class="faq-question">
                              <?php echo $faq_name ?>
                            </div>
                          </div>
                        </i>
                        </a>
                      </h4>
                    </div>

                    <div id="collapse<?php echo $faq_id;?>" class="panel-collapse collapse">
                      <div class="panel-body">
                      <?php echo $faq_detail ?>

				   </div>
                    </div>
                  </div>    
                <!--Question 1 END-->

<?php

	
			}
		}

				
?>
  


                
                </div>
              </div>
            </div>
          <!-- Accordion One END -->





<?php

	
			}
		}

				
?>
  











</div>


      




      
   
      </div>
    </div>   
  </div>
<!-- container pas-faq END-->  



















       
       



  
    
    


</body>

<?php include('global/footer.php'); ?>


<script>

/*var iconContainer = document.querySelector("#accordionEx");
var listIcon = document.querySelector(".accordion_icon");

iconContainer.addEventListener("click", function () {
  var aTag = iconContainer.querySelector("a");
  //console.log(aTag);

  if (aTag.classList.contains("collapsed")) {
    listIcon.classList.add("fa-plus-circle");
    listIcon.classList.remove("fa-minus-circle");
  } else {
    listIcon.classList.remove("fa-plus-circle");
    listIcon.classList.add("fa-minus-circle");
  }
});*/



// fa-fa-icon

function myFunction(x) {
  x.classList.toggle("fa-minus-circle");
  x.classList.toggle("fa-plus-circle");
}


</script>

</html>




