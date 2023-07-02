@extends('common.layout')

@section('style')

@endsection

@section('title')

@endsection

@section('header')

@endsection

@section('content')
    <style>
        ::placeholder{
            color: gray !important;
        }

        .format{
            text-align: center;
            font-size: 25px;
            color: black;
            background-color: white;
            padding: 12%;
            margin-top: -80px;
            margin-bottom: 2%;
            position: relative;
        }
    </style>

    <div class="container">
        <div class="box mt-4" >
            <div class="content has-text-centered">
                                                                            <?php
                                                                         $date = date('Y-m-d');
                                                                         $week = (int)date('W', strtotime($date));
                                                                         echo "Week ".($week);
                                                                         ?>
            </div>
            <div class="columns">
                <div class="column content has-text-left m-auto">
{{--                    Total Purchase value: € {{$purchaseSold[0]}}--}}
{{--                    <br>--}}
{{--                    Sold Revenue value: € {{$totalRevenue[0]}}--}}
                </div>
                <div class="column content has-text-centered">
                    <figure class="image is-64x64 is-inline-block">
                        <img class="" src="/img/truckicon.png">
                    </figure>
                </div>
                <div class="column content has-text-right m-auto">
                </div>
            </div>
        </div>
        <div class="field is-grouped" style="margin-top: 2em">
            <input type="text" class="input" id="search-input" onkeyup="filterTheTable()" placeholder="Search a customer..." style="margin-top: -10px; margin-bottom: 0px; border-radius: 10px; border: solid 1px black; box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px">
            <figure class="image is-48x48" onclick="filterTheTable()" style="cursor: pointer; margin-top: -14px; margin-left: 6px">
                <img src="/img/searchIcon.png">
            </figure>
        </div>
        <div class="columns has-text-centered">
            <div class="column">
                <div class="box table is-fullwidth is-striped is-hoverable is-centered pt-4 pb-4 mt-1">
                    <div class="content">
                        <div class="field is-grouped">
                            <select class="select" id="select-truck" style="margin-bottom: -100px; border-radius: 6px; border: solid 1px black; box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px">
                                <option value="all">
                                    All Trucks
                                </option>
                                <option value="0">
                                    Truck 0
                                </option>
                                <option value="1">
                                    Truck 1
                                </option>
                                <option value="3">
                                    Truck 3
                                </option>
                                <option value="4">
                                    Truck 4
                                </option>
                                <option value="5">
                                    Truck 5
                                </option>
                            </select>
                        </div>
                        @for ($i = 0; $i < 6; $i++)
                            @if ($i != 2)
                                <div id="tableDisplay{{$i}}">
                                    <h1>Truck: {{$i}}</h1>
                                    <table id="table{{$i}}" style=" border-bottom: solid grey 1px; margin-bottom: 30px; text-align: left">
                                        <thead>
                                        <tr>
                                            <th style="text-align: center; width: 400px">Customer</th>
                                            <th>
                                                    <?php
                                                    $date = date('Y-m-d');
                                                    $week = (int)date('W', strtotime($date));
                                                    echo "Week ".($week - 4);
                                                    ?>
                                            </th>
                                            <th>
                                                    <?php
                                                    $date = date('Y-m-d');
                                                    $week = (int)date('W', strtotime($date));
                                                    echo "Week ".($week - 3);
                                                    ?>
                                            </th>
                                            <th>
                                                    <?php
                                                    $date = date('Y-m-d');
                                                    $week = (int)date('W', strtotime($date));
                                                    echo "Week ".($week - 2);
                                                    ?>
                                            </th>
                                            <th>
                                                    <?php
                                                    $date = date('Y-m-d');
                                                    $week = (int)date('W', strtotime($date));
                                                    echo "Week ".($week - 1);
                                                    ?>
                                            </th>
                                            <th width="100">Current Week</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($customers as $customer)
                                            @if($customer->truck_id == $i)
                                                <tr>
                                                    <td style="text-align: center">@if($customer->truck_id != -1)
                                                            {{$customer->name}}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if($customer->week4 != 0)
                                                            @if($customer->week4Amnt != 0)
                                                                ✅ {{ $customer->week4Amnt}}
                                                            @else
                                                                🟡 Refund
                                                            @endif
                                                        @else
                                                            ❌
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if($customer->week3 != 0)
                                                            @if($customer->week3Amnt != 0)
                                                                ✅ {{ $customer->week3Amnt}}
                                                            @else
                                                                🟡 Refund
                                                            @endif
                                                        @else
                                                            ❌
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if($customer->week2 != 0)
                                                            @if($customer->week2Amnt != 0)
                                                                ✅ {{ $customer->week2Amnt}}
                                                            @else
                                                                🟡 Refund
                                                            @endif
                                                        @else
                                                            ❌
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if($customer->week1 != 0)
                                                            @if($customer->week1Amnt != 0)
                                                                ✅ {{ $customer->week1Amnt}}
                                                            @else
                                                                🟡 Refund
                                                            @endif
                                                        @else
                                                            ❌
                                                        @endif
                                                    </td>
                                                    <td style="width: 120px">
                                                        @if($customer->weekcr != 0)
                                                            ✅ {{ $customer->weekcrAmnt}}
                                                        @else
                                                            ❓
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                        @endfor
                    </div>
                </div>
            </div>
        </div>
        <div id="notFound">
            <!-- This division will display a message with js if the search doesn't find anything -->
        </div>
        <script>
            function filterTruck() {

                let trucks =  []

                for (let i=0; i < 6; i++){
                    if(i != 2){
                        trucks.push(document.getElementById(`tableDisplay${i}`))
                    }
                    else{
                        trucks.push("0")
                    }
                }
                for (let i=0; i < 6; i++){

                    if(i != 2){
                        if (selecttruck.value != "all"){
                            if (selecttruck.value != i){
                                trucks[i].style.display = "none"
                                console.log(i)
                            }
                            else{
                                trucks[i].style.display = "block"
                            }
                        }
                        else{
                            trucks[i].style.display = "block"
                        }
                    }
                }
            }

            const selecttruck = document.getElementById("select-truck");

            selecttruck.addEventListener("change", filterTruck)

            function filterTheTable() {
                let input, filter, table, tr, td, i, txtValue, div, errorMessage, tablesFound;
                input = document.getElementById("search-input");
                filter = input.value.toUpperCase();
                errorMessage = document.getElementById("notFound");
                tablesFound = 0;
                // Loop through all tables
                for(let j = 0; j < 6; j++){
                    div = document.getElementById(`tableDisplay${j}`)
                    if(j != 2) {
                        table = document.getElementById(`table${j}`);
                        tr = table.getElementsByTagName("tr");
                        let rowsFound = 0;
                        // Loop through all table rows, and hide those who don't match the search query
                        for (i = 0; i < tr.length; i++) {
                            td = tr[i].getElementsByTagName("td")[0];
                            if (td) {
                                txtValue = td.textContent || td.innerText;
                                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                                    errorMessage.innerHTML = "";
                                    tr[i].style.display = "";
                                    rowsFound++;
                                } else {
                                    tr[i].style.display = "none";
                                }
                            }
                        }
                        // If no rows are found, hide the table
                        if (rowsFound == 0) {
                            table.style.display = "none";
                            div.style.display = "none";
                            tablesFound--;
                        }
                        else  {table.style.display = "";
                            div.style.display = "";
                            tablesFound++;
                        }
                    }
                }
                // If no tables are found, display a message
                if(tablesFound == -5){
                    errorMessage.innerHTML = `<h1 class="format">Customer not found :(</h1>`;
                }
                console.log(tablesFound);
            }
        </script>
@endsection

@section('footer')

@endsection





