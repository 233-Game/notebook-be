<?php


namespace App\Http\Controllers\Note;


use App\Application\Notebook\ForkNoteBookApplication;
use App\Application\Notebook\SourceBindNotebookApplication;
use App\Application\Notebook\SourceCreateByNotebookApplication;
use App\Http\Controllers\Controller;
use App\Http\Requests\NotebookRequest;
use App\Http\Requests\SourceBindNotebookRequest;
use App\Http\Resources\NotebookListResource;
use App\Http\Resources\NotebookResource;
use App\Models\NoteBook;
use Illuminate\Http\Request;

class NoteBookController extends Controller
{

    /**
     * @param Request $request
     * @param SourceCreateByNotebookApplication $createByNotebookApplication
     * @return \Illuminate\Http\JsonResponse
     */
    public function createSource(Request $request, SourceCreateByNotebookApplication $createByNotebookApplication): \Illuminate\Http\JsonResponse
    {
        return $this->formatApplication(
            $createByNotebookApplication->setParameter($request->input('notebook_id'), $request->only(['title', 'content']))
        );
    }

    /**
     * @param NotebookRequest $notebookRequest
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(NotebookRequest $notebookRequest): \Illuminate\Http\JsonResponse
    {
        $data = $notebookRequest->only(['name', 'cover', 'desc']);
        $data['user_id'] = auth()->id();
        return $this->format(NoteBook::create($data));
    }

    /**
     * @param NoteBook $noteBook
     * @param NotebookRequest $notebookRequest
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(NoteBook $noteBook, Request $notebookRequest): \Illuminate\Http\JsonResponse
    {
        $data = $notebookRequest->only(['name', 'cover', 'desc']);
        $this->authorize('update', $noteBook);
        return $this->format($noteBook->update($data));
    }

    /**
     * @param NoteBook $noteBook
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function delete(NoteBook $noteBook): \Illuminate\Http\JsonResponse
    {
        $this->authorize('delete', $noteBook);
        return $this->formatDelete($noteBook->delete());
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getList(Request $request): \Illuminate\Http\JsonResponse
    {
        $list = NoteBook::where('user_id', auth()->id());
        if (!empty($search = $request->get('search'))) {
            $list->where(function ($query) use ($search) {
                return $query->where('name', "%$search%")->orWhere('desc', "%$search");
            });
        }
        $list = $list->paginate();
        return $this->success(new NotebookListResource($list));
    }

    /***
     * @param NoteBook $noteBook
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show(NoteBook $noteBook): \Illuminate\Http\JsonResponse
    {
        $this->authorize('view', $noteBook);
        return $this->success(new NotebookResource($noteBook));
    }

    /**
     * 绑定笔记到笔记本
     * @param SourceBindNotebookRequest $request
     * @param SourceBindNotebookApplication $sourceBindNotebookApplication
     * @return \Illuminate\Http\JsonResponse
     */
    public function bindSource(SourceBindNotebookRequest $request, SourceBindNotebookApplication $sourceBindNotebookApplication): \Illuminate\Http\JsonResponse
    {
        return $this->formatApplication(
            $sourceBindNotebookApplication->setParameter($request->get('notebook_id'), $request->get('source_id'))->execute()
        );
    }

    public function unbindSource(SourceBindNotebookRequest $request, SourceBindNotebookApplication $sourceBindNotebookApplication): \Illuminate\Http\JsonResponse
    {
        return $this->success( $request->get('source_id'));
    }

    public function fork(Request $request, ForkNoteBookApplication $forkNoteBookApplication)
    {

    }

    public function star()
    {

    }

}
