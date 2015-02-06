<!-- Modal -->
<div class="modal fade" id="deleteAppModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body text-right">
                <form method="post" action="{{URL::to('app-delete')}}">
                    <div class="panel-heading">
                        <strong>Are you sure you want to delete this app?</strong>
                    </div>
                    <input type="hidden" name="app_id" id="delete_app_id" value=""/>
                    <div class="buttons-container text-right">
                        <input type="submit" class="btn btn-dark" value="Yes" />
                        <input type="button" data-dismiss="modal" class="btn btn-dark" value="No" />
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>