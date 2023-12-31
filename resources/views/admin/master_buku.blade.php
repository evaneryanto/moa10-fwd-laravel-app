<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel 10 CRUD</title>
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
        <h2>Master Buku Using Ajax</h2>
        <div class="card shadow">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="text-light">Manage Buku</h3>
            <button class="btn btn-light" data-bs-toggle="modal" data-bs-target="#addBookModal"><i
                class="bi-plus-circle me-2"></i>Add New Book</button>
          </div>
          <div class="card-body" id="show_books">
            <h1 class="text-center text-secondary my-5">Loading...</h1>
          </div>
        </div>
      </div>
    </div>
  </div>

  {{-- new book modal --}}

  <div class="modal fade" id="addBookModal" tabindex="-1" aria-labelledby="exampleModalLabel"
  data-bs-backdrop="static" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add New Book</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="#" method="POST" id="add_book_form" enctype="multipart/form-data">
        @csrf
        <div class="modal-body p-4 bg-light">
          <div class="row">
            
        <div class="my-2">
                <label for="isbn">ISBN</label>
                <input type="text" name="kode_buku" class="form-control" placeholder="ISBN" required>
              
              <label for="judul">Judul</label>
              <input type="text" name="judul" class="form-control" placeholder="Judul" required>
          
            <label for="pengarang">Pengarang</label>
            <input type="text" name="pengarang" class="form-control" placeholder="pengarang" required>

            <label for="tanggal_terbit">Tanggal Terbit</label>
            <input type="date" name="tanggal_terbit" class="form-control" placeholder="tanggal_terbit" required>

            <label for="penerbit">Penerbit</label>
            <input type="text" name="penerbit" class="form-control" placeholder="penerbit" required>

            <label for="klasifikasi">Klasifikasi</label>
            <input type="text" name="klasifikasi" class="form-control" placeholder="klasifikasi" required>

        </div>
            
        </div>
          <div class="my-2">
            <label for="avatar">Pilih Foto</label>
            <input type="file" name="foto_buku" class="form-control" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" id="add_book_btn" class="btn btn-primary">Add Book</button>
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
        <h5 class="modal-title" id="exampleModalLabel">Edit Book</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="#" method="POST" id="edit_book_form" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="kode" id="kode">
        <input type="hidden" name="avatar" id="avatar">
        <div class="modal-body p-4 bg-light">
            <div class="my-2">
              <label for="avatar">Select Avatar</label>
              <input type="file" name="foto_buku" class="form-control">
            </div>
            <div class="mt-2" id="foto_buku"></div>
              <label for="isbn">ISBN</label>
              <input type="text" id = "kode_buku" name="kode_buku" class="form-control" placeholder="ISBN" required>
              
              <label for="judul">Judul</label>
              <input type="text" id = "judul" name="judul" class="form-control" placeholder="Judul" required>
          
              <label for="pengarang">Pengarang</label>
              <input type="text" id = "pengarang" name="pengarang" class="form-control" placeholder="pengarang" required>

              <label for="tanggal_terbit">Tanggal Terbit</label>
              <input type="date" id = "tanggal_terbit" name="tanggal_terbit" class="form-control" placeholder="tanggal_terbit" required>

              <label for="penerbit">Penerbit</label>
              <input type="text" id = "penerbit" name="penerbit" class="form-control" placeholder="penerbit" required>

              <label for="klasifikasi">Klasifikasi</label>
              <input type="text" id = "klasifikasi" name="klasifikasi" class="form-control" placeholder="klasifikasi" required>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" id="edit_book_btn" class="btn btn-success">Update Book</button>
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
      $("#add_book_form").submit(function(e) {
        e.preventDefault();
        const fd = new FormData(this);
        $("#add_book_btn").text('Adding...');
        $.ajax({
          url: '{{ route('store') }}',
          method: 'post',
          data: fd,
          cache: false,
          contentType: false,
          processData: false,
          dataType: 'json',
          success: function(response) {
            //alert(response);
            if(response.status == 200) {
              Swal.fire(
                'Added!',
                'Book Added Successfully!',
                'success'
              )
              fetchAllBooks();
            }
            console.log(response);
            $("#add_book_btn").text('Add Book');
            $("#add_book_form")[0].reset();
            $("#addBookeModal").modal('hide');
          }
        });
      });
 
      // edit 
      $(document).on('click', '.editIcon', function(e) {
        e.preventDefault();
        let id = $(this).attr('id');
        //alert("ini id "+id);
        $.ajax({
          url: '{{ route('edit') }}',
          method: 'get',
          data: {
            id: id,
            _token: '{{ csrf_token() }}'
          },
          success: function(response) {
            //alert(response.foto_buku);
            $("#judul").val(response.judul);
            $("#kode_buku").val(response.kode_buku);
            $("#pengarang").val(response.pengarang);
            $("#tanggal_terbit").val(response.tanggal_terbit);
            $("#foto_buku").html(
              `<img src="storage/images/${response.foto_buku}" width="100" height = "100" class="img-fluid img-thumbnail">`);
            $("#penerbit").val(response.penerbit);
            $("#klasifikasi").val(response.klasifikasi);

            $("#kode").val(response.id);
            $("#avatar").val(response.foto_buku);
          }
        });
      });
 
      //update 
      $("#edit_book_form").submit(function(e) {
        e.preventDefault();
        const fd = new FormData(this);
        $("#edit_book_btn").text('Updating...');
        $.ajax({
          url: '{{route('update')}}',
          method: 'post',
          data: fd,
          cache: false,
          contentType: false,
          processData: false,
          dataType: 'json',
          success: function(response) {
            //alert("pesan "+response.msg);
            if (response.status == 200) {
              Swal.fire(
                'Updated!',
                'Book Updated Successfully!',
                'success'
              )
              fetchAllBooks();
             
            }
            $("#edit_book_btn").text('Update Book');
            $("#edit_book_form")[0].reset();
            $("#editBookModal").modal('hide');
          }
        });
      });
 
      // delete 
      $(document).on('click', '.deleteIcon', function(e) {
        e.preventDefault();
        let id = $(this).attr('id');
        let csrf = '{{ csrf_token() }}';
        Swal.fire({
          title: 'Are you sure?',
          text: "You won't be able to revert this!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
          if (result.isConfirmed) {
            $.ajax({
              url: '{{route('delete')}}',
              method: 'delete',
              data: {
                id: id,
                _token: csrf
              },
              success: function(response) {
                console.log(response);
                Swal.fire(
                  'Deleted!',
                  'Your file has been deleted.',
                  'success'
                )
                fetchAllBooks();
              }
            });
          }
        })
      });
 
    //   // fetch all employees ajax request
    fetchAllBooks();
 
      function fetchAllBooks() {
        //alert("Oke");
        $.ajax({
          url: '{{ route('fetchAll') }}',
          method: 'GET',
          success: function(response) {
            //alert(response);
            $("#show_books").html(response);
            $("table").DataTable({
              order: [1, 'desc']
            });
          }
          //alert(response);
        });
      }
     });
  </script>
  

</body>
</html>