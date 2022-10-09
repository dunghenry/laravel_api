<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Http\Resources\CustomerCollection;
use App\Http\Resources\CustomerResource;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response(CustomerResource::collection(Customer::paginate(5)), 200);
        // return Customer::all();
        // return new CustomerCollection(Customer::paginate());

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required',
                'phone' => 'required',
                'address' => 'required',
                'email' => 'required',
                'city' => 'required',
            ]
        );
        $customer = Customer::create(
            [
                'name' => $request->name,
                'phone' => $request->phone,
                'address' => $request->address,
                'email' => $request->email,
                'city' => $request->city,
                'created_at' => now(),
                'updated_at' => now()
            ]
        );
        $data = $customer->save();
        return response(new CustomerResource($data), 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        return response(new CustomerResource($customer), 200);
    }
    // public function show($id)
    // {
    //     $customer = Customer::find($id);
    //     if ($customer)
    //         return $customer;
    //     else
    //         return ["message" => "Customer not found."];
    // }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $customer = Customer::find($id);

        if (!$customer) {
            return response(["message" => "Customer not found"], 404);
        } else {
            $request->validate(
                [
                    'name' => 'required',
                    'phone' => 'required',
                    'address' => 'required',
                    'email' => 'required',
                    'city' => 'required',
                ]
            );
            $customer->update([
                'name' => $request->name,
                'phone' => $request->phone,
                'address' => $request->address,
                'email' => $request->email,
                'city' => $request->city,
                'created_at' => now(),
                'updated_at' => now()
            ]);
            return response(new CustomerResource($customer), 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customer = Customer::find($id);
        if ($customer) {
            $customer->delete();
            return response(['message' => 'Customer deleted successfully'], 200);
        } else {
            return response(["message" => "Customer not found"], 404);
        }
    }
}
