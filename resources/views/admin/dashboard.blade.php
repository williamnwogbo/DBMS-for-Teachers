@extends('layouts.admin')
@section('style')
    <link href="{{ url('css/form.css') }}" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="{{ url('assets/bootstrap-datepicker/css/datepicker.css') }}" />
    <!-- date range picker -->
    <link rel="stylesheet" type="text/css" href="{{ url('assets/bootstrap-daterangepicker/daterangepicker.css') }}" />
    @stop

@section('content')

        <!--main content start-->
        <section id="main-content">
            <section class="wrapper">
                <!-- page start-->
                <div class="row">
                    <div class="col-lg-12">
                        <section class="panel">
                            <header class="panel-heading">
                                Registration
                            </header>
                            <div class="panel-body">

                                <div class="container">

                                    <div class="stepwizard col-md-offset-2">
                                        <div class="stepwizard-row setup-panel">
                                            <div class="stepwizard-step">
                                                <a href="#step-1" type="button" class="btn btn-primary btn-circle">1</a>
                                                <p>BioData</p>
                                            </div>
                                            <div class="stepwizard-step">
                                                <a href="#step-2" type="button" class="btn btn-default btn-circle" disabled="disabled">2</a>
                                                <p>Status</p>
                                            </div>
                                            <div class="stepwizard-step">
                                                <a href="#step-3" type="button" class="btn btn-default btn-circle" disabled="disabled">3</a>
                                                <p>Coordination</p>
                                            </div>
                                        </div>
                                    </div>

                                    <form role="form" action="" method="post">
                                        <div class="row setup-content" id="step-1">
                                            <div class="col-xs-6 col-md-offset-2 form-change">
                                                <div class="col-md-12">
                                                    <h3> Step 1</h3>
                                                    <div class="form-group">
                                                        <div class="row-fluid">
                                                            <div class="col-lg-4 col_l">
                                                                <label class="control-label">Title</label>
                                                                <input   type="text" name="title" value="{{ old('title') }}"  class="form-control" placeholder="Title"  />
                                                            </div>

                                                            <div class="col-lg-4 col_l">
                                                                <label class="control-label">Surname</label>
                                                                <input   type="text" name="surname" value="{{ old('surname') }}"  class="form-control"/>
                                                            </div>
                                                            <div class="col-lg-4 col_r">
                                                                <label class="control-label">Other names</label>
                                                                <input   type="text" name="othernames" value="{{ old('othernames') }}"  class="form-control" />
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="control-label">TSC File No</label>
                                                        <input  type="text"  name="tsc_file_no" value="{{ old('tsc_file_no') }}" class="form-control" />
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="control-label">OG File No</label>
                                                        <input  type="text"  name="og_file_no" value="{{ old('og_file_no') }}" class="form-control" />
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">Date of Birth</label>
                                                        <input  type="text"  name="date_of_birth" value="{{ old('date_of_birth') }}" class="form-control"/>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">Email</label>
                                                        <input  type="text"  name="email" value="{{ old('email') }}" class="form-control"  />
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">Phone number</label>
                                                        <input  type="text"  name="phone_no" value="{{ old('phone_no') }}" class="form-control"  />
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">Nationality</label>
                                                        <input  type="text"  name="country_id" value="{{ old('country_id') }}" class="form-control"  />
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">State of Origin</label>
                                                        {!! Form::select('state_id',['Select a State'] + $states->toArray(),'',['class' => 'form-control state_id','onchange' => 'getLocalGovt()']) !!}
                                                     </div>
                                                    <div class="form-group">
                                                        <label class="control-label">Local Government of Origin</label>
                                                        <select class="form-control" name="local_govt_id" id="localGovt" required>

                                                        </select>
                                                     </div>
                                                    <div class="form-group">
                                                        <label class="control-label">Ward of Origin</label>
                                                        <input  type="text"  name="ward" value="{{ old('ward') }}" class="form-control"/>
                                                    </div>
                                                    <button class="btn btn-primary nextBtn btn-lg pull-right" type="button" >Next</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row setup-content" id="step-2">
                                            <div class="col-xs-6 col-md-offset-2 form-change">
                                                <div class="col-md-12">
                                                    <h3> Status</h3>

                                                    <div class="col-md-12 col_l" >
                                                    <div class="col-md-4 col_l">
                                                        <div class="form-group">
                                                            <label class="control-label">Professional Status</label>
                                                            <!- So this data is static doesn't changes so there isn't a need to add it in the controller -->
                                                           <?php
                                                                $status = ["" => 'Select a professional Status','Professional','Non Professional'];
                                                            ?>
                                                            {!! Form::select('professional_status',$status,'',['class' => 'form-control state_id','onchange' => 'getLocalGovt()']) !!}

                                                           </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="control-label">Qualification</label>
                                                            <input name="qualification" type="text" value="{{ old('qualification') }}"    class="form-control"  />
                                                        </div>
                                                    </div>
                                                        <div class="col-md-4 col_r">
                                                            <div class="form-group">
                                                                <label class="control-label">Year</label>
                                                                <input name="year" type="text" value="{{ old('year') }}" onkeypress='return event.charCode >= 48 && event.charCode <= 57'  class="form-control"  />
                                                            </div>
                                                        </div>

                                                        </div>
                                                    <div class="form-group">
                                                        <label class="control-label">Subject of Specialization</label>
                                                        {!! Form::select('subject_of_specialisation',$subjects,old('subject_of_specialisation'),['class' => 'form-control state_id','onchange' => 'getLocalGovt()']) !!}

                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">Staff Classification</label>
                                                        <?php
                                                        $classifications = ["" => 'Select Staff Classification','Teaching','Non Teaching'];
                                                        ?>
                                                        {!! Form::select('classifications',$classifications,'',['class' => 'form-control state_id','onchange' => 'getLocalGovt()']) !!}

                                                     </div>
                                                    <div class="form-group">
                                                        <label class="control-label">Post Held</label>
                                                        <input type="text" value="{{ old('post_held') }}" name="post_held" class="form-control"  />
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-sm-12 col_l">Date of 1st Appointment in Ogun State</label>
                                                        <div class="col-sm-12 col_l col_r">
                                                            <input id="dp1" type="text" value="{{ old('appointment') }}" size="16" name="appointment" class="form-control">
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="control-label">Date of Last Promotion</label>
                                                        <input type="text" value="{{ old('last_promotion') }}" id="dp2" name="last_promotion" class="form-control "/>
                                                    </div>

                                                    <button class="btn btn-primary nextBtn btn-lg pull-right" type="button" >Next</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row setup-content" id="step-3">
                                            <div class="col-xs-6 col-md-offset-2 form-change">
                                                <div class="col-md-12">
                                                    <h3>COORDINATION: <a href="javascript:;" onclick="cloneRow()" class="btn btn-primary pull-right"><i class="icon icon_plus"></i></a></h3>
                                                    <table class="table table-bordered">
                                                        <thead>
                                                        <th>Name of School</th>
                                                        <th style="width: 150px;">Subject</th>
                                                        <th>Designation while in school</th>
                                                        <th>Last Grade Level in School</th>
                                                        <th colspan="2">Date Posted</th>
                                                        </thead>
                                                        <tbody class="table_append">
                                                        <tr class="first_data">
                                                            <td><input type="text" class="form-control" name="school"></td>
                                                            <td> {!! Form::select('subject_id[]',$subjects,"",['class' => 'form-control state_id','onchange' => 'getLocalGovt()']) !!}
                                                            </td>
                                                            <td><input type="text" class="form-control" name="designation[]"></td>
                                                            <td><input type="text" class="form-control" name="grade_level[]"></td>
                                                            <td><input id="dp3" type="text" value="{{ old('appointment') }}" size="16" name="from[]" class="form-control">
                                                            </td>
                                                            <td><input id="dp4" type="text" value="{{ old('appointment') }}" size="16" name="to[]" class="form-control">
                                                            </td>

                                                        </tr>

                                                        </tbody>

                                                    </table>



                                                    <button class="btn btn-success btn-lg pull-right" type="submit">Submit</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </section>
                    </div>
                </div>
                <!-- page end-->
            </section>
        </section>
        <!--main content end-->

    @stop

@section('script')
    <script src="{{ url('/js/jquery.smartWizard.js') }}"></script>
    <!--custome script for all page-->
    <script src="{{ url('/js/scripts.js') }}"></script>
    <script src="{{  url('/js/form-wizard.js') }}"></script>
    <script type="text/javascript" src="{{ url('assets/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>
    <script type="text/javascript" src="{{ url('assets/bootstrap-daterangepicker/date.js') }}"></script>
    <script type="text/javascript" src="{{ url('assets/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ url('js/form-component.js') }}"></script>
    <script type="text/javascript">
        function cloneRow(){
                var $table_data = $('.first_data').clone();
                $('.table_append').append($table_data);

        }
        function getLocalGovt(){
                var state_id = $('.state_id').val();
                var  formData = "state_id="+ state_id;

                $.ajax({
                    url : "{{ url('/api/get/local_govt') }}",
                    type: "POST",
                    data : formData,
                    success: function(data)
                    {
                        $('#localGovt')
                                .find('option')
                                .remove()
                                .end();
                        $.each(data, function(key, value) {
                            $('#localGovt')
                                    .append($("<option></option>")
                                            .attr("value",key)
                                            .text(value));
                        });

                    }
                });
            }
       </script>

@stop