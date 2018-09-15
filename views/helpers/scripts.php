<!--============================================
  MODULOS DEL TEMPLATE
============================================-->
<script src="<?php printf($home); ?>assets/js/templates/windowModal.js"> </script>
<script src="<?php printf($home); ?>assets/js/templates/alert.js"> </script>

<!--============================================
  MODULOS DE LOS ARTICULOS
============================================-->
<script src="<?php printf($home); ?>assets/js/articles/menuCategories.js"> </script>
<script src="<?php printf($home); ?>assets/js/articles/addmyfavorite.js"> </script>
<script src="<?php printf($home); ?>assets/js/articles/newcomment.js"> </script>
<script src="<?php printf($home); ?>assets/js/articles/editcomment.js"> </script>
<script src="<?php printf($home); ?>assets/js/articles/updateviews.js"> </script>

<!--============================================
  MODULOS DE USUARIOS
============================================-->
<script src="<?php printf($home); ?>assets/js/users/validatelogup.js"> </script>
<script src="<?php printf($home); ?>assets/js/users/storagelogin.js"> </script>
<script src="<?php printf($home); ?>assets/js/users/logupfacebook.js"> </script>
<script src="<?php printf($home); ?>assets/js/users/perfil.js"> </script>
<script src="<?php printf($home); ?>assets/js/users/editprofile.js"> </script>

<!--============================================
  FUNCION PRINCIPAL
============================================-->
<script src="<?php printf($home); ?>assets/js/main.js"> </script>


<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '281378555785407',
      cookie     : true,
      xfbml      : true,
      version    : 'v3.1'
    });

    FB.AppEvents.logPageView();

  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "https://connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));

   var btnSharedFB = document.querySelector(".btn-shared-facebook");
   if (btnSharedFB != null) {
     btnSharedFB.addEventListener("click", (event)=>{
       event.preventDefault();
       var rute = btnSharedFB.getAttribute("href");
       console.log(rute);
       FB.ui({

         method: 'share',
         display: 'popup',
         href: rute,
       },(response)=>{});
     });
   }

</script>
