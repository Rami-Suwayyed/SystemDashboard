<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Dialog\Web\Dialog;
use App\Helpers\Dialog\Web\Types\SuccessMessage;
use App\Helpers\Dialog\Web\Types\WarningMessage;
use App\Http\Controllers\Controller;
use App\Http\Requests\SliderRequest;
use App\Models\Languages;
use App\Models\Media;
use App\Models\Slider;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class SliderController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sliders = Slider::with('image','media','icon')->orderBy("sort", "asc")->paginate(20);
        $data['sliders'] =$sliders;
        return view('admin.slider.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.slider.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SliderRequest $request)
    {
        $validated = $request->validated();
        $lastRow = Slider::orderBy('sort',"desc")->first();

        $result = Slider::create([
            'title'=>$request->title,
            'description'=>$request->description,
            'sort'=> $lastRow ? $lastRow->sort + 1 : 1,
            'status'=> 1
        ]);

        //check if file exist
        if($request->hasFile('image'))
        $result->saveMedia($request->file("image"),$result->path,'image');

        $message = (new SuccessMessage())->title(__("created_successfully"))
            ->body(__("the_data_has_been_created_successfully"));
        Dialog::flashing($message);
        return redirect()->route("sliders.index");
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
        $data['sliders'] = Slider::orderBy("sort", "asc")->get();
        return view("admin.slider.sort", $data);
    }

    public function sort(Request $request){

        $sort= 1;
        foreach ($request->slider as $id){
            $slider = Slider::where("id" , $id)->firstOrFail();
            if($slider->sort != $sort){
                $slider->sort = $sort;
                $slider->save();
            }
            $sort++;
        }
        $message = (new SuccessMessage())->title(__("sorted_successfully"))
            ->body(__("the_data_has_been_sorted_successfully"));
        Dialog::flashing($message);
        return redirect()->route("sliders.index");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['slider'] =Slider::findOrFail($id);
        return view('admin.slider.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SliderRequest $request, string $id)
    {
        $validated = $request->validated();
        $slider = Slider::findOrFail($id);
        $result = Slider::findOrFail($id)->update([
            'title'=>$request->title,
            'description'=>$request->description,
            'sort'=>$request->sort,
            'status'=> $request->status ? 1 :0
        ]);
        //check if file exist
        if($request->hasFile('image')) {
            if ($slider->image)
                $slider->removeMedia($slider->image);
            $slider->saveMedia($request->file("image"),$slider->path,'image');
        }

        $message = (new SuccessMessage())->title(__("updated_successfully"))
            ->body(__("the_data_has_been_updated_successfully"));
        Dialog::flashing($message);
        return redirect()->route("sliders.index");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $result= Slider::findOrFail($id);
        if ($result->media)
            $result->removeAllMedia($result->media);
        $result->delete();

        $message = (new SuccessMessage())->title(__("deleted_successfully"))
            ->body(__("the_data_has_been_deleted_successfully"));
        Dialog::flashing($message);
        return redirect()->route("sliders.index");
    }

}

?>
