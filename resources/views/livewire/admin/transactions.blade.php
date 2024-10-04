<!-- Page Sidebar Ends-->
<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-6 ps-0">
                    <h3>Transactions</h3>
                </div>
                <div class="col-sm-6 pe-0">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">
                                <svg class="stroke-icon">
                                    <use href="/web1/assets/svg/icon-sprite.svg#stroke-home"></use>
                                </svg></a></li>
                        <li class="breadcrumb-item">Orders</li>
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
                        <h3>Transaction Table</h3>
                    </div>

                    <div class="align-self-end search-form m-3">
                        <input wire:model.live.debounce.150ms="search" type="text" placeholder="Search here...">
                    </div>
                    <div class="table-responsive custom-scrollbar mt-2">
                        <table class="table">
                            <thead>
                                <thead>
                                    <tr>
                                        <th scope="col"></th>
                                        <th scope="col">Order</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Customer Name</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Total</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                            </thead>
                            <tbody>
                                @if ($transactions->count())
                                    @foreach ($transactions as $order)
                                        <tr>
                                            <th> <input class="form-check-input" wire:model="selectedItems" type="checkbox"
                                                id="checkbox-{{ $order->id }}" value="{{ $order->id }}"></th>
                                            <th scope="row">#{{ $order->reference }}</th>
                                            <td>{{ $order->created_at }}</td>
                                            <td>{{ $order->user->name }}</th>
                                            <td>Processing</td>
                                            <td>${{ $this->getTotal($order->id) }}</td>
                                            <td>
                                                <a href="{{ route('admin-order', $order->reference) }}"
                                                    class="btn btn-outline-primary btn-sm" type="submit">view</a>
                                                    <a wire:click="openUpdateModal({{ $order->id }})" class="btn btn-outline-primary btn-sm" type="submit"><i class="bi bi-pencil-square"></i></a>
                                                    <button wire:click="delete({{ $order->id }})"
                                                        class="btn btn-danger btn-sm" type="submit" wire:loading.attr="disabled" wire:target="delete({{ $order->id }})">
                                                        <i wire:loading.remove wire:target="delete({{ $order->id }})"
                                                            class="bi bi-trash3-fill"></i>
                                                        <span wire:loading wire:target="delete({{ $order->id }})"
                                                            class="spinner-border spinner-border-sm"
                                                            aria-hidden="true"></span>
                                                    </button>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                    <div class="alert alert-info" role="alert">
                                        No Transaction to Show Yet!
                                    </div>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="m-2">
                        {{ $transactions->withQueryString()->links() }}
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
    </div>
    <!-- Container-fluid Ends-->
    <!-- Button trigger modal -->
  
  <!-- Modal -->
  <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Update Transaction Status</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="form-group mb-3">
            <label for="">Status</label>
            <select wire:model="status" class="form-control" id="">
                @foreach($statusList as $item)
                <option value="{{ $item["id"] }}" {{ $status === $item["id"]? "selected" : ''}}>{{ $item["name"] }}</option>
                @endforeach
            </select>
          </div>
          <div class="">
            <button wire:click="updateOrderStatus()" class="btn btn-primary">Save Changes</button>
          </div>

        </div>
      </div>
    </div>
  </div>


  <script>
    window.addEventListener("openUpdateModal", function(){
        $("#updateModal").modal("show");
    });

    window.addEventListener("closeUpdateModal", function(){
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
