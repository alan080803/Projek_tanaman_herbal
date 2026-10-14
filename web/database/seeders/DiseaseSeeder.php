<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Disease;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DiseaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Seeds 20 common diseases as per requirements.
     */
    public function run(): void
    {
        $diseases = [
            [
                'name' => 'Batuk',
                'slug' => 'batuk',
                'description' => 'Batuk adalah respons alami tubuh untuk membersihkan saluran pernapasan dari lendir, iritan, atau benda asing.',
                'symptoms' => 'Tenggorokan gatal, dahak, nyeri dada, sesak napas, suara serak',
                'causes' => 'Infeksi virus, alergi, asap rokok, polusi udara, GERD',
                'prevention' => 'Hindari asap rokok, jaga kebersihan tangan, konsumsi makanan bergizi, minum air cukup',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'Flu dan Pilek',
                'slug' => 'flu-dan-pilek',
                'description' => 'Infeksi virus pada saluran pernapasan atas yang sangat umum terjadi, ditandai dengan hidung tersumbat dan bersin.',
                'symptoms' => 'Hidung tersumbat, bersin, demam ringan, sakit kepala, lemas, sakit tenggorokan',
                'causes' => 'Virus influenza atau rhinovirus yang menular melalui udara atau kontak langsung',
                'prevention' => 'Cuci tangan rutin, hindari kontak dengan penderita, istirahat cukup, konsumsi vitamin C',
                'order' => 2,
                'is_active' => true,
            ],
            [
                'name' => 'Demam',
                'slug' => 'demam',
                'description' => 'Peningkatan suhu tubuh di atas normal (>37.5°C) sebagai respons sistem kekebalan tubuh melawan infeksi.',
                'symptoms' => 'Suhu tubuh tinggi, menggigil, berkeringat, sakit kepala, nyeri otot, lemas',
                'causes' => 'Infeksi bakteri atau virus, peradangan, efek samping obat, dehidrasi',
                'prevention' => 'Jaga kebersihan, hindari kontak dengan penderita, istirahat cukup, minum air yang cukup',
                'order' => 3,
                'is_active' => true,
            ],
            [
                'name' => 'Masuk Angin',
                'slug' => 'masuk-angin',
                'description' => 'Kondisi tidak nyaman yang ditandai dengan perut kembung, mual, dan tubuh terasa tidak enak, umum terjadi di Indonesia.',
                'symptoms' => 'Perut kembung, mual, pusing, badan pegal, meriang, perut terasa penuh gas',
                'causes' => 'Cuaca dingin, kelelahan, pola makan tidak teratur, kurang tidur, stress',
                'prevention' => 'Hindari terlalu lama di ruangan ber-AC, makan teratur, istirahat cukup, konsumsi minuman hangat',
                'order' => 4,
                'is_active' => true,
            ],
            [
                'name' => 'Sakit Maag',
                'slug' => 'sakit-maag',
                'description' => 'Gangguan pencernaan yang menyebabkan rasa tidak nyaman atau nyeri pada perut bagian atas.',
                'symptoms' => 'Nyeri ulu hati, mual, kembung, sendawa berlebihan, perut terasa panas',
                'causes' => 'Asam lambung berlebih, pola makan tidak teratur, stress, infeksi bakteri H. pylori',
                'prevention' => 'Makan teratur, hindari makanan pedas dan asam, kelola stress, hindari kafein berlebih',
                'order' => 5,
                'is_active' => true,
            ],
            [
                'name' => 'Diare',
                'slug' => 'diare',
                'description' => 'Kondisi buang air besar dengan tinja encer lebih dari 3 kali sehari, bisa menyebabkan dehidrasi.',
                'symptoms' => 'Tinja encer, kram perut, mual, demam ringan, lemas, dehidrasi',
                'causes' => 'Infeksi bakteri, virus, atau parasit, keracunan makanan, intoleransi makanan',
                'prevention' => 'Jaga kebersihan makanan, cuci tangan sebelum makan, hindari air mentah, masak makanan hingga matang',
                'order' => 6,
                'is_active' => true,
            ],
            [
                'name' => 'Hipertensi',
                'slug' => 'hipertensi',
                'description' => 'Tekanan darah tinggi yang persisten (≥140/90 mmHg), faktor risiko penyakit jantung dan stroke.',
                'symptoms' => 'Sakit kepala, pusing, penglihatan kabur, sesak napas, nyeri dada (pada kasus berat)',
                'causes' => 'Obesitas, kurang olahraga, konsumsi garam berlebih, stress, genetik, usia',
                'prevention' => 'Kurangi garam, olahraga teratur, jaga berat badan ideal, hindari stress, batasi alkohol',
                'order' => 7,
                'is_active' => true,
            ],
            [
                'name' => 'Diabetes',
                'slug' => 'diabetes',
                'description' => 'Penyakit metabolik kronis dengan kadar gula darah tinggi akibat gangguan produksi atau fungsi insulin.',
                'symptoms' => 'Sering haus, sering buang air kecil, cepat lapar, berat badan turun, luka sulit sembuh',
                'causes' => 'Faktor genetik, obesitas, kurang aktivitas fisik, pola makan tidak sehat, usia',
                'prevention' => 'Jaga berat badan ideal, olahraga rutin, diet seimbang, kurangi gula, cek gula darah berkala',
                'order' => 8,
                'is_active' => true,
            ],
            [
                'name' => 'Kolesterol Tinggi',
                'slug' => 'kolesterol-tinggi',
                'description' => 'Kondisi kadar kolesterol dalam darah melebihi batas normal, meningkatkan risiko penyakit jantung.',
                'symptoms' => 'Umumnya tanpa gejala, bisa muncul xanthelasma (benjolan kuning di kelopak mata), nyeri dada',
                'causes' => 'Diet tinggi lemak jenuh, obesitas, kurang olahraga, merokok, genetik',
                'prevention' => 'Diet rendah lemak jenuh, olahraga teratur, hindari makanan gorengan, konsumsi serat tinggi',
                'order' => 9,
                'is_active' => true,
            ],
            [
                'name' => 'Asam Urat',
                'slug' => 'asam-urat',
                'description' => 'Penumpukan kristal asam urat di persendian yang menyebabkan peradangan dan nyeri hebat.',
                'symptoms' => 'Nyeri sendi mendadak (terutama jempol kaki), bengkak, kemerahan, terasa panas, sulit bergerak',
                'causes' => 'Konsumsi purin tinggi, obesitas, genetik, dehidrasi, konsumsi alkohol berlebih',
                'prevention' => 'Batasi makanan tinggi purin, minum air cukup, jaga berat badan, hindari alkohol, olahraga teratur',
                'order' => 10,
                'is_active' => true,
            ],
            [
                'name' => 'Anemia',
                'slug' => 'anemia',
                'description' => 'Kondisi kekurangan sel darah merah atau hemoglobin yang membawa oksigen ke seluruh tubuh.',
                'symptoms' => 'Lemas, pucat, pusing, sesak napas, jantung berdebar, tangan dan kaki dingin',
                'causes' => 'Kekurangan zat besi, vitamin B12, asam folat, pendarahan, penyakit kronis',
                'prevention' => 'Konsumsi makanan kaya zat besi, vitamin C untuk penyerapan zat besi, suplemen jika perlu',
                'order' => 11,
                'is_active' => true,
            ],
            [
                'name' => 'Insomnia',
                'slug' => 'insomnia',
                'description' => 'Gangguan tidur yang menyebabkan kesulitan untuk tidur, tetap tidur, atau bangun terlalu pagi.',
                'symptoms' => 'Sulit tidur, sering terbangun malam hari, bangun terlalu pagi, lelah saat bangun, sulit konsentrasi',
                'causes' => 'Stress, kecemasan, depresi, pola tidur buruk, konsumsi kafein berlebih, gangguan kesehatan',
                'prevention' => 'Rutinitas tidur teratur, hindari kafein sore hari, relaksasi sebelum tidur, olahraga teratur',
                'order' => 12,
                'is_active' => true,
            ],
            [
                'name' => 'Sakit Kepala',
                'slug' => 'sakit-kepala',
                'description' => 'Rasa nyeri atau tidak nyaman di area kepala atau leher, bisa ringan hingga berat.',
                'symptoms' => 'Nyeri berdenyut atau tekanan di kepala, sensitif terhadap cahaya, mual, pusing',
                'causes' => 'Tegang otot, stress, dehidrasi, kurang tidur, mata lelah, migrain',
                'prevention' => 'Istirahat cukup, minum air yang cukup, kelola stress, hindari pemicu migrain, postur tubuh baik',
                'order' => 13,
                'is_active' => true,
            ],
            [
                'name' => 'Radang Tenggorokan',
                'slug' => 'radang-tenggorokan',
                'description' => 'Peradangan pada tenggorokan yang menyebabkan rasa sakit, terutama saat menelan.',
                'symptoms' => 'Nyeri tenggorokan, sulit menelan, tenggorokan merah, demam, suara serak, batuk',
                'causes' => 'Infeksi virus atau bakteri, iritasi akibat asap atau polusi, alergi, GERD',
                'prevention' => 'Jaga kebersihan tangan, hindari berbagi peralatan makan, hindari asap rokok, minum air hangat',
                'order' => 14,
                'is_active' => true,
            ],
            [
                'name' => 'Wasir (Hemoroid)',
                'slug' => 'wasir-hemoroid',
                'description' => 'Pembengkakan pembuluh darah di area anus atau rektum bawah yang menyebabkan nyeri dan pendarahan.',
                'symptoms' => 'Benjolan di anus, gatal, nyeri saat BAB, pendarahan saat BAB, rasa tidak nyaman',
                'causes' => 'Sembelit kronis, mengejan saat BAB, duduk terlalu lama, obesitas, kehamilan',
                'prevention' => 'Konsumsi serat tinggi, minum air cukup, hindari mengejan berlebihan, olahraga teratur',
                'order' => 15,
                'is_active' => true,
            ],
            [
                'name' => 'Asma',
                'slug' => 'asma',
                'description' => 'Penyakit kronis saluran pernapasan yang menyebabkan peradangan dan penyempitan saluran udara.',
                'symptoms' => 'Sesak napas, mengi (napas berbunyi), batuk (terutama malam hari), dada terasa sesak',
                'causes' => 'Alergen (debu, serbuk sari), asap rokok, polusi udara, olahraga berlebihan, stress',
                'prevention' => 'Hindari pemicu alergi, jaga kebersihan rumah, hindari asap, olahraga bertahap, kelola stress',
                'order' => 16,
                'is_active' => true,
            ],
            [
                'name' => 'Keputihan',
                'slug' => 'keputihan',
                'description' => 'Keluarnya cairan dari vagina yang bisa normal atau abnormal jika disertai gejala lain.',
                'symptoms' => 'Cairan vagina berlebihan, gatal, bau tidak sedap, warna tidak normal, iritasi',
                'causes' => 'Infeksi jamur, bakteri, parasit, kebersihan kurang, penggunaan produk kimia, stress',
                'prevention' => 'Jaga kebersihan area intim, ganti pakaian dalam rutin, hindari celana ketat, hindari douching',
                'order' => 17,
                'is_active' => true,
            ],
            [
                'name' => 'Jerawat',
                'slug' => 'jerawat',
                'description' => 'Kondisi kulit akibat penyumbatan folikel rambut oleh minyak dan sel kulit mati.',
                'symptoms' => 'Komedo, benjolan merah, pustula berisi nanah, kulit berminyak, bekas luka',
                'causes' => 'Produksi minyak berlebih, bakteri, hormon, stress, makanan tertentu, genetik',
                'prevention' => 'Bersihkan wajah rutin, hindari menyentuh wajah, diet seimbang, kelola stress, tidur cukup',
                'order' => 18,
                'is_active' => true,
            ],
            [
                'name' => 'Rematik',
                'slug' => 'rematik',
                'description' => 'Penyakit autoimun yang menyebabkan peradangan kronis pada sendi dan jaringan sekitarnya.',
                'symptoms' => 'Nyeri sendi, bengkak, kaku (terutama pagi hari), sendi terasa hangat, kelelahan',
                'causes' => 'Autoimun, genetik, hormon, infeksi, usia, obesitas',
                'prevention' => 'Olahraga teratur, jaga berat badan ideal, diet antiinflamasi, hindari merokok, kelola stress',
                'order' => 19,
                'is_active' => true,
            ],
            [
                'name' => 'Vertigo',
                'slug' => 'vertigo',
                'description' => 'Sensasi berputar atau pusing yang membuat penderita merasa dirinya atau lingkungan bergerak.',
                'symptoms' => 'Pusing berputar, mual, muntah, kehilangan keseimbangan, nistagmus (gerakan mata abnormal)',
                'causes' => 'Gangguan telinga dalam, BPPV, penyakit Meniere, migrain, infeksi telinga',
                'prevention' => 'Hindari gerakan kepala mendadak, tidur cukup, hindari stress, hidrasi cukup, kontrol tekanan darah',
                'order' => 20,
                'is_active' => true,
            ],
        ];

        DB::beginTransaction();
        try {
            foreach ($diseases as $disease) {
                Disease::create($disease);
            }
            DB::commit();
            
            $this->command->info('20 Diseases seeded successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            $this->command->error('Failed to seed diseases: ' . $e->getMessage());
        }
    }
}
