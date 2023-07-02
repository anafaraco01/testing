<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class PreOrderController extends Controller
{
    private $httpClient;
    private $baseUri = 'https://api-v4.easyflor.eu/api/';

    public function __construct()
    {
        $this->httpClient = new Client([
            'base_uri' => $this->baseUri,
            'headers' => [
                'Accept' => 'application/json',
            ],
        ]);
    }

    public function getPreOrder($preOrderId)
    {
        $response = $this->httpClient->get('preorder/'.$preOrderId);
        $preOrder = json_decode($response->getBody()->getContents(), true);
        return response()->json($preOrder);
    }

    public function updateOrCreatePreOrder(Request $request)
    {
        $data = $request->validate([
            'Id' => 'nullable|integer',
            'debtorId' => 'required|integer',
            'listArticleSortId' => 'required|string',
            'date' => 'required|date',
            'quantity' => 'required|integer',
            'price' => 'required|numeric',
        ]);

        $response = $this->httpClient->put('preorder', ['json' => $data]);
        $result = json_decode($response->getBody()->getContents(), true);
        return response()->json($result);
    }

    public function getPreOrderByDateAndDebtor($date, $debtorId)
    {
        $url = 'preorderdate/' . $date . '/' . $debtorId;
        $response = $this->httpClient->get($url);
        $preOrder = json_decode($response->getBody()->getContents(), true);
        return response()->json($preOrder);
    }
}
