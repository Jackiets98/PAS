

<!DOCTYPE html>

<html lang="en" class="light-style layout-compact layout-navbar-fixed layout-menu-fixed     " dir="ltr" data-theme="theme-default" data-assets-path="https://demos.pixinvent.com/materialize-html-laravel-admin-template/demo/assets/" data-base-url="https://demos.pixinvent.com/materialize-html-laravel-admin-template/demo-1" data-framework="laravel" data-template="vertical-menu-theme-default-light">

@include('layout.header')


<style>
  div.dataTables_wrapper div.dataTables_filter {
      margin-top: -17px;
      margin-right: 8px;
  }

  input[type=number]::-webkit-inner-spin-button, 
  input[type=number]::-webkit-outer-spin-button { 
  -webkit-appearance: none; 
  margin: 0; 
  }

  .upload__box {
  padding: 40px;
}

.upload__inputfile {
  width: 0.1px;
  height: 0.1px;
  opacity: 0;
  overflow: hidden;
  position: absolute;
  z-index: -1;
}

.upload__btn {
  display: inline-block;
  font-weight: 600;
  color: #fff;
  text-align: center;
  min-width: 116px;
  padding: 5px;
  transition: all 0.3s ease;
  cursor: pointer;
  border: 2px solid;
  background-color: #4045ba;
  border-color: #4045ba;
  border-radius: 10px;
  line-height: 26px;
  font-size: 14px;
}

.upload__btn:hover {
  background-color: unset;
  color: #4045ba;
  transition: all 0.3s ease;
}

.upload__btn-box {
  margin-bottom: 10px;
}

.upload__img-wrap {
  display: flex;
  flex-wrap: wrap;
  margin: 0 -10px;
}

.upload__img-box {
  width: 200px;
  padding: 0 10px;
  margin-bottom: 12px;
}

.upload__img-close {
  width: 24px;
  height: 24px;
  border-radius: 50%;
  background-color: rgba(0, 0, 0, 0.5);
  position: absolute;
  top: 10px;
  right: 10px;
  text-align: center;
  line-height: 24px;
  z-index: 1;
  cursor: pointer;
}

.upload__img-close:after {
  content: "\2716";
  font-size: 14px;
  color: white;
}

p {
margin: 0;
}

.img-bg {
background-repeat: no-repeat;
background-position: center;
background-size: cover;
position: relative;
padding-bottom: 100%;
}

#fileElem, #second-fileElem {
  display: none;
}

#drop-area, #second-drop-area {
  border: 2px dashed #ccc;
  border-radius: 5px;
  padding: 20px;
  text-align: center;
  cursor: pointer;
  transition: border-color 0.3s ease;
}

#drop-area.highlight {
  border-color: #4045ba; /* Change color on dragover */
}

#drop-area .button {
  /* background-color: #4045ba;
  color: #fff;
  padding: 10px 20px;
  border-radius: 5px;
  display: inline-block;
  cursor: pointer;
  transition: background-color 0.3s ease; */

}

#drop-area .button:hover {
  /* background-color: #303593; Darken color on hover */

}

.preview-container {
    width: 100%;
    height: 200px; /* Adjust height as needed */
    overflow: hidden;
    margin-bottom: 10px; /* Adjust margin as needed */
}

#file-preview {
    width: 200px;
    height: 200px;
}
</style>

      <!-- Content wrapper -->
      <div class="content-wrapper">

        <!-- Content -->
                  <div class="container-xxl flex-grow-1 container-p-y">


