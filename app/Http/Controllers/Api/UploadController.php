<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UploadImageRequest;
use App\Models\Stroage;
use Illuminate\Support\Facades\Storage;
use Image;
use Spatie\LaravelImageOptimizer\Facades\ImageOptimizer;

class UploadController extends Controller
{
    public function __construct()
    {
        $this->middleware('optimizeImages');
    }

    public function editorImage(UploadImageRequest $request){
        $request->validated();

        $uploadFolder = $request->folderName ?? 'other';
        $image = $request->file('image');
        $fileSize = Image::make($image)->filesize();
        $thumbnail = Image::make($image)->resize(320,240);
        ImageOptimizer::optimize($image);
        $imageUploadedPath = $image->store($uploadFolder, 'public');

        $imageUrl = Storage::disk('public')->url($imageUploadedPath);

        $uploadedImageResponse = array(
            "image_name" => basename($imageUploadedPath),
            'image_uploaded_path' => $imageUploadedPath,
            "image_url" => $imageUrl,
            "mime" => $image->getClientMimeType(),
            'file_size' => $fileSize,
        );
        Stroage::create($uploadedImageResponse);

        return response()->json(['message' => 'Resim yükleme işlemi başarılı','messageType' => 'success','status' => 200,'data' => $uploadedImageResponse],200);

    }
}
