<!DOCTYPE html>

<html lang="en" class="light-style layout-compact layout-navbar-fixed layout-menu-fixed     " dir="ltr" data-theme="theme-default" data-assets-path="https://demos.pixinvent.com/materialize-html-laravel-admin-template/demo/assets/" data-base-url="https://demos.pixinvent.com/materialize-html-laravel-admin-template/demo-1" data-framework="laravel" data-template="vertical-menu-theme-default-light">

@include('layout.header')

      <!-- Content wrapper -->
      <div class="content-wrapper">

        <!-- Content -->
                  <div class="container-xxl flex-grow-1 container-p-y">
            
            <h4 class="py-3 mb-4">
  <span class="text-muted fw-light">Customer / </span> Account
</h4>

<div class="col-12">
  @if (session()->has('success'))
  <div class="alert alert-success" id="success-alert">
      {{ session()->get('success') }}
  </div>
  @endif

  @if (session()->has('error'))
  <div class="alert alert-danger" id="error-alert">
      {{ session()->get('error') }}
  </div>
  @endif
</div>

<div class="row">
  <!-- User Sidebar -->
  <div class="col-xl-4 col-lg-5 col-md-5 order-1 order-md-0">
    <!-- User Card -->
    <div class="card mb-4">
      <div class="card-body">
        @foreach ($userDetails as $user)
        <div class="user-avatar-section">
          <div class=" d-flex align-items-center flex-column">
            <img class="img-fluid rounded mb-3 mt-4" src="{{asset('assets/img/avatars/unknown_profile.png')}}" height="120" width="120" alt="User avatar" />
            <div class="user-info text-center">
              <h4>{{$user->customer_first_name}} {{$user->customer_last_name}}</h4>
            </div>
          </div>
        </div>
        <h5 class="pb-3 border-bottom mb-3">Details</h5>
        <div class="info-container">
          <ul class="list-unstyled mb-4">
            <li class="mb-3">
              <span class="fw-medium text-heading me-2">Identification No:</span>
              <span>{{$user->customer_ic}}</span>
            </li>
            <li class="mb-3">
              <span class="fw-medium text-heading me-2">Email:</span>
              <span>{{$user->customer_email}}</span>
            </li>
            <li class="mb-3">
              <span class="fw-medium text-heading me-2">Phone No:</span>
              <span>{{$user->customer_contact}}</span>
            </li>
            <li class="mb-3">
              <span class="fw-medium text-heading me-2">Race:</span>
              <span>{{$user->customer_race}}</span>
            </li>
            <li class="mb-3">
              <span class="fw-medium text-heading me-2">Property:</span>
              <span>{{$user->customer_property}}</span>
            </li>
            <li class="mb-3">
              <span class="fw-medium text-heading me-2">Status:</span>
              @if ($user->status == "1")
              <span class="badge bg-label-success rounded-pill">Active</span> 
              @else
              <span class="badge bg-label-danger rounded-pill">Suspended</span>    
              @endif
            </li>
          </ul>
          <div class="d-flex justify-content-center">
            <a href="javascript:;" class="btn btn-primary me-3" data-bs-target="#editUser" data-bs-toggle="modal">Edit</a>
            @if ($user->status == "1")
            <a href="{{ route('customer.status.update', ['id' => $user->id, 'status' => '0']) }}" class="btn btn-outline-danger">Suspend</a> 
            @elseif ($user->status == "0")
            <a href="{{ route('customer.status.update', ['id' => $user->id, 'status' => '1']) }}" class="btn btn-outline-success">Activate</a>
            @endif
            
          </div>
        </div>
        @endforeach
      </div>
    </div>
    <!-- /User Card -->

  </div>
  <!--/ User Sidebar -->


  <!-- User Content -->
  <div class="col-xl-8 col-lg-7 col-md-7 order-0 order-md-1">
    <!-- User Tabs -->
    <ul class="nav nav-tabs mb-3">
      <li class="nav-item"><a class="nav-link active" href="javascript:void(0);"><i class="mdi mdi-account-outline mdi-20px me-1"></i>Account</a></li>
      <li class="nav-item"><a class="nav-link" href="security.html"><i class="mdi mdi-lock-open-outline mdi-20px me-1"></i>Security</a></li>
      <li class="nav-item"><a class="nav-link" href="billing.html"><i class="mdi mdi-bookmark-outline mdi-20px me-1"></i>Billing & Plans</a></li>
      <li class="nav-item"><a class="nav-link" href="notifications.html"><i class="mdi mdi-bell-outline mdi-20px me-1"></i>Notifications</a></li>
      <li class="nav-item"><a class="nav-link" href="connections.html"><i class="mdi mdi-link mdi-20px me-1"></i>Connections</a></li>
    </ul>
    <!--/ User Tabs -->

    <!-- Project table -->
    <div class="card mb-4">
      <h5 class="card-header">User's Projects List</h5>
      <div class="table-responsive mb-3">
        <table class="table datatable-project">
          <thead class="table-light">
            <tr>
              <th></th>
              <th></th>
              <th>Project</th>
              <th class="text-nowrap">Total Task</th>
              <th>Progress</th>
              <th>Hours</th>
            </tr>
          </thead>
        </table>
      </div>
    </div>
    <!-- /Project table -->

    <!-- Activity Timeline -->
    <div class="card mb-4">
      <h5 class="card-header">User Activity Timeline</h5>
      <div class="card-body pb-0 pt-3">
        <ul class="timeline mb-0">
          <li class="timeline-item timeline-item-transparent">
            <span class="timeline-point timeline-point-danger"></span>
            <div class="timeline-event">
              <div class="timeline-header mb-1">
                <h6 class="mb-0">12 Invoices have been paid</h6>
                <small class="text-muted">12 min ago</small>
              </div>
              <p class="mb-2">Invoices have been paid to the company</p>
              <div class="d-flex">
                <a href="javascript:void(0)" class="me-3">
                  <img src="{{asset('assets/img/icons/misc/pdf.png')}}" alt="PDF image" width="15" class="me-2">
                  <span class="fw-medium text-heading">invoices.pdf</span>
                </a>
              </div>
            </div>
          </li>
          <li class="timeline-item timeline-item-transparent">
            <span class="timeline-point timeline-point-primary"></span>
            <div class="timeline-event">
              <div class="timeline-header mb-1">
                <h6 class="mb-0">Client Meeting</h6>
                <small class="text-muted">45 min ago</small>
              </div>
              <p class="mb-2">Project meeting with john @10:15am</p>
              <div class="d-flex flex-wrap">
                <div class="avatar me-3">
                  <img src="{{asset('assets/img/avatars/3.png')}}" alt="Avatar" class="rounded-circle" />
                </div>
                <div>
                  <h6 class="mb-0">Lester McCarthy (Client)</h6>
                  <span>CEO of Pixinvent</span>
                </div>
              </div>
            </div>
          </li>
          <li class="timeline-item timeline-item-transparent">
            <span class="timeline-point timeline-point-warning"></span>
            <div class="timeline-event">
              <div class="timeline-header mb-1">
                <h6 class="mb-0">Create a new project for client</h6>
                <small class="text-muted">2 Day Ago</small>
              </div>
              <p class="mb-2">5 team members in a project</p>
              <div class="d-flex align-items-center avatar-group">
                <div class="avatar pull-up" data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Vinnie Mostowy">
                  <img src="{{asset('assets/img/avatars/5.png')}}" alt="Avatar" class="rounded-circle">
                </div>
                <div class="avatar pull-up" data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Marrie Patty">
                  <img src="{{asset('assets/img/avatars/12.png')}}" alt="Avatar" class="rounded-circle">
                </div>
                <div class="avatar pull-up" data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Jimmy Jackson">
                  <img src="{{asset('assets/img/avatars/9.png')}}" alt="Avatar" class="rounded-circle">
                </div>
                <div class="avatar pull-up" data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Kristine Gill">
                  <img src="{{asset('assets/img/avatars/6.png')}}" alt="Avatar" class="rounded-circle">
                </div>
                <div class="avatar pull-up" data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Nelson Wilson">
                  <img src="{{asset('assets/img/avatars/14.png')}}" alt="Avatar" class="rounded-circle">
                </div>
              </div>
            </div>
          </li>
          <li class="timeline-item timeline-item-transparent border-transparent">
            <span class="timeline-point timeline-point-info"></span>
            <div class="timeline-event">
              <div class="timeline-header mb-1">
                <h6 class="mb-0">Design Review</h6>
                <small class="text-muted">5 days Ago</small>
              </div>
              <p class="mb-0">Weekly review of freshly prepared design for our new app.</p>
            </div>
          </li>
        </ul>
      </div>
    </div>
    <!-- /Activity Timeline -->

  </div>
  <!--/ User Content -->
