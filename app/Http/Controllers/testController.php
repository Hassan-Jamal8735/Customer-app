<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
// use Illuminate\Routing\Console\ControllerMakeCommand;

class testController 
{
    public function index(){
        return view('test');
    }
    public function register(Request $request){
        $request->validate([
            // 'name'=>'required',
            'email'=>'required',
        ]);
        
        print_r($request->all());

    }
    public function customer(){
        $url=url('customer/');
        return view('customerForm');
    }
    public function insert(Request $request){
        

        echo'<pre/>';
        // print_r($request->all());
        $customers=new Customer();
        $customers->customer_name=$request['customer_name'];
        $customers->customer_email=$request['customer_email'];
        $customers->customer_phone=$request['customer_phone'];
        $customers->customer_password=Hash::make($request['customer_password']);
        $customers->save();
        return redirect('customer/view');
        
       
    }
    public function show(){
        $customers=Customer::all();
        $data=compact('customers');
        return view('customer-view')->with($data);
    }
    public function delete($id){
        $customer=Customer::find($id);
        if (!is_null($customer)) {
            $customer->delete();
        }
        return redirect('customer-view');

    }
    public function edit($id) {
        $url=url('customer/update','/',$id);
        $customers = Customer::find($id);
        if (!is_null($customers)) {
            return view('customerForm', compact('customers'));
        } 
        // return redirect('customer/view');
    }
    
    public function update(Request $request,$id){   
        $customer=Customer::find($id);


    }
}
