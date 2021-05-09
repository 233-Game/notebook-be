<?php


namespace App\Http\Controllers\Api\Note;


use App\Application\NoteTree\GetListApplication;
use App\Http\Controllers\Controller;
use App\Models\NoteTree;
use Illuminate\Http\Request;

class NoteTreeController extends Controller
{

    public function getList(GetListApplication $application): \Illuminate\Http\JsonResponse
    {
        return $this->formatApplication($application->execute());
    }

    public function create(Request $request){
        $request->only(['pid','name','type']);
    }

    public function delete(NoteTree $tree): \Illuminate\Http\JsonResponse
    {
        return  $this->formatDelete($tree->delete());
    }

    public function update(Request $request){
        $data = $request->only(['pid','name','type']);

    }

}
