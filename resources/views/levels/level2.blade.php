@extends('common.layout')
@section('style')
    <style>
         ! tailwindcss v3.2.4 | MIT License | https: //tailwindcss.com*,::after,::before{box-sizing:border-box;border-width:0;border-style:solid;border-color:#e5e7eb}::after,::before{--tw-content:''}html{line-height:1.5;-webkit-text-size-adjust:100%;-moz-tab-size:4;tab-size:4;font-family:Figtree, sans-serif;font-feature-settings:normal}body{margin:0;line-height:inherit}hr{height:0;color:inherit;border-top-width:1px}abbr:where([title]){-webkit-text-decoration:underline dotted;text-decoration:underline dotted}h1,h2,h3,h4,h5,h6{font-size:inherit;font-weight:inherit}a{color:inherit;text-decoration:inherit}b,strong{font-weight:bolder}code,kbd,pre,samp{font-family:ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;font-size:1em}small{font-size:80%}sub,sup{font-size:75%;line-height:0;position:relative;vertical-align:baseline}sub{bottom:-.25em}sup{top:-.5em}table{text-indent:0;border-color:inherit;border-collapse:collapse}button,input,optgroup,select,textarea{font-family:inherit;font-size:100%;font-weight:inherit;line-height:inherit;color:inherit;margin:0;padding:0}button,select{text-transform:none}[type=button],[type=reset],[type=submit],button{-webkit-appearance:button;background-color:transparent;background-image:none}:-moz-focusring{outline:auto}:-moz-ui-invalid{box-shadow:none}progress{vertical-align:baseline}::-webkit-inner-spin-button,::-webkit-outer-spin-button{height:auto}[type=search]{-webkit-appearance:textfield;outline-offset:-2px}::-webkit-search-decoration{-webkit-appearance:none}::-webkit-file-upload-button{-webkit-appearance:button;font:inherit}summary{display:list-item}blockquote,dd,dl,figure,h1,h2,h3,h4,h5,h6,hr,p,pre{margin:0}fieldset{margin:0;padding:0}legend{padding:0}menu,ol,ul{list-style:none;margin:0;padding:0}textarea{resize:vertical}input::placeholder,textarea::placeholder{opacity:1;color:#9ca3af}[role=button],button{cursor:pointer}:disabled{cursor:default}audio,canvas,embed,iframe,img,object,svg,video{display:block;vertical-align:middle}img,video{max-width:100%;height:auto}[hidden]{display:none}*, ::before, ::after{--tw-border-spacing-x:0;--tw-border-spacing-y:0;--tw-translate-x:0;--tw-translate-y:0;--tw-rotate:0;--tw-skew-x:0;--tw-skew-y:0;--tw-scale-x:1;--tw-scale-y:1;--tw-pan-x: ;--tw-pan-y: ;--tw-pinch-zoom: ;--tw-scroll-snap-strictness:proximity;--tw-ordinal: ;--tw-slashed-zero: ;--tw-numeric-figure: ;--tw-numeric-spacing: ;--tw-numeric-fraction: ;--tw-ring-inset: ;--tw-ring-offset-width:0px;--tw-ring-offset-color:#fff;--tw-ring-color:rgb(59 130 246 / 0.5);--tw-ring-offset-shadow:0 0 #0000;--tw-ring-shadow:0 0 #0000;--tw-shadow:0 0 #0000;--tw-shadow-colored:0 0 #0000;--tw-blur: ;--tw-brightness: ;--tw-contrast: ;--tw-grayscale: ;--tw-hue-rotate: ;--tw-invert: ;--tw-saturate: ;--tw-sepia: ;--tw-drop-shadow: ;--tw-backdrop-blur: ;--tw-backdrop-brightness: ;--tw-backdrop-contrast: ;--tw-backdrop-grayscale: ;--tw-backdrop-hue-rotate: ;--tw-backdrop-invert: ;--tw-backdrop-opacity: ;--tw-backdrop-saturate: ;--tw-backdrop-sepia: }::-webkit-backdrop{--tw-border-spacing-x:0;--tw-border-spacing-y:0;--tw-translate-x:0;--tw-translate-y:0;--tw-rotate:0;--tw-skew-x:0;--tw-skew-y:0;--tw-scale-x:1;--tw-scale-y:1;--tw-pan-x: ;--tw-pan-y: ;--tw-pinch-zoom: ;--tw-scroll-snap-strictness:proximity;--tw-ordinal: ;--tw-slashed-zero: ;--tw-numeric-figure: ;--tw-numeric-spacing: ;--tw-numeric-fraction: ;--tw-ring-inset: ;--tw-ring-offset-width:0px;--tw-ring-offset-color:#fff;--tw-ring-color:rgb(59 130 246 / 0.5);--tw-ring-offset-shadow:0 0 #0000;--tw-ring-shadow:0 0 #0000;--tw-shadow:0 0 #0000;--tw-shadow-colored:0 0 #0000;--tw-blur: ;--tw-brightness: ;--tw-contrast: ;--tw-grayscale: ;--tw-hue-rotate: ;--tw-invert: ;--tw-saturate: ;--tw-sepia: ;--tw-drop-shadow: ;--tw-backdrop-blur: ;--tw-backdrop-brightness: ;--tw-backdrop-contrast: ;--tw-backdrop-grayscale: ;--tw-backdrop-hue-rotate: ;--tw-backdrop-invert: ;--tw-backdrop-opacity: ;--tw-backdrop-saturate: ;--tw-backdrop-sepia: }::backdrop{--tw-border-spacing-x:0;--tw-border-spacing-y:0;--tw-translate-x:0;--tw-translate-y:0;--tw-rotate:0;--tw-skew-x:0;--tw-skew-y:0;--tw-scale-x:1;--tw-scale-y:1;--tw-pan-x: ;--tw-pan-y: ;--tw-pinch-zoom: ;--tw-scroll-snap-strictness:proximity;--tw-ordinal: ;--tw-slashed-zero: ;--tw-numeric-figure: ;--tw-numeric-spacing: ;--tw-numeric-fraction: ;--tw-ring-inset: ;--tw-ring-offset-width:0px;--tw-ring-offset-color:#fff;--tw-ring-color:rgb(59 130 246 / 0.5);--tw-ring-offset-shadow:0 0 #0000;--tw-ring-shadow:0 0 #0000;--tw-shadow:0 0 #0000;--tw-shadow-colored:0 0 #0000;--tw-blur: ;--tw-brightness: ;--tw-contrast: ;--tw-grayscale: ;--tw-hue-rotate: ;--tw-invert: ;--tw-saturate: ;--tw-sepia: ;--tw-drop-shadow: ;--tw-backdrop-blur: ;--tw-backdrop-brightness: ;--tw-backdrop-contrast: ;--tw-backdrop-grayscale: ;--tw-backdrop-hue-rotate: ;--tw-backdrop-invert: ;--tw-backdrop-opacity: ;--tw-backdrop-saturate: ;--tw-backdrop-sepia: }.relative{position:relative}.mx-auto{margin-left:auto;margin-right:auto}.mx-6{margin-left:1.5rem;margin-right:1.5rem}.ml-4{margin-left:1rem}.mt-16{margin-top:4rem}.mt-6{margin-top:1.5rem}.mt-4{margin-top:1rem}.-mt-px{margin-top:-1px}.mr-1{margin-right:0.25rem}.flex{display:flex}.inline-flex{display:inline-flex}.grid{display:grid}.h-16{height:4rem}.h-7{height:1.75rem}.h-6{height:1.5rem}.h-5{height:1.25rem}.min-h-screen{min-height:100vh}.w-auto{width:auto}.w-16{width:4rem}.w-7{width:1.75rem}.w-6{width:1.5rem}.w-5{width:1.25rem}.max-w-7xl{max-width:80rem}.shrink-0{flex-shrink:0}.scale-100{--tw-scale-x:1;--tw-scale-y:1;transform:translate(var(--tw-translate-x), var(--tw-translate-y)) rotate(var(--tw-rotate)) skewX(var(--tw-skew-x)) skewY(var(--tw-skew-y)) scaleX(var(--tw-scale-x)) scaleY(var(--tw-scale-y))}.grid-cols-1{grid-template-columns:repeat(1, minmax(0, 1fr))}.items-center{align-items:center}.justify-center{justify-content:center}.gap-6{gap:1.5rem}.gap-4{gap:1rem}.self-center{align-self:center}.rounded-lg{border-radius:0.5rem}.rounded-full{border-radius:9999px}.bg-gray-100{--tw-bg-opacity:1;background-color:rgb(243 244 246 / var(--tw-bg-opacity))}.bg-white{--tw-bg-opacity:1;background-color:rgb(255 255 255 / var(--tw-bg-opacity))}.bg-red-50{--tw-bg-opacity:1;background-color:rgb(254 242 242 / var(--tw-bg-opacity))}.bg-dots-darker{background-image:url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(0,0,0,0.07)'/%3E%3C/svg%3E")}.from-gray-700\/50{--tw-gradient-from:rgb(55 65 81 / 0.5);--tw-gradient-to:rgb(55 65 81 / 0);--tw-gradient-stops:var(--tw-gradient-from), var(--tw-gradient-to)}.via-transparent{--tw-gradient-to:rgb(0 0 0 / 0);--tw-gradient-stops:var(--tw-gradient-from), transparent, var(--tw-gradient-to)}.bg-center{background-position:center}.stroke-red-500{stroke:#ef4444}.stroke-gray-400{stroke:#9ca3af}.p-6{padding:1.5rem}.px-6{padding-left:1.5rem;padding-right:1.5rem}.text-center{text-align:center}.text-right{text-align:right}.text-xl{font-size:1.25rem;line-height:1.75rem}.text-sm{font-size:0.875rem;line-height:1.25rem}.font-semibold{font-weight:600}.leading-relaxed{line-height:1.625}.text-gray-600{--tw-text-opacity:1;color:rgb(75 85 99 / var(--tw-text-opacity))}.text-gray-900{--tw-text-opacity:1;color:rgb(17 24 39 / var(--tw-text-opacity))}.text-gray-500{--tw-text-opacity:1;color:rgb(107 114 128 / var(--tw-text-opacity))}.underline{-webkit-text-decoration-line:underline;text-decoration-line:underline}.antialiased{-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale}.shadow-2xl{--tw-shadow:0 25px 50px -12px rgb(0 0 0 / 0.25);--tw-shadow-colored:0 25px 50px -12px var(--tw-shadow-color);box-shadow:var(--tw-ring-offset-shadow, 0 0 #0000), var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow)}.shadow-gray-500\/20{--tw-shadow-color:rgb(107 114 128 / 0.2);--tw-shadow:var(--tw-shadow-colored)}.transition-all{transition-property:all;transition-timing-function:cubic-bezier(0.4, 0, 0.2, 1);transition-duration:150ms}.selection\:bg-red-500 *::selection{--tw-bg-opacity:1;background-color:rgb(239 68 68 / var(--tw-bg-opacity))}.selection\:text-white *::selection{--tw-text-opacity:1;color:rgb(255 255 255 / var(--tw-text-opacity))}.selection\:bg-red-500::selection{--tw-bg-opacity:1;background-color:rgb(239 68 68 / var(--tw-bg-opacity))}.selection\:text-white::selection{--tw-text-opacity:1;color:rgb(255 255 255 / var(--tw-text-opacity))}.hover\:text-gray-900:hover{--tw-text-opacity:1;color:rgb(17 24 39 / var(--tw-text-opacity))}.hover\:text-gray-700:hover{--tw-text-opacity:1;color:rgb(55 65 81 / var(--tw-text-opacity))}.focus\:rounded-sm:focus{border-radius:0.125rem}.focus\:outline:focus{outline-style:solid}.focus\:outline-2:focus{outline-width:2px}.focus\:outline-red-500:focus{outline-color:#ef4444}.group:hover .group-hover\:stroke-gray-600{stroke:#4b5563}@media (prefers-reduced-motion: no-preference){.motion-safe\:hover\:scale-\[1\.01\]:hover{--tw-scale-x:1.01;--tw-scale-y:1.01;transform:translate(var(--tw-translate-x), var(--tw-translate-y)) rotate(var(--tw-rotate)) skewX(var(--tw-skew-x)) skewY(var(--tw-skew-y)) scaleX(var(--tw-scale-x)) scaleY(var(--tw-scale-y))}}@media (prefers-color-scheme: dark){.dark\:bg-gray-900{--tw-bg-opacity:1;background-color:rgb(17 24 39 / var(--tw-bg-opacity))}.dark\:bg-gray-800\/50{background-color:rgb(31 41 55 / 0.5)}.dark\:bg-red-800\/20{background-color:rgb(153 27 27 / 0.2)}.dark\:bg-dots-lighter{background-image:url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(255,255,255,0.07)'/%3E%3C/svg%3E")}.dark\:bg-gradient-to-bl{background-image:linear-gradient(to bottom left, var(--tw-gradient-stops))}.dark\:stroke-gray-600{stroke:#4b5563}.dark\:text-gray-400{--tw-text-opacity:1;color:rgb(156 163 175 / var(--tw-text-opacity))}.dark\:text-white{--tw-text-opacity:1;color:rgb(255 255 255 / var(--tw-text-opacity))}.dark\:shadow-none{--tw-shadow:0 0 #0000;--tw-shadow-colored:0 0 #0000;box-shadow:var(--tw-ring-offset-shadow, 0 0 #0000), var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow)}.dark\:ring-1{--tw-ring-offset-shadow:var(--tw-ring-inset) 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color);--tw-ring-shadow:var(--tw-ring-inset) 0 0 0 calc(1px + var(--tw-ring-offset-width)) var(--tw-ring-color);box-shadow:var(--tw-ring-offset-shadow), var(--tw-ring-shadow), var(--tw-shadow, 0 0 #0000)}.dark\:ring-inset{--tw-ring-inset:inset}.dark\:ring-white\/5{--tw-ring-color:rgb(255 255 255 / 0.05)}.dark\:hover\:text-white:hover{--tw-text-opacity:1;color:rgb(255 255 255 / var(--tw-text-opacity))}.group:hover .dark\:group-hover\:stroke-gray-400{stroke:#9ca3af}}@media (min-width: 640px){.sm\:fixed{position:fixed}.sm\:top-0{top:0px}.sm\:right-0{right:0px}.sm\:ml-0{margin-left:0px}.sm\:flex{display:flex}.sm\:items-center{align-items:center}.sm\:justify-center{justify-content:center}.sm\:justify-between{justify-content:space-between}.sm\:text-left{text-align:left}.sm\:text-right{text-align:right}}@media (min-width: 768px){.md\:grid-cols-2{grid-template-columns:repeat(2, minmax(0, 1fr))}}@media (min-width: 1024px){.lg\:gap-8{gap:2rem}.lg\:p-8{padding:2rem}}

        /* Custom drop-down menu styles */
        .dropdown {
            position: relative;
            display: inline-block;
            float: right;
        }

        .dropbtn {
            background-color: #092f20;
            color: #ffffff;
            padding: 10px;
            font-size: 16px;
            border: none;
            cursor: pointer;
            border-radius: 7px;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            z-index: 1;
            left: -50px;
            border-radius: 10px;
        }

        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdown-content a:hover {
            background-color: #eaeaea;
            border-radius: 10px;

        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        .charts-container {
            display: flex;
            justify-content: center;
            align-items: flex-start;
            /* margin-top: 50px; */
        }

        .charts-container {
            display: flex;
            justify-content: flex-start;
            /* margin-top: 10px; */
        }

        .charts-container>div {
            display: flex;
            flex-direction: column;
            /* margin-right: 50px; */
            flex-basis: 50%;
        }

        .charts-container>div>div {
            /* margin-bottom: 20px; */
        }
    </style>
@endsection
@section('title')
    <title>Van As Bloemen</title>
@endsection
@section('header')
    <h1 style="color: #e2e8f0; font-size: 100px">Flor'as</h1>
@endsection
@section('content')
    @php
        function calculateMetrics(): array
        {
            $totalPurchaseValue = DB::table('invoices')->sum('value');
            $soldPurchaseValue = DB::table('invoices')
                ->where('paid', true)
                ->sum('amount_to_pay');
            $ordered = DB::table('invoices')->count();
            $revenue = 0;
        
            $invoices = DB::table('invoices')
                ->where('paid', true)
                ->get();
            foreach ($invoices as $invoice) {
                $price = $invoice->amount_to_pay * ($invoice->profit_margin / 100);
                $revenue += $price;
            }
        
            $profitMargin = $revenue != 0 ? round((($revenue - $totalPurchaseValue) / $revenue) * 100, 2) : 0;
        
            return [
                'totalPurchaseValue' => $totalPurchaseValue,
                'soldPurchaseValue' => $soldPurchaseValue,
                'ordered' => $ordered,
                'revenue' => $revenue,
                'profitMargin' => $profitMargin,
            ];
        }
        
        $metrics = calculateMetrics();
        
        function truckMetrics(): array
        {
            $trucks = [0, 1, 3, 4, 5]; // Truck IDs
            $currentWeek = date('W');
        
            $weeks = range($currentWeek - 5, $currentWeek); // Weeks
            //    dd($weeks);
            $truckMetrics = [];
            foreach ($trucks as $truck) {
                foreach ($weeks as $week) {
                    $query = DB::table('invoices')
                        ->where('truck_id', '=', '' . $truck)
                        ->where('week', '=', '' . $week)
                        ->get();
                    $totalPurchaseValue = $query->sum('amount_to_pay');
        
                    $totalValue = $query->sum('value');
        
                    $revenue = $totalPurchaseValue - $totalValue;
                    $profitMargin = DB::table('invoices')
                        ->where('truck_id', '=', '' . $truck)
                        ->where('week', '=', '' . $week)
                        ->avg('profit_margin');
        
                    $truckMetrics[$truck][$week] = [
                        'totalPurchaseValue' => $totalPurchaseValue,
                        'revenue' => $revenue,
                        'profitMargin' => $profitMargin,
                    ];
                }
            }
        
            return $truckMetrics;
        }
        
        $truckMetrics = truckMetrics();
    @endphp
    <div class="tables"
        style="display:grid; 
    grid-template-rows:1fr 1fr;
    grid-template-columns: 1fr 1fr;
    height: 100%;
    width: 100vh;
    margin-left:auto;
    margin-right:auto;
    margin-top:50px;
   margin-bottom:20px;
        justify-content: center;
        allign-items: center;
    gap: 20px;
    ">
        <div class="table-container"
            style="display: grid; grid-template-rows: 1fr 9fr; background-color: white;  border-radius: 10px; width: auto; margin-bottom: 0">

            <p class="sm:text-left" style="color:#1a202c; font-size: 22px; text-align: center; background-color: white;  ">
                Sales Performance (Last 4 weeks + current week)</p>
            <table class="table is-bordered is-striped is-narrow is-hoverable" style="font-size:14px">
                <tr>
                    <th></th>
                    <th>Truck 0</th>
                    <th>Truck 1</th>
                    <th>Truck 3</th>
                    <th>Truck 4</th>
                    <th>Truck 5</th>
                    <th>Full overview</th>
                </tr>

                <tr>
                    <th>Purchase value (sold)</th>
                    <td>€{{ number_format($totalPurchaseSoldT0, 2, '.', ',') }}</td>
                    <td>€{{ number_format($totalPurchaseSoldT1, 2, '.', ',') }}</td>
                    <td>€{{ number_format($totalPurchaseSoldT3, 2, '.', ',') }}</td>
                    <td>€{{ number_format($totalPurchaseSoldT4, 2, '.', ',') }}</td>
                    <td>€{{ number_format($totalPurchaseSoldT5, 2, '.', ',') }}</td>
                    <td>€{{ number_format($totalPurchaseSold, 2, '.', ',') }}</td>
                </tr>
                <tr>
                    <th>Orders</th>

                    <td>{{ $invoiceAmountT0 }}</td>
                    <td>{{ $invoiceAmountT1 }}</td>
                    <td>{{ $invoiceAmountT3 }}</td>
                    <td>{{ $invoiceAmountT4 }}</td>
                    <td>{{ $invoiceAmountT5 }}</td>
                    <td>{{ $invoiceAmountTotal }}</td>
                </tr>
                <tr>
                    <th>Revenue</th>
                    <td>€{{ number_format($totalRevenue[0], 2, '.', ',') }}</td>
                    <td>€{{ number_format($totalRevenue[1], 2, '.', ',') }}</td>
                    <td>€{{ number_format($totalRevenue[3], 2, '.', ',') }}</td>
                    <td>€{{ number_format($totalRevenue[4], 2, '.', ',') }}</td>
                    <td>€{{ number_format($totalRevenue[5], 2, '.', ',') }}</td>
                    <td>{{ '€' . number_format(array_sum($totalRevenue), 2, '.', ',') }}</td>
                </tr>
                {{-- <tr>
             

                <th>Profit Margin</th>
                <td>{{ $profitMarginT0 }}%</td>
                <td>{{ $profitMarginT1 }}%</td>
                <td>{{ $profitMarginT3 }}%</td>

                <td>{{ $profitMarginT4 }}%</td>
                <td>{{ $profitMarginT5 }}%</td>
                <td>{{ $profitMargin }}%</td>

            </tr> --}}

            </table>
        </div>

        <div class="charts-container "   style="display: flex; flex-direction: column; background-color: white;  border-radius: 10px; width: auto; padding: 2em;"
       >
            <div>
                <div style=" display: flex; flex-direction: column; background-color: white; width: auto; ">
                    <h3 style="color:#1a202c; font-size: 25px; text-align: center; background-color: white;">
                        Total Purchase Value</h3>
                    <canvas id="totalPurchaseValueChart" style="height: 300px; "></canvas>
                </div>
            </div>
        </div>


        <div class="charts-container"   style="display: flex; flex-direction: column; background-color: white;  border-radius: 10px; width: auto; padding: 2em;">
            <div>
                <div style="">
                    <h3 style="color:#1a202c; font-size: 25px; text-align: center; background-color: white;">
                        Profit Margin</h3>
                    <canvas id="profitMarginChart" style="height: 300px;"></canvas>
                </div>
            </div>
        </div>
        <div class="charts-container"
            style="display: flex; flex-direction: column; background-color: white;  border-radius: 10px; width: auto; padding: 2em;">
            <div>
                <div
                    style="display: flex; flex-direction: column; background-color: white;; border-radius: 10px; width: auto; padding: 1em; ">
                    <h3 style="color:#1a202c; font-size: 25px; text-align: center; background-color: white;">
                        Profit</h3>
                    <canvas id="revenueChart" style="height: 300px;"></canvas>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const truckMetrics = {!! json_encode($truckMetrics) !!};

        // Create a function to extract the data for a specific metric and truck
        function extractData(metric, truck) {
            return Object.values(truckMetrics[truck]).map((weekData) => weekData[metric]);
        }

        // Define the colors for each truck consistently
        const truckColors = {
            1: '#388F75',
            3: '#DD7931',
            4: '#B4B4B4',
            5: '#4D4D4D',
            0: '#FF5A5F',
        };
        const datasetKeys = Object.keys(truckMetrics).filter(truck => truck !== 'T2');

        // Create an array to store the chart instances
        const charts = [];

        // Create the totalPurchaseValue chart
        const currentDate = new Date();

        // Set the first day of the week to Sunday (0), or Monday (1) if your week starts on Monday
        const firstDayOfWeek = 0;

        // Get the ISO week number by calculating the number of full weeks passed since the beginning of the year
        const weekNumber = Math.ceil((((currentDate - new Date(currentDate.getFullYear(), 0, 1 + (firstDayOfWeek - 1))) /
            86400000) + 1 + new Date(currentDate.getFullYear(), 0, 1 + (firstDayOfWeek - 1)).getDay()) / 7);

        // Output the week number

        const totalPurchaseValueChart = new Chart('totalPurchaseValueChart', {
            type: 'line',
            data: {
                labels: [weekNumber - 5, weekNumber - 4, weekNumber - 3, weekNumber - 2, weekNumber - 1,
                    'Current Week'
                ],
                datasets: datasetKeys.map((truck) => ({
                    label: truck == '0' ? 'B1' : 'T' + truck,
                    data: extractData('totalPurchaseValue', truck),
                    borderColor: truckColors[truck],
                    fill: false,
                })),
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                },
            },
        });
        charts.push(totalPurchaseValueChart);

        // Create the revenue chart
        const revenueChart = new Chart('revenueChart', {
            type: 'line',
            data: {
                labels: [weekNumber - 5, weekNumber - 4, weekNumber - 3, weekNumber - 2, weekNumber - 1,
                    'Current Week'
                ],
                datasets: datasetKeys.map((truck) => ({
                    label: truck == '0' ? 'B1' : 'T' + truck,
                    data: extractData('revenue', truck),
                    borderColor: truckColors[truck],
                    fill: false,

                })),
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                },
            },
        });
        charts.push(revenueChart);

        // Create the profit margin chart
        const profitMarginChart = new Chart('profitMarginChart', {
            type: 'line',
            data: {
                labels: [weekNumber - 5, weekNumber - 4, weekNumber - 3, weekNumber - 2, weekNumber - 1,
                    'Current Week'
                ],
                datasets: Object.keys(truckMetrics).map((truck) => ({
                    label: truck == '0' ? 'B1' : 'T' + truck,

                    data: extractData('profitMargin',
                        truck), // Replace 'profitMargin' with the correct data field for profit margin
                    borderColor: truckColors[truck],
                    fill: false,
                })),
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                },
            },
        });
        charts.push(profitMarginChart);
    </script>
@endsection

@section('footer')
@endsection
