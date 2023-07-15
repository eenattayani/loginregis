const jlhBarang = document.querySelector("#product-jlh");
const subtotal = document.querySelector("#subtotal");

const hargaSatuan = Number(subtotal.value.split(" ")[1]);

function kurangSubtotal() {
  jlhBarang.value = Number(jlhBarang.value) - 1;
  if (jlhBarang.value <= 0) jlhBarang.value = 1;

  subtotal.value = "Rp " + hargaSatuan * Number(jlhBarang.value);
}

function tambahSubtotal() {
  jlhBarang.value = Number(jlhBarang.value) + 1;

  subtotal.value = "Rp " + hargaSatuan * Number(jlhBarang.value);
}

function ubahSubtotal() {
  jlhBarang.value = Number(jlhBarang.value);

  subtotal.value = "Rp " + hargaSatuan * Number(jlhBarang.value);
}
