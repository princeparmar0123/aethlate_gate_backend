<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Sports;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SportsController extends Controller
{
    public function index()
    {
       $datas = Sports::all();
       return view('backend.sports.index', compact('datas'));
    }
       
    public function store(Request $request)
    {
 
       $dublicate_check = Sports::where('sport_name', 'like', $request->name)->get()->first();
       if ($dublicate_check) {
           return back()->with('error', "Dublicate entry is not allowed.");
       }
       $data = new Sports();
       $data->sport_name = $request->name;
       $data->sport_slug = Str::slug($request->name);
       $data->user_id = User::where('type', 'admin')->first()->id;
       $data->save();
 
       return back()->with('success', "Sport created successfully");
    }

    public function edit(Request $request, $id)
    {
       $dublicate_check = Sports::where([['sport_name', 'like', $request->name],['id', '<>', $id]])->get()->first();
       if ($dublicate_check) {
           return back()->with('error', "Dublicate entry is not allowed.");
       }
       $data = Sports::find($id);
       $data->sport_name = $request->name;
       $data->sport_slug = Str::slug($request->name);
       $data->user_id = User::where('type', 'admin')->first()->id;
       $data->save();
 
       return back()->with('success', "Sport updated successfully");
    }
    public function delete($id)
    {
       $data = Sports::find($id)->delete();
       return back()->with('success', "Sport deleted successfully");
    }

}
