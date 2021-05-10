<?php


namespace App\Http\Controllers\Note;


use App\Application\NoteTree\GetListApplication;
use App\Http\Controllers\Controller;
use App\Http\Requests\NoteTreeRequest;
use App\Models\NoteTree;
use Illuminate\Http\Request;

class NoteTreeController extends Controller
{

    public function getList(GetListApplication $application): \Illuminate\Http\JsonResponse
    {
        return $this->formatApplication($application->execute());
    }

    public function create(NoteTreeRequest $request){
        $data = $request->only(['pid','name','type']);
    }

    public function delete(NoteTree $tree): \Illuminate\Http\JsonResponse
    {
        return  $this->formatDelete($tree->delete());
    }

    public function show(){

    }

    public function update($id,NoteTreeRequest $request){
        $data = $request->only(['pid','name','type']);

    }

}
