<?php


namespace App\Http\Controllers\Api\Note;


use App\Application\Source\CreateContentApplication;
use App\Application\Source\UpdateContentApplication;
use App\Http\Controllers\Controller;
use App\Http\Resources\SourceResource;
use App\Models\Source;
use Illuminate\Http\Request;

class ContentController extends Controller
{

    public function getList(){
        // 分页获取当前用户下所有的信息
    }

    public function create(Request $request, CreateContentApplication $contentApplication): \Illuminate\Http\JsonResponse
    {
        $data = $request->only(['title','content', 'type', 'notebook_id']);
        return $this->formatApplication($contentApplication->setParameter($data)->execute());
    }

    public function update(Request $request,UpdateContentApplication $updateContentApplication): \Illuminate\Http\JsonResponse
    {
        $data = $request->only(['id','title','content', 'type', 'notebook_id']);
        return $this->formatApplication($updateContentApplication->setParameter($data)->execute());
    }

    public function delete(Source $source): \Illuminate\Http\JsonResponse
    {
        return $this->formatDelete($source->delete());
    }

    public function show(Source $source): \Illuminate\Http\JsonResponse
    {
        return $this->success(new SourceResource($source));
    }

}
