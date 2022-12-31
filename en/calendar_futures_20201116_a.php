<!doctype html>

  <html>
    <?php include('global/html_head.php'); ?>

<style>
/* Calendar Futures Page Banner & Title */
    #calendar-futures .title-bg {
      background-color: #f6F6F6;
    }

    #calendar-futures .ctm-width {
      max-width: 1200px;
      margin: auto;
    }

    #calendar-futures span.square::before {
      content: "";
      border: 1px solid #D93A16;
      background-color: #D93A16;
      padding: 9px 4px;
      position: absolute;
      top: 10px;
    }
    
    #calendar-futures .col-lg-12.ctm-width h3 {
      display: inline-block;
      font-size: 18px;
      font-family: "Microsoft Yahei";
      padding: 10px 0px 5px 20px;
      color: #333333;
    }

    #calendar-futures span.other-title {
      font-size: 18px;
      font-family: "Microsoft Yahei";
      padding: 10px 0px 5px 0px;
      float: right;
    }

  /* Calendar Futures Page Content */
    /* Select Column */
      #calendar-futures .container.select-column {
        margin: 50px auto;
        margin-bottom: 20px;  
      }

      #calendar-futures .select-dropdown {
        display: flex;
        justify-content: space-between;
        box-sizing: border-box;
        position: relative;
      }

      #calendar-futures .select-dropdown select {
        font-size: 18px;
        color: #333;
        width: 100%;
        padding: 8px 20px 8px 10px;
        border: 1px solid #707070;
        border-radius: 0px;
        margin: 0 10px;
        background-color: transparent
      }

      #calendar-futures input.input-form-control {
        margin: 0px 0px 0px 10px;
        padding: 0px 10px;
        color: #333;
      }
      
      #calendar-futures span.fa.fa-search.fafa-icon-control {
        font-size: 18px;
        color: #707070;
        position: absolute;
        top: 12px;
        right: 10px;
      }

      #calendar-futures .select-dropdown.select:active, 
      #calendar-futures .select-dropdown.select:focus {
	      outline: none;
	      box-shadow: none;
      }

    /* Colour Column */
    #calendar-futures .row.colour-row {
      margin: 0px 15px;
    }

    #calendar-futures span.square-green {
      content: "";
    border: 1px solid #0E899B;
    background-color: #0E899B;
    padding: 8px 8px;
    position: absolute;
    top: 1px;
    }

    #calendar-futures h5.control-ccr-green {
      font-size: 18px;
      color: #0E899B;
      padding: 0px 0px 0px 30px;
    }

    #calendar-futures span.square-red {
      content: "";
      border: 1px solid #9B0E0E;
      background-color: #9B0E0E;
      padding: 8px 8px;
      position: absolute;
      top: 1px;
    }

    #calendar-futures h5.control-ccr-red {
      font-size: 18px;
      color: #9B0E0E;
      padding: 0px 0px 0px 30px;
    }

    #calendar-futures span.square-yellow {
      content: "";
      border: 1px solid #FE9300;
      background-color: #FE9300;
      padding: 8px 8px;
      position: absolute;
      top: 1px;
    }

    #calendar-futures h5.control-ccr-yellow {
      font-size: 18px;
      color: #FE9300;
      padding: 0px 0px 0px 30px;
    }

    #calendar-futures .container.colour-column {
      margin-bottom: 50px;
    }

  /* Calendar */
    #calendar-futures .container.calendar {
      padding: 50px 0px 120px 0px;
    }

    #calendar-futures .fc .fc-scroller-harness {
      position: relative;
      overflow: unset;
    }
