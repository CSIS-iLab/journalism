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

anime({
	targets: ".zoom-img .entry-header__image .post__image-wrapper",
	//translateX: [{ value: 50, easing: "easeOutSine", duration: 500 }],
	scale: [{ value: 1.2, easing: "easeOutSine", duration: 600, delay: 3000 }],
	opacity: [{ value: 0.3, easing: "easeOutSine", duration: 600, delay: 3000 }]
});

anime({
	targets: ".zoom-img .post__intro",
	//translateX: [{ value: 50, easing: "easeOutSine", duration: 500 }],
	translateY: [
		{ value: [-30, 0], easing: "easeOutSine", duration: 600, delay: 3200 }
	],
	opacity: [
		{ value: [0, 1], easing: "easeOutSine", duration: 300, delay: 3200 }
	]
});
anime({
	targets: ".zoom-img .entry-title",
	//translateX: [{ value: 50, easing: "easeOutSine", duration: 500 }],
	translateY: [
		{ value: [-30, 0], easing: "easeOutSine", duration: 600, delay: 3300 }
	],
	opacity: [
		{ value: [0, 1], easing: "easeOutSine", duration: 300, delay: 3300 }
	]
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

const header = document.querySelector(".site-header");
const header_height = header.offsetHeight + 8;
//console.log(header_height);
const hidden_class = "totop";
let scrollPos = window.pageYOffset;
let lastScrollPos = 0;
let offsetScroll = true;

window.addEventListener("scroll", function() {
	scrollPos = window.pageYOffset;

	if (!offsetScroll) {
		scrollPos += header_height;
	}

	if (scrollPos > header_height) {
		offsetScroll = false;

		header.classList.add(hidden_class);
	} else {
		offsetScroll = true;
		header.classList.remove(hidden_class);
	}

	lastScrollPos = scrollPos;
});

let addBtn = document.querySelector("#font-increment");
let subBtn = document.querySelector("#font-decrement");
const postcontent = document.querySelector(".entry-content");
const postpara = document.querySelectorAll("p");
//let el = document.querySelector(".num");
let num = 2;

let increment = () => {
	num += 1;
	subBtn.disabled = false;
	if (num > 5) {
		num = 5;
		addBtn.disabled = true;
	} else {
		//el.innerHTML = num;
	}
	postcontent.setAttribute("data-fontzoom", "font" + num);
};

let decrement = () => {
	num -= 1;
	addBtn.disabled = false;
	if (num < 0) {
		num = 0;
		//alert("Decrement button has been disabled.");
		subBtn.disabled = true;
	} else {
		//el.innerHTML = num;
	}
	postcontent.setAttribute("data-fontzoom", "font" + num);
};

function changefont() {
	postpara.forEach(function(userItem) {
		deleteUser(userItem);
	});
}

addBtn.addEventListener("click", increment);
subBtn.addEventListener("click", decrement);
