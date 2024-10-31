<!-- Page Sidebar Ends-->
<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-6 ps-0">
                    <h3>sizes</h3>
                </div>
                <div class="col-sm-6 pe-0">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">
                                <svg class="stroke-icon">
                                    <use href="/web1/assets/svg/icon-sprite.svg#stroke-home"></use>
                                </svg></a></li>
                        <li class="breadcrumb-item">sizes</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid starts-->
    <div class="container-fluid basic_table">
        <div class="row g-5 d-flex justify-content-space-between">

            {{-- start of image table --}}
            <div class="col-sm-5">
                <div class="card">
                    <div class="card-header ">
                        <h3>Images</h3>
                    </div>

                    <div class="align-self-end m-3">
                        <button class="btn btn-primary" type="button" wire:click="openImageModal"> Add
                            image</button>
                    </div>
                    {{-- <div class="form-group search-form m-2">
                        <input wire:model.live.debounce.150ms="search" type="text" placeholder="Search here...">
                    </div> --}}
                    <div class="table-responsive custom-scrollbar mt-2">
                        <table class="table">
                            <thead>
                                <tr class="border-bottom-primary">
                                    <th scope="col"></th>
                                    <th scope="col">Id</th>
                                    <th scope="col">image</th>
                                    <th scope="col">Created_at</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($product_images as $prod_image)
                                    <tr class="border-bottom-secondary">
                                        <th> <input class="form-check-input" wire:model="selectedImageItems"
                                                type="checkbox" id="checkbox-{{ $prod_image->id }}"
                                                value="{{ $prod_image->id }}"></th>
                                                <th>{{ $prod_image->id }}</th>
                                        <th > <img class="img-30" src="/products/{{$prod_image->image}}"
                                            alt="No Image"></th>
                                        <th>{{ $prod_image->created_at }}</th>
                                        <td>
                                            <div>
                                                <div class="">
                                                    <button wire:click="deleteImage({{ $prod_image->id }})"
                                                        class="btn btn-danger btn-sm" type="submit">
                                                        <i wire:loading.remove
                                                            wire:target="deleteImage({{ $prod_image->id }})"
                                                            class="bi bi-trash3-fill"></i>
                                                        <span wire:loading
                                                            wire:target="deleteImage({{ $prod_image->id }})"
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
                    {{-- <div class="m-2">
                        {{ $product_sizes->withQueryString()->links() }}
                    </div> --}}
                    <div class="align-self-start m-3">
                        <button wire:click="deleteSelectedImages" class="btn btn-primary" type="submit">
                            <span wire:loading.remove wire:target="deleteSelectedImages">Delete Selected</span>
                            <span wire:loading wire:target="deleteSelectedImages"
                                class="spinner-border spinner-border-sm" aria-hidden="true"></span>
                        </button>
                    </div>
                </div>
            </div>



            <div class="col-sm-6">
                <div class="card">
                    <div class="card-header ">
                        <h3>Sizes</h3>
                    </div>

                    <div class="align-self-end m-3">
                        <button class="btn btn-primary" type="button" wire:click="openSizeModal"> Add
                            size</button>
                    </div>
                    {{-- <div class="form-group search-form m-2">
                        <input wire:model.live.debounce.150ms="search" type="text" placeholder="Search here...">
                    </div> --}}
                    <div class="table-responsive custom-scrollbar mt-2">
                        <table class="table">
                            <thead>
                                <tr class="border-bottom-primary">
                                    <th scope="col"></th>
                                    <th scope="col">Id</th>
                                    <th scope="col">name</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Created_at</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($product_sizes as $prod_size)
                                    <tr class="border-bottom-secondary">
                                        <th> <input class="form-check-input" wire:model="selectedSizeItems"
                                                type="checkbox" id="checkbox-{{ $prod_size->id }}"
                                                value="{{ $prod_size->id }}"></th>
                                        <th scope="row">{{ $prod_size->id }}</th>
                                        <th scope="row">{{ $prod_size->size->name }}</th>
                                        <th scope="row">{{ $prod_size->quantity }}</th>
                                        <td>{{ $prod_size->created_at }}</td>
                                        <td>
                                            <div>
                                                <div class="">
                                                    <button wire:click="deleteSize({{ $prod_size->id }})"
                                                        class="btn btn-danger btn-sm" type="submit">
                                                        <i wire:loading.remove
                                                            wire:target="deleteSize({{ $prod_size->id }})"
                                                            class="bi bi-trash3-fill"></i>
                                                        <span wire:loading
                                                            wire:target="deleteSize({{ $prod_size->id }})"
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
                    {{-- <div class="m-2">
                        {{ $product_sizes->withQueryString()->links() }}
                    </div> --}}
                    <div class="align-self-start m-3">
                        <button wire:click="deleteSelectedSizes" class="btn btn-primary" type="submit">
                            <span wire:loading.remove wire:target="deleteSelectedSizes">Delete Selected</span>
                            <span wire:loading wire:target="deleteSelectedSizes"
                                class="spinner-border spinner-border-sm" aria-hidden="true"></span>
                        </button>
                    </div>
                </div>
            </div>
        </div>



        <!-- Create Size Modal -->
        <div wire:ignore.self class="modal fade" id="SizeModal" data-bs-backdrop="static" data-bs-keyboard="false"
            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form wire:submit="saveSize">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Size</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="validationCustom01">Size</label>
                                <select wire:model="size_id" name="size" id="" class="form-control">
                                    <option value="" selected>Please select a size</option>
                                    @foreach ($sizes as $size)
                                        <option value="{{ $size->id }}">{{ $size->name }}</option>
                                    @endforeach
                                </select>
                                @error('size_id')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="validationCustom01">Quantity</label>
                                <input wire:model="quantity" class="form-control" id="validationCustom01"
                                    type="number">
                                @error('quantity')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-secondary" wire:loading.attr="disabled"
                                wire:target="saveSize">
                                <span wire:loading.remove wire:target="saveSize">Add size</span>
                                <span wire:loading wire:target="saveSize" class="spinner-border spinner-border-sm"
                                    role="status" aria-hidden="true"></span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- Create Size  Modal -->


        <!-- Create Size Modal -->
        <div wire:ignore.self class="modal fade" id="ImageModal" data-bs-backdrop="static" data-bs-keyboard="false"
            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form wire:submit="saveImage">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">image</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="validationCustom01">Upload Image</label>
                                <input wire:model="image" class="form-control" id="validationCustom01"
                                    type="file">
                                @error('image')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-secondary" wire:loading.attr="disabled"
                                wire:target="saveImage">
                                <span wire:loading.remove wire:target="saveImage">Add image</span>
                                <span wire:loading wire:target="saveImage" class="spinner-border spinner-border-sm"
                                    role="status" aria-hidden="true"></span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- Create Size  Modal -->


    </div>
    <!-- Container-fluid Ends-->

    <script>
        window.addEventListener("openSizeModal", function(e) {

            $("#SizeModal").modal("show");
        });

        window.addEventListener("openImageModal", function(e) {

            $("#ImageModal").modal("show");
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
