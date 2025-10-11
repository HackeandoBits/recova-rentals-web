# RECOVA RENTALS – Base de Datos & Dependencias

## Resumen
Proyecto en **Laravel 12** + **MySQL 8**.

- **Dominio (app propia):** catálogo, combos, bookings (lead público), appointments (agenda interna), disponibilidad.
- **Spatie Permission:** roles/permisos.
- **Sanctum:** tokens de API.
- **Core Laravel:** users, jobs/queues, cache, sessions, password reset.

---

## Mapa de tablas → paquete/dependencia

### Dominio (proyecto)
- `categories`, `items`, `item_features`, `item_specs`
- `combos`, `combo_item`
- `bookings`, `booking_items`
- `appointments` ← (nueva, agenda con horarios y responsable interno)
- `blocked_slots`  
**Origen:** migraciones del proyecto (catálogo, combos, reservas, agenda y disponibilidad).

### Spatie Laravel-Permission
- `roles`
- `permissions`
- `role_has_permissions` (pivot rol ↔ permiso)
- `model_has_roles` (pivot modelo ↔ rol; p.ej. users)
- `model_has_permissions` (pivot modelo ↔ permiso directo)  
**Paquete:** `spatie/laravel-permission`.

### Laravel Sanctum (API tokens)
- `personal_access_tokens`  
**Paquete:** `laravel/sanctum`.

### Laravel Queue / Bus (jobs)
- `jobs`, `failed_jobs`, `job_batches`  
**Origen:** Core de Laravel (migraciones generadas con `queue:table` y `queue:batches-table`).

### Laravel Cache (database driver)
- `cache`, `cache_locks`  
**Origen:** Core de Laravel (migraciones generadas con `cache:table`).

### Laravel Session (database driver)
- `sessions`  
**Origen:** Core de Laravel (migración generada con `session:table`).

### Laravel Auth / Núcleo
- `users` — usuarios de la app
- `password_reset_tokens` — reseteo de contraseña
- `migrations` — historial de migraciones  
**Origen:** Core de Laravel.

---

## ¿Qué guarda cada tabla del dominio?

- **categories**: jerarquía del catálogo (con `parent_id` para subcategorías).
- **items**: productos alquilables (precio diario, stock, activo).
- **item_features**: bullets cortos para mostrar (ordenados).
- **item_specs**: ficha técnica clave→valor para filtros/comparación.
- **combos**: paquetes comerciales activos/inactivos.
- **combo_item**: pivot N:M combos↔items con `quantity`.
- **bookings**: lead de cliente (sin login) con datos de contacto, fecha de evento y estado.
- **booking_items**: snapshot de lo seleccionado (items/combos) en la booking.
- **appointments**: reuniones internas con horario real y responsable.
  - Campos clave: `booking_id`, `assigned_user_id`, `starts_at`, `ends_at`, `channel (office/whatsapp/email)`, `status`.
  - Índices: `assigned_user_id, starts_at, ends_at` y `unique(booking_id, assigned_user_id, starts_at)` para evitar duplicados exactos.
  - **Anti-solape**: se valida por responsable (`assigned_user_id`) y rango `starts_at…ends_at`.
- **blocked_slots**: bloqueos por **día completo** (manual/GCal) por usuario/owner.  
  > *Tip*: si en el futuro necesitás bloquear **franjas horarias**, se puede extender con `time_from/time_to`.

---

## Diagrama ASCII (dominio)

