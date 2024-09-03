<!-- Page Sidebar Ends-->
<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-6 ps-0">
                    <h3>Products</h3>
                </div>
                <div class="col-sm-6 pe-0">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">
                                <svg class="stroke-icon">
                                    <use href="/web1/assets/svg/icon-sprite.svg#stroke-home"></use>
                                </svg></a></li>
                        <li class="breadcrumb-item">Products</li>
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
                        <h3>Product Table</h3>
                    </div>

                    <div class="align-self-end m-3">
                        <button class="btn btn-primary" type="submit">New Product </button>
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
                                    <th scope="col">Discount</th>
                                    <th scope="col">Brand</th>
                                    <th scope="col">Category</th>
                                    <th scope="col">Tag</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Created_at</th>
                                    <th scope="col">Updated_at</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($products->count())

                                    @foreach ($products as $product)
                                        <tr class="border-bottom-secondary">
                                            <th>
                                                <input class="form-check-input" wire:model="selectedItems"
                                                    type="checkbox" id="checkbox-{{ $product->id }}"
                                                    value="{{ $product->id }}">
                                            </th>
                                            <th scope="row">{{ $product->id }}</th>
                                            <td>{{ Str::words($product->name, 8) }}</td>
                                            <td>{{ number_format($product->price) }}</td>
                                            <td>{{ $product->discount }}</td>
                                            <td>{{ $product->brand }}</td>
                                            <td>{{ $product->category }}</td>
                                            <td>{{ $product->tag }}</td>
                                            <td> <img class="img-30 me-2" src="/storage/products/{{$product->image}}"
                                                    alt="No Image"></td>
                                            <td>{{ Str::words($product->description, 8) }}</td>
                                            <td>{{ $product->created_at }}</td>
                                            <td>{{ $product->updated_at }}</td>
                                            <td>
                                                <div>
                                                    <div class="">
                                                        <a href="{{ route("edit-product", $product->id) }}" class="btn btn-primary btn-sm" type="submit"><i
                                                                class="bi bi-pencil-square"></i></a>
                                                        <button wire:click="deleteProduct({{ $product->id }})"
                                                            class="btn btn-danger btn-sm" type="submit">
                                                            <i wire:loading.remove
                                                                wire:target="deleteProduct({{ $product->id }})"
                                                                class="bi bi-trash3-fill"></i>
                                                            <span wire:loading
                                                                wire:target="deleteProduct({{ $product->id }})"
                                                                class="spinner-border spinner-border-sm"
                                                                aria-hidden="true"></span>
                                                        </button>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <div class="alert alert-info" role="alert">
                                            No Product to Show Yet!
                                        </div>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="m-2">
                        {{ $products->withQueryString()->links() }}
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
    </div>
    <!-- Container-fluid Ends-->

    <script>
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
