<!doctype html>

<style>
#calendar-futures h5.control-ccr-yellow {
    margin-top: -23px;
}
</style>

  <html>
    <?php include('global/html_head.php'); ?>

    


<body id="calendar-futures">

    <?php include('global/header.php'); ?>
<?php
	$banner = '';
	$sql = "select img from ".TB_BANNER_PHOTO;
	$sql .= " where  ";
	$sql .= " disabled='0' ";
	$sql .= " and banner_id=6 ";
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
<!-- Calendar Futures Page Banner & Title -->
  <div class="container-fluid contactus-container" style="padding: 0;">
    <img src="<?php echo $banner; ?>" class="img-fluid" style="width: 100%;">
  </div>

  <div class="contaniner-fluid">
    <div class="title-bg">
      <div class="col-lg-12 ctm-width">
        <span class="square"></span><h3>Exchange Calendar</h3>
        <span class="other-title">Last Trading Days</span></div>
    </div>
  </div>


<!-- Calendar Futures Page Content -->
  <!-- Select Column -->
  <div class="container select-column">
    <div class="row">
      <div class="col-lg-12 col-12">
<form method="get" action="">
        <div class="select-dropdown">
          
<select id="all-place" name="all-place">
<option value="">All Exchanges</option>
<option value="芝商所CME">芝商所CME</option>
<option value="香港期货交易所HKEX">香港期货交易所HKEX</option>
<option value="台湾期货交易所TAIFEX">台湾期货交易所TAIFEX</option>
<option value="日交易所JPX">日交易所JPX</option>
</select>
          
<select id="all-goods" name="all-goods">
<option value="">All Products</option>
<option value="期货">期货</option>
<option value="选择权">选择权</option>
</select>
          
		  <!--
<select id="c-years" name="c-years">
<option value="" <?php if ($_GET['c-years']=="") { ?>selected<?php } ?>>-- 选择年份 --</option>
            <?php $fy = (date("Y")-20); $ly = ($fy + 40); for ($sy=$fy; $sy<=$ly; $sy++) { ?>
<option value="<?php echo $sy; ?>" <?php if ($_GET['c-years']== $sy) { ?>selected<?php } ?>><?php echo $sy; ?> </option>
            <?php } ?>
</select>
-->

<select id="c-years" name="c-years">
          <option value="" <?php if ($_GET['c-years']=="") { ?>selected<?php } ?>>-- Select Year --</option>
		
<?php

	
			$sql = "select YEAR(trading_future.display_date) as year,trading_future.*, trading_future_desc.name as name  from ".TB_TRADING_FUTURE." as trading_future , ".TB_TRADING_FUTURE_DESC." as trading_future_desc ";
			$sql .= " where ";
			$sql .= " trading_future.id=trading_future_desc.trading_future_id ";
			$sql .= " and trading_future_desc.language_id='".CURRENT_LANG."' ";
			$sql .= " and trading_future.disabled='0' ";


		 	 $sql .= " group by YEAR(display_date) ";
			
	$sql .= "  order by  YEAR(display_date) desc ";
			

		$rows3 = $G_DB_CONNECT->query($sql);
		$total_record = $G_DB_CONNECT->affected_rows;
		if($G_DB_CONNECT->affected_rows > 0){
	
			while($data3 = $G_DB_CONNECT->fetch_array($rows3)){
		
					$sy = ($data3['year']);
					
?>	
		  <option value="<?php echo $sy; ?>" <?php if ($_GET['c-years']== $sy) { ?>selected<?php } ?>><?php echo $sy; ?> </option>
		  <?php
		  }
		  }
		  ?>
		  </select>
	        <!--select id="c-months">
		        <option value="">一月</option>
		        <option value="">二月</option>
		        <option value="">三月</option>
		        <option value="">四月</option>
		        <option value="">五月</option>
		        <option value="">六月</option>
		        <option value="">七月</option>
		        <option value="">八月</option>
		        <option value="">九月</option>
		        <option value="">十月</option>
		        <option value="">十一月</option>
		        <option value="">十二月</option>
	        </select-->
          
          <!-- Input Serach -->  
            <!--span class="fa fa-search fafa-icon-control"></span-->
          <div class="search_box">
		        <input type="text" class="input-form-control" name="calendar_search" id="calendar_search" placeholder="Search">
            <button type="submit"><i class="fa fa-search"></i></button>
          </div>
        </div>
