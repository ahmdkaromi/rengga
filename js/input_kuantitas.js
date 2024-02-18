const kuantitas = document.getElementById("kuantitas");
const decrement = document.getElementById("decrement");
const increment = document.getElementById("increment");

const filterContainer = document.querySelector(".filter_star");

filterContainer.addEventListener("click", action);

var jumlah = kuantitas.value;

decrement.addEventListener("click", function (e) {
  e.preventDefault;
  jumlah <= 1 ? (jumlah = 1) : --jumlah;
  kuantitas.value = jumlah;
  console.log(jumlah);
});

increment.addEventListener("click", function (e) {
  e.preventDefault;
  kuantitas.value = ++jumlah;
  console.log(jumlah);
});

function action(e) {
  const targets = e.target;
  const array = Array.from(filterContainer.childNodes);

  console.log(array);

  //   array.forEach((node) => {
  //     console.log(node);
  //     //  node.classList.remove("actived");
  //   });

  //   targets.classList.add("actived");
}
