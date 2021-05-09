<?php


namespace App\Http\Controllers\Base;


use App\Http\Controllers\Controller;
use App\Http\Requests\Base\UploadRequest;

class UploadController extends Controller
{
    public function __invoke(UploadRequest $request)
    {
        // 上传控制器
        $files = $request->get('files');
        if (is_array($files)) {

        } else {

        }
    }

}
