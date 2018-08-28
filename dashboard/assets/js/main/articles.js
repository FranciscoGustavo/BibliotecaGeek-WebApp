class EditArticle {
  constructor() {
    this.btns = document.querySelectorAll(".edit");

    if (this.btns != null) {
      this.bindEvents();
    }
  }

  bindEvents(){
    this.btns.forEach((btn) => {
      btn.addEventListener("click", ()=>{
        this.article = btn.getAttribute("data-url");
        this.url = dashboard + "editar/" + this.article;
        location.href = this.url;
      });
    });
  }
}
