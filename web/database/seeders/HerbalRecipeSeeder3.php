<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HerbalRecipe;
use App\Models\RecipeIngredient;
use App\Models\RecipeStep;
use App\Models\Disease;
use App\Models\Plant;
use Illuminate\Support\Facades\DB;

class HerbalRecipeSeeder3 extends Seeder
{
    /**
     * Run the database seeds.
     * Seeds herbal recipes for diseases 11-15 (Batch 3).
     */
    public function run(): void
    {
        DB::beginTransaction();
        try {
            $diseases = Disease::all()->keyBy('slug');
            $plants = Plant::all()->keyBy('name');

            // Recipe 11: Anemia
            if (isset($diseases['anemia'])) {
                $recipe = HerbalRecipe::create([
                    'disease_id' => $diseases['anemia']->id,
                    'name' => 'Jus Bayam dan Bit untuk Anemia',
                    'description' => 'Bayam dan bit kaya zat besi untuk meningkatkan hemoglobin',
                    'instructions' => 'Jus bayam bit untuk mengatasi kekurangan darah',
                    'dosage' => '1 kali sehari, 1 gelas di pagi hari',
                    'duration' => 'Rutin minimal 2 minggu',
                    'warnings' => 'Tetap konsumsi suplemen zat besi dari dokter jika diperlukan',
                    'preparation_time' => '10 menit',
                    'difficulty_level' => 'easy',
                    'servings' => 1,
                    'is_recommended' => true,
                    'is_active' => true,
                ]);

                RecipeStep::create(['recipe_id' => $recipe->id, 'step_number' => 1, 'instruction' => 'Cuci bersih 1 genggam daun bayam merah dan 1 buah bit ukuran sedang']);
                RecipeStep::create(['recipe_id' => $recipe->id, 'step_number' => 2, 'instruction' => 'Kupas bit dan potong-potong kecil']);
                RecipeStep::create(['recipe_id' => $recipe->id, 'step_number' => 3, 'instruction' => 'Masukkan bayam dan bit ke blender dengan 1 gelas air']);
                RecipeStep::create(['recipe_id' => $recipe->id, 'step_number' => 4, 'instruction' => 'Blender hingga halus, tambahkan perasan jeruk nipis']);
                RecipeStep::create(['recipe_id' => $recipe->id, 'step_number' => 5, 'instruction' => 'Saring jika perlu, tambahkan madu, minum langsung setiap pagi']);
            }

            // Recipe 12: Insomnia
            if (isset($diseases['insomnia'])) {
                $recipe = HerbalRecipe::create([
                    'disease_id' => $diseases['insomnia']->id,
                    'name' => 'Teh Daun Mint untuk Insomnia',
                    'description' => 'Daun mint memiliki efek menenangkan yang membantu tidur lebih nyenyak',
                    'instructions' => 'Teh mint hangat untuk relaksasi sebelum tidur',
                    'dosage' => '1 gelas sebelum tidur',
                    'duration' => 'Rutin setiap malam',
                    'warnings' => 'Hindari konsumsi kafein 6 jam sebelum tidur',
                    'preparation_time' => '10 menit',
                    'difficulty_level' => 'easy',
                    'servings' => 1,
                    'is_recommended' => true,
                    'is_active' => true,
                ]);

                if (isset($plants['Daun Mint'])) {
                    RecipeIngredient::create([
                        'recipe_id' => $recipe->id,
                        'plant_id' => $plants['Daun Mint']->id,
                        'quantity' => '10-15',
                        'unit' => 'lembar',
                        'part_used' => 'leaf',
                        'preparation_notes' => 'Daun segar lebih baik',
                        'order' => 1,
                    ]);
                }

                RecipeStep::create(['recipe_id' => $recipe->id, 'step_number' => 1, 'instruction' => 'Cuci bersih 10-15 lembar daun mint segar']);
                RecipeStep::create(['recipe_id' => $recipe->id, 'step_number' => 2, 'instruction' => 'Masukkan daun mint ke dalam cangkir']);
                RecipeStep::create(['recipe_id' => $recipe->id, 'step_number' => 3, 'instruction' => 'Tuang air panas (bukan mendidih) ke dalam cangkir']);
                RecipeStep::create(['recipe_id' => $recipe->id, 'step_number' => 4, 'instruction' => 'Tutup dan diamkan 5-7 menit']);
                RecipeStep::create(['recipe_id' => $recipe->id, 'step_number' => 5, 'instruction' => 'Tambahkan madu jika suka, minum 30 menit sebelum tidur']);
            }

            // Recipe 13: Sakit Kepala
            if (isset($diseases['sakit-kepala'])) {
                $recipe = HerbalRecipe::create([
                    'disease_id' => $diseases['sakit-kepala']->id,
                    'name' => 'Kompres Jahe untuk Sakit Kepala',
                    'description' => 'Jahe memiliki efek antiinflamasi yang meredakan sakit kepala',
                    'instructions' => 'Kombinasi minum wedang jahe dan kompres untuk sakit kepala',
                    'dosage' => 'Kompres dan minum saat kepala sakit',
                    'duration' => 'Sesuai kebutuhan',
                    'warnings' => 'Jika sakit kepala tidak mereda atau makin parah, segera ke dokter',
                    'preparation_time' => '15 menit',
                    'difficulty_level' => 'easy',
                    'servings' => 1,
                    'is_recommended' => true,
                    'is_active' => true,
                ]);

                if (isset($plants['Jahe'])) {
                    RecipeIngredient::create([
                        'recipe_id' => $recipe->id,
                        'plant_id' => $plants['Jahe']->id,
                        'quantity' => '2',
                        'unit' => 'ruas',
                        'part_used' => 'rhizome',
                        'preparation_notes' => 'Cuci dan parut',
                        'order' => 1,
                    ]);
                }

                RecipeStep::create(['recipe_id' => $recipe->id, 'step_number' => 1, 'instruction' => 'Parut 2 ruas jahe segar']);
                RecipeStep::create(['recipe_id' => $recipe->id, 'step_number' => 2, 'instruction' => 'Untuk diminum: rebus parutan jahe dengan 2 gelas air hingga tersisa 1 gelas']);
                RecipeStep::create(['recipe_id' => $recipe->id, 'step_number' => 3, 'instruction' => 'Untuk kompres: bungkus parutan jahe dengan kain bersih']);
                RecipeStep::create(['recipe_id' => $recipe->id, 'step_number' => 4, 'instruction' => 'Kompres dahi dan belakang leher dengan jahe parut selama 15-20 menit']);
                RecipeStep::create(['recipe_id' => $recipe->id, 'step_number' => 5, 'instruction' => 'Sambil kompres, minum wedang jahe hangat. Istirahat di tempat tenang']);
            }

            // Recipe 14: Radang Tenggorokan
            if (isset($diseases['radang-tenggorokan'])) {
                $recipe = HerbalRecipe::create([
                    'disease_id' => $diseases['radang-tenggorokan']->id,
                    'name' => 'Air Garam Kunyit untuk Berkumur',
                    'description' => 'Kunyit bersifat antibakteri dan antiinflamasi untuk radang tenggorokan',
                    'instructions' => 'Berkumur dengan air kunyit garam untuk meredakan radang',
                    'dosage' => '3-4 kali sehari setelah makan',
                    'duration' => '3-5 hari',
                    'warnings' => 'Jangan ditelan, hanya untuk berkumur',
                    'preparation_time' => '10 menit',
                    'difficulty_level' => 'easy',
                    'servings' => 1,
                    'is_recommended' => true,
                    'is_active' => true,
                ]);

                if (isset($plants['Kunyit'])) {
                    RecipeIngredient::create([
                        'recipe_id' => $recipe->id,
                        'plant_id' => $plants['Kunyit']->id,
                        'quantity' => '1',
                        'unit' => 'ruas',
                        'part_used' => 'rhizome',
                        'preparation_notes' => 'Parut untuk diambil sarinya',
                        'order' => 1,
                    ]);
                }

                RecipeStep::create(['recipe_id' => $recipe->id, 'step_number' => 1, 'instruction' => 'Parut 1 ruas kunyit dan peras untuk mendapatkan 1 sendok makan sari kunyit']);
                RecipeStep::create(['recipe_id' => $recipe->id, 'step_number' => 2, 'instruction' => 'Campurkan sari kunyit dengan 1 gelas air hangat']);
                RecipeStep::create(['recipe_id' => $recipe->id, 'step_number' => 3, 'instruction' => 'Tambahkan 1/2 sendok teh garam, aduk rata']);
                RecipeStep::create(['recipe_id' => $recipe->id, 'step_number' => 4, 'instruction' => 'Berkumur dengan larutan ini selama 30 detik lalu buang']);
                RecipeStep::create(['recipe_id' => $recipe->id, 'step_number' => 5, 'instruction' => 'Ulangi 3-4 kali sehari terutama setelah makan']);
            }

            // Recipe 15: Wasir (Hemoroid)
            if (isset($diseases['wasir-hemoroid'])) {
                $recipe = HerbalRecipe::create([
                    'disease_id' => $diseases['wasir-hemoroid']->id,
                    'name' => 'Lidah Buaya untuk Wasir',
                    'description' => 'Lidah buaya memiliki efek antiinflamasi yang menenangkan wasir',
                    'instructions' => 'Gel lidah buaya untuk meredakan nyeri dan peradangan wasir',
                    'dosage' => 'Oleskan 2-3 kali sehari',
                    'duration' => '1-2 minggu',
                    'warnings' => 'Untuk wasir parah, tetap konsultasi ke dokter',
                    'preparation_time' => '5 menit',
                    'difficulty_level' => 'easy',
                    'servings' => 1,
                    'is_recommended' => true,
                    'is_active' => true,
                ]);

                if (isset($plants['Lidah Buaya'])) {
                    RecipeIngredient::create([
                        'recipe_id' => $recipe->id,
                        'plant_id' => $plants['Lidah Buaya']->id,
                        'quantity' => '1',
                        'unit' => 'batang',
                        'part_used' => 'leaf',
                        'preparation_notes' => 'Ambil gelnya',
                        'order' => 1,
                    ]);
                }

                RecipeStep::create(['recipe_id' => $recipe->id, 'step_number' => 1, 'instruction' => 'Potong 1 batang lidah buaya segar']);
                RecipeStep::create(['recipe_id' => $recipe->id, 'step_number' => 2, 'instruction' => 'Kupas kulit luarnya dan ambil gel bening di dalamnya']);
                RecipeStep::create(['recipe_id' => $recipe->id, 'step_number' => 3, 'instruction' => 'Cuci bersih gel untuk menghilangkan getah kuning (lateks)']);
                RecipeStep::create(['recipe_id' => $recipe->id, 'step_number' => 4, 'instruction' => 'Haluskan gel dan simpan dalam wadah bersih di kulkas']);
                RecipeStep::create(['recipe_id' => $recipe->id, 'step_number' => 5, 'instruction' => 'Oleskan gel dingin pada area wasir 2-3x sehari setelah BAB dan dibersihkan']);
            }

            DB::commit();
            $this->command->info('Herbal recipes (Batch 3: diseases 11-15) seeded successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            $this->command->error('Failed to seed recipes batch 3: ' . $e->getMessage());
        }
    }
}
