<!--begin:: Avatar -->
<div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
    <a href="apps/user-management/users/view.html">
        <div class="symbol-label">
            <img src="{{$url}}" alt="{{$row->name}}" class="w-100" />
        </div>
    </a>
</div>
<!--end::Avatar-->
<!--begin::User details-->
<div class="d-flex flex-column">
    <a class="text-gray-800 text-hover-primary mb-1">{{$row->name}}</a>
    <span>{{$row->email}}</span>
</div>
<!--begin::User details-->