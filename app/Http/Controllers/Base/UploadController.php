<?php


namespace App\Http\Controllers\Base;


use App\Http\Controllers\Controller;
use App\Http\Requests\Base\UploadRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class UploadController extends Controller
{

    protected $allowed_ext = ['png', 'jpg', 'gif', 'jpeg', 'mp3', 'wav'];

    public function save($file, $folder, $file_prefix)
    {
        // 构建存储的文件夹规则，值如：uploads/images/avatars/201709/21/
        // 文件夹切割能让查找效率更高。
        $folder_name = "uploads/$folder/" . date('Ym/d', time());

        // 文件具体存储的物理路径，`public_path()` 获取的是 `public` 文件夹的物理路径。
        $upload_path = public_path() . '/' . $folder_name;

        // 获取文件的后缀名，因图片从剪贴板里黏贴时后缀名为空，所以此处确保后缀一直存在
        $extension = strtolower($file->getClientOriginalExtension()) ?: 'png';

        $filename = $file_prefix . '_' . time() . '_' . Str::random(10) . '.' . $extension;
        // 如果上传的不是图片将终止操作
        if (!in_array($extension, $this->allowed_ext)) {
            return false;
        }
        // 将图片移动到我们的目标存储路径中
        $file->move($upload_path, $filename);

        return "/$folder_name/$filename";
    }

    public function __invoke(Request $request, $type = ''): \Illuminate\Http\JsonResponse
    {
        $uid = Auth::id();
        switch ($type) {
            case 'vditor':
                return $this->vditor($request->file('file'), $uid);
            default:
                return $this->default($request->file('files'), $uid);
        }
    }

    private function default($files, $uid): \Illuminate\Http\JsonResponse
    {
        $res = [];
        if (is_array($files)) {
            foreach ($files as $file) {
                $res[$file->getClientOriginalName()] = $this->save($file, md5('default' . $uid), $uid . '_');
            }
        } else {
            $res[$files->getClientOriginalName()] = $this->save($files, md5('default' . $uid), $uid . '_');
        }

        return $this->success($res);
    }


    private function vditor($files, $uid): \Illuminate\Http\JsonResponse
    {
        $successFile = [];
        $errFile = [];
        foreach ($files as $file) {
            if ($url = $this->save($file, md5('vditor' . $uid), $uid . '_')) {
                $successFile[$file->getClientOriginalName()] = $url;
            } else {
                $errFile[] = $file->getClientOriginalName();
            }
        }
//        dd($res);
        return $this->json([
            'msg' => '',
            'code' => 0,
            'data' => [
                'errFiles' => $errFile,
                'succMap' => $successFile
            ]
        ]);
    }

}
