<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Dialog\Web\Dialog;
use App\Helpers\Dialog\Web\Types\SuccessMessage;
use App\Helpers\Dialog\Web\Types\WarningMessage;
use App\Http\Controllers\Controller;
use App\Http\Requests\AboutRequest;
use App\Models\About;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['abouts'] = About::orderBy("sort", "asc")->paginate(20);
        return view('admin.about.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.about.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AboutRequest $request)
    {

        $validated = $request->validated();
        $lastRow = About::orderBy('sort',"desc")->first();

        $result = About::create([
            'title'=>$request->title,
            'description'=>$request->description,
            'sort'=> $lastRow ? $lastRow->sort + 1 : 1,
            'status'=> 1
        ]);
        //check if file exist
        if($request->hasFile('image'))
            $result->saveMedia($request->file("image"),$result->path,'image');
        //check if file exist
        if($request->hasFile('icon'))
            $result->saveMedia($request->file("icon"),$result->path,'icon');

        $message = (new SuccessMessage())->title(__("created_successfully"))
            ->body(__("the_data_has_been_created_successfully"));
        Dialog::flashing($message);
        return redirect()->route("abouts.index");
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
        $data['abouts'] = About::orderBy("sort", "asc")->get();
        return view("admin.about.sort", $data);
    }

    public function sort(Request $request){

        $sort= 1;
        foreach ($request->about as $id){
            $about = About::where("id" , $id)->firstOrFail();
            if($about->sort != $sort){
                $about->sort = $sort;
                $about->save();
            }
            $sort++;
        }
        $message = (new SuccessMessage())->title(__("sorted_successfully"))
            ->body(__("the_data_has_been_sorted_successfully"));
        Dialog::flashing($message);
        return redirect()->route("abouts.index");
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['about'] =About::findOrFail($id);
        return view('admin.about.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AboutRequest $request, string $id)
    {
        $validated = $request->validated();
        $about = About::findOrFail($id);


        $result = About::findOrFail($id)->update([
            'title'=>$request->title,
            'description'=>$request->description,
            'sort'=>$request->sort,
            'status'=> $request->status ? 1 :0
        ]);

        //check if file exist
        if($request->hasFile('image')) {
            if ($about->image)
                $about->removeMedia($about->image);
            $about->saveMedia($request->file("image"),$about->path,'image');
        }
        //check if file exist
        if($request->hasFile('icon')) {
            if ($about->icon)
                $about->removeMedia($about->icon);
            $about->saveMedia($request->file("icon"),$about->path,'icon');
        }



        $message = (new SuccessMessage())->title(__("updated_successfully"))
            ->body(__("the_data_has_been_updated_successfully"));
        Dialog::flashing($message);
        return redirect()->route("abouts.index");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $result =  About::findOrFail($id);
        if ($result->media)
            $result->removeAllMedia($result->media);
        $result->delete();

        $message = (new SuccessMessage())->title(__("deleted_successfully"))
            ->body(__("the_data_has_been_deleted_successfully"));
        Dialog::flashing($message);
        return redirect()->route("abouts.index");
    }
}
