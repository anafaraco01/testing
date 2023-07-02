<?php

namespace App\Http\Controllers;

use App\Models\Invoices;
use App\Models\Route;
use App\Notifications\InvoiceNotification;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Tour;
use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Nette\Utils\DateTime;
use function Symfony\Component\Translation\t;



class APIInsertDataFix extends Controller
{
    // should be main function
    public function storeCustomer()
    {
        $this->storeCustomers();
        $this->storeInvoices();
        $this->storeTours();
        return back();
    }
    public function getWeekNumber($dateString)
    {
        // Convert the string date to a DateTime object
        $date = DateTime::createFromFormat('Y-m-d', $dateString);

        // Get the week number using the 'W' format specifier
        $weekNumber = $date->format('W');

        return $weekNumber;
    }
    public function quickCheck($param, $param2 = null)
    {
        $api = new ApiController();
        $apiResponse = json_decode($api->callAPI($param), true);


        if ($param2 != null) {
            $apiResponse = $apiResponse[$param2];
        }

        dd($apiResponse);
    }

    public function getFirstDayOfWeek($week)
    {
        $year = date('Y');


        // Create a new DateTime object
        $date = new DateTime();
        $date->setISODate($year, $week, 1); // Set the ISO date using the year, week number, and day (1 for Monday)


        return $date->format('Y-m-d'); // Format the date as desired (e.g., 'Y-m-d' for 'YYYY-MM-DD')
    }
    public function getLastDayOfWeek($week)
    {
        $year = date('Y');


        // Create a new DateTime object
        $date = new DateTime();
        $date->setISODate($year, $week, 7); // Set the ISO date using the year, week number, and day (1 for Monday)


        return $date->format('Y-m-d'); // Format the date as desired (e.g., 'Y-m-d' for 'YYYY-MM-DD')
    }

