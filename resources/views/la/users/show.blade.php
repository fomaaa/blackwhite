@extends('la.layouts.app')

@section('htmlheader_title')
	User View
@endsection


@section('main-content')
<div id="page-content" class="profile2">


	<ul data-toggle="ajax-tab" class="nav nav-tabs profile" role="tablist">
		<li class=""><a href="{{ url(config('laraadmin.adminRoute') . '/users') }}" data-toggle="tooltip" data-placement="right" title="Back to Users"><i class="fa fa-chevron-left"></i></a></li>
		<li class="active"><a role="tab" data-toggle="tab" class="active" href="#tab-general-info" data-target="#tab-info"><i class="fa fa-bars"></i> General Info</a></li>
	</ul>

	<div class="tab-content">
		<div role="tabpanel" class="tab-pane active fade in" id="tab-info">
			<div class="tab-content">
				<div class="panel infolist">
					<div class="panel-default panel-heading">
						<h4>General Info</h4>
					</div>
					<div class="panel-body">
						@la_display($module, 'name')
						@la_display($module, 'email')
						@la_display($module, 'phone')
						@la_display($module, 'type')
						@la_display($module, 'is_ban')
						@la_display($module, 'created')
						@la_display($module, 'com_count')
						@la_display($module, 'rev_count')
						@la_display($module, 'last_login')
						@la_display($module, 'email_confirmed')
					</div>
				</div>
			</div>
		</div>
	</div>
	</div>
	</div>
</div>
@endsection
