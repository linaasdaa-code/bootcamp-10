// ===================================================
// 1. DATA PRODUK
// ===================================================
const daftarProduk = [
  { id: 1, nama: "French Rose", kategori: "floral", harga: 149000, hargaAsli: 179000, rating: 4.8, ulasan: 128, deskripsi: "Aroma mawar Prancis yang lembut dan romantis.", gambar: "https://picsum.photos/seed/frenchrose/600/450" },
  { id: 2, nama: "Provence Lavender", kategori: "floral", harga: 149000, hargaAsli: 169000, rating: 4.9, ulasan: 85, deskripsi: "Lavender yang menenangkan untuk waktu istirahat.", gambar: "https://picsum.photos/seed/lavender/600/450" },
  { id: 3, nama: "Gardenia", kategori: "floral", harga: 159000, hargaAsli: 189000, rating: 4.7, ulasan: 64, deskripsi: "Bunga gardenia putih yang elegan dan bersih.", gambar: "https://picsum.photos/seed/gardenia/600/450" },
  { id: 4, nama: "Vanilla Soft", kategori: "sweet", harga: 129000, hargaAsli: 149000, rating: 4.8, ulasan: 210, deskripsi: "Vanilla hangat yang membuat ruangan terasa nyaman.", gambar: "https://picsum.photos/seed/vanilla/600/450" },
  { id: 5, nama: "Honeyed Bloom", kategori: "sweet", harga: 159000, hargaAsli: 179000, rating: 4.6, ulasan: 47, deskripsi: "Perpaduan bunga nectarine dan madu yang manis.", gambar: "https://picsum.photos/seed/honey/600/450" },
  { id: 6, nama: "Island Vanilla", kategori: "sweet", harga: 139000, hargaAsli: 159000, rating: 4.5, ulasan: 39, deskripsi: "Kelapa dan vanilla, seperti liburan di pantai Bali.", gambar: "https://picsum.photos/seed/island/600/450" },
  { id: 7, nama: "Osmanthus Tea", kategori: "fresh", harga: 129000, hargaAsli: 149000, rating: 4.7, ulasan: 92, deskripsi: "Teh hijau dan bunga osmanthus yang segar.", gambar: "https://picsum.photos/seed/osmanthus/600/450" },
  { id: 8, nama: "Pear Freesia", kategori: "fresh", harga: 139000, hargaAsli: 159000, rating: 4.8, ulasan: 76, deskripsi: "Pir segar dan freesia yang ringan.", gambar: "https://picsum.photos/seed/pear/600/450" },
  { id: 9, nama: "Rose Oud", kategori: "woody", harga: 189000, hargaAsli: 229000, rating: 4.9, ulasan: 58, deskripsi: "Mawar dan kayu oud yang hangat dan mewah.", gambar: "https://picsum.photos/seed/roseoud/600/450" },
  { id: 10, nama: "Sacred Wood", kategori: "woody", harga: 179000, hargaAsli: 199000, rating: 4.6, ulasan: 33, deskripsi: "Cendana yang tenang, cocok untuk meditasi.", gambar: "https://picsum.photos/seed/sandalwood/600/450" }
];

const daftarKategori = [
  { kode: "semua", label: "All" },
  { kode: "floral", label: "Floral" },
  { kode: "sweet", label: "Sweet" },
  { kode: "fresh", label: "Fresh" },
  { kode: "woody", label: "Woody" }
];

// ===================================================
// 2. KONDISI FILTER SAAT INI
// ===================================================
let kataKunci = "";
let kategoriAktif = "semua";
let hargaMaksimum = 300000;
let urutan = "rekomendasi";
let jumlahKeranjang = 0;

// ===================================================
// 3. AMBIL ELEMEN DARI HTML
// ===================================================
const wadahProduk = document.getElementById("daftar-produk");
const wadahKategori = document.getElementById("daftar-kategori");
const inputCari = document.getElementById("cari");
const inputHarga = document.getElementById("harga-maks");
const teksHarga = document.getElementById("teks-harga");
const pilihUrutan = document.getElementById("urutan");
const teksJumlah = document.getElementById("jumlah-tampil");
const badgeKeranjang = document.getElementById("jumlah-keranjang");
const tombolReset = document.getElementById("reset");

// ===================================================
// 4. FUNGSI BANTUAN: format rupiah
// ===================================================
function rupiah(angka) {
  return "Rp " + angka.toLocaleString("id-ID");
}

// ===================================================
// 5. TAMPILKAN DAFTAR KATEGORI (dengan jumlah produk)
// ===================================================
function tampilkanKategori() {
  wadahKategori.innerHTML = "";

  daftarKategori.forEach(function (kat) {
    let jumlah;
    if (kat.kode === "semua") {
      jumlah = daftarProduk.length;
    } else {
      jumlah = daftarProduk.filter(function (p) {
        return p.kategori === kat.kode;
      }).length;
    }

    const tercentang = kat.kode === kategoriAktif ? "checked" : "";

    wadahKategori.innerHTML += `
      <div class="form-check d-flex justify-content-between mb-2">
        <div>
          <input class="form-check-input" type="radio" name="kategori"
                 id="kat-${kat.kode}" value="${kat.kode}" ${tercentang}
                 onchange="pilihKategori('${kat.kode}')">
          <label class="form-check-label" for="kat-${kat.kode}">${kat.label}</label>
        </div>
        <span class="text-muted small">${jumlah}</span>
      </div>
    `;
  });
}

