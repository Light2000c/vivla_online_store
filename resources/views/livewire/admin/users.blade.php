<!-- Page Sidebar Ends-->
<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-6 ps-0">
                    <h3>Users</h3>
                </div>
                <div class="col-sm-6 pe-0">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">
                                <svg class="stroke-icon">
                                    <use href="/web1/assets/svg/icon-sprite.svg#stroke-home"></use>
                                </svg></a></li>
                        <li class="breadcrumb-item">Users</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid starts-->
    <div class="container-fluid basic_table">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header ">
                        <h3>User Table</h3>
                    </div>

                    <div class="form-group search-form m-2">
                        <input type="text" placeholder="Search here...">
                    </div>
                    <div class="table-responsive custom-scrollbar mt-2">
                        <table class="table">
                            <thead>
                                <tr class="border-bottom-primary">
                                    <th scope="col">Id</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Phone</th>
                                    <th scope="col">Password</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">Verified_at</th>
                                    <th scope="col">Created_at</th>
                                    <th scope="col">Updated_at</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="border-bottom-secondary">
                                    <th> <input class="form-check-input" id="flexCheckDefault" type="checkbox"
                                            value=""></th>
                                    <th scope="row">1</th>
                                    <td>Wolfe</td>
                                    <td>RamJacob@twitter</td>
                                    <td>Developer</td>
                                    <td>Developer</td>
                                    <td>Apple Inc.</td>
                                    <td>Php</td>
                                    <td>IND</td>
                                    <td>
                                        <div>
                                            <div class="">
                                                <button class="btn btn-primary btn-sm" type="submit"><i
                                                        class="bi bi-pencil-square"></i></button>
                                                <button class="btn btn-danger btn-sm" type="submit"><i
                                                        class="bi bi-trash3-fill"></i></button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Team Member</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="validationCustom01">Name</label>
                            <input class="form-control" id="validationCustom01" type="text"
                                placeholder="Name" required="">
                            <small class="text-danger">error text</small>
                        </div>

                        <div class="mb-3">
                            <label for="validationCustom01">Email</label>
                            <input class="form-control" id="validationCustom01" type="email"
                                placeholder="name@example.com" required="">
                            <small class="text-danger">error text</small>
                        </div>

                        <div class="mb-3">
                            <label for="validationCustom01">Phone</label>
                            <input class="form-control" id="validationCustom01" type="number"
                                placeholder="Phone Number" required="">
                            <small class="text-danger">error text</small>
                        </div>

                        <div class="mb-3">
                            <label for="validationCustom01">Password</label>
                            <input class="form-control" id="validationCustom01" type="email"
                                placeholder="Password" required="">
                            <small class="text-danger">error text</small>
                        </div>
                        
                        <div class="mb-3">
                            <label for="validationCustom01">Confirm Password</label>
                            <input class="form-control" id="validationCustom01" type="email"
                                placeholder="Confirm Password" required="">
                            <small class="text-danger">error text</small>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Add Member</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->

    </div>
    <!-- Container-fluid Ends-->
</div>
