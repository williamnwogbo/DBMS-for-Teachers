@extends('layouts.admin')

@section('content')
    <section id="main-content">
        <section class="wrapper">

            <div class="row">
                <div class="col-lg-6">
                    <!--notification start-->
                    <section class="panel">
                        <header class="panel-heading">
                            Subjects
                        </header>
                        <div class="panel-body">
                            @if(session('delete_data'))
                                    <div class="alert alert-info"> {{ session('delete_data') }}</div>
                                @endif
                            @if($subjects->count())
                               <table class="table table-bordered">
                                   <thead>
                                   <th>Subject</th>
                                   <th>Action</th>
                                   </thead>
                                   <tbody>
                                   @foreach($subjects as $subject)
                                        <tr>
                                            <td>{{ ucwords($subject->name) }}</td>
                                            <td>{{ Form::open(['method' => 'DELETE', 'route' => 'subject.delete', $subject->id]) }}
                                            {{ Form::hidden('id', $subject->id) }}
                                            {{ Form::submit('Delete', ['class' => 'btn btn-danger btn-xs']) }}
                                            {{ Form::close() }}
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
                            Add Subject
                        </header>
                        <div class="panel-body">
                            @include('errors.showerrors')
                            <form action="{{ url('/subject/add') }}" method="post">
                                 <label>Subject</label>
                                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                                <input type="text" name="name" class="form-control"/><br/>
                                <input type="submit" value="Save" class="btn pull-right btn-primary"/>
                                <p style="color: red">Note once a subject has been added it cannot be edited</p>
                            </form>
                        </div>
                    </section>

                </div>

            </div>
        </section>
    </section>
    @stop


