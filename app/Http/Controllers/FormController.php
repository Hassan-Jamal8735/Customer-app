<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Cookie;
use Laravel\Prompts\SearchPrompt as Search;

class FormController
{
    // Display the customer registration form
    public function customerForm()
    {
        return view('customer-form');
    }

    public function customerSubmit(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required|string',
            'phone' => 'required|string|max:255',
            'address' => 'nullable|string|max:255',
            'gender' => 'nullable|in:m,f',
            'dob' => 'nullable|date',
            // 'g-recaptcha-response' => 'required',
        ]);

        // $response = Http::asForm()->post('htt   ps://www.google.com/recaptcha/api/siteverify', [
        //     'secret' => config('services.recaptcha.secret_key'),
        //     'response' => $request->input('g-recaptcha-response'),
        //     'remoteip' => $request->ip(),
        // ]);

        // $responseBody = json_decode($response->getBody());

        // if (!$responseBody->success || $responseBody->score < 0.5) {
        //     return back()->withErrors(['captcha' => 'ReCAPTCHA verification failed. Please try again.']);
        // }

        // Create a new customer instance and fill the fields
        $customer = new Customer();
        $customer->name = $request->input('name');
        $customer->email = $request->input('email');
        $customer->password = bcrypt($request->input('password')); // Hash the password for security
        $customer->phone = $request->input('phone');
        $customer->address = $request->input('address');
        $customer->gender = $request->input('gender');
        $customer->dob = $request->input('dob');

        // Save the customer record
        $customer->save();

        // Redirect to a route or view after successful insertion
        return redirect()->route('customer.view')->with('success', 'Customer registered successfully');
    }

    public function showCustomers()
    {
        $customers = Customer::all();
        return view('customer-view', compact('customers'));
    }
    // Delete a customer
    public function deleteCustomer($id)
    {
        $customer = Customer::find($id);

        if (!$customer) {
            return redirect()->route('customer.view')->with('error', 'Customer not found');
        }

        $customer->forceDelete();

        return redirect()->route('customer.trashed')->with('success', 'Customer deleted successfully');
    }
    public function softDelete($id)
    {
        $customer = Customer::find($id);
        if ($customer) {
            $customer->delete(); // This performs the soft delete

        } else {
            Session::flash('error', 'Customer not found.');
        }
        return redirect()->route('customer.trashed');
    }
    public function trashed()
    {
        $trashCustomer = Customer::onlyTrashed()->get();
        return view('customer-trashed', compact('trashCustomer'));
    }
    public function restore($id)
    {
        $customer = Customer::withTrashed($id)->find($id);
        if ($customer) {
            $customer->restore();
        } else {
            Session::flash('error', 'Customer not found');
        }
        return redirect()->route('customer.trashed');
    }
    // Display form to edit a customer
    public function editCustomer($id)
    {
        $customer = Customer::find($id);

        if (!$customer) {
            return redirect()->route('customer.view')->with('error', 'Customer not found');
        }

        return view('customer-edit', compact('customer'));
    }

    // search a customer
    public function searchCustomer(Request $request)
    {
        // $search = $request->input("search");

        // $customers = Customer::
        //     where('name', 'LIKE', "%{$search}%")->orWhere('email', 'LIKE', "%{$search}%")->get();

        // return view('customer-view', compact('customers'));
    }
    public function ajaxSearch(Request $request)
{
    $query = $request->get('query');
    $customers = Customer::where('name', 'LIKE', "%{$query}%")
        ->orWhere('email', 'LIKE', "%{$query}%")
        ->get();
    return response()->json($customers);
}




    // Handle form submission to update customer
    public function updateCustomer(Request $request)
    {
        $customer = Customer::find($request->input('customer_id'));

        if (!$customer) {
            return redirect()->route('customer.view')->with('error', 'Customer not found');
        }

        $customer->name = $request->input('customer_name');
        $customer->email = $request->input('customer_email');
        $customer->phone = $request->input('customer_phone');

        // Save the updated customer record
        $customer->save();

        return redirect()->route('customer.view')->with('success', 'Customer updated successfully');
    }
}
