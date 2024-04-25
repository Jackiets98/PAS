<!DOCTYPE html>

<html lang="en" class="light-style layout-compact layout-navbar-fixed layout-menu-fixed     " dir="ltr" data-theme="theme-default" data-assets-path="https://demos.pixinvent.com/materialize-html-laravel-admin-template/demo/assets/" data-base-url="https://demos.pixinvent.com/materialize-html-laravel-admin-template/demo-1" data-framework="laravel" data-template="vertical-menu-theme-default-light">

@include('layout.header')

<style>
  .vertical-middle td {
      vertical-align: middle;
  }
</style>


      <!-- Content wrapper -->
      <div class="content-wrapper">

        <!-- Content -->
                  <div class="container-xxl flex-grow-1 container-p-y">
            
            <h4 class="py-3 mb-4">
  <span class="text-muted fw-light">Pages /</span> Property List
</h4>

<!-- Product List Widget -->

<div class="card mb-4">
  <div class="card-widget-separator-wrapper">
    <div class="card-body card-widget-separator">
      <div class="row gy-4 gy-sm-1">
        <div class="col-sm-6 col-lg-3">
          <div class="d-flex justify-content-between align-items-start card-widget-1 border-end pb-3 pb-sm-0">
            <div>
              <p class="mb-2">In-store Sales</p>
              <h4 class="mb-2">$5,345.43</h4>
              <p class="mb-0"><span class="me-2">5k orders</span><span class="badge rounded-pill bg-label-success">+5.7%</span></p>
            </div>
            <div class="avatar me-sm-4">
              <span class="avatar-initial rounded bg-label-secondary">
                <i class="mdi mdi-home-outline mdi-24px"></i>
              </span>
            </div>
          </div>
          <hr class="d-none d-sm-block d-lg-none me-4">
        </div>
        <div class="col-sm-6 col-lg-3">
          <div class="d-flex justify-content-between align-items-start card-widget-2 border-end pb-3 pb-sm-0">
            <div>
              <p class="mb-2">Website Sales</p>
              <h4 class="mb-2">$674,347.12</h4>
              <p class="mb-0"><span class="me-2">21k orders</span><span class="badge rounded-pill bg-label-success">+12.4%</span></p>
            </div>
            <div class="avatar me-lg-4">
              <span class="avatar-initial rounded bg-label-secondary">
                <i class="mdi mdi-laptop mdi-24px"></i>
              </span>
            </div>
          </div>
          <hr class="d-none d-sm-block d-lg-none">
        </div>
        <div class="col-sm-6 col-lg-3">
          <div class="d-flex justify-content-between align-items-start border-end pb-3 pb-sm-0 card-widget-3">
            <div>
              <p class="mb-2">Discount</p>
              <h4 class="mb-2">$14,235.12</h4>
              <p class="mb-0">6k orders</p>
            </div>
            <div class="avatar me-sm-4">
              <span class="avatar-initial rounded bg-label-secondary">
                <i class="mdi mdi-wallet-giftcard mdi-24px"></i>
              </span>
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-lg-3">
          <div class="d-flex justify-content-between align-items-start">
            <div>
              <p class="mb-2">Affiliate</p>
              <h4 class="mb-2">$8,345.23</h4>
              <p class="mb-0"><span class="me-2">150 orders</span><span class="badge rounded-pill bg-label-danger">-3.5%</span></p>
            </div>
            <div class="avatar">
              <span class="avatar-initial rounded bg-label-secondary">
                <i class="mdi mdi-currency-usd mdi-24px"></i>
              </span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Product List Table -->
<div class="card">
  <div class="card-header">
    <h5 class="card-title">Filter</h5>
    <div class="d-flex justify-content-between align-items-center row py-3 gap-3 gap-md-0">
      <div class="col-md-4 product_status"></div>
      <div class="col-md-4 product_category"></div>
      <div class="col-md-4 product_stock"></div>
    </div>
  </div>
  <div class="card-datatable table-responsive">
    <table class="datatables-products table vertical-middle">
      <thead class="table-light">
        <tr>
          <th style="display: none">Created At</th>
          <th>Project Logo</th>
          <th>Project Name</th>
          <th>Project Type</th>
          <th>Status</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach($projectList as $project)
        <tr>
            <td>
                @if($project->project_logo)
                <img src="{{ asset('logos/' . $project->project_logo) }}" alt="Project Logo" style="max-width: 50px; max-height: 50px;">
                @else
                <img src="{{ asset('logos/no_image.png') }}" alt="Project Logo" style="max-width: 50px; max-height: 50px;">
                @endif
            </td>
            <td>{{ $project->project_name }}</td>
            <td>{{ $project->project_type }}</td>
            <td>
                @if ($project->status == '1')
                    <span class="badge badge-pill badge-success">Active</span>
                @elseif ($project->status == '0')
                    <span class="badge badge-pill badge-danger">Inactive</span>
                @endif
            </td>
            <td>
                <a href="{{url('/viewCustomer/'.$project->id)}}" class="btn btn-sm btn-info"><i class="fa fa-address-card"> View Details</i></a>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
  </div>
</div>


          </div>
          <!-- / Content -->

@include('layout.footer')
</body>

</html>
