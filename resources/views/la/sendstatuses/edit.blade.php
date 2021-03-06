@extends("la.layouts.app")

@section("contentheader_title")
	<a href="{{ url(config('laraadmin.adminRoute') . '/sendstatuses') }}">SendStatus</a> :
@endsection
@section("contentheader_description", $sendstatus->$view_col)
@section("section", "SendStatuses")
@section("section_url", url(config('laraadmin.adminRoute') . '/sendstatuses'))
@section("sub_section", "Edit")

@section("htmlheader_title", "SendStatuses Edit : ".$sendstatus->$view_col)

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
				{!! Form::model($sendstatus, ['route' => [config('laraadmin.adminRoute') . '.sendstatuses.update', $sendstatus->id ], 'method'=>'PUT', 'id' => 'sendstatus-edit-form']) !!}
					@la_form($module)
					
					{{--
					@la_input($module, 'user_id')
					@la_input($module, 'review_id')
					@la_input($module, 'status')
					--}}
                    <br>
					<div class="form-group">
						{!! Form::submit( 'Update', ['class'=>'btn btn-success']) !!} <button class="btn btn-default pull-right"><a href="{{ url(config('laraadmin.adminRoute') . '/sendstatuses') }}">Cancel</a></button>
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
	$("#sendstatus-edit-form").validate({
		
	});
});
</script>
@endpush
