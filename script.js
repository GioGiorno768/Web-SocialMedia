var navLinks = document.querySelectorAll(".category-item");

navLinks.forEach(function(link) {
  link.addEventListener("mouseenter", function() {
    navLinks.forEach(function(link) {
      link.classList.remove("active");
    });
    this.classList.add("active");
  });
});

const check = document.getElementById("chcont")
const form1 = document.getElementById("conform")
const txemail = document.getElementById("emailform")


check.onclick = () => {
  form1.getAttribute("action")
  form1.setAttribute(`action`, `mailto:${txemail.value}`)
}
