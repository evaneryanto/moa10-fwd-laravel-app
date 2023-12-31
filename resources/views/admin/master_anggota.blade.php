<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Member</title>
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css' />
    <link rel='stylesheet'
        href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css' />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" />
</head>
<body>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container">
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="{{route('tampil_master_buku')}}">Master Buku</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="{{route('tampil_master_member')}}">Master Member</a>
              </li>
            </ul>
            <form action="{{ route('logout') }}" method="POST" class="d-flex" role="search">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger" type="submit">Logout</button>
            </form>
          </div>
        </div>
    </nav>
  <div class="container">
    <div class="row my-5">
      <div class="col-lg-12">
        <h2>Master Member</h2>
        <div class="card shadow">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="text-light">Member</h3>
            <button class="btn btn-light" data-bs-toggle="modal" data-bs-target="#addMemberModal"><i
                class="bi-plus-circle me-2"></i>Add New Member</button>
          </div>
          <div class="card-body" id="show_members">
            <h1 class="text-center text-secondary my-5">Loading...</h1>
          </div>
        </div>
      </div>
    </div>
  </div>

  {{-- new member modal --}}

  <div class="modal fade" id="addMemberModal" tabindex="-1" aria-labelledby="exampleModalLabel"
  data-bs-backdrop="static" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add New Member</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="#" method="POST" id="add_member_form" enctype="multipart/form-data">
        @csrf
        <div class="modal-body p-4 bg-light">
          <div class="row">
            
        <div class="my-2">
                <label for="isbn">Nama</label>
                <input type="text" name="name" class="form-control" placeholder="Name" required>
              
              <label for="judul">Username</label>
              <input type="text" name="judul" class="form-control" placeholder="Username" required>
          
            <label for="pengarang">Email</label>
            <input type="text" name="email" class="form-control" placeholder="Email" required>

            <label for="klasifikasi">Klasifikasi</label>
            <input type="password" name="password" class="form-control" placeholder="Password" required>

        </div>
            
        </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" id="add_member_btn" class="btn btn-primary">Add Member</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!--Edit Book -->

<div class="modal fade" id="editBookModal" tabindex="-1" aria-labelledby="exampleModalLabel"
  data-bs-backdrop="static" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Members</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="#" method="POST" id="edit_book_form" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="kode" id="kode">
        <div class="modal-body p-4 bg-light">
            
              <label for="name">Nama Member</label>
              <input type="text" id = "name" name="nama_member" class="form-control" placeholder="Nama" required>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" id="edit_book_btn" class="btn btn-success">Update Member</button>
        </div>
      </form>
    </div>
  </div>
</div>

 
<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
<script src='https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js'></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <script>
    $(function(){
 
    // add 
    //   $("#add_member_form").submit(function(e) {
    //     e.preventDefault();
    //     const fd = new FormData(this);
    //     $("#add_member_btn").text('Adding...');
    //     $.ajax({
    //       url: '{{ route('storeMembers') }}',
    //       method: 'post',
    //       data: fd,
    //       cache: false,
    //       contentType: false,
    //       processData: false,
    //       dataType: 'json',
    //       success: function(response) {
    //         //alert(response);
    //         if(response.status == 200) {
    //           Swal.fire(
    //             'Added!',
    //             'Member Added Successfully!',
    //             'success'
    //           )
    //           fetchAllMembers();
    //         }
    //         console.log(response);
    //         $("#add_member_btn").text('Add Member');
    //         $("#add_member_form")[0].reset();
    //         $("#addMemberModal").modal('hide');
    //       }
    //     });
    //   });
 
      // edit 
      $(document).on('click', '.editIcon', function(e) {
        e.preventDefault();
        let id = $(this).attr('id');
        //alert("ini id "+id);
        $.ajax({
          url: '{{ route('editMembers') }}',
          method: 'get',
          data: {
            id: id,
            _token: '{{ csrf_token() }}'
          },
          success: function(response) {
            //alert(response.name);
            $("#kode").val(response.id);
            $("#name").val(response.name);
          }
        });
      });
 
      //update 
    //   $("#edit_book_form").submit(function(e) {
    //     e.preventDefault();
    //     const fd = new FormData(this);
    //     $("#edit_book_btn").text('Updating...');
    //     $.ajax({
    //       url: '{{route('update')}}',
    //       method: 'post',
    //       data: fd,
    //       cache: false,
    //       contentType: false,
    //       processData: false,
    //       dataType: 'json',
    //       success: function(response) {
    //         //alert("pesan "+response.msg);
    //         if (response.status == 200) {
    //           Swal.fire(
    //             'Updated!',
    //             'Book Updated Successfully!',
    //             'success'
    //           )
    //           fetchAllBooks();
             
    //         }
    //         $("#edit_book_btn").text('Update Book');
    //         $("#edit_book_form")[0].reset();
    //         $("#editBookModal").modal('hide');
    //       }
    //     });
    //   });
 
      // delete 
    //   $(document).on('click', '.deleteIcon', function(e) {
    //     e.preventDefault();
    //     let id = $(this).attr('id');
    //     let csrf = '{{ csrf_token() }}';
    //     Swal.fire({
    //       title: 'Are you sure?',
    //       text: "You won't be able to revert this!",
    //       icon: 'warning',
    //       showCancelButton: true,
    //       confirmButtonColor: '#3085d6',
    //       cancelButtonColor: '#d33',
    //       confirmButtonText: 'Yes, delete it!'
    //     }).then((result) => {
    //       if (result.isConfirmed) {
    //         $.ajax({
    //           url: '{{route('delete')}}',
    //           method: 'delete',
    //           data: {
    //             id: id,
    //             _token: csrf
    //           },
    //           success: function(response) {
    //             console.log(response);
    //             Swal.fire(
    //               'Deleted!',
    //               'Your file has been deleted.',
    //               'success'
    //             )
    //             fetchAllBooks();
    //           }
    //         });
    //       }
    //     })
    //   });
 
    //   // fetch all employees ajax request
    fetchAllMembers();
 
      function fetchAllMembers() {
        //alert("Oke");
        $.ajax({
          url: '{{ route('fetchAllMembers') }}',
          method: 'GET',
          success: function(response) {
            //alert(response);
            $("#show_members").html(response);
            $("table").DataTable({
              order: [0, 'desc']
            });
          }
          //alert(response);
        });
      }
     });
  </script>
  

</body>
</html>