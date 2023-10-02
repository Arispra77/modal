<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Data Pegawai</title>
  
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
   
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

     <!-- Bootstrap JavaScript -->
     <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> 
    
    <title>Document</title>
</head>

<body class="p-0 m-0 border-0 bd-example">
    
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
                  <a class="nav-link " href="{{ route('features') }}">Profil</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link active"  href="{{ url('modal')}}">isi</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link disabled" aria-disabled="true">Disabled</a>
              </li>
              <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Dropdown link
                  </a>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Action</a></li>
                    <li><a class="dropdown-item" href="#">Another action</a></li>
                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                  </ul>
                </li>
              <li class="nav-item">
                  <a class="nav-link" href="{{ route('logout') }}">Logout</a>
              </li>
          </ul>
      </div>
  </div>
</nav>
@if(session('success'))
<div class="alert alert-success" id="success-alert">
    {{ session('success') }}
</div>

<script>
    setTimeout(function() {
        document.getElementById('success-alert').style.display = 'none';
    }, 5000); // Menghilangkan pesan setelah 5 detik
</script>
@endif
<!-- End Navbar -->
    <table class="table table-bordered" id="myTable">
        <thead>
            <tr>
              <th>No.</th>
                  <th>No SPK</th>
                  <th>No WBS</th>
                  <th>Kode Proyek</th>
                  <th>Nama Kapal</th>
                  <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
            <tr data-id="{{ $item->Id_Job_SPK }}">
              <td>{{ $loop->iteration }}</td> <!-- Ini adalah nomor urutan -->
            
              <td>{{ $item->NoSPK }}</td>
              <td>{{ $item->NoWBS }}</td>
              <td>{{ $item->Kode_Proyek }}</td>
              <td>{{ $item->{'Nama Kapal'} }}</td>
              <td> 
           
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal{{$item->Id_Job_SPK}}">
                   modal
                  </button>
                
       
                {{-- <a href="#" class="btn btn-primary tombol-tambah" id="editCompany" >Tambah Data</a> --}}
       
                 @include('edit')
  
        </td>
       
            </tr>
            
            @endforeach
        </tbody>
    </table>
  
    
    
   
    
</body>
</html>