@extends('common.layout')
@section('style')
    <style>
        table {
            width: 1200px !important;
        }
        .last-cell {
            display: flex;
        }
        .content {
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .last-cell nav {
            margin-left: auto;
        }
        tr {
            display: grid;
            grid-template-columns: 1fr 2fr 3fr 2fr 2.5fr .5fr .5fr;
        }
    </style>
@endsection

@section('content')
    <section class="hero  is-bold" style="background-color: #092F20; opacity: 80%;">
        <div class="hero-body">
            <div class="container">
                <p class="title is-2" style="color: white">Tours</p>
            </div>
        </div>
    </section>
    @include('common.notifications')
    @stack('scripts')

    <section class="section" style="min-height: 771px">
        <div class="container">
            <div class="columns">
                <div class="column is-12">
                    <div class="has-text-right">
                        <a class="button" href="/routes/create" style="background-color: #092F20; color: white">Add a new tour</a>
                    </div>
                    <div class="content">
                        <table class="table" style="margin-top: 15px; border-radius: 10px;">
                            <thead>
                            <tr>
                                <th>Tour</th>
                                <th>Starting Point</th>
                                <th>Ending Point</th>
                                <th>Truck ID</th>
                                <th>Number of debtors</th>
                                <th></th>
                                <th class="last-cell">{{ $routes->links() }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($routes as $route)

                                <tr>
                                    <td>{{ $route->id }}</td>
                                    <td><a href=" {{ route('routes.show',$route) }}">{{ $route->start_place }}</a></td>
                                    <td class="last-cell">{{ $route->end_place }}</td>
                                    <td style="text-align: center">{{ $route->truck_id }}</td>
                                    <td style="text-align: center">{{ $route->number_of_debtors }}</td>
                                    <td><a class="button is-primary" href=" {{ route('routes.edit', $route) }}">Edit</a></td>
                                   
                                    <td>
                                        <form method="POST" onclick="return confirm('Are you certain you want to delete {{$route->start_place}}, ID: {{ $route->end_place}}?')" action="{{route('routes.destroy', $route)}}">
                                            @csrf
                                            @method('DELETE')
                                            <div class="form-group">
                                                <button class="button is-danger" type="submit">Delete</button>
                                            </div>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
