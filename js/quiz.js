window.Main = (function($) {
	
    var registeredTags=[];
    var allTags=[];
    var allucode=[];
    var registereducode=[];
    var id;
  	var currentTag;
    
    function onInit(event, args) {
	 //alert("stamp_init");
    	
    }
    function onUcode(event, args) {
    	var ucode = args.ucode.toLowerCase();
    	var type=args.type;
        if(type!=null){
             update(ucode,type); 
         }else{
            updatewithoutType(ucode);
         }
    }

    function onResume(event, args) {
	    getStamp();
    }
    

   function getStamp(){
        var sPageURL = window.location.search.substring(1);
        
        var sParameterName =sPageURL.split('=');
    
        id=sParameterName[sParameterName.length-1];
    
        registeredTags=KokosilClient.getContext('mayfestival_stamprally_registeredTags',  registeredTags);
        allTags=KokosilClient.getContext('mayfestival_stamprally_allTags',  allTags);
        
        var currentTag=getCurrentTag();
        if(currentTag!=null){
    
            $('#spot_place').html(currentTag.name);
            $("#img_link").attr("href", currentTag.full);
            $('#img_full').attr('src',currentTag.full);
        }   
        
    }

    function getCurrentTag(){
    	for(var i=0;i<allTags.length;i++){
    		var tag=allTags[i];
    		if(tag.id==id){
    			currentTag=tag;
    			return currentTag;
    		}
    	}
    	return currentTag;
    }
  
  function update(ucode,type){
       allTags=KokosilClient.getContext('mayfestival_stamprally_allTags', allTags);
    
        registeredTags=KokosilClient.getContext('mayfestival_stamprally_registeredTags');
     
        var id;       

        for(var i=0; i<allTags.length;i++){
            var tag=allTags[i];
            if(tag.ucode==ucode){
                id=tag.id;
                if(!checkRegistered(tag)){
                    KokosilClient.unregisterUcodeNotification(tag.ucode);

                    registereducode= KokosilClient.getContext('mayfestival_stamprally_registereducode');
                    registereducode.push(ucode);
                    KokosilClient.setContext('mayfestival_stamprally_registereducode',  registereducode);

                    registeredTags.push(tag);
                    KokosilClient.setContext('mayfestival_stamprally_registeredTags',  registeredTags);
                    
                    var user_id=KokosilClient.getContext('mayfestival_stamprally_user');
                    
                    location.href = 'quiz.php?user_id='+user_id+'&type='+type+'&id='+id;
                }
            }
        }

    }

    function updatewithoutType(ucode){
       allTags=KokosilClient.getContext('mayfestival_stamprally_allTags', allTags);
    
        registeredTags=KokosilClient.getContext('mayfestival_stamprally_registeredTags');
     
        var id;       

        for(var i=0; i<allTags.length;i++){
            var tag=allTags[i];
            if(tag.ucode==ucode){
                id=tag.id;
                if(!checkRegistered(tag)){
                    KokosilClient.unregisterUcodeNotification(tag.ucode);

                    registereducode= KokosilClient.getContext('mayfestival_stamprally_registereducode');
                    registereducode.push(ucode);
                    KokosilClient.setContext('mayfestival_stamprally_registereducode',  registereducode);

                    registeredTags.push(tag);
                    KokosilClient.setContext('mayfestival_stamprally_registeredTags',  registeredTags);
                    
                    var user_id=KokosilClient.getContext('mayfestival_stamprally_user');
                    location.href = 'quiz.php?user_id='+user_id+'&id='+id;
                    //location.href = 'stamp_get.php?user_id='+user_id+'&type='+type+'&id='+id;
                }
            }
        }

    }
      
    function checkRegistered(currentTag){
         for(var i=0;i<registeredTags.length;i++){
            //var tag=registeredTags[i];
            // console.log(registeredTags[i]);
            if(JSON.stringify(currentTag)==JSON.stringify(registeredTags[i])){
                return true;
            }
        }
        return false;
    }

    function launchQr() {
    	KokosilClient.launchQrReader();
    }
    
    return {
	onInit : onInit,
	onUcode:onUcode,
	onResume : onResume,
	launchQr:launchQr
    };
})(window.jQuery);
