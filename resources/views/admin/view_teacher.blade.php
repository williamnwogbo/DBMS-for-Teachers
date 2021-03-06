@extends('layouts.admin')
@section('style')
    <link rel="stylesheet" type="text/css" href="{{ url('css/select2.min.css') }}" />
@stop
@section('content')
    <section id="main-content">
        <section class="wrapper">
            <div class="row">
                <!-- profile-widget -->
                <div class="col-lg-12">
                    <div class="profile-widget profile-widget-info">
                        <div class="panel-body">
                            <div class="col-lg-12 col-sm-12">
                                <h4 class="text-left offset-0"> {{ $teacher->title." ".ucwords($teacher->surname." ".$teacher->othernames) }}</h4>
                                <p class="text-left">Email: {{ $teacher->email }}</p>
                                <p class="text-left">Phone: {{ $teacher->phone }} </p>
                                @if(auth()->user()->level == "1")
                                {{ Form::open(['method' => 'DELETE','style'=>'float:right', 'route' => 'teacher.delete', $teacher->id]) }}
                                {{ Form::hidden('id', $teacher->id) }}
                                {{ Form::submit('Delete', ['class' => 'text-left btn btn-danger btn-xs deleteTeacher','style' => 'display:none' ]) }}
                                {{ Form::close() }}
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- page start-->
            <div class="row">
                <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading tab-bg-info">
                            <ul class="nav nav-tabs">
                                <li class="active">
                                    <a data-toggle="tab" href="#recent-activity">
                                         Profile
                                    </a>
                                </li>
                                <li class="">
                                    <a data-toggle="tab" href="#profile">
                                        Professional
                                    </a>
                                </li>
                                <li class="">
                                    <a data-toggle="tab" href="#coordination">
                                        Cordination
                                    </a>
                                </li>
                            </ul>
                        </header>
                        <div class="panel-body">
                            <div class="tab-content">
                                <div id="recent-activity" class="tab-pane active">
                                    <section class="panel">
@include('errors.showerrors')
                                        <div class="panel-body bio-graph-info">
                                            <h1>Bio Graph</h1>
                                            <div class="row">
                                                <div class="bio-row">
                                                    <p><span>Full Name </span>: {{ $teacher->title." ".ucwords($teacher->surname." ".$teacher->othernames) }}</p>
                                                </div>
                                                <div class="bio-row">
                                                    <p><span>TSC File No </span>: {{ $teacher->tsc_file_no }}</p>
                                                </div>
                                                <div class="bio-row">
                                                    <p><span>OG File No</span>: {{ $teacher->og_file_no }}</p>
                                                </div>
                                                <div class="bio-row">
                                                    <p><span>Date of Birth </span>: {{ \Carbon\Carbon::parse($teacher->date_of_birth)->format('M d ,Y') }}</p>
                                                </div>
                                                <div class="bio-row">
                                                    <p><span>Nationality </span>: {{ $teacher->nationality }}</p>
                                                </div>
                                                <div class="bio-row">
                                                    <p><span>State of Origin </span>: {{ $teacher->state->name }}</p>
                                                </div>
                                                <div class="bio-row">
                                                    <p><span>LGA </span>: {{ $teacher->lga->name }}</p>
                                                </div>
                                                <div class="bio-row">
                                                    <p><span>Ward </span>:  {{ $teacher->ward }}</p>
                                                </div>
                                                <div class="bio-row">
                                                    <p><span>Gender </span>: @if($teacher->gender == "0")
                                                                                 Male
                                                    @else
