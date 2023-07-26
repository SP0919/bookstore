<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SubCategories;

use File;
use Image;

class SubCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $filename1 = public_path('assets/js/category.json');
        $data1 = file_get_contents($filename1);
        $array1 = json_decode($data1, true);
        $filename2 = public_path('assets/js/subcategory.json');
        $data2 = file_get_contents($filename2);
        $array2 = json_decode($data2, true);

        $destination = "/images/subcategories/images";
        $destinationThumb = "/images/subcategories/thumbnail";
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
        for ($j = 0; $j < count($array1); $j++) {
            for ($i = 0; $i < count($array2); $i++) {
                if ($array1[$j]['slug'] == $array2[$i]['slug']) {

                    $fileds = [];
                    $image = public_path('assets/defaultImage/subcategory/') . $array2[$i]['image'];
                    $imageName = time() . date('ymd')  . '.' . 'png';
                    $img = Image::make($image);
                    $img->resize(100, 100, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($destinationPathThumbnail . '/' . $imageName);
                    $img = Image::make($image);
                    $img->save($destinationPath . '/' . $imageName);
                    $input[] = $fileds;
                    SubCategories::create([
                        'title' => $array2[$i]['title'],
                        'category_id' => $array1[$j]['id'],
                        'image_url' => $destination . '/' . $imageName,
                        'thumb_url' => $destinationThumb . '/' . $imageName,
                    ]);
                    sleep(1);
                }
            }
        }
    }
}
