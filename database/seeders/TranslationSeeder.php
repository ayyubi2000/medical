<?php

namespace Database\Seeders;

use App\Models\Translation;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TranslationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        try {
            $translations = [
                [
                    "key"=> "We are on Facebook",
                    "uz"=> "We are on Facebook",
                    "en"=> "We are on Facebook",
                    "ru"=> "We are on Facebook",
                ],
                [
                    "key"=> "shop",
                    "uz"=> "shop",
                    "en"=> "shop",
                    "ru"=> "shop",
                ],
                [
                    "key"=> "ABOUT COMPANY",
                    "uz"=> "ABOUT COMPANY",
                    "en"=> "ABOUT COMPANY",
                    "ru"=> "ABOUT COMPANY",
                ],
            ];

            foreach ($translations as $translation) {
                Translation::firstOrCreate([
                    'key' => $translation['key'],
                    'uz' => $translation['uz'],
                    'ru' => $translation['ru'],
                    'en' => $translation['en'],
                ]);
            }
        }
        catch (\Exception $e) {
             dump($e->getMessage());
        }
    }
}