</div>

<!-- Modal -->
<!-- Edit User Modal -->
<div class="modal fade" id="editUser" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-simple modal-edit-user">
    <div class="modal-content p-3 p-md-5">
      <div class="modal-body py-3 py-md-0">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        <div class="text-center mb-4">
          <h3 class="mb-2">Edit Customer Information</h3>
          <p class="pt-1">Updating details will receive a privacy audit.</p>
        </div>
        @foreach ($userDetailsForEditing as $userDetails)
        <form action="{{url('/customerUpdate/'.$userDetails->id)}}" class="row g-4" method="POST">
          @csrf
          <div class="col-12 col-md-6">
            <div class="form-floating form-floating-outline">
              <input type="text" name="customerFirstName" class="form-control" value="{{$userDetails->customer_first_name}}" />
              <label for="modalEditUserFirstName">First Name</label>
            </div>
          </div>
          <div class="col-12 col-md-6">
            <div class="form-floating form-floating-outline">
              <input type="text" name="customerLastName" class="form-control" value="{{$userDetails->customer_last_name}}" />
              <label for="modalEditUserLastName">Last Name</label>
            </div>
          </div>
          <div class="col-12">
            <div class="form-floating form-floating-outline">
              <input type="text" name="customerIC" class="form-control" value="{{$userDetails->customer_ic}}" />
              <label for="modalEditUserName">Identification No</label>
            </div>
          </div>
          <div class="col-12 col-md-6">
            <div class="form-floating form-floating-outline">
              <input type="text" name="customerEmail" class="form-control" value="{{$userDetails->customer_email}}" />
              <label for="modalEditUserEmail">Email</label>
            </div>
          </div>
          <div class="col-12 col-md-6">
            <div class="form-floating form-floating-outline">
              <input type="number" name="customerPhone" class="form-control" value="{{$userDetails->customer_contact}}" />
              <label>Contact No</label>
            </div>
          </div>
          <div class="col-12 col-md-6">
            <div class="form-floating form-floating-outline">
              <input type="text" name="customerOccupation" class="form-control" value="{{$userDetails->customer_occupation}}" />
              <label for="modalEditTaxID">Occupation</label>
            </div>
          </div>
          <div class="col-12 col-md-6">
            <div class="form-floating form-floating-outline">
              <select name="customerRace" class="form-select">
                <option value="chinese" {{ $userDetails->customer_race == 'chinese' ? 'selected' : '' }}>Chinese</option>
                <option value="malay" {{ $userDetails->customer_race == 'malay' ? 'selected' : '' }}>Malay</option>
                <option value="indian" {{ $userDetails->customer_race == 'indian' ? 'selected' : '' }}>Indian</option>
              </select>
              <label>Race</label>
            </div>
          </div>
          <div class="col-12 col-md-6">
            <div class="form-floating form-floating-outline">
              <select name="customerProperty" class="form-select">
                <option value="basic" {{ $userDetails->customer_property == 'basic' ? 'selected' : '' }}>Basic</option>
                <option value="enterprise" {{ $userDetails->customer_property == 'enterprise' ? 'selected' : '' }}>Enterprise</option>
                <option value="company" {{ $userDetails->customer_property == 'company' ? 'selected' : '' }}>Company</option>
                <option value="team" {{ $userDetails->customer_property == 'team' ? 'selected' : '' }}>Team</option>
              </select>
              <label>Property</label>
            </div>
          </div>
          <div class="col-12 col-md-6">
            <div class="form-floating form-floating-outline">
              <select name="customerStatus" class="form-select">
                <option value="1" {{ $userDetails->status == '1' ? 'selected' : '' }}>Active</option>
                <option value="0" {{ $userDetails->status == '0' ? 'selected' : '' }}>Suspended</option>
              </select>
              <label for="modalEditUserStatus">Status</label>
            </div>
          </div>
          <div class="col-12 col-md-6">
            <div class="input-group input-group-merge mb-4">
              <div class="form-floating form-floating-outline">
                <input type="password" name="customerPassword" id="passwordInput" class="form-control" />
                <label>Password (Optional)</label>
              </div>
              <span class="input-group-text cursor-pointer" id="togglePasswordVisibility"><i class="mdi mdi-eye-off-outline"></i></span>
            </div>
          </div>
          <div class="col-12 col-md-6">
            <div class="input-group input-group-merge mb-4">
              <div class="form-floating form-floating-outline">
                <input type="password" name="customerConfirmPassword" id="passwordConfirmInput" class="form-control" />
                <label>Confirm Password (Optional)</label>
              </div>
              <span class="input-group-text cursor-pointer" id="toggleConfirmPasswordVisibility"><i class="mdi mdi-eye-off-outline"></i></span>
            </div>
          </div>
          <div class="col-12 text-center">
            <button type="submit" class="btn btn-primary me-sm-3 me-1">Submit</button>
            <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
          </div>
        </form>
        @endforeach
      </div>
    </div>
  </div>
