@if(session()->has('success'))
    <div class='alert alert-success alert-dismissible'>
        <a href="#" class="close" data-dismiss='alert'>x</a>
        {{session()->get('success')}}
    </div>
@endif
