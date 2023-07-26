<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Categories;
use File;
use Image;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $filename = public_path('assets/js/category.json');
        $data = file_get_contents($filename);
        $array = json_decode($data, true);

        $destination = "/images/categories/images";
        $destinationThumb = "/images/categories/thumbnail";
        $destinationPathThumbnail = public_path($destinationThumb);
        if (!File::exists($destinationPathThumbnail)) {

            File::makeDirectory($destinationPathThumbnail, 777, true, true);
        } else {
            File::cleanDirectory($destinationPathThumbnail);
        }
        $destinationPath = public_path($destination);
        if (!File::exists($destinationPath)) {

            File::makeDirectory($destinationPath, 777, true, true);
        } else {
            File::cleanDirectory($destinationPath);
        }
        $input = [];
        for ($i = 0; $i < count($array); $i++) {
            $fileds = [];
            $image = public_path('assets/defaultImage/category/') . $array[$i]['image'];
            $imageName = time() . date('ymd')  . '.' . 'png';
            $img = Image::make($image);
            $img->resize(100, 100, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPathThumbnail . '/' . $imageName);
            $img = Image::make($image);
            $img->save($destinationPath . '/' . $imageName);
            $input[] = $fileds;
            Categories::create([
                'title' => $array[$i]['title'],
                'image_url' => $destination . '/' . $imageName,
                'thumb_url' => $destinationThumb . '/' . $imageName,
            ]);
            sleep(1);
        }
    }
}
