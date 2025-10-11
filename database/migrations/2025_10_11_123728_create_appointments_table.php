<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('appointments', function (Blueprint $table) {

            $table->id();
            // vínculo a la reserva creada por el cliente (lead)
            $table->foreignId('booking_id')->constrained('bookings')->cascadeOnDelete();

            // staff interno responsable que atiende
            $table->foreignId('assigned_user_id')->constrained('users')->cascadeOnDelete();

            // rango horario real (en tu TZ global: America/Argentina/Cordoba)
            $table->dateTime('starts_at');
            $table->dateTime('ends_at');

            // canal: oficina / whatsapp / email
            $table->enum('channel', ['office','whatsapp','email'])->default('office');

            // nota opcional (ej: "Sala 2", "Llamar al cliente", etc.)
            $table->string('location_note')->nullable();

            // estado de la cita
            $table->enum('status', ['scheduled','done','cancelled'])->default('scheduled');

            $table->timestamps();

            // índices útiles
            $table->index(['assigned_user_id','starts_at','ends_at'], 'appt_owner_time_idx');
            $table->index('booking_id');
            $table->index(['status','starts_at']);
            $table->index('starts_at');

            // Evita duplicados exactos del mismo turno
            $table->unique(['booking_id','assigned_user_id','starts_at'], 'appt_unique_per_owner_start');
        });

        // Nota: MySQL >= 8.0.16 lo respeta; MariaDB puede ignorarlo.
        try {
            DB::statement("
                ALTER TABLE appointments
                ADD CONSTRAINT chk_appt_time CHECK (starts_at < ends_at)
            ");
        } catch (\Throwable $e) {
            // Si tu motor no soporta CHECK (p.ej. MariaDB antiguo), lo omitimos en silencio.
            // La validación ya está cubierta en tus FormRequests.
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
