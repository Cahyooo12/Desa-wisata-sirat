<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Event;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Data from DataContext.tsx
        $events = [
            [
                'title' => "Opening Ceremony Festival",
                'description' => "Pembukaan festival dengan arak-arakan budaya dan tarian tradisional penyambutan panen.",
                'date' => '2026-10-01', // "1 Okt"
                'time' => "08:00 - 12:00 WIB",
                'location' => "Alun-Alun Desa"
            ],
            [
                'title' => "Workshop Olahan Bunga Telang",
                'description' => "Belajar membuat pewarna alami, teh, dan kue tradisional berbahan dasar bunga telang.",
                'date' => '2026-10-05', // "5 Okt"
                'time' => "09:00 - 14:00 WIB",
                'location' => "Pendopo Agrowisata"
            ],
            [
                'title' => "Bazar Rakyat & Kuliner Desa",
                'description' => "Nikmati jajanan pasar, kerajinan tangan, dan hasil bumi langsung dari petani lokal.",
                'date' => '2026-10-12', // "12 Okt"
                'time' => "10:00 - 20:00 WIB",
                'location' => "Sepanjang Jalan Utama"
            ],
            [
                'title' => "Lomba Fotografi & Konten Kreatif",
                'description' => "Abadikan keindahan desa dan menangkan hadiah menarik. Terbuka untuk umum!",
                'date' => '2026-10-20', // "20 Okt"
                'time' => "07:00 - 16:00 WIB",
                'location' => "Spot Wisata Bunga Telang"
            ],
            [
                'title' => "Malam Puncak & Pagelaran Wayang",
                'description' => "Penutupan festival dengan pertunjukan wayang kulit semalam suntuk dan kembang api.",
                'date' => '2026-10-28', // "28 Okt"
                'time' => "19:00 - Selesai",
                'location' => "Alun-Alun Desa"
            ]
        ];

        foreach ($events as $event) {
            Event::create($event);
        }
    }
}
