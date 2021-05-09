<?php


namespace App\Http\Controllers\Api\Note;


use App\Http\Controllers\Controller;
use App\Http\Requests\NotebookRequest;
use App\Models\NoteBook;

class NoteBookController extends Controller
{

    public function create(NotebookRequest $notebookRequest): \Illuminate\Http\JsonResponse
    {
        $data = $notebookRequest->only(['name', 'cover', 'desc']);

        return $this->success([
            'notebook' => NoteBook::create($data)
        ]);
    }

    public function update(NoteBook $noteBook, NotebookRequest $notebookRequest)
    {
        $data = $notebookRequest->only(['name', 'cover', 'desc']);

        return $this->success([
            'notebook' => $noteBook->update($data)
        ]);
    }


    public function getList()
    {
        $list = NoteBook::paginate();
        return $this->success($list);
    }

    public function show(NoteBook $noteBook)
    {
        return $this->success($noteBook);
    }

}
