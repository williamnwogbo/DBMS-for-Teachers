@extends('layouts.admin')

@section('content')
    <section id="main-content">
        <section class="wrapper">

            <div class="row">
                <div class="col-lg-12">
                    <!--notification start-->
                    <section class="panel">
                        <header class="panel-heading">
                            Subjects
                        </header>
                        <div class="panel-body">
                            @if($teachers->count())
                                <table class="table table-bordered">
                                    <thead>
                                    <th>Full Name</th>
                                    <th>TSC File No</th>
                                    <th>Og File No</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th style="width: 100px;">Action</th>
                                    </thead>
                                    <tbody>
                                    @foreach($teachers as $teacher)
                                        <tr>
                                            <td>{{ ucwords($teacher->title." ".$teacher->surname ." ".$teacher->othernames) }}</td>
                                            <td>{{ $teacher->tsc_file_no }}</td>
                                            <td>{{ $teacher->og_file_no }}</td>
                                            <td>{{ $teacher->email }}</td>
                                            <td>{{ $teacher->phone }}</td>
                                            <td>
                                                <a href="{{ url('/teacher/view/'.encrypt_decrypt('encrypt',$teacher->id)) }}" class="btn" style="float: left"><i class="icon_search"></i></a>
                                                <a href="{{ url('/teacher/edit/'.encrypt_decrypt('encrypt',$teacher->id)) }}" class="btn" style="float: left"><i class="icon_pencil-edit"></i></a>
                                                {{--<!--Since it is eventually going to be a destop app, i would encrypt the id-->--}}
                                                {{--{{ Form::open(['method' => 'DELETE','style'=>'float:left', 'route' => 'subject.delete', $teacher->id]) }}--}}
                                                {{--{{ Form::hidden('id', $teacher->id) }}--}}
                                                {{--{{ Form::submit('Delete', ['class' => 'text-left btn btn-danger btn-xs']) }}--}}
                                                {{--{{ Form::close() }}--}}

                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                {{ $teachers->render() }}

                            @else
                                <div class="alert alert-info">
                                    No subject has been added to the system
                                </div>
                            @endif
                        </div>
                    </section>
                    <!--notification end-->


                </div>

            </div>
        </section>
    </section>
@stop


