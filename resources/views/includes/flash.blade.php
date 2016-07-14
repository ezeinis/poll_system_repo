@if(Session::has('flash_message'))
    <div class="alert alert-{{session('flash_message.type')}}" role="alert">{{session('flash_message.message')}}</div>
@endif
