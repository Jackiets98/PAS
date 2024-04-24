<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;

class CustomerController extends Controller
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

        $customerList = DB::table('customers')
        ->select('*')
        ->get();

        return view('customer.list', compact('userFirstName','userLastName','userRole','customerList'));
    }

    public function addCustomer(Request $request)
    {
        
        $customerFirstName = $request->input('customerFirstName');
        $customerLastName = $request->input('customerLastName');
        $customerIC = $request->input('customerIC');
        $customerEmail = $request->input('customerEmail');
        $customerContact = $request->input('customerContact');
        $customerOccupation = $request->input('customerOccupation');
        $customerRace = $request->input('customerRace');
        $customerProperty = $request->input('customerProperty');
        $customerPassword = $request->input('customerPassword');

        $customerContact = preg_replace('/^(\+?60|0)/', '', $customerContact);

        // Validation rules
        $validationRules = [
            'customerEmail' => [
                'required',
                'email',
                Rule::unique('customers', 'customer_email'),
            ],
        ];

        // Custom error messages
        $customMessages = [
            'customerEmail.required' => 'The email field is required.',
            'customerEmail.email' => 'Invalid email format.',
            'customerEmail.unique' => 'The email has already been taken.',
        ];

        // Validate the request
        $validator = Validator::make($request->all(), $validationRules, $customMessages);

        // Check if validation fails
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with('error', 'Email Has Been Taken');
        }

        DB::table('customers')
        ->insert([
            'id' => Str::random(30),
            'customer_first_name' => $customerFirstName,
            'customer_last_name' => $customerLastName,
            'customer_ic' => $customerIC,
            'customer_email' => $customerEmail,
            'customer_contact' => $customerContact,
            'customer_occupation' => $customerOccupation,
            'customer_race' => $customerRace,
            'customer_property' => $customerProperty,
            'password' => Hash::make($customerPassword),
            'status' => '1',
            'created_at' => now()
        ]);

        return redirect('/customerlist')->with('success', 'Customer created successfully!');
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
}