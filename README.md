<p align="center">
  <img src="https://readme-typing-svg.herokuapp.com?font=Orbitron&size=35&color=FF2D20&center=true&vCenter=true&width=800&lines=Laravel+10+Quiz+App;Role-Based+Quiz+System;Admin+%7C+Pelajar+%7C+Masyarakat;Built+with+Love+and+Laravel" />
</p>

<!-- Laravel Logo GIF -->
<p align="center">
  <img src="https://media4.giphy.com/media/ES4Vcv8zWfIt2/giphy.gif" width="150px" alt="Laravel GIF" />
</p>

---

# 🎯 Laravel 10 Quiz App

Aplikasi quiz berbasis **Laravel 10** dengan logika role-based sesuai flowchart berikut:
- 🔐 **Login** pengguna
- 🎭 **Role-based access**: Admin, Pelajar, Masyarakat
- 🛠 **Admin**: CRUD quiz & soal
- 📝 **Peserta**: Mengerjakan quiz, submit jawaban, melihat hasil & penjelasan.

---

## 🚀 **Fitur Utama**

### 👤 **Autentikasi**
- Login & register
- Role: `admin`, `pelajar`, `masyarakat`

### 🛠 **Admin**
- CRUD quiz & soal
- Tambah opsi jawaban
- Target quiz berdasarkan role
- Lihat hasil quiz peserta

### 📚 **Peserta**
- Lihat daftar quiz sesuai role
- Mengerjakan quiz
- Submit jawaban
- Melihat hasil & penjelasan

---

## 🗄 **Struktur Database**
| Tabel | Deskripsi |
|-------|-----------|
| **users** | Data pengguna & role |
| **quizzes** | Data quiz |
| **questions** | Pertanyaan |
| **options** | Pilihan jawaban |
| **quiz_attempts** | Riwayat pengerjaan |
| **user_answers** | Jawaban peserta |

---

## 📂 **Instalasi**

---

## 1️⃣ **Clone Repository**

---
```
git clone https://github.com/Akbar330/BNN_QUIZ.git
cd laravel-quiz-app
```

## 2️⃣ Install Dependencies

---
```
Copy
Edit
composer install
npm install
npm run dev
```

## 3️⃣ Setup Environment

---
```
Copy
Edit
cp .env.example .env
php artisan key:generate
Edit .env sesuai konfigurasi database Anda. 
```

## 4️⃣ Migrasi Database

---
```
Copy
Edit
php artisan migrate --seed
```

## 5️⃣ Jalankan Server

---
```
Copy
Edit
php artisan serve
```

## 🔑 Akun Default (Seeder)

---

- Role	Email	Password
- Admin	admin@example.com	password
- Pelajar	pelajar@example.com	password
- Masyarakat	masyarakat@example.com	password

## 📌 Alur Logika

---

flowchart TD
    A[🔑 Login] --> B{👥 Role?}
    
    B -->|👨‍💼 Admin| C[📝 CRUD Quiz & Soal]
    B -->|🎓 Pelajar| D[📚 Daftar Quiz Pelajar]
    B -->|🏛 Masyarakat| E[📚 Daftar Quiz Masyarakat]
    
    D --> F[🚀 Mulai Quiz]
    E --> F
    
    F --> G[✏️ Jawab Soal]
    G --> H[📤 Submit Jawaban]
    H --> I[📊 Hasil & Penjelasan Jawaban]
    
    C --> B


## 🤝 Kontribusi

---
```
Fork repo ini

Buat branch baru: feature/nama-fitur

Commit perubahan Anda

Push ke branch

Buat Pull Request
```


## 📄 Lisensi

---

Hak cipta © 2025 Badan Narkotika Nasional Kota Bandung.  
Dilarang menggunakan kode ini untuk tujuan komersial tanpa izin tertulis.  
Boleh digunakan, dimodifikasi, dan dibagikan untuk tujuan non-komersial dengan menyertakan kredit.

 
<p align="center"> 💡 *"Belajar adalah perjalanan, bukan tujuan. Teruslah membangun dan berkembang."* </p>
