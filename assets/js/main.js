/*=============================================
  RUTAS DINAMICAS
=============================================*/
var home = "";
var dashboard = "";

(function(){
  /*=============================================
    VENTANA MODAL DE INICIO DE SESSION
  =============================================*/
  new WindowModal(".container-login",".login", ()=>{
    new ChangeModal(".create-Account", ".container-login", ".logup");
  });

  /*=============================================
    VENTANA MODAL DE REGISTRO DE USUARIO
  =============================================*/
  new WindowModal(".container-logup", ".logup", ()=>{
    new ChangeModal(".do-you-already-have-an-account", ".container-logup", ".login");
  });

  /*=============================================
    VALIDA EL REGISTRO DE USUARIO
  =============================================*/
  new ValidateForm("#logup form","#logup .errors-form");

  /*=============================================
    VENTANA MODAL DE CAMBIO DE CONTRASEÑA
  =============================================*/
  new WindowModal(".container-password",".forgotten-your-password", ()=>{});

  /*=============================================
    ALMACENA LA IRECCION EN UN LOCALSTORAGE
  =============================================*/
  new Storage('.direct');
  new Storage('.fb');
  new Storage('.gl');

  /*=============================================
    FUNCIONES DE MENU DE USUARIO
  =============================================*/
  new MenuUser(".menu-user",".btn-user");

  /*=============================================
    FUNCIONES DEL MENU
  =============================================*/
  new OpenMenu(".btn-menu", ".header", ".icon-menu");

  /*=============================================
    MENU DE CATEGORIES
  =============================================*/
  new MenuCategories(".btn-categories", ".categories-list");

  /*=============================================
    ACTUALIZA LAS VISTAS
  =============================================*/
  new UpdateView(".view-number");
})();
