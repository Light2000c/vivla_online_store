<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        $storagePath = storage_path('app/public/products');

        // Create the directory if it doesn't exist
        if (!file_exists($storagePath)) {
            mkdir($storagePath, 0755, true);
        }

        $categories = Category::all()->pluck('name')->toArray();

        foreach (range(1, 50) as $index) {
            $imageName = time() . '-' . Str::slug($faker->word) . '.jpg';
            $imagePath = $storagePath . '/' . $imageName;

            // Debugging: Check if image path is generated correctly
            $this->command->info("Attempting to create image at path: $imagePath");

            $imageContents = $this->createDummyImage($imagePath);

            // Debugging: Check if the image file exists after creation
            if (File::exists($imagePath)) {
                // Store the image in the public storage
                Storage::disk('public')->put('products/' . $imageName, $imageContents);

                // Debugging: Confirm the image was stored successfully
                $this->command->info("Image stored successfully at: storage/products/$imageName");

                // Delete the temporary image file after storing it
                File::delete($imagePath);

                $categoryName = $faker->randomElement($categories);

                // Create a product with the image name stored
                Product::create([
                    'name' => $faker->word,
                    'price' => $faker->numberBetween(10, 1000),
                    'discount' => $faker->numberBetween(0, 50),
                    'quantity' => $faker->numberBetween(1, 50),
                    'category' => $categoryName,
                    'tag' => implode(',', $faker->words(3)),
                    'image' => 'products/' . $imageName, // Store path relative to 'public' disk
                    'description' => $faker->sentence,
                ]);
            } else {
                // Debugging: Log an error if image file was not created
                $this->command->error("Image file not created at path: $imagePath");
            }
        }
    }

    private function createDummyImage($path)
    {
        // Create a blank image
        $image = imagecreatetruecolor(640, 480);
        $bgColor = imagecolorallocate($image, 255, 255, 255);
        imagefill($image, 0, 0, $bgColor);

        $textColor = imagecolorallocate($image, 0, 0, 0);
        imagestring($image, 5, 50, 50, 'Dummy Image', $textColor);

        // Capture the output buffer
        ob_start();
        imagejpeg($image);
        $contents = ob_get_clean();
        imagedestroy($image);

        // Write the image to the path specified
        if (file_put_contents($path, $contents) === false) {
            // Debugging: Log an error if writing the image fails
            $this->command->error("Failed to write image file at path: $path");
        }

        return $contents;
    }
}
