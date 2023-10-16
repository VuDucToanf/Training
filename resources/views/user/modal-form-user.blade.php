<div
    class="modal fade" id="basicModal" tabindex="-1" style="display: none;"
    aria-hidden="true" ng-class="isLoading ? 'show' : 'hidden'">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">
                    @{{ user ? 'Edit user' : 'Create user' }}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col mb-3">
                        <label for="nameBasic" class="form-label">Full name</label>
                        <input type="text" id="nameBasic" class="form-control" placeholder="Enter Full name"
                               ng-model="user.full_name">
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label for="emailBasic" class="form-label">Email</label>
                        <input type="email" id="emailBasic" class="form-control" placeholder="xxxx@xxx.xx"
                               ng-model="user.email">
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label for="genderBasic" class="form-label">Gender</label>
                        <select id="genderBasic" class="form-select">
                            <option value=""> Select Gender</option>
                            <option value="MALE" class="text-capitalize" ng-selected="user.gender == 'MALE'">
                                MALE
                            </option>
                            <option value="FEMALE" class="text-capitalize" ng-selected="user.gender == 'FEMALE'">
                                FEMALE
                            </option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label for="locationBasic" class="form-label">Location</label>
                        <input type="text" id="locationBasic" class="form-control"
                               ng-model="user.address">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" ng-click="user ? editUser(user.id) : createUser()">
                    Save
                </button>
            </div>
        </div>
    </div>
</div>
