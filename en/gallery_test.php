<!DOCTYPE html>
<html lang="en" >

<head>

  <meta charset="UTF-8">
  
<link rel="apple-touch-icon" type="image/png" href="https://static.codepen.io/assets/favicon/apple-touch-icon-5ae1a0698dcc2402e9712f7d01ed509a57814f994c660df9f7a952f3060705ee.png" />
<meta name="apple-mobile-web-app-title" content="CodePen">

<link rel="shortcut icon" type="image/x-icon" href="https://static.codepen.io/assets/favicon/favicon-aec34940fbc1a6e787974dcd360f2c6b63348d4b1f4e06c77743096d55480f33.ico" />

<link rel="mask-icon" type="" href="https://static.codepen.io/assets/favicon/logo-pin-8f3771b1072e3c38bd662872f6b673a722f4b3ca2421637d5596661b4e2132cc.svg" color="#111" />


  <title>CodePen - Side Scrolling from jInvertScroll</title>
  
  
  
  
<style>
/* hide horizontal scrollbars, since we use the vertical ones to scroll to the right */
body
{
    overflow-x: hidden;
}

/**
  * important: keep position fixed, you can however use top:0 instead of bottom:0
  * if you want to make it stick to the top of the browser
  */
.scroll
{
    position: fixed;
    bottom: 0;
    left: 0;
}

html,
body
{
    padding: 0;
    margin: 0;
    font-family: 'Open Sans', sans-serif;
    font-weight: 300;
    font-size: 16px;
    color: #555;
}

h1,
h2,
h3
{
    color: #238acb;
}

h3
{
    margin: 10px 0;
}

a
{
    color: #238acb;
}

a img
{
    border: none;
}

pre
{
    font-size: 14px;
    color: white;
    padding: 10px;
    background: #646464;
}

.header
{
    position: fixed;
    top: 0;
    left: 0;
    height: 70px;
    width: 100%;
    overflow: hidden;
    background: #238acb;
    z-index: 1000;
}

.header .logo
{
    float: left;
    padding: 22px;
    padding-left: 30px;
}

.header .credits
{
    float: right;
    padding-top: 15px;
}

.horizon
{
    line-height: 0;
    z-index: 100;
    width: 3000px;
}

.middle
{
    z-index: 250;
    line-height: 0;
    width: 4500px;
}

.front
{
    z-index: 500;
    top: 150px;
    width: 6000px;
}

.intro
{
    position: absolute;
    left: 500px;
    top: 0px;
    padding-right: 50px;
    background: url('../images/scroll.png') no-repeat right 5px;
}

.page
{
    top: 0px;
    width: 500px;
    background: white;
    padding: 10px 30px;
    border: 1px #eee solid;
    position: absolute;
}

.description
{
    left: 1500px;
}

.documentation
{
    left: 2450px;
    width: 700px;
}

.options
{
    width: 700px;
    left: 3800px;
}

.download
{
    width: 500px;
    left: 5100px;
}

.license
{
    padding: 100px 30px 30px 30px;
}
</style>

  <script>
  window.console = window.console || function(t) {};
</script>

  
  
  <script>
  if (document.location.search.match(/type=embed/gi)) {
    window.parent.postMessage("resize", "*");
  }
</script>


</head>

