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
    padding-bottom: 5px;
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
  }

  #pas-faq .card-body {
    padding: 0px 40px 15px 40px;
}

#pas-faq .panel-heading {
  padding-bottom: 55px;
}

#pas-faq i.fa.fa-minus-circle {
    display: inline-flex;
}

}



   

  







    
    

</style>

<!doctype html>
  <html>
    <?php include('global/html_head.php'); ?>
<a href="" id="backToTopAchor"></a>
<body id="pas-faq">

    <?php include('global/header.php'); ?>





  <div class="contaniner-fluid">
    <div class="title-bg">
      <div class="col-lg-12 ctm-width"><span class="square"></span><h3>Terms and Disclaimer</h3></div>
    </div>
  </div>

<!-- Product & Service FAQ Content -->
  <div class="container pas-faq">
    <div class="row">
      <div class="col-lg-12 col-12 pas-faq-col">



<?php echo webpageContent(39,CURRENT_LANG); ?>




      
   
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




