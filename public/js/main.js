document.addEventListener("DOMContentLoaded", function(){
console.log("tutu"); 

    //Fonction appelée lorsque l'on clique sur le lien Afficher la fenêtre
    $('.read-more').on('click', function(){
            if($('.serviceBox').hasClass('selected') || $('.contenu').hasClass('selected') || $('#background').hasClass('selected') ){
        deselect($('.serviceBox')); 
        deselect($('.contenu')); 
        deselect($('#background')); 
     
        }else{
                $('.serviceBox').addClass('selected');  
                $('.contenu').addClass('selected'); 
                $('#background').addClass('selected'); 
               
            }
    return false;
    });
    //Fonction appelée lorsque l'on clique sur le lien Fermer la fenêtre
    $('.close').on('click', function(){
        deselect($('.serviceBox')); 
        deselect($('.contenu')); 
        deselect($('#background')); 
        
    return false;
    });

   function deselect(e) {
    e.removeClass('selected');
   }
}); 