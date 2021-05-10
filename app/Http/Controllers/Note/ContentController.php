<?php


namespace App\Http\Controllers\Note;


use App\Application\Source\CreateContentApplication;
use App\Application\Source\UpdateContentApplication;
use App\Http\Controllers\Controller;
use App\Http\Requests\SourceRequest;
use App\Http\Resources\SourceListResource;
use App\Http\Resources\SourceResource;
use App\Models\Source;
use Illuminate\Http\Request;

class ContentController extends Controller
{

    public function getList(): \Illuminate\Http\JsonResponse
    {
        $data = Source::select('id', 'user_id', 'title','size','created_at','updated_at')->where('user_id', auth()->id())->paginate();
        return $this->success(new SourceListResource($data));
    }

    public function create(SourceRequest $request, CreateContentApplication $contentApplication): \Illuminate\Http\JsonResponse
    {
        $data = $request->only(['title', 'content']);
        return $this->formatApplication($contentApplication->setParameter($data)->execute());
    }

    public function update($id, SourceRequest $request, UpdateContentApplication $updateContentApplication): \Illuminate\Http\JsonResponse
    {
        $data = $request->only(['title', 'content']);
        return $this->formatApplication($updateContentApplication->setParameter($id, $data)->execute());
    }

    public function delete($source): \Illuminate\Http\JsonResponse
    {
        return $this->formatDelete(Source::where('id',$source)->delete());
    }

    public function show(Source $source): \Illuminate\Http\JsonResponse
    {
        return $this->success(new SourceResource($source));
    }

}
