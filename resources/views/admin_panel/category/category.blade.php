@include('admin_panel.include.header')
<meta name="csrf-token" content="{{ csrf_token() }}">

<body>
    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="loader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3"
                    stroke-miterlimit="10" />
            </svg>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->
    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">
        <!--**********************************
            Nav header start
        ***********************************-->
        <div class="nav-header">
            <div class="brand-logo">
                <a href="index.html">
                    <b class="logo-abbr"><img src="images/logo.png" alt=""> </b>
                    <span class="logo-compact"><img src="./images/logo-compact.png" alt=""></span>
                    <span class="brand-title">
                        <img src="images/logo-text.png" alt="">
                    </span>
                </a>
            </div>
        </div>
        <!--**********************************
            Nav header end
        ***********************************-->
        <!--**********************************
            Header start
        ***********************************-->
        @include('admin_panel.include.navbar')
        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->

        <!--**********************************
            Sidebar start
        ***********************************-->
        @include('admin_panel.include.sidebar')
        <!--**********************************
            Sidebar end
        ***********************************-->
        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <div class="container-fluid mt-3">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <!-- Add Sub Category Button (Above Heading) -->
                                <button type="button" class="btn btn-primary float-right mb-3" data-toggle="modal"
                                    data-target="#addSubCategoryModal">
                                    Add Category
                                </button>
                                <div class="card-title">
                                    <h4>All Categories</h4>
                                </div>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Sub Categories</th>
                                                <th>Categories</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($all_categories as $categories)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $categories->sub_category_name }}</td>
                                                    <td>{{ $categories->category_name }}</td>
                                                    <td>
                                                        <button type="button" class="btn btn-primary"
                                                            data-toggle="modal" data-target="#editCategoryModal"
                                                            data-id="{{ $categories->id }}"
                                                            data-category="{{ $categories->category_name }}">
                                                            Edit
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #/ container -->
        </div>
        <!--**********************************
            Content body end
        ***********************************-->
        <!-- Add Sub Category Modal -->
        <div class="modal fade" id="addSubCategoryModal" tabindex="-1" role="dialog"
            aria-labelledby="addCategoryModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addCategoryModalLabel">Add Category</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Add your form or content for adding sub-category here -->
                        <!-- Example form: -->
                        <form method="POST" action="{{ route('store-category') }}">
                            @csrf
                            <div class="form-group">
                                <label for="subCategoryName">Sub Category Name</label>
                                <select name="sub_category_name" id="ProjectName" class="form-control" required>
                                    <option value="" disabled selected>Select Sub Category</option>
                                    @foreach($all_sub_categories as $sub_categories)
                                        <option value="{{ $sub_categories->sub_category_name }}" @if($sub_categories->sub_category_name == 'Select Sub Category') disabled @endif>
                                            {{ $sub_categories->sub_category_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        
                            <div class="form-group">
                                <label for="subCategoryName">Category Name</label>
                                <input type="text" class="form-control" id="subCategoryName" placeholder="Enter Sub Category Name" name="category_name">
                            </div>
                            <!-- Add more form fields as needed -->
                            <button type="submit" class="btn btn-primary">Add Category</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit Sub Category Modal -->
        <div class="modal fade" id="editCategoryModal" tabindex="-1" role="dialog"
            aria-labelledby="addCategoryModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addCategoryModalLabel">Update Category</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Add your form or content for updating sub-category here -->
                        <form method="POST" id="updateCategoryForm">
                            <input type="hidden" id="categoryId" name="categoryId">
                            <div class="form-group">
                                <label for="subCategoryName">Update Sub Category Name</label>
                                <select name="subCategoryName" class="form-control" required>
                                    <option value="" disabled selected id="subCategoryName">Select Sub Category</option>
                                    @foreach($all_sub_categories as $categories)
                                        <option value="{{ $categories->sub_category_name }}" @if($categories->sub_category_name == 'Select Sub Category') disabled @endif>
                                            {{ $categories->sub_category_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="CategoryName" id="categoryId" id="CategoryName">Category Name</label>
                                <input type="text" name="category_name" class="form-control" id="CategoryName"  placeholder="Enter Category Name">


                            </div>

                            <!-- Add more form fields as needed -->
                            <button type="submit" class="btn btn-primary">Update Category</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
        <!--**********************************
            Footer start
        ***********************************-->
        <div class="footer">
            <div class="copyright">
                <p>Copyright &copy; Designed & Developed by <a href="https://themeforest.net/user/quixlab">Quixlab</a>
                    2018</p>
            </div>
        </div>
        <!--**********************************
            Footer end
        ***********************************-->
    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
    @include('admin_panel.include.footer')
    <script>
        $(document).ready(function () {
             $('#editCategoryModal').on('show.bs.modal', function (event) {
                 var button = $(event.relatedTarget); // Button that triggered the modal
                 var categoryId = button.data('id'); // Extract id from data-id attribute
                 var subcategoryname = button.data('subcategory'); // Extract id from data-id attribute
                 var categoryname = button.data('category'); // Extract id from data-id attribute
                 $('#categoryId').val(categoryId); // Set the id in the hidden input field
                 $('#subCategoryName').val(subcategoryname);
                 $('#CategoryName').val(categoryname);
             });
         });
 
         $(document).ready(function() {
             $('#updateCategoryForm').submit(function(e) {
                 e.preventDefault();
                //  console.log('Form submitted');
                 // Get form data
                 var formData = $(this).serialize();
                 // Get CSRF token value from the meta tag
                 var csrfToken = $('meta[name="csrf-token"]').attr('content');
                 // Add CSRF token to the headers
                 $.ajaxSetup({
                     headers: {
                         'X-CSRF-TOKEN': csrfToken
                     }
                 });
 
                 // Make Ajax request with a POST method
                 $.ajax({
                     type: 'POST',
                     url: '/update-category', // Replace with your actual endpoint
                     data: formData,
                     success: function(response) {
                         // Handle success response
                         console.log(response);
                         // Close the modal if needed
                         // $('#editCategoryModal').modal('hide');
                                 // Close the modal after 1 second
                         setTimeout(function () {
                             $('#editCategoryModal').modal('hide');
                         }, 1000);
 
                         // Reload the page after 2 seconds
                         setTimeout(function () {
                             location.reload();
                         }, 2000);
                     },
                     error: function(error) {
                         // Handle error response
                         console.error('Ajax request failed:', error);
                     }
                 });
             });
         });
     </script>
