<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Plant;
use Illuminate\Support\Facades\DB;

class PlantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $plants = [
            [
                'name' => 'Belimbing Botol',
                'local_name' => 'Belimbing Wuluh',
                'scientific_name' => 'Averrhoa bilimbi',
                'description' => 'Belimbing botol atau belimbing wuluh adalah tanaman buah kecil yang tumbuh di daerah tropis. Buahnya berbentuk lonjong seperti botol dengan rasa yang sangat asam.',
                'characteristics' => 'Pohon kecil dengan tinggi 5-10 meter. Buah berwarna hijau terang hingga kekuningan saat matang, berukuran 4-10 cm. Daun majemuk bersirip dengan anak daun berjumlah 11-37 helai.',
                'benefits' => 'Menurunkan tekanan darah tinggi, mengobati batuk, menurunkan demam, mengatasi diabetes, mengobati sariawan, antiseptik alami, menurunkan kolesterol, dan mengobati jerawat.',
                'usage_notes' => 'Dapat dikonsumsi langsung atau dijus. Untuk obat luar, buah dapat ditumbuk dan dioleskan. Hindari konsumsi berlebihan karena sangat asam. Tidak disarankan untuk penderita maag.',
                'is_active' => true,
            ],
            [
                'name' => 'Brotowali',
                'local_name' => 'Bratawali, Antawali',
                'scientific_name' => 'Tinospora crispa',
                'description' => 'Brotowali adalah tanaman merambat yang banyak tumbuh di hutan atau pekarangan. Batangnya yang pahit telah lama digunakan sebagai obat tradisional.',
                'characteristics' => 'Tanaman merambat dengan batang beralur dan berwarna hijau keabu-abuan. Daun berbentuk jantung atau bulat telur dengan ujung runcing. Bunga kecil berwarna kuning kehijauan.',
                'benefits' => 'Menurunkan kadar gula darah, mengobati demam, meningkatkan daya tahan tubuh, mengatasi rematik, mengobati sakit kuning, antioksidan, dan membantu detoksifikasi tubuh.',
                'usage_notes' => 'Batang direbus dan diminum airnya. Rasanya sangat pahit sehingga bisa ditambahkan madu. Dosis: 10-15 gram batang kering direbus dengan 3-4 gelas air hingga tersisa 1 gelas. Tidak untuk ibu hamil dan menyusui.',
                'is_active' => true,
            ],
            [
                'name' => 'Cocor Bebek',
                'local_name' => 'Sosor Bebek, Daun Sejuk',
                'scientific_name' => 'Kalanchoe pinnata',
                'description' => 'Cocor bebek adalah tanaman sukulen yang mudah tumbuh dan berkembang biak. Daunnya tebal, berair, dan memiliki kemampuan menumbuhkan tunas baru di tepi daun.',
                'characteristics' => 'Tanaman tegak dengan tinggi 50-150 cm. Daun tebal, berdaging, berwarna hijau dengan tepi bergerigi. Di tepi daun tumbuh tunas-tunas kecil yang mudah jatuh dan tumbuh menjadi tanaman baru.',
                'benefits' => 'Mengobati luka dan bisul, menurunkan tekanan darah tinggi, mengobati batu ginjal, mengatasi infeksi saluran kemih, antiinflamasi, mengobati sakit kepala, dan meredakan batuk.',
                'usage_notes' => 'Untuk obat luar: daun ditumbuk dan ditempelkan pada luka. Untuk obat dalam: 2-3 lembar daun direbus atau dimakan mentah. Dapat juga dijus dengan tambahan madu. Aman digunakan jangka pendek.',
                'is_active' => true,
            ],
            [
                'name' => 'Daun Panya',
                'local_name' => 'Panja, Tanaman Insulin',
                'scientific_name' => 'Costus speciosus',
                'description' => 'Daun panya atau tanaman insulin adalah tanaman herbal yang terkenal efektif untuk mengatasi diabetes. Tanaman ini memiliki daun spiral yang khas.',
                'characteristics' => 'Tanaman tegak dengan tinggi 1-2 meter. Daun tunggal, tersusun spiral mengelilingi batang, berbentuk lonjong dengan ujung runcing. Bunga berwarna putih atau merah muda dengan braktea merah.',
                'benefits' => 'Menurunkan kadar gula darah, meningkatkan sensitivitas insulin, mengobati diabetes tipe 2, antiinflamasi, menurunkan kolesterol, melindungi fungsi ginjal, dan antioksidan.',
                'usage_notes' => 'Daun segar dapat dimakan langsung (2-3 lembar sehari) atau direbus. Untuk teh: 5-7 lembar daun direbus dengan 2 gelas air hingga tersisa 1 gelas. Minum 2 kali sehari. Konsultasi dokter jika sedang minum obat diabetes.',
                'is_active' => true,
            ],
            [
                'name' => 'Daun Sirih',
                'local_name' => 'Sirih Hijau',
                'scientific_name' => 'Piper betle',
                'description' => 'Daun sirih adalah tanaman merambat yang telah lama digunakan dalam pengobatan tradisional Indonesia. Daunnya mengandung minyak atsiri yang bersifat antiseptik.',
                'characteristics' => 'Tanaman merambat dengan sulur yang dapat mencapai beberapa meter. Daun tunggal, berbentuk jantung, berwarna hijau dengan permukaan mengkilap, berukuran 5-15 cm. Aroma khas yang menyengat.',
                'benefits' => 'Antiseptik dan antibakteri, mengobati keputihan, mengatasi bau mulut dan bau badan, menyembuhkan luka, mengobati batuk, menghentikan mimisan, mengatasi gatal-gatal, dan melancarkan pencernaan.',
                'usage_notes' => 'Untuk obat luar: daun diremas atau direbus airnya untuk mencuci. Untuk obat dalam: 3-5 lembar daun direbus dan diminum. Untuk keputihan: rebus 10 lembar daun untuk cebok. Hindari penggunaan berlebihan.',
                'is_active' => true,
            ],
            [
                'name' => 'Jahe',
                'local_name' => 'Jahe Merah',
                'scientific_name' => 'Zingiber officinale',
                'description' => 'Jahe adalah tanaman rimpang yang sangat populer sebagai rempah-rempah dan bahan obat tradisional. Memiliki rasa pedas dan hangat yang khas.',
                'characteristics' => 'Tanaman herba dengan tinggi 30-100 cm, memiliki rimpang yang tebal dan berdaging, batang semu berwarna hijau, daun tunggal berbentuk lanset.',
                'benefits' => 'Menghangatkan badan, mengatasi masuk angin, meredakan mual, meningkatkan sistem imun, antiinflamasi, membantu pencernaan.',
                'usage_notes' => 'Dapat dikonsumsi dalam bentuk wedang jahe, direbus, atau ditambahkan dalam masakan. Hindari konsumsi berlebihan pada penderita maag.',
                'is_active' => true,
            ],
            [
                'name' => 'Jambu Biji',
                'local_name' => 'Jambu Klutuk',
                'scientific_name' => 'Psidium guajava',
                'description' => 'Jambu biji adalah tanaman buah tropis yang daunnya memiliki khasiat obat. Buah dan daunnya sama-sama bermanfaat untuk kesehatan.',
                'characteristics' => 'Pohon kecil setinggi 3-10 meter. Daun tunggal berbentuk lonjong dengan tulang daun menyirip, permukaan kasar. Buah bulat atau oval berwarna hijau hingga kuning saat matang.',
                'benefits' => 'Mengatasi diare, meningkatkan trombosit pada demam berdarah, menurunkan kadar gula darah, meningkatkan kesehatan jantung, antioksidan tinggi, menjaga kesehatan kulit.',
                'usage_notes' => 'Daun muda direbus untuk diminum air rebusannya. Untuk diare: rebus 5-7 lembar daun. Buah dapat dikonsumsi langsung. Aman untuk konsumsi rutin.',
                'is_active' => true,
            ],
            [
                'name' => 'Kunyit',
                'local_name' => 'Kunir',
                'scientific_name' => 'Curcuma longa',
                'description' => 'Kunyit adalah tanaman obat berupa tumbuhan rimpang yang termasuk dalam suku temu-temuan. Rimpangnya berwarna kuning cerah dan memiliki banyak khasiat.',
                'characteristics' => 'Tinggi sekitar 40-100 cm, memiliki rimpang berwarna jingga kekuningan, daun lebar berbentuk lanset memanjang dengan panjang 20-40 cm.',
                'benefits' => 'Antioksidan kuat, antiinflamasi, meningkatkan fungsi liver, membantu pencernaan, menjaga kesehatan kulit, meningkatkan daya tahan tubuh.',
                'usage_notes' => 'Dapat dibuat jamu, direbus menjadi minuman, atau diparut untuk campuran masakan. Aman dikonsumsi rutin dalam dosis wajar.',
                'is_active' => true,
            ],
            [
                'name' => 'Lidah Buaya',
                'local_name' => 'Aloe Vera',
                'scientific_name' => 'Aloe vera',
                'description' => 'Lidah buaya adalah tanaman sukulen dengan daging daun yang berisi gel bening. Sangat populer untuk kesehatan kulit dan pencernaan.',
                'characteristics' => 'Tinggi 60-100 cm, daun tebal berdaging dengan tepi bergerigi, warna hijau keabu-abuan, gel transparan di dalam daun.',
                'benefits' => 'Melembabkan kulit, menyembuhkan luka, melancarkan pencernaan, detoksifikasi, menurunkan gula darah, antiinflamasi.',
                'usage_notes' => 'Gel dapat dikonsumsi langsung atau dibuat jus. Untuk pemakaian luar, oleskan gel pada kulit. Hindari konsumsi lateks kuning.',
                'is_active' => true,
            ],
            [
                'name' => 'Mayana',
                'local_name' => 'Jawer Kotok, Iler',
                'scientific_name' => 'Coleus scutellarioides',
                'description' => 'Mayana adalah tanaman hias yang juga memiliki khasiat obat. Daunnya yang berwarna-warni mengandung senyawa aktif untuk kesehatan.',
                'characteristics' => 'Tinggi 30-60 cm, batang bersegi empat. Daun beraneka warna dari hijau, merah, ungu, hingga kombinasi warna-warni. Tepi daun bergerigi, permukaan sedikit berbulu.',
                'benefits' => 'Mengobati wasir (ambeien), mengatasi bisul dan luka, meredakan batuk, menurunkan demam, antiinflamasi, mengobati infeksi kulit, dan meredakan nyeri.',
                'usage_notes' => 'Untuk wasir: daun ditumbuk dan dioleskan atau direbus untuk diminum. Untuk luka luar: daun segar ditumbuk dan ditempelkan. 5-7 lembar daun direbus untuk obat dalam. Penggunaan luar umumnya aman.',
                'is_active' => true,
            ],
            [
                'name' => 'Pepaya',
                'local_name' => 'Gedang, Kates',
                'scientific_name' => 'Carica papaya',
                'description' => 'Pepaya adalah tanaman buah tropis dengan daun yang memiliki khasiat obat luar biasa. Daunnya mengandung enzim papain yang berguna untuk kesehatan.',
                'characteristics' => 'Pohon dengan tinggi 2-10 meter, batang berongga. Daun besar menjari dengan 7-9 cuping, bertangkai panjang, warna hijau tua, mengandung getah putih ketika dipetik.',
                'benefits' => 'Meningkatkan trombosit pada demam berdarah, melancarkan pencernaan, menurunkan kolesterol, meningkatkan nafsu makan, antimalaria, detoksifikasi, dan antioksidan.',
                'usage_notes' => 'Direbus 2-3 lembar daun untuk diminum air rebusannya. Rasa pahit dapat dikurangi dengan menambahkan madu atau gula. Untuk DBD: minum 2-3 kali sehari.',
                'is_active' => true,
            ],
            [
                'name' => 'Pohon Jarak',
                'local_name' => 'Jarak Pagar',
                'scientific_name' => 'Jatropha curcas',
                'description' => 'Pohon jarak adalah tanaman yang banyak tumbuh sebagai pagar hidup. Getah dan daunnya memiliki khasiat obat, namun bijinya beracun jika tertelan.',
                'characteristics' => 'Perdu dengan tinggi 2-5 meter. Daun lebar berbentuk seperti telapak tangan dengan 3-5 cuping. Bunga kecil berwarna kuning kehijauan. Buah berbentuk bulat berisi 2-3 biji hitam.',
                'benefits' => 'Mengobati luka dan bisul, mengatasi eksim dan penyakit kulit, meredakan rematik, obat pencahar (dengan dosis sangat kecil), mengatasi gatal-gatal, dan antiinflamasi.',
                'usage_notes' => 'HANYA untuk pemakaian luar: daun ditumbuk untuk ditempelkan pada luka atau bisul. Getah dapat dioleskan pada luka. JANGAN dikonsumsi karena beracun. Hindari konsumsi biji. Jauhkan dari anak-anak.',
                'is_active' => true,
            ],
            [
                'name' => 'Sambiloto',
                'local_name' => 'Ki Pait, Bidara',
                'scientific_name' => 'Andrographis paniculata',
                'description' => 'Sambiloto adalah tanaman herba yang terkenal dengan rasa pahitnya. Sangat efektif untuk meningkatkan daya tahan tubuh dan mengatasi berbagai penyakit.',
                'characteristics' => 'Tinggi 30-70 cm, batang berbentuk segi empat, daun tunggal berbentuk lanset dengan panjang 5-8 cm, bunga kecil berwarna putih keunguan.',
                'benefits' => 'Meningkatkan imunitas, menurunkan demam, antibakteri, antivirus, mengatasi diabetes, detoksifikasi tubuh, meredakan diare, dan antiinflamasi.',
                'usage_notes' => 'Dapat direbus daunnya atau dikonsumsi dalam bentuk kapsul ekstrak. Rasa sangat pahit, bisa ditambahkan madu. Dosis: 5-7 lembar daun direbus. Hindari konsumsi jangka panjang tanpa pengawasan.',
                'is_active' => true,
            ],
        ];

        DB::beginTransaction();
        try {
            foreach ($plants as $plant) {
                Plant::create($plant);
            }
            DB::commit();
            
            $this->command->info('Plants seeded successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            $this->command->error('Failed to seed plants: ' . $e->getMessage());
        }
    }
}
