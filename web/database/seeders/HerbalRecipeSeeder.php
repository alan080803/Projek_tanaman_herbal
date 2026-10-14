<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Disease;
use App\Models\Plant;
use App\Models\HerbalRecipe;
use App\Models\RecipeIngredient;
use App\Models\RecipeStep;

class HerbalRecipeSeeder extends Seeder
{
    public function run(): void
    {
        DB::beginTransaction();
        try {
            $diseases = Disease::all()->keyBy('slug');
            $plants = Plant::all()->keyBy('name');

            // Recipe 1: Demam - Sambiloto
            if (isset($diseases['demam'])) {
                $recipe1 = HerbalRecipe::create([
                    'disease_id' => $diseases['demam']->id,
                    'name' => 'Rebusan Sambiloto untuk Penurun Demam',
                    'description' => 'Sambiloto mengandung andrographolide yang bersifat antipiretik alami, efektif menurunkan demam',
                    'instructions' => 'Rebusan daun sambiloto untuk menurunkan panas tubuh secara alami',
                    'dosage' => '3 kali sehari, 1/2 gelas setelah makan',
                    'duration' => '2-3 hari',
                    'warnings' => 'Sangat pahit, dapat ditambahkan madu. Tidak untuk ibu hamil dan menyusui',
                    'preparation_time' => '15 menit',
                    'difficulty_level' => 'easy',
                    'servings' => 2,
                    'is_recommended' => true,
                    'is_active' => true,
                ]);

                if (isset($plants['Sambiloto'])) {
                    RecipeIngredient::create([
                        'recipe_id' => $recipe1->id,
                        'plant_id' => $plants['Sambiloto']->id,
                        'quantity' => '7-10',
                        'unit' => 'lembar',
                        'part_used' => 'leaf',
                        'preparation_notes' => 'Daun segar atau kering',
                        'order' => 1,
                    ]);
                }

                RecipeStep::create(['recipe_id' => $recipe1->id, 'step_number' => 1, 'instruction' => 'Cuci bersih 7-10 lembar daun sambiloto']);
                RecipeStep::create(['recipe_id' => $recipe1->id, 'step_number' => 2, 'instruction' => 'Rebus dengan 3 gelas air hingga mendidih']);
                RecipeStep::create(['recipe_id' => $recipe1->id, 'step_number' => 3, 'instruction' => 'Kecilkan api dan biarkan hingga air tersisa 1 gelas']);
                RecipeStep::create(['recipe_id' => $recipe1->id, 'step_number' => 4, 'instruction' => 'Saring dan biarkan hingga hangat']);
                RecipeStep::create(['recipe_id' => $recipe1->id, 'step_number' => 5, 'instruction' => 'Tambahkan madu untuk mengurangi rasa pahit, minum 3x sehari']);
            }

            // Recipe 2: Batuk - Daun Sirih
            if (isset($diseases['batuk'])) {
                $recipe2 = HerbalRecipe::create([
                    'disease_id' => $diseases['batuk']->id,
                    'name' => 'Rebusan Daun Sirih untuk Batuk',
                    'description' => 'Daun sirih mengandung kavikol yang bersifat antiseptik dan antibakteri, meredakan batuk dan tenggorokan',
                    'instructions' => 'Rebusan daun sirih hangat untuk meredakan batuk berdahak',
                    'dosage' => '3 kali sehari, 1 gelas',
                    'duration' => '3-5 hari',
                    'warnings' => 'Gunakan daun sirih hijau segar, bukan sirih merah',
                    'preparation_time' => '15 menit',
                    'difficulty_level' => 'easy',
                    'servings' => 2,
                    'is_recommended' => true,
                    'is_active' => true,
                ]);

                if (isset($plants['Daun Sirih'])) {
                    RecipeIngredient::create([
                        'recipe_id' => $recipe2->id,
                        'plant_id' => $plants['Daun Sirih']->id,
                        'quantity' => '5-7',
                        'unit' => 'lembar',
                        'part_used' => 'leaf',
                        'preparation_notes' => 'Daun segar, dicuci bersih',
                        'order' => 1,
                    ]);
                }

                RecipeStep::create(['recipe_id' => $recipe2->id, 'step_number' => 1, 'instruction' => 'Cuci bersih 5-7 lembar daun sirih']);
                RecipeStep::create(['recipe_id' => $recipe2->id, 'step_number' => 2, 'instruction' => 'Rebus dengan 3 gelas air hingga mendidih']);
                RecipeStep::create(['recipe_id' => $recipe2->id, 'step_number' => 3, 'instruction' => 'Biarkan mendidih selama 10-15 menit']);
                RecipeStep::create(['recipe_id' => $recipe2->id, 'step_number' => 4, 'instruction' => 'Saring dan tambahkan madu secukupnya']);
                RecipeStep::create(['recipe_id' => $recipe2->id, 'step_number' => 5, 'instruction' => 'Minum hangat 3x sehari']);
            }

            // Recipe 3: Diabetes - Daun Panya
            if (isset($diseases['diabetes'])) {
                $recipe3 = HerbalRecipe::create([
                    'disease_id' => $diseases['diabetes']->id,
                    'name' => 'Rebusan Daun Panya untuk Diabetes',
                    'description' => 'Daun panya membantu menurunkan kadar gula darah dan meningkatkan sensitivitas insulin',
                    'instructions' => 'Rebusan daun panya sebagai terapi pendamping diabetes',
                    'dosage' => '2 kali sehari, 1 gelas (pagi dan sore sebelum makan)',
                    'duration' => '4-8 minggu',
                    'warnings' => 'Monitor gula darah secara rutin, tidak menggantikan obat dokter',
                    'preparation_time' => '20 menit',
                    'difficulty_level' => 'easy',
                    'servings' => 2,
                    'is_recommended' => true,
                    'is_active' => true,
                ]);

                if (isset($plants['Daun Panya'])) {
                    RecipeIngredient::create([
                        'recipe_id' => $recipe3->id,
                        'plant_id' => $plants['Daun Panya']->id,
                        'quantity' => '7',
                        'unit' => 'lembar',
                        'part_used' => 'leaf',
                        'preparation_notes' => 'Daun segar',
                        'order' => 1,
                    ]);
                }

                RecipeStep::create(['recipe_id' => $recipe3->id, 'step_number' => 1, 'instruction' => 'Cuci bersih 7 lembar daun panya']);
                RecipeStep::create(['recipe_id' => $recipe3->id, 'step_number' => 2, 'instruction' => 'Rebus dengan 3 gelas air hingga mendidih']);
                RecipeStep::create(['recipe_id' => $recipe3->id, 'step_number' => 3, 'instruction' => 'Kecilkan api, masak hingga air tersisa 1 gelas (20 menit)']);
                RecipeStep::create(['recipe_id' => $recipe3->id, 'step_number' => 4, 'instruction' => 'Saring dan dinginkan']);
                RecipeStep::create(['recipe_id' => $recipe3->id, 'step_number' => 5, 'instruction' => 'Minum 2x sehari sebelum makan']);
            }

            // Recipe 4: Hipertensi - Belimbing Botol + Cocor Bebek
            if (isset($diseases['hipertensi'])) {
                $recipe4 = HerbalRecipe::create([
                    'disease_id' => $diseases['hipertensi']->id,
                    'name' => 'Jus Belimbing Botol dan Cocor Bebek untuk Hipertensi',
                    'description' => 'Kombinasi belimbing botol yang kaya kalium dan cocor bebek sebagai diuretik alami untuk menurunkan tekanan darah',
                    'instructions' => 'Jus herbal untuk menurunkan tekanan darah tinggi',
                    'dosage' => '2 kali sehari, 1 gelas (pagi dan malam)',
                    'duration' => '2-4 minggu',
                    'warnings' => 'Monitor tekanan darah rutin, tidak untuk penderita hipotensi',
                    'preparation_time' => '15 menit',
                    'difficulty_level' => 'easy',
                    'servings' => 1,
                    'is_recommended' => true,
                    'is_active' => true,
                ]);

                if (isset($plants['Belimbing Botol'])) {
                    RecipeIngredient::create([
                        'recipe_id' => $recipe4->id,
                        'plant_id' => $plants['Belimbing Botol']->id,
                        'quantity' => '2',
                        'unit' => 'buah',
                        'part_used' => 'fruit',
                        'preparation_notes' => 'Buah matang, cuci bersih',
                        'order' => 1,
                    ]);
                }
                if (isset($plants['Cocor Bebek'])) {
                    RecipeIngredient::create([
                        'recipe_id' => $recipe4->id,
                        'plant_id' => $plants['Cocor Bebek']->id,
                        'quantity' => '3',
                        'unit' => 'lembar',
                        'part_used' => 'leaf',
                        'preparation_notes' => 'Daun segar',
                        'order' => 2,
                    ]);
                }

                RecipeStep::create(['recipe_id' => $recipe4->id, 'step_number' => 1, 'instruction' => 'Cuci bersih 2 buah belimbing botol dan 3 lembar daun cocor bebek']);
                RecipeStep::create(['recipe_id' => $recipe4->id, 'step_number' => 2, 'instruction' => 'Potong belimbing dan daun cocor bebek']);
                RecipeStep::create(['recipe_id' => $recipe4->id, 'step_number' => 3, 'instruction' => 'Blender dengan 1 gelas air matang']);
                RecipeStep::create(['recipe_id' => $recipe4->id, 'step_number' => 4, 'instruction' => 'Saring dan tambahkan madu secukupnya']);
                RecipeStep::create(['recipe_id' => $recipe4->id, 'step_number' => 5, 'instruction' => 'Minum 2x sehari, pagi dan malam']);
            }

            // Recipe 5: Demam Berdarah - Pepaya + Jambu Biji
            if (isset($diseases['demam'])) {
                $recipe5 = HerbalRecipe::create([
                    'disease_id' => $diseases['demam']->id,
                    'name' => 'Jus Pepaya dan Jambu Biji untuk Demam Berdarah',
                    'description' => 'Kombinasi daun pepaya dan jambu biji merah meningkatkan trombosit pada penderita DBD',
                    'instructions' => 'Jus herbal untuk meningkatkan trombosit',
                    'dosage' => '3 kali sehari, 1/2 gelas',
                    'duration' => '3-5 hari',
                    'warnings' => 'Tetap konsultasi dokter, tidak menggantikan perawatan medis',
                    'preparation_time' => '10 menit',
                    'difficulty_level' => 'easy',
                    'servings' => 1,
                    'is_recommended' => true,
                    'is_active' => true,
                ]);

                if (isset($plants['Pepaya'])) {
                    RecipeIngredient::create([
                        'recipe_id' => $recipe5->id,
                        'plant_id' => $plants['Pepaya']->id,
                        'quantity' => '3-5',
                        'unit' => 'lembar',
                        'part_used' => 'leaf',
                        'preparation_notes' => 'Daun muda',
                        'order' => 1,
                    ]);
                }
                if (isset($plants['Jambu Biji'])) {
                    RecipeIngredient::create([
                        'recipe_id' => $recipe5->id,
                        'plant_id' => $plants['Jambu Biji']->id,
                        'quantity' => '5',
                        'unit' => 'lembar',
                        'part_used' => 'leaf',
                        'preparation_notes' => 'Daun muda',
                        'order' => 2,
                    ]);
                }

                RecipeStep::create(['recipe_id' => $recipe5->id, 'step_number' => 1, 'instruction' => 'Cuci bersih 3-5 lembar daun pepaya dan 5 lembar daun jambu biji']);
                RecipeStep::create(['recipe_id' => $recipe5->id, 'step_number' => 2, 'instruction' => 'Blender dengan 1 gelas air matang']);
                RecipeStep::create(['recipe_id' => $recipe5->id, 'step_number' => 3, 'instruction' => 'Saring dan peras untuk mendapatkan airnya']);
                RecipeStep::create(['recipe_id' => $recipe5->id, 'step_number' => 4, 'instruction' => 'Tambahkan madu untuk mengurangi rasa pahit']);
                RecipeStep::create(['recipe_id' => $recipe5->id, 'step_number' => 5, 'instruction' => 'Minum 3x sehari']);
            }

            // Recipe 6: Diare - Jambu Biji
            if (isset($diseases['diare'])) {
                $recipe6 = HerbalRecipe::create([
                    'disease_id' => $diseases['diare']->id,
                    'name' => 'Rebusan Daun Jambu Biji untuk Diare',
                    'description' => 'Daun jambu biji mengandung tanin yang bersifat astringen, menghentikan diare',
                    'instructions' => 'Rebusan daun jambu biji untuk mengatasi diare',
                    'dosage' => '3 kali sehari, 1 gelas',
                    'duration' => '2-3 hari',
                    'warnings' => 'Jika diare berlanjut lebih dari 3 hari, segera ke dokter',
                    'preparation_time' => '15 menit',
                    'difficulty_level' => 'easy',
                    'servings' => 2,
                    'is_recommended' => true,
                    'is_active' => true,
                ]);

                if (isset($plants['Jambu Biji'])) {
                    RecipeIngredient::create([
                        'recipe_id' => $recipe6->id,
                        'plant_id' => $plants['Jambu Biji']->id,
                        'quantity' => '7',
                        'unit' => 'lembar',
                        'part_used' => 'leaf',
                        'preparation_notes' => 'Daun muda',
                        'order' => 1,
                    ]);
                }

                RecipeStep::create(['recipe_id' => $recipe6->id, 'step_number' => 1, 'instruction' => 'Cuci bersih 7 lembar daun jambu biji muda']);
                RecipeStep::create(['recipe_id' => $recipe6->id, 'step_number' => 2, 'instruction' => 'Rebus dengan 3 gelas air hingga mendidih']);
                RecipeStep::create(['recipe_id' => $recipe6->id, 'step_number' => 3, 'instruction' => 'Biarkan mendidih hingga air tersisa 1 gelas']);
                RecipeStep::create(['recipe_id' => $recipe6->id, 'step_number' => 4, 'instruction' => 'Saring dan biarkan hangat']);
                RecipeStep::create(['recipe_id' => $recipe6->id, 'step_number' => 5, 'instruction' => 'Minum 3x sehari']);
            }

            // Recipe 7: Masuk Angin - Jahe
            if (isset($diseases['masuk-angin'])) {
                $recipe7 = HerbalRecipe::create([
                    'disease_id' => $diseases['masuk-angin']->id,
                    'name' => 'Wedang Jahe untuk Masuk Angin',
                    'description' => 'Jahe menghangatkan tubuh dan melancarkan sirkulasi darah, efektif mengatasi masuk angin',
                    'instructions' => 'Minuman jahe hangat untuk menghangatkan tubuh',
                    'dosage' => '2-3 kali sehari, 1 gelas',
                    'duration' => '1-2 hari',
                    'warnings' => 'Tidak untuk penderita maag akut',
                    'preparation_time' => '15 menit',
                    'difficulty_level' => 'easy',
                    'servings' => 2,
                    'is_recommended' => true,
                    'is_active' => true,
                ]);

                if (isset($plants['Jahe'])) {
                    RecipeIngredient::create([
                        'recipe_id' => $recipe7->id,
                        'plant_id' => $plants['Jahe']->id,
                        'quantity' => '3',
                        'unit' => 'ruas',
                        'part_used' => 'rhizome',
                        'preparation_notes' => 'Jahe segar, dimemarkan',
                        'order' => 1,
                    ]);
                }

                RecipeStep::create(['recipe_id' => $recipe7->id, 'step_number' => 1, 'instruction' => 'Cuci dan memarkan 3 ruas jahe']);
                RecipeStep::create(['recipe_id' => $recipe7->id, 'step_number' => 2, 'instruction' => 'Rebus dengan 3 gelas air hingga mendidih']);
                RecipeStep::create(['recipe_id' => $recipe7->id, 'step_number' => 3, 'instruction' => 'Biarkan mendidih hingga air tersisa 2 gelas']);
                RecipeStep::create(['recipe_id' => $recipe7->id, 'step_number' => 4, 'instruction' => 'Tambahkan gula aren atau madu secukupnya']);
                RecipeStep::create(['recipe_id' => $recipe7->id, 'step_number' => 5, 'instruction' => 'Minum selagi hangat 2-3x sehari']);
            }

            // Recipe 8: Kolesterol Tinggi - Kunyit + Belimbing Botol
            if (isset($diseases['kolesterol-tinggi'])) {
                $recipe8 = HerbalRecipe::create([
                    'disease_id' => $diseases['kolesterol-tinggi']->id,
                    'name' => 'Jamu Kunyit Belimbing untuk Kolesterol',
                    'description' => 'Kombinasi kunyit dan belimbing botol membantu menurunkan kolesterol LDL dan meningkatkan HDL',
                    'instructions' => 'Jamu herbal untuk menurunkan kolesterol',
                    'dosage' => '2 kali sehari, 1 gelas (pagi dan malam)',
                    'duration' => '4-8 minggu',
                    'warnings' => 'Monitor kolesterol rutin, tidak menggantikan obat dokter',
                    'preparation_time' => '20 menit',
                    'difficulty_level' => 'medium',
                    'servings' => 1,
                    'is_recommended' => true,
                    'is_active' => true,
                ]);

                if (isset($plants['Kunyit'])) {
                    RecipeIngredient::create([
                        'recipe_id' => $recipe8->id,
                        'plant_id' => $plants['Kunyit']->id,
                        'quantity' => '2',
                        'unit' => 'ruas',
                        'part_used' => 'rhizome',
                        'preparation_notes' => 'Kupas dan cuci bersih',
                        'order' => 1,
                    ]);
                }
                if (isset($plants['Belimbing Botol'])) {
                    RecipeIngredient::create([
                        'recipe_id' => $recipe8->id,
                        'plant_id' => $plants['Belimbing Botol']->id,
                        'quantity' => '1',
                        'unit' => 'buah',
                        'part_used' => 'fruit',
                        'preparation_notes' => 'Buah matang',
                        'order' => 2,
                    ]);
                }

                RecipeStep::create(['recipe_id' => $recipe8->id, 'step_number' => 1, 'instruction' => 'Kupas dan parut 2 ruas kunyit']);
                RecipeStep::create(['recipe_id' => $recipe8->id, 'step_number' => 2, 'instruction' => 'Potong 1 buah belimbing botol']);
                RecipeStep::create(['recipe_id' => $recipe8->id, 'step_number' => 3, 'instruction' => 'Rebus kunyit dan belimbing dengan 2 gelas air hingga mendidih']);
                RecipeStep::create(['recipe_id' => $recipe8->id, 'step_number' => 4, 'instruction' => 'Masak hingga air tersisa 1 gelas, saring']);
                RecipeStep::create(['recipe_id' => $recipe8->id, 'step_number' => 5, 'instruction' => 'Tambahkan madu, minum 2x sehari']);
            }

            // Recipe 9: Wasir - Mayana
            if (isset($diseases['wasir-hemoroid'])) {
                $recipe9 = HerbalRecipe::create([
                    'disease_id' => $diseases['wasir-hemoroid']->id,
                    'name' => 'Rebusan Daun Mayana untuk Wasir',
                    'description' => 'Daun mayana melancarkan peredaran darah dan mengurangi pembengkakan wasir',
                    'instructions' => 'Rebusan untuk diminum dan kompres luar',
                    'dosage' => '2 kali sehari, 1 gelas',
                    'duration' => '1-2 minggu',
                    'warnings' => 'Untuk kompres luar, gunakan air rebusan yang sudah dingin',
                    'preparation_time' => '20 menit',
                    'difficulty_level' => 'easy',
                    'servings' => 2,
                    'is_recommended' => true,
                    'is_active' => true,
                ]);

                if (isset($plants['Mayana'])) {
                    RecipeIngredient::create([
                        'recipe_id' => $recipe9->id,
                        'plant_id' => $plants['Mayana']->id,
                        'quantity' => '10-15',
                        'unit' => 'lembar',
                        'part_used' => 'leaf',
                        'preparation_notes' => 'Daun segar',
                        'order' => 1,
                    ]);
                }

                RecipeStep::create(['recipe_id' => $recipe9->id, 'step_number' => 1, 'instruction' => 'Cuci bersih 10-15 lembar daun mayana']);
                RecipeStep::create(['recipe_id' => $recipe9->id, 'step_number' => 2, 'instruction' => 'Rebus dengan 3 gelas air hingga mendidih']);
                RecipeStep::create(['recipe_id' => $recipe9->id, 'step_number' => 3, 'instruction' => 'Masak hingga air tersisa 1 gelas']);
                RecipeStep::create(['recipe_id' => $recipe9->id, 'step_number' => 4, 'instruction' => 'Saring dan bagi menjadi 2 bagian']);
                RecipeStep::create(['recipe_id' => $recipe9->id, 'step_number' => 5, 'instruction' => 'Minum hangat 2x sehari, sisanya untuk kompres area wasir']);
            }

            // Recipe 10: Keputihan - Daun Sirih
            if (isset($diseases['keputihan'])) {
                $recipe10 = HerbalRecipe::create([
                    'disease_id' => $diseases['keputihan']->id,
                    'name' => 'Rebusan Daun Sirih untuk Keputihan',
                    'description' => 'Daun sirih bersifat antiseptik dan antibakteri, mengatasi keputihan abnormal',
                    'instructions' => 'Air rebusan untuk cebok/pembersihan area intim',
                    'dosage' => '2 kali sehari (pagi dan malam)',
                    'duration' => '5-7 hari',
                    'warnings' => 'Hanya untuk pemakaian luar, jangan diminum. Gunakan air hangat-hangat kuku',
                    'preparation_time' => '15 menit',
                    'difficulty_level' => 'easy',
                    'servings' => 1,
                    'is_recommended' => true,
                    'is_active' => true,
                ]);

                if (isset($plants['Daun Sirih'])) {
                    RecipeIngredient::create([
                        'recipe_id' => $recipe10->id,
                        'plant_id' => $plants['Daun Sirih']->id,
                        'quantity' => '10',
                        'unit' => 'lembar',
                        'part_used' => 'leaf',
                        'preparation_notes' => 'Daun segar',
                        'order' => 1,
                    ]);
                }

                RecipeStep::create(['recipe_id' => $recipe10->id, 'step_number' => 1, 'instruction' => 'Cuci bersih 10 lembar daun sirih']);
                RecipeStep::create(['recipe_id' => $recipe10->id, 'step_number' => 2, 'instruction' => 'Rebus dengan 2 liter air hingga mendidih']);
                RecipeStep::create(['recipe_id' => $recipe10->id, 'step_number' => 3, 'instruction' => 'Biarkan mendidih selama 10 menit']);
                RecipeStep::create(['recipe_id' => $recipe10->id, 'step_number' => 4, 'instruction' => 'Matikan api dan biarkan hingga hangat (tidak panas)']);
                RecipeStep::create(['recipe_id' => $recipe10->id, 'step_number' => 5, 'instruction' => 'Gunakan untuk cebok/pembersihan area intim 2x sehari']);
            }

            // Recipe 11: Rematik - Brotowali
            if (isset($diseases['rematik'])) {
                $recipe11 = HerbalRecipe::create([
                    'disease_id' => $diseases['rematik']->id,
                    'name' => 'Rebusan Batang Brotowali untuk Rematik',
                    'description' => 'Brotowali mengandung senyawa antiinflamasi yang mengurangi nyeri dan pembengkakan sendi',
                    'instructions' => 'Rebusan batang brotowali untuk meredakan nyeri rematik',
                    'dosage' => '2 kali sehari, 1 gelas',
                    'duration' => '2-4 minggu',
                    'warnings' => 'Sangat pahit, dapat ditambahkan madu. Tidak untuk ibu hamil',
                    'preparation_time' => '25 menit',
                    'difficulty_level' => 'easy',
                    'servings' => 2,
                    'is_recommended' => true,
                    'is_active' => true,
                ]);

                if (isset($plants['Brotowali'])) {
                    RecipeIngredient::create([
                        'recipe_id' => $recipe11->id,
                        'plant_id' => $plants['Brotowali']->id,
                        'quantity' => '1',
                        'unit' => 'batang',
                        'part_used' => 'stem',
                        'preparation_notes' => 'Batang sepanjang 10 cm, dimemarkan',
                        'order' => 1,
                    ]);
                }

                RecipeStep::create(['recipe_id' => $recipe11->id, 'step_number' => 1, 'instruction' => 'Cuci bersih batang brotowali sepanjang 10 cm']);
                RecipeStep::create(['recipe_id' => $recipe11->id, 'step_number' => 2, 'instruction' => 'Memarkan batang agar sarinya keluar']);
                RecipeStep::create(['recipe_id' => $recipe11->id, 'step_number' => 3, 'instruction' => 'Rebus dengan 3 gelas air hingga mendidih']);
                RecipeStep::create(['recipe_id' => $recipe11->id, 'step_number' => 4, 'instruction' => 'Masak hingga air tersisa 1 gelas (sekitar 25 menit)']);
                RecipeStep::create(['recipe_id' => $recipe11->id, 'step_number' => 5, 'instruction' => 'Saring, tambahkan madu untuk mengurangi pahit, minum 2x sehari']);
            }

            // Recipe 12: Sakit Maag - Kunyit + Lidah Buaya
            if (isset($diseases['sakit-maag'])) {
                $recipe12 = HerbalRecipe::create([
                    'disease_id' => $diseases['sakit-maag']->id,
                    'name' => 'Jamu Kunyit Lidah Buaya untuk Maag',
                    'description' => 'Kombinasi kunyit antiinflamasi dan gel lidah buaya yang menenangkan lambung',
                    'instructions' => 'Jamu untuk meredakan nyeri maag dan melindungi dinding lambung',
                    'dosage' => '2 kali sehari, 1 gelas (pagi dan sore setelah makan)',
                    'duration' => '7-14 hari',
                    'warnings' => 'Minum setelah makan, tidak saat perut kosong',
                    'preparation_time' => '20 menit',
                    'difficulty_level' => 'medium',
                    'servings' => 1,
                    'is_recommended' => true,
                    'is_active' => true,
                ]);

                if (isset($plants['Kunyit'])) {
                    RecipeIngredient::create([
                        'recipe_id' => $recipe12->id,
                        'plant_id' => $plants['Kunyit']->id,
                        'quantity' => '2',
                        'unit' => 'ruas',
                        'part_used' => 'rhizome',
                        'preparation_notes' => 'Kupas dan cuci bersih',
                        'order' => 1,
                    ]);
                }
                if (isset($plants['Lidah Buaya'])) {
                    RecipeIngredient::create([
                        'recipe_id' => $recipe12->id,
                        'plant_id' => $plants['Lidah Buaya']->id,
                        'quantity' => '1',
                        'unit' => 'batang',
                        'part_used' => 'leaf',
                        'preparation_notes' => 'Gel bagian dalam, sekitar 3 cm',
                        'order' => 2,
                    ]);
                }

                RecipeStep::create(['recipe_id' => $recipe12->id, 'step_number' => 1, 'instruction' => 'Kupas dan parut 2 ruas kunyit']);
                RecipeStep::create(['recipe_id' => $recipe12->id, 'step_number' => 2, 'instruction' => 'Ambil gel lidah buaya sekitar 3 cm, cuci bersih']);
                RecipeStep::create(['recipe_id' => $recipe12->id, 'step_number' => 3, 'instruction' => 'Blender kunyit parut dan gel lidah buaya dengan 1 gelas air matang']);
                RecipeStep::create(['recipe_id' => $recipe12->id, 'step_number' => 4, 'instruction' => 'Saring dan tambahkan 1 sendok madu']);
                RecipeStep::create(['recipe_id' => $recipe12->id, 'step_number' => 5, 'instruction' => 'Minum 2x sehari setelah makan']);
            }

            // Recipe 13: Radang Tenggorokan - Daun Sirih + Kunyit
            if (isset($diseases['radang-tenggorokan'])) {
                $recipe13 = HerbalRecipe::create([
                    'disease_id' => $diseases['radang-tenggorokan']->id,
                    'name' => 'Rebusan Daun Sirih dan Kunyit untuk Radang Tenggorokan',
                    'description' => 'Kombinasi antiseptik daun sirih dan antiinflamasi kunyit untuk meredakan radang tenggorokan',
                    'instructions' => 'Air hangat untuk berkumur dan diminum',
                    'dosage' => '3 kali sehari berkumur, 2 kali sehari diminum',
                    'duration' => '3-5 hari',
                    'warnings' => 'Jika demam tinggi atau tidak membaik dalam 3 hari, konsultasi dokter',
                    'preparation_time' => '15 menit',
                    'difficulty_level' => 'easy',
                    'servings' => 2,
                    'is_recommended' => true,
                    'is_active' => true,
                ]);

                if (isset($plants['Daun Sirih'])) {
                    RecipeIngredient::create([
                        'recipe_id' => $recipe13->id,
                        'plant_id' => $plants['Daun Sirih']->id,
                        'quantity' => '5',
                        'unit' => 'lembar',
                        'part_used' => 'leaf',
                        'preparation_notes' => 'Daun segar',
                        'order' => 1,
                    ]);
                }
                if (isset($plants['Kunyit'])) {
                    RecipeIngredient::create([
                        'recipe_id' => $recipe13->id,
                        'plant_id' => $plants['Kunyit']->id,
                        'quantity' => '1',
                        'unit' => 'ruas',
                        'part_used' => 'rhizome',
                        'preparation_notes' => 'Iris tipis',
                        'order' => 2,
                    ]);
                }

                RecipeStep::create(['recipe_id' => $recipe13->id, 'step_number' => 1, 'instruction' => 'Cuci bersih 5 lembar daun sirih dan 1 ruas kunyit yang sudah diiris']);
                RecipeStep::create(['recipe_id' => $recipe13->id, 'step_number' => 2, 'instruction' => 'Rebus dengan 3 gelas air hingga mendidih']);
                RecipeStep::create(['recipe_id' => $recipe13->id, 'step_number' => 3, 'instruction' => 'Masak hingga air tersisa 2 gelas']);
                RecipeStep::create(['recipe_id' => $recipe13->id, 'step_number' => 4, 'instruction' => 'Saring dan biarkan hangat']);
                RecipeStep::create(['recipe_id' => $recipe13->id, 'step_number' => 5, 'instruction' => 'Gunakan untuk berkumur 3x sehari dan minum hangat 2x sehari']);
            }

            // Recipe 14: Jerawat - Lidah Buaya
            if (isset($diseases['jerawat'])) {
                $recipe14 = HerbalRecipe::create([
                    'disease_id' => $diseases['jerawat']->id,
                    'name' => 'Masker Gel Lidah Buaya untuk Jerawat',
                    'description' => 'Gel lidah buaya memiliki sifat antibakteri dan antiinflamasi yang mengatasi jerawat',
                    'instructions' => 'Masker alami untuk mengobati jerawat dan bekas jerawat',
                    'dosage' => '2 kali sehari (pagi dan malam)',
                    'duration' => '2-4 minggu',
                    'warnings' => 'Untuk pemakaian luar saja, tes alergi terlebih dahulu di area kecil',
                    'preparation_time' => '10 menit',
                    'difficulty_level' => 'easy',
                    'servings' => 1,
                    'is_recommended' => true,
                    'is_active' => true,
                ]);

                if (isset($plants['Lidah Buaya'])) {
                    RecipeIngredient::create([
                        'recipe_id' => $recipe14->id,
                        'plant_id' => $plants['Lidah Buaya']->id,
                        'quantity' => '1',
                        'unit' => 'batang',
                        'part_used' => 'leaf',
                        'preparation_notes' => 'Gel bagian dalam, sekitar 5 cm',
                        'order' => 1,
                    ]);
                }

                RecipeStep::create(['recipe_id' => $recipe14->id, 'step_number' => 1, 'instruction' => 'Potong lidah buaya 5 cm, belah dan ambil gelnya']);
                RecipeStep::create(['recipe_id' => $recipe14->id, 'step_number' => 2, 'instruction' => 'Cuci bersih gel untuk menghilangkan getah kuning']);
                RecipeStep::create(['recipe_id' => $recipe14->id, 'step_number' => 3, 'instruction' => 'Haluskan gel atau langsung oleskan']);
                RecipeStep::create(['recipe_id' => $recipe14->id, 'step_number' => 4, 'instruction' => 'Oleskan pada wajah yang sudah bersih, diamkan 20 menit']);
                RecipeStep::create(['recipe_id' => $recipe14->id, 'step_number' => 5, 'instruction' => 'Bilas dengan air bersih, gunakan 2x sehari']);
            }

            // Recipe 15: Asam Urat - Cocor Bebek
            if (isset($diseases['asam-urat'])) {
                $recipe15 = HerbalRecipe::create([
                    'disease_id' => $diseases['asam-urat']->id,
                    'name' => 'Jus Daun Cocor Bebek untuk Asam Urat',
                    'description' => 'Daun cocor bebek membantu menurunkan kadar asam urat dan meredakan nyeri sendi',
                    'instructions' => 'Jus herbal untuk menurunkan asam urat',
                    'dosage' => '2 kali sehari, 1/2 gelas',
                    'duration' => '2-4 minggu',
                    'warnings' => 'Monitor kadar asam urat rutin, tetap jaga pola makan rendah purin',
                    'preparation_time' => '10 menit',
                    'difficulty_level' => 'easy',
                    'servings' => 1,
                    'is_recommended' => true,
                    'is_active' => true,
                ]);

                if (isset($plants['Cocor Bebek'])) {
                    RecipeIngredient::create([
                        'recipe_id' => $recipe15->id,
                        'plant_id' => $plants['Cocor Bebek']->id,
                        'quantity' => '5',
                        'unit' => 'lembar',
                        'part_used' => 'leaf',
                        'preparation_notes' => 'Daun segar dan tebal',
                        'order' => 1,
                    ]);
                }

                RecipeStep::create(['recipe_id' => $recipe15->id, 'step_number' => 1, 'instruction' => 'Cuci bersih 5 lembar daun cocor bebek']);
                RecipeStep::create(['recipe_id' => $recipe15->id, 'step_number' => 2, 'instruction' => 'Blender dengan 1 gelas air matang']);
                RecipeStep::create(['recipe_id' => $recipe15->id, 'step_number' => 3, 'instruction' => 'Saring untuk memisahkan ampas']);
                RecipeStep::create(['recipe_id' => $recipe15->id, 'step_number' => 4, 'instruction' => 'Tambahkan madu untuk rasa']);
                RecipeStep::create(['recipe_id' => $recipe15->id, 'step_number' => 5, 'instruction' => 'Minum 2x sehari, pagi dan sore']);
            }

            DB::commit();
            $this->command->info('15 Herbal recipes seeded successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            $this->command->error('Failed to seed recipes: ' . $e->getMessage());
        }
    }
}
