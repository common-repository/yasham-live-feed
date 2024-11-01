jQuery(document).ready( function() {
	jQuery( livefeed_headerid ).after( '<div id="main_feed_div" name="main_feed_div" class="main_feed_div" style="background-color:'+livefeed_bgcolor+';"></div>' );

	  var config = {
		apiKey: livefeed_apicode,
		authDomain: livefeed_appname+".firebaseapp.com",
		databaseURL: "https://"+livefeed_appname+".firebaseio.com",
	  };
	firebase.initializeApp(config);
	
	var cats_list = cats_lst.split(',');
	if(is_single){
		check_single_feed(cats_list);
	}else{
		check_cat_feed(cats_list);
	}
});

function check_cat_feed(cats_list){
	cats_list.forEach(function(item) {
		var feed_list = firebase.database().ref('livefeed/'+item);
		feed_list.on('value', function(snapshot) {
			jQuery("#main_feed_div").empty();
			if(snapshot.val()){
				var feed_data_keys = Object.keys(snapshot.val());
				var feed_data = snapshot.val();
				var k = 0;
				for (var i = feed_data_keys.length; i > 0; i--){
					var message_data = feed_data[feed_data_keys[i-1]].message;
					if(message_data){
						//var message_url = feed_data[feed_data_keys[i-1]].url;
						//if(feed_data[feed_data_keys[i-1]].url){
							//var f_message = '<a class="feed_single_message" href=\''+message_url+'\'>'+message_data+'</a>';
						//}else{
							//var f_message = '<p class="feed_single_message">'+message_data+'</p>';
						//}
						var f_message = '<div class="feed_single_message" style="color:'+livefeed_textcolor+';">'+message_data+'</div>';
						jQuery( "#main_feed_div" ).prepend(f_message);
						k++;
						if(k == 3){break;}
					}
				}
			}
		});
	});
}

function check_single_feed(cats_list){
	cats_list.forEach(function(item) {
		var feed_list = firebase.database().ref('livefeed/'+item);
		feed_list.on('value', function(snapshot) {
			jQuery("#sub_feed_div"+item).empty();
			if(snapshot.val()){
				var feed_data_keys = Object.keys(snapshot.val());
				var feed_data = snapshot.val();
				var k = 0;
				jQuery( "#main_feed_div" ).prepend('<div id="sub_feed_div'+item+'" name="sub_feed_div'+item+'"></div>');
				for (var i = feed_data_keys.length; i > 0; i--){
					var message_data = feed_data[feed_data_keys[i-1]].message;
					if(message_data){
						if(feed_data[feed_data_keys[i-1]].inpost){
							//var message_url = feed_data[feed_data_keys[i-1]].url;
							//var f_message = '<a class="feed_single_message" href=\''+message_url+'\'>'+message_data+'</a>';
							var f_message = '<div class="feed_single_message" style="color:'+livefeed_textcolor+';">'+message_data+'</div>';
							jQuery( "#sub_feed_div"+item ).prepend(f_message);
							k++;
							if(k == 3){break;}
						}
					}
				}
			}
		});
	});
} 