Female
                                                        @endif
                                                    </p>
                                                </div>
                                                <div class="bio-row">
                                                    <p><span>Religion </span>:   @if($teacher->gender == "0")
                                                            Christian
                                                        @else
                                                            Muslim
                                                        @endif</p>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                    <section>
                                        <div class="row">
                                        </div>
                                    </section>
                                    </div>
                                <!-- profile -->
                                <div id="profile" class="tab-pane">
                                    <section class="panel">

                                        <div class="panel-body bio-graph-info">
                                            <h1>Professional Profile   @if(auth()->user()->level == "1")
                                                    <span class="pull-right">
                                             <a href="#" data-toggle="modal" data-target="#addProfessional" class="pull-right btn btn-primary"><i class="icon_plus"></i></a>
                                         </span>
                                            @endif</h1>

                                            <div class="row">
                                                @if($teacher->professionals->count() > 0)
                                                <table class="table table-bordered">
                                                    <thead>
                                                    <th>Qualification</th>
                                                    <th>Year</th>
                                                    <th>Subject of Specialisation</th>
                                                    <th>Classification</th>
                                                    <th>Position Held</th>
                                                    <th>Appointment</th>
                                                    <th>Last Promotion</th>
                                                    @if(auth()->user()->level == 1)
                                                    <th>Action</th>
                                                        @endif
                                                    </thead>
                                                    <tbody>
                                                        @foreach($teacher->professionals as $professional)
                                                            <tr>
                                                                <td>
                                                                    @if($professional->qualification_id != "0")
                                                                    {{ $professional->qualification->name }}
                                                                        @endif
                                                                </td>
                                                                <td> {{ $professional->year }}</td>
                                                                <td>
                                                                    @if($professional->subject_of_specialisation)
                                                                    {{ $professional->subject_spec->name }}
                                                                @endif
                                                                </td>
                                                                <td>
                                                                    @if($professional->classifications == "0")
                                                                            Teaching
                                                                        @else
                                                                            Non Teaching
                                                                        @endif
                                                                </td>
                                                                <td> {{ $professional->post_held }}</td>
                                                                <td> {{ Carbon\Carbon::parse($professional->appointment)->format('d M Y') }}</td>
                                                                <td> {{ Carbon\Carbon::parse($professional->last_promotion)->format('d M Y') }}</td>
                                                                @if(auth()->user()->level == "1")
                                                                <td><a href="#" onclick="openEdit('{{ $professional->id }}','{{ $professional->qualification }}','{{ $professional->year }}','{{  $professional->subject_of_specification }}','{{ $professional->classifications }}','{{ $professional->post_held }}','{{ $professional->appointment }}','{{ $professional->last_promotion }}','{{ $professional->retirement }}')"><i class="icon_pencil-edit"></i></a>
                                                                 <a style="margin-left: 5px;margin-top: 4px;" href="javascript:;" onclick="confirmDelete('/professional/delete/{{ encrypt_decrypt('encrypt',$professional->id) }}')">    <i class="icon_blocked"></i></a>
                                                                </td>
                                                                    @endif
                                                            </tr>
                                                            @endforeach
                                                    </tbody>
                                                </table>
                                                    @else
                                                    <div class="alert alert-info">
                                                        No teacher's record was found
                                                    </div>
                                                @endif

                                            </div>
                                        </div>
                                    </section>
                                </div>
                                <div id="coordination" class="tab-pane">
                                    <section class="panel">

                                        <div class="panel-body bio-graph-info">
                                            <h1>Coordination
                                                @if(auth()->user()->level == "1")
                                                <span class="pull-right">
                                            <a href="javascript:;" onclick="cloneRow()" class="btn btn-primary pull-right"><i class="icon icon_plus"></i></a></a>
                                         </span>
                                            @endif
                                            </h1>

                                            <div class="row">
                                                @if($teacher->professionals->count() > 0)
                                                    <form action="{{ url('add/cordination') }}" method="post">

                                                        <input type="hidden" name="teacher_id" value="{{ $teacher->id }}">
                                                    <table class="table table-bordered">
                                                        <thead>
                                                        <th style="width: 200px;">Name of School</th>
                                                        <th style="width: 200px;">Subject</th>
                                                        <th>Designation while in school</th>
                                                        <th>Last Grade Level in School</th>
                                                        <th colspan="2">Date Posted</th>
                                                        @if(auth()->user()->level == "1")
                                                        <th colspan="2">Action</th>
                                                            @endif
                                                        </thead>
                                                        <tbody class="table_append">
                                                        <!- we habe to add the same proportion of data that was save->
                                                        @if($teacher->coordination)
                                                            @foreach($teacher->coordination  as $coordination)
                                                                <tr class="first_data">
                                                                    <input type="hidden" name="cordination_id[]" value="{{ $coordination->id }}"/>
                                                                    <td>
                                                                        {!! Form::select('school_info[]',$schools,$coordination->school_id,['class' => 'form-control','style' => 'width: 200px']) !!}
