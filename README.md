# 🎯 Laravel 10 Quiz App

Aplikasi quiz berbasis Laravel 10 dengan logika sesuai flowchart:
- **Login** pengguna
- **Role-based access** (Admin, Pelajar, Masyarakat)
- **Admin**: CRUD quiz & soal
- **Peserta** (Pelajar/Masyarakat): Mengerjakan quiz, submit jawaban, melihat hasil & penjelasan.

---

## 🚀 Fitur

### 👤 Autentikasi
- Login & register
- Role: `admin`, `pelajar`, `masyarakat`

### 🛠 Admin
- CRUD quiz
- Tambah soal & opsi jawaban
- Target quiz berdasarkan role peserta
- Melihat hasil quiz peserta

### 📚 Peserta
- Melihat daftar quiz sesuai role
- Mengerjakan quiz
- Submit jawaban
- Melihat hasil & penjelasan jawaban

---

## 🗄 Struktur Database

- **users** — Data pengguna & role
- **quizzes** — Data quiz
- **questions** — Pertanyaan
- **options** — Pilihan jawaban
- **quiz_attempts** — Riwayat pengerjaan quiz
- **user_answers** — Jawaban peserta

---

## 📂 Instalasi

1. **Clone Repository**
   ```bash
   git clone https://github.com/username/laravel-quiz-app.git
   cd laravel-quiz-app
