<?php

namespace ARsig\Http\Controllers\Api;

use ARsig\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;


class UploadController extends Controller
{
    public function __construct()
    {
//        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request, $dir)
    {
        $input = $request->all();

        $rules = [];

        $rules['file'] = 'file|max:50000';

        $validation = Validator::make($input, $rules);

        if ($validation->fails())
        {
            return \response()->make($validation->errors()->all(), 400);
        }

        $file = $request->file('file');

        $extension = $file->getClientOriginalExtension();
        $mime = $file->getClientMimeType();
        $size = $file->getSize();

        $directory = '';

        if ($dir != ''){
            $directory = $dir.'/';
        }
//        $directory = storage_path('public\uploads').sha1(time());
        $filename = sha1($file->getFilename().time()).".{$extension}";
//        $filename = $file->getClientOriginalName();

//        dd($file);


        $upload_success =  $file->storeAs('public/'.$directory, $filename);


        switch ($mime) {
            case 'image/jpg':
            case 'image/jpeg':
            case 'image/png':

                // criar rotina de thumbs
                $thumb = Image::make($file)->resize(255, null, function ($constraint) {
                    $constraint->aspectRatio();
                });

                Storage::disk('public')->makeDirectory('thumbnail/' . $directory);

                $thumb->save('storage/thumbnail/' . $directory . $filename);

            ////**************** fim thumbs

        }

        $result = [
            'arquivo' => $directory.$filename,
            'filename' => $filename,
            'mime' => $mime,
            'size' => $size,
        ];

//        dd($result);

        if( $upload_success ) {
            return $result;
        } else {
            return \response()->json('error', 400);
        }
    }


    public function destroy(Request $request)
    {
        $arquivos = $request->all();

//        dd($arquivos);

        $result = Storage::disk('public')->delete($arquivos);

        foreach ($arquivos as  $key => $arquivo) {
            $arquivos[$key] = 'thumbnail/'.$arquivo;
        }

//        dd($arquivos);
        $result = Storage::disk('public')->delete($arquivos);



//        foreach ($arquivos as $arquivo){
//            $result = Storage::delete($arquivo);
//        }

        if($result){
            return \response()->json('Arquivos excluidos', 200);
        }else{
            return \response()->json('Erro ao excluir arquivos', 400);
        }
    }
}
