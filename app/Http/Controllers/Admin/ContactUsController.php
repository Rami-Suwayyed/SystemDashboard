<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Dialog\Web\Dialog;
use App\Helpers\Dialog\Web\Types\SuccessMessage;
use App\Http\Controllers\Controller;
use App\Models\ContactUs;
use App\Models\Languages;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['contact_us'] = ContactUs::paginate(20);
        return view('admin.contact_us.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     */

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        ContactUs::findOrFail($id)->delete();
        $message = (new SuccessMessage())->title(__("deleted_successfully"))
            ->body(__("the_data_has_been_deleted_successfully"));
        Dialog::flashing($message);
        return redirect()->route("contact_us.index");
    }

}

?>