    public function storeCustomers()
    {
        DB::table('customers')->truncate();
        $currentDate = date('Y-m-d');
        $currentWeek = $this->getWeekNumber($currentDate);

        $api = new ApiController();



        $apiResponseDebtors = json_decode($api->callAPI("debtors"), true);

        $apiResponseInvoices = json_decode($api->callAPI("invoices", null, str_replace('-', '', $this->getFirstDayOfWeek((int) $currentWeek - 8))), true);

        $apiResponsePayments = json_decode($api->callAPI("payments", null, str_replace('-', '', $this->getFirstDayOfWeek((int) $currentWeek - 20))), true);

        foreach ($apiResponseDebtors as $debtor) {
            if ($debtor['price'] != null) {
                $debtors[$debtor['code']] = str_replace("%", "", explode(" ", $debtor['price'])[1]);
            } else {
                $debtors[$debtor['code']] = 100;
            }
        }


        // dd($apiResponsePayments);

        $payments = array();
        foreach ($apiResponsePayments as $payment) {
            // print_r((explode("/", $payment['paidInvoices'][0]['invoiceId']))[1]);
            // try{
            //     $test = (explode("/", $payment['paidInvoices'][0]['invoiceId']))[1];
            // } catch (\Exception $e) {

            //     print_r($payment);
            // }

            if ($payment['paymentMethod'] != null) {
                if ($payment['paidInvoices'] != null)
                    $payments[(explode("/", $payment['paidInvoices'][0]['invoiceId']))[1]] = array(
                        'debtorCode' => $payment['debtorCode'],
                        'amount' => $payment['amount'],
                        'paymentMethod' => $payment['paymentMethod'],
                        'date' => $payment['dateTime']
                    );
            } else {
                if ($payment['paidInvoices'] != null) {
                    $payments[(explode("/", $payment['paidInvoices'][0]['invoiceId']))[1]] = array(
                        'debtorCode' => $payment['debtorCode'],
                        'amount' => $payment['amount'],
                        'paymentMethod' => 'REFUND',
                        'date' => $payment['dateTime']
                    );
                }
            }
        }

        // 13561



        for ($i = 0; $i < count($apiResponseDebtors); ++$i) {
            $code = $apiResponseDebtors[$i]['code'];
            $weeks = array();
            $weeks['week8'] = 0;
            $weeks['week7'] = 0;
            $weeks['week6'] = 0;
            $weeks['week5'] = 0;
            $weeks['week4'] = 0;
            $weeks['week3'] = 0;
            $weeks['week2'] = 0;
            $weeks['week1'] = 0;
            $weeks['weekcr'] = 0;
            $weekCrAmnt = 0;
            $week1Amnt = 0;
            $week2Amnt = 0;
            $week3Amnt = 0;
            $week4Amnt = 0;
            $weekCrValue = 0;
            $week1Value = 0;
            $week2Value = 0;
            $week3Value = 0;
            $week4Value = 0;





            // dd($payments);
            foreach ($apiResponseInvoices as $invoice) {
                $p2 = explode("/", $invoice['id']);
                $invoiceID = $p2[1];
                if (substr($invoice['debtorId'], 8) == $apiResponseDebtors[$i]['id']) {
                    $invoiceDate = substr($invoice['date'], 0, 10);;
                    $invoiceWeek = $this->getWeekNumber($invoiceDate);
                    if ($invoiceWeek == $currentWeek) {
                        $weeks['weekcr']++;
                        if ($invoice['toPay'] != 0) {
                            $weekCrAmnt += $invoice['toPay'];
                        } else {
                            try {
                                $weekCrAmnt += $payments[$invoiceID]['amount'];
                            } catch (\Exception $e) {
                                $weekCrAmnt = 0; // dd($apiResponsePayments);
                                $weeks['weekcr']--;
                            }
                        }
                    } else if ($invoiceWeek == $currentWeek - 1) {
                        $weeks['week1']++;
                        if ($invoice['toPay'] != 0) {
                            $week1Amnt += $invoice['toPay'];
                        } else {
                            try {
                                $week1Amnt
                                    += $payments[$invoiceID]['amount'];
                            } catch (\Exception $e) {
                                $week1Amnt = 0;
                                $weeks['week1']--;
                            }
                        }
                        // dd($invoice);
                    } else if ($invoiceWeek == $currentWeek - 2) {
                        $weeks['week2']++;
                        if ($invoice['toPay'] != 0) {
                            $week2Amnt += $invoice['toPay'];
                        } else {
                            try {
                                $week2Amnt +=
                                    $payments[$invoiceID]['amount'];
                            } catch (\Exception $e) {
                                $week2Amnt = 0;
                                $weeks['week2']--;
                            }
                        }
                    } else if ($invoiceWeek == $currentWeek - 3) {
                        $weeks['week3']++;
                        if ($invoice['toPay'] != 0) {
                            $week3Amnt += $invoice['toPay'];
                        } else {
                            try {
                                $week3Amnt
                                    += $payments[$invoiceID]['amount'];
                            } catch (\Exception $e) {
                                $week3Amnt = 0;
                                $weeks['week3']--;
                            }
                        }
                    } else if ($invoiceWeek == $currentWeek - 4) {
                        $weeks['week4']++;
                        if ($invoice['toPay'] != 0) {
                            $week4Amnt += $invoice['toPay'];
                        } else {
                            try {
                                $week4Amnt
                                    += $payments[$invoiceID]['amount'];
                            } catch (\Exception $e) {
                                $week4Amnt = 0;
                                $weeks['week4']--;
                            }
                        }
                    } else if ($invoiceWeek == $currentWeek - 5) {
                        $weeks['week5']++;
                    } else if ($invoiceWeek == $currentWeek - 6) {
                        $weeks['week6']++;
                    } else if ($invoiceWeek == $currentWeek - 7) {
                        $weeks['week7']++;
                    } else if ($invoiceWeek == $currentWeek - 8) {
                        $weeks['week8']++;
                    }
                }
            }
            $weekCrValue = $weekCrAmnt / (100 + $debtors[$code]) * 100;
            $week1Value = $week1Amnt / (100 + $debtors[$code]) * 100;
            $week2Value = $week2Amnt / (100 + $debtors[$code]) * 100;
            $week3Value = $week3Amnt / (100 + $debtors[$code]) * 100;
            $week4Value = $week4Amnt / (100 + $debtors[$code]) * 100;

            if (array_sum($weeks) != 0) {
                $name = "Missing Name!";
                if (!is_null($apiResponseDebtors[$i]['name'])) {
                    $name = $apiResponseDebtors[$i]['name'];
                }

                $address1 = "Missing Address";
                $address2 = "";

                if ($apiResponseDebtors[$i]['addresses'] != null) {
                    if ($apiResponseDebtors[$i]['addresses'][0]['line1'] != null) {
                        $address1 = $apiResponseDebtors[$i]['addresses'][0]['line1'];
                        try {
                            if ($apiResponseDebtors[$i]['addresses'][1]['line1'] != null) {
                                $address2 = $apiResponseDebtors[$i]['2dresses'][1]['line1'];
                            };
                        } catch (\Exception $e) {
                            //nuh uh
                        }
                    }
                }
                $TID = 0;

                switch (substr($apiResponseDebtors[$i]['code'], 0, 2)) {
                    case 'T1':
                        $TID = 1;
                        break;
                    case 'T3':
                        $TID = 3;
                        break;
                    case 'T4':
                        $TID = 4;
                        break;
                    case 'T5':
                        $TID = 5;
                        break;
                    default:
                        $TID = 0;
                }
                // dd($weeks);
                $customer = Customer::create($this->validateCustomer(
                    $name,
                    $address1,
                    $address2,
                    $TID,
                    $weeks['week4'],
                    $week4Value,
                    $week4Amnt,
                    $weeks['week3'],
                    $week3Value,
                    $week3Amnt,
                    $weeks['week2'],
                    $week2Value,
                    $week2Amnt,
                    $weeks['week1'],
                    $week1Value,
                    $week1Amnt,
                    $weeks['weekcr'],
                    $weekCrValue,
                    $weekCrAmnt
                ));
                $user = Auth::user();
                if ($customer->week1 == 0 && $customer->week2 == 0 && $customer->week3 == 0) {
                    Notification::send($user, new InvoiceNotification($customer));
                }
            }
            // dd($payments);
        }
    }

