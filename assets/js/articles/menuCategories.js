/*=======================================================
  BOTON DE CATEGORIAS
=======================================================*/
class MenuCategories {
  constructor(btnSelector, Selector) {
    this.btnCategories = document.querySelector(btnSelector);
    this.Categories = document.querySelector(Selector);
    if(this.Categories != null){
      console.log("HOLA");
      this.x = window.matchMedia("(max-width: 700px)");
      this.bindEvents();
    }
  }

  bindEvents(){
    this.myFunction(this.x); // Call listener function at run time
    this.x.addListener(this.myFunction); // Attach listener function on state changes

    this.btnCategories.addEventListener("click", ()=>{
      console.log("HOLA");
      if (this.Categories.offsetHeight != 0){
        this.Categories.setAttribute("style","height: 0px;  padding: 0rem;");
      } else {
        this.Categories.setAttribute("style","padding: 0.5rem; height: "+ (this.elementHeight + 16)+"px;");
      }

    });
  }

  myFunction(X) {
    if (X.matches) { // If media query matches
        document.body.style.backgroundColor = "yellow";
        this.initialize();
    } else {
        document.body.style.backgroundColor = "pink";

    }
  }

  initialize(){
    this.elementHeight = this.Categories.offsetHeight;
    this.Categories.setAttribute("style","height: 0px;");
    console.log(this.elementHeight);
  }

}
