@if(Session::has('alert-info'))
    <div class="row">
        <div class="col s8 offset-s2">
            <div class="card alert blue lighten-3">
                <span class="card-title">Information</span>
                <span class="alert-close"><i class="material-icons">close</i></span>
                <div class="card-content">
                    <strong>{{ Session::get('alert-info') }}</strong>
                </div>
            </div>
        </div>
    </div>
@endif