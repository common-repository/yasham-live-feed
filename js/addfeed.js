jQuery(document).ready( function() {
  var config = {
    apiKey: livefeed_apicode,
    authDomain: livefeed_appname+".firebaseapp.com",
    databaseURL: "https://"+livefeed_appname+".firebaseio.com",
  };
  firebase.initializeApp(config);

  // Get a reference to the database service
  var database = firebase.database();
});

function send_feed(){

	var time_span = new Date().getTime();
	var cat_id = jQuery( 'select[id="cat_feed_lst"]' ).children("option:selected").val();
	
	var inPosts = jQuery('#inposts').attr('checked');
	if(inPosts){
		inPosts=true;
	}else{
		inPosts=false;
	}
	
	/**
	var feed_url = jQuery( 'input[id="feed_url"]' ).val();
	if(false){
		alert("Feed url is wrong");
		return;
	}
	**/
	
	var feed_msg = tinymce.activeEditor.getContent();
	if(!isMsg(feed_msg)){
		alert("Feed message is wrong or too short");
		return;
	}
	
	firebase.database().ref('livefeed/' + cat_id + '/' + time_span).set({
		message: feed_msg,
		inpost: inPosts,
	});
	alert("sent successfully");
	jQuery( 'textarea[id="feed_msg"]' ).val('');
}

function clear_feed(){
	if (confirm('Are you sure?')) {
		var cat_id = jQuery( 'select[id="cat_feed_lst"]' ).children("option:selected").val();
		firebase.database().ref('livefeed/' + cat_id).remove();
		alert("Done..");
	}
}

function clear_feed_all(){
	if (confirm('Are you sure?')) {
		firebase.database().ref('livefeed').remove();
		alert("Done..");
	}
}
/**
function isUrl(url_txt) {
    var regexp = /(ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/
    return regexp.test(url_txt);
}
**/
function isMsg(msg_txt) {
	if(msg_txt.length > 20){
		return true;
	}
	return false;
}