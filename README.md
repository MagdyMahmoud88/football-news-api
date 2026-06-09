<div align="center">

# ⚽ Football News API

RESTful API لأخبار كرة القدم | Laravel 11 · Sanctum · MySQL

![Laravel](https://img.shields.io/badge/Laravel-11-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-8.2-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-8.0-4479A1?style=for-the-badge&logo=mysql&logoColor=white)
![Sanctum](https://img.shields.io/badge/Sanctum-Auth-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)

</div>

---

## ✨ المميزات

### 📰 الأخبار
- عرض وتصفية الأخبار حسب الفئة والفريق
- بحث في الأخبار
- أخبار عاجلة
- نشر / إخفاء الأخبار

### 🏆 الفرق واللاعبين
- إدارة الفرق والدوريات
- إدارة اللاعبين مع ربطهم بالفرق
- أخبار كل فريق منفصلة

### 👤 المستخدمين
- تسجيل وتسجيل دخول بـ Sanctum
- حفظ الأخبار في المفضلة
- التعليق على الأخبار

### 🛠️ لوحة الأدمن
- إدارة كاملة للأخبار والفئات والفرق واللاعبين
- Admin Middleware للحماية

---

## 🔗 API Endpoints

### Auth
| Method | Endpoint | Description |
|--------|----------|-------------|
| POST | `/api/auth/register` | تسجيل مستخدم جديد |
| POST | `/api/auth/login` | تسجيل الدخول |
| POST | `/api/auth/logout` | تسجيل الخروج |
| GET  | `/api/auth/me` | بيانات المستخدم الحالي |

### Public
| Method | Endpoint | Description |
|--------|----------|-------------|
| GET | `/api/news` | كل الأخبار |
| GET | `/api/news/{slug}` | خبر واحد |
| GET | `/api/news/breaking` | الأخبار العاجلة |
| GET | `/api/categories` | كل الفئات |
| GET | `/api/categories/{slug}/news` | أخبار فئة |
| GET | `/api/teams` | كل الفرق |
| GET | `/api/teams/{slug}` | فريق واحد |
| GET | `/api/teams/{slug}/news` | أخبار فريق |
| GET | `/api/players` | كل اللاعبين |
| GET | `/api/players/{slug}` | لاعب واحد |

### Authenticated
| Method | Endpoint | Description |
|--------|----------|-------------|
| POST | `/api/news/{news}/comments` | إضافة تعليق |
| DELETE | `/api/comments/{comment}` | حذف تعليق |
| POST | `/api/bookmarks/{news}` | حفظ / إلغاء حفظ خبر |
| GET | `/api/bookmarks` | أخباري المحفوظة |

### Admin
| Method | Endpoint | Description |
|--------|----------|-------------|
| GET/POST | `/api/admin/news` | إدارة الأخبار |
| PATCH | `/api/admin/news/{news}/toggle-breaking` | تبديل عاجل |
| PATCH | `/api/admin/news/{news}/toggle-published` | تبديل النشر |
| GET/POST | `/api/admin/categories` | إدارة الفئات |
| GET/POST | `/api/admin/teams` | إدارة الفرق |
| GET/POST | `/api/admin/players` | إدارة اللاعبين |

---

## 🛠️ التقنيات المستخدمة

| الطبقة | التقنية |
|--------|---------|
| Backend | Laravel 11 |
| Authentication | Laravel Sanctum |
| Database | MySQL |
| Storage | Laravel Storage |

---

## 🚀 طريقة التشغيل

### المتطلبات
- PHP >= 8.2
- Composer
- MySQL

### الخطوات

```bash
# 1. Clone المشروع
git clone https://github.com/MagdyMahmoud88/football-news-api.git
cd football-news-api

# 2. تثبيت الـ dependencies
composer install

# 3. إعداد ملف البيئة
cp .env.example .env
php artisan key:generate

# 4. إعداد قاعدة البيانات في .env
# DB_DATABASE=football_news
# DB_USERNAME=root
# DB_PASSWORD=

# 5. تشغيل الـ migrations والـ seeders
php artisan migrate --seed

# 6. Storage link
php artisan storage:link

# 7. تشغيل السيرفر
php artisan serve
```

---

## 🧪 تست الـ API

استورد ملف `postman_collection.json` في Postman وستجد كل الـ endpoints جاهزة للاختبار.

**بيانات الأدمن:**
```
Email: admin@football.com
Password: password
```

---

## 👨‍💻 المطور

**Magdy Mahmoud**
- GitHub: [@MagdyMahmoud88](https://github.com/MagdyMahmoud88)

---

<div align="center">
صُنع بـ ❤️ باستخدام Laravel
</div>
