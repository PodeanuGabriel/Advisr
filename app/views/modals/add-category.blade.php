<!-- Modal -->
<div class="modal fade" id="addCategoryModal" tabindex="-1" role="dialog" aria-labelledby="addCategoryModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <div class="panel-heading">
                    <strong>Add new category</strong>
                </div>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="addCategoryForm" method="POST" action="{{ URL::to('category-add') }}" >
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Name</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="category_name" required aria-required="true"/>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <input type="submit" form="addCategoryForm" name="submitButton" class="btn btn-success" value="Submit" />
            </div>
        </div>
    </div>
</div>