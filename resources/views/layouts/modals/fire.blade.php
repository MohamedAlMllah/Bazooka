<!-- Modal -->
<div class="modal fade" id="fireModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Fire Employee</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h3>Are you sure you want to fire this employee?</h3>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <form id="formFire" action="" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-danger">Fire</button>
                </form>
            </div>
        </div>
    </div>
</div>