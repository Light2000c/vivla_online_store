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
                        <input wire:model.live.debounce.150ms="search" type="text" placeholder="Search here...">
                    </div>
                    <div class="table-responsive custom-scrollbar mt-2">
                        <table class="table">
                            <thead>
                                <tr class="border-bottom-primary">
                                    <th scope="col">Id</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">Created_at</th>
                                    <th scope="col">Updated_at</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr class="border-bottom-secondary">
                                        <th> <input class="form-check-input" wire:model="selectedItems" type="checkbox"
                                                id="checkbox-{{ $user->id }}" value="{{ $user->id }}"></th>
                                        <th scope="row">{{ $user->id }}</th>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->created_at }}</td>
                                        <td>{{ $user->updated_at }}</td>
                                        <td>
                                            <div>
                                                <div class="">
                                                    <button wire:click="viewUser({{ $user->id }})"
                                                        class="btn btn-primary btn-sm" type="submit">
                                                        <i class="bi bi-eye"></i>
                                                    </button>
                                                    <button wire:click="delete({{ $user->id }})"
                                                        class="btn btn-danger btn-sm" type="submit" wire:loading.attr="disabled" wire:target="delete({{ $user->id }})">
                                                        <i wire:loading.remove wire:target="delete({{ $user->id }})"
                                                            class="bi bi-trash3-fill"></i>
                                                        <span wire:loading wire:target="delete({{ $user->id }})"
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
                        {{ $users->withQueryString()->links() }}
                    </div>
                    <div class="align-self-start m-3">
                        <button wire:click="deleteSelected" class="btn btn-primary" type="submit" wire:loading.attr="disabled" wire:target="deleteSelected">
                            <span wire:loading.remove wire:target="deleteSelected">Delete Selected</span>
                            <span wire:loading wire:target="deleteSelected" class="spinner-border spinner-border-sm"
                                aria-hidden="true"></span>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal modal-lg fade" id="viewModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">User</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        {{-- user carts --}}
                        <div class="m-2 mb-4">
                            <p>Carts</p>
                            @if ($activeCart)
                                <div class="table-responsive custom-scrollbar mt-2">
                                    <table class="table">
                                        <thead>
                                            <tr class="border-bottom-primary">
                                                <th scope="col">Id</th>
                                                <th scope="col">Customer Name</th>
                                                <th scope="col">Product Name</th>
                                                <th scope="col">Quantity</th>
                                                <th scope="col">Image</th>
                                                <th scope="col">Price</th>
                                                <th scope="col">Total</th>
                                                <th scope="col">Created_at</th>
                                                <th scope="col">Updated_at</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($activeCart as $cart)
                                                <tr class="border-bottom-secondary">
                                                    <th scope="row">{{ $cart->id }}</th>
                                                    <td>{{ $cart->user->name }}</td>
                                                    <td>{{ $cart->product->name }}</td>
                                                    <td>{{ $cart->quantity }}</td>
                                                    <td> <img class="img-30 me-2"
                                                            src="/storage/products/{{ $cart->product->image }}"
                                                            alt="profile"></td>
                                                    <td>{{ $cart->product->price }}</td>
                                                    <td>{{ $cart->product->price * $cart->quantity }}</td>
                                                    <td>{{ $cart->created_at }}</td>
                                                    <td>{{ $cart->updated_at }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                        </div>
                            {{-- user carts --}}

                            {{-- user wishlist --}}
                            @if($activeWishes)
                            <div class="mb-4">
                                <p>Wishes</p>

                                <div>
                                    <div class="table-responsive custom-scrollbar mt-2">
                                        <table class="table">
                                            <thead>
                                                <tr class="border-bottom-primary">
                                                    <th scope="col">Id</th>
                                                    <th scope="col">Customer Name</th>
                                                    <th scope="col">Product Name</th>
                                                    <th scope="col">Image</th>
                                                    <th scope="col">Price</th>
                                                    <th scope="col">Created_at</th>
                                                    <th scope="col">Updated_at</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($activeWishes as $wishlist)
                                                    <tr class="border-bottom-secondary">
                                                        <th scope="row">{{ $wishlist->id }}</th>
                                                        <td>{{ $wishlist->user->name }}</td>
                                                        <td>{{ $wishlist->product->name }}</td>
                                                        <td> <img class="img-30 me-2"
                                                                src="/storage/products/{{ $wishlist->product->image }}" alt="profile">
                                                        </td>
                                                        <td>{{ $wishlist->product->price }}</td>
                                                        <td>{{ $wishlist->created_at }}</td>
                                                        <td>{{ $wishlist->updated_at }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            @endif
                            {{-- user wishlist --}}
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Add user</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->

</div>

<script>
    window.addEventListener("openViewModal", function(e) {
        $("#viewModal").modal("show");
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
