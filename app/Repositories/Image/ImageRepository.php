<?php
namespace App\Repositories\Image;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use App\Repositories\BaseRepository;
use App\Image;

class ImageRepository extends BaseRepository implements ImageRepositoryInterface
{
    /**
     * @var Image
     */
    protected $model;

    /**
     * ImageRepository constructor.
     *
     * @param Image $model
     */
    public function __construct(Image $model)
    {
        parent::__construct($model);
    }

    public function upload($form_data, $roomId = 1)
    {
        // $validator = Validator::make($form_data, Image::$rules, Image::$messages);
        // if ($validator->fails()) {

        //     return response()->json([
        //         'error' => true,
        //         'message' => $validator->messages()->first(),
        //         'code' => 400
        //     ], 400);
        // }
        $path = 'uploads/images/' . date('Y') . "/" . date('m') . "/";

        if (!file_exists($path) && !is_dir($path)) {
            File::makeDirectory($path, $mode = 0777, true, true);
        }

        $photo = $form_data['file'];
        $originalName = $photo->getClientOriginalName();
        $originalNameWithoutExt = substr($originalName, 0, strlen($originalName) - 4);
        $filename = $this->sanitize($originalNameWithoutExt);
        $allowed_filename = $this->createUniqueFilename($filename, $path);
        $filenameExt = $allowed_filename . ".jpg";
        $uploadSuccess1 = $this->original($photo, $filenameExt, $path);

        if (!$uploadSuccess1) {
            return response()->json([
                'error' => true,
                'message' => 'Server error while uploading',
                'code' => 500
            ], 500);
        }

        $sessionImage = new Image;
        $sessionImage->original_name = $originalName;
        $sessionImage->name          = $allowed_filename;
        $sessionImage->slug          = $path . Config::get('images.icon_size') . '-' . $filenameExt;
        $sessionImage->link          = $path . Config::get('images.full_size') . '-' . $filenameExt;
        $sessionImage->room_id       = $roomId;

        $sessionImage->save();

        return response()->json([
            'error' => false,
            'code'  => 200
        ], 200);
    }

    public function delete($originalFilename)
    {
        $image = Image::where('original_name', 'like', $originalFilename)->first();
        if (empty($sessionImage)) {
            return response()->json([
                'error' => true,
                'code'  => 400
            ], 400);
        }
        if (empty($image)) {
            return response()->json([
                'error' => true,
                'code'  => 400
            ], 400);
        }

        $full_path = $image->original_name;

        if (File::exists($full_path)) {
            File::delete($full_path);
        }

        $image->delete();

        return response()->json([
            'error' => false,
            'code'  => 200
        ], 200);
    }

    public function createUniqueFilename($filename, $path)
    {
        $full_image_path =  $path . Config::get('images.full_size') . '-' . $filename . '.jpg';

        if (File::exists($full_image_path)) {
            // Generate token for image
            $imageToken = substr(sha1(mt_rand()), 0, 6);
            return $filename . '-' . $imageToken;
        }
        return $filename;
    }

    /**
     * Optimize Original Image
     */
    public function original($photo, $filename, $path)
    {
        $manager = new ImageManager();
        $image = $manager->make($photo)->encode('jpg')->save($path . Config::get('images.full_size') . '-' . $filename);
        return $image;
    }

    public function sanitize($string, $force_lowercase = true, $anal = false)
    {
        $strip = array(
            "~", "`", "!", "@", "#", "$", "%", "^", "&", "*", "(", ")", "_", "=", "+", "[", "{", "]",
            "}", "\\", "|", ";", ":", "\"", "'", "&#8216;", "&#8217;", "&#8220;", "&#8221;", "&#8211;", "&#8212;",
            "â€”", "â€“", ",", "<", ".", ">", "/", "?"
        );
        $clean = trim(str_replace($strip, "", strip_tags($string)));
        $clean = preg_replace('/\s+/', "-", $clean);
        $clean = ($anal) ? preg_replace("/[^a-zA-Z0-9]/", "", $clean) : $clean;

        return ($force_lowercase) ? (function_exists('mb_strtolower')) ?
            mb_strtolower($clean, 'UTF-8') : strtolower($clean) : $clean;
    }
}
