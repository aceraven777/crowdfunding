@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Start a Campaign</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('campaigns') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                                <label for="title" class="col-md-4 control-label">Title</label>

                                <div class="col-md-6">
                                    <input id="title" type="text" class="form-control" name="title" value="{{ old('title') }}">

                                    @if ($errors->has('title'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('title') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('goal_price') ? ' has-error' : '' }}">
                                <label for="goal_price" class="col-md-4 control-label">Goal Price</label>

                                <div class="col-md-6">
                                    <input id="goal_price" type="number" class="form-control" name="goal_price" value="{{ old('goal_price') }}">

                                    @if ($errors->has('goal_price'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('goal_price') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('image_name') ? ' has-error' : '' }}">
                                <label for="image_name" class="col-md-4 control-label">Image</label>

                                <div class="col-md-6">
                                    <input id="image_name" type="file" name="image_name" value="{{ old('image_name') }}" accept="image/*">
                                    <p class="help-block">668x445 pixels</p>

                                    @if ($errors->has('image_name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('image_name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('story') ? ' has-error' : '' }}">
                                <label for="story" class="col-md-4 control-label">Story</label>

                                <div class="col-md-6">
                                    <textarea id="story" name="story" class="form-control" cols="30" rows="10">{{ old('story') }}</textarea>

                                    @if ($errors->has('story'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('story') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('deadline') ? ' has-error' : '' }}">
                                <label for="deadline" class="col-md-4 control-label">Deadline</label>

                                <div class="col-md-6">
                                    <input id="deadline" type="text" class="form-control datepicker" name="deadline" value="{{ old('deadline') }}">

                                    @if ($errors->has('deadline'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('deadline') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-btn fa-user"></i> Start Campaign
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('custom_scripts')
    @parent

    <input type="hidden" name="js_current_date" value="{{ date("m/d/Y") }}" />

    <script type="text/javascript">
        (function ($) {
            'use strict';

            var current_date = $("[name=js_current_date]").val();

            $('.datepicker').datepicker({
                minDate: current_date
            });

        }(jQuery));
    </script>

@endsection