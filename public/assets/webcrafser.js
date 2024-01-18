function formatRupiah(input) {
  let value = input.value.replace(/[^0-9]/g, "");

  if (value !== "") {
    value = parseInt(value, 10).toLocaleString("id-ID");

    value = value.replace(/,/g, ".");

    input.value = "Rp " + value;
  } else {
    input.value = "";
  }
}