</form>
      </div>
    </div>
  </div>

  <!-- Colour Column -->
  <div class="container colour-column mb-4">
      <div class="row colour-row ml-lg-2 ml-0 mr-0">
      <div class="col-lg-4 col-12 p-0">
        <table cellpadding="0" cellspacing="0" border="0">
          <tr>
            <td><span class="square-green"></span></td>
            <td><h5 class="control-ccr-green">First Notice Day</h5></td>
            <td width="10"></td>
            <td><span class="square-red"></span></td>
            <td><h5 class="control-ccr-red">Last Trading Day</h5></td>
            <td width="10"></td>
            <td><span class="square-yellow"></span></td>
            <td><h5 class="control-ccr-yellow">Settlement Day</h5></td>
          </tr>
        </table>
      </div>
      
      
	  
	<?php
$download_name= getLangName(TB_WEBPAGE,"name",48,CURRENT_LANG);

	$img = '';
	$sql = "select img from ".TB_WEBPAGE_PHOTO;
	$sql .= " where  ";
	$sql .= " disabled='0' ";
	$sql .= " and webpage_id=48 ";
	//$sql .= " and language_id='".CURRENT_LANG."' ";
	 $sql .= " order by sort_order asc  limit 0,1 ";
	$rowsp = $G_DB_CONNECT->query($sql);
	if($G_DB_CONNECT->affected_rows > 0){	
			while($datap = $G_DB_CONNECT->fetch_array($rowsp)){
			
				$img = DIR_PATH.$datap['img'];
			
			}
	}
    if($img != ''){
?>
      <div class="col-lg-8 col-12 text-lg-right text-left">
        <a href="<?php echo $img ?>" target="_blank"><?php echo $download_name ?></a>
      </div>
	  
	  
	  	<?php
	}
?>
        
		
		
		
      </div>
    </div>

    <!--div class="container calendar">
      <div class="row">
        <div class="col-lg-12">
          <div id="calendar"></div>
        </div>
      </div>  
    </div-->

  
  
    <!--div class="container cf-notes">
      <div class="row">
        <div class="col-lg-12">
          <p>备注:以上的期货交易时间仅供客户参考, 且交易所有可能随时更改交易时间,<br>
             客户可自行登陆各交易所网站 查询最新之交易时间安排。具体时间以交易所为准。</p>
        </div>
      </div>
    </div-->
    
    </div>

    
<div class="container theme-showcase">
<div id="holder" class="row" ></div>
</div>




    <div class="container cf-notes">
      <div class="row">
        <div class="col-lg-12 pb-5">
        <?php echo webpageContent(24,CURRENT_LANG); ?>
        </div>
      </div>
    </div>






</body>
<style>
  .tr_none {
    display: none;
  }
  .tr_block {
    display: block;
  }
</style>
<?php include('global/footer.php');

if($_GET['c-years']!="") {
$gcyear = $_GET['c-years'];
}else{
$gcyear = date("Y");
}
?>
<script>
  $("form select").on('change', function () {
   $("form").trigger('submit');
});
  
  
function GetXmlHttpObject()
{
if (window.XMLHttpRequest)
  {
  // code for IE7+, Firefox, Chrome, Opera, Safari
  return new XMLHttpRequest();
  }
if (window.ActiveXObject)
  {
  // code for IE6, IE5
  return new ActiveXObject("Microsoft.XMLHTTP");
  }
return null;
}
  
  $(function(){
	$('#day_ck[onload]').trigger('onload');
	$('#active_m_1[onload]').trigger('onload');
	$('td[onload]').trigger('onload');
});
  
