<?php


namespace App\Http\Controllers\Note;


use App\Application\NoteTree\GetListApplication;
use App\Http\Controllers\Controller;
use App\Http\Requests\NoteTreeRequest;
use App\Http\Resources\NoteTreeResource;
use App\Models\NoteTree;
use Illuminate\Http\Request;

class NoteTreeController extends Controller
{

    public function getList(GetListApplication $application): \Illuminate\Http\JsonResponse
    {
        return $this->formatApplication($application->execute());
    }

    public function create(NoteTreeRequest $request)
    {
        $data = $request->only(['pid', 'name', 'type']);
        return $this->format(NoteTree::create($data));
    }

    public function delete(NoteTree $tree): \Illuminate\Http\JsonResponse
    {
        return $this->formatDelete($tree->delete());
    }

    public function show($tree)
    {
        $noteTree = NoteTree::with('children', 'sources')->find($tree);
        return new NoteTreeResource($noteTree);
    }

    public function update(NoteTree $tree, NoteTreeRequest $request)
    {
        $data = $request->only(['pid', 'name', 'type']);
        return $this->format($tree->update($data));
    }

}
