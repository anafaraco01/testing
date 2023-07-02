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

        /* tr {
            display: grid;
            grid-template-columns: 1fr 1.5fr 2fr 2fr 2fr;
        } */

        .button-primary {
            background-color: #00d1b2;
            color: white;
        }
    </style>
@endsection

@section('content')
    <section class="hero  is-bold" style="background-color: #092F20; opacity: 80%;">
        <div class="hero-body">
            <div class="container">
                <p class="title is-2" style="color: white">Profile</p>
            </div>
        </div>
    </section>
    @include('common.notifications')
    @stack('scripts')

    <section class="section" style="min-height: 771px">
        <div class="container">
            <div class="columns">
                <div class="column is-12">
                    <div class="content">
                        <table class="table" style="margin-top: 15px; border-radius: 10px;">
                            <thead>
                                <tr>
                                    <th>Username:</th>
                                    <td class="has-text-centered" >{{ $user->name }}</td>
                                    <td class="has-text-right"><a class="button button-primary" href="{{ route('username') }}">Change</a></td>
                                </tr>
                                <tr>
                                    <th>Email:</th>
                                    <td class="has-text-centered">{{ $user->email }}</td>
                                    <td class="has-text-right"><a  href="{{ route('email') }}" class="button button-primary">Change</a></td>
                                </tr>
                                <tr>
                                    <th>Password:</th>
                                    <td class="has-text-centered">*******</td>
                                    <td class="has-text-right"><a class="button button-primary" href="{{ route('password') }}">Change</a></td>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