function remark_colors(d, e, f) 
{ 


  /*
  var xmlhttp = GetXmlHttpObject();
  var url="getclr.php?date=" + d ;
  
  
  xmlhttp.onreadystatechange = function() {
	if (xmlhttp.readyState==4)
	  {
	  document.getElementById('clr'+d).innerHTML = xmlhttp.responseText;
	  }
  },
  xmlhttp.open("GET",url,true);
  xmlhttp.send(null);
  
  var xmlhttp2 = GetXmlHttpObject();
  var url2="getitem.php?date=" + d ;
  
  xmlhttp2.onreadystatechange = function() {
	if (xmlhttp2.readyState==4)
	  {
	  document.getElementById('day_data_'+e+'_'+f).innerHTML = xmlhttp2.responseText;
	  }
  },
  xmlhttp2.open("GET",url2,true);
  xmlhttp2.send(null);




*/



$.ajax({
       		url:"getclr.php?date=" + d ,
       		type:'get',     
           dataType : "html",       
       		success: function(data){  

          
            document.getElementById('clr'+d).innerHTML = data;
            

 				}  ,  
			  error: function(json){  
         
			  
					
				} 
     		});	




$.ajax({
       		url:"getitem.php?date=" + d ,
       		type:'get',     
           dataType : "html",       
       		success: function(data){  

          
           
            document.getElementById('day_data_'+e+'_'+f).innerHTML =data;
            

 				}  ,  
			  error: function(json){  
         
			  
					
				} 
     		});	


















} 

function GetFile(str, a)
{

/*
  var xmlhttp = GetXmlHttpObject();
  var url="getdate.php?date=" + str ;
  
	$('#day_ck[onload]').trigger('onload');
  
  
  xmlhttp.onreadystatechange = function() {
    
	if (xmlhttp.readyState==4)
	  {
	  document.getElementById('col_pop_'+a).innerHTML = xmlhttp.responseText;
	  }
  },
  xmlhttp.open("GET",url,true);
  xmlhttp.send(null);



*/






$.ajax({
       		url:"getdate.php?date=" + str ,
       		type:'get',     
           dataType : "html",       
       		success: function(data){  

            document.getElementById('col_pop_'+a).innerHTML = data;
					
            

 				}  ,  
			  error: function(json){  
			 
			  
					
				} 
     		});	






  
}
  
</script>