<body translate="no" >
  <div class="container">
  <div class="header">
    <div class="logo">
      <a href="//jInvertScroll">
        <img src="http://www.pixxelfactory.net/jInvertScroll/images/jInvertScroll.png" alt="jInvertScroll" />
      </a>
    </div>

    <div class="credits">
      <a href="http://www.pixxelfactory.net">
        <img src="http://www.pixxelfactory.net/jInvertScroll/images/pixxelfactory.png" alt="Pixxelfactory" />
      </a>
    </div>
  </div>

  <div class="horizon scroll">
    <img src="http://www.pixxelfactory.net/jInvertScroll/images/horizon.png" alt="" />
  </div>

  <div class="middle scroll">
    <img src="http://www.pixxelfactory.net/jInvertScroll/images/middle.png" alt="" />
  </div>

  <div class="front scroll">
    <h1 class="intro">Scroll down</h1>

    <div class="description page">
      <h2>jInvertScroll - A lightweight jQuery horizontal Parallax Plugin</h2>
      <p>
        What is it?
        <br/> It's a lightweight plugin for jQuery that allows you to move in horizontal with a parallax effect while scrolling down.
        <br/> It's extremely easy to setup and requires nearly no configuration.
        <br/>
        <hr style="border:none; border-bottom: 1px #ddd solid;" /> Note:
        <br/> By using this plugin, we expect that you know the limitations of horizontal parallax scrolling, for instance if the screen height is smaller than the content, the content will be clipped, but this plugin is intended anyway for webdesigners and
        -developers, so we think that you know what you're doing. ;-)
      </p>
    </div>

    <div class="documentation page">
      <h2>Quickstart</h2>
      <p>
        1.) Include the css file, jQuery and the Plugin
        <br/> 2.) Create the desired elements that you want to scroll (You can create normal divs, that contain other elements, images, videos...)
        <br/> 3.) Assign following attributes to the elements you just created:
        <br/>
        <pre>position: fixed;	// All scrollable elements have to be position:fixed
bottom: 0;	// Make it stick to the bottom (or top)
width: xxxxpx;	// I recommend to assign the width in px, prevents preloading issues</pre>
        <br/> 4.) Order the layers via z-index (Note that it is recommended that the front layers are wider than the ones in the back) 5.) In your javascript, use this code (the selectors refer to the elements that you desire to be scrolled):
        <pre>$.jInvertScroll(['yourselector1', 'yourselector2'...]);</pre>
      </p>
    </div>

    <div class="options page">
      <h2>Options</h2>
      <p>
        You can tweak some options if you like:
        <br/>
        <pre>$.jInvertScroll(['.myScrollableElements'], {
	width: 'auto',	// Page width (auto or int value)
	height: 'auto',	// Page height (the shorter, the faster the scroll)
	onScroll: function(percent) {
		// Callback function that will be called each time the user
		// scrolls up or down, useful for animating other parts
		// on the page depending on how far the user has scrolled down
		// values go from 0.0 to 1.0 (with 4 decimals precision)
	}
});</pre>
      </p>
    </div>

    <div class="download page">
      <h2>Download</h2>
      <p>
        You can download the script as a zip file here:
        <br/>
        <br/>
        <a href="jInvertScroll.zip" class="file">
						jInvertScroll.zip
					</a>
        <br/>
        <br/> ..or get it from our <a href="https://www.github.com/pixxelfactory/jInvertScroll">GitHub repository</a>.
        <br/>
        <br/>
      </p>
      <h3>License</h3>
      <p>
        It is published under the <a href="license.php">Mit license.</a></small>
      </p>
      <h3>Author</h3>
      <p>
        The plugin was written by Alex Franzelin and sponsored by Pixxelfactory.
      </p>
    </div>
  </div>
    <script src="https://static.codepen.io/assets/common/stopExecutionOnTimeout-157cd5b220a5c80d4ff8e0e70ac069bffd87a61252088146915e8726e5d9f147.js"></script>

  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src='https://codepen.io/AlfalfaAnne/pen/idwtn.js'></script>
  
      <script id="rendered-js" >
$(function () {
  var elem = $.jInvertScroll(['.scroll'], // an array containing the selector(s) for the elements you want to animate
  {
    // height: 6000,                   // optional: define the height the user can scroll, otherwise the overall length will be taken as scrollable height
    onScroll: function (percent) {//optional: callback function that will be called when the user scrolls down, useful for animating other things on the page
      console.log(percent);
    } });

  $(window).resize(function () {
    if ($(window).width() <= 768) {
      elem.destroy();
    } else
    {
      elem.reinitialize();
    }
  });
});
//# sourceURL=pen.js
    </script>

  

</body>

</html>