</style>
    
    
<style>
  .calendar-day {
  width: 100px;
  min-width: 100px;
  max-width: 100px;
  height: 80px;
   padding: 10px !important;
  border: 1px solid #dcdcdc !important;
}
.calendar-table {
  margin: 0 auto;
  width: 100%;
}
.selected {
  background-color: #f9f6ef;
}
.outside .date {
  color: #ccc;
}
.timetitle {
  white-space: nowrap;
  text-align: right;
}
.event {
  border-top: 1px solid #b2dba1;
  border-bottom: 1px solid #b2dba1;
  background-image: linear-gradient(to bottom, #dff0d8 0px, #c8e5bc 100%);
  background-repeat: repeat-x;
  color: #3c763d;
  border-width: 1px;
  font-size: .75em;
  padding: 0 .75em;
  line-height: 2em;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
  margin-bottom: 1px;
}
.event.begin {
  border-left: 1px solid #b2dba1;
  border-top-left-radius: 4px;
  border-bottom-left-radius: 4px;
}
.event.end {
  border-right: 1px solid #b2dba1;
  border-top-right-radius: 4px;
  border-bottom-right-radius: 4px;
}
.event.all-day {
  border-top: 1px solid #9acfea;
  border-bottom: 1px solid #9acfea;
  background-image: linear-gradient(to bottom, #d9edf7 0px, #b9def0 100%);
  background-repeat: repeat-x;
  color: #31708f;
  border-width: 1px;
}
.event.all-day.begin {
  border-left: 1px solid #9acfea;
  border-top-left-radius: 4px;
  border-bottom-left-radius: 4px;
}
.event.all-day.end {
  border-right: 1px solid #9acfea;
  border-top-right-radius: 4px;
  border-bottom-right-radius: 4px;
}
.event.clear {/*
  background: none;
  border: 1px solid transparent;*/
}
.table-tight > thead > tr > th,
.table-tight > tbody > tr > th,
.table-tight > tfoot > tr > th,
.table-tight > thead > tr > td,
.table-tight > tbody > tr > td,
.table-tight > tfoot > tr > td {
  padding-left: 0;
  padding-right: 0;
}
.table-tight-vert > thead > tr > th,
.table-tight-vert > tbody > tr > th,
.table-tight-vert > tfoot > tr > th,
.table-tight-vert > thead > tr > td,
.table-tight-vert > tbody > tr > td,
.table-tight-vert > tfoot > tr > td {
  padding-top: 0;
  padding-bottom: 0;
}

  
  .table td, .table th {
    border: 0px;
  }
  .date_pop_div table td, .date_pop_div table th {
    border: 0px;
    padding: 0;
  }
  .date_pop_div {
    padding: 10px 20px;
    background-color: #f9f6ef;
  }
  .table thead th {
    border: 1px solid #dcdcdc;
  }
  #holder > table {
    border: 1px solid #dcdcdc;
  }
  .c-name {
    color: #a7a7a7;
    border-left: 0px !important;
    border-right: 0px !important;
    padding: 10px !important;
  }
  .show_year .table td, .show_year .table th {
    padding: 10px 20px;
  }
  #day_ck {
    position: relative;
  }
  .color_box_m {
    position: absolute;
    top: 0;
    right: 0;
    display: flex;
  }
  .color_box_1 {
    width: 10px;
    height: 10px;
    background-color: #0483d5;
    margin: 2px;
  }
  .color_box_2 {
    width: 10px;
    height: 10px;
    background-color: #ff6900;
    margin: 2px;
  }
  .color_box_3 {
    width: 10px;
    height: 10px;
    background-color: #c29e6c;
    margin: 2px;
  }
  .day_title_clr_1 {
    color: #0483d5;
    margin: 0 10px;
    text-align: left;
  }
  .day_title_clr_2 {
    color: #ff6900;
    margin: 0 10px;
    text-align: left;
  }
  .day_title_clr_3 {
    color: #c29e6c;
    margin: 0 10px;
    text-align: left;
  }
  .pop_title_clrbox_1 {
    width: 15px; 
    height: 15px; 
    background-color: #0483d5;
    display: inline-block;
  }
  .pop_title_clrbox_2 {
    width: 15px; 
    height: 15px; 
    background-color: #ff6900;
    display: inline-block;
  }
  .pop_title_clrbox_3 {
    width: 15px; 
    height: 15px; 
    background-color: #c29e6c;
    display: inline-block;
  }
  .pop_title_1 {
    color: #0483d5;
  }
  .pop_title_2 {
    color: #ff6900;
  }
  .pop_title_3 {
    color: #c29e6c;
  }
  </style>


<body id="calendar-futures">

    <?php include('global/header.php'); ?>

<!-- Calendar Futures Page Banner & Title -->
  <div class="container-fluid contactus-container" style="padding: 0;">
    <img src="../images/calendar_futures_bg.svg" class="img-fluid" style="width: 100%;">
  </div>

  <div class="contaniner-fluid">
    <div class="title-bg">
      <div class="col-lg-12 ctm-width">
        <span class="square"></span><h3>交易日历</h3>
        <span class="other-title">华泰（香港）期货有限公司最后交易日</span></div>
    </div>
  </div>