<div class="app-ecommerce">
    <form action="{{ url('/storeProject') }}" method="POST" enctype="multipart/form-data">
        @csrf
  <!-- Add Project -->
  <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-3">

    <div class="d-flex flex-column justify-content-center">
      <h4 class="mb-1 mt-3">Add a new Project</h4>
    </div>
    <div class="d-flex align-content-center flex-wrap gap-3">
      <button class="btn btn-outline-secondary">Discard</button>
      <button type="submit" class="btn btn-primary">Add Project</button>
    </div>
  </div>

  <div class="row">

    <!-- First column-->
    <div class="col-12 col-lg-8">
      <!-- Project Information -->
      <div class="card mb-4">
        <div class="card-header">
          <h5 class="card-tile mb-0">Project information</h5>
        </div>
        <div class="card-body">
          <div class="form-floating form-floating-outline mb-4">
            <input type="text" class="form-control" placeholder="Project Name" name="projectTitle" required>
            <label for="project-name">Name</label>
          </div>

          <div class="row mb-3">
            <div class="col">
              <div class="form-floating form-floating-outline">
                <select name="projectType" class="select2 form-select" data-allow-clear="true" required>
                    <option disabled>Select Property Type</option>
                    <option value="10000">Flat/ Apartment</option>
                    <option value="10001">Residential House</option>
                    <option value="10002">Villa</option>
                    <option value="10003">Builder Floor Apartment</option>
                    <option value="10004">Residential Land/ Plot</option>
                    <option value="10005">Penthouse</option>
                    <option value="10006">Studio Apartment</option>
                  </select>
                <label for="project-type">Type</label>
              </div>
            </div>
            <div class="col">
              <div class="form-floating form-floating-outline">
                <input type="text" class="form-control" placeholder="Property Address" name="propertyAddress" required>
                <label for="property-address">Address</label>
              </div>
            </div>
          </div>

          <div class="row mb-3">
            <div class="col">
                <div class="form-floating form-floating-outline">
                    <select class="form-select" name="propertyCity" id="citySelect" required>
                        <option value="" selected disabled>Choose a City</option>
                    </select>
                    <label for="property-address">City</label>
                </div>
            </div>
          </div>

          <div class="row mb-3">
            <div class="col">
              <div class="form-floating form-floating-outline">
                <input type="text" class="form-control" placeholder="Postcode" name="propertyPostcode" required>
                <label for="project-type">Postcode</label>
              </div>
            </div>
            <div class="col">
                <div class="form-floating form-floating-outline">
                    <select class="form-select" name="propertyState" id="propertyState" required>
                        <option value="" selected disabled>Choose a State</option>
                        <option value="Johor">Johor</option>
                        <option value="Kedah">Kedah</option>
                        <option value="Kelantan">Kelantan</option>
                        <option value="Melaka">Melaka</option>
                        <option value="Negeri Sembilan">Negeri Sembilan</option>
                        <option value="Pahang">Pahang</option>
                        <option value="Penang">Penang</option>
                        <option value="Perak">Perak</option>
                        <option value="Perlis">Perlis</option>
                        <option value="Sabah">Sabah</option>
                        <option value="Sarawak">Sarawak</option>
                        <option value="Selangor">Selangor</option>
                        <option value="Terengganu">Terengganu</option>
                        <option value="Kuala Lumpur">Kuala Lumpur</option>
                        <option value="Labuan">Labuan</option>
                        <option value="Putrajaya">Putrajaya</option>
                    </select>
                    <label for="property-address">State</label>
                </div>
            </div>
          </div>

          <div class="form-floating form-floating-outline mb-4">
            <input type="text" class="form-control" placeholder="Project URL" name="projectURL">
            <label for="project-link">Website Link</label>
          </div>

          <div class="row mb-3">
            <div class="col">
              <div class="form-floating form-floating-outline">
                <input type="number" class="form-control"  name="propertyLatitude">
                <label for="project-type">Latitude</label>
              </div>
            </div>
            <div class="col">
                <div class="form-floating form-floating-outline">
                  <input type="number" class="form-control"  name="propertyLongitude">
                  <label for="project-type">Longitude</label>
                </div>
              </div>
          </div>
          <!-- Comment -->

        </div>
      </div>
      <!-- /Project Information -->
      <!-- Media -->
      <div class="card mb-4">
        <div class="card-header">
          <h5 class="card-title mb-0">Brochures</h5>
        </div>
        <div class="card-body">
            <div id="drop-area">
                <input type="file" id="fileElem" multiple accept="image/*" onchange="handleFiles(this.files)">
                <label class="button" for="fileElem">Select some files</label><br>
                <label for="gallery" style="color: red;">Supported Format: jpeg, png, gif, svg | </label>
                <label for="gallery" style="color: red;">Max Size: 3MB | </label>
                <label for="gallery" style="color: red;">Max no. of Images: 30</label>
                <div id="gallery" class="row"></div>
                <input type="file" name="photo_additional[]" style="display: none">
                <p id="image_limit_warning" class="text-danger" style="display: none;">Reached 30 images limit</p>
            </div>
        </div>
      </div>

    <div id="preview" class="form-group row bg-light p-1">
    </div>
      <!-- /Media -->
      <!-- Variants -->
      <div class="card mb-4">
        <div class="card-header">
            <h5 class="card-title mb-0">Gallery</h5>
        </div>
        <div class="card-body">
            <div id="second-drop-area">
                <input type="file" id="second-fileElem" multiple accept="image/*" onchange="handleSecondFiles(this.files)" style="display: none">
                <label class="button" for="second-fileElem">Select some files</label><br>
                <label for="second-gallery" style="color: red;">Supported Format: jpeg, png, gif, svg | </label>
                <label for="second-gallery" style="color: red;">Max Size: 3MB | </label>
                <label for="second-gallery" style="color: red;">Max no. of Images: 30</label>
                <div id="second-gallery" class="row"></div>
                <input type="file" name="second_photo_additional[]" style="display: none">
                <p id="second-image_limit_warning" class="text-danger" style="display: none;">Reached 30 images limit</p>
            </div>
        </div>
    </div>

    <div id="second-preview" class="form-group row bg-light p-1"></div>
      <!-- /Variants -->
      <!-- Inventory -->

      <!-- /Inventory -->
    </div>
    <!-- /Second column -->

    <!-- Second column -->
    <div class="col-12 col-lg-4">
      <!-- Pricing Card -->
      <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
          <h5 class="mb-0 card-title">Logo</h5>
        </div>
        <div class="card-body">
          <div class="preview-container">
              <center><img id="file-preview" src="#" alt="Preview" style="display: none;" /></center>
          </div>
          <div class="fallback">
              <input id="file-input" name="projectLogo" type="file" onchange="previewingFile()" />
          </div>
      </div>
      </div>
      <!-- /Pricing Card -->
      <!-- Organize Card -->
      <div class="card mb-4">
        <div class="card-header">
          <h5 class="card-title mb-0">Facilities</h5>
        </div>
        <div class="card-body">
          <div class="mb-3">
            <div class="form-floating form-floating-outline">
              <input id="ecommerce-Project-tags" class="form-control h-auto" name="projectFacilities" aria-label="Project Tags" />
              <label for="ecommerce-Project-tags">Tags</label>
            </div>
          </div>
        </div>
      </div>
      <!-- /Organize Card -->
    </div>
