<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Dialog\Web\Dialog;
use App\Helpers\Dialog\Web\Types\SuccessMessage;
use App\Http\Controllers\Controller;
use App\Models\Languages;
use Illuminate\Http\Request;

class LanguageController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['languages'] = Languages::orderBy("sort", "asc")->get();

        return view('admin.language.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.language.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $result = Languages::create($request->all());

        $message = (new SuccessMessage())->title(__("created_successfully"))
            ->body(__("the_data_has_been_created_successfully"));
        Dialog::flashing($message);
        return redirect()->route("languages.index");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }


    public function viewsort(Request $request)
    {
        $data['languages'] = Languages::orderBy("sort", "asc")->get();
        return view("admin.language.sort", $data);
    }

    public function sort(Request $request){

        $sort= 1;
        foreach ($request->language as $id){
            $language = Languages::where("id" , $id)->firstOrFail();
            if($language->sort != $sort){
                $language->sort = $sort;
                $language->save();
            }
            $sort++;
        }
        $message = (new SuccessMessage())->title(__("sorted_successfully"))
            ->body(__("the_data_has_been_sorted_successfully"));
        Dialog::flashing($message);
        return redirect()->route("languages.index");
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['language'] =Languages::findOrFail($id);
        return view('admin.language.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $result = Languages::findOrFail($id)->update([
            'name'=>$request->name,
            'direction'=>$request->direction,
            'code'=>$request->code,
            'sort'=>$request->sort,
            'status'=> $request->status ? 1 :0
        ]);

        $message = (new SuccessMessage())->title(__("updated_successfully"))
            ->body(__("the_data_has_been_updated_successfully"));
        Dialog::flashing($message);
        return redirect()->route("languages.index");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Languages::findOrFail($id)->delete();
        $message = (new SuccessMessage())->title(__("deleted_successfully"))
            ->body(__("the_data_has_been_deleted_successfully"));
        Dialog::flashing($message);
        return redirect()->route("languages.index");
    }

}

?>
