<style>
/* About Us Page Background */
    #about-us-03 .aboutus-container{
        background-image: url("../images/au-bg.png");
        background-repeat: no-repeat;
        background-size: cover;
        background-position: 50% 50%;
    }

/* About Us Page Top Button */
#about-us-03 .top-btn{
        display: flex;
        list-style-type: none;
        padding: 50px 10px;
    }

    #about-us-03 ul.top-btn a {
        font-size: 18px;
        color: #797979;
        line-height: 50px;
        text-decoration: none;
    }

    @media only screen and (min-width: 677px) {
    #about-us-03 li.btn-01{
        width: 150px;
        height: 50px;
        text-align: center;
        border: 1px solid #fff;
        border-radius: 10px 0px 0px 10px;
        border-right: 1px solid #eee; 
    }
}
    
    #about-us-03 .btn-01 a {
        color: #fff !important;
    }

    #about-us-03 li.btn-02{
        width: 150px;
        height: 50px;
        text-align: center;
        border: 1px solid #fff;
        border-radius: 0px 10px 10px 0px;
        background-color: #fff; 
    }

/* About Us Page Content */
    #about-us-03 .aboutus-content {
        max-width: 1150px;
        margin: auto;   
    }

    #about-us-03 h5.au-title {
        font-size: 24px;
        font-weight: 900;
        color: #fff;
        padding-bottom: 20px;
    }

    #about-us-03 .col-lg-12.col-sm-12 p {
        font-size: 14px;
        color: #fff;
        padding-bottom: 10px;
    }

    #about-us-03 .row.aboutus-wrapper {
        padding-bottom: 150px;
    }


/* Mobile Page */
    @media only screen and (max-width: 676px) {
        /* About Us Page Background */
        #about-us-03 .aboutus-container{
            background-image: url("../images/au-m-bg.png");
            background-repeat: no-repeat;
            background-size: cover;
            background-position: 50% 50%;
        }

        #about-us-03 li.btn-01{
            width: 97px;
            height: 30px;
            text-align: center;
            border: 1px solid #fff;
            border-radius: 10px 0px 0px 10px;
            border-right: 1px solid #eee;
        }

        #about-us-03 .btn-01 a {
            color: #fff !important;
        }

        #about-us-03 li.btn-02{
            width: 97px;
            height: 30px;
            text-align: center;
            border: 1px solid #fff;
            border-radius: 0px 10px 10px 0px;
            background-color: #fff; 
        }
        
        #about-us-03 ul.top-btn a{
            line-height: inherit;
        }
        
        #about-us-03 ul.top-btn a {
            font-size: 14px;
            color: #797979;
        }

        #about-us-03 .top-btn {
            display: flex;
            list-style-type: none;
            padding: 25px 10px;
            padding-bottom: 10px;
        }

        #about-us-03 h5.au-title {
            font-size: 12px;
            font-weight: 900;
            color: #fff;
            padding-bottom: 20px;
        }

        #about-us-03 .col-lg-12.col-sm-12 p {
            font-size: 12px;
            color: #fff;
            padding-bottom: 0px;
        }

        #about-us-03 .col-lg-12.col-sm-12 {
            padding: 0px 0px;
        }
        
        #about-us-03 .row.aboutus-wrapper {
            padding-bottom: 80px;
        }

    /* Full Page Padding */
        #about-us-03 .row.aboutus-wrapper .col-lg-9.col-sm-12 {
            padding: 0px;
        }

        #about-us-03 .col-lg-3.col-sm-12 {
            padding: 0px;
        }

    }




    

</style>

<!doctype html>
    <html>
        <?php include('global/html_head.php'); ?>

<body id="about-us-03">
<?php $a = 1;?>
        <?php include('global/header.php'); ?>

<?php
	$img = '';
	$sql = "select img from ".TB_WEBPAGE_PHOTO;
	$sql .= " where  ";
	$sql .= " disabled='0' ";
	$sql .= " and webpage_id=9 ";
	//$sql .= " and language_id='".CURRENT_LANG."' ";
	 $sql .= " order by sort_order asc  limit 0,1 ";
	$rowsp = $G_DB_CONNECT->query($sql);
	if($G_DB_CONNECT->affected_rows > 0){	
			while($datap = $G_DB_CONNECT->fetch_array($rowsp)){
			
				$img = DIR_PATH.$datap['img'];
							$arr_data = getThumbPhotoPath($img,"img",200,200);
$thumb = $arr_data['img_path'];
			}
	}
?>



<!-- About Us Page Background & Top Button -->
    <div class="container-fluid aboutus-container"  style="background-image:url(<?php echo $img; ?>)">
        <div class="d-flex justify-content-center">
            <ul class="top-btn">
                <li class="btn-01"><a href="../en/about_us.php">About Huatai</a></li>
                <li class="btn-02"><a href="../en/about_us_02.php">Our Group</a></li>
            </ul>
        </div>
<!-- About Us Page Content -->
    <div class="container aboutus-content">
        <div class="row aboutus-wrapper">
            <div class="col-lg-12 col-sm-12">
                   <?php echo webpageContent(9,CURRENT_LANG); ?>


		   </div>

        </div>
    </div>


</div>

    













  
</body>

<?php include('global/footer.php'); ?>

</html>