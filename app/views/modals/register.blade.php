<!-- Modal -->
<div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="registerModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <div class="panel-heading">
                    <strong>Register Yourself</strong>
                </div>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="registerForm" method="POST" action="{{ URL::to('signup') }}" >
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Name</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="name" required aria-required="true"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label">Email address</label>
                        <div class="col-sm-6">
                            <input type="email" class="form-control" name="email" required aria-required="true"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label">Password</label>
                        <div class="col-sm-6">
                            <input type="password" class="form-control" name="password" minlength="6" required aria-required="true"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label">Confirm Password</label>
                        <div class="col-sm-6">
                            <input type="password" class="form-control" name="confirm_password" required aria-required="true"/>
                        </div>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <input type="submit" form="registerForm" name="submitButton" class="btn btn-dark btn-success" value="Submit" />
            </div>
        </div>
    </div>
</div>

<script>
    /*$(document).ready(
        function()
        {
            $('#registerForm').bootstrapValidator(
                {
                    feedbackIcons:
                    {
                        valid: 'glyphicon glyphicon-ok',
                        invalid: 'glyphicon glyphicon-remove',
                        validating: 'glyphicon glyphicon-refresh'
                    },
                    live: 'submitted'
                }
            );
        }
    );*/
</script>