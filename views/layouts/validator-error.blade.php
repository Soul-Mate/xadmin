@if(count($errors)>0)
<div class="alert alert-danger alert-dismissable">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4><i class="icon fa fa-ban"></i>Error.</h4>
    @forelse($errors->all() as $error)
        <p>{{$error}}</p>
        @empty
    @endforelse
</div>
@endif