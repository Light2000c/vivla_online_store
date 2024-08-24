<!-- Page Sidebar Ends-->
<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-6 ps-0">
                    <h3>Categories</h3>
                </div>
                <div class="col-sm-6 pe-0">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">
                                <svg class="stroke-icon">
                                    <use href="/web1/assets/svg/icon-sprite.svg#stroke-home"></use>
                                </svg></a></li>
                        <li class="breadcrumb-item">Categories</li>
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
                        <h3>Category Table</h3>
                    </div>

                    <div class="align-self-end m-3">
                        <button class="btn btn-primary" type="button" data-bs-toggle="modal"
                            data-bs-target="#staticBackdrop"> Add Category</button>
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
                                    <td>RamJacob@twitter</td>
                                    <td>Developer</td>
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
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Category</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="validationCustom01">Name</label>
                            <input class="form-control" id="validationCustom01" type="text" placeholder="Name"
                                required="">
                            <small class="text-danger">error text</small>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Add category</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->

    </div>
    <!-- Container-fluid Ends-->
</div>
