@extends('common.layout')

@section('content')
    <section class="section" style="height: 1200px ;">
        <div class="container">
            <div class="columns">
                <div class="column is-12"> {{-- These divs are needed for proper layout --}}
                    <form method="POST" action="{{route('users.update', $user)}}">
                        @csrf
                        @method('PUT')
                        <div class="card"> {{-- The form is placed in side a Bulma Card component --}}
                            <header class="card-header">

                                <p class="card-header-title"
                                   style="font-size:22px; !important"> {{-- The Card header content --}}
                                    Edit user
                                </p>
                            </header>

                            <div class="card-content">
                                <div class="content">
                                    {{-- Here are all the form fields --}}
                                    <div class="field">
                                        <label class="label">Name</label>
                                        <div class="control">
                                            <input name="name"
                                                   class="input
                                           @error('name') is-danger @enderror--}} "
                                                   id="name"
                                                   type="text" value="{{$user->name}}">
                                        </div>
                                        @error('name')
                                        <p class="help is-danger">{{ $message }}</p>
                                        @enderror
                                    </div>


                                    {{-- Here are all the form fields --}}
                                    <div class="field">
                                        <label class="label">Email</label>
                                        <div class="control">
                                            <input name="email" class="
                                            input @error('name') is-danger @enderror
                                                "
                                                   id="email"
                                                   type="text" value="{{$user->email}}">
                                        </div>
                                        @error('email')
                                        <p class="help is-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="field">
                                        <label class="label">Role</label>
                                        <div class="select col-md-6 @error('role') is-danger @enderror">
                                            <select class="col-md-6" name="role"  id="role">
                                                <option id="user" value="user"  {{ $user->role === 'user' ? "selected" : ''}}>Normal User</option>
                                                <option id="admin" value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                                            </select>
                                            @if ($errors->has('role'))
                                                <span class="text-danger">{{ $errors->first('role') }}</span>
                                            @endif
                                        </div>
                                    </div>



                                    <div class="field is-grouped">
                                        {{-- Here are the form buttons: save, reset and cancel --}}
                                        <div class="control">
                                            <button type="submit" class="button is-primary">Save</button>
                                        </div>
                                        <div class="control">
                                            <a type="button" href="/users" class="button is-light">Cancel</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
                </form>
            </div>
        </div>
        </div>
    </section>
@endsection
