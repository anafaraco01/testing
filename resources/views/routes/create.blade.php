@extends('common.layout')

@section('content')
    <section class="hero is-medium is-bold">
        <div class="hero-body">
            <form method="POST" action="{{ route('routes.store') }}">
                @csrf
                <div class="card"> {{-- The form is placed inside a Bulma Card component --}}
                    <header class="card-header">
                        <p class="card-header-title"> {{-- The Card header content --}}
                            Add a new Route
                        </p>
                    </header>

                    <div class="card-content">
                        <div class="content">

                            {{-- Here are all the form fields --}}
                            <div class="field">
                                <label class="label">Truck ID:</label>
                                <div class="control">
                                    <input name="truck_id" class="input @error('truck_id') is-danger @enderror"
                                           type="number" >
                                </div>
                                @error('truck_id')
                                <p class="help is-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="field">
                                <label class="label">Starting Point</label>
                                <div class="control">
                                    <input name="start_place" class="input @error('start_place') is-danger @enderror"
                                           type="text" placeholder="Starting Point goes here...">
                                </div>
                                @error('start_place')
                                <p class="help is-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="field">
                                <label class="label">Ending Point</label>
                                <div class="control">
                                    <input name="end_place" class="input @error('end_place') is-danger @enderror"
                                           type="text" placeholder="Ending Point goes here..." >
                                </div>
                                @error('end_place')
                                <p class="help is-danger">{{ $message }}</p>
                                @enderror
                            </div>





                        </div>
                        <div class="field is-grouped">
                            {{-- Here are the form buttons: save, reset and cancel --}}
                            <div class="control">
                                <button type="submit" class="button is-primary">Save</button>
                            </div>
                            <div class="control">
                                <button type="reset" class="button is-warning">Reset</button>
                            </div>
                            <div class="control">
                                <a type="button" href="/routes" class="button is-light">Cancel</a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </section>
@endsection