<!-- Calendar Futures Page Content -->
  <!-- Select Column -->
  <div class="container select-column">
    <div class="row">
      <div class="col-lg-12 col-12">

        <div class="select-dropdown">
		      <select id=äll-goods>
		        <option value="">所有交易所</option>
		        <option value="">芝商所CME</option>
		        <option value="">香港期貨交易所HKEX</option>
		        <option value="">台灣期貨交易所TAIFEX</option>
		        <option value="">日交易所JPX</option>
	        </select>
		      <select id="all-goods">
		        <option value="">所有商品</option>
		        <option value="">期貨</option>
		        <option value="">選擇權</option>
	        </select>
		      <select id="c-years">
		        <option value="">2019</option>
		        <option value="">2020</option>
		        <option value="">2021</option>
		        <option value="">2022</option>
		        <option value="">2023</option>
	        </select>
	        <select id="c-months">
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
	        </select>
          <!-- Input Serach -->  
            <span class="fa fa-search fafa-icon-control"></span>
		        <input type="text" class="input-form-control" placeholder="搜寻">
        </div>

      </div>
    </div>
  </div>

  <!-- Colour Column -->
  <div class="container colour-column">
      <div class="row colour-row">
      <div class="col-lg-2 col-2">
        <span id="ccr-green"><span class="square-green"></span><h5 class="control-ccr-green">第一通知日</h5></span>
      </div>
      
      <div class="col-lg-2 col-2">
        <span id="ccr-red"><span class="square-red"></span><h5 class="control-ccr-red">最後交易日</h5></span>
      </div>
      
      <div class="col-lg-2 col-2">
        <span id="ccr-yellow"><span class="square-yellow"></span><h5 class="control-ccr-yellow">結算日</h5></span>
      </div>
      
      
      <div class="col-lg-6 col-6"></div>
      </div>
    </div>

    <!--div class="container calendar">
      <div class="row">
        <div class="col-lg-12">
          <div id="calendar"></div>
        </div>
      </div>  
    </div-->

  
  
    <div class="container cf-notes">
      <div class="row">
        <div class="col-lg-12">
          <p>备注:以上的期货交易时间仅供客户参考, 且交易所有可能随时更改交易时间,<br>
             客户可自行登陆各交易所网站 查询最新之交易时间安排。具体时间以交易所为准。</p>
        </div>
      </div>
    </div>
    
    </div>

    
<div class="container theme-showcase" style="margin-top: 30px; margin-bottom: 30px;">
  <h1>Calendar</h1>
<div id="holder" class="row" ></div>
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
<?php include('global/footer.php'); ?>
<script>
  
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
});
  
function remark_colors(d, e, f) 
{ 
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
} 

function GetFile(str, a)
{
  var xmlhttp = GetXmlHttpObject();
  var url="getdate_20210205_ori.php?date=" + str ;
  
	$('#day_ck[onload]').trigger('onload');
  
  
  xmlhttp.onreadystatechange = function() {
    
	if (xmlhttp.readyState==4)
	  {
	  document.getElementById('col_pop_'+a).innerHTML = xmlhttp.responseText;
	  }
  },
  xmlhttp.open("GET",url,true);
  xmlhttp.send(null);
  
  
}
  
</script>