    public function validateCustomer(
        $name,
        $address1,
        $address2,
        $truck_id,
        $week4,
        $week4Value,
        $week4Amnt,
        $week3,
        $week3Value,
        $week3Amnt,
        $week2,
        $week2Value,
        $week2Amnt,
        $week1,
        $week1Value,
        $week1Amnt,
        $weekcr,
        $weekCrValue,
        $weekcrAmnt
    ) {
        return [
            'name' => $name,
            'address1' =>  $address1,
            'address2' =>  $address2,
            'truck_id' =>  $truck_id,
            'week4' => $week4,
            'week4Value' => $week4Value,
            'week4Amnt' => $week4Amnt,
            'week3' => $week3,
            'week3Value' => $week3Value,
            'week3Amnt' => $week3Amnt,
            'week2' => $week2,
            'week2Value' => $week2Value,
            'week2Amnt' => $week2Amnt,
            'week1' => $week1,
            'week1Value' => $week1Value,
            'week1Amnt' => $week1Amnt,
            'weekcr' => $weekcr,
            'weekcrValue' => $weekCrValue,
            'weekcrAmnt' => $weekcrAmnt,
        ];
    }



    public function storeInvoices()
    {
        DB::table('invoices')->truncate();
        $currentDate = date('Y-m-d');
        $currentWeek = $this->getWeekNumber($currentDate);

        $api = new ApiController();
        $apiResponseDebtors = json_decode($api->callAPI("debtors"), true);


        // dd($test);
        $apiResponseInvoices = json_decode(
            $api->callAPI(
                "invoicesDB",
                null,
                str_replace('-', '', $this->getFirstDayOfWeek((int) $currentWeek - 5)),
                str_replace('-', '', $this->getLastDayOfWeek((int) $currentWeek))
            ),
            true
        );

        // dd($apiResponseInvoices);
        $apiResponsePayments = json_decode(
            $api->callAPI(
                "payments",
                null,
                str_replace('-', '', $this->getFirstDayOfWeek((int) $currentWeek - 5)),
                str_replace('-', '', $this->getLastDayOfWeek((int) $currentWeek))
            ),
            true
        );

        foreach ($apiResponseDebtors as $debtor) {
            if ($debtor['price'] != null) {
                $debtors[$debtor['code']] = str_replace("%", "", explode(" ", $debtor['price'])[1]);
            } else {
                $debtors[$debtor['code']] = 100;
            }
        }
        // foreach ($debtors as $debtor) {
        //     print_r($debtor . "\n");
        // }
        //  dd();
        $payments = array();
        // foreach ($apiResponsePayments as $dd) {
        //     print_r($dd);
        // }

        foreach ($apiResponsePayments as $payment) {


            if ($payment['paymentMethod'] != null) {
                if ($payment['paidInvoices'] != null)
                    $payments[(explode("/", $payment['paidInvoices'][0]['invoiceId']))[1]] = array(
                        'debtorCode' => $payment['debtorCode'],
                        'amount' => $payment['amount'],
                        'paymentMethod' => $payment['paymentMethod'],
                        'date' => $payment['dateTime']
                    );
            } else {
                if ($payment['paidInvoices'] != null) {
                    $payments[(explode("/", $payment['paidInvoices'][0]['invoiceId']))[1]] = array(
                        'debtorCode' => $payment['debtorCode'],
                        'amount' => $payment['amount'],
                        'paymentMethod' => 'REFUND',
                        'date' => $payment['dateTime']
                    );
                }
            }
        }

        $total = 0;
        foreach ($apiResponseInvoices as $invoice) {
            $p2 = explode("/", $invoice['id']);
            $invoiceID = $p2[1];
            $invoiceDebtorID = $invoice['debtorCode'];
            $invoiceIsPaid = false;
            $TID = 0;
            $invoiceValue = 0;
            $invoiceDate = substr($invoice['date'], 0, 10);
            $invoiceWeek = $this->getWeekNumber($invoiceDate);
            $invoicePaymentMethod = 'Not Paid';
            $invoiceRefunded = false;
            $profitMargin = $debtors[$invoiceDebtorID];
            switch (substr($invoiceDebtorID, 0, 2)) {
                case 'T1':
                    $TID = 1;
                    break;
                case 'T3':
                    $TID = 3;
                    break;
                case 'T4':
                    $TID = 4;
                    break;
                case 'T5':
                    $TID = 5;
                    break;
                default:
                    $TID = 0;
                    break;
            }



            // 2312 - 100%
            // 2312 / 200 * 100 = 1156
            // 2312 / (100 + 80) * 100 = 1260



            $invoiceAmount = $invoice['toPay'];


            if ($invoiceAmount == 0) {
                try {
                    if ($payments[$invoiceID]['paymentMethod'] != 'REFUND') {
                        $invoiceAmount = $payments[$invoiceID]['amount'];
                        $invoiceIsPaid = true;
                        $invoiceAmount = $payments[$invoiceID]['amount'];
                        $invoiceIsPaid = true;
                        $invoicePaymentMethod = $payments[$invoiceID]['paymentMethod'];
                    } else {
                        $invoicePaymentMethod = 'REFUND';
                        $invoiceAmount = $payments[$invoiceID]['amount'];
                        $invoiceIsPaid = false;
                        $invoiceRefunded = true;
                    }
                } catch (\Exception $e) {
                    $fails[] = $invoice;
                }
            }

            $invoiceValue = $invoiceAmount / (100 + $debtors[$invoiceDebtorID]) * 100;
            if ($currentWeek == $invoiceWeek)
                $total += $invoiceValue;

            Invoices::create($this->validateInvoice($invoiceID, $invoiceDebtorID, $TID, $invoiceWeek, $invoiceDate, $profitMargin, $invoiceValue, $invoiceAmount, $invoicePaymentMethod, $invoiceIsPaid, $invoiceRefunded));
        }
    }



