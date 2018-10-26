<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UploadFileController extends Controller
{
    //
        public function create(Request $request)
        {

            return view('uploadfile');
        }

        public function store(Request $request)
        {
            $this->validate($request, [
                'gambar' => 'required|mimes:jpg,png,jpeg,giv'
            ]);
        }
}
