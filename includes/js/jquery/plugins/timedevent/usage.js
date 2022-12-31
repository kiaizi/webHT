$(document).ready(function() {
    $("#delayed-button").timedBind("click", {delay: 3000},  function() {
        var $log = $("#delayed-log");
	$log.html($log.html() + "Delayed button was clicked.<br />");
    });
    
    $("#buffered-button").timedBind("click", {buffer: 3000}, function() {
        var $log = $("#buffered-log");
	$log.html($log.html() + "Buffered button was clicked.<br/>");
    });
});