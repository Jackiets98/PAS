<!DOCTYPE html>

<html lang="en" class="light-style layout-compact layout-navbar-fixed layout-menu-fixed     " dir="ltr" data-theme="theme-default" data-assets-path="https://demos.pixinvent.com/materialize-html-laravel-admin-template/demo/assets/" data-base-url="https://demos.pixinvent.com/materialize-html-laravel-admin-template/demo-1" data-framework="laravel" data-template="vertical-menu-theme-default-light">

@include('layout.header')

<div class="content-wrapper">

<!-- Content -->
          <div class="container-xxl flex-grow-1 container-p-y">
    
    <div class="row g-4 mb-4">
<div class="col-sm-6 col-xl-3">
<div class="card">
<div class="card-body">
<div class="d-flex justify-content-between">
  <div class="me-1">
    <p class="text-heading mb-2">Session</p>
    <div class="d-flex align-items-center">
      <h4 class="mb-2 me-1 display-6">21,459</h4>
      <p class="text-success mb-2">(+29%)</p>
    </div>
    <p class="mb-0">Total Users</p>
  </div>
  <div class="avatar">
    <div class="avatar-initial bg-label-primary rounded">
      <div class="mdi mdi-account-outline mdi-24px"></div>
    </div>
  </div>
</div>
</div>
</div>
</div>
<div class="col-sm-6 col-xl-3">
<div class="card">
<div class="card-body">
<div class="d-flex justify-content-between">
  <div class="me-1">
    <p class="text-heading mb-2">Paid Users</p>
    <div class="d-flex align-items-center">
      <h4 class="mb-2 me-1 display-6">4,567</h4>
      <p class="text-success mb-2">(+18%)</p>
    </div>
    <p class="mb-0">Last week analytics</p>
  </div>
  <div class="avatar">
    <div class="avatar-initial bg-label-danger rounded">
      <div class="mdi mdi-account-plus-outline mdi-24px scaleX-n1"></div>
    </div>
  </div>
</div>
</div>
</div>
</div>
<div class="col-sm-6 col-xl-3">
<div class="card">
<div class="card-body">
<div class="d-flex justify-content-between">
  <div class="me-1">
    <p class="text-heading mb-2">Active Users</p>
    <div class="d-flex align-items-center">
      <h4 class="mb-2 me-1 display-6">19,860</h4>
      <p class="text-danger mb-2">(-14%)</p>
    </div>
    <p class="mb-0">Last week analytics</p>
  </div>
  <div class="avatar">
    <div class="avatar-initial bg-label-success rounded">
      <div class="mdi mdi-account-check-outline mdi-24px"></div>
    </div>
  </div>
</div>
</div>
</div>
</div>
<div class="col-sm-6 col-xl-3">
<div class="card">
<div class="card-body">
<div class="d-flex justify-content-between">
  <div class="me-1">
    <p class="text-heading mb-2">Pending Users</p>
    <div class="d-flex align-items-center">
      <h4 class="mb-2 me-1 display-6">237</h4>
      <p class="text-success mb-2">(+42%)</p>
    </div>
    <p class="mb-0">Last week analytics</p>
  </div>
  <div class="avatar">
    <div class="avatar-initial bg-label-warning rounded">
      <div class="mdi mdi-account-search mdi-24px"></div>
    </div>
  </div>
</div>
</div>
</div>
</div>

</div>

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

<!-- Users List Table -->
<div class="card">
<div class="card-header border-bottom">
<h5 class="card-title">Search Filter</h5>
<div class="d-flex justify-content-between align-items-center row py-3 gap-3 gap-md-0">
<div class="col-md-4 user_role"></div>
<div class="col-md-4 user_plan"></div>
<div class="col-md-4 user_status"></div>
</div>
</div>
<div class="card-datatable table-responsive">
<table class="datatables-users table">
<thead class="table-light">
<tr>
  <th>First Name</th>
  <th>Last Name</th>
  <th>Email</th>
  <th>Status</th>
  <th>Actions</th>
</tr>
</thead>
<tbody>
  @foreach($agentList as $user)
  <tr>
      <td>{{ $user->first_name }}</td>
      <td>{{ $user->last_name }}</td>
      <td>{{ $user->email }}</td>
      <td>
          @if ($user->status == '1')
              <span class="badge badge-pill badge-success">Active</span>
          @elseif ($user->status == '0')
              <span class="badge badge-pill badge-danger">Inactive</span>
          @endif
      </td>
      <td>
          <a href="{{url('/superadmin/'.$user->id)}}" class="btn btn-sm btn-info"><i class="fa fa-address-card"> View Details</i></a>
      </td>
  </tr>
  @endforeach
</tbody>
</table>
</div>
<!-- Offcanvas to add new customer -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasAddUser" aria-labelledby="offcanvasAddUserLabel">
<div class="offcanvas-header">
<h5 id="offcanvasAddUserLabel" class="offcanvas-title">Add Super Admin</h5>
<button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
</div>
<div class="offcanvas-body mx-0 flex-grow-0 h-100">
<form action="{{ route('createSuperAdmin') }}" class="add-new-user pt-0" method="POST" id="addSuperAdmin">
    @csrf

<div class="form-floating form-floating-outline mb-4">
  <input type="text" class="form-control" placeholder="Please Insert First Name" name="managementFirstName" required/>
  <label for="add-user-fullname">First Name <span style="color: red;">*</span></label>
</div>
<div class="form-floating form-floating-outline mb-4">
  <input type="text" class="form-control" placeholder="Please Insert Last Name" name="managementLastName" required/>
  <label>Last Name <span style="color: red;">*</span></label>
</div>
<div class="form-floating form-floating-outline mb-4">
  <input type="email" class="form-control" placeholder="Please Insert Email" name="managementEmail" required/>
  <label>Email <span style="color: red;">*</span></label>
</div>
<div class="form-floating form-floating-outline mb-4">
  <input type="text" class="form-control phone-mask" placeholder="Please Insert Phone No"  name="managementContact" required/>
  <label>Contact <span style="color: red;">*</span></label>
</div>
<div class="input-group input-group-merge mb-4">
    <div class="form-floating form-floating-outline">
        <input type="password" class="form-control" placeholder="Please Enter Password" name="managementPassword" id="passwordInput" required>
        <label for="password">Password <span style="color: red;">*</span></label>
    </div>
    <span class="input-group-text cursor-pointer" id="togglePasswordVisibility"><i class="mdi mdi-eye-off-outline"></i></span>
</div>
<div>
@error('password')
        <div class="mt-2">
            <div class="alert alert-danger">{{ $message }}</div>
        </div>
    @enderror
</div>
<div class="input-group input-group-merge mb-4">
    <div class="form-floating form-floating-outline">
        <input type="password" class="form-control" placeholder="Please Confirm Password" name="managementConfirmPassword" id="passwordConfirmInput" required>
        <label for="password">Confirm Password <span style="color: red;">*</span></label>
    </div>
    <span class="input-group-text cursor-pointer" id="toggleConfirmPasswordVisibility"><i class="mdi mdi-eye-off-outline"></i></span>
</div>
<button type="submit" class="btn btn-success me-sm-3 me-1 data-submit">Submit</button>
<button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="offcanvas">Cancel</button>
</form>
</div>
</div>
</div>

  </div>
          <!-- / Content -->

@include('layout.footer')

<script>
        document.addEventListener("DOMContentLoaded", function () {
            var form = document.getElementById("addSuperAdmin");
            var password = form.elements["managementPassword"];
            var confirmPassword = form.elements["managementConfirmPassword"];

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
