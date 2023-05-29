<?php

namespace App\Http\Controllers;

use Storage;
use App\Models\Item;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ImageController extends Controller
{
    public function imageUpload(Request $request,  Item $item)
    {
        if (!empty($request->file())) {
            $this->validate($request, ['upload' => 'required|image|max:10240|mimes:jpeg,jpg,gif,bmp,png']);

            $item     = Item::where('id', $request->id);
            $itemData = $item->first();
    
            if ($itemData->img !== '') {
                if(Storage::exists('public/'.$itemData->img)){
                    Storage::delete([
                        'public/'.$itemData->img, 
                        'public/'.$itemData->thumb
                    ]);
                }
            }
            
            $image     = $request->file('upload');
            $imageName = time() . $image->getClientOriginalName();

            $image->storeAs('public/uploaded', $imageName);
            $image->storeAs('public/uploaded/thumbnail', $imageName);

            $imagePath     = 'uploaded/' . $imageName;
            $thumbPath     = 'uploaded/thumbnail/' . $imageName;
            $thumbnailPath = public_path('storage/uploaded/thumbnail/'. $imageName);
            $thumbnail     = Image::make($thumbnailPath)->resize(150, 150);

            $thumbnail->save($thumbnailPath);

            $item->update([
                'img'   => $imagePath,
                'thumb' => $thumbPath
            ]);
        }

        return redirect()->back();
    }

    public function removeImage($id) 
    {
        $item     = Item::where('id', $id);
        $itemData = $item->first();

        if ($itemData->img !== '') {
            if(Storage::exists('public/'.$itemData->img)){
                Storage::delete([
                    'public/'.$itemData->img, 
                    'public/'.$itemData->thumb
                ]);
            }
        }

        $item->update([
            'img'   => "",
            'thumb' => ""
        ]);

        return redirect()->back();
    }
}
