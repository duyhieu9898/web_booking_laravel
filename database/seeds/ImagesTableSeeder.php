<?php

use App\Image;
use Illuminate\Database\Seeder;

class ImagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        for ($i = 1; $i <= 100; $i++) {
            Image::create([
                'original_name' => "image {$i}",
                'slug' => "room-image-{$i}.jpg",
                'file_name' => '/images/motel-1.jpg',
                'room_id' => $i,
            ]);
            Image::create([
                'original_name' => "image {$i}",
                'slug' => "room-image-house-{$i}.jpg",
                'file_name' => '/images/house-1.jpg',
                'room_id' => $i,
            ]);

            Image::create([
                'original_name' => "image {$i}",
                'slug' => "room-image-apartment-{$i}.jpg",
                'file_name' => '/images/apartment-1.jpg',
                'room_id' => $i,
            ]);
        }

        for ($i = 101; $i <= 200; $i++) {
            Image::create([
                'original_name' => "image {$i}",
                'slug' => "room-image-{$i}.jpg",
                'file_name' => '/images/house-1.jpg',
                'room_id' => $i,
            ]);
            Image::create([
                'original_name' => "image {$i}",
                'slug' => "room-image-motel-{$i}.jpg",
                'file_name' => '/images/motel-1.jpg',
                'room_id' => $i,
            ]);

            Image::create([
                'original_name' => "image {$i}",
                'slug' => "room-image-apartment-{$i}.jpg",
                'file_name' => '/images/apartment-1.jpg',
                'room_id' => $i,
            ]);
        }

        for ($i = 201; $i <= 300; $i++) {
            Image::create([
                'original_name' => "image {$i}",
                'slug' => "room-image-{$i}.jpg",
                'file_name' => '/images/apartment-1.jpg',
                'room_id' => $i,
            ]);

            Image::create([
                'original_name' => "image {$i}",
                'slug' => "room-image-house-{$i}.jpg",
                'file_name' => '/images/house-1.jpg',
                'room_id' => $i,
            ]);

            Image::create([
                'original_name' => "image {$i}",
                'slug' => "room-image-motel-{$i}.jpg",
                'file_name' => '/images/motel-1.jpg',
                'room_id' => $i,
            ]);
        }
    }
}
