const inputId = document.querySelector("#fid-kategori");
const inputNama = document.querySelector("#fnama-kategori");

const btnTambah = document.querySelector("#btntambah");
const btnSimpan = document.querySelector("#btnsimpan");
const btnBatal = document.querySelector("#btnbatal");
const btnHapus = document.querySelector("#btnhapus");
const btnCari = document.querySelector("#btncari");
const btnUbah = document.querySelector("#btnubah");

btnSimpan.disabled = true;
btnSimpan.classList.add("disabled");
btnBatal.disabled = true;
btnBatal.classList.add("disabled");
btnHapus.disabled = true;
btnHapus.classList.add("disabled");
btnCari.disabled = true;
btnCari.classList.add("disabled");
btnUbah.disabled = true;
btnUbah.classList.add("disabled");

function pilihBaris(row) {
  const kolId = document.querySelector("#id" + row).innerHTML;
  const kolNama = document.querySelector("#nama" + row).innerHTML;

  console.log("barisnya: " + row + kolId + " dan " + kolNama);
  inputId.value = kolId;
  inputNama.value = kolNama;
  inputId.readOnly = true;
  inputNama.readOnly = true;

  btnUbah.disabled = false;
  btnUbah.classList.remove("disabled");
  btnHapus.disabled = false;
  btnHapus.classList.remove("disabled");
  btnTambah.disabled = true;
  btnTambah.classList.add("disabled");
  btnBatal.disabled = false;
  btnBatal.classList.remove("disabled");
  btnSimpan.disabled = true;
  btnSimpan.classList.add("disabled");
}

function ubah() {
  inputNama.readOnly = false;
  inputNama.focus();

  btnSimpan.disabled = false;
  btnSimpan.classList.remove("disabled");
  btnHapus.disabled = true;
  btnHapus.classList.add("disabled");
}

function batal() {
  inputNama.readOnly = false;
  inputNama.value = "";
  inputId.readOnly = false;
  inputId.value = "";
  inputId.focus();

  btnUbah.disabled = true;
  btnUbah.classList.add("disabled");
  btnBatal.disabled = true;
  btnBatal.classList.add("disabled");
  btnSimpan.disabled = true;
  btnSimpan.classList.add("disabled");
  btnTambah.disabled = false;
  btnTambah.classList.remove("disabled");
  btnHapus.disabled = true;
  btnHapus.classList.add("disabled");
}

function inputData() {
  console.log("ubah data");

  if (inputId.value !== "" || inputNama.value !== "") {
    btnBatal.disabled = false;
    btnBatal.classList.remove("disabled");

    return;
    console.log("hapus data");
  }

  btnBatal.disabled = true;
  btnBatal.classList.add("disabled");
}
