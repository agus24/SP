@ext('partials.layout')
@section('login')
<div class="container">
<div class="row">
    <div class="col-md-12 text-center">
        <div class="panel panel-default">
            <div class="panel-heading">Login</div>
            <div class="panel-body">
                <div class="form-group">
                    <form class="form-horizontal" method="POST" action="<?=makeUrl('login')?>">
                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">Username</label>
                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control" name="username" value="" required autofocus>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">Password</label>
                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" value="" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
