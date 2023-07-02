@extends('common.layout')

@section('content')
    <style>
        body {
            background-image: url('/img/changePassword-bg.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            display: grid;
            grid-template-rows: 15vh 70vh 15vh;
        }

        footer {
            margin-top: auto;
        }
    </style>

    <main class="login-form">
        <div class="cotainer">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card" style="margin-top: 100px">
                        <div class="card-header">Change your password</div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('password.update') }}">
                                @csrf
                                <div class="form-group row">
                                    <label for="password" class="col-md-4 col-form-label text-md-right">New Password</label>
                                    <div class="col-md-6">
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                        @if ($errors->has('password'))
                                            <span class="text-danger">{{ $errors->first('password') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password_confirmation" class="col-md-4 col-form-label text-md-right">Confirm Password</label>
                                    <div class="col-md-6">
                                        <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                    </div>
                                </div>

                                <label style="margin-left: 26%; margin-top: 10px; margin-bottom: 15px">
                                    These questions will serve as a password recovery method:
                                </label>

                                <div class="form-group row">
                                    <label for="secret_answer1" class="col-md-4 col-form-label text-md-right">What is your favorite flower?</label>
                                    <div class="col-md-6">
                                        <input id="secret_answer1" type="secret_answer1" value="{{ old('secret_answer1') }}" class="form-control @error('secret_answer1') is-invalid @enderror" name="secret_answer1" required>
                                        @if ($errors->has('secret_answer1'))
                                            <span class="text-danger">{{ $errors->first('secret_answer1') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="secret_answer2" class="col-md-4 col-form-label text-md-right">What is your favorite color?</label>
                                    <div class="col-md-6">
                                        <input id="secret_answer2" type="secret_answer2" class="form-control @error('secret_answer2') is-invalid @enderror" value="{{ old('secret_answer2') }}" name="secret_answer2" required>
                                        @if ($errors->has('secret_answer2'))
                                            <span class="text-danger">{{ $errors->first('secret_answer2') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <input type="hidden" value="{{ $user->id }}" name="id">

                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            Change Password
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

