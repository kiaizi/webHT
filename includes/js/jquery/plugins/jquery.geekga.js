/*
 * jquery.geekga-1.2.js - jQuery plugin for Google Analytics
 * 
 * Version 1.2
 * 
 * This plugin extends jQuery with two new functions:
 * 
 *   - $.geekGaTrackPage(account_id)
 *       Track a pageview on a domain.
 *
 *   - $.geekGaTrackPage(account_id, domain_name);
 *       Track a pageview on a domain and its subdomains.
 * 
 *   - $.geekGaTrackEvent(category, action, label, value)
 *       Track an event with a category, action, label and value.
 * 
 * 
 * This code is in the public domain.
 *
 * Contributors:
 *   - Armin Pasalic - http://pasalic.com.ba/ (the addition of subdomain tracking)
 * 
 * Willem van Zyl
 * willem@geekology.co.za
 * http://www.geekology.co.za/blog/
 */

(function($) {
  
  var pageTracker;
  
  
  /**
   * Track a pageview on a domain, e.g.:
   * 
   *   $.geekGaTrackPage('UA-0000000-0');
   *
   * Track a pageview on a domain and its subdomains
   * (include the leading '.'), e.g.:
   *
   *   $.geekGaTrackPage('UA-0000000-0', '.geekology.co.za');
   */
  $.geekGaTrackPage = function(account_id, domain_name) {
    
    //check whether to use an unsecured or a ssl connection:
    var host = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
    var src = host + 'google-analytics.com/ga.js';
    
    //load the Google Analytics javascript file:
    $.ajax(
      {
        type:      'GET',
        url:       src,
        success:   function() {
                                //the ga.js file was loaded successfully, set the account id:
                                pageTracker = _gat._getTracker(account_id);
                                
                                //check whether a domain name was specified:
                                domain_name = domain_name || '';
                                if (domain_name != '')
                                {
                                  pageTracker._setDomainName(domain_name);
                                }
                                
                                //track the pageview:
                                pageTracker._trackPageview();
                              },
        error:     function() {
                                //the ga.js file wasn't loaded successfully:
                                throw "Unable to load ga.js; _gat has not been defined.";
                              },
        dataType:  'script',
        cache:     true
      }
    );
    
    //old method, doesn't cache the script file:
    /*
    $.getScript(src, function() {
      if (typeof _gat != undefined) {
        //the ga.js file was loaded successfully, set the account id:
        pageTracker = _gat._getTracker(account_id);
        
        //track the pageview:
        pageTracker._trackPageview();
      }
      else {
        //the ga.js file wasn't loaded successfully:
        throw "Unable to load ga.js; _gat has not been defined.";
      }
    });
    */
    
  };
  
  
  /**
   * Track an event, e.g.:
   * 
   *   $('a.twitter').click(function() {
   *     $.geekGaTrackEvent('feed', 'click', 'Twitter', 'willemvzyl');
   *   });
   */
  $.geekGaTrackEvent = function(category, action, label, value) {
    
    if (typeof pageTracker != undefined) {
      //the pageTracker was defined, track the event:
      pageTracker._trackEvent(category, action, label, value);
    } else {
      //the pageTracker wasn't defined:
      throw "Unable to track event; pageTracker has not been defined";
    }
    
  };
  
})(jQuery);