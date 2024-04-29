<!DOCTYPE html>

<html lang="en" class="light-style layout-compact layout-navbar-fixed layout-menu-fixed     " dir="ltr" data-theme="theme-default" data-assets-path="https://demos.pixinvent.com/materialize-html-laravel-admin-template/demo/assets/" data-base-url="https://demos.pixinvent.com/materialize-html-laravel-admin-template/demo-1" data-framework="laravel" data-template="vertical-menu-theme-default-light">

@include('layout.header')

      <!-- Content wrapper -->
      <div class="content-wrapper">

        <!-- Content -->
                  <div class="container-xxl flex-grow-1 container-p-y">
            
            <h4 class="py-3 mb-4">
  <span class="text-muted fw-light">Project / </span> Details
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
    @foreach ($projectDetails as $project)
    <div class="card mb-4">
      <div class="card-body">
        <div class="user-avatar-section">
          <div class=" d-flex align-items-center flex-column">
            @if ($project->project_logo != NULL)
            <img class="img-fluid rounded mb-3 mt-4" src="{{asset('logos/' . $project->project_logo)}}" height="180" width="180" alt="User avatar" />       
            @else
            <img class="img-fluid rounded mb-3 mt-4" src="{{asset('logos/no_image.png')}}" height="180" width="180" alt="User avatar" />      
            @endif
          </div>
        </div>        
      </div>
    </div>
    <div class="card mb-4">
      <div class="card-body">
        <div class="project-detail-section">
          <div class=" d-flex align-items-center flex-column">
            <h5 class="pb-3 border-bottom mb-3">Project's Details</h5>
            <div class="info-container">
              <ul class="list-unstyled mb-4">
                <li class="mb-3">
                  <span class="fw-medium text-heading me-2">Name:</span>
                  <span>{{$project->project_name}}</span>
                </li>
                <li class="mb-3">
                  <span class="fw-medium text-heading me-2">Type:</span>
                  @if ($project->project_type == '10000')
                  <span>Flat / Apartment</span> 
                  @elseif($project->project_type == '10001')
                  <span>Residential House</span>   
                  @elseif($project->project_type == '10002')
                  <span>Villa</span> 
                  @elseif($project->project_type == '10003')
                  <span>Builder Floor Apartment</span>
                  @elseif($project->project_type == '10004')
                  <span>Residential Land/ Plot</span>
                  @elseif($project->project_type == '10005')
                  <span>Penthouse</span>
                  @elseif($project->project_type == '10006')
                  <span>Studio Apartment</span>
                  @endif
                  
                </li>
                <li class="mb-3">
                  <span class="fw-medium text-heading me-2">Address:</span>
                  <span>{{$project->address}}</span>
                </li>
                <li class="mb-3">
                  <span class="fw-medium text-heading me-2">City:</span>
                  <span>{{$project->city}}</span>
                </li>
                <li class="mb-3">
                  <span class="fw-medium text-heading me-2">Postcode:</span>
                  <span>{{$project->postcode}}</span>
                </li>
                <li class="mb-3">
                  <span class="fw-medium text-heading me-2">State:</span>
                  <span>{{$project->state}}</span>
                </li>
                <li class="mb-3">
                  <span class="fw-medium text-heading me-2">Website:</span>
                  @if ($project->website_url != NULL)
                  <a href="{{url($project->website_url)}}">{{$project->website_url}}</a>
                  @else
                  <span style="color: darkgrey">No Website Listed</span>    
                  @endif
                </li>
                <li class="mb-3">
                  <span class="fw-medium text-heading me-2">Status:</span>
                  @if ($project->status == "1")
                  <span class="badge bg-label-success rounded-pill">Active</span> 
                  @else
                  <span class="badge bg-label-danger rounded-pill">Suspended</span>    
                  @endif
                </li>
              </ul>
              <div class="d-flex justify-content-center">
                <a href="javascript:;" class="btn btn-primary me-3" data-bs-target="#editUser" data-bs-toggle="modal">Edit</a>
                @if ($project->status == "1")
                <a href="{{ route('customer.status.update', ['id' => $project->id, 'status' => '0']) }}" class="btn btn-outline-danger">Suspend</a> 
                @elseif ($project->status == "0")
                <a href="{{ route('customer.status.update', ['id' => $project->id, 'status' => '1']) }}" class="btn btn-outline-success">Activate</a>
                @endif
              </div>
            </div>
          </div>
        </div>        
      </div>
    </div>
    @endforeach
    <!-- /User Card -->

  </div>
  <!--/ User Sidebar -->


  <!-- User Content -->
  <div class="col-xl-8 col-lg-7 col-md-7 order-0 order-md-1">
    <!-- User Tabs -->
    <ul id="userTabs" class="nav nav-tabs mb-3">
        <li class="nav-item"><a id="brochuresTab" class="nav-link active" href="#" onclick="showCard('brochures')"><i class="mdi mdi-image-outline mdi-20px me-1"></i>Brochures</a></li>
        <li class="nav-item"><a id="galleryTab" class="nav-link" href="#" onclick="showCard('gallery')"><i class="mdi mdi-view-gallery-outline mdi-20px me-1"></i>Gallery</a></li>
        <li class="nav-item"><a id="unitsTab" class="nav-link" href="#" onclick="showCard('units')"><i class="mdi mdi-sofa-outline mdi-20px me-1"></i>Units</a></li>
    </ul>
    <!--/ User Tabs -->

    <!-- Project table -->
    <div id="brochuresCard" class="card mb-4">
        <h5 class="card-header">Project's Brochures</h5>
        <div id="brochuresGrid" class="row row-cols-1 row-cols-md-3 g-4 p-3">
          <!-- Placeholder for images -->
      </div>
    </div>
    
    <div id="galleryCard" class="card mb-4" style="display: none;">
        <h5 class="card-header">Project's Gallery</h5>
        <div id="galleryGrid" class="row row-cols-1 row-cols-md-3 g-4 p-3">
          <!-- Placeholder for images -->
      </div>
    </div>
    
    <div id="unitsCard" class="card mb-4" style="display: none;">
        <h5 class="card-header">User's Units List</h5>
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
          <h3 class="mb-2">Edit Project Information</h3>
          <p class="pt-1">Updating details will receive a privacy audit.</p>
        </div>
        @foreach ($projectDetailsForEditing as $project)
        <form action="{{url('/customerUpdate/'.$project->id)}}" class="row g-4" method="POST">
          @csrf
          <div class="col-12 col-md-6">
            <div class="form-floating form-floating-outline">
              <input type="text" name="projectName" class="form-control" value="{{$project->project_name}}" />
              <label for="modalEditUserFirstName">Project Name</label>
            </div>
          </div>
          <div class="col-12 col-md-6">
            <div class="form-floating form-floating-outline">
              <select name="projectType" class="form-select">
                <option value="10000" {{ $project->project_type == '10000' ? 'selected' : '' }}>Flat/ Apartment</option>
                <option value="10001" {{ $project->project_type == '10001' ? 'selected' : '' }}>Residential House</option>
                <option value="10002" {{ $project->project_type == '10002' ? 'selected' : '' }}>Villa</option>
                <option value="10003" {{ $project->project_type == '10003' ? 'selected' : '' }}>Builder Floor Apartment</option>
                <option value="10004" {{ $project->project_type == '10004' ? 'selected' : '' }}>Residential Land/ Plot</option>
                <option value="10005" {{ $project->project_type == '10005' ? 'selected' : '' }}>Penthouse</option>
                <option value="10006" {{ $project->project_type == '10006' ? 'selected' : '' }}>Studio Apartment</option>
              </select>
              <label for="modalEditUserLastName">Project Type</label>
            </div>
          </div>
          <div class="col-12">
            <div class="form-floating form-floating-outline">
              <input type="text" name="projectAddress" class="form-control" value="{{$project->address}}" />
              <label for="modalEditUserName">Address</label>
            </div>
          </div>
          <div class="col-12 col-md-6">
            <div class="form-floating form-floating-outline">
              <select class="form-select" name="propertyCity" id="citySelect" required data-project-city="{{$project->city}}">
                <option value="" disabled>Choose a City</option>
            </select>
            <label for="modalEditUserEmail">City</label>
            </div>
          </div>
          <div class="col-12 col-md-6">
            <div class="form-floating form-floating-outline">
              <input type="number" name="projectPostcode" class="form-control" value="{{$project->postcode}}" />
              <label>Postcode</label>
            </div>
          </div>
          <div class="col-12 col-md-6">
            <div class="form-floating form-floating-outline">
              <select class="form-select" name="projectState" id="propertyState">
                <option value="Johor" {{ $project->state == 'Johor' ? 'selected' : '' }}>Johor</option>
                <option value="Kedah" {{ $project->state == 'Kedah' ? 'selected' : '' }}>Kedah</option>
                <option value="Kelantan" {{ $project->state == 'Kelantan' ? 'selected' : '' }}>Kelantan</option>
                <option value="Melaka" {{ $project->state == 'Melaka' ? 'selected' : '' }}>Melaka</option>
                <option value="Negeri Sembilan" {{ $project->state == 'Negeri Sembilan' ? 'selected' : '' }}>Negeri Sembilan</option>
                <option value="Pahang" {{ $project->state == 'Pahang' ? 'selected' : '' }}>Pahang</option>
                <option value="Penang" {{ $project->state == 'Penang' ? 'selected' : '' }}>Penang</option>
                <option value="Perak" {{ $project->state == 'Perak' ? 'selected' : '' }}>Perak</option>
                <option value="Perlis" {{ $project->state == 'Perlis' ? 'selected' : '' }}>Perlis</option>
                <option value="Sabah" {{ $project->state == 'Sabah' ? 'selected' : '' }}>Sabah</option>
                <option value="Sarawak" {{ $project->state == 'Sarawak' ? 'selected' : '' }}>Sarawak</option>
                <option value="Selangor" {{ $project->state == 'Selangor' ? 'selected' : '' }}>Selangor</option>
                <option value="Terengganu" {{ $project->state == 'Terengganu' ? 'selected' : '' }}>Terengganu</option>
                <option value="Kuala Lumpur" {{ $project->state == 'Kuala Lumpur' ? 'selected' : '' }}>Kuala Lumpur</option>
                <option value="Labuan" {{ $project->state == 'Labuan' ? 'selected' : '' }}>Labuan</option>
                <option value="Putrajaya" {{ $project->state == 'Putrajaya' ? 'selected' : '' }}>Putrajaya</option>
            </select>
              <label>State</label>
            </div>
          </div>
          <div class="col-12 col-md-6">
            <div class="form-floating form-floating-outline">
              <input type="text" name="projectWebsite" class="form-control" value="{{$project->website_url}}" />
              <label>Website URL (Optional)</label>
            </div>
          </div>
          <div class="col-12 col-md-6">
            <div class="form-floating form-floating-outline">
              <input type="number" name="projectLatitude" class="form-control" value="{{$project->latitude}}" />
              <label>Latitude (Optional)</label>
            </div>
          </div>
          <div class="col-12 col-md-6">
            <div class="form-floating form-floating-outline">
              <input type="number" name="projectLongitude" class="form-control" value="{{$project->longitude}}" />
              <label for="modalEditUserStatus">Longitude (Optional)</label>
            </div>
          </div>
          <hr>
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