<script type="text/tmpl" id="tmpl">
  {{ 
  var date = date || new Date(),
      month = date.getMonth(), 
      year = date.getFullYear(), 
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
                  <button class="js-cal-prev btn btn-default" onclick="remark_colors('{{: thedate.toDateCssClass() }}')"><</button>
                <span class="btn-group btn-group-lg">
                  {{ if (mode !== 'day') { }}
                    {{ if (mode === 'month') { }}<div class="btn" data-mode="year">{{: months[month] }}</div>{{ } }}
                    {{ if (mode ==='week') { }}
                      <button class="btn btn-link disabled">{{: shortMonths[first.getMonth()] }} {{: first.getDate() }} - {{: shortMonths[last.getMonth()] }} {{: last.getDate() }}</button>
                    {{ } }}
                    <div class="btn year_btn">{{: year}}</div> 
                  {{ } else { }}
                    <button class="btn btn-link disabled">{{: date.toDateString() }}</button> 
                  {{ } }}
                </span>
                  <button class="js-cal-next btn btn-default">></button>
                </span>
                <button style="display:none;" class="js-cal-option btn btn-default {{: first.toDateInt() <= today.toDateInt() && today.toDateInt() <= last.toDateInt() ? 'active':'' }}" data-date="{{: today.toISOString()}}" data-mode="month">{{: todayname }}</button>
              </td>
            </tr>
          </table>
          
        </td>
      </tr>
      <tr>
        <td colspan="7" style="text-align: center">
          
          <table width="100%">
    {{ 
      month = 0;
    }}
            <tr>
              {{ for (i = 0; i < 12; i++) { }}
              <td class="calendar-month month-{{:month}} js-cal-option" data-date="{{: new Date(year, month, 1).toISOString() }}" data-mode="month">
                {{: months[month] }}
                {{ month++;}}
              </td>
              {{ } }}
            </tr>
    {{  }}
          </table>
        
        </td>
      </tr>
    </thead>
    {{ if (mode ==='year') {
      month = 0;
    }}
    <tbody>
      {{ for (j = 0; j < 3; j++) { }}
      <tr>
        {{ for (i = 0; i < 4; i++) { }}
        <td class="calendar-month month-{{:month}} js-cal-option" data-date="{{: new Date(year, month, 1).toISOString() }}" data-mode="month">
          {{: months[month] }}
          {{ month++;}}
        </td>
        {{ } }}
      </tr>
      {{ } }}
    </tbody>
    {{ } }}
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
        <td class="calendar-day {{: dayclass }} {{: thedate.toDateCssClass() }} {{: date.toDateCssClass() === thedate.toDateCssClass() ? 'selected':'' }} {{: daycss[i] }} js-cal-option" data-date="{{: thedate.toISOString() }}" onclick="GetFile('{{: thedate.toDateCssClass() }}', {{: [j+1] }});"> 
        
          <div class="date" id="day_ck" onload="remark_colors('{{: thedate.toDateCssClass() }}',{{: [j+1] }}, {{: [i+1] }})"> 
            {{: thedate.getDate() }}
            
            <div class="color_box_m" id="clr{{: thedate.toDateCssClass() }}">
            </div>
          </div>
          
          {{ thedate.setDate(thedate.getDate() + 1);}}
          
          <div id="day_data_{{: [j+1] }}_{{: [i+1] }}">
          
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
    {{ if (mode ==='day') { }}
    <tbody>
      <tr>
        <td colspan="7">
          <table class="table table-striped table-condensed table-tight-vert" >
            <thead>
              <tr>
                <th> </th>
                <th style="text-align: center; width: 100%">{{: days[date.getDay()] }}</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th class="timetitle" >All Day</th>
                <td class="{{: date.toDateCssClass() }}">  </td>
              </tr>
              <tr>
                <th class="timetitle" >Before 6 AM</th>
                <td class="time-0-0"> </td>
              </tr>
              {{for (i = 6; i < 22; i++) { }}
              <tr>
                <th class="timetitle" >{{: i <= 12 ? i : i - 12 }} {{: i < 12 ? "AM" : "PM"}}</th>
                <td class="time-{{: i}}-0"> </td>
              </tr>
              <tr>
                <th class="timetitle" >{{: i <= 12 ? i : i - 12 }}:30 {{: i < 12 ? "AM" : "PM"}}</th>
                <td class="time-{{: i}}-30"> </td>
              </tr>
              {{ } }}
              <tr>
                <th class="timetitle" >After 10 PM</th>
                <td class="time-22-0"> </td>
              </tr>
            </tbody>
          </table>
        </td>
      </tr>
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
	$('#day_ck[onload]').trigger('onload');
    }).on('click', '.js-cal-next', function () {
      switch(options.mode) {
      case 'year': options.date.setFullYear(options.date.getFullYear() + 1); break;
      case 'month': options.date.setMonth(options.date.getMonth() + 1); break;
      case 'week': options.date.setDate(options.date.getDate() + 7); break;
      case 'day':  options.date.setDate(options.date.getDate() + 1); break;
      }
      draw();
	$('#day_ck[onload]').trigger('onload');
    }).on('click', '.js-cal-option', function () {
      var $t = $(this), o = $t.data();
      if (o.date) { o.date = new Date(o.date); }
      $.extend(options, o);
      draw();
      
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
      $('.' + (new Date()).toDateCssClass()).addClass('today');
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
    days: ["周日", "周一", "周二", "周三", "周四", "周五", "周六"],
    months: ["一月", "二月", "三月", "四月", "五月", "六月", "七月", "八月", "九月", "十月", "十一月", "十二月"],
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

  for(i = 0; i < 2; i++) {
    j = Math.max(i % 15 - 10, 0);
    //c and c1 jump around to provide an illusion of random data
    c = (c * 1063) % 1061; 
    c1 = (c1 * 3329) % 3331;
    d = (d1 + c + c1) % 839 - 440;
    h = i % 36;
    m = (i % 4) * 15;
    if (h < 18) { h = 0; m = 0; } else { h = Math.max(h - 24, 0) + 8; }
    /*end = !j ? null : new Date(y, m, d + j, h + 2, m);*/
    data.push({ title: 'title', start: new Date(2020, 11, 11, h, m), /*end: end, allDay: !(i % 6), text: slipsum[c % slipsum.length ] */ });
  }
  
  data.sort(function(a,b) { return (+a.start) - (+b.start); });
  
//data must be sorted by start date

//Actually do everything
$('#holder').calendar({
  data: data
});
</script>


</html>




