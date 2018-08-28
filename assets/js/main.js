/*=======================================================
  MEMU INTERACTIVO EN DISPOSITIVOS MOBILES
=======================================================*/
class OpenMenu {
  constructor(btnSelector, selector, iconSelector) {
    this.btnMenu = document.querySelector(btnSelector);
    this.Menu = document.querySelector(selector);
    this.shadow = document.querySelector(".header-shadow");
    this.iconMenu = document.querySelector(iconSelector);
    this.bindEvents();
  }

  bindEvents(){
    this.btnMenu.addEventListener("click", ()=>{
      this.Menu.classList.add("active");
      this.shadow.classList.add("active");
    });

    this.shadow.addEventListener("click", ()=>{
        this.Menu.classList.remove("active");
        this.shadow.classList.remove("active");
    });
  }

  changeIconMenu(){
    this.iconMenu.classList.toggle("fa-bars");
    this.iconMenu.classList.toggle("fa-times");
  }
}

var home = "http://localhost/bibliotecageek/";
var dashboard = "http://localhost/bibliotecageek/dashboard/";

(function(){
  /*=============================================
    RUTAS DINAMICAS
  =============================================*/

  /*=============================================
    INICIALIZAMOS LOS INPUT DEL SITIO
  =============================================*/
  new InputMD(".input-form input");

  /*=============================================
    VENTANA MODAL DE INICIO DE SESSION
  =============================================*/
  new WindowModal("#login",".login", ()=>{
    new ChangeModal(".create-Account", "#login", ".logup");
    new ChangeModal(".forgotten-your-password", "#login", ".forgotten-your-password");
  });

  /*=============================================
    VENTANA MODAL DE REGISTRO DE SESSION
  =============================================*/
  new WindowModal("#logup",".logup", ()=>{
    new ChangeModal(".do-you-already-have-an-account", "#logup", ".login");
  });

  /*=============================================
    VENTANA MODAL DE CAMBIO DE CONTRASEÑA
  =============================================*/
  new WindowModal("#forgotten-your-password",".forgotten-your-password", ()=>{});

  /*=============================================
    VALIDA EL REGISTRO DE USUARIO
  =============================================*/
  new ValidateForm("#logup form","#logup .errors-form");

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

  /*=============================================
    TABS DE LA PAGINA DE PERFIL DE USUARIO
  =============================================*/
  new Tabs(".tabs-control");

  /*=============================================
    BOTON DE EDITAR USUARIO
  =============================================*/
  new BtnEditPorfile("#editprofile");

  /*=============================================
    AGREGAR ARTICULOS A FAVORITOS
  =============================================*/
  new AddMyFavorite("#addmyfavorite");

/*
  new ShowModal("#logup",".logup");
  new ShowModal("#login",".login");
  new EditPorfile("#edit-porfile");*/



})();
