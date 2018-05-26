@if($errors->any())
<div class="row">
    <div class="col s6 offset-s3">
        <div class="card alert red lighten-3">
            <span class="card-title">Errors</span>
            <span class="alert-close"><i class="material-icons">close</i></span>
            <div class="card-content">
                    @foreach ($errors->all() as $error)
                    <strong>- {{ $error }} </strong><br />
                    @endforeach
            </div>
        </div>
    </div>
</div>
@endif