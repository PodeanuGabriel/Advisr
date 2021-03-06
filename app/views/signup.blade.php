@extends('layout.main')

@section('content')

<?php var_dump($errors); ?>

<?php if(true) : ?>

    <div class="alert alert-error">
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        <strong>Error!</strong> A problem occurred while submitting your data.
    </div>

<?php endif; ?>

<form class="form-horizontal registerForm" id="registerForm" method="POST" action="{{ URL::to('signup') }}" >
    <div class="form-group">
        <label class="col-sm-3 control-label">Name</label>
        <div class="col-sm-6">
            <input type="text" data-bv-validatorname="true" data-bv-notempty="true"
                   class="form-control" name="name" />
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-3 control-label">Email address</label>
        <div class="col-sm-6">
            <input type="text" class="form-control" name="email"
                   data-bv-notempty="true" data-bv-emailaddress="true" />
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-3 control-label">Password</label>
        <div class="col-sm-6">
            <input type="password" class="form-control" name="password" data-bv-validatorname="true" data-bv-notempty="true"
                   minlength="6" />
        </div>
    </div>

    <div class="form-group">
        <input type="submit" form="registerForm" name="submitButton" class="btn btn-success" value="Submit" />
    </div>

</form>
@stop