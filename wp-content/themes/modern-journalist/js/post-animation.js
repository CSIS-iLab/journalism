console.log("hey");

// anime({
//   targets: ".entry-header__text *",
//   translateX: [{ value: -50, easing: "easeOutSine", duration: 500 }],
//   opacity: [{ value: 0, easing: "easeOutSine", duration: 500 }],
//   direction: "reverse",
//   delay: anime.stagger(100, { grid: [14, 5], from: "last" })
// });

anime({
  targets: ".color-block .entry-header__image .post__image",
  //translateX: [{ value: 50, easing: "easeOutSine", duration: 500 }],
  opacity: [{ value: 0, easing: "easeOutSine", duration: 500 }],
  direction: "reverse"
});

/*
document.addEventListener("DOMContentLoaded", function() {
  var input = document.querySelector(".entry-title");
  console.log(input.textContent);
  var newone = input.textContent.replace(
    /([^\x00-\x80]|\w)/g,
    "<span class='letter'>$&</span>"
  );
  input.innerHTML = newone;

  anime({
    targets: [".entry-title .letter", ".entry-title .letter"],
    opacity: [0, 1],
    easing: "easeInOutQuad",
    duration: 250,
    delay: anime.stagger(100, { from: "center" })
  });
});
*/
window.addEventListener("scroll", function(e) {
  var scrolled = window.pageYOffset;
  //if (scrolled <= 1200) {

  const imagewrap = document.querySelector(".color-block .entry-header__image");
  if (imagewrap) {
    imagewrap.style.top = -(scrolled * 0.1) + "px";
  }

  const imageobj = document.querySelector(".color-block .post__image");
  if (imageobj) {
    imageobj.style.marginBottom = scrolled * 0.02 + "px";
  }
  const textwrap = document.querySelector(".color-block .entry-header__text");
  if (textwrap) {
    textwrap.style.top = -(scrolled * 0.15) + "px";
  }
  //}
});
