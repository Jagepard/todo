<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ListController extends Controller
{
    public function index()
    {
        $items = Item::where('user_id', '=', Auth::id())->orderBy('id','desc')->paginate(5);

        return view('todo.list', [
            'items' => $items,
            'title' => 'ToDo'
        ]);
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'task' => 'required'
        ]);

        $item = Item::where('id', $request->id);

        $item->update([
            'text' => $request->task,
        ]);

        return redirect()->back();
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'task' => 'required'
        ]);

        $item          = new Item;
        $item->user_id = $request->user;
        $item->text    = $request->task;
        $item->img     = '';
        $item->thumb   = '';
        $item->status  = 1;
        $item->save();

        return response()->json($item);
    }

    public function delete($id)
    {
        $item     = Item::where('id', $id);
        $itemData = $item->first();

        if ($itemData->img !== '') {
            if(Storage::exists('public/'.$itemData->img)){
                Storage::delete([
                    'public/'.$itemData->img, 
                    'public/'.$itemData->thumb
                ]);
            }
        }

        $item->delete();

        return redirect()->back();
    }

    public function search(Request $request) 
    {
        $items = Item::search($request, Auth::id());

        return view('todo.search', [
            'items' => $items,
            'title' => 'ToDo'
        ]);
    }
}
