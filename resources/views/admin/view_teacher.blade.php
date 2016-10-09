@extends('layouts.admin')

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
                                            <h1>Professional Profile  <span class="pull-right">
                                             <a href="#" data-toggle="modal" data-target="#addProfessional" class="pull-right btn btn-info"><i class="icon_plus"></i></a>
                                         </span></h1>

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
                                                    <th>Action</th>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($teacher->professionals as $professional)
                                                            <tr>
                                                                <td>{{ $professional->qualification }}</td>
                                                                <td> {{ $professional->year }}</td>
                                                                <td> {{ $professional->subject_spec->name }}</td>
                                                                <td>
                                                                    @if($professional->classification == "1")
                                                                            Teaching
                                                                        @else
                                                                            Non Teaching
                                                                        @endif
                                                                </td>
                                                                <td> {{ $professional->post_held }}</td>
                                                                <td> {{ Carbon\Carbon::parse($professional->appointment)->format('d M Y') }}</td>
                                                                <td> {{ Carbon\Carbon::parse($professional->last_promotion)->format('d M Y') }}</td>
                                                                <td><a href="#" onclick="openEdit('{{ $professional->id }}','{{ $professional->qualification }}','{{ $professional->year }}','{{  $professional->subject_of_specification }}','{{ $professional->classification }}','{{ $professional->post_held }}','{{ $professional->appointment }}','{{ $professional->last_promotion }}')"><i class="icon_pencil-edit"></i></a>
                                                                 <a style="margin-left: 5px;margin-top: 4px;" href="javascript:;" onclick="confirmDelete('/professional/delete/{{ encrypt_decrypt('encrypt',$professional->id) }}')">    <i class="icon_blocked"></i></a>
                                                                </td>
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
                                            <h1>Coordination  <span class="pull-right">
                                            <a href="javascript:;" onclick="cloneRow()" class="btn btn-primary pull-right"><i class="icon icon_plus"></i></a></a>
                                         </span></h1>

                                            <div class="row">
                                                @if($teacher->professionals->count() > 0)
                                                    <table class="table table-bordered">
                                                        <thead>
                                                        <th>Name of School</th>
                                                        <th style="width: 150px;">Subject</th>
                                                        <th>Designation while in school</th>
                                                        <th>Last Grade Level in School</th>
                                                        <th colspan="2">Date Posted</th>
                                                        </thead>
                                                        <tbody class="table_append">
                                                        <!- we habe to add the same proportion of data that was save->
                                                        @if($teacher->coordination)
                                                            @foreach($teacher->coordination  as $coordination)
                                                                <tr class="first_data">
                                                                    <input type="hidden" name="cordination_id[]" value="{{ $coordination->id }}"/>
                                                                    <td><input type="text" value="{{ $coordination->school }}" class="form-control" name="school_info[]"></td>
                                                                    <td> {!! Form::select('subject_id[]',$subjects,$coordination->subject_id,['class' => 'form-control']) !!}
                                                                    </td>
                                                                    <td><input type="text" value="{{ $coordination->designation }}" class="form-control" name="designation[]"></td>
                                                                    <td><input type="text" value="{{ $coordination->grade_level }}" class="form-control" name="grade_level[]"></td>
                                                                    <td><input type="text" value="{{ $coordination->from }}"  name="from[]" onclick="activateDatetime()" class="form-control dp3">
                                                                    </td>
                                                                    <td><input type="text" value="{{ $coordination->to }}" name="to[]" class="form-control dp4">
                                                                    </td>

                                                                </tr>
                                                            @endforeach
                                                        @endif

                                                        </tbody>

                                                    </table>

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
                        <input type="text" name="qualification" class="qualification form-control"/>
                        <label>Year</label>
                        <input type="text" name="year" class="year form-control"/>
                        <label>Subject of Specialisation</label>
                        {!! Form::select('subject_of_specialisation',$subjects,'' ,['class' => 'form-control specialisation']) !!}
                        <label>Classification</label>
                        <?php
                        $classifications = ["" => 'Select Staff Classification','Teaching','Non Teaching'];
                        ?>
                        {!! Form::select('classifications',$classifications,"",['class' => 'form-control classification']) !!}
                        <label>Position Held</label>
                        <input type="text" name="post_held" class="post_held form-control"/>
                        <label>Appointment</label>
                        <input type="text" name="appointment" class="appointment form-control" id="dp4"/>
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
                        <input type="text" name="qualification" class="form-control"/>
                        <label>Year</label>
                        <input type="text" name="year" class="form-control"/>
                        <label>Subject of Specialisation</label>
                        {!! Form::select('subject_of_specialisation',$subjects,'' ,['class' => 'form-control']) !!}
                        <label>Classification</label>
                        <?php
                        $classifications = ["" => 'Select Staff Classification','Teaching','Non Teaching'];
                        ?>
                        {!! Form::select('classifications',$classifications,"",['class' => 'form-control']) !!}
                        <label>Position Held</label>
                        <input type="text" name="post_held" class="form-control"/>
                        <label>Appointment</label>
                        <input type="text" name="appointment" class="form-control" id="dp7"/>
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
        function openEdit(id,qualification,year,subject_of_specialisation,classification,post_held,appointment,last_promotion){
            $('.id').val(id);
            $('.qualification').val(qualification);
            $('.year').val(year);
            $('.specialisation').val(subject_of_specialisation);
            $('.classification').val(classification);
            $('.post_held').val(post_held);
            $('.appointment').val(appointment);
            $('.last_promotion').val(last_promotion);
            $('#editProfessional').modal('toggle');
        }
    </script>
@stop
