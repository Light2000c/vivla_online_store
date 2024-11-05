<!-- Page Sidebar Ends-->
<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-6 ps-0">
                    <h3>prices</h3>
                </div>
                <div class="col-sm-6 pe-0">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">
                                <svg class="stroke-icon">
                                    <use href="/web1/assets/svg/icon-sprite.svg#stroke-home"></use>
                                </svg></a></li>
                        <li class="breadcrumb-item">prices</li>
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
                        <h3>Price Table</h3>
                    </div>

                    <div class="align-self-end m-3">
                        <button class="btn btn-primary" type="button" wire:click="openCreateModal"> Add
                            Price</button>
                    </div>
                    <div class="form-group search-form m-2">
                        <input wire:model.live.debounce.150ms="search" type="text" placeholder="Search here...">
                    </div>
                    <div class="table-responsive custom-scrollbar mt-2">
                        <table class="table">
                            <thead>
                                <tr class="border-bottom-primary">
                                    <th scope="col"></th>
                                    <th scope="col">Id</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Created_at</th>
                                    <th scope="col">Updated_at</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($prices as $price)
                                    <tr class="border-bottom-secondary">
                                        <th> <input class="form-check-input" wire:model="selectedItems" type="checkbox"
                                                id="checkbox-{{ $price->id }}" value="{{ $price->id }}"></th>
                                        <th scope="row">{{ $price->id }}</th>
                                        <td>{{ $price->name }}</td>
                                        <td>{{ $price->price }}</td>
                                        <td>{{ $price->created_at }}</td>
                                        <td>{{ $price->updated_at }}</td>
                                        <td>
                                            <div>
                                                <div class="">
                                                    <button wire:click="openUpdateModal({{ $price->id }})"
                                                        class="btn btn-primary btn-sm" type="submit"><i
                                                            class="bi bi-pencil-square"></i></button>
                                                    <button wire:click="delete({{ $price->id }})"
                                                        class="btn btn-danger btn-sm" type="submit">
                                                        <i wire:loading.remove wire:target="delete({{ $price->id }})"
                                                            class="bi bi-trash3-fill"></i>
                                                        <span wire:loading wire:target="delete({{ $price->id }})"
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
                    <div class="m-2">
                        {{ $prices->withQueryString()->links() }}
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
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">price</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="validationCustom01">Name</label>
                                <input wire:model="name" class="form-control" id="validationCustom01" type="text"
                                    placeholder="Full Name">
                                @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="validationCustom01">Price</label>
                                <input wire:model="price" class="form-control" id="validationCustom01" type="number"  step="0.01" min="0">
                                @error('pricee')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-secondary" wire:loading.attr="disabled"
                                wire:target="store">
                                <span wire:loading.remove wire:target="store">Add price</span>
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
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">price</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="validationCustom01">Name</label>
                                <input wire:model="name" class="form-control" id="validationCustom01" type="text"
                                    placeholder="Full Name">
                                @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="validationCustom01">Price</label>
                                <input wire:model="price" class="form-control" id="validationCustom01" type="number" step="0.01" min="0">
                                @error('pricee')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-secondary" wire:target="update"
                                wire:loading.attr="disabled">
                                <span wire:loading.remove wire:target="update">Save changes</span>
                                <span wire:loading wire:target="update" class="spinner-border spinner-border-sm"
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
