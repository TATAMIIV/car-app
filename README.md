<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

# 🚗 Car Inventory Management System
**Full Stack Developer Assignment - Toyota Khon Kaen Test**

ระบบจัดการข้อมูลรถยนต์ (CRUD) พร้อมระบบแจ้งเตือนแบบ Real-time พัฒนาด้วย Laravel 11, Filament PHP และ Laravel Reverb

---

## 🌐 Live Demo (Cloudflare Tunnel)
สามารถทดสอบระบบผ่าน URL ด้านล่างนี้ (กรุณาทดสอบในช่วงเวลาที่กำหนด คือ 09:00-17:00):
- **URL:** https://transparency-quite-food-evaluation.trycloudflare.com
- **Admin Panel:** https://transparency-quite-food-evaluation.trycloudflare.com/admin

### 🔑 Credentials สำหรับ Login
- **Email:** `admin@test.com`
- **Password:** `password`

---

## 🛠️ ขั้นตอนการติดตั้งสำหรับเครื่อง Local (Laravel Sail)

หากต้องการรันโปรเจกต์นี้ในเครื่องของคุณ ให้ทำตามขั้นตอนดังนี้:

### 1. เตรียมโปรเจกต์
```bash
git clone https://github.com/TATAMIIV/car-app.git
cd car-app
cp .env.example .env
```

### 2. ติดตั้ง Dependencies และรัน Docker
```bash
composer install
./vendor/bin/sail up -d
```

### 3. Setup ข้อมูลเริ่มต้น (Migration & Seeding)
```bash
./vendor/bin/sail artisan migrate:fresh --seed
```

### 4. การรันระบบ Real-time และ Assets
```bash
./vendor/bin/sail npm run dev
./vendor/bin/sail artisan reverb:start
```
