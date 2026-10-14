<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     * 
     * Seeds the herbal medicine application with:
     * - 12 common herbal plants
     * - 20 diseases (as per requirements)
     * - Herbal recipes with ingredients and steps for each disease
     */
    public function run(): void
    {
        $this->command->info('🌿 Starting Herbal Medicine Database Seeding...');
        
        // 0. Seed Admin User FIRST
        $this->command->info('📌 Creating admin user...');
        $this->call(AdminUserSeeder::class);
        
        // 1. Seed Plants (12 herbal plants)
        $this->command->info('📌 Seeding plants...');
        $this->call(PlantSeeder::class);
        
        // 2. Seed Diseases (20 diseases)
        $this->command->info('📌 Seeding diseases...');
        $this->call(DiseaseSeeder::class);
        
        // 3. Seed Herbal Recipes with Ingredients and Steps
        $this->command->info('📌 Seeding herbal recipes (batch 1/4)...');
        $this->call(HerbalRecipeSeeder::class);
        
        $this->command->info('📌 Seeding herbal recipes (batch 2/4)...');
        $this->call(HerbalRecipeSeeder2::class);
        
        $this->command->info('📌 Seeding herbal recipes (batch 3/4)...');
        $this->call(HerbalRecipeSeeder3::class);
        
        $this->command->info('📌 Seeding herbal recipes (batch 4/4)...');
        $this->call(HerbalRecipeSeeder4::class);
        
        $this->command->info('✅ Database seeding completed successfully!');
        $this->command->info('🌿 Summary:');
        $this->command->info('   - Admin User: 1 (admin@herbal.com / password)');
        $this->command->info('   - Plants: 12 herbal plants');
        $this->command->info('   - Diseases: 20 common diseases');
        $this->command->info('   - Recipes: 20+ herbal recipes with ingredients & steps');
    }
}
