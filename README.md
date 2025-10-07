# 🏡 Recova Rentals Web

**Recova Rentals Web** es una aplicación desarrollada en **Laravel 12** con **Livewire v3**, **Tailwind CSS v4** y **Breeze** para la autenticación de usuarios.  
El sistema permite la gestión de alquileres, usuarios y roles (administrador / cliente), ofreciendo una base moderna y segura para el desarrollo continuo del proyecto.

---

## 🚀 Tecnologías utilizadas

| Área | Tecnología |
|------|-------------|
| Backend | Laravel 12 (PHP 8.2) |
| Frontend | Livewire v3 + Tailwind CSS v4 |
| Autenticación | Laravel Breeze + Sanctum |
| Base de datos | MySQL / MariaDB |
| Servidor local | Laragon |
| Compilador assets | Vite |

---

## ⚙️ Instalación del proyecto

Cloná el repositorio y ejecutá los siguientes pasos en la raíz del proyecto:

```bash
# 1️⃣ Clonar el proyecto
git clone https://github.com/<tu_usuario>/<tu_repo>.git
cd Recova-Rentals-Web

# 2️⃣ Instalar dependencias de PHP
composer install

# 3️⃣ Instalar dependencias de Node.js
npm install

# 4️⃣ Copiar archivo de entorno
cp .env.example .env

# 5️⃣ Generar clave de aplicación
php artisan key:generate

# 6️⃣ Configurar conexión a base de datos en .env
# (nombre de BD, usuario, contraseña)

# 7️⃣ Ejecutar migraciones y seeders
php artisan migrate --seed

# 8️⃣ Compilar assets (modo desarrollo)
npm run dev
