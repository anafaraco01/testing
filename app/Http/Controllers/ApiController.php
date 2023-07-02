<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ApiController extends Controller
{
    public function getToken()
    {
        $response = Http::withHeaders(
            ['Content-Type' => 'application/json']
        )->post('https://api-v4.easyflor.eu/api/authorizationtoken', [
            'Username' => 'Studenten', 'Password' => 'Studenten#1', 'Database' => 'easyflor-vanas'
        ]);

        $tokenID = 'token';

        return json_decode($response)->$tokenID;
    }



    public function callAPI($action = null, $param = null, $dateSince = null, $dataTo = null)
    {
        $token = $this->getToken();


        switch ($action) {
            case 'debtors':
                return Http::withToken($token)->timeout(30)->get('https://api-v4.easyflor.eu/api/debtor');
            case 'payments':
                return Http::withToken($token)->timeout(30)->get('https://api-v4.easyflor.eu/api/paymentsincedate/' . $dateSince);



            case 'purchases':
                $response = Http::withToken($token)->timeout(15)->get('https://api-v4.easyflor.eu/api/purchase');
                dd($response);
                break;
            case 'articles':
                return Http::withToken($token)->timeout(80)->get('https://api-v4.easyflor.eu/api/article');
            case 'invoices':

                return Http::withToken($token)->timeout(20)->get('https://api-v4.easyflor.eu/api/InvoiceSinceDate/' . $dateSince );
            case 'invoicesDB':
                // dd('https://api-v4.easyflor.eu/api/InvoiceSinceDate/' . $dateSince . '/' . $dataTo);
                return Http::withToken($token)->timeout(20)->get('https://api-v4.easyflor.eu/api/InvoiceSinceDate/' . $dateSince . '/' . $dataTo);
            case 'debtorInvoices':
                return Http::withToken($token)->timeout(20)->get('https://api-v4.easyflor.eu/api/debtorinvoice/13561');
            default:
                # code...
                break;
        }




        //        dd(json_decode($response)[0]);

    }
}
