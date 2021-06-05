<?php

namespace App\Http\Controllers\Note;

use App\Application\Tag\BindSourceApplication;
use App\Application\Tag\UnBindSourceApplication;
use App\Http\Controllers\Controller;
use App\Http\Requests\TagBindRequest;
use App\Http\Requests\TagRequest;
use App\Http\Resources\SourceListResource;
use App\Http\Resources\TagResource;
use App\Http\Resources\TagsListResource;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TagsController extends Controller
{
    public function create(TagRequest $tagRequest): \Illuminate\Http\JsonResponse
    {
        $data = $tagRequest->only(['name', 'desc']);
        $data['user_id'] = Auth::id();
        return $this->success(Tag::create($data));
    }

    public function bind(TagBindRequest $tagBindRequest, BindSourceApplication $bindSourceApplication): \Illuminate\Http\JsonResponse
    {
        $tag_id = $tagBindRequest->get('tag_id');
        $source_id = $tagBindRequest->get('source_id');
        return $this->formatApplication($bindSourceApplication->setParameter($tag_id, $source_id)->execute());
    }

    public function unbind(TagBindRequest $tagBindRequest, UnBindSourceApplication $unBindSourceApplication): \Illuminate\Http\JsonResponse
    {
        $tag_id = $tagBindRequest->get('tag_id');
        $source_id = $tagBindRequest->get('source_id');
        return $this->formatApplication($unBindSourceApplication->setParameter($tag_id, $source_id)->execute());
    }

    public function delete(Tag $tag): \Illuminate\Http\JsonResponse
    {
        $this->authorize('delete',$tag);
        return $this->formatDelete($tag->delete());
    }

    /**
     * @param Tag $tag
     * @param Request $tagRequest
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Tag $tag, TagRequest $tagRequest): \Illuminate\Http\JsonResponse
    {
        $this->authorize('update',$tag);
        $tag->update($tagRequest->only(['name','desc']));
        return $this->success($tag);
    }

    public function getList(): \Illuminate\Http\JsonResponse
    {
        $tags = Tag::where('user_id', Auth::id())->get();
        return $this->success(TagResource::collection($tags));
    }

    public function showSources(Request $request){
        // 分页返回tag下的所有
        $tag = Tag::find($request->input('id',0));
        $this->authorize('view',$tag);
        $sources = $tag->sources()->paginate();
        return new SourceListResource($sources);
    }

    public function getSourceByTag(){

    }

}
