@extends('layouts.master')

@section('content')
	<div>
	    <h1>New Thread</h1>

	    <form class="form-horizontal" role="form" method="POST" action="{{ route('saveNewThread') }}">
            {{ csrf_field() }}

            <div class="form-group row">
			    <label for="inputPassword" class="col-sm-2 col-form-label">Thread Title</label>
			    <div class="col-sm-10">
			      	<input class="form-control" placeholder="Title" name="title" required>
				</div>
			</div>
            <div class="form-group">
                <button type="submit" class="btn btn-dark">
                    New Thread
                </button>
            </div>
    	</form>
	</div>
@endsection