    public function validateInvoice($invoiceID, $debtorID, $truckID, $week, $date, $profintMargin, $value, $amountToPay, $paymentMethod, $isPaid, $isRefunded)
    {
        return [
            'invoice_id' => $invoiceID,
            'debtor_code' =>  $debtorID,
            'truck_id' =>  $truckID,
            'week' =>  $week,
            'date' =>  $date,
            'profit_margin' =>  $profintMargin,
            'value' =>  $value,
            'amount_to_pay' =>  $amountToPay,
            'payment_method' =>  $paymentMethod,
            'paid' =>  $isPaid,
            'refunded' =>  $isRefunded,
        ];
    }

    public function storeTours()
    {
        DB::table('routes')->truncate();
        $api = new ApiController();
        $currentDate = date('Y-m-d');
        $currentWeek = $this->getWeekNumber($currentDate);
        $apiResponseDebtors = json_decode(
            $api->callAPI(
                "debtors"
            ),

            true
        );
        $debtorTrucks = array();
        $debtorTrucks['T0'] = 0;
        $debtorTrucks['T1'] = 0;
        $debtorTrucks['T3'] = 0;
        $debtorTrucks['T4'] = 0;
        $debtorTrucks['T5'] = 0;
        $startRoutes = array();
        $startRoutes['T0'] = "14 Rue de l'Hôtel Colbert";
        $startRoutes['T1'] = "Plougastel-Daoulas";
        $startRoutes['T3'] = "St Pierre Sur Dives";
        $startRoutes['T4'] = "Tulle";
        $startRoutes['T5'] = "Chateau-Chinon";
        $endRoutes = array();
        $endRoutes['T0'] = "34 Rue Notre Dame de Nazareth";
        $endRoutes['T1'] = "Sene";
        $endRoutes['T3'] = "Villers Bocage";
        $endRoutes['T4'] = "Kamperland";
        $endRoutes['T5'] = "Le Coteau";


        foreach ($apiResponseDebtors as $debtor) {
            switch (substr($debtor['code'], 0, 2)) {
                case 'T1':
                    $debtorTrucks['T1']++;
                    break;
                case 'T3':
                    $debtorTrucks['T3']++;
                    break;
                case 'T4':
                    $debtorTrucks['T4']++;
                    break;
                case 'T5':
                    $debtorTrucks['T5']++;
                    break;
                default:
                    $debtorTrucks['T0']++;
                    break;
            }
        }
        for ($i = 0; $i < 6; $i++) {
            if ($i != 2) {

                Route::create($this->validateRoute($i, $startRoutes['T' . $i], $endRoutes['T' . $i], $debtorTrucks['T' . $i]));
            }
        }
    }

    public function validateRoute($truckID, $startRoutes, $endRoutes, $debtors)
    {

        return [
            'truck_id' => $truckID,
            'start_place' =>  $startRoutes,
            'end_place' =>  $endRoutes,
            'number_of_debtors' =>  $debtors,
        ];
    }
}