<script type="text/tmpl" id="tmpl">
  {{ 
  var date = date || new Date(),
      month = date.getMonth(), 
      year = <?php echo ($gcyear); ?>, 
      first = new Date(year, month, 1), 
      last = new Date(year, month + 1, 0),
      startingDay = first.getDay(), 
      thedate = new Date(year, month, 1 - startingDay),
      dayclass = lastmonthcss,
      today = new Date(),
      i, j; 
  if (mode === 'week') {
    thedate = new Date(date);
    thedate.setDate(date.getDate() - date.getDay());
    first = new Date(thedate);
    last = new Date(thedate);
    last.setDate(last.getDate()+6);
  } else if (mode === 'day') {
    thedate = new Date(date);
    first = new Date(thedate);
    last = new Date(thedate);
    last.setDate(thedate.getDate() + 1);
  }
  
  }}
  <table class="calendar-table table table-condensed table-tight">
    <thead>
      <tr>
        <td colspan="7" style="text-align: center" class="show_year">
          <table style="white-space: nowrap; width: 100%">
            <tr>
              <td style="text-align: center; padding:0;">
                <span class="btn-group">
                  <!--button class="js-cal-prev btn btn-default"><</button-->
                <span class="btn-group btn-group-lg">
                  {{ if (mode !== 'day') { }}
                    {{ if (mode === 'month') { }}<!--div class="btn disabled" data-mode="year">{{: months[month] }}</div-->{{ } }}
                    {{ if (mode ==='week') { }}
                      <button class="btn btn-link disabled">{{: shortMonths[first.getMonth()] }} {{: first.getDate() }} - {{: shortMonths[last.getMonth()] }} {{: last.getDate() }}</button>
                    {{ } }}
                    <div class="btn year_btn">{{: year}}</div> 
                    
                    
        <div class="select-dropdown" style="border:0;">
	        <select id="c-months">
		        <option value="1" {{ if (month == 0) {  }} selected {{ } }}>Jan</option>
		        <option value="2" {{ if (month == 1) {  }} selected {{ } }}>Feb</option>
		        <option value="3" {{ if (month == 2) {  }} selected {{ } }}>Mar</option>
		        <option value="4" {{ if (month == 3) {  }} selected {{ } }}>Apr</option>
		        <option value="5" {{ if (month == 4) {  }} selected {{ } }}>May</option>
		        <option value="6" {{ if (month == 5) {  }} selected {{ } }}>Jun</option>
		        <option value="7" {{ if (month == 6) {  }} selected {{ } }}>Jul</option>
		        <option value="8" {{ if (month == 7) {  }} selected {{ } }}>Aug</option>
		        <option value="9" {{ if (month == 8) {  }} selected {{ } }}>Sep</option>
		        <option value="10" {{ if (month == 9) {  }} selected {{ } }}>Oct</option>
		        <option value="11" {{ if (month == 10) {  }} selected {{ } }}>Nov</option>
		        <option value="12" {{ if (month == 11) {  }} selected {{ } }}>Dec</option>
          </select>
        </div>
                    
                    
                  {{ } else { }}
                    <button class="btn btn-link disabled">{{: date.toDateString() }}</button> 
                  {{ } }}
                </span>
                
                  <!--button class="js-cal-next btn btn-default">></button-->
                  
                </span>
                
              </td>
            </tr>
          </table>
          
        </td>
      </tr>
      <tr>
        <td colspan="7" style="text-align: center" id="month_hide">
          
          <table width="100%" class="wb_show">
    {{ 
      month = 0;
    }}
            <tr>
              {{ for (i = 0; i < 12; i++) { }}
              <td width="5" style="padding:0;margin:0;"></td>
              <td class="calendar-month month-{{:month}} js-cal-option" data-date="{{: new Date(year, month, 1).toISOString() }}" data-mode="month">
                {{: months[month] }}
                {{ month++;}}
              </td>
              <td width="5" style="padding:0;margin:0;"></td>
              {{ } }}
            </tr>
    {{  }}
          </table>
        
        
        
        </td>
      </tr>
    </thead>
    {{ if (mode ==='month' || mode ==='week') { }}
    <thead>
      <tr class="c-weeks" align="center">
        {{ for (i = 0; i < 7; i++) { }}
          <th class="c-name">
            {{: days[i] }}
          </th>
        {{ } }}
      </tr>
    </thead>
    <tbody>
      {{ for (j = 0; j < 6 && (j < 1 || mode === 'month'); j++) { }}
      <tr>
        {{ for (i = 0; i < 7; i++) { }}
        {{ if (thedate > last) { dayclass = nextmonthcss; } else if (thedate >= first) { dayclass = thismonthcss; } }}
        <td class="calendar-day {{: dayclass }} {{: thedate.toDateCssClass() }} {{: daycss[i] }} js-cal-option" data-date="{{: thedate.toISOString() }}" onclick="GetFile('{{: thedate.toDateCssClass() }}', {{: [j+1] }});"> 
        
          <div class="date" id="day_ck" onload="remark_colors('{{: thedate.toDateCssClass() }}',{{: [j+1] }}, {{: [i+1] }})"> 
            {{: thedate.getDate() }}
            
            <div class="color_box_m" id="clr{{: thedate.toDateCssClass() }}">
            </div>
            
          </div>
          
          {{ thedate.setDate(thedate.getDate() + 1);}}
          
          <div id="day_data_{{: [j+1] }}_{{: [i+1] }}" class="wb_show">
          
          </div>
        </td>
        {{ } }}
      </tr>
      <tr id="tr_{{: [j+1] }}" style="margin:0; padding:0; height:0;">
        <td colspan="7" style="margin:0; padding:0; height:0;"><div id="col_pop_{{: [j+1] }}"></div></td>
      </tr>
      
      {{ } }}
      
    </tbody>
    {{ } }}
  </table>
  
  
