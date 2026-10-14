<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HerbalRecipe;
use App\Models\RecipeIngredient;
use App\Models\RecipeStep;
use App\Models\Disease;
use App\Models\Plant;
use Illuminate\Support\Facades\DB;

class HerbalRecipeSeeder2 extends Seeder
{
    /**
     * Run the database seeds.
     * Seeds herbal recipes for diseases 6-10 (Batch 2).
     */
    public function run(): void
    {
        DB::beginTransaction();
        try {
            $diseases = Disease::all()->keyBy('slug');
            $plants = Plant::all()->keyBy('name');

            // Recipe 6: Diare
            if (isset($diseases['diare'])) {
                $recipe = HerbalRecipe::create([
                    'disease_id' => $diseases['diare']->id,
                    'name' => 'Daun Jambu Biji untuk Diare',
                    'description' => 'Daun jambu biji efektif mengatasi diare karena kandungan taninnya',
                    'instructions' => 'Rebusan daun jambu biji untuk menghentikan diare',
                    'dosage' => '3 kali sehari, 1/2 gelas',
                    'duration' => '1-2 hari',
                    'warnings' => 'Jika diare tidak berhenti setelah 2 hari, segera ke dokter',
                    'preparation_time' => '15 menit',
                    'difficulty_level' => 'easy',
                    'servings' => 1,
                    'is_recommended' => true,
                    'is_active' => true,
                ]);

                RecipeStep::create(['recipe_id' => $recipe->id, 'step_number' => 1, 'instruction' => 'Cuci bersih 5-7 lembar daun jambu biji muda']);
                RecipeStep::create(['recipe_id' => $recipe->id, 'step_number' => 2, 'instruction' => 'Rebus dengan 2 gelas air hingga mendidih']);
                RecipeStep::create(['recipe_id' => $recipe->id, 'step_number' => 3, 'instruction' => 'Biarkan hingga air tersisa 1 gelas (sekitar 15 menit)']);
                RecipeStep::create(['recipe_id' => $recipe->id, 'step_number' => 4, 'instruction' => 'Saring dan dinginkan hingga hangat']);
                RecipeStep::create(['recipe_id' => $recipe->id, 'step_number' => 5, 'instruction' => 'Minum 1/2 gelas, 3 kali sehari sampai diare berhenti']);
            }

            // Recipe 7: Hipertensi
            if (isset($diseases['hipertensi'])) {
                $recipe = HerbalRecipe::create([
                    'disease_id' => $diseases['hipertensi']->id,
                    'name' => 'Daun Seledri untuk Tekanan Darah Tinggi',
                    'description' => 'Seledri mengandung apigenin yang membantu menurunkan tekanan darah',
                    'instructions' => 'Jus daun seledri untuk membantu mengontrol hipertensi',
                    'dosage' => '2 kali sehari, 1 gelas (pagi dan sore)',
                    'duration' => 'Rutin setiap hari',
                    'warnings' => 'Tetap kontrol ke dokter dan minum obat rutin. Ini hanya terapi tambahan',
                    'preparation_time' => '10 menit',
                    'difficulty_level' => 'easy',
                    'servings' => 1,
                    'is_recommended' => true,
                    'is_active' => true,
                ]);

                RecipeStep::create(['recipe_id' => $recipe->id, 'step_number' => 1, 'instruction' => 'Cuci bersih 5-7 batang seledri lengkap dengan daunnya']);
                RecipeStep::create(['recipe_id' => $recipe->id, 'step_number' => 2, 'instruction' => 'Potong-potong seledri dan masukkan ke blender']);
                RecipeStep::create(['recipe_id' => $recipe->id, 'step_number' => 3, 'instruction' => 'Tambahkan 1 gelas air matang dan blender hingga halus']);
                RecipeStep::create(['recipe_id' => $recipe->id, 'step_number' => 4, 'instruction' => 'Saring dan tambahkan sedikit madu atau lemon untuk rasa']);
                RecipeStep::create(['recipe_id' => $recipe->id, 'step_number' => 5, 'instruction' => 'Minum langsung, jangan disimpan lama. Konsumsi rutin pagi dan sore']);
            }

            // Recipe 8: Diabetes
            if (isset($diseases['diabetes'])) {
                $recipe = HerbalRecipe::create([
                    'disease_id' => $diseases['diabetes']->id,
                    'name' => 'Daun Insulin (Sambung Nyawa) untuk Diabetes',
                    'description' => 'Daun insulin membantu menurunkan kadar gula darah secara alami',
                    'instructions' => 'Konsumsi daun insulin untuk membantu kontrol gula darah',
                    'dosage' => '2 kali sehari, makan 2-3 lembar daun',
                    'duration' => 'Rutin setiap hari',
                    'warnings' => 'Tetap cek gula darah rutin dan konsumsi obat dari dokter',
                    'preparation_time' => '5 menit',
                    'difficulty_level' => 'easy',
                    'servings' => 1,
                    'is_recommended' => true,
                    'is_active' => true,
                ]);

                RecipeStep::create(['recipe_id' => $recipe->id, 'step_number' => 1, 'instruction' => 'Petik 2-3 lembar daun insulin/sambung nyawa yang segar']);
                RecipeStep::create(['recipe_id' => $recipe->id, 'step_number' => 2, 'instruction' => 'Cuci bersih daun dengan air mengalir']);
                RecipeStep::create(['recipe_id' => $recipe->id, 'step_number' => 3, 'instruction' => 'Bisa dimakan langsung (dikunyah) atau dijadikan lalapan']);
                RecipeStep::create(['recipe_id' => $recipe->id, 'step_number' => 4, 'instruction' => 'Alternatif: blender dengan air dan minum sebagai jus']);
                RecipeStep::create(['recipe_id' => $recipe->id, 'step_number' => 5, 'instruction' => 'Konsumsi rutin sebelum makan pagi dan malam']);
            }

            // Recipe 9: Kolesterol Tinggi
            if (isset($diseases['kolesterol-tinggi'])) {
                $recipe = HerbalRecipe::create([
                    'disease_id' => $diseases['kolesterol-tinggi']->id,
                    'name' => 'Bawang Putih Madu untuk Kolesterol',
                    'description' => 'Bawang putih efektif menurunkan kolesterol LDL dan meningkatkan HDL',
                    'instructions' => 'Kombinasi bawang putih dan madu untuk menurunkan kolesterol',
                    'dosage' => '1 kali sehari di pagi hari sebelum sarapan',
                    'duration' => 'Minimal 1 bulan untuk hasil optimal',
                    'warnings' => 'Tidak untuk penderita gangguan lambung berat',
                    'preparation_time' => '24 jam (fermentasi)',
                    'difficulty_level' => 'medium',
                    'servings' => 30,
                    'is_recommended' => true,
                    'is_active' => true,
                ]);

                RecipeStep::create(['recipe_id' => $recipe->id, 'step_number' => 1, 'instruction' => 'Kupas 10 siung bawang putih segar']);
                RecipeStep::create(['recipe_id' => $recipe->id, 'step_number' => 2, 'instruction' => 'Masukkan bawang putih ke dalam toples kaca bersih']);
                RecipeStep::create(['recipe_id' => $recipe->id, 'step_number' => 3, 'instruction' => 'Tuang madu murni hingga semua bawang putih terendam']);
                RecipeStep::create(['recipe_id' => $recipe->id, 'step_number' => 4, 'instruction' => 'Tutup rapat dan diamkan selama 3-7 hari di suhu ruang']);
                RecipeStep::create(['recipe_id' => $recipe->id, 'step_number' => 5, 'instruction' => 'Konsumsi 1 siung bawang putih dengan 1 sendok madunya setiap pagi sebelum sarapan']);
            }

            // Recipe 10: Asam Urat
            if (isset($diseases['asam-urat'])) {
                $recipe = HerbalRecipe::create([
                    'disease_id' => $diseases['asam-urat']->id,
                    'name' => 'Daun Seledri dan Lemon untuk Asam Urat',
                    'description' => 'Seledri membantu mengeluarkan asam urat melalui urin',
                    'instructions' => 'Jus seledri lemon untuk menurunkan kadar asam urat',
                    'dosage' => '2 kali sehari, 1 gelas',
                    'duration' => 'Rutin minimal 2 minggu',
                    'warnings' => 'Tetap batasi makanan tinggi purin',
                    'preparation_time' => '10 menit',
                    'difficulty_level' => 'easy',
                    'servings' => 1,
                    'is_recommended' => true,
                    'is_active' => true,
                ]);

                RecipeStep::create(['recipe_id' => $recipe->id, 'step_number' => 1, 'instruction' => 'Cuci bersih 5 batang seledri lengkap dengan daun']);
                RecipeStep::create(['recipe_id' => $recipe->id, 'step_number' => 2, 'instruction' => 'Potong-potong dan masukkan ke blender']);
                RecipeStep::create(['recipe_id' => $recipe->id, 'step_number' => 3, 'instruction' => 'Tambahkan air perasan 1/2 jeruk lemon']);
                RecipeStep::create(['recipe_id' => $recipe->id, 'step_number' => 4, 'instruction' => 'Blender dengan 1 gelas air matang hingga halus']);
                RecipeStep::create(['recipe_id' => $recipe->id, 'step_number' => 5, 'instruction' => 'Saring, tambahkan sedikit madu, minum 2x sehari']);
            }

            DB::commit();
            $this->command->info('Herbal recipes (Batch 2: diseases 6-10) seeded successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            $this->command->error('Failed to seed recipes batch 2: ' . $e->getMessage());
        }
    }
}
