@extends("la.layouts.app")

@section("contentheader_title")
	<a href="{{ url(config('laraadmin.adminRoute') . '/personal_statuses') }}">Personal status</a> :
@endsection
@section("contentheader_description", $personal_status->$view_col)
@section("section", "Personal statuses")
@section("section_url", url(config('laraadmin.adminRoute') . '/personal_statuses'))
@section("sub_section", "Edit")

@section("htmlheader_title", "Personal statuses Edit : ".$personal_status->$view_col)

@section("main-content")

@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="box">
	<div class="box-header">
		
	</div>
	<div class="box-body">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				{!! Form::model($personal_status, ['route' => [config('laraadmin.adminRoute') . '.personal_statuses.update', $personal_status->id ], 'method'=>'PUT', 'id' => 'personal_status-edit-form']) !!}
					@la_form($module)
					
					{{--
					@la_input($module, 'user')
					@la_input($module, 'client')
					@la_input($module, 'status')
					--}}
                    <br>
					<div class="form-group">
						{!! Form::submit( 'Update', ['class'=>'btn btn-success']) !!} <button class="btn btn-default pull-right"><a href="{{ url(config('laraadmin.adminRoute') . '/personal_statuses') }}">Cancel</a></button>
					</div>
				{!! Form::close() !!}
			</div>
		</div>
	</div>
</div>

@endsection

@push('scripts')
<script>
$(function () {
	$("#personal_status-edit-form").validate({
		
	});
});
</script>
@endpush