<script>
  window.onload = function() {
      // Show Brochures card by default
      showCard('brochures');
  };

  function showCard(cardType) {
      // Hide all cards
      document.getElementById('brochuresCard').style.display = 'none';
      document.getElementById('galleryCard').style.display = 'none';
      document.getElementById('unitsCard').style.display = 'none';

      // Remove active class from all tabs
      document.getElementById('brochuresTab').classList.remove('active');
      document.getElementById('galleryTab').classList.remove('active');
      document.getElementById('unitsTab').classList.remove('active');

      // Show the selected card and set the corresponding tab as active
      if (cardType === 'brochures') {
          document.getElementById('brochuresCard').style.display = 'block';
          document.getElementById('brochuresTab').classList.add('active');
          // Populate the image grid with dummy images (replace with actual images)
          populateBrochuresGrid();
      } else if (cardType === 'gallery') {
          document.getElementById('galleryCard').style.display = 'block';
          document.getElementById('galleryTab').classList.add('active');
          populateGalleryGrid();
      } else if (cardType === 'units') {
          document.getElementById('unitsCard').style.display = 'block';
          document.getElementById('unitsTab').classList.add('active');
      }
  }

// Function to populate the Brochures grid with image URLs fetched from the controller
function populateBrochuresGrid(projectBrochuresArray) {
    const brochuresGrid = document.getElementById('brochuresGrid');
    // Clear existing content
    brochuresGrid.innerHTML = '';

    // Check if projectBrochuresArray is defined and is an array
    if (Array.isArray(projectBrochuresArray)) {
        // Iterate over the brochure URLs fetched from the controller
        projectBrochuresArray.forEach(relativePath => {
            // Construct the complete image URL by prepending the base URL
            const imageUrl = window.location.origin + '/' + relativePath;

            // Create a card container for each brochure
            const cardDiv = document.createElement('div');
            cardDiv.classList.add('col');

            // Create a card element
            const card = document.createElement('div');
            card.classList.add('card');
            card.style.position = 'relative'; // Set position to relative for absolute positioning of edit button

            // Create an image element
            const img = document.createElement('img');
            img.classList.add('img-fluid');
            img.style.width = '300px'; // Set width to 300px
            img.style.height = '300px'; // Set height to 300px
            img.style.boxShadow = '0px 4px 8px rgba(0, 0, 0, 0.1)'; // Add shadow effect
            img.src = imageUrl; // Use the complete image URL

            // Append the image to the card
            card.appendChild(img);

            // Append the card to the card container
            cardDiv.appendChild(card);

            // Append the card container to the brochuresGrid
            brochuresGrid.appendChild(cardDiv);
        });

        // Create the edit button
        const editButton = document.createElement('button');
        editButton.textContent = 'Edit';
        editButton.classList.add('btn');
        editButton.classList.add('btn-primary');
        editButton.classList.add('edit-button');
        editButton.style.position = 'absolute';
        editButton.style.top = '10px'; // Adjust top position as needed
        editButton.style.right = '10px'; // Adjust right position as needed

        // Append the edit button to the brochuresCard
        const brochuresCard = document.getElementById('brochuresCard');
        brochuresCard.appendChild(editButton);


        editButton.addEventListener('click', function() {
            // Toggle between edit and save mode
            if (editButton.textContent === 'Edit') {
                // Change button text to 'Save'
                editButton.textContent = 'Done';
                
                // Add remove icon buttons to each image
                const images = document.querySelectorAll('#brochuresGrid img');
                images.forEach(image => {
                    const removeButton = document.createElement('button');
                    removeButton.innerHTML = '&times;'; // Unicode for the times (X) symbol
                    removeButton.classList.add('remove-button');
                    removeButton.style.position = 'absolute';
                    removeButton.style.top = '10px'; // Adjust top position as needed
                    removeButton.style.right = '10px'; // Adjust right position as needed
                    removeButton.style.background = 'transparent';
                    removeButton.style.border = 'none';
                    removeButton.style.color = 'red';
                    removeButton.style.fontSize = '1.5rem';
                    removeButton.style.cursor = 'pointer';

                    // Add click event listener to remove button
                    removeButton.addEventListener('click', function() {
                        // Get the image name
                        const imageName = image.src.split('/').pop(); // Extract the image name from the URL
                        console.log('Removed image:', imageName);

                        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                        // Send a request to the backend to delete the image
                        $.ajax({
                            url: '/remove-brochure',
                            type: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Include the CSRF token in the request headers
                            },
                            dataType: 'json',
                            contentType: 'application/json',
                            data: JSON.stringify({ imageName: imageName, id: '{{$id}}' }), // Send the image name to the backend
                            success: function(response) {
                                console.log(response);
                                console.log('Image deleted successfully');
                                // Remove the parent card container from the DOM
                                image.parentElement.parentElement.remove();
                            },
                            error: function(xhr, status, error) {
                                console.error('Failed to delete image:', error);
                            }
                        });
                    });

                    // Append remove button to the image container
                    image.parentElement.appendChild(removeButton);
                });

                // Add circular button for adding new images
                const addButton = document.createElement('button');
                addButton.innerHTML = '+';
                addButton.classList.add('add-button');
                addButton.style.position = 'absolute';
                addButton.style.bottom = '10px'; // Adjust bottom position as needed
                addButton.style.right = '10px'; // Adjust right position as needed
                addButton.style.background = 'green';
                addButton.style.border = 'none';
                addButton.style.color = 'white';
                addButton.style.fontSize = '1.5rem';
                addButton.style.width = '40px';
                addButton.style.height = '40px';
                addButton.style.borderRadius = '50%';
                addButton.style.cursor = 'pointer';

                // Add click event listener to add button
                addButton.addEventListener('click', function() {
                    const fileInput = document.createElement('input');
                    fileInput.type = 'file';
                    fileInput.accept = 'image/*';
                    fileInput.style.display = 'none'; // Hide the input element
                    document.body.appendChild(fileInput);

                    // Listen for changes in the file input
                    fileInput.addEventListener('change', function(event) {
                        const files = event.target.files;
                        // Process the selected files
                        Array.from(files).forEach(file => {
                            // You can perform additional checks/validation here if needed
                            // For example, check file type, size, etc.

                            // Create FormData object to send the file to the backend
                            const formData = new FormData();
                            formData.append('image', file);

                            // Send a request to the backend to upload the image
                            fetch('/upload-image', {
                                method: 'POST',
                                body: formData
                            })
                            .then(response => {
                                if (response.ok) {
                                    console.log('Image uploaded successfully');
                                    // Reload the page to reflect the changes
                                    location.reload();
                                } else {
                                    console.error('Failed to upload image:', response.statusText);
                                }
                            })
                            .catch(error => {
                                console.error('Error uploading image:', error);
                            });
                        });
                    });

                    // Trigger click on the file input when the add button is clicked
                    fileInput.click();
                });

                // Append add button to the brochuresCard
                brochuresCard.appendChild(addButton);
            } else if (editButton.textContent === 'Done') {
                // Change button text back to 'Edit'
                editButton.textContent = 'Edit';
                
                // Remove remove icon buttons from each image
                const removeButtons = document.querySelectorAll('.remove-button');
                removeButtons.forEach(button => {
                    button.remove();
                });

                // Remove add button
                const addButton = document.querySelector('.add-button');
                addButton.remove();
            }
        });
    } else {
        console.error('projectBrochuresArray is not an array or is undefined');
    }
}




   // Function to populate the Brochures grid with image URLs fetched from the controller
