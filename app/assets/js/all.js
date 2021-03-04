// $(document).ready(function(){
//     console.log('恭喜可以寫JQ囉');
// });

window.onload = function() {
  console.log(document.title);

  //popovers 
  let popoversItem = document.querySelectorAll(`[data-js='js-popovers']`);
  let popoversArea = document.querySelector(`.popovers`);

  if (popoversItem) {
    popoversItem.forEach((item) => {
      item.addEventListener("mouseenter", (e) => {
        // let target = e.target.getBoundingClientRect();
        e.preventDefault();
        // console.log(e.pageX, e.pageY)
        const { pageX, pageY } = e;
        popoversArea.style.top = `${pageY - 50}px`;
        popoversArea.style.left = `${pageX - 250}px`;
        popoversArea.style.display = "block";
        popoversArea.style.opacity = 1;
      })
      item.addEventListener("mouseleave", (e) => {
        popoversArea.style.display = "none";
        popoversArea.style.opacity = 0;
      })

    })



  }
  //progress 進度條

  let progressBtn = document.querySelector(`[data-js='js-progress']`);
  let progressBar = document.querySelector('.progress');

  let clickNumber = 1;

  if (progressBtn) {

    progressBtn.addEventListener('click', () => {

      let liList = progressBar.querySelectorAll('.progress li');

      if (clickNumber >= liList.length) {
        console.log(`超過了`);
        return
      };

      if (liList[clickNumber].classList.contains("progress__item--active")) {
        // liList[i].classList.remove("progress__item--active");
      } else {
        liList[clickNumber].classList.add("progress__item--active");
      }

      clickNumber += 1;

    })

  }



  //member menu

  const menus = document.querySelectorAll(".cool > li");

  const dropdownBackground = document.querySelector(".dropdownBackground");

  function enterHandler() {

    this.classList.add("trigger-enter");

    setTimeout(() => {
      this.classList.add("trigger-enter-active");
    }, 50);


    const dropdown = this.querySelector(".dropdown");
    if (dropdown) {
      const rect = dropdown.getBoundingClientRect();
      const navRect = document.querySelector("nav").getBoundingClientRect();
      dropdownBackground.classList.add("open");
      dropdownBackground.style.width = rect.width + "px";
      dropdownBackground.style.height = (rect.height) + "px";
      dropdownBackground.style.top = (rect.top - navRect.top) + "px";
      dropdownBackground.style.left = (rect.left - navRect.left) + "px";
    }

  }

  function leaveHandler() {
    dropdownBackground.classList.remove("open");
    this.classList.remove("trigger-enter-active");
    this.classList.remove("trigger-enter");
  }

  menus.forEach(menu => {
    menu.addEventListener("mouseenter", enterHandler);
    menu.addEventListener("mouseleave", leaveHandler);
  });



};