<?php

namespace App\Http\Controllers\Admin;

use App\Models\TmpImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class TmpImageUploadController extends Controller
{
    public function store(Request $request)
    {
        if($request->hasFile('image') || $request->hasFile('avatar')) 
        {
            $image = $request->image ?? $request->avatar;

            $image_name = $image->hashName(); // hashed name of an image ( Unique)

            $image->storeAs('tmp', $image_name, 'public'); // store to the default storage driver temporarily

            TmpImage::create(['filename' => $image_name]);

            return $image_name;
        }

        return 'not found';
    }

    public function revert(Request $request)
    {
        $image = $request->getContent();

        Storage::disk('public')->delete("tmp/$image"); // remove from the tmp folder
        TmpImage::where('filename', $image)->delete(); // remove from the tmp db tbl
    }
}
