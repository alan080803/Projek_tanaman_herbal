<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HerbalRecipe;
use App\Models\RecipeIngredient;
use App\Models\RecipeStep;
use App\Models\Disease;
use App\Models\Plant;
use Illuminate\Support\Facades\DB;

class HerbalRecipeSeeder4 extends Seeder
{
    /**
     * Run the database seeds.
     * Seeds herbal recipes for diseases 16-20 (Batch 4 - Final).
     */
    public function run(): void
    {
        DB::beginTransaction();
        try {
            $diseases = Disease::all()->keyBy('slug');
            $plants = Plant::all()->keyBy('name');

            // Recipe 16: Asma
            if (isset($diseases['asma'])) {
                $recipe = HerbalRecipe::create([
                    'disease_id' => $diseases['asma']->id,
                    'name' => 'Jahe Madu untuk Melegakan Asma',
                    'description' => 'Jahe membantu melegakan saluran pernapasan dan mengurangi peradangan',
                    'instructions' => 'Wedang jahe hangat untuk meredakan gejala asma',
                    'dosage' => '2-3 kali sehari, 1 gelas',
                    'duration' => 'Rutin sebagai terapi pendukung',
                    'warnings' => 'TIDAK MENGGANTIKAN inhaler. Tetap bawa inhaler dan konsultasi dokter',
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
                        'quantity' => '3',
                        'unit' => 'ruas',
                        'part_used' => 'rhizome',
                        'preparation_notes' => 'Cuci dan memarkan',
                        'order' => 1,
                    ]);
                }

                RecipeStep::create(['recipe_id' => $recipe->id, 'step_number' => 1, 'instruction' => 'Cuci dan memarkan 3 ruas jahe']);
                RecipeStep::create(['recipe_id' => $recipe->id, 'step_number' => 2, 'instruction' => 'Rebus dengan 2 gelas air hingga mendidih, kecilkan api']);
                RecipeStep::create(['recipe_id' => $recipe->id, 'step_number' => 3, 'instruction' => 'Biarkan hingga air tersisa 1 gelas (15 menit)']);
                RecipeStep::create(['recipe_id' => $recipe->id, 'step_number' => 4, 'instruction' => 'Saring, tambahkan 2 sendok makan madu murni']);
                RecipeStep::create(['recipe_id' => $recipe->id, 'step_number' => 5, 'instruction' => 'Minum hangat 2-3x sehari. Hirup uapnya sebelum minum untuk melegakan napas']);
            }

            // Recipe 17: Keputihan
            if (isset($diseases['keputihan'])) {
                $recipe = HerbalRecipe::create([
                    'disease_id' => $diseases['keputihan']->id,
                    'name' => 'Daun Sirih untuk Keputihan',
                    'description' => 'Daun sirih memiliki sifat antibakteri dan antijamur untuk mengatasi keputihan',
                    'instructions' => 'Air rebusan daun sirih untuk membersihkan area kewanitaan',
                    'dosage' => '2 kali sehari (pagi dan malam)',
                    'duration' => '7-10 hari',
                    'warnings' => 'Hanya untuk cebok luar, jangan dimasukkan ke dalam vagina',
                    'preparation_time' => '15 menit',
                    'difficulty_level' => 'easy',
                    'servings' => 1,
                    'is_recommended' => true,
                    'is_active' => true,
                ]);

                RecipeStep::create(['recipe_id' => $recipe->id, 'step_number' => 1, 'instruction' => 'Cuci bersih 7-10 lembar daun sirih segar']);
                RecipeStep::create(['recipe_id' => $recipe->id, 'step_number' => 2, 'instruction' => 'Rebus dengan 2 liter air hingga mendidih']);
                RecipeStep::create(['recipe_id' => $recipe->id, 'step_number' => 3, 'instruction' => 'Kecilkan api, biarkan 10 menit lagi']);
                RecipeStep::create(['recipe_id' => $recipe->id, 'step_number' => 4, 'instruction' => 'Angkat dan biarkan hingga hangat (tidak panas)']);
                RecipeStep::create(['recipe_id' => $recipe->id, 'step_number' => 5, 'instruction' => 'Gunakan untuk cebok area luar kewanitaan pagi dan malam setelah mandi']);
            }

            // Recipe 18: Jerawat
            if (isset($diseases['jerawat'])) {
                $recipe = HerbalRecipe::create([
                    'disease_id' => $diseases['jerawat']->id,
                    'name' => 'Masker Lidah Buaya untuk Jerawat',
                    'description' => 'Lidah buaya memiliki sifat antibakteri dan antiinflamasi untuk jerawat',
                    'instructions' => 'Masker gel lidah buaya untuk mengurangi jerawat',
                    'dosage' => 'Pakai 2 kali sehari atau setiap malam',
                    'duration' => 'Rutin 2-4 minggu',
                    'warnings' => 'Test patch dulu untuk memastikan tidak alergi',
                    'preparation_time' => '10 menit',
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
                        'preparation_notes' => 'Ambil gel beningnya',
                        'order' => 1,
                    ]);
                }

                RecipeStep::create(['recipe_id' => $recipe->id, 'step_number' => 1, 'instruction' => 'Potong 1 batang lidah buaya, kupas dan ambil gel beningnya']);
                RecipeStep::create(['recipe_id' => $recipe->id, 'step_number' => 2, 'instruction' => 'Cuci bersih gel untuk menghilangkan getah kuning']);
                RecipeStep::create(['recipe_id' => $recipe->id, 'step_number' => 3, 'instruction' => 'Haluskan gel dengan blender atau garpu']);
                RecipeStep::create(['recipe_id' => $recipe->id, 'step_number' => 4, 'instruction' => 'Bersihkan wajah, lalu oleskan gel merata di wajah']);
                RecipeStep::create(['recipe_id' => $recipe->id, 'step_number' => 5, 'instruction' => 'Diamkan 20-30 menit, bilas dengan air dingin. Lakukan rutin malam hari']);
            }

