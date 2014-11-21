window.Main = (function($) {
    
    var user;
    var tag;
    var registeredTags=[];
    var allTags=[];
    var allucode=[];
    var registereducode=[];
    var id;
    
    function onInit(event, args){ 
    }
    
    function onResume(event, args) {
    
     allTags = KokosilClient.getContext('mayfestival_stamprally_allTags');
     allucode = KokosilClient.getContext('mayfestival_stamprally_allucode');
     
     if (allTags==null||allucode==null){
         
         load();
     }else{
         $('#start_btn').show();
         //initNotification();
         $('#progress').hide();
     }
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

    function load(){
        StamprallyApi.getSpots(function(data, status, xhr) {  
            allTags=data;
        for(var i = 0; i < allTags.length; i++) {
            allTags[i].ucode = allTags[i].ucode.toLowerCase();
            }
            
            KokosilClient.setContext('mayfestival_stamprally_allTags', allTags);    
            initTagInfo();
            $('#start_btn').show();
            $('#progress').hide();  
            //initNotification();
        }, function(xhr, status, error) {
            $('#progress').hide();
            $('#reload').show();
        });
        
    }

    function initTagInfo(){
        allucode=[];
        for(var i = 0; i < allTags.length; i++) {
            allucode.push(allTags[i].ucode);
        }
        
        KokosilClient.setContext('mayfestival_stamprally_allucode',  allucode); 
       
        registeredTags=[];
        KokosilClient.setContext('mayfestival_stamprally_registeredTags',  registeredTags); 
        
        registereducode=[];
        KokosilClient.setContext('mayfestival_stamprally_registereducode',  registereducode); 
        
        var user = 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function(c) {
            var r = Math.random()*16|0, v = c == 'x' ? r : (r&0x3|0x8);
            return v.toString(16);
        });
        KokosilClient.setContext('mayfestival_stamprally_user', user);   
    }
       
    function reload() {
        load();
    }

    function reset() {
        localStorage.clear();
        load();
        //location.href = 'index.html';
    }

    function launchQr() {
        KokosilClient.launchQrReader();
    }
 /*       
    function initNotification(){
        //alert("initNotification");
        allucode=KokosilClient.getContext('mayfestival_stamprally_allucode');
        registereducode= KokosilClient.getContext('mayfestival_stamprally_registereducode');
         allTags=KokosilClient.getContext('mayfestival_stamprally_allTags', allTags);
        registeredTags=KokosilClient.getContext('mayfestival_stamprally_registeredTags');
        if(registeredTags.length!=allTags.length){
            if(allucode!=null){
            for(var i=0;i<allucode.length;i++){
                var code=allucode[i];
                var index=jQuery.inArray( code, registereducode);
                //alert(index); 
                if(index!=-1){
                    KokosilClient.unregisterUcodeNotification(code);

                }else{
                    //var registereducode= KokosilClient.getContext('mayfestival_stamprally_registereducode');
                    if(registereducode.length!=allucode.length)
                    KokosilClient.registerUcodeNotification(code, 'スタンプをゲット!');
                    //if(allucode.length==registereducode.length) KokosilClient.unregisterUcodeNotification(tag.ucode);
                }

            }
        }
    }
}
*/

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
                    //location.href = 'quiz.php?user_id='+user_id+'&id='+id;
                    if(allTags.length!=registeredTags.length)
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
                    if(allTags.length!=registeredTags.length)
                    location.href = 'quiz.php?user_id='+user_id+'&id='+id;
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
    onInit : onInit,
    onResume : onResume,
    onUcode: onUcode,
    reset:reset,
    launchQr:launchQr,
    };
})(window.jQuery);

