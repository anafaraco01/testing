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
            grid-template-columns: .5fr 1fr 3fr 4fr 1fr .5fr .5fr;
        }
        td {
            text-align: left;
        }
    </style>
@endsection

@section('title')

@endsection

@section('header')

@endsection

@section('content')
    @section('content')
        <section class="hero  is-bold" style="background-color: #092F20; opacity: 80%;">
            <div class="hero-body">
                <div class="container">
                    <p class="title is-2" style="color: white">Users</p>
                </div>
            </div>
        </section>
        @include('common.notifications')
        @stack('scripts')

        <section class="section" style="min-height: 771px">
            <div class="container">
                <div class="columns">
                    <div class="column is-12">
                        <div class="has-text-right" style="margin-bottom: 20px">
                            <a class="button" href=" {{ route('register') }}" style="background-color: #092F20; color: white">Register a new user</a>
                        </div>
                        <div class="card mt-4 mb-4 p-4">
                            <div class="card-title"><h2 class="text-center">How long a user has been logged in/out, since today.</h2></div>
                            <div id="timeline" class="cart-content"></div>
                        </div>
                        <table class="table p-4" style="border-radius: 10px; margin-left: 35px">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th></th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td><a href=" {{ route('users.show',$user) }}">{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{  $user->role }}</td>
                                    <td><a class="button is-primary" href=" {{ route('users.edit', $user) }}">Edit</a></td>
                                    <td>
                                        <form method="POST" onclick="return confirm('Are you certain you want to delete {{ $user->role }} {{$user->name}}, ID: {{$user->id}}?')" action="{{ route('users.destroy', $user) }}">
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
        </section>
    @endsection
@section('footer')
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script>

        var users = @json($users);

        if (users[0]) {
            google.charts.load('current', {'packages':['timeline']});
            google.charts.setOnLoadCallback(drawChart);

            function drawChart() {
                var container = document.getElementById('timeline');
                var chart = new google.visualization.Timeline(container);
                var dataTable = new google.visualization.DataTable();

                let oldestLogin = null;
                const currentDate = new Date();
                let color; let lastLogout; let lastLogin;

                //Checks if the date1 input is older than date2
                function isBefore(date1, date2) {
                    return date1 < date2;
                }

                dataTable.addColumn({ type: 'string', id: 'User' });
                dataTable.addColumn({ type: 'string', id: 'IP' });
                dataTable.addColumn({ type: 'string', id: 'style', role: 'style' });
                dataTable.addColumn({ type: 'date', id: 'Start' });
                dataTable.addColumn({ type: 'date', id: 'End' });

                users.forEach(function (user) {
                    let ip;

                    const lastLogoutUser = user['last_logout_at'];
                    const lastLoginUser = user['last_login_at'];

                    if (lastLoginUser !== null) {
                        lastLogin = new Date(lastLoginUser);
                    } else if (oldestLogin !== null) {
                        lastLogin = oldestLogin;
                    }

                    if (lastLogoutUser !== null) {
                        lastLogout = new Date(lastLogoutUser);
                    } else {
                        lastLogout = currentDate;
                    }

                    if (!isBefore(lastLogin, lastLogout)) {
                        lastLogout = currentDate;
                        lastLogout.setHours(lastLogout.getHours() + 1);
                        ip = user['last_login_ip'] + ' | Online';
                        color = '#6e9c8b'
                    } else {
                        ip = user['last_login_ip'] + ' | Offline';
                        color = '#214437';
                    }

                    if (user['last_login_ip'] == null) {
                        ip = "Has never logged in before."
                        color = '#edcf56';
                    }

                    dataTable.addRows([
                        [user['email'], ip, color, lastLogin, lastLogout]
                    ]);

                    if (oldestLogin !== null && isBefore(lastLogin, oldestLogin)) {
                        oldestLogin = lastLogin;
                    } else if (oldestLogin == null) oldestLogin = lastLogin;
                });
                chart.draw(dataTable);
            }
        }
    </script>
@endsection