            // Recipe 19: Rematik
            if (isset($diseases['rematik'])) {
                $recipe = HerbalRecipe::create([
                    'disease_id' => $diseases['rematik']->id,
                    'name' => 'Kompres Jahe Kunyit untuk Rematik',
                    'description' => 'Kombinasi jahe dan kunyit untuk meredakan nyeri dan peradangan sendi',
                    'instructions' => 'Kompres hangat untuk meredakan nyeri rematik',
                    'dosage' => '2 kali sehari (pagi dan malam)',
                    'duration' => 'Rutin setiap hari',
                    'warnings' => 'Tetap minum obat dari dokter, ini hanya terapi tambahan',
                    'preparation_time' => '20 menit',
                    'difficulty_level' => 'medium',
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
                        'preparation_notes' => 'Parut halus',
                        'order' => 1,
                    ]);
                }
                if (isset($plants['Kunyit'])) {
                    RecipeIngredient::create([
                        'recipe_id' => $recipe->id,
                        'plant_id' => $plants['Kunyit']->id,
                        'quantity' => '2',
                        'unit' => 'ruas',
                        'part_used' => 'rhizome',
                        'preparation_notes' => 'Parut halus',
                        'order' => 2,
                    ]);
                }

                RecipeStep::create(['recipe_id' => $recipe->id, 'step_number' => 1, 'instruction' => 'Parut 2 ruas jahe dan 2 ruas kunyit']);
                RecipeStep::create(['recipe_id' => $recipe->id, 'step_number' => 2, 'instruction' => 'Campur parutan, tambahkan sedikit air hingga menjadi pasta']);
                RecipeStep::create(['recipe_id' => $recipe->id, 'step_number' => 3, 'instruction' => 'Panaskan pasta sebentar (jangan terlalu panas)']);
                RecipeStep::create(['recipe_id' => $recipe->id, 'step_number' => 4, 'instruction' => 'Oleskan pada sendi yang sakit, bungkus dengan kain']);
                RecipeStep::create(['recipe_id' => $recipe->id, 'step_number' => 5, 'instruction' => 'Diamkan 30-45 menit, lakukan 2x sehari. Bisa sambil minum wedang jahe']);
            }

            // Recipe 20: Vertigo
            if (isset($diseases['vertigo'])) {
                $recipe = HerbalRecipe::create([
                    'disease_id' => $diseases['vertigo']->id,
                    'name' => 'Jahe dan Daun Mint untuk Vertigo',
                    'description' => 'Jahe dan mint membantu meredakan mual dan pusing akibat vertigo',
                    'instructions' => 'Teh jahe mint untuk meredakan gejala vertigo',
                    'dosage' => '2-3 kali sehari saat vertigo muncul',
                    'duration' => 'Sesuai kebutuhan',
                    'warnings' => 'Jika vertigo sering kambuh atau makin parah, segera ke dokter',
                    'preparation_time' => '10 menit',
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
                        'preparation_notes' => 'Iris tipis',
                        'order' => 1,
                    ]);
                }
                if (isset($plants['Daun Mint'])) {
                    RecipeIngredient::create([
                        'recipe_id' => $recipe->id,
                        'plant_id' => $plants['Daun Mint']->id,
                        'quantity' => '7-10',
                        'unit' => 'lembar',
                        'part_used' => 'leaf',
                        'preparation_notes' => 'Daun segar',
                        'order' => 2,
                    ]);
                }

                RecipeStep::create(['recipe_id' => $recipe->id, 'step_number' => 1, 'instruction' => 'Cuci bersih 2 ruas jahe (iris tipis) dan 7-10 lembar daun mint']);
                RecipeStep::create(['recipe_id' => $recipe->id, 'step_number' => 2, 'instruction' => 'Rebus jahe dengan 2 gelas air hingga mendidih']);
                RecipeStep::create(['recipe_id' => $recipe->id, 'step_number' => 3, 'instruction' => 'Masukkan daun mint, matikan api, tutup selama 5 menit']);
                RecipeStep::create(['recipe_id' => $recipe->id, 'step_number' => 4, 'instruction' => 'Saring, tambahkan madu secukupnya']);
                RecipeStep::create(['recipe_id' => $recipe->id, 'step_number' => 5, 'instruction' => 'Minum hangat saat vertigo muncul. Duduk atau berbaring sambil minum']);
            }

            DB::commit();
            $this->command->info('Herbal recipes (Batch 4: diseases 16-20) seeded successfully! All recipes completed.');
        } catch (\Exception $e) {
            DB::rollBack();
            $this->command->error('Failed to seed recipes batch 4: ' . $e->getMessage());
        }
    }
}
