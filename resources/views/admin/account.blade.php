@extends('layouts.admin')

@section('content')
    <section id="main-content">
        <section class="wrapper">

            <div class="row">
                <div class="col-lg-6">
                    <!--notification start-->
                    <section class="panel">
                        <header class="panel-heading">
                            Accounts
                        </header>
                        <div class="panel-body">
                            @if(session('delete_data'))
                                <div class="alert alert-info"> {{ session('delete_data') }}</div>
                            @endif
                            @if($users->count())
                                <table class="table table-bordered">
                                    <thead>
                                    <th>FullName</th>
                                    <th>Email</th>
                                    <th>Level</th>
                                    <th>Action</th>
                                    </thead>
                                    <tbody>
                                    @foreach($users as $user)
                                        <tr>
                                            <td>{{ ucwords($user->full_name) }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>@if($user->level == "0")
Admin
                                                    @else
Viewer
                                                @endif
                                            </td>
                                            <td>
                                                <a href="javascript:;" onclick="confirmDelete('/account/delete/{{ encrypt_decrypt('encrypt',$user->id) }}')" class="btn btn-danger btn-xs">
                                                    Delete
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            @else
                                <div class="alert alert-info">
                                    No subject has been added to the system
                                </div>
                            @endif
                        </div>
                    </section>
                    <!--notification end-->


                </div>
                <div class="col-lg-6">
                    <section class="panel">
                        <header class="panel-heading">
                            Add New Account
                        </header>
                        <div class="panel-body">
                            @include('errors.showerrors')
                            <form action="{{ url('/users/add') }}" method="post">
                                <label>Full Name</label>
                                <input type="text" name="full_name" value="{{ old('full_name') }}" class="form-control" required/><br/>
                                <label>Email</label>
                                <input type="text" name="email" value="{{ old('email') }}" class="form-control" required/><br/>
                                <label>Password</label>
                                <input type="password" name="password" class="form-control" required/><br/>
                                <label>Level</label>
                                <?php
                                $level = ['Viewer','Admin'];
                                ?>
                                {!! Form::select('level',$level,old('level'),['class' => 'form-control']) !!}
                                <br/>
                                <input type="submit" value="Save" class="btn pull-right btn-primary"/>
                            </form>
                        </div>
                    </section>

                </div>

            </div>
        </section>
    </section>
@stop


