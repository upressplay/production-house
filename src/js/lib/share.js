(function(site,$){
	"use strict";

	var trace = {push: function() {}},
    dom = {};

	function init() {

		trace = site.utilities && site.utilities.trace ? site.utilities.trace : {push: function() {}};
        trace.push("inti");
		dom.shareBtn = $('.social-btn, .share-btn');
		dom.shareBtn.each(function(){
            $(this).on('click', function() {
                share($(this));
            });
			
		});


	}
    function set(obj) {

        obj.on('click', function() {
            share($(this));
        });

    }

	function share(obj) {

        var title = obj.attr('data-title');
        var desc = obj.attr('data-desc');
        if(desc != "" && desc != undefined) {
            title = title +" "+desc;
        }
        var url = encodeURIComponent(obj.attr('data-url'));
        var type = obj.attr('data-type');
        var hashtag = obj.attr('data-hashtag');

        if(hashtag == "" || hashtag == undefined) {
            hashtag = "MattBrookens";
        }
        trace.push('hashtag = '+hashtag);

        if(type == "facebook") {
            network_url = "https://www.facebook.com/sharer/sharer.php?u="+url;
            window.open(network_url, "facebook_share", "width=600, height=400");
            return;
        }

        var network_url;

        if(type == "twitter") {

            var character_max = 240;
            var characters_over = 0;
            var message_string = title;

            trace.push("title.length = "+title.length+" > "+character_max);

            if(title.length > character_max) {
                characters_over = title.length + hashtag.length - character_max  + 3;
                title = title.substring(0, title.length - characters_over);
                title = title +"... %23"+hashtag;
                trace.push("title = "+title+" characters_over = "+characters_over+" message_string.length = "+message_string.length)
            }
            trace.push('twitter url ========= '+url);

            network_url = "http://twitter.com/share?text="+title+"&url="+url;

            trace.push('twitter network_url ========= '+network_url);

            window.open(network_url, "twitter_share", "width=600, height=400");
        }

    }

	

	// Public API definitions
	site.share = {
        set:set
	};


	$(function(){
		init();
	});

})(window.site=window.site || {}, jQuery);