</div>
<!--/ Edit User Modal -->


@include('layout.footer')

<script>
  document.getElementById('togglePasswordVisibility').addEventListener('click', function() {
      var passwordInput = document.getElementById('passwordInput');
      var eyeIcon = this.querySelector('i');

      // Toggle password visibility
      if (passwordInput.type === 'password') {
          passwordInput.type = 'text';
          eyeIcon.classList.remove('mdi-eye-off-outline');
          eyeIcon.classList.add('mdi-eye-outline');
      } else {
          passwordInput.type = 'password';
          eyeIcon.classList.remove('mdi-eye-outline');
          eyeIcon.classList.add('mdi-eye-off-outline');
      }
  });
</script>

<script>
  document.getElementById('toggleConfirmPasswordVisibility').addEventListener('click', function() {
      var passwordInput = document.getElementById('passwordConfirmInput');
      var eyeIcon = this.querySelector('i');

      // Toggle password visibility
      if (passwordInput.type === 'password') {
          passwordInput.type = 'text';
          eyeIcon.classList.remove('mdi-eye-off-outline');
          eyeIcon.classList.add('mdi-eye-outline');
      } else {
          passwordInput.type = 'password';
          eyeIcon.classList.remove('mdi-eye-outline');
          eyeIcon.classList.add('mdi-eye-off-outline');
      }
  });
</script>

<script>
  document.addEventListener("DOMContentLoaded", function () {
      var form = document.getElementById("addCustomer");
      var password = form.elements["customerPassword"];
      var confirmPassword = form.elements["customerConfirmPassword"];

      function validatePassword() {
          if (password.value !== confirmPassword.value) {
              confirmPassword.setCustomValidity("Passwords don't match");
          } else {
              confirmPassword.setCustomValidity('');
          }
      }

      password.addEventListener("input", validatePassword);
      confirmPassword.addEventListener("input", validatePassword);

      form.addEventListener("submit", function (event) {
          if (password.value !== confirmPassword.value) {
              event.preventDefault(); // Prevent form submission
              // Optionally, you can display an alert or error message here.
          }
      });
  });
</script>

<script>
  // Remove success alert after 3 seconds
  setTimeout(function() {
      document.getElementById('success-alert').remove();
  }, 3000);

  // Remove error alert after 3 seconds
  setTimeout(function() {
      document.getElementById('error-alert').remove();
  }, 3000);
</script>

</body>

</html>