function populateGalleryGrid(galleryImagesArray) {
    const galleryGrid = document.getElementById('galleryGrid');
    // Clear existing content
    galleryGrid.innerHTML = '';

    // Check if projectBrochuresArray is defined and is an array
    if (Array.isArray(galleryImagesArray)) {
        // Iterate over the brochure URLs fetched from the controller
        galleryImagesArray.forEach(relativePath => {
            // Construct the complete image URL by prepending the base URL
            const imageUrl = window.location.origin + '/' + relativePath;

            const colDiv = document.createElement('div');
            colDiv.classList.add('col');
            const img = document.createElement('img');
            img.classList.add('img-fluid');
            img.style.width = '300px'; // Set width to 200px
            img.style.height = '300px'; // Set height to 200px
            img.style.boxShadow = '0px 4px 8px rgba(0, 0, 0, 0.1)'; // Add shadow effect
            img.src = imageUrl; // Use the complete image URL
            colDiv.appendChild(img);
            galleryGrid.appendChild(colDiv);
        });
    } else {
        console.error('galleryImagesArray is not an array or is undefined');
    }
}

</script>

<script>
  // Call populateBrochuresGrid function with projectBrochuresArray
  window.onload = function() {
      populateBrochuresGrid({!! json_encode($projectBrochuresArray) !!});
      populateGalleryGrid({!! json_encode($galleryImagesArray) !!});
  };

  // Event listener to re-populate the Brochures grid when the brochure tab is clicked
