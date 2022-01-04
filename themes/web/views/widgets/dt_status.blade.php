@if($status==0)
    <span class='badge bg-warning text-dark'>{{__('order::datatable.awaiting confirm')}}</span>
@elseif($status==1)
    <span class='badge bg-success'>{{__('order::datatable.confirmed')}}</span>
@elseif($status==2)
    <span class='badge bg-danger'>{{__('order::datatable.canceled')}}</span>  
@endif