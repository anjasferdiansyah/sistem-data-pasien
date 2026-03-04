<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('data-pasien', function (Blueprint $table) {
            // Tambahkan kolom yang hilang
            if (!Schema::hasColumn('data-pasien', 'nik')) {
                $table->string('nik')->nullable()->after('nama');
            }
            if (!Schema::hasColumn('data-pasien', 'tanggal_lahir')) {
                $table->date('tanggal_lahir')->nullable()->after('nik');
            }
            if (!Schema::hasColumn('data-pasien', 'jenis_kelamin')) {
                $table->string('jenis_kelamin')->nullable()->after('tanggal_lahir');
            }
            if (!Schema::hasColumn('data-pasien', 'no_telepon')) {
                $table->string('no_telepon')->nullable()->after('alamat');
            }
            if (!Schema::hasColumn('data-pasien', 'email')) {
                $table->string('email')->nullable()->after('no_telepon');
            }
            if (!Schema::hasColumn('data-pasien', 'golongan_darah')) {
                $table->string('golongan_darah')->nullable()->after('email');
            }
            if (!Schema::hasColumn('data-pasien', 'riwayat_penyakit')) {
                $table->text('riwayat_penyakit')->nullable()->after('golongan_darah');
            }
            if (!Schema::hasColumn('data-pasien', 'alergi')) {
                $table->text('alergi')->nullable()->after('riwayat_penyakit');
            }
            
            // Tambahkan timestamps
            if (!Schema::hasColumn('data-pasien', 'created_at')) {
                $table->timestamps();
            }
        });
        
        // Update data yang sudah ada
        try {
            \DB::statement("UPDATE `data-pasien` SET tanggal_lahir = NULL WHERE tanggal_lahir = '0000-00-00'");
            \DB::statement("UPDATE `data-pasien` SET nik = CONCAT('TMP_', id) WHERE nik IS NULL OR nik = ''");
            \DB::statement("UPDATE `data-pasien` SET jenis_kelamin = 'L' WHERE jenis_kelamin IS NULL OR jenis_kelamin = ''");
            \DB::statement("UPDATE `data-pasien` SET no_telepon = no_hp WHERE no_telepon IS NULL AND no_hp IS NOT NULL");
        } catch (\Exception $e) {
            // Ignore errors for now
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('data-pasien', function (Blueprint $table) {
            $table->dropColumn([
                'nik',
                'tanggal_lahir', 
                'jenis_kelamin',
                'no_telepon',
                'email',
                'golongan_darah',
                'riwayat_penyakit',
                'alergi',
                'created_at',
                'updated_at'
            ]);
        });
    }
};