```
Category (categories)
├─ id PK
├─ parent_id FK → categories.id
└─ name, slug, description

Item (items)
├─ id PK
├─ category_id FK → categories.id
└─ name, slug, stock, active, description

ItemFeature (item_features)
├─ id PK
├─ item_id FK → items.id
└─ text, sort_order

ItemSpec (item_specs)
├─ id PK
├─ item_id FK → items.id
└─ spec_key, spec_value, sort_order

Combo (combos)
├─ id PK
└─ name, slug, active

combo_item (pivot)
├─ combo_id FK → combos.id
├─ item_id  FK → items.id
└─ quantity

Booking (bookings)
├─ id PK
└─ customer_name, email, event_date, meeting_*, service_type, status

BookingItem (booking_items)
├─ id PK
├─ booking_id FK → bookings.id
└─ product_type, product_id, name, category, description, quantity

Appointment (appointments)
├─ id PK
├─ booking_id FK → bookings.id
├─ assigned_user_id FK → users.id
├─ starts_at, ends_at (DATETIME AR)
├─ channel (office/whatsapp/email), location_note
└─ status (scheduled/done/cancelled)

BlockedSlot (blocked_slots)
├─ id PK
├─ owner_user_id FK → users.id
└─ date_from, date_to, reason, source
```

Relaciones clave:
- `Category 1─* Item`
- `Item 1─* ItemFeature`
- `Item 1─* ItemSpec`
- `Combo *─* Item` (pivot `combo_item` con `quantity`)
- `Booking 1─* BookingItem`
- **`Booking 1─* Appointment`** (una booking puede tener 0..N reuniones)
- `User 1─* Appointment` (asignado/operador)
- `User 1─* BlockedSlot`

---

## Anti-solape (regla y alcance)

**Regla de solape:** dos rangos se solapan si  
`A.starts_at < B.ends_at` **y** `A.ends_at > B.starts_at`.

**Política recomendada:**
- Chequear **appointments** del mismo `assigned_user_id` con `status = 'scheduled'`.
- Chequear **blocked_slots** (día completo) del mismo usuario/owner en las fechas del rango.

> Toda la operación es en **America/Argentina/Cordoba** (AR). `appointments.starts_at/ends_at` son `DATETIME` en hora local AR.

---

## Setup de dependencias

### Spatie Permission
```bash
composer require spatie/laravel-permission
php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider" --tag="config"
# (si te faltan migraciones del paquete, también: --tag="migrations")
php artisan migrate
```

En `app/Models/User.php` agrega:
```php
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable {
    use HasApiTokens, HasFactory, Notifiable, HasRoles;
}
```

### Sanctum
```bash
composer require laravel/sanctum
php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"
php artisan migrate
```

---

## Migraciones & Seeders (flujo recomendado)

Seeders incluidos:
- `CategorySeeder`, `ItemSeeder`, `ComboSeeder`, `BookingSeeder`
- `RolesSeeder` (Spatie: crea “Admin”, “User”)
- `UserSeeder` (admin `admin@gmail.com / Admin123`, user demo)
- `BlockedSlotSeeder` (rangos fijos para owner_id=1)

Ejecución completa:
```bash
php artisan migrate:fresh --seed
php artisan permission:cache-reset
```

Chequeos útiles:
```sql
-- roles Spatie
SELECT id, name FROM roles;

-- asignaciones user↔role (Spatie)
SELECT * FROM model_has_roles;

-- tokens API (Sanctum)
SELECT * FROM personal_access_tokens;

-- dominio
SELECT COUNT(*) FROM items;
SELECT COUNT(*) FROM bookings;
SELECT COUNT(*) FROM appointments;
SELECT * FROM blocked_slots;
```

---

## Comandos artisan que generan tablas core

**Queue**
```bash
php artisan queue:table
php artisan queue:batches-table
php artisan migrate
```

**Cache**
```bash
php artisan cache:table
php artisan migrate
```

**Session**
```bash
php artisan session:table
php artisan migrate
```

---

## Notas
- `migrate:fresh` borra y recrea todas las tablas con migración (propias o de paquetes).
- Si no querés una tabla (cache/sessions via DB), no publiques su migración o cambiá el driver correspondiente en `.env`.
- Con Spatie, **no crees `App\Models\Role`**; se usa `Spatie\Permission\Models\Role`.
- Zona horaria de la app: `America/Argentina/Cordoba` (configurado en `config/app.php`).