</script>


<script>
    var $currentPopover = null;
  $(document).on('shown.bs.popover', function (ev) {
    var $target = $(ev.target);
    if ($currentPopover && ($currentPopover.get(0) != $target.get(0))) {
      $currentPopover.popover('toggle');
    }
    $currentPopover = $target;
  }).on('hidden.bs.popover', function (ev) {
    var $target = $(ev.target);
    if ($currentPopover && ($currentPopover.get(0) == $target.get(0))) {
      $currentPopover = null;
    }
  });


//quicktmpl is a simple template language I threw together a while ago; it is not remotely secure to xss and probably has plenty of bugs that I haven't considered, but it basically works
//the design is a function I read in a blog post by John Resig (http://ejohn.org/blog/javascript-micro-templating/) and it is intended to be loosely translateable to a more comprehensive template language like mustache easily
$.extend({
    quicktmpl: function (template) {return new Function("obj","var p=[],print=function(){p.push.apply(p,arguments);};with(obj){p.push('"+template.replace(/[\r\t\n]/g," ").split("{{").join("\t").replace(/((^|\}\})[^\t]*)'/g,"$1\r").replace(/\t:(.*?)\}\}/g,"',$1,'").split("\t").join("');").split("}}").join("p.push('").split("\r").join("\\'")+"');}return p.join('');")}
});

$.extend(Date.prototype, {
  //provides a string that is _year_month_day, intended to be widely usable as a css class
  toDateCssClass:  function () { 
    return '_' + this.getFullYear() + '_' + (this.getMonth() + 1) + '_' + this.getDate(); 
  },
  //this generates a number useful for comparing two dates; 
  toDateInt: function () { 
    return ((this.getFullYear()*12) + this.getMonth())*32 + this.getDate(); 
  },
  toTimeString: function() {
    var hours = this.getHours(),
        minutes = this.getMinutes(),
        hour = (hours > 12) ? (hours - 12) : hours,
        ampm = (hours >= 12) ? ' pm' : ' am';
    if (hours === 0 && minutes===0) { return ''; }
    if (minutes > 0) {
      return hour + ':' + minutes + ampm;
    }
    return hour + ampm;
  }
});


