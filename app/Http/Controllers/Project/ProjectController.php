<?php

namespace App\Http\Controllers\Project;

use Illuminate\Http\Request;
use Models\Project;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\File;

class ProjectController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){

        $userFirstName = DB::table('managements')
        ->pluck('first_name')
        ->first();

        $userLastName = DB::table('managements')
        ->pluck('last_name')
        ->first();

        $userRole = DB::table('managements')
        ->pluck('role')
        ->first();

        $projectList = DB::table('projects')
        ->select('*')
        ->get();

        return view('project.list', compact('userFirstName','userLastName','userRole','projectList'));
    }

    public function addNewProject(Request $request)
    {
        $userFirstName = DB::table('managements')
        ->pluck('first_name')
        ->first();

        $userLastName = DB::table('managements')
        ->pluck('last_name')
        ->first();

        $userRole = DB::table('managements')
        ->pluck('role')
        ->first();

        return view('project.add', compact('userFirstName','userLastName','userRole'));
    }

    public function viewCustomerDetails($id)
    {
        $userFirstName = DB::table('managements')
        ->pluck('first_name')
        ->first();

        $userLastName = DB::table('managements')
        ->pluck('last_name')
        ->first();

        $userRole = DB::table('managements')
        ->pluck('role')
        ->first();

        $userDetails = DB::table('customers')
        ->where('id',"=", $id)
        ->select('*')
        ->get();

        $userDetailsForEditing = DB::table('customers')
        ->where('id',"=", $id)
        ->select('*')
        ->get();

        return view('customer.view', compact('userFirstName','userLastName','userRole','userDetails','userDetailsForEditing'));
    }

    public function updateStatus($id, $status)
    {
        $updateStatus = DB::table('customers')
            ->where('customers.id', $id)
            ->update([
                'status' => $status,
                'updated_at' => now()
            ]);

        if ($updateStatus) {
            return redirect()->back();
        } else {
            return redirect()->back()->with('error', 'Failed to update admin status!');
        }
    }

    public function updateCustomer($id, Request $request)
    {
        $customerFirstName = $request->input('customerFirstName');
        $customerLastName = $request->input('customerLastName');
        $customerIC = $request->input('customerIC');
        $customerEmail = $request->input('customerEmail');
        $customerPhone = $request->input('customerPhone');
        $customerOccupation = $request->input('customerOccupation');
        $customerRace = $request->input('customerRace');
        $customerProperty = $request->input('customerProperty');
        $customerStatus = $request->input('customerStatus');
        $customerPassword = $request->input('customerPassword');
        // Trim the first digit 0 from the phoneNo
        $customerPhone = preg_replace('/^(?:\+|0|60)?/', '', $customerPhone);

        if($customerPassword != "") {
            DB::table('customers')
            ->where('customers.id', $id)
            ->update([
                'customer_first_name' => $customerFirstName,
                'customer_last_name' => $customerLastName,
                'customer_email' => $customerEmail,
                'customer_contact' => $customerPhone,
                'customer_occupation' => $customerOccupation,
                'customer_ic' => $customerIC,
                'customer_race' => $customerRace,
                'customer_property' => $customerProperty,
                'customer_property' => $customerProperty,
                'status' => $customerStatus,
                'password' => Hash::make($customerPassword),
                'updated_at' => now()
            ]);
        }else{
            DB::table('customers')
            ->where('customers.id', $id)
            ->update([
                'customer_first_name' => $customerFirstName,
                'customer_last_name' => $customerLastName,
                'customer_email' => $customerEmail,
                'customer_contact' => $customerPhone,
                'customer_occupation' => $customerOccupation,
                'customer_ic' => $customerIC,
                'customer_race' => $customerRace,
                'customer_property' => $customerProperty,
                'customer_property' => $customerProperty,
                'status' => $customerStatus,
                'updated_at' => now()
            ]);
        }

        // Redirect to the customer's profile page with the updated data
        return redirect()->back()->with('success', 'Customer updated successfully!');
    }

    public function storeProject(Request $request)
    {
        $projectTitle = $request->input('projectTitle');
        $projectType = $request->input('projectType');
        $propertyAddress = $request->input('propertyAddress');
        $propertyCity = $request->input('propertyCity');
        $propertyPostcode = $request->input('propertyPostcode');
        $propertyState = $request->input('propertyState');
        $projectURL = $request->input('projectURL');
        $propertyLatitude = $request->input('propertyLatitude');
        $propertyLongitude = $request->input('propertyLongitude');
        $projectFacilities = $request->input('projectFacilities');

            // Decode the JSON string received from the frontend
        $jsonArray = json_decode($projectFacilities, true);

        // Extract the 'value' field from each element and store in an array
        $valuesArray = [];
        foreach ($jsonArray as $item) {
            $valuesArray[] = $item['value'];
        }

        $id = Str::random(30);

        // Handle logo upload
        if ($request->hasFile('projectLogo')) {
            $logo = $request->file('projectLogo');
            $logoName = $id . '.' . $logo->getClientOriginalExtension();
            $logo->storeAs('logos', $logoName, 'public'); // Assuming you want to store logos in the 'storage/app/public/logos' directory
        } else {
            $logoName = NULL;
        }

        // Handle brochure uploads
        if ($request->hasFile('photo_additional')) {
            $brochures = [];
            foreach ($request->file('photo_additional') as $key => $brochure) {
                $brochureName = $id . '_' . $key . '.' . $brochure->getClientOriginalExtension();
                $storagePath = 'brochures/'; // Relative path inside the 'public' directory
                $path = $brochure->storeAs($storagePath, $brochureName, 'public'); // Save to the 'public' directory
                $brochures[] = $storagePath . $brochureName; // Store the relative path in the array
            }
        } else {
            $brochures = NULL;
        }

        // Handle gallery uploads
        if ($request->hasFile('second_photo_additional')) {
            $galleryImages = [];
            foreach ($request->file('second_photo_additional') as $key => $image) {
                $imageName = $id . '_' . $key . '.' . $image->getClientOriginalExtension();
                $storagePath = 'gallery/'; // Relative path inside the 'public' directory
                $path = $image->storeAs($storagePath, $imageName, 'public'); // Assuming you want to store gallery images in the 'storage/app/public/gallery' directory
                $galleryImages[] =  $storagePath . $imageName;
            }
        }else{
            $galleryImages = NULL;
        }

        DB::table('projects')->insert([
            'id' => $id,
            'project_name' => $projectTitle,
            'project_type' => $projectType,
            'address' => $propertyAddress,
            'city' => $propertyCity,
            'postcode' => $propertyPostcode,
            'state' => $propertyState,
            'website_url' => $projectURL ? $projectURL : null,
            'latitude' => $propertyLatitude ? $propertyLatitude : null,
            'longitude' => $propertyLongitude ? $propertyLongitude : null,
            'facilities' => json_encode($valuesArray),
            'project_logo' => $logoName,
            'status' => '1',
            'brochure' => json_encode($brochures),
            'gallery' => json_encode($galleryImages),
            'created_at' => now()
        ]);

        return redirect()->back()->with('success','New Project Jas Been Added');
    }

}
