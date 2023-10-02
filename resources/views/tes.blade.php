<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
   
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Bootstrap CSS -->
   
    <script src="{{ asset('vendor/sweetalert/sweetalert.all.js') }}"></script>
    <!-- Bootstrap JavaScript -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    
    <title></title>
</head>
<body class="p-0 m-0 border-0 bd-example">
   <!-- Alert untuk pesan sukses atau error -->
<div class="alert alert-success" style="display:none;"></div>
<div class="alert alert-danger" style="display:none;"></div>

    @include('sweetalert::alert')
<!-- Navbar -->
<nav class="navbar navbar-expand-md navbar-dark bg-dark sticky-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">{{ old('nama_kary',Auth::user()->nama_kary) }}</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('features') }}">Profil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('modal')}}">isi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" aria-disabled="true">Disabled</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('logout') }}">Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- End Navbar -->


<div class="container mt-4">
    <h4>Username: {{old('nama_kary',Auth::user()->nama_kary)}}</h4></h4>
    <p>Nama PT: {{old('nama_kary1',Auth::user()->nama_kary1)}}</p>
</div>
<div class="container mt-4">
    
    <!-- Button to trigger the password change modal -->
    <button id="editPasswordButton" class="btn btn-primary" data-toggle="modal" data-target="#passwordChangeModal">Edit Password</button>

    <!-- Password Change Modal -->
    <form method="POST" action="{{ route('passwordd') }} "class="modal fade" id="passwordChangeModal" tabindex="-1" role="dialog" aria-labelledby="passwordChangeModalLabel" aria-hidden="true">
        @method('POST')
        @csrf
    
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="passwordChangeModalLabel">Ganti Password</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
             
                   
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="current_password" class="col-md-4 col-form-label text-md-right">{{ __('Password Lama') }}</label>

                            <div class="col-md-8">
                                <input id="current_password" type="password" class="form-control" name="current_password" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password Baru') }}</label>

                            <div class="col-md-8">
                                <input id="password" type="password" class="form-control" name="password" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password_confirmation" class="col-md-4 col-form-label text-md-right">{{ __('Konfirmasi Password Baru') }}</label>

                            <div class="col-md-8">
                                <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close') }}</button>
                        <button type="submit" class="btn btn-primary" id="submit-btn">{{ __('Save') }}</button>
                    </div>
             
            </div>
        </div>
    
</form>
    <script>
        $(document).ready(function() {
            // Tombol "Edit Password"
            $('#editPasswordButton').on('click', function() {
                $('#passwordChangeModal')[0].reset(); // reset form saat modal dibuka
                $('#current_password').focus();
            });

            // Submit form
            $('#passwordChangeModal').on('submit', function(e) {
                e.preventDefault();

                var current_password = $('#current_password').val();
                var password = $('#password').val();
                var password_confirmation = $('#password_confirmation').val();

                // Validasi input
                // ...

                if (current_password === '') {
            Swal.fire({
                title: "Error",
                text: "Please enter your current password.",
                icon: "error"
            });
            $('#current_password').focus();
            return false;
        }
        if (password === '') {
            Swal.fire({
                title: "Error",
                text: "Please enter your new password.",
                icon: "error"
            });
            $('#password').focus();
            return false;
        }
        if (password_confirmation === '') {
            Swal.fire({
                title: "Error",
                text: "Please confirm your new password.",
                icon: "error"
            });
            $('#password_confirmation').focus();
            return false;
        }
        if (password !== password_confirmation) {
            Swal.fire({
                title: "Error",
                text: "password baru dan confirmasi password tidak sama.",
                icon: "error"
            });
            $('#password_confirmation').focus();
            return false;
        }

                // Kirim request untuk mengubah password
                $.ajax({
            type: 'POST',
            url: '{{ route('passwordd') }}',
            data: {
                '_token': '{{ csrf_token() }}',
                'current_password': current_password,
                'password': password,
                'password_confirmation': password_confirmation,
            },
            beforeSend: function() {
                // Menampilkan loading spinner
                $('#submit-btn').html('<i class="fa fa-spinner fa-spin"></i> Saving...');
            },
            success: function(response) {
                // Menampilkan pesan sukses menggunakan SweetAlert2
                Swal.fire({
                    title: "Success",
                    text: response.message,
                    icon: "success"
                }).then(function() {
   $('#passwordChangeForm')[0].reset();
        // Menghilangkan modal dan reset form
        $("#passwordChangeModal").modal("hide");
    
       
        });
               
            },
            error: function(xhr, textStatus, error) {
                // Menampilkan pesan error menggunakan SweetAlert2
                var errorMessage =  xhr.responseJSON.message;
                Swal.fire({
                    title: "Error",
                    text: errorMessage,
                    icon: "error"
                });
                $('#submit-btn').html('Save');
            }
        });
    });

            // Menampilkan modal jika terdapat error
            @if ($errors->any())
                $('#passwordChangeModal').modal('show');
            @endif
        });
    </script>
</div>




</body>
</html>
