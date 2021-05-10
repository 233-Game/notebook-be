<?php


namespace App\Http\Controllers\Note;


use App\Application\Notebook\SourceCreateByNotebookApplication;
use App\Http\Controllers\Controller;
use App\Http\Requests\NotebookRequest;
use App\Http\Resources\NotebookListResource;
use App\Http\Resources\NotebookResource;
use App\Models\NoteBook;
use Illuminate\Http\Request;

class NoteBookController extends Controller
{
    public function createSource(Request $request, SourceCreateByNotebookApplication $createByNotebookApplication): \Illuminate\Http\JsonResponse
    {
        return $this->formatApplication(
            $createByNotebookApplication->setParameter($request->input('notebook_id'), $request->only(['title', 'content']))
        );
    }

    public function create(NotebookRequest $notebookRequest): \Illuminate\Http\JsonResponse
    {
        $data = $notebookRequest->only(['name', 'cover', 'desc']);
        $data['user_id'] = auth()->id();
        return $this->format(NoteBook::create($data));
    }

    public function update(NoteBook $noteBook, NotebookRequest $notebookRequest): \Illuminate\Http\JsonResponse
    {
        $data = $notebookRequest->only(['name', 'cover', 'desc']);
        return $this->format($noteBook->update($data));
    }

    public function delete(NoteBook $noteBook): \Illuminate\Http\JsonResponse
    {
        return $this->formatDelete($noteBook->delete());
    }

    public function getList(): \Illuminate\Http\JsonResponse
    {
        $list = NoteBook::where('user_id', auth()->id())->paginate();
        return $this->success(new NotebookListResource($list));
    }

    public function show(NoteBook $noteBook): \Illuminate\Http\JsonResponse
    {
        return $this->success(new NotebookResource($noteBook));
    }

    public function fork(){
        // 拷贝数据，并且创建fork任务

    }

}
