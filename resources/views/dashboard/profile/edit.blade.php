@extends('dashboard.index')

@section('title')
    Products
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item active"> Profiles </li>
@endsection


@section('content')


<x-alert msg='info'> </x-alert>


    <form action="{{ route('profile.update') }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for=""> Admin First Name </label>
            <input type="text" name="first_name" class="form-control" value="{{ $user->profile->first_name }}">
            @error('first_name')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>


        <div class="form-group">
            <label for=""> Admin Last Name </label>
            <input type="text" name="last_name" class="form-control" value="{{ $user->profile->last_name }}">
            @error('last_name')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>


        <div class="form-group">
            <label for=""> Admin birthday </label>
            <input type="date" name="birthday" class="form-control" value="{{ $user->profile->birthday }}">
            @error('birthday')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>




        <div class="form-group">
            <label for=""> Gender </label>
            <select name="gender" id="" class="form-control">
                <option hidden selected value="{{ $user->profile->gender }}"> {{ $user->profile->gender }} </option>
                <option value="male"> Male </option>
                <option value="female"> Female </option>
            </select>
            @error('birthday')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>



        <div class="form-group">
            <div class="form-row">
                <div class="col-md-4">
                    <label for=""> Admin street Name </label>
                    <input type="text" name="street_address" class="form-control"
                        value="{{ $user->profile->street_address }}">
                    @error('street_address')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>

                <div class="col-md-4">
                    <label for=""> Admin City </label>
                    <input type="text" name="city" class="form-control" value="{{ $user->profile->city }}">
                    @error('city')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>

                <div class="col-md-4">
                    <label for=""> Admin State </label>
                    <input type="text" name="state" class="form-control" value="{{ $user->profile->state }}">
                    @error('state')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>



            </div>
        </div>


        <div class="form-group">


            <div class="form-row">
                <div class="col-md-4">
                    <label for=""> Admin Postal Name </label>
                    <input type="text" name="postal_code" value="{{ $user->profile->postal_code }}" class="form-control">
                    @error('postal_code')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>

                <div class="col-md-4">
                    <label for=""> country </label>
                    <select name="country" id="" class="form-control">
                        <option hidden selected value="{{ $user->profile->country }}"> {{ $user->profile->country }}
                        </option>
                        @foreach ($Countries as $key => $value)
                            <option value="{{ $key }}"> {{ $key }} </option>
                        @endforeach

                    </select>
                    @error('country')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>

                <div class="col-md-4">
                    <label for=""> Locale </label>
                    <select name="locale" id="" class="form-control">
                        <option hidden selected value="{{ $user->profile->locale }}"> {{ $user->profile->locale }}
                        </option>
                        @foreach ($Languages as $key => $value)
                            <option value="{{ $key }}"> {{ $key }} </option>
                        @endforeach

                    </select>
                    @error('locale')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit"> Done </button>

            </div>
        </div>





    </form>
@endsection
