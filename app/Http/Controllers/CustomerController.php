<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CustomerController extends Controller
{
    public function create()
    {
        return view('customers.create');
    }

    public function store(Request $request)
    {
        // データのバリデーション
        $validated = $request->validate([
            'name' => 'required|max:255',
            'age' => 'required|integer',
            'memo' => 'nullable|max:500'
        ]);

        // DBにデータを保存
        $customer = Customer::create($validated);

        // APIキー
        $apiKey = 'test';
        // $apiKey = 'test_failure';
        $url = 'http://host.docker.internal:8082/api/customers';

        // redirect url
        // $url = 'http://host.docker.internal:8082/api/redirect_customers';

        // 307
        // $url = 'http://host.docker.internal:8082/api/handle-post';

        // HTTP clientを使って別のLaravelプロジェクトにPOSTリクエスト
        $response = Http::withHeaders([
            'x-api-key' => $apiKey,
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->post($url, $validated);

        // log response
        Log::info($response->body());
        Log::info($response->status());

        return redirect()->route('customers.create')->with('status', 'Successfully created and posted!');
    }


}
