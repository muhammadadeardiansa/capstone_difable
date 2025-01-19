<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Subject;
use App\Models\Question;

class QuestionSeeder extends Seeder
{
    public function run()
    {
        // Daftar mata pelajaran dan file JSON terkait
        $subjects = [
            ['name' => 'Bahasa Indonesia', 'tts_voice' => 'id-ID-Wavenet-A', 'file' => 'indo.json'],
            ['name' => 'Matematika', 'tts_voice' => 'id-ID-Wavenet-B', 'file' => 'matematika.json'],
            ['name' => 'Lingkungan & Hewan', 'tts_voice' => 'id-ID-Wavenet-C', 'file' => 'lingkungan_hewan.json'],
        ];

        foreach ($subjects as $subjectData) {
            // Cek apakah subject sudah ada, jika belum maka buat
            $subject = Subject::firstOrCreate(
                ['name' => $subjectData['name']], // Kriteria pencarian
                ['tts_voice' => $subjectData['tts_voice']] // Data tambahan jika tidak ditemukan
            );

            // Load file JSON
            $filePath = database_path('seeders/data/' . $subjectData['file']);
            if (!file_exists($filePath)) {
                echo "File JSON tidak ditemukan: {$filePath}\n";
                continue;
            }

            $questions = json_decode(file_get_contents($filePath), true)['questions'];

            // Tambahkan pertanyaan tanpa duplikasi
            foreach ($questions as $q) {
                Question::firstOrCreate(
                    [
                        'subject_id' => $subject->id,
                        'question' => $q['question'], // Kriteria pencarian
                    ],
                    [
                        'options' => $q['options'], // Simpan langsung sebagai array (Eloquent akan menangani konversi)
                        'answer' => trim($q['answer']), // Hapus spasi tambahan
                    ]
                );
            }
            
        }
    }
}
