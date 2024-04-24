<?php

namespace App\Http\Controllers\Managements;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function superAdmin(){

        $userFirstName = DB::table('managements')
        ->pluck('first_name')
        ->first();

        $userLastName = DB::table('managements')
        ->pluck('last_name')
        ->first();

        $userRole = DB::table('managements')
        ->pluck('role')
        ->first();

        $superAdminList = DB::table('managements')
        ->where('role',"=",'Super Admin')
        ->select('*')
        ->get();

        return view('managements.superadmin_list', compact('userFirstName','userLastName','userRole','superAdminList'));
    }

    public function getDetails($id, Request $request){
        $userFirstName = DB::table('managements')
        ->pluck('first_name')
        ->first();

        $userLastName = DB::table('managements')
        ->pluck('last_name')
        ->first();

        $userRole = DB::table('managements')
        ->pluck('role')
        ->first();

        $userDetails = DB::table('managements')
        ->where('id',"=", $id)
        ->select('*')
        ->get();

        $userDetailsForEditing = DB::table('managements')
        ->where('id',"=", $id)
        ->select('*')
        ->get();

        return view('managements.superadmin_view', compact('userFirstName','userLastName','userRole','userDetails','userDetailsForEditing'));
    }

    public function updateSuperAdmin($id, Request $request)
    {
        $firstName = $request->input('managementFirstName');
        $lastName = $request->input('managementLastName');
        $role = $request->input('managementRole');
        $email = $request->input('managementEmail');
        $contact = $request->input('managementPhone');
        $status = $request->input('managementStatus');
        $password = $request->input('managementPassword');
        // Trim the first digit 0 from the phoneNo
        $contact = preg_replace('/^(?:\+|0|60)?/', '', $contact);

        if($password != "") {
            DB::table('managements')
            ->where('management.id', $id)
            ->update([
                'first_name' => $firstName,
                'last_name' => $lastName,
                'role' => $role,
                'email' => $email,
                'phone_no' => $contact,
                'status' => $status,
                'password' => Hash::make($customerPassword),
                'updated_at' => now()
            ]);
        }else{
            DB::table('managements')
            ->where('managements.id', $id)
            ->update([
                'first_name' => $firstName,
                'last_name' => $lastName,
                'role' => $role,
                'email' => $email,
                'phone_no' => $contact,
                'status' => $status,
                'updated_at' => now()
            ]);
        }

        // Redirect to the customer's profile page with the updated data
        return redirect()->back()->with('success', 'Changes made successfully!');
    }

    public function updateStatus($id, $status)
    {
        $updateStatus = DB::table('managements')
            ->where('managements.id', $id)
            ->update([
                'status' => $status,
                'updated_at' => now()
            ]);
    
        if ($updateStatus) {
            return redirect()->back();
        } else {
            return redirect()->back()->with('error', 'Failed to update status!');
        }
    }

    public function addSuperAdmin(Request $request)
    {
        
        $firstName = $request->input('managementFirstName');
        $lastName = $request->input('managementLastName');
        $managementEmail = $request->input('managementEmail');
        $phoneNo = $request->input('managementContact');
        $password = $request->input('managementPassword');

        $phoneNo = preg_replace('/^(\+?60|0)/', '', $phoneNo);

        // Validation rules
        $validationRules = [
            'managementEmail' => [
                'required',
                'email',
                Rule::unique('managements', 'email'),
            ],
        ];

        // Custom error messages
        $customMessages = [
            'email.required' => 'The email field is required.',
            'email.email' => 'Invalid email format.',
            'email.unique' => 'The email has already been taken.',
        ];

        // Validate the request
        $validator = Validator::make($request->all(), $validationRules, $customMessages);

        // Check if validation fails
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with('error', 'Email Has Been Taken');
        }

        DB::table('managements')
        ->insert([
            'id' => Str::random(30),
            'first_name' => $firstName,
            'last_name' => $lastName,
            'email' => $managementEmail,
            'phone_no' => $phoneNo,
            'role' => 'Super Admin',
            'status' => '1',
            'password' => Hash::make($password),
            'created_at' => now()
        ]);

        return redirect('/superadminlist')->with('success', 'Super Admin created successfully!');
    }

    public function propertyAgent(){

        $userFirstName = DB::table('managements')
        ->pluck('first_name')
        ->first();

        $userLastName = DB::table('managements')
        ->pluck('last_name')
        ->first();

        $userRole = DB::table('managements')
        ->pluck('role')
        ->first();

        $agentList = DB::table('managements')
        ->where('role',"=",'Agent')
        ->select('*')
        ->get();

        return view('managements.agent_list', compact('userFirstName','userLastName','userRole','agentList'));
    }
}