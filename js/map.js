window.Main = (function($) {
	
    var user;
    var tag;
    var registeredTags=[];
    var allTags=[];
    var allucode=[];
    var registereducode=[];
    var id;
    
    function onInit(event, args) {

    }
    
    function onResume(event, args) {
        initMap();        
     }
    
    function initMap(){
        registeredTags=KokosilClient.getContext('mayfestival_stamprally_registeredTags', registeredTags);

        if(registeredTags==null){
        $("#stamp_acount").html("0");
        }
        else $("#stamp_acount").html(registeredTags.length);

        //$("#stamp_acount").html(registeredTags.length);

        if(registeredTags!=null){
            displayImg();
        }    
    }

    function launchQr() {
    	KokosilClient.launchQrReader();
    }
    
    function displayImg(){
        if(registeredTags.length==10){

            var user_id=KokosilClient.getContext('mayfestival_stamprally_user');

            $("#finish").html("コンプリートおめでとう！");
            $("#finish").attr("href","result.php?user_id="+user_id);
            $("#finish").attr("style","color:yellow;");
        }
    	for(var i=0;i<registeredTags.length;i++){
    		var tag=registeredTags[i];	
    		$("#"+tag.id+'_off').hide();
   		    $("#"+tag.id+'_on').show();
    	}
    	
    }
    
    function onUcode(event, args) {
    	var ucode = args.ucode.toLowerCase();
        var type=args.type;
       
    	if(type!=''){
             update(ucode,type); 
         }else{
            updatewithoutType(ucode); 
         }
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
        alert("update no type");
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
                    //location.href = 'quiz.php?user_id='+user_id+'&type='+type+'&id='+id;
                }
            }
        }

    }
    
    function checkRegistered(currentTag){
         for(var i=0;i<registeredTags.length;i++){
            if(JSON.stringify(currentTag)==JSON.stringify(registeredTags[i])){
                return true;
            }
        }
        return false;
    }

    
    return {
	onInit: onInit,
	onResume : onResume,
    initMap: initMap,
	onUcode: onUcode,
	launchQr: launchQr,
    };
})(window.jQuery);


