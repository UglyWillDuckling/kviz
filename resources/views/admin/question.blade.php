@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Question</div>

                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                            @if (isset($question))
                                <question-component :data="{{ $question }}"></question-component>
                            @else
                                <question-component></question-component>
                            @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
