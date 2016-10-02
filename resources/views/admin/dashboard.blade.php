@extends('layouts.admin')
@section('style')
    <link href="{{ url('css/form.css') }}" rel="stylesheet" />
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
                                                <p>Step 2</p>
                                            </div>
                                            <div class="stepwizard-step">
                                                <a href="#step-3" type="button" class="btn btn-default btn-circle" disabled="disabled">3</a>
                                                <p>Step 3</p>
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
                                                                <input  maxlength="100" type="text" name="title" value="{{ old('title') }}" required="required" class="form-control" placeholder="Title"  />
                                                            </div>

                                                            <div class="col-lg-4 col_l">
                                                                <label class="control-label">Surname</label>
                                                                <input  maxlength="100" type="text" name="surname" value="{{ old('surname') }}" required="required" class="form-control"/>
                                                            </div>
                                                            <div class="col-lg-4 col_r">
                                                                <label class="control-label">Other names</label>
                                                                <input  maxlength="100" type="text" name="othernames" value="{{ old('othernames') }}" required="required" class="form-control" />
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="control-label">TSC File No</label>
                                                        <input maxlength="100" type="text" required="required" name="tsc_file_no" value="{{ old('tsc_file_no') }}" class="form-control" />
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="control-label">OG File No</label>
                                                        <input maxlength="100" type="text" required="required" name="og_file_no" value="{{ old('og_file_no') }}" class="form-control" />
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">Date of Birth</label>
                                                        <input maxlength="100" type="text" required="required" name="date_of_birth" value="{{ old('date_of_birth') }}" class="form-control"/>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">Email</label>
                                                        <input maxlength="100" type="text" required="required" name="email" value="{{ old('email') }}" class="form-control"  />
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">Phone number</label>
                                                        <input maxlength="100" type="text" required="required" name="phone_no" value="{{ old('phone_no') }}" class="form-control"  />
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">Nationality</label>
                                                        <input maxlength="100" type="text" required="required" name="country_id" value="{{ old('country_id') }}" class="form-control"  />
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">State of Origin</label>
                                                        {!! Form::select('state_id',$states,'',['class' => 'form-control state_id','onchange' => 'getLocalGovt()']) !!}
                                                     </div>
                                                    <div class="form-group">
                                                        <label class="control-label">Local Government of Origin</label>
                                                        <select class="form-control" name="local_govt_id" id="localGovt" required>

                                                        </select>
                                                     </div>
                                                    <div class="form-group">
                                                        <label class="control-label">Ward of Origin</label>
                                                        <input maxlength="100" type="text"  name="ward" value="{{ old('ward') }}" class="form-control"/>
                                                    </div>
                                                    <button class="btn btn-primary nextBtn btn-lg pull-right" type="button" >Next</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row setup-content" id="step-2">
                                            <div class="col-xs-6 col-md-offset-2 form-change">
                                                <div class="col-md-12">
                                                    <h3> Status</h3>

                                                    <div class="col-md-12">
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="control-label">Professional Status</label>
                                                            <input maxlength="200" type="text" required="required" name="professional_status" class="form-control"  />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="control-label">Qualification</label>
                                                            <input maxlength="200" type="text" name="qualification"   required="required" class="form-control"  />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="control-label">Subject of Specialization</label>
                                                            <input maxlength="200" type="text" name="qualification"   required="required" class="form-control"  />
                                                        </div>
                                                    </div>
                                                        </div>
                                                    <div class="form-group">
                                                        <label class="control-label">Company Address</label>
                                                        <input maxlength="200" type="text" required="required" class="form-control" placeholder="Enter Company Address"  />
                                                    </div>
                                                    <button class="btn btn-primary nextBtn btn-lg pull-right" type="button" >Next</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row setup-content" id="step-3">
                                            <div class="col-xs-6 col-md-offset-3">
                                                <div class="col-md-12">
                                                    <h3> Step 3</h3>
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
    <script type="text/javascript">
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