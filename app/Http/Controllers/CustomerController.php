<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerRequest;
use App\Models\Customer;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::all();
        $data = [
            'customers' => $customers,
        ];
        return view('customers.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        $zipcode = $request->zipcode;

        $method = 'GET';
        $url = config('zipcloud.url') . '/api/search?zipcode=' . $zipcode;
        $options = [];

        $client = new Client();
        try {
            $response = $client->request($method, $url, $options);
            $body = $response->getBody();
            $zipcode = json_decode($body, false);
            if (empty($zipcode->results)) {
                if ($zipcode->status === 200) {
                    return back()->withErrors(['errors' => '該当の郵便番号は存在しません。']);
                }
                return back()->withErrors(['errors' => $zipcode->message]);
            }
            $data = [
                'zipcode' => $zipcode->results[0]->zipcode,
                'address' => $zipcode->results[0]->address1 . $zipcode->results[0]->address2 . $zipcode->results[0]->address3,
            ];
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            dd($zipcode);
            return back()->withErrors(['error' => $e->getResponse()->getReasonPhrase()]);
        }

        return view('customers.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CustomerRequest $request)
    {
        $customer = new Customer();
        $customer->fill($request->all());
        $customer->save();
        return redirect()->route('customers.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        $data = [
            'customer' => $customer,
        ];
        return view('customers.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        $data = [
            'customer' => $customer,
        ];
        return view('customers.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(CustomerRequest $request, Customer $customer)
    {
        $customer->fill($request->all());
        $customer->save();
        return redirect()->route('customers.show', $customer);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();
        return redirect()->route('customers.index');
    }

    public function search()
    {
        return view('customers.zipcode_search');
    }
}
