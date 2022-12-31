<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>無標題文件</title>
<link rel="stylesheet" type="text/css" href="../css/jquery.horizontal.scroll.css" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
<script src="../js/jquery.horizontal.scroll.js" type="text/javascript"></script>

</head>
<body>
  <script type="text/javascript">
    $(document).ready(function(){
        $('#horiz_container_outer').horizontalScroll();
    });
</script>

<ul id="horiz_container_outer">
    <li id="horiz_container_inner">
        <ul id="horiz_container">
            <li><img src="../images/index/news_1.jpg"></li>
            <li><img src="../images/index/news_2.jpg"></li>
            <li><img src="../images/index/news_3.jpg"></li>
        </ul>
    </li>    
</ul>        
  
  
<div id="scrollbar">
    <a id="left_scroll" class="mouseover_left" href="#"></a>
    <div id="track">
         <div id="dragBar"></div>
    </div>
    <a id="right_scroll" class="mouseover_right" href="#"></a></div>

      </body>


</html>