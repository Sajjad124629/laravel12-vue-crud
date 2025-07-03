<?php 
namespace App\Traits;

trait ImageStorageTraits{
    public function uploadImage($requestedImage, $path, $key=0) {
        $file = $requestedImage;
        $filename = time() . '_' . date('Ymdhis') .$key. '.' . $file->getClientOriginalExtension();
        $imageName = $file->storeAs($path, $filename, 'public');
        return $imageName;
    }
    public function uploadUpdateImage($olderImage, $requestedImage, $path, $key = 0) {
        
        if ($olderImage && file_exists('storage/' . $olderImage)) {
            unlink('storage/' . $olderImage);
        }
        $file = $requestedImage;
        $filename = time() . '_' . date('Ymdhis') .$key. '.' . $file->getClientOriginalExtension();
        $imageName = $file->storeAs($path, $filename, 'public');
        return $imageName;
    }
} 