document.getElementById('brochuresTab').addEventListener('click', function() {
    populateBrochuresGrid({!! json_encode($projectBrochuresArray) !!});
});

  // Event listener to re-populate the Brochures grid when the brochure tab is clicked
  document.getElementById('galleryTab').addEventListener('click', function() {
    populateGalleryGrid({!! json_encode($galleryImagesArray) !!});
});
</script>

<script>
  // The DOM element you wish to replace with Tagify
  var input = document.querySelector('input[name=projectFacilities]');

  // initialize Tagify on the above input node reference
  new Tagify(input)
</script>

<script>
  fetch('https://countriesnow.space/api/v0.1/countries/cities', {
      method: 'POST', // Since the API requires a POST request
      headers: {
          'Content-Type': 'application/json'
      },
      body: JSON.stringify({
          "country": "malaysia"
      })
  })
  .then(response => response.json())
  .then(data => {
      if (!data.error) {
          const cities = data.data;
          const select = document.getElementById('citySelect');
          const projectCity = select.getAttribute('data-project-city');

          cities.forEach(city => {
              const option = document.createElement('option');
              option.value = city;
              option.textContent = city;
              // Check if the city matches the project's city
              if (projectCity === city) {
                  option.selected = true;
              }
              select.appendChild(option);
          });
      } else {
          console.error('Error:', data.msg);
      }
  })
  .catch(error => {
      console.error('Error:', error);
  });
</script>


</body>

</html>
