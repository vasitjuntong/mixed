<div class="clearfix">
	<div class="pull-left">
		<span class="img-demo">
			<img src="/img/logo.jpg" />
		</span>
	  <div class="pull-left m-left-sm">
		<h3 class="m-bottom-xs m-top-xs">Mixed System</h3>
	    <span class="text-muted">1 Soi Inthamara 41, Dindeang, Dindeang, Bangkok 10400 </span></div>
	</div>
	<div class="pull-right">
      <h4>REQUISITION</h4>
	  <h5><strong>{{ $requesition->document_no }}</strong></h5>
		<strong>{{ $requesition->created_at->format('jS M Y') }}</strong>
  </div>
</div>

<hr>

<div class="clearfix">
	<div class="pull-left"> 
		<h4>Information</h4> 
		<address> 
			<strong>Project : </strong>
			<a  href="#"
	  			id="editable-requisition-select" 
				data-name="project_id"
			 	data-pk="{{ $requesition->id }}" 
			 	data-url="/requisitions/edit-multi/{{ $requesition->id }}" 
			 	data-title="Enter {{ trans('requesition.attributes.project_id') }}"
			 	data-source="{{ json_encode($projectLists) }}"
			 	data-value="{{ $requesition->project_id }}"
	  		>
				{{ $requesition->project_code }}
			</a>
			<br> 
			<span style="font-weight: 700">Site ID : </span>
			<a  href="#"
	  			id="editable-requisition" 
				data-name="site_id"
			 	data-pk="{{ $requesition->id }}" 
			 	data-url="/requisitions/edit-multi/{{ $requesition->id }}" 
			 	data-title="Enter {{ trans('requesition.attributes.site_id') }}"
			 	data-source="{{ json_encode($projectLists) }}"
			 	data-value="{{ $requesition->site_id }}"
	  		>
				{{ $requesition->site_id }}
			</a>
			<br>
			<span style="font-weight: 700">Site Name : </span>
			<a  href="#"
	  			id="editable-requisition" 
				data-name="site_name"
			 	data-pk="{{ $requesition->id }}" 
			 	data-url="/requisitions/edit-multi/{{ $requesition->id }}" 
			 	data-title="Enter {{ trans('requesition.attributes.site_name') }}"
			 	data-source="{{ json_encode($projectLists) }}"
			 	data-value="{{ $requesition->site_name }}"
	  		>
				{{ $requesition->site_name }}
			</a>
			<br>
			<strong>Requested Date : </strong>{{ $requesition->created_at->format('jS M Y') }}
		</address> 
	</div>
	<div class="pull-right text-right">
		<h4>Receive By</h4> 
		<address>
			<strong>
				<a  href="#"
		  			id="editable-requisition" 
					data-name="receive_company_name"
				 	data-pk="{{ $requesition->id }}" 
				 	data-url="/requisitions/edit-multi/{{ $requesition->id }}" 
				 	data-title="Enter {{ trans('requesition.attributes.receive_company_name') }}"
				 	data-source="{{ json_encode($projectLists) }}"
				 	data-value="{{ $requesition->receive_company_name }}"
		  		>
					{{ $requesition->receive_company_name }}
				</a>
			</strong>
			<br>
			<a  href="#"
	  			id="editable-requisition" 
				data-name="receive_contact_name"
			 	data-pk="{{ $requesition->id }}" 
			 	data-url="/requisitions/edit-multi/{{ $requesition->id }}" 
			 	data-title="Enter {{ trans('requesition.attributes.receive_contact_name') }}"
			 	data-source="{{ json_encode($projectLists) }}"
			 	data-value="{{ $requesition->receive_contact_name }}"
	  		>
				{{ $requesition->receive_contact_name }}
			</a>
			<br> 
			<a  href="#"
	  			id="editable-requisition" 
				data-name="receive_phone"
			 	data-pk="{{ $requesition->id }}" 
			 	data-url="/requisitions/edit-multi/{{ $requesition->id }}" 
			 	data-title="Enter {{ trans('requesition.attributes.receive_phone') }}"
			 	data-source="{{ json_encode($projectLists) }}"
			 	data-value="{{ $requesition->receive_phone }}"
	  		>
				{{ $requesition->receive_phone }}
			</a>
			<br>
			Receve Date : 
			<a  href="#"
	  			id="editable-requisition-date" 
				data-name="receive_date"
			 	data-pk="{{ $requesition->id }}" 
			 	data-url="/requisitions/edit-multi/{{ $requesition->id }}" 
			 	data-title="Enter {{ trans('requesition.attributes.receive_date') }}"
			 	data-source="{{ json_encode($projectLists) }}"
			 	data-value="{{ $requesition->receive_date }}"
	  		>
				{{ $requesition->receive_date->format('jS M Y') }}
			</a>
        </address> 
	</div>
</div>