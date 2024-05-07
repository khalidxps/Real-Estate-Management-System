<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Amenities;

class AmenitieController extends Controller
{
    public function AllAmenitie()
    {
        $amenities = Amenities::latest()->get();
        return view('backend.amenitie.all_amenitie', compact('amenities'));
    }

    public function AddAmenitie()
    {
        return view('backend.amenitie.add_amenitie');
    }

    public function StoreAmenitie(Request $request)
    {
        // Validation

        $request->validate([
            'amenitie_name' => 'required|unique:amenities|max:200',
        ]);

        Amenities::insert([

            'amenitie_name' => $request->amenitie_name,  

        ]);

        $notification = array(
            'message' => 'Amenitie Created Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.amenitie')->with($notification);
    }

    public function EditAmenitie($id)
    {
        $amenities = Amenities::findOrFail($id);
        return view('backend.amenitie.edit_amenitie', compact('amenities'));
    }

    public function UpdateAmenitie(Request $request)
    {
        $pid = $request->id;

        $request->validate([
            'amenitie_name' => 'required|unique:amenities|max:200',
        ]);

        Amenities::findOrFail($pid)->update([

            'amenitie_name' => $request->amenitie_name,

        ]);

        $notification = array(
            'message' => 'Amenitie Created Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.amenitie')->with($notification);
    }

    public function DeleteAmenitie($id)
    {
        Amenities::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Amenitie Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}
