let checkAll = document.querySelector("#selectAllBoxes");
let checkboxes = document.querySelectorAll(".checkbox");

checkAll.addEventListener("input", (e) => {
  if (checkAll.checked == true) {
    checkboxes.forEach((checkbox) => {
      checkbox.checked = true;
    });
  } else {
    checkboxes.forEach((checkbox) => {
      checkbox.checked = false;
    });
  }
});