// ===================================================
// 6. TAMPILKAN PRODUK
// ===================================================
function tampilkanProduk(produkYangDitampilkan) {
  wadahProduk.innerHTML = "";

  if (produkYangDitampilkan.length === 0) {
    wadahProduk.innerHTML = `<p class="text-center text-muted py-5">Produk tidak ditemukan.</p>`;
    return;
  }

  produkYangDitampilkan.forEach(function (produk) {
    wadahProduk.innerHTML += `
      <div class="col-12 col-sm-6 col-xl-4 mb-4">
        <div class="card h-100 produk-card">
          <img src="${produk.gambar}" class="card-img-top" alt="${produk.nama}">
          <div class="card-body d-flex flex-column">
            <p class="small mb-1">
              <span class="bintang">★ ${produk.rating}</span>
              <span class="text-muted">(${produk.ulasan})</span>
            </p>
            <h5 class="card-title">${produk.nama}</h5>
            <p class="card-text text-muted small">${produk.deskripsi}</p>
            <p class="harga mb-0">${rupiah(produk.harga)}</p>
            <p class="harga-asli small">${rupiah(produk.hargaAsli)}</p>
            <div class="d-flex gap-2 mt-auto">
              <button class="btn btn-outline-dark flex-grow-1" onclick="lihatDetail(${produk.id})">Detail</button>
              <button class="btn btn-gold" onclick="tambahKeKeranjang()">+ 🛒</button>
            </div>
          </div>
        </div>
      </div>
    `;
  });
}

// ===================================================
// 7. GABUNGKAN SEMUA FILTER + URUTAN
// ===================================================
function terapkanFilter() {
  let hasil = daftarProduk.filter(function (produk) {
    const cocokKategori = kategoriAktif === "semua" || produk.kategori === kategoriAktif;
    const cocokHarga = produk.harga <= hargaMaksimum;
    const teks = (produk.nama + " " + produk.deskripsi).toLowerCase();
    const cocokKata = teks.includes(kataKunci.toLowerCase());
    return cocokKategori && cocokHarga && cocokKata;
  });

  if (urutan === "termurah") {
    hasil.sort(function (a, b) { return a.harga - b.harga; });
  } else if (urutan === "termahal") {
    hasil.sort(function (a, b) { return b.harga - a.harga; });
  } else if (urutan === "nama") {
    hasil.sort(function (a, b) { return a.nama.localeCompare(b.nama); });
  }

  tampilkanProduk(hasil);
  teksJumlah.innerHTML = `Menampilkan <b>${hasil.length}</b> dari <b>${daftarProduk.length}</b> produk`;
}

// ===================================================
// 8. AKSI DARI PENGGUNA
// ===================================================
function pilihKategori(kode) {
  kategoriAktif = kode;
  terapkanFilter();
}

inputCari.addEventListener("input", function () {
  kataKunci = inputCari.value;
  terapkanFilter();
});

inputHarga.addEventListener("input", function () {
  hargaMaksimum = Number(inputHarga.value);
  teksHarga.textContent = rupiah(hargaMaksimum);
  terapkanFilter();
});

pilihUrutan.addEventListener("change", function () {
  urutan = pilihUrutan.value;
  terapkanFilter();
});

tombolReset.addEventListener("click", function () {
  kataKunci = "";
  kategoriAktif = "semua";
  hargaMaksimum = 300000;
  urutan = "rekomendasi";

  inputCari.value = "";
  inputHarga.value = 300000;
  teksHarga.textContent = rupiah(300000);
  pilihUrutan.value = "rekomendasi";

  tampilkanKategori();
  terapkanFilter();
});

// ===================================================
// 9. KERANJANG & DETAIL PRODUK
// ===================================================
function tambahKeKeranjang() {
  jumlahKeranjang = jumlahKeranjang + 1;
  badgeKeranjang.textContent = jumlahKeranjang;
}

function lihatDetail(id) {
  const produk = daftarProduk.find(function (p) {
    return p.id === id;
  });

  document.getElementById("detail-gambar").src = produk.gambar;
  document.getElementById("detail-nama").textContent = produk.nama;
  document.getElementById("detail-deskripsi").textContent = produk.deskripsi;
  document.getElementById("detail-harga").textContent = rupiah(produk.harga);

  const modal = bootstrap.Modal.getOrCreateInstance(document.getElementById("modalDetail"));
  modal.show();
}

// ===================================================
// 10. JALANKAN SAAT HALAMAN DIBUKA
// ===================================================
tampilkanKategori();
terapkanFilter();
