<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.typekit.net/oov2wcw.css"><!--Link to the family font-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
    <link rel="stylesheet" href="/css/style.css">
    @yield('style')
    @yield('title')
</head>

<header>
    <img src="/img/logo.png" class="logo-img">
    @include('common.navbar')
</header>

<main>
    <style>
        body{
            background-image: url('/img/login-bg.jpeg');
            background-size: cover;background-repeat: no-repeat;
            display: grid;
            grid-template-rows: 15vh 70vh 15vh;
        }
        footer{
            margin-top:auto;
        }
    </style>

    <div class="login-form" style="margin-top: 8%; margin-bottom: 13%">
        <div class="cotainer">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Change Username Form</div>
                        <div class="card-body">
                            @if (session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif
                            <form action="{{ route('username') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="current_name">Current Username</label>
                                    <input type="text" id="current_name" name="current_name" class="form-control" required>
                                    @error('current_name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="new_name">New Username</label>
                                    <input type="text" id="new_name" name="new_name" class="form-control" required>
                                    @error('new_name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="confirm_new_name">Confirm New Username</label>
                                    <input type="text" id="confirm_new_name" name="confirm_new_name" class="form-control" required>
                                    @error('confirm_new_name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary">Change Username</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<footer>
    {{--    @yield('footer')--}}
</footer>

</html>



