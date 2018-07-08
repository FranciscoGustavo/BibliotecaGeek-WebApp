class OpenMenu {
  constructor(btnSelector, selector, iconSelector) {
    this.btnMenu = document.querySelector(btnSelector);
    this.Menu = document.querySelector(selector);
    this.iconMenu = document.querySelector(iconSelector);
    this.bindEvents();
  }

  bindEvents(){
    this.btnMenu.addEventListener("click", ()=>{
      this.Menu.classList.toggle("active");
      this.changeIconMenu();
    });
  }

  changeIconMenu(){
    this.iconMenu.classList.toggle("fa-bars");
    this.iconMenu.classList.toggle("fa-times");
  }
}

(function(){
  var interactiveMenu = new OpenMenu(".btn-menu", ".header", ".icon-menu");
})();
