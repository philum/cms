


/**        ==========================================         **/

/**        T W I T T E R    R S S    F E E D S   v5.0         **/

/**        ==========================================         **/

/**        Written by Amit Agarwal on 07/30/2013              **/

/**        Last updated on 10/11/2014 - @labnol               **/




/**        ==========================================          **/

/**        S U P P O R T   &   H E L P                         **/

/**        ==========================================          **/

/**        INSTRUCTIONS: http://www.labnol.org/?p=28149        **/

/**        VIDEO TUTORIAL: http://youtu.be/BXLYIw-IU8I         **/

/**        TWITTER: https://twitter.com/labnol                 **/

/**        DISCOVERED A BUG? Email amit@labnol.org             **/




/**        ==========================================          **/

/**        R S S   S C R I P T   L I C E N S E                 **/

/**        ==========================================          **/

/**        License: You can use, modify, republish, and        **/
/**        distribute this Google Script with attribution.     **/

/**        ==========================================          **/





































function Twitter_RSS() {
  return; 
}








function doGet(e) {
  
  var widgetID = e.queryString? e.queryString : "362462751664263169";
  
  var cache = CacheService.getPublicCache();
  var id = "labnol" + widgetID;
  var rss = cache.get(id);
  
  if ( ! rss ) {
    rss = getTweets_(widgetID);
    cache.put(id, rss, 120); // Expire in 2 minutes
  }
  
  return ContentService.createTextOutput(rss)
  .setMimeType(ContentService.MimeType.XML);
}


function getTweets_(id) {
  
  try {
    
    var widget, json, tweets, regex, tweet, list, time, url, when, rss, heading, title, link, alltweets, permalink, permatitle, img; 
    
    id = id || "362462751664263169";
    
    title = "Twitter RSS Feed :: " + id;
    link  = "http://ctrlq.org/#" + id;              
    url   = "https://cdn.syndication.twimg.com/widgets/timelines/" + id;
    
    widget  = UrlFetchApp.fetch(url);
    json    = JSON.parse(widget.getContentText());   
    
    if ( ! json.body ) {
      return;
    }
    
    list = json.body.replace(/(\r\n|\n|\r)/gm," ")
    .replace(/\s+/g, " ")
    .replace(/<time[^>]*>(.*?)<\/time>/gi, "")
    .replace(/<ul class=\"tweet-actions[^>]*>(.*?)<\/ul>/gi, "")
    .replace(/<div class=\"(footer|detail\-expander)[^>]*>(.*?)<\/div>/gi, "");       
    
    regex = new RegExp(/<h1[^>]*>(.*?)<\/h1>/ig);    
    if ((heading = regex.exec(list)) !== null) {
      
      regex = RegExp(/href="(.*?)"/ig);
      if ((permalink = regex.exec(heading[1])) !== null) {
        link = permalink[1];
      }
      
      regex = RegExp(/title="(.*?)"/ig);
      if ((permatitle = regex.exec(heading[1])) !== null) {
        title = permatitle[1];
      }
    }
    
    var self = ScriptApp.getService().getUrl() + "?" + id;
    
    rss  = '<?xml version="1.0"?><rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom">';
    rss += ' <channel><title>' + title + '</title>';
    rss += ' <link>' + link + '</link>';
    rss += ' <atom:link href="' + self + '" rel="self" type="application/rss+xml" />';
    rss += ' <description>' + title + ' :: Twitter RSS Feed generated from Google Scripts. See tutorial at http://www.labnol.org/?p=28149</description>';
    
    regex = RegExp(/<ol[^>]*>(.*?)<\/ol>/ig);
    
    if ((alltweets = regex.exec(list)) !== null) {
      
      alltweets = alltweets[1].replace(/\s+/g, " ");
      
      var re = /<a class=".*?permalink.*?" href="(.*?)" data-datetime="(.*?)"[^>]*>(.*?)<\/a>(.*?)<p[^>]*>(.*?)<\/p>/gm;
      
      while (tweet = re.exec(alltweets)) {
        
        url   = tweet[1];
        when  = Utilities.formatDate(parseDate_(tweet[2]), "UTC", "EEE, d MMM yyyy HH:mm:ss");
        
        img = tweet[4].replace(/<.?(div|span|b)[^>]*>/gi, "")
        .replace(/class=".*?"|aria-label=".*?"|data-scribe=".*?"|data-src-2x=".*?"/gi, "")
        .replace(/img /gi, "img style='float:left;padding:10px' ")
        .replace(/_normal/gi, "_bigger");
        
        tweet = tweet[5].replace(/<\s*(span|b|p)[^>]*>/gi, "")
        .replace(/<\s*\/\s*(span|b|p)[^>]*>/gi, "")
        .replace(/class=".*?"|rel=".*?"|title=".*?"|target=".*?"|data-pre-embedded=".*?"|data-expanded-url=".*?"|data-query-source=".*?"|dir=".*?"|data-scribe=".*?"/gi, "")
        .replace(/\s+/g, " ");
        
        rss += "<item>";
        // v5.0 11/10/2014 - Do not replace #tag links in the title but replace regular http links
        //rss += " <title>" + url.split("/")[3] + ": " + tweet.replace(/<a[^>]*>(.*?)<\/a>/gi, "") + "</title>";
        rss += " <title>" + url.split("/")[3] + ": " + tweet.replace(/<[^>]*>/gi, "").replace(/https?:\/\/[^\s]*/gi, "") + "</title>";
        rss += " <pubDate>" + when + " +0000</pubDate>";
        rss += " <guid>" + url + "</guid>";
        rss += " <link>" + url + "</link>";
        // v3.1 11/12/13 No need to decode since the tweet is already decoded by Twitter API
        // rss += " <description><![CDATA[" + decodeURIComponent(tweet) + "]]></description>";
        rss += " <description><![CDATA[" + img + ":<br>" + tweet + "]]></description>";
        rss += "</item>";            
        
      }
      
      rss += "</channel></rss>";
      return rss;
    }
    
  } catch (e) {
    Logger.log(e.toString());
  }
}

function parseDate_(d) {
  
  var date = /(\d{4})-(\d{2})-(\d{2})T(\d{2}):(\d{2}):(\d{2})/;
  var m = date.exec(d);
  var year   = +m[1];
  var month  = +m[2];
  var day    = +m[3];
  var hour   = +m[4];
  var minute = +m[5];
  var second = +m[6];
  
  return new Date(year, month - 1, day, hour, minute, second);
}
