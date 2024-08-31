<!-- Page Sidebar Ends-->
<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-6 ps-0">
                    <h3>Address</h3>
                </div>
                <div class="col-sm-6 pe-0">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">
                                <svg class="stroke-icon">
                                    <use href="/web1/assets/svg/icon-sprite.svg#stroke-home"></use>
                                </svg></a></li>
                        <li class="breadcrumb-item">Address</li>
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
                    <div class="card-header">
                        <h3>Address Table</h3>
                    </div>

                    <div class="align-self-end search-form m-3">
                        <input type="text" placeholder="Search here...">
                    </div>
                    <div class="table-responsive custom-scrollbar mt-2">
                        <table class="table">
                            <thead>
                                <tr class="border-bottom-primary">
                                    <th scope="col"></th>
                                    <th scope="col">Id</th>
                                    <th scope="col">First Name</th>
                                    <th scope="col">Last Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Phone</th>
                                    <th scope="col">Street</th>
                                    <th scope="col">City</th>
                                    <th scope="col">Country</th>
                                    <th scope="col">Created_at</th>
                                    <th scope="col">Updated_at</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($addresses as $address)
                                    <tr class="border-bottom-secondary">
                                        <th>
                                            <input class="form-check-input" wire:model="selectedItems" type="checkbox"
                                                id="checkbox-{{ $address->id }}" value="{{ $address->id }}">
                                        </th>
                                        <th scope="row">{{ $address->id }}</th>
                                        <td>{{ $address->firstname }}</td>
                                        <td>{{ $address->lastname }}</td>
                                        <td>{{ $address->email }}</td>
                                        <td>{{ $address->phone }}</td>
                                        <td>{{ $address->street }}</td>
                                        <td>{{ $address->city }}</td>
                                        <td>{{ $address->country }}</td>
                                        <td>{{ $address->created_at }}</td>
                                        <td>{{ $address->updated_at }}</td>
                                        <td>
                                            <div>
                                                <div class="">
                                                    <button wire:click="delete({{ $address->id }})"
                                                        class="btn btn-danger btn-sm" type="submit">
                                                        <i wire:loading.remove
                                                            wire:target="delete({{ $address->id }})"
                                                            class="bi bi-trash3-fill"></i>
                                                        <span wire:loading wire:target="delete({{ $address->id }})"
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
