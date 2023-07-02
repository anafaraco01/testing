@extends('common.layout')
@section('style')

@endsection

@section('title')

@endsection

@section('header')
@endsection

@section('content')
{{--    @dd($prevWeekPurchaseSold);--}}
{{--    @dd($purchaseSold);--}}
{{--@dd($totalRevenue);--}}
{{--@dd($prevWeekRevenue);--}}
{{--{--@dd($truckIDs);--}}


    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <div class="container is-max-desktop">
        <div class="columns is-centered">
            <div class="column is-12">
                <div class="list has-hoverable-list-items mb-5 mt-4">

                        <div class="box">

                            <div class="list-item mb-4">
                                <strong style="font-size: 2em">  Truck {{ $truckIDs['0'] }}</strong>
                                <div class="list-item-image">
                                    <figure class="image is-32x32">
                                        <img class="truck-image" src="/img/truckicon.png">
                                    </figure>
                                    <div class="progress-wrapper is-max-desktop" style="display: flex; flex-direction: column;">
{{--                                        <div class="progress-labels" style="display: flex; justify-content: space-between;">--}}
{{--                                            <span style="color: red; margin-left: -10px;">Monday</span>--}}
{{--                                            <span style="color: red;">Tuesday</span>--}}
{{--                                            <span style="color: red; margin-right: -10px;">Wednesday</span>--}}
{{--                                        </div>--}}
{{--                                        <progress id="progress-bar-{{ $truck->id }}" class="progress is-success" value="{{ $truck->progress }}" max="100" style="width: 100%;"></progress>--}}
                                        <progress id="progress-bar-{{ $truckIDs['0'] }}" class="progress is-success" value="{{ $purchaseSold[0] }}" max="{{ $prevWeekPurchaseSold[0] }}" style="width: 100%;"></progress>
{{--                                        <p style="text-align: center; color: orange;">amount of orders: {{ $orders[0]}}</p>--}}
                                        <div style="display: flex; justify-content: space-between; margin-top: auto;">
                                            <p style="margin-left: -10px;">Purchase value Sold: €{{ $purchaseSold[0] }}</p>
                                            <p style="margin-right: -10px;">Last week Purchase value Sold: €{{ $prevWeekPurchaseSold[0]}}</p>
                                        </div>
                                    </div>
                                </div>
                                <div style="display: flex; justify-content: space-between; margin-top: 5px;">
                                    <p>Total Revenue: €{{  $totalRevenue[0]}}</p>
                                    <p>Last week Revenue €{{ $prevWeekRevenue[0] }}</p>
                                </div>
                            </div>
                        </div>
                    <div class="box">

                        <div class="list-item mb-4">
                            <strong style="font-size: 2em">  Truck {{ $truckIDs['1'] }}</strong>
                            <div class="list-item-image">
                                <figure class="image is-32x32">
                                    <img class="truck-image" src="/img/truckicon.png">
                                </figure>
                                <div class="progress-wrapper is-max-desktop" style="display: flex; flex-direction: column;">
                                    {{--                                        <div class="progress-labels" style="display: flex; justify-content: space-between;">--}}
                                    {{--                                            <span style="color: red; margin-left: -10px;">Monday</span>--}}
                                    {{--                                            <span style="color: red;">Tuesday</span>--}}
                                    {{--                                            <span style="color: red; margin-right: -10px;">Wednesday</span>--}}
                                    {{--                                        </div>--}}
                                    {{--                                        <progress id="progress-bar-{{ $truck->id }}" class="progress is-success" value="{{ $truck->progress }}" max="100" style="width: 100%;"></progress>--}}
                                    <progress id="progress-bar-{{ $truckIDs['1'] }}" class="progress is-success" value="{{ $purchaseSold['1'] }}" max="{{ $prevWeekPurchaseSold['1'] }}" style="width: 100%;"></progress>
                                    {{--                                        <p style="text-align: center; color: orange;">amount of orders: {{ $orders[0]}}</p>--}}
                                    <div style="display: flex; justify-content: space-between; margin-top: auto;">
                                        <p style="margin-left: -10px;">Purchase value Sold: €{{ $purchaseSold['1'] }}</p>
                                        <p style="margin-right: -10px;">Last week Purchase value Sold: €{{ $prevWeekPurchaseSold['1']}}</p>
                                    </div>
                                </div>
                            </div>
                            <div style="display: flex; justify-content: space-between; margin-top: 5px;">
                                <p>Total Revenue: €{{  $totalRevenue['1']}}</p>
                                <p>Last week Revenue €{{ $prevWeekRevenue['1'] }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="box">

                        <div class="list-item mb-4">
                            <strong style="font-size: 2em">  Truck {{ $truckIDs['2'] }}</strong>
                            <div class="list-item-image">
                                <figure class="image is-32x32">
                                    <img class="truck-image" src="/img/truckicon.png">
                                </figure>
                                <div class="progress-wrapper is-max-desktop" style="display: flex; flex-direction: column;">
                                                                            <div class="progress-labels" style="display: flex; justify-content: space-between;">
                                                                                <span style="color: red; margin-left: -10px;">Monday</span>
                                                                                <span style="color: red;">Tuesday</span>
                                                                                <span style="color: red; margin-right: -10px;">Wednesday</span>
                                                                            </div>
{{--                                                                            <progress id="progress-bar-{{ $truck->id }}" class="progress is-success" value="{{ $truck->progress }}" max="100" style="width: 100%;"></progress>--}}
                                    <progress id="progress-bar-{{ $truckIDs[3] }}" class="progress is-success" value="{{ $purchaseSold[3] }}" max="{{ $prevWeekPurchaseSold[3] }}" style="width: 100%;"></progress>
{{--                                                                            <p style="text-align: center; color: orange;">amount of orders: {{ $orders[0]}}</p>--}}
                                    <div style="display: flex; justify-content: space-between; margin-top: auto;">
                                        <p style="margin-left: -10px;">Purchase value Sold: €{{ $purchaseSold[3] }}</p>
                                        <p style="margin-right: -10px;">Last week Purchase value Sold: €{{ $prevWeekPurchaseSold[3]}}</p>
                                    </div>
                                </div>
                            </div>
                            <div style="display: flex; justify-content: space-between; margin-top: 5px;">
                                <p>Total Revenue: €{{  $totalRevenue[3]}}</p>
                                <p>Last week Revenue €{{ $prevWeekRevenue[3] }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="box">

                        <div class="list-item mb-4">
                            <strong style="font-size: 2em">  Truck {{ $truckIDs['3'] }}</strong>
                            <div class="list-item-image">
                                <figure class="image is-32x32">
                                    <img class="truck-image" src="/img/truckicon.png">
                                </figure>
                                <div class="progress-wrapper is-max-desktop" style="display: flex; flex-direction: column;">
                                    {{--                                        <div class="progress-labels" style="display: flex; justify-content: space-between;">--}}
                                    {{--                                            <span style="color: red; margin-left: -10px;">Monday</span>--}}
                                    {{--                                            <span style="color: red;">Tuesday</span>--}}
                                    {{--                                            <span style="color: red; margin-right: -10px;">Wednesday</span>--}}
                                    {{--                                        </div>--}}
                                    {{--                                        <progress id="progress-bar-{{ $truck->id }}" class="progress is-success" value="{{ $truck->progress }}" max="100" style="width: 100%;"></progress>--}}
                                    <progress id="progress-bar-{{ $truckIDs['3'] }}" class="progress is-success" value="{{ $purchaseSold[4] }}" max="{{ $prevWeekPurchaseSold[4] }}" style="width: 100%;"></progress>
                                    {{--                                        <p style="text-align: center; color: orange;">amount of orders: {{ $orders[0]}}</p>--}}
                                    <div style="display: flex; justify-content: space-between; margin-top: auto;">
                                        <p style="margin-left: -10px;">Purchase value Sold: €{{ $purchaseSold[4] }}</p>
                                        <p style="margin-right: -10px;">Last week Purchase value Sold: €{{ $prevWeekPurchaseSold[4]}}</p>
                                    </div>
                                </div>
                            </div>
                            <div style="display: flex; justify-content: space-between; margin-top: 5px;">
                                <p>Total Revenue: €{{  $totalRevenue[4]}}</p>
                                <p>Last week Revenue €{{ $prevWeekRevenue[4] }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="box">

                        <div class="list-item mb-4">
                            <strong style="font-size: 2em">  Truck {{ $truckIDs['4'] }}</strong>
                            <div class="list-item-image">
                                <figure class="image is-32x32">
                                    <img class="truck-image" src="/img/truckicon.png">
                                </figure>
                                <div class="progress-wrapper is-max-desktop" style="display: flex; flex-direction: column;">
                                                                            <div class="progress-labels" style="display: flex; justify-content: space-between;">
                                                                                <span style="color: red; margin-left: -10px;">Monday</span>
                                                                                <span style="color: red;">Tuesday</span>
                                                                                <span style="color: red; margin-right: -10px;">Wednesday</span>
                                                                            </div>
{{--                                                                            <progress id="progress-bar-{{ $truck->id }}" class="progress is-success" value="{{ $truck->progress }}" max="100" style="width: 100%;"></progress>--}}
                                    <progress id="progress-bar-{{ $truckIDs['4'] }}" class="progress is-success" value="{{ $purchaseSold['5'] }}" max="{{ $prevWeekPurchaseSold['5'] }}" style="width: 100%;"></progress>
{{--                                                                            <p style="text-align: center; color: orange;">amount of orders: {{ $orders[0]}}</p>--}}
                                    <div style="display: flex; justify-content: space-between; margin-top: auto;">
                                        <p style="margin-left: -10px;">Purchase value Sold: €{{ $purchaseSold['5'] }}</p>
                                        <p style="margin-right: -10px;">Last week Purchase value Sold: €{{ $prevWeekPurchaseSold['5']}}</p>
                                    </div>
                                </div>
                            </div>
                            <div style="display: flex; justify-content: space-between; margin-top: 5px;">
                                <p>Total Revenue: €{{  $totalRevenue['5']}}</p>
                                <p>Last week Revenue €{{ $prevWeekRevenue['5'] }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6">
                        {{ $trucks->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const truckImages = document.querySelectorAll('.truck-image');

        truckImages.forEach((truckImage) => {
            const progressBar = truckImage.closest('.list-item').querySelector('progress');
            const value = progressBar.value;
            const max = progressBar.getAttribute('max');
            const width = progressBar.offsetWidth;
            const position = (value / max) * (width - 64);
            truckImage.style.transform = `translateX(${position}px)`;
        });
    </script>
@endsection

@section('footer')

@endsection