(function ($) {

  //t here is a function which gets passed an options object and returns a string of html. I am using quicktmpl to create it based on the template located over in the html block
  var t = $.quicktmpl($('#tmpl').get(0).innerHTML);
  
  function calendar($el, options) {
    //actions aren't currently in the template, but could be added easily...
    $el.on('click', '.js-cal-prev', function () {
      switch(options.mode) {
      case 'year': options.date.setFullYear(options.date.getFullYear() - 1); break;
      case 'month': options.date.setMonth(options.date.getMonth() - 1); break;
      case 'week': options.date.setDate(options.date.getDate() - 7); break;
      case 'day':  options.date.setDate(options.date.getDate() - 1); break;
      }
      draw();
      
    var m = options.date.getMonth();
	  $('.month-' + m).addClass('month_active');
	$('#day_ck[onload]').trigger('onload');
      
    }).on('click', '.js-cal-next', function () {
      switch(options.mode) {
      case 'year': options.date.setFullYear(options.date.getFullYear() + 1); break;
      case 'month': options.date.setMonth(options.date.getMonth() + 1); break;
      case 'week': options.date.setDate(options.date.getDate() + 7); break;
      case 'day':  options.date.setDate(options.date.getDate() + 1); break;
      }
      draw();
      
      
      
    var m = options.date.getMonth();
	  $('.month-' + m).addClass('month_active');
	$('#day_ck[onload]').trigger('onload');
      
    }).on('click', '.js-cal-option', function () {
      var $t = $(this), o = $t.data();
      if (o.date) { o.date = new Date(o.date); }
      $.extend(options, o);
      draw();
      
    var m = options.date.getMonth();
	  $('.month-' + m).addClass('month_active');
	$('#day_ck[onload]').trigger('onload');
      
      $('#c-months').val(m+1);
      
    }).on('change', '#c-months', function () {
      var dm =  $(this).val();
      switch(options.mode) {
      case 'year': options.date.setFullYear(options.date.getFullYear() + 1); break;
      case 'month': options.date.setMonth(dm-1); break;
      case 'week': options.date.setDate(options.date.getDate() + 7); break;
      case 'day':  options.date.setDate(options.date.getDate() + 1); break;
      }
      draw();
      $('#c-months').val(dm);
      
	$('#day_ck[onload]').trigger('onload');
    
    }).on('click', '.js-cal-years', function () {
      var $t = $(this), 
          haspop = $t.data('popover'),
          s = '', 
          y = options.date.getFullYear() - 2, 
          l = y + 5;
      if (haspop) { return true; }
      for (; y < l; y++) {
        s += '<button type="button" class="btn btn-default btn-lg btn-block js-cal-option" data-date="' + (new Date(y, 1, 1)).toISOString() + '" data-mode="year">'+y + '</button>';
      }
      $t.popover({content: s, html: true, placement: 'auto top'}).popover('toggle');
      return false;
    }).on('click', '.event', function () {
      var $t = $(this), 
          index = +($t.attr('data-index')), 
          haspop = $t.data('popover'),
          data, time;
          
      if (haspop || isNaN(index)) { return true; }
      data = options.data[index];
      time = data.start.toTimeString();
      if (time && data.end) { time = time + ' - ' + data.end.toTimeString(); }
      $t.data('popover',true);
      $t.popover({content: '<p><strong>' + time + '</strong></p>'+data.text, html: true, placement: 'auto left'}).popover('toggle');
      return false;
    });
    function dayAddEvent(index, event) {
      if (!!event.allDay) {
        monthAddEvent(index, event);
        return;
      }
      var $event = $('<div/>', {'class': 'event', text: event.title, title: event.title, 'data-index': index}),
          start = event.start,
          end = event.end || start,
          time = event.start.toTimeString(),
          hour = start.getHours(),
          timeclass = '.time-22-0',
          startint = start.toDateInt(),
          dateint = options.date.toDateInt(),
          endint = end.toDateInt();
      if (startint > dateint || endint < dateint) { return; }
      
      if (!!time) {
        $event.html('<strong>' + time + '</strong> ' + $event.html());
      }
      $event.toggleClass('begin', startint === dateint);
      $event.toggleClass('end', endint === dateint);
      if (hour < 6) {
        timeclass = '.time-0-0';
      }
      if (hour < 22) {
        timeclass = '.time-' + hour + '-' + (start.getMinutes() < 30 ? '0' : '30');
      }
      $(timeclass).append($event);
    }
    
    function monthAddEvent(index, event) {
      var $event = $('<div/>', {'class': 'event', text: event.title, title: event.title, 'data-index': index}),
          e = new Date(event.start),
          dateclass = e.toDateCssClass(),
          day = $('.' + e.toDateCssClass()),
          empty = $('<div/>', {'class':'clear event', html:' '}), 
          numbevents = 0, 
          time = event.start.toTimeString(),
          endday = event.end && $('.' + event.end.toDateCssClass()).length > 0,
          checkanyway = new Date(e.getFullYear(), e.getMonth(), e.getDate()+40),
          existing,
          i;
      $event.toggleClass('all-day', !!event.allDay);
      if (!!time) {
        $event.html('<strong>' + time + '</strong> ' + $event.html());
      }
      if (!event.end) {
        $event.addClass('begin end');
        $('.' + event.start.toDateCssClass()).append($event);
        return;
      }
            
      while (e <= event.end && (day.length || endday || options.date < checkanyway)) {
        if(day.length) { 
          existing = day.find('.event').length;
          numbevents = Math.max(numbevents, existing);
          for(i = 0; i < numbevents - existing; i++) {
            day.append(empty.clone());
          }
          day.append(
            $event.
            toggleClass('begin', dateclass === event.start.toDateCssClass()).
            toggleClass('end', dateclass === event.end.toDateCssClass())
          );
          $event = $event.clone();
          $event.html(' ');
        }
        e.setDate(e.getDate() + 1);
        dateclass = e.toDateCssClass();
        day = $('.' + dateclass);
      }
    }
    function yearAddEvents(events, year) {
      var counts = [0,0,0,0,0,0,0,0,0,0,0,0];
      $.each(events, function (i, v) {
        if (v.start.getFullYear() === year) {
            counts[v.start.getMonth()]++;
        }
      });
      $.each(counts, function (i, v) {
        if (v!==0) {
            $('.month-'+i).append('<span class="badge">'+v+'</span>');
        }
      });
    }
    
    function draw() {
      $el.html(t(options));
      //potential optimization (untested), this object could be keyed into a dictionary on the dateclass string; the object would need to be reset and the first entry would have to be made here
      
      $(new Date()).addClass('today');
      if (options.data && options.data.length) {
        if (options.mode === 'year') {
            yearAddEvents(options.data, options.date.getFullYear());
        } else if (options.mode === 'month' || options.mode === 'week') {
            $.each(options.data, monthAddEvent);
        } else {
            $.each(options.data, dayAddEvent);
        }
      }
    }
    
    draw();
	  
	  var dat = new Date();
	  var m = dat.getMonth();
    
	  $('.month-' + m).addClass('month_active');
  
  }
  
  ;(function (defaults, $, window, document) {
    $.extend({
      calendar: function (options) {
        return $.extend(defaults, options);
      }
    }).fn.extend({
      calendar: function (options) {
        options = $.extend({}, defaults, options);
        return $(this).each(function () {
          var $this = $(this);
          calendar($this, options);
        });
      }
    });
  })({
    days: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fir", "Sat"],
    months:  ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
    shortMonths: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"],
    date: (new Date()),
        daycss: ["c-sunday", "", "", "", "", "", "c-saturday"],
        todayname: "Today",
        thismonthcss: "current",
        lastmonthcss: "outside",
        nextmonthcss: "outside",
    mode: "month",
    data: []
  }, jQuery, window, document);
    
})(jQuery);

