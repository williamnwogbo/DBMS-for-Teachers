@extends('layouts.setup')

@section('content')
    <div class="container">

        <form class="login-form" action="{{ url('/installation/setup') }}" method="post">
            <div class="login-wrap">
                <p class="login-img"><i class="icon_lock_alt"></i></p>
                <h2 style="text-align: center">Installation Setup</h2>
                @include('errors.showerrors')
                <div class="input-group">
                    <span class="input-group-addon"><i class="icon_datareport"></i></span>
                    <input type="text" name="name" class="form-control" placeholder="Name of Platform" autofocus>
                </div>
                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                <div class="input-group">
                    <span class="input-group-addon"><i class="icon_profile"></i></span>
                    <input type="text" name="full_name" class="form-control" placeholder="Fullname of User" autofocus>
                </div>
                <div class="input-group">
                    <span class="input-group-addon"><i class="icon_pencil"></i></span>
                    <input type="text" name="email" class="form-control" placeholder="Email Address" autofocus>
                </div>
                <div class="input-group">
                    <span class="input-group-addon"><i class="icon_key_alt"></i></span>
                    <input type="password" name="password" class="form-control" placeholder="Password">
                </div>

                <button class="btn btn-primary btn-lg btn-block" type="submit">Setup Account</button>
            </div>
        </form>

    </div>

@stop