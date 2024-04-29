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
use Illuminate\Support\Facades\Log; 

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

    public function viewProjectDetails($id)
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

        $projectDetails = DB::table('projects')
        ->where('id',"=", $id)
        ->select('*')
        ->get();

        $projectDetailsForEditing = DB::table('projects')
        ->where('id',"=", $id)
        ->select('*')
        ->get();

        $projectBrochures = DB::table('projects')
            ->where('id', $id)
            ->pluck('brochure')
            ->first(); 

        $projectGallery = DB::table('projects')
        ->where('id', $id)
        ->pluck('gallery')
        ->first(); 

        // Decode the JSON string into a PHP array
        $projectBrochuresArray = json_decode($projectBrochures, true);
        // Decode the JSON string into a PHP array
        $galleryImagesArray = json_decode($projectGallery, true);


        return view('project.view', compact('userFirstName', 'userLastName', 'userRole', 'projectDetails', 'projectDetailsForEditing', 'projectBrochuresArray','galleryImagesArray','id'));
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

    public function removeBrochure(Request $request)
    {
        // Get the image name and ID from the request
        $imageName = $request->imageName;
        $arrayName = 'brochures/' . $imageName;
        $id = $request->id;
    
        // Fetch the current array of image names from the database
        $project = DB::table('projects')->where('id', $id)->first();
    
        if ($project) {
            // Decode the JSON string into a PHP array
            $brochures = json_decode($project->brochure, true);
    
            // Find the index of the image name to be removed
            $index = array_search($arrayName, $brochures);
    
            // If the image name exists in the array, remove it
            if ($index !== false) {
                unset($brochures[$index]);
    
                // Re-index the array to fix the keys
                $brochures = array_values($brochures);
    
                // Encode the modified array back to JSON
                $updatedBrochures = json_encode($brochures);
    
                // Update the database column with the modified array
                DB::table('projects')->where('id', $id)->update(['brochure' => $updatedBrochures]);
    
                return response()->json(['message' => 'Image removed successfully'], 200);
            } else {
                return response()->json(['error' => 'Image not found'], 404);
            }
        } else {
            return response()->json(['error' => 'Project not found'], 404);
        }
    }
}
