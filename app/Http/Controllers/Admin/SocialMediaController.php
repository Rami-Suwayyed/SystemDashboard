<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Dialog\Web\Dialog;
use App\Helpers\Dialog\Web\Types\SuccessMessage;
use App\Http\Controllers\Controller;
use App\Http\Requests\SocialMediaRequest;
use App\Models\SocialMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SocialMediaController extends Controller

{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $socials = SocialMedia::orderBy("sort", "asc")->paginate(20);

        $data['socials'] =$socials;

        return view('admin.social.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('admin.social.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SocialMediaRequest $request)
    {
        $validated = $request->validated();
        $lastRow = SocialMedia::orderBy('sort',"desc")->first();
        $result = SocialMedia::create([
            'link'=>$request->link,
            'type'=>$request->type,
            'sort'=> $lastRow ? $lastRow->sort + 1 : 1,
            'status'=> 1
        ]);

        $message = (new SuccessMessage())->title(__("created_successfully"))
            ->body(__("the_data_has_been_created_successfully"));
        Dialog::flashing($message);
        return redirect()->route("socials.index");
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
        $data['socials'] = SocialMedia::orderBy("sort", "asc")->get();
        return view("admin.social.sort", $data);
    }

    public function sort(Request $request){

        $sort= 1;
        foreach ($request->social as $id){
            $social = SocialMedia::where("id" , $id)->firstOrFail();
            if($social->sort != $sort){
                $social->sort = $sort;
                $social->save();
            }
            $sort++;
        }
        $message = (new SuccessMessage())->title(__("sorted_successfully"))
            ->body(__("the_data_has_been_sorted_successfully"));
        Dialog::flashing($message);
        return redirect()->route("socials.index");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['social'] =SocialMedia::findOrFail($id);
        return view('admin.social.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SocialMediaRequest $request, string $id)
    {
        $validated = $request->validated();

        $result = SocialMedia::findOrFail($id)->update([
            'link'=>$request->link,
            'type'=>$request->type,
            'sort'=>$request->sort,
            'status'=> $request->status ? 1 :0
        ]);

        $message = (new SuccessMessage())->title(__("updated_successfully"))
            ->body(__("the_data_has_been_updated_successfully"));
        Dialog::flashing($message);
        return redirect()->route("socials.index");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $media =  SocialMedia::findOrFail($id);

        if (Storage::exists("public/" . $media->icon)) {
            Storage::delete("public/" . $media->icon);
        }
        $media->delete();
        $message = (new SuccessMessage())->title(__("deleted_successfully"))
            ->body(__("the_data_has_been_deleted_successfully"));
        Dialog::flashing($message);
        return redirect()->route("socials.index");
    }

}

?>
