
        <div class="page-body">
          <div class="container-fluid">
            <div class="page-title">
              <div class="row">
                <div class="col-sm-6 p-0">
                  <h3>
                     Ecommerce Dashboard</h3>
                </div>
                <div class="col-sm-6 p-0">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">
                        <svg class="stroke-icon">
                          <use href="../assets/svg/icon-sprite.svg#stroke-home"></use>
                        </svg></a></li>
                    <li class="breadcrumb-item">Dashboard</li>
                    <li class="breadcrumb-item active">E-Commerce</li>
                  </ol>
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->
          <div class="container-fluid ecommerce-dashboard">
            <div class="row bg-light p-4 mb-4">
              <div class="col-xl-2 col-xl-33 col-sm-6 box-col-4 ps-0">
                <div class="card mb-0 online-order">
                  <div class="card-header pb-0">
                    <div class="d-flex">
                      <div class="order bg-light-primary"><span></span>
                        <div>
                          <i class="bi bi-handbag-fill" style="font-size: 20px;"></i>
                        </div>
                      </div>
                      <div class="arrow-chart">
                        <svg>
                        </svg><span class="font-danger">-6.3%</span>
                      </div>
                    </div>
                    <div class="online"><span>Products</span>
                      <h2>{{ $products->count() }}</h2>
                    </div>
                  </div>
                  <div class="card-body pt-0 ps-2 pe-2">
                    {{-- <div id="online-chart"> </div> --}}
                  </div>
                </div>
              </div>
              <div class="col-xl-2 col-xl-33 col-sm-6 box-col-4 pedding-sm">
                <div class="card mb-0 online-order">
                  <div class="card-header offline-order">
                    <div class="d-flex">
                      <div class="order bg-light-secondary"><span></span>
                        <div>
                          <i class="bi bi-people-fill" style="font-size: 20px;"></i>
                        </div>
                      </div>
                      <div class="arrow-chart">
                        <svg>
                        </svg><span class="font-success">+8.3%</span>
                      </div>
                    </div>
                    <div class="online"><span>Users</span>
                      <h2>{{ $users->count() }}</h2>
                    </div>
                  </div>
                  <div class="card-body pt-0 ps-2 pe-2">
                    {{-- <div class="offline-chart" id="offline-chart"></div> --}}
                  </div>
                </div>
              </div>
              <div class="col-xl-2 col-xl-33 col-sm-6 box-col-4 pedding-end pedding-sm-start pedding-sm">
                <div class="card mb-0 online-order">
                  <div class="card-header revenue-order pb-0">
                    <div class="d-flex">
                      <div class="order bg-light-danger"><span></span>
                        <div>
                          <i class="bi bi-cart4" style="font-size: 20px;"></i>
                        </div>
                        {{-- <svg>
                          <use href="../assets/svg/icon-sprite.svg#increased"></use>
                        </svg> --}}
                      </div>
                      <div class="arrow-chart">
                        <svg>
                        </svg><span class="font-danger">-3.5%</span>
                      </div>
                    </div>
                    <div class="online"><span>Carts</span>
                      <h2>{{ $carts->count() }}</h2>
                    </div>
                  </div>
                  <div class="card-body pt-0 ps-2 pe-2">
                    {{-- <div class="revenue" id="Revenue-chart"></div> --}}
                  </div>
                </div>
              </div>
            </div>

          </div>
          <!-- Container-fluid Ends-->
        </div>
        