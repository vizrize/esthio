# Cara Menambahkan Review

Review di website Esthio menggunakan sistem JSON. Tidak ada review palsu atau hardcoded di HTML.

## Format Review

Edit file `reviews.json` dan tambahkan review baru dengan format:

```json
{
  "reviews": [
    {
      "name": "Nama Pelanggan",
      "rating": 5,
      "comment": "Komentar review pelanggan",
      "date": "2025-01-15",
      "variant": "Cookies & Cream",
      "verified": true
    }
  ]
}
```

## Field Penjelasan

- **name**: Nama pelanggan (wajib)
- **rating**: Rating 1-5 bintang (wajib)
- **comment**: Komentar/testimoni pelanggan (wajib)
- **date**: Tanggal review format YYYY-MM-DD (wajib)
- **variant**: Varian yang dibeli - opsional (Cookies & Cream / Chocolate / Strawberry / Matcha Green Tea)
- **verified**: true/false - badge pembeli terverifikasi (opsional)

## Contoh Multiple Reviews

```json
{
  "reviews": [
    {
      "name": "Budi Santoso",
      "rating": 5,
      "comment": "Enak banget! Gabin-nya renyah dan es krimnya lembut. Rasa cookies & cream-nya pas banget, ga terlalu manis.",
      "date": "2025-01-15",
      "variant": "Cookies & Cream",
      "verified": true
    },
    {
      "name": "Siti Nurhaliza",
      "rating": 5,
      "comment": "Pertama kali coba es krim tape, ternyata enak! Matchanya berasa premium. Packing juga rapi, sampai masih beku.",
      "date": "2025-01-14",
      "variant": "Matcha Green Tea",
      "verified": true
    },
    {
      "name": "Ahmad Rizki",
      "rating": 4,
      "comment": "Cokelatnya pekat dan ga terlalu manis. Cuma pengen lebih banyak lagi porsinya hehe. Overall recommended!",
      "date": "2025-01-13",
      "variant": "Chocolate",
      "verified": false
    }
  ]
}
```

## Important Notes

1. **Hanya review ASLI** - Jangan tambahkan review palsu
2. **Format JSON harus valid** - Gunakan validator JSON jika perlu
3. **Tanggal real** - Gunakan tanggal sebenarnya saat review diterima
4. **Verified badge** - Hanya untuk pelanggan yang benar-benar melakukan pembelian
5. File akan di-load otomatis saat website dibuka

## Fitur Review Section

✅ Rating bintang (1-5)
✅ Verified buyer badge
✅ Varian produk yang dibeli
✅ Tanggal review (format Indonesia)
✅ Statistik rating rata-rata
✅ Distribusi rating (bar chart)
✅ Empty state jika belum ada review
✅ XSS protection (HTML escaping)

## Testing

Setelah menambah review di `reviews.json`, refresh website untuk melihat perubahan.
