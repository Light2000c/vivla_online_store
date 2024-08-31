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
                        <button class="btn btn-primary" type="button" wire:click="openCreateModal"> Add
                            Category</button>
                    </div>
                    <div class="form-group search-form m-2">
                        <input type="text" placeholder="Search here...">
                    </div>
                    <div class="table-responsive custom-scrollbar mt-2">
                        <table class="table">
                            <thead>
                                <tr class="border-bottom-primary">
                                    <th scope="col"></th>
                                    <th scope="col">Id</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Created_at</th>
                                    <th scope="col">Updated_at</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $category)
                                    <tr class="border-bottom-secondary">
                                        <th> <input class="form-check-input" wire:model="selectedItems" type="checkbox"
                                                id="checkbox-{{ $category->id }}" value="{{ $category->id }}"></th>
                                        <th scope="row">{{ $category->id }}</th>
                                        <td>{{ $category->name }}</td>
                                        <td>{{ $category->created_at }}</td>
                                        <td>{{ $category->updated_at }}</td>
                                        <td>
                                            <div>
                                                <div class="">
                                                    <button wire:click="openUpdateModal({{ $category->id }})"
                                                        class="btn btn-primary btn-sm" type="submit"><i
                                                            class="bi bi-pencil-square"></i></button>
                                                    <button wire:click="delete({{ $category->id }})"
                                                        class="btn btn-danger btn-sm" type="submit">
                                                        <i wire:loading.remove wire:target="delete({{ $category->id }})"
                                                            class="bi bi-trash3-fill"></i>
                                                        <span wire:loading wire:target="delete({{ $category->id }})"
                                                            class="spinner-border spinner-border-sm"
                                                            aria-hidden="true"></span>
                                                    </button>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="align-self-start m-3">
                        <button wire:click="deleteSelected" class="btn btn-primary" type="submit">
                            <span wire:loading.remove wire:target="deleteSelected">Delete Selected</span>
                            <span wire:loading wire:target="deleteSelected" class="spinner-border spinner-border-sm"
                                aria-hidden="true"></span>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Create Modal -->
        <div wire:ignore.self class="modal fade" id="createModal" data-bs-backdrop="static" data-bs-keyboard="false"
            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form wire:submit="store">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Category</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="validationCustom01">Name</label>
                                <input wire:model="title" class="form-control" id="validationCustom01" type="text"
                                    placeholder="Category Name">
                                @error('title')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-secondary">
                                <span wire:loading.remove wire:target="store">Add category</span>
                                <span wire:loading wire:target="store" class="spinner-border spinner-border-sm"
                                    role="status" aria-hidden="true"></span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- Create  Modal -->

        <!-- Update Modal -->
        <div wire:ignore.self class="modal fade" id="updateModal" data-bs-backdrop="static" data-bs-keyboard="false"
            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form wire:submit="update">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Category >
                                {{ $activeCategory->name ?? '' }}</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="validationCustom01">Name</label>
                                <input wire:model="title" class="form-control" id="validationCustom01"
                                    type="text" placeholder="Category Name">
                                @error('title')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                        </div>
                      <div class="modal-footer">
                            <button type="submit" class="btn btn-secondary">
                                <span wire:loading.remove wire:target="store">Add category</span>
                                <span wire:loading wire:target="store" class="spinner-border spinner-border-sm"
                                    role="status" aria-hidden="true"></span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- Update  Modal -->

    </div>
    <!-- Container-fluid Ends-->

    <script>
        window.addEventListener("openCreateModal", function(e) {

            $("#createModal").modal("show");
        });

        window.addEventListener("closeCreateModal", function(e) {

            $("#createModal").modal("hide");
        });

        window.addEventListener("openUpdateModal", function(e) {

            $("#updateModal").modal("show");
        });

        window.addEventListener("closeUpdateModal", function(e) {

            $("#updateModal").modal("hide");
        });


        window.addEventListener('message', function(e) {

            let data = e.detail;

            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            });
            Toast.fire({
                icon: data.icon,
                title: data.title
            });

        });
    </script>
</div>
