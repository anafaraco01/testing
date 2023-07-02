@extends('common.layout')

@section('content')
    <section class="hero  is-bold ">
        <div class="hero-body">
            <form method="POST" action="{{route('routes.update', $route)}}">
                @csrf
                @method('PUT')
                <div class="card" style="margin: 40px"> {{-- The form is placed inside a Bulma Card component --}}
                    <header class="card-header">
                        <p class="card-header-title" style="font-size:22px; !important"> {{-- The Card header content --}}
                            Edit a Tour
                        </p>
                    </header>

                    <div class="card-content">
                        <div class="content">

                            {{-- Here are all the form fields --}}
                            <div class="field">
                                <label class="label">Truck ID:</label>
                                <div class="control">
                                    <input name="truck_id" class="input @error('truck_id') is-danger @enderror"
                                           type="number"  value="{{$route->truck_id}}">
                                </div>
                                @error('truck_id')
                                <p class="help is-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="field">
                                <label class="label">Starting Point</label>
                                <div class="control">
                                    <input name="start_place" class="input @error('start_place') is-danger @enderror"
                                           type="text" placeholder="Starting Point goes here..." value="{{$route->start_place}}">
                                </div>
                                @error('start_place')
                                <p class="help is-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="field">
                                <label class="label">Ending Point</label>
                                <div class="control">
                                    <input name="end_place" class="input @error('end_place') is-danger @enderror"
                                           type="text" placeholder="Ending Point goes here..."  value="{{$route->end_place}}" >
                                </div>
                                @error('end_place')
                                <p class="help is-danger">{{ $message }}</p>
                                @enderror
                            </div>





                        </div>
                        <div class="field is-grouped">
                            <div class="control">
                                <button type="submit" class="button is-primary">Save</button>
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
