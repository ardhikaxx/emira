<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Icd10Seeder extends Seeder
{
    public function run(): void
    {
        $icd10s = [
            ['kode' => 'A09', 'nama_penyakit_indonesia' => 'Diare dan Gastroenteritis', 'nama_penyakit_inggris' => 'Diarrhoea and Gastroenteritis', 'kategori' => 'Penyakit Infeksi'],
            ['kode' => 'A15', 'nama_penyakit_indonesia' => 'Tuberkulosis Paru', 'nama_penyakit_inggris' => 'Tuberculosis of Lungs', 'kategori' => 'Penyakit Infeksi'],
            ['kode' => 'A90', 'nama_penyakit_indonesia' => 'Demam Berdarah Dengue', 'nama_penyakit_inggris' => 'Dengue Haemorrhagic Fever', 'kategori' => 'Penyakit Infeksi'],
            ['kode' => 'A91', 'nama_penyakit_indonesia' => 'Demam Dengue', 'nama_penyakit_inggris' => 'Dengue Fever', 'kategori' => 'Penyakit Infeksi'],
            ['kode' => 'B34.9', 'nama_penyakit_indonesia' => 'Infeksi Virus Tidak Spesifik', 'nama_penyakit_inggris' => 'Viral Infection Unspecified', 'kategori' => 'Penyakit Infeksi'],
            ['kode' => 'E10', 'nama_penyakit_indonesia' => 'Diabetes Melitus Tipe 1', 'nama_penyakit_inggris' => 'Type 1 Diabetes Mellitus', 'kategori' => 'Penyakit Metabolik'],
            ['kode' => 'E11', 'nama_penyakit_indonesia' => 'Diabetes Melitus Tipe 2', 'nama_penyakit_inggris' => 'Type 2 Diabetes Mellitus', 'kategori' => 'Penyakit Metabolik'],
            ['kode' => 'E78', 'nama_penyakit_indonesia' => 'Dislipidemia / Kolesterol Tinggi', 'nama_penyakit_inggris' => 'Disorders of Lipoprotein Metabolism', 'kategori' => 'Penyakit Metabolik'],
            ['kode' => 'E66', 'nama_penyakit_indonesia' => 'Obesitas', 'nama_penyakit_inggris' => 'Obesity', 'kategori' => 'Penyakit Metabolik'],
            ['kode' => 'I10', 'nama_penyakit_indonesia' => 'Hipertensi Esensial (Primer)', 'nama_penyakit_inggris' => 'Essential (Primary) Hypertension', 'kategori' => 'Penyakit Kardiovaskular'],
            ['kode' => 'I20', 'nama_penyakit_indonesia' => 'Angina Pektoris', 'nama_penyakit_inggris' => 'Angina Pectoris', 'kategori' => 'Penyakit Kardiovaskular'],
            ['kode' => 'I21', 'nama_penyakit_indonesia' => 'Infark Miokard Akut', 'nama_penyakit_inggris' => 'Acute Myocardial Infarction', 'kategori' => 'Penyakit Kardiovaskular'],
            ['kode' => 'I50', 'nama_penyakit_indonesia' => 'Gagal Jantung', 'nama_penyakit_inggris' => 'Heart Failure', 'kategori' => 'Penyakit Kardiovaskular'],
            ['kode' => 'J00', 'nama_penyakit_indonesia' => 'Nasofaringitis Akut (Pilek)', 'nama_penyakit_inggris' => 'Acute Nasopharyngitis (Common Cold)', 'kategori' => 'Penyakit Pernapasan'],
            ['kode' => 'J06', 'nama_penyakit_indonesia' => 'Infeksi Saluran Napas Atas Akut', 'nama_penyakit_inggris' => 'Acute Upper Respiratory Infections', 'kategori' => 'Penyakit Pernapasan'],
            ['kode' => 'J18', 'nama_penyakit_indonesia' => 'Pneumonia', 'nama_penyakit_inggris' => 'Pneumonia', 'kategori' => 'Penyakit Pernapasan'],
            ['kode' => 'J45', 'nama_penyakit_indonesia' => 'Asma', 'nama_penyakit_inggris' => 'Asthma', 'kategori' => 'Penyakit Pernapasan'],
            ['kode' => 'J20', 'nama_penyakit_indonesia' => 'Bronkitis Akut', 'nama_penyakit_inggris' => 'Acute Bronchitis', 'kategori' => 'Penyakit Pernapasan'],
            ['kode' => 'K21', 'nama_penyakit_indonesia' => 'Penyakit Refluks Gastroesofageal', 'nama_penyakit_inggris' => 'Gastro-Oesophageal Reflux Disease', 'kategori' => 'Penyakit Pencernaan'],
            ['kode' => 'K25', 'nama_penyakit_indonesia' => 'Ulkus Gaster (Tukak Lambung)', 'nama_penyakit_inggris' => 'Gastric Ulcer', 'kategori' => 'Penyakit Pencernaan'],
            ['kode' => 'K29', 'nama_penyakit_indonesia' => 'Gastritis dan Duodenitis', 'nama_penyakit_inggris' => 'Gastritis and Duodenitis', 'kategori' => 'Penyakit Pencernaan'],
            ['kode' => 'K35', 'nama_penyakit_indonesia' => 'Apendisitis Akut', 'nama_penyakit_inggris' => 'Acute Appendicitis', 'kategori' => 'Penyakit Pencernaan'],
            ['kode' => 'K80', 'nama_penyakit_indonesia' => 'Kolelitiasis (Batu Empedu)', 'nama_penyakit_inggris' => 'Cholelithiasis', 'kategori' => 'Penyakit Pencernaan'],
            ['kode' => 'G43', 'nama_penyakit_indonesia' => 'Migrain', 'nama_penyakit_inggris' => 'Migraine', 'kategori' => 'Penyakit Saraf'],
            ['kode' => 'G47', 'nama_penyakit_indonesia' => 'Gangguan Tidur (Insomnia)', 'nama_penyakit_inggris' => 'Sleep Disorders', 'kategori' => 'Penyakit Saraf'],
            ['kode' => 'I63', 'nama_penyakit_indonesia' => 'Infark Serebral (Stroke Iskemik)', 'nama_penyakit_inggris' => 'Cerebral Infarction', 'kategori' => 'Penyakit Saraf'],
            ['kode' => 'I64', 'nama_penyakit_indonesia' => 'Stroke Tidak Spesifik', 'nama_penyakit_inggris' => 'Stroke Not Specified', 'kategori' => 'Penyakit Saraf'],
            ['kode' => 'M06', 'nama_penyakit_indonesia' => 'Artritis Reumatoid', 'nama_penyakit_inggris' => 'Rheumatoid Arthritis', 'kategori' => 'Muskuloskeletal'],
            ['kode' => 'M10', 'nama_penyakit_indonesia' => 'Gout (Asam Urat)', 'nama_penyakit_inggris' => 'Gout', 'kategori' => 'Muskuloskeletal'],
            ['kode' => 'M54', 'nama_penyakit_indonesia' => 'Nyeri Punggung Bawah (LBP)', 'nama_penyakit_inggris' => 'Dorsalgia (Low Back Pain)', 'kategori' => 'Muskuloskeletal'],
            ['kode' => 'M79', 'nama_penyakit_indonesia' => 'Mialgia (Nyeri Otot)', 'nama_penyakit_inggris' => 'Myalgia', 'kategori' => 'Muskuloskeletal'],
            ['kode' => 'L20', 'nama_penyakit_indonesia' => 'Dermatitis Atopik', 'nama_penyakit_inggris' => 'Atopic Dermatitis', 'kategori' => 'Penyakit Kulit'],
            ['kode' => 'L50', 'nama_penyakit_indonesia' => 'Urtikaria (Biduran)', 'nama_penyakit_inggris' => 'Urticaria', 'kategori' => 'Penyakit Kulit'],
            ['kode' => 'S00', 'nama_penyakit_indonesia' => 'Cedera Superfisial Kepala', 'nama_penyakit_inggris' => 'Superficial Injury of Head', 'kategori' => 'Cedera'],
            ['kode' => 'T14', 'nama_penyakit_indonesia' => 'Luka pada Bagian Tubuh Tidak Spesifik', 'nama_penyakit_inggris' => 'Injury of Unspecified Body Region', 'kategori' => 'Cedera'],
            ['kode' => 'O14', 'nama_penyakit_indonesia' => 'Preeklamsia', 'nama_penyakit_inggris' => 'Pre-Eclampsia', 'kategori' => 'Kehamilan'],
            ['kode' => 'O80', 'nama_penyakit_indonesia' => 'Persalinan Normal', 'nama_penyakit_inggris' => 'Single Spontaneous Delivery', 'kategori' => 'Kehamilan'],
        ];

        foreach ($icd10s as $icd10) {
            DB::table('icd10_masters')->updateOrInsert(['kode' => $icd10['kode']], array_merge($icd10, [
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }

        $this->command->info('✅ Icd10Seeder: ' . count($icd10s) . ' kode ICD-10 berhasil dibuat.');
    }
}
