document.addEventListener("DOMContentLoaded", function(){
    console.log("tutu"); 
    
        //Fonction appelée lorsque l'on clique sur le lien Afficher la fenêtre
        $('.read-more').on('click', function(){
                if( ){
            deselect(); 
            deselect(); 
            // deselect($('#background')); 
         
            }else{
               .addClass('selected');  
               .addClass('selected'); 
                // $('#background').addClass('selected'); 
                   
                }
        return false;
        });
        //Fonction appelée lorsque l'on clique sur le lien Fermer la fenêtre
        $('.close').on('click', function(){ 
            deselect(   ); 
            deselect(  ); 
               
        return false;
        });
    
       function deselect(e) {
        e.removeClass('selected');
       }

    }); 