<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class CreditInvoicePurchaseItemController extends Controller
{
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function index()
    {
        // Get all credited distributed purchase items
        $response = $this->client->get('api/CreditInvoicePurchaseItem');
        $creditedPurchaseItems = json_decode($response->getBody(), true);

        return response()->json($creditedPurchaseItems);
    }

    public function show($id)
    {
        // Get a specific credited distributed purchase item by ID
        $response = $this->client->get("api/CreditInvoicePurchaseItem/$id");
        $creditedPurchaseItem = json_decode($response->getBody(), true);

        return response()->json($creditedPurchaseItem);
    }

    public function showSinceDate($id, $date)
    {
        // Get credited distributed purchase items by ID and date
        $response = $this->client->get("api/CreditInvoicePurchaseItemSinceDate/$id", [
            'query' => ['date' => $date]
        ]);
        $creditedPurchaseItems = json_decode($response->getBody(), true);

        return response()->json($creditedPurchaseItems);
    }
}
