var btnLogFacebook = document.querySelectorAll('.fb');
btnLogFacebook.forEach((btn)=>{
  btn.addEventListener("click", (event)=>{
    event.preventDefault();

    FB.login(function(response){

      validarUsuario();

    }, {scope: 'public_profile, email'});
  });

});




/*=============================================
VALIDAR EL INGRESO
=============================================*/
function validarUsuario(){

	FB.getLoginStatus(function(response){

		statusChangeCallback(response);

	});

}

/*=============================================
VALIDAMOS EL CAMBIO DE ESTADO EN FACEBOOK
=============================================*/
function statusChangeCallback(response){

	if(response.status === 'connected'){

		testApi();

	}else{
    title =  "¡ERROR!";
    text =  "¡Ocurrió un error al ingresar con Facebook, vuelve a intentarlo!";
    type =  "error";
    confirmButtonText =  "Cerrar";

    new AlertModal(title, text, confirmButtonText, type, ()=>{
      window.location = localStorage.getItem("currentRute");
    });
	}

}

/*=============================================
INGRESAMOS A LA API DE FACEBOOK
=============================================*/
function testApi(){

	FB.api('/me?fields=id,name,email,picture',function(response){

		if(response.email == null){

      title = "¡ERROR!";
      text = "¡Para poder ingresar al sistema debe proporcionar la información del correo electrónico!";
      type = "error";
      confirmButtonText = "Cerrar";
      new AlertModal(title, text, confirmButtonText, type, ()=>{
        window.location = localStorage.getItem("currentRute");
      });

		}else{

			var email = response.email;
			var name = response.name;
			var photo = "https://graph.facebook.com/"+response.id+"/picture?type=large";
      var logupFacebook = "yes";

      var data = "email=" + email + "&name=" + name + "&photo=" + photo + "&logupFb=" + logupFacebook;

      if(window.XMLHttpRequest)	{
        var xhr = new XMLHttpRequest();
      }	else if(window.ActiveXObject)	{
        var xhr = new ActiveXObject("Microsoft.XMLHTTP");
      }

      xhr.onreadystatechange = () => {
        if (xhr.readyState == 4) {
          if (xhr.status == 200) {
            console.log(xhr.responseText);
            if(xhr.responseText == "OK"){
              console.log("windows");
               window.location  = localStorage.getItem('currentRute');
            } else {
              var title = '¡Correo duplicado!';
              var message = '¡El correo electrónico ' + email +' ya está registrado con un método diferente a Facebook!';
              new AlertModal(title, message, 'Aceptar','error', ()=>{

                FB.getLoginStatus((response)=>{
                  if(response.status === 'connected'){
                    FB.logout(function(response){

                      deleteCookie("fblo_281378555785407");

                      setTimeout(function(){

                        window.location= home + "salir";

                      },500)
                    });

                    function deleteCookie(name){

                      document.cookie = name +'=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;';

                    }
                  }
                });

              });
            }
          } else {
          }
        }
      }
      xhr.open("POST", home + "ajax/user.ajax.php");
      xhr.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
      xhr.send(data);

		}

	})

}


/*=============================================
SALIR DE FACEBOOK
=============================================*/
var btnLogup = document.querySelector(".btn-logout");
var btnLogupTwoo = document.querySelector(".btn-logout-two");
if (btnLogup != null) {
  btnLogup.addEventListener("click",(event)=>{
    event.preventDefault();
    FB.getLoginStatus(function(response){

      if(response.status === 'connected'){

       FB.logout(function(response){

         deleteCookie("fblo_281378555785407");

         console.log("salir");

         setTimeout(function(){

           window.location= home + "salir";

         },500)

       });

       function deleteCookie(name){

          document.cookie = name +'=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;';

       }

      }

    })

  });

}

if (btnLogupTwoo != null) {
  btnLogupTwoo.addEventListener("click",(e)=>{
    e.preventDefault();
    FB.getLoginStatus(function(response){

      if(response.status === 'connected'){

       FB.logout(function(response){

         deleteCookie("fblo_281378555785407");

         console.log("salir");

         setTimeout(function(){

           window.location= home + "salir";

         },500)

       });

       function deleteCookie(name){

          document.cookie = name +'=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;';

       }

      }

    })

  });
}
