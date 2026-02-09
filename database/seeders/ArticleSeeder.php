<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Article;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $articles = [
            [
                'title' => 'Warga Bantul Olah Bunga Telang Bernilai Ratusan Ribu',
                'excerpt' => 'Dianggap tanaman liar, warga Bantul berhasil mengubah bunga telang menjadi produk bernilai tinggi.',
                'image' => 'https://images.unsplash.com/photo-1545241047-6083a3684587?auto=format&fit=crop&q=80&w=600',
                'url' => 'https://jogja.suara.com/read/2020/10/01/071442/dianggap-tanaman-liar-warga-bantul-olah-bunga-telang-bernilai-ratusan-ribu',
                'views' => 1200,
                'published_at' => '2020-10-01',
                'category' => 'Produk & UMKM'
            ],
            [
                'title' => "Usai Di-PHK, Pria Ini 'Sulap' Bunga Telang Jadi Sabun",
                'excerpt' => 'Kena PHK pandemi tidak membuat Danang putus asa. Ia mengolah bunga telang jadi teh dan sabun.',
                'image' => 'https://images.unsplash.com/photo-1512413316925-fd4b93f31521?auto=format&fit=crop&q=80&w=600',
                'url' => 'https://finance.detik.com/solusiukm/d-5195744/usai-di-phk-pria-ini-sulap-bunga-telang-jadi-sabun-hingga-teh',
                'views' => 2500,
                'published_at' => '2020-09-30',
                'category' => 'Kisah Komunitas'
            ],
            [
                'title' => 'Sekilo Bunga Telang Dihargai Rp500 Ribu',
                'excerpt' => 'Permintaan bunga telang kering semakin meningkat hingga mencapai pasar internasional.',
                'image' => 'https://images.unsplash.com/photo-1594631252845-29fc458681b3?auto=format&fit=crop&q=80&w=600',
                'url' => 'https://jogja.idntimes.com/business/economy/daruwaskita/sekilo-bunga-telang-dihargai-rp500-ribu-diminati-hingga-bangladesh',
                'views' => 3100,
                'published_at' => '2020-10-02',
                'category' => 'Produk & UMKM'
            ]
        ];

        foreach ($articles as $article) {
            Article::create($article);
        }
    }
}
