<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function benefits()
    {
        $benefits = [
            [
                'id' => 'b1',
                'title' => 'Kesehatan Otak',
                'description' => 'Mengandung antioksidan flavonoid yang memperbaiki sel saraf dan meningkatkan daya ingat.',
                'icon' => 'psychology',
                'color' => 'bg-indigo-100 text-indigo-600'
            ],
            [
                'id' => 'b2',
                'title' => 'Memperbaiki Mood',
                'description' => 'Efek penghilang stres yang membantu mengurangi gejala kecemasan dan depresi ringan.',
                'icon' => 'sentiment_satisfied',
                'color' => 'bg-purple-100 text-purple-600'
            ],
            [
                'id' => 'b3',
                'title' => 'Anti-Inflamasi',
                'description' => 'Mengandung asam oleat tinggi untuk mengurangi peradangan dan infeksi pada tubuh.',
                'icon' => 'healing',
                'color' => 'bg-green-100 text-green-600'
            ],
            [
                'id' => 'b4',
                'title' => 'Mencegah Rambut Rontok',
                'description' => 'Bioflavonoid meningkatkan sirkulasi darah di kulit kepala untuk menyehatkan folikel rambut.',
                'icon' => 'science',
                'color' => 'bg-pink-100 text-pink-600'
            ],
            [
                'id' => 'b5',
                'title' => 'Diabetes & Hipertensi',
                'description' => 'Membantu stimulasi pelepasan insulin dan mengurangi kekakuan arteri untuk tekanan darah.',
                'icon' => 'monitor_heart',
                'color' => 'bg-red-100 text-red-600'
            ]
        ];

        return view('benefits', compact('benefits'));
    }

    public function about()
    {
        return view('about');
    }
}
