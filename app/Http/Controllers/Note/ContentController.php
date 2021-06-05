<?php


namespace App\Http\Controllers\Note;


use App\Application\Source\CreateContentApplication;
use App\Application\Source\GetSourceListApplication;
use App\Application\Source\UpdateContentApplication;
use App\Enums\Source\SourceStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\SourceRequest;
use App\Http\Resources\SourceListResource;
use App\Http\Resources\SourceResource;
use App\Models\Source;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContentController extends Controller
{

    public function getList(Request $request,GetSourceListApplication $sourceListApplication): \Illuminate\Http\JsonResponse
    {
        $uid = Auth::id();
        $tagId = $request->get('tag_id', 0);
        $notebookId = $request->get('notebook_id', 0);
        $search = $request->get('search');
        return $this->success(new SourceListResource($sourceListApplication->setParameter($uid,$notebookId,$tagId,$search)->execute()));

    }

    public function create(SourceRequest $request, CreateContentApplication $contentApplication): \Illuminate\Http\JsonResponse
    {
        $data = $request->only(['title', 'content']);
        return $this->formatApplication($contentApplication->setParameter($data)->execute());
    }

    public function update($id, Request $request, UpdateContentApplication $updateContentApplication): \Illuminate\Http\JsonResponse
    {
        $data = $request->only(['title', 'content']);
        return $this->formatApplication($updateContentApplication->setParameter($id, array_filter($data))->execute());
    }

    /**
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function delete($source): \Illuminate\Http\JsonResponse
    {
        $source = Source::where('id', $source);
        $this->authorize('delete', $source);
        return $this->formatDelete($source->delete());
    }

    /**
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show($source): \Illuminate\Http\JsonResponse
    {
        $source = Source::with('tags', 'notebook')->find($source);
        $this->authorize('view', $source);
        return $this->success(new SourceResource($source, false));
    }

    public function collect(Source $source): \Illuminate\Http\JsonResponse
    {
        return $this->format($source->update(['status'=>SourceStatus::COLLECTED]));
    }

    public function unCollect(Source $source): \Illuminate\Http\JsonResponse
    {
        return $this->format($source->update(['status'=>SourceStatus::DEFAULT]));
    }

}
