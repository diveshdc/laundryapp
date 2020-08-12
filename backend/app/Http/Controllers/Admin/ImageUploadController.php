<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
class ImageUploadController extends Controller
{
    public function store(Request $request)
    {
        {
        request()->validate([
            'image' => 'required',
        ]);
 
        if ($files = $request->file('image')) {
                $image=$request->file('image');
                $parts = pathinfo($image->getClientOriginalName());
                $extension = strtolower($parts['extension']);
                $imageName = uniqid() . mt_rand(999, 9999) . '.' . $extension;
                $imagePath = '/images/profile_picture/';
                $returnImagePath =  url('/').$imagePath.$imageName;
                $image->move(public_path() .$imagePath , $imageName);
                User::where('id',$request['user_id'])->update([
                  'image_upload' =>$returnImagePath
                ]);
                    return Response()->json([
                    "success" => true,
                    "image" => $returnImagePath
                  ]);
            }
            return Response()->json([
                    "success" => false,
                    "image" => ''
                ]);
    }
}

}