</form>
    <!-- /Second column -->
  </div>
</div>


          </div>
          <!-- / Content -->

          @include('layout.footer')

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

                    cities.forEach(city => {
                        const option = document.createElement('option');
                        option.value = city;
                        option.textContent = city;
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


        <script>
            // drag n drop
            let dropArea = document.getElementById('drop-area');
            let img_n = 0;

            // Prevent default drag behaviors
            ;['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            dropArea.addEventListener(eventName, preventDefaults, false)
            document.body.addEventListener(eventName, preventDefaults, false)
            })

            // Highlight drop area when item is dragged over it
            ;['dragenter', 'dragover'].forEach(eventName => {
            dropArea.addEventListener(eventName, highlight, false)
            })

            ;['dragleave', 'drop'].forEach(eventName => {
            dropArea.addEventListener(eventName, unhighlight, false)
            })

            // Handle dropped files
            dropArea.addEventListener('drop', handleDrop, false)

            function preventDefaults (e) {
                e.preventDefault()
                e.stopPropagation()
            }

            function highlight(e) {
                dropArea.classList.add('highlight')
            }

            function unhighlight(e) {
                dropArea.classList.remove('highlight')
            }

            function handleDrop(e) {
                var dt = e.dataTransfer;
                var files = dt.files;

                // create new DataTransfer object
                let dataTransfer = new DataTransfer();

                // add existing file objects into datatransfer
                var fileList = $('input[name="photo_additional[]"]').prop('files');
                for (let i = 0; i < fileList.length; i++) {
                    dataTransfer.items.add(fileList[i]);
                }

                // add newly uploaded file objects into datatransfer
                for (let i = 0; i < files.length; i++) {
                    // Check the size of the file (in bytes) and add only if it's less than 3MB
                    if (files[i].size <= 3 * 1024 * 1024) {
                        if (dataTransfer.items.length < 30) {
                            dataTransfer.items.add(files[i]);
                        } else {
                            console.log('over limit 30');
                            $('#image_limit_warning').show();
                        }
                    } else {
                        console.log('File size exceeds 3MB: ' + files[i].name);
                        alert('File size exceeds 3MB: ' + files[i].name);
                        // You can also show a warning message to the user here if needed
                    }
                }

                // add the new Filelist to input
                $('input[name="photo_additional[]"]').prop('files', dataTransfer.files);
                $('#preview').html('');
                handleFiles(dataTransfer.files);
            }

            function handleFiles(files) {
                console.log("Selected files:", files);
                files = [...files]
                files.forEach(previewFile)
            }

            function previewFile(file) {
                img_n+=1;
                let reader = new FileReader()
                reader.readAsDataURL(file)
                reader.onloadend = function() {
                    // let img = document.createElement('img')
                    // img.src = reader.result

                    // string = `<div class="card mb-0 mt-2">
                    //             <div class="card-body">
                    //                 <div class="d-flex align-items-start">
                    //                     <div class="w-100">
                    //                         <img src="`+reader.result+`">
                    //                     </div>
                    //                 </div>
                    //             </div>
                    //         </div>`

                    // // document.getElementById('gallery').appendChild(img)
                    // $('#gallery').append(string);

                    var html = `<div class="col-6">
                                    <div class="card" style="padding: .20rem .20rem; margin: .20rem .20rem; position:relative;">
                                        <div class="card-body">
                                            <button type="button" class="btn btn-danger remove-file" onclick="removeFile(this)">X</button>
                                            <img src="${reader.result}" alt="" style="width: 200px; height: 200px; margin-top: 5px; margin-left: 30px; object-fit: contain;" data-file-name="${file.name}">
                                        </div>
                                    </div>
                                </div>`

                    $('#preview').append(html)
                }
            }

            function removeFile(e) {
                var fileList = $('input[name="photo_additional[]').prop('files');
                var fileName = $(e).parent().find('img').attr('data-file-name');
                var index = $(e).parent().parent().parent().index();

                // create new DataTransfer object
                let dataTransfer = new DataTransfer();

                // add existing file objects except the file to be removed into datatransfer
                var fileList = $('input[name="photo_additional[]').prop('files');
                for (let i = 0; i < fileList.length; i++) {
                    // if(fileList[i].name != fileName) {
                    //     dataTransfer.items.add(fileList[i])
                    // }
                    if(i != index) {
                        dataTransfer.items.add(fileList[i])
                    }
                }

                // add the new Filelist to input
                $('input[name="photo_additional[]').prop('files', dataTransfer.files);

                // remove preview
                $(e).parent().parent().parent().remove();
            }


            // end drag n drop
        </script>


<script>
    // drag n drop
    let secondDropArea = document.getElementById('second-drop-area');
    let secondImg_n = 0;

    // Prevent default drag behaviors
    ;['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        secondDropArea.addEventListener(eventName, preventDefaults, false)
        document.body.addEventListener(eventName, preventDefaults, false)
    })

    // Highlight drop area when item is dragged over it
    ;['dragenter', 'dragover'].forEach(eventName => {
        secondDropArea.addEventListener(eventName, highlight, false)
    })

    ;['dragleave', 'drop'].forEach(eventName => {
        secondDropArea.addEventListener(eventName, unhighlight, false)
    })

    // Handle dropped files
    secondDropArea.addEventListener('drop', handleSecondDrop, false)

    function handleSecondDrop(e) {
        var dt = e.dataTransfer;
        var files = dt.files;

        // create new DataTransfer object
        let dataTransfer = new DataTransfer();

        // add existing file objects into datatransfer
        var fileList = $('input[name="second_photo_additional[]"]').prop('files');
        for (let i = 0; i < fileList.length; i++) {
            dataTransfer.items.add(fileList[i]);
        }

        // add newly uploaded file objects into datatransfer
        for (let i = 0; i < files.length; i++) {
            // Check the size of the file (in bytes) and add only if it's less than 3MB
            if (files[i].size <= 3 * 1024 * 1024) {
                if (dataTransfer.items.length < 30) {
                    dataTransfer.items.add(files[i]);
                } else {
                    console.log('over limit 30');
                    $('#second-image_limit_warning').show();
                }
            } else {
                console.log('File size exceeds 3MB: ' + files[i].name);
                alert('File size exceeds 3MB: ' + files[i].name);
                // You can also show a warning message to the user here if needed
            }
        }

        // add the new Filelist to input
        $('input[name="second_photo_additional[]"]').prop('files', dataTransfer.files);
        $('#second-preview').html('');
        handleSecondFiles(dataTransfer.files);
    }

    function handleSecondFiles(files) {
        files = [...files]
        files.forEach(previewSecondFile)
    }

    function previewSecondFile(file) {
        secondImg_n += 1;
        let reader = new FileReader()
        reader.readAsDataURL(file)
        reader.onloadend = function() {
            var html = `<div class="col-6">
                                    <div class="card" style="padding: .20rem .20rem; margin: .20rem .20rem; position:relative;">
                                        <div class="card-body">
                                            <button type="button" class="btn btn-danger remove-file" onclick="removeSecondFile(this)">X</button>
                                            <img src="${reader.result}" alt="" style="width: 200px; height: 200px; margin-top: 5px; margin-left: 30px; object-fit: contain;" data-file-name="${file.name}">
                                        </div>
                                    </div>
                                </div>`

            $('#second-preview').append(html)
        }
    }

    function removeSecondFile(e) {
        var fileList = $('input[name="second_photo_additional[]').prop('files');
        var fileName = $(e).parent().find('img').attr('data-file-name');
        var index = $(e).parent().parent().parent().index();

        // create new DataTransfer object
        let dataTransfer = new DataTransfer();

        // add existing file objects except the file to be removed into datatransfer
        var fileList = $('input[name="second_photo_additional[]').prop('files');
        for (let i = 0; i < fileList.length; i++) {
            // if(fileList[i].name != fileName) {
            //     dataTransfer.items.add(fileList[i])
            // }
            if (i != index) {
                dataTransfer.items.add(fileList[i])
            }
        }

        // add the new Filelist to input
        $('input[name="second_photo_additional[]').prop('files', dataTransfer.files);

        // remove preview
        $(e).parent().parent().parent().remove();
    }
    // end drag n drop
</script>

<script>
  function previewingFile() {
    var preview = document.getElementById('file-preview');
    var fileInput = document.getElementById('file-input').files[0];
    var reader = new FileReader();

    reader.onloadend = function () {
        preview.src = reader.result;
        preview.style.display = 'block';
    }

    if (fileInput) {
        reader.readAsDataURL(fileInput);
    } else {
        preview.src = '#';
        preview.style.display = 'none';
    }
}
</script>

</body>

</html>

