jquery.json = jquery.json-2.2.min


http://code.google.com/p/jquery-json/



var encoded = $.toJSON(thing);              //'{"plugin":"jquery-json","version":2.2}'
var name = $.evalJSON(encoded).plugin;      //"jquery-json"
var version = $.evalJSON(encoded).version;  // 2.2