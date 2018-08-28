/*=============================================
 MANEJA LA OPCIONES POR TABS
=============================================*/
class Tabs {
  constructor(selector) {
    this.tabs = document.querySelectorAll(selector + " a");
    this.tabsContainer = document.querySelector(".tabs .container");
    if (this.tabs.length != 0) {
      this.tab = this.tabs[0].classList.add("active");
      this.bindEvents();
    }
  }

  bindEvents(){
    this.tabs.forEach((tab)=>{
      tab.addEventListener("click", (event)=>{
        event.preventDefault();

        this.tabs.forEach((tab)=>{
          tab.classList.remove("active");
        });

        tab.classList.add("active");

        if (tab.getAttribute("href") == "#porfile") {
          this.move = 0;
        } else if (tab.getAttribute("href") == "#favorites") {
          this.move = 100;
        } else if (tab.getAttribute("href") == "#comments") {
          this.move = 200;
        }

        console.log(tab.getAttribute("href"));
        console.log(this.move);
        this.tabsContainer.setAttribute("style","left: -" + this.move + "%;");
      });
    });
  }
}