</td>
                                                                    <td> {!! Form::select('subject_id[]',$subjects,$coordination->subject_id,['class' => 'form-control','style' => 'width: 200px']) !!}
                                                                    </td>
                                                                    <td><input type="text" value="{{ $coordination->designation }}" class="form-control" name="designation[]"></td>
                                                                    <td><input type="text" value="{{ $coordination->grade_level }}" class="form-control" name="grade_level[]"></td>
                                                                    <td><input type="text" value="{{ $coordination->from }}"  name="from[]" onclick="activateDatetime()" class="form-control dp3">
                                                                    </td>
                                                                    <td><input type="text" value="{{ $coordination->to }}" name="to[]" class="form-control dp4">
                                                                    </td>
                                                                    @if(auth()->user()->level == "1")
                                                                    <td>
                                                                        <a href="javascript:;" onclick="confirmDelete('/cordination/delete/{{ encrypt_decrypt('encrypt',$coordination->id) }}')"><i  class="icon_blocked"></i></a>
                                                                    </td>
                                                                        @endif
                                                                </tr>
                                                            @endforeach
                                                        @endif


                                                        </tbody>

                                                    </table>

                                                        @if(auth()->user()->level == "1")
                                                        <input type="submit" class=" btn btn-info pull-right"/>
                                                            @endif
                                                    </form>
                                                @else
                                                    <div class="alert alert-info">
                                                        No Cordination record was found
                                                    </div>
                                                @endif

                                            </div>
                                        </div>
                                    </section>
                                </div>

                            </div>
                        </div>
                    </section>
                </div>
            </div>

            <!-- page end-->
        </section>
    </section>
    <div id="editProfessional" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Edit Professional Record</h4>
                </div>
                <div class="modal-body">
                    <form action="{{ url('/edit/professional') }}" method="post">
                        <input type="hidden" class="id" name="professional_id"/>
                        <label>Qualification</label>
                        {!! Form::select('qualification_id',$qualifications,old('qualification_id'),['class' => 'qualification form-control','style' => 'width: 100%']) !!}
                        <label>Year</label>
                        <input type="text" name="year" class="year form-control"/>
                        <label>Subject of Specialisation</label>
                        {!! Form::select('subject_of_specialisation',$subjects,'' ,['class' => 'form-control specialisation','style' => 'width: 100%']) !!}
                        <label>Classification</label>
                        <?php
                        $classifications = ["" => 'Select Staff Classification','Teaching','Non Teaching'];
                        ?>
                        {!! Form::select('classifications',$classifications,"",['class' => 'form-control classification','style' => 'width: 100%']) !!}
                        <label>Position Held</label>
                        <input type="text" name="post_held" class="post_held form-control"/>
                        <label>Appointment</label>
                        <input type="text" name="appointment" class="appointment form-control" id="dp4"/>
                        <label>Retirement</label>
                        <input type="text" name="retirement" class="retirement form-control" id="dp9"/>
                        <label>Last Promotion</label>
                        <input type="text" name="last_promotion" class="last_promotion form-control" id="dp5"/>
                        <br/>
                        <input type="submit" class="btn btn-info pull-right" value="Edit"/>
                        <br/>
                        <br/>
                    </form>
                </div>

            </div>

        </div>
    </div>
    <div id="addProfessional" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add Professional Record</h4>
                </div>
                <div class="modal-body">
                    <form action="{{ url('/add/professional') }}" method="post">
                        <input type="hidden" name="teacher_id" value="{{ $teacher->id }}">
                        <label>Qualification</label>
                        {!! Form::select('qualification_id',$qualifications,old('qualification_id'),['class' => 'qualification form-control','style' => 'width: 100%']) !!}
                        <label>Year</label>
                        <input type="text" name="year" class="form-control"/>
                        <label>Subject of Specialisation</label>
                        {!! Form::select('subject_of_specialisation',$subjects,'' ,['class' => 'form-control','style' => 'width: 100%']) !!}
                        <label>Classification</label>
                        <?php
                        $classifications = ["" => 'Select Staff Classification','Teaching','Non Teaching'];
                        ?>
                        {!! Form::select('classifications',$classifications,"",['class' => 'form-control','style' => 'width: 100%']) !!}
                        <label>Position Held</label>
                        <input type="text" name="post_held" class="form-control"/>
                        <label>Appointment</label>
                        <input type="text" name="appointment" class="form-control" id="dp7"/>
                        <label>Retirement</label>
                        <input type="text" name="retirement" class="form-control" id="dp2"/>
                        <label>Last Promotion</label>
                        <input type="text" name="last_promotion" class="form-control" id="dp8"/>
                        <br/>
                        <input type="submit" class="btn btn-info pull-right" value="Add"/>
                        <br/>
                        <br/>
                    </form>
                </div>

            </div>

        </div>
    </div>
@stop
@section('script')
    <script src="{{ url('/js/scripts.js') }}"></script>
    <script src="{{  url('/js/form-wizard.js') }}"></script>
    <script type="text/javascript" src="{{ url('assets/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>
    <script type="text/javascript" src="{{ url('assets/bootstrap-daterangepicker/date.js') }}"></script>
    <script type="text/javascript" src="{{ url('assets/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ url('js/form-component.js') }}"></script>

    <script>
        function cloneRow(){
            //using localstorage to save count number
            var count = localStorage.getItem('count');
            if(!count){
                count = 6;
                localStorage.setItem('count',6);
            }
            var $table_data = '<tr class="first_data'+count+'"> <td>{!! Form::select('school_info[]',$schools,"",['class' => 'form-control']) !!}</td><td>{!! Form::select('subject_id[]',$subjects,"",['class'=> 'form-control']) !!}</td><td><input type="text" class="form-control" name="designation[]"></td><td><input type="text" class="form-control" name="grade_level[]"></td><td><input type="text" name="from[]" onclick="activateDatetime(\'dp'+count+'\')" class="form-control dp'+count+'"> </td><td><input type="text" name="to[]" onclick="activateDatetime(\'dpr'+count+'\')" class="form-control dpr'+count+'"> </td></tr>';

            $('.table_append').append($table_data);
            count++;
            localStorage.setItem('count',count);
        }

        function openEdit(id,qualification,year,subject_of_specialisation,classification,post_held,appointment,last_promotion,retirement){
            $('.id').val(id);
            $('.qualification').val(qualification);
            $('.year').val(year);
            $('.specialisation').val(subject_of_specialisation);
            $('.classification').val(classification);
            console.log(classification);
            $('.post_held').val(post_held);
            $('.appointment').val(appointment);
            $('.retirement').val(retirement);
            $('.last_promotion').val(last_promotion);
            $('#editProfessional').modal('toggle');
        }
    </script>
    <script src="{{ url('js/select2.full.js') }}"></script>
    <script type="text/javascript">
        $('select').select2();
    </script>
@stop
