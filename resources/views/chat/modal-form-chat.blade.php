<div
    class="modal fade" id="basicModal" tabindex="-1" style="display: none;"
    aria-hidden="true" ng-class="isLoading ? 'show' : 'hidden'">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">
                    Data user
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col mb-3">
                        <label for="idBasic" class="form-label">User Id</label>
                        <input
                            type="text"
                            id="idBasic"
                            class="form-control"
                            placeholder="Enter user id"
                            ng-model="user.id">
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label for="groupIdBasic" class="form-label">Group Id</label>
                        <input type="text" id="groupIdBasic" class="form-control" placeholder="Enter user group id"
                               ng-model="user.group_id">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal" style="display: none;">
                    Close
                </button>
                <button type="button" class="btn btn-primary" ng-click="saveDataUser()">
                    Send
                </button>
            </div>
        </div>
    </div>
</div>
