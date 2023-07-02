<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class PurchaseController extends Controller
{
    private $apiUrl = 'https://api-v4.easyflor.eu/api/';
    private $apiToken = 'apiToken';

    public function index()
    {
        try {
            // Make a GET request to retrieve all purchases
            $response = $this->sendRequest('GET', 'purchase');
            $purchases = json_decode($response->getBody(), true);

            // Process and return the purchases
            return response()->json($purchases);
        } catch (RequestException $e) {
            return response()->json(['error' => $e->getMessage()], $e->getCode());
        }
    }

    public function show($id)
    {
        try {
            // Make a GET request to retrieve a specific purchase
            $response = $this->sendRequest('GET', "purchase/$id");
            $purchase = json_decode($response->getBody(), true);

            // Process and return the purchase
            return response()->json($purchase);
        } catch (RequestException $e) {
            return response()->json(['error' => $e->getMessage()], $e->getCode());
        }
    }

    public function purchasesSinceDate($date)
    {
        try {
            // Make a GET request to retrieve purchases since a specific date
            $response = $this->sendRequest('GET', "purchase/PurchaseSinceDate/$date");
            $purchases = json_decode($response->getBody(), true);

            // Process and return the purchases
            return response()->json($purchases);
        } catch (RequestException $e) {
            return response()->json(['error' => $e->getMessage()], $e->getCode());
        }
    }

    public function purchasesSinceChangeDate($dateFrom, $dateTo = null)
    {
        try {
            // Make a GET request to retrieve purchases since a specific change date range
            $url = "purchase/PurchaseSinceChangeDate/$dateFrom";
            if ($dateTo) {
                $url .= "/$dateTo";
            }
            $response = $this->sendRequest('GET', $url);
            $purchases = json_decode($response->getBody(), true);

            // Process and return the purchases
            return response()->json($purchases);
        } catch (RequestException $e) {
            return response()->json(['error' => $e->getMessage()], $e->getCode());
        }
    }

    public function stock()
    {
        try {
            // Make a GET request to retrieve the list of purchases that haven't been sold completely
            $response = $this->sendRequest('GET', 'purchase/stock');
            $purchases = json_decode($response->getBody(), true);

            // Process and return the purchases
            return response()->json($purchases);
        } catch (RequestException $e) {
            return response()->json(['error' => $e->getMessage()], $e->getCode());
        }
    }

    private function sendRequest($method, $endpoint)
    {
        $client = new Client();

        // Set the headers with the API token
        $headers = [
            'Authorization' => $this->apiToken,
        ];

        try {
            // Send the API request
            $response = $client->request($method, $this->apiUrl . $endpoint, [
                'headers' => $headers,
            ]);

            return $response;

        } catch (RequestException $e) {
            return response()->json(['error' => $e->getMessage()], $e->getCode());
        }
    }
}