var data = [],
    date = new Date(),
    d = date.getDate(),
    d1 = d,
    m = date.getMonth(),
    y = date.getFullYear(),
    i,
    end, 
    j, 
    c = 1063, 
    c1 = 3329,
    h, 
    m,
    names = ['All Day Event', 'Long Event', 'Birthday Party', 'Repeating Event', 'Training', 'Meeting', 'Mr. Behnke', 'Date', 'Ms. Tubbs'],
    slipsum = ["Now that we know who you are, I know who I am. I'm not a mistake! It all makes sense! In a comic, you know how you can tell who the arch-villain's going to be? He's the exact opposite of the hero. And most times they're friends, like you and me! I should've known way back when... You know why, David? Because of the kids. They called me Mr Glass.", "You see? It's curious. Ted did figure it out - time travel. And when we get back, we gonna tell everyone. How it's possible, how it's done, what the dangers are. But then why fifty years in the future when the spacecraft encounters a black hole does the computer call it an 'unknown entry event'? Why don't they know? If they don't know, that means we never told anyone. And if we never told anyone it means we never made it back. Hence we die down here. Just as a matter of deductive logic.", "Your bones don't break, mine do. That's clear. Your cells react to bacteria and viruses differently than mine. You don't get sick, I do. That's also clear. But for some reason, you and I react the exact same way to water. We swallow it too fast, we choke. We get some in our lungs, we drown. However unreal it may seem, we are connected, you and I. We're on the same curve, just on opposite ends.", "Well, the way they make shows is, they make one show. That show's called a pilot. Then they show that show to the people who make shows, and on the strength of that one show they decide if they're going to make more shows. Some pilots get picked and become television programs. Some don't, become nothing. She starred in one of the ones that became nothing.", "Yeah, I like animals better than people sometimes... Especially dogs. Dogs are the best. Every time you come home, they act like they haven't seen you in a year. And the good thing about dogs... is they got different dogs for different people. Like pit bulls. The dog of dogs. Pit bull can be the right man's best friend... or the wrong man's worst enemy. You going to give me a dog for a pet, give me a pit bull. Give me... Raoul. Right, Omar? Give me Raoul.", "Like you, I used to think the world was this great place where everybody lived by the same standards I did, then some kid with a nail showed me I was living in his world, a world where chaos rules not order, a world where righteousness is not rewarded. That's Cesar's world, and if you're not willing to play by his rules, then you're gonna have to pay the price.", "You think water moves fast? You should see ice. It moves like it has a mind. Like it knows it killed the world once and got a taste for murder. After the avalanche, it took us a week to climb out. Now, I don't know exactly when we turned on each other, but I know that seven of us survived the slide... and only five made it out. Now we took an oath, that I'm breaking now. We said we'd say it was the snow that killed the other two, but it wasn't. Nature is lethal but it doesn't hold a candle to man.", "You see? It's curious. Ted did figure it out - time travel. And when we get back, we gonna tell everyone. How it's possible, how it's done, what the dangers are. But then why fifty years in the future when the spacecraft encounters a black hole does the computer call it an 'unknown entry event'? Why don't they know? If they don't know, that means we never told anyone. And if we never told anyone it means we never made it back. Hence we die down here. Just as a matter of deductive logic.", "Like you, I used to think the world was this great place where everybody lived by the same standards I did, then some kid with a nail showed me I was living in his world, a world where chaos rules not order, a world where righteousness is not rewarded. That's Cesar's world, and if you're not willing to play by his rules, then you're gonna have to pay the price.", "You think water moves fast? You should see ice. It moves like it has a mind. Like it knows it killed the world once and got a taste for murder. After the avalanche, it took us a week to climb out. Now, I don't know exactly when we turned on each other, but I know that seven of us survived the slide... and only five made it out. Now we took an oath, that I'm breaking now. We said we'd say it was the snow that killed the other two, but it wasn't. Nature is lethal but it doesn't hold a candle to man."];
/*
  for(i = 0; i < 2; i++) {
    j = Math.max(i % 15 - 10, 0);
    //c and c1 jump around to provide an illusion of random data
    c = (c * 1063) % 1061; 
    c1 = (c1 * 3329) % 3331;
    d = (d1 + c + c1) % 839 - 440;
    h = i % 36;
    m = (i % 4) * 15;
    if (h < 18) { h = 0; m = 0; } else { h = Math.max(h - 24, 0) + 8; }
    /*end = !j ? null : new Date(y, m, d + j, h + 2, m);
    data.push({ title: 'title', start: new Date(2020, 11, 11, h, m), /*end: end, allDay: !(i % 6), text: slipsum[c % slipsum.length ]  });
  }*/
  
  data.sort(function(a,b) { return (+a.start) - (+b.start); });
	
  //$('.month-'+m).addClass('month_active');
	
//data must be sorted by start date

//Actually do everything
$('#holder').calendar({
  data: data
});
	
  
</script>


</html>




