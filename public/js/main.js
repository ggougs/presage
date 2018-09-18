document.addEventListener("DOMContentLoaded", function(){
console.log("toto"); 

    //Fonction appelée lorsque l'on clique sur le lien Afficher la fenêtre
    $('.read-more').on('click', function(){
            if($(this).hasClass('selected')){
        deselect($(this)); 
        }else{
                $(this).addClass('selected');  
            }
    return false;
    });
    //Fonction appelée lorsque l'on clique sur le lien Fermer la fenêtre
    $('.close').on('click', function(){
    deselect($('#afficherPopup'));
    return false;
    });

   function deselect(e) {
    e.removeClass('selected');
   }
}); 