<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\DataStoreRequest;
use App\Models\Data;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class TableController extends Controller
{
    public function index($pageNumber)
    {
        $data = Data::paginate(10, ['*'], 'page', $pageNumber)->makeHidden(['file','created_at']);
        return response()->json($data,200);
    }

    public function findById($id)
    {
        $data = Data::where('id',$id)->first()->makeHidden(['created_at']);
        return response()->json($data,200);
    }

    public function store(DataStoreRequest $request)
    {
        
        $data = new Data();

        $data->name = $request->name;
        $data->description = $request->description;
        $data->type = $request->type;
        $data->file = Storage::put('uploads', $request->file, 'private');
        
        // $data->file = $request->file('file')->store('uploads');
        // $data->file = Storage::temporaryUrl('uploads', now()->addMinutes(10));

       


        if($data->save())
        {
            return response()->json([
                'name' => $data->name,
                'description' => $data->description,
                'type' => $data->type
            ],201);
        }
        else{
            return response()->json([
                'message' => 'Error occured!!!'
            ]);
        }

}
}