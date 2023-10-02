
<style>
    /* Ukuran huruf default */
    body {
        font-size: 14px;
    }
    /* Media query untuk layar kecil */
    @media screen and (max-width: 768px) {
        body {
            font-size: 10px; /* Ukuran huruf lebih kecil untuk layar kecil */
        }

        /* Mengatur tata letak tabel untuk layar kecil */
        table {
            font-size: 10px;
       }
    }
    @media screen and (max-width: 1000px) {
        body {
            font-size: 14px; /* Ukuran huruf lebih kecil untuk layar kecil */
        }

        /* Mengatur tata letak tabel untuk layar kecil */
        table {
            font-size: 9.5px;
       }
    }

    /* Media query untuk layar sangat kecil */
    @media screen and (max-width: 576px) {
        body {
            font-size: 9px; /* Ukuran huruf lebih kecil lagi untuk layar sangat kecil */
        }

        /* Mengatur tata letak tabel untuk layar sangat kecil */
        table {
            font-size: 9px;
        }
    }
    .textarea-container {
        display: flex;
        flex-direction: column;
        max-width: 300px; /* Sesuaikan dengan lebar yang Anda inginkan */
        width: 100%; /* Mengisi lebar kolom tersedia */
    }

    /* CSS untuk mengatur tata letak button */
    .textarea-container button {
        align-self: flex-end; /* Menyusun button ke kanan */
        margin-top: 10px; /* Memberikan jarak atas antara textarea dan button */
    }
</style>



<script>

  
    $(document).ready(function(){
  
  $('.table.table-bordered input#volume_Task').on('input', function(){
      var volume = $(this).val();
      var harga = $(this).closest('.table').find('input#UnitPrice').val();
      var total = volume * harga;
      
      // Konversi nilai total ke format mata uang Rupiah
      var totalRupiah = formatRupiah(total);
      
      // Masukkan hasil perhitungan ke dalam input Ttl_Price
      $(this).closest('.table').find('input#Ttl_Price').val(totalRupiah);
  });
});

// Fungsi untuk mengonversi angka ke format mata uang Rupiah
function formatRupiah(angka) {
  var reverse = angka.toString().split('').reverse().join(''),
      ribuan = reverse.match(/\d{1,3}/g);
  ribuan = ribuan.join('.').split('').reverse().join('');
  return 'Rp ' + ribuan;
}

</script>
<!-- Di dalam tampilan Blade Anda -->
<script>
   $(document).ready(function() {
    $('body').on('click', '.tombol-tambah', function() {
    var id = $(this).closest('tr').data('id');
    alert(id);
    //$('#editModal'+id).modal('show');
   })
   // $('#editModal').load('');
  // $('body').on('click', '#submit', function(event){
         //  event.preventDefault();
    //$('#editModal').load('{{ route('tambah-data', $item->Id_Job_SPK) }}');
//     $('#companydata ').on('submit', '#submit', function(event){
// event.preventDefault();
    
//         var id = $('#Id_Job_SPK').val();
//       //$('#editModal').load('tambah-data-real/'+id);
//        $.ajax({
//         type: 'POST',
//         url: 'tambah-data-real/'+id,
//         data : $('#companydata').serialize(),
//         success: function(response){
//             console.log(response);
//            // $('#editModal').modal('show');
//             $('#editModal').load('tambah-data-real/'+id);
//             $('#companydata')[0].reset();
//  //   $('#editModal').modal('show');
//     alert('oi')
//         }
//        })
        
       
     // }
     $('#close-btn').on('click', function() {
        // Sembunyikan form
        $('#passwordChangeForm').modal('hide');
    });
    
      //function() {
    //                $('#editModal').modal('show');
               //  alert('succes');
       //});

    //     var url = $(this).attr('tambah-');
    //   //  var method = $(this).attr('method');
    //     var data = $(this).serialize();
    //     var id = $('#Id_Job_SPK').val();
    //         var kode = $('#Kode').val();
    //         var realisasi = $('#realisasi_WP').val();
    //         var satuan = $('#Satuan').val();
    //         var Total = $('#Ttl_Price').val();
    //         var unit = $('#UnitPrice').val();
    //     $.ajax({
    //         url: 'tambah-data-real/'+id,
    //         type: 'post',
    //         data: {
    //                 id: id,
    //                 kode:kode,
    //                 realisasi:realisasi,
    //                 satuan:satuan,
    //                 Total:Total,
    //                 unit:unit,
    //             },
    //         success:function(response){
    //             // reset form input values
    //             $('#companydata')[0].reset();
                
    //             // load modal content
    //             $('#editModal').load('{{ route('tambah-data', $item->Id_Job_SPK) }}', function(event) {
    //                event.preventDefault();
    //                 $('#editModal').modal('show');
    //                 alert('succes');
    //          });
    //         },
    //         error:function(xhr, status, error){
    //             // handle error case
    //             alert('Error')
    //         }
    //     });
    });

          //  });
</script>
{{-- 
<script>
    $(document).ready(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('value'),
            }
        });
        $('body').on('click', '#submit', function(event){
            event.preventDefault();
            var id = $('#Id_Job_SPK').val();
            var kode = $('#Kode').val();
            var realisasi = $('#realisasi_WP').val();
            var satuan = $('#Satuan').val();
            var Total = $('#Ttl_Price').val();
            var unit = $('#UnitPrice').val();
            $.ajax({
                url: 'tambah-data-real/'+id,
                type: 'POST',
                data :{
                    id: id,
                    kode:kode,
                    realisasi:realisasi,
                    satuan:satuan,
                    Total:Total,
                    unit:unit,
                },
                dataType: 'json',
                success: function (data){
                   // $('#companydata').trigger('reset');
                    $('#editModal').modal('show');
                }
            })
        });
        $('body').on('click','#editModal',function(event){
            event.preventDefault();
            var id =$(this).data('id');
            console.log(id);
            $.get('item/'+id,function(data){
                $('#editModal').modal('show');
                $('#Id_Job_SPK').val(data.data.id);
                $('#Kode').val(data.data.kode);
                $('#realisasi_WP').val(data.data.realisasi);
                $('#Satuan').val(data.data.satuan);
                $('#Ttl_Price').val(data.data.Total);
                $('#UnitPrice').val(data.data.Unit);
            })
        })
    });
</script> --}}

@include('sweetalert::alert')

<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">No SPK : {{$item->NoSPK}} </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
          
               
            <div class="modal-body">
                <div id="data-real-container">
               
             
                <table class="table table-bordered"id="myTable">
                    <thead>
                        <tr>
                            <th>Kode</th>
                            <th>realisasi_WP</th>
                            <th>Volume</th>
                            <th>Satuan</th>
                            <th>Price</th>
                            <th>Total Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($item->real()->get() as $pos)
                        <tr >
                            <td>{{ $pos->Kode }}</td>
                            <td>{{ $pos->realisasi_WP }}</td>
                            <td>{{ $pos->volume_Task }}</td>
                            <td>{{ $pos->Satuan }}</td>
                            <td>{{ $pos->UnitPrice }}</td>
                            <td>Rp {{ number_format($pos->Ttl_Price, 0, ',', '.') }}</td>

                            <!-- Tambahkan kolom lainnya sesuai kebutuhan -->
                        </tr>
                        @endforeach
                        
                        <!-- Tambahkan kolom lainnya sesuai dengan kebutuhan -->
                    </tbody>
                </table>
               
              
                <form action="{{ route('tambah-data', $item->Id_Job_SPK) }}" method="POST"id="companydata">
                    @csrf
                    <div class="form-group">
                        <div class="col-md-5">
                        <label for="Kode">Kode</label>
                        <input type="text" class="form-control" id="Kode" name="Kode" required>
                        </div>
                    </div>
                    <br>
                    <div class="form-group">
                        <div>
                            <label for="realisasi_WP">Realisasi WP</label>
                        </div>
                      
                        <div class="row">
                            <div class="col-md-10">
                                <textarea name="realisasi_WP" id="realisasi_WP" cols="70" rows="6" required>

                                </textarea>  
                            </div>
                            
                        <div class="col-md-1">
                         
                           
                                {{-- <button type="submit" class="btn btn-outline-success tombol-simpan" id="simpan-data">Save</button>
                                --}}
                                <input type="submit" value="Submit" id="submit" class="btn btn-outline-success py-0" style="font-size: 0.9em;">
                                <div style="margin-top: 20px;"></div>
                                <button type="button"class="btn btn-outline-warning" id="close-btn" data-bs-dismiss="modal">Close</button>
                            
                        </div>

                        </div>

                   
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="volume_Task">Volume Task</label>
                                <input type="number" class="form-control" id="volume_Task" name="volume_Task" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="Satuan">Satuan</label>
                                <input type="text" class="form-control" id="Satuan" name="Satuan" required>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="UnitPrice">Harga Satuan</label>
                                <input type="text" class="form-control" id="UnitPrice" name="UnitPrice" value="3000" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="Ttl_Price">Total:</label>
                                <input type="text" class="form-control" id="Ttl_Price" name="Ttl_Price" readonly>
                            </div>
                        </div>
                    </div>
                      
                    <!-- Tambahkan input untuk kolom lainnya sesuai dengan kebutuhan -->
                   

              
                </form>
        </div>
    </div>
        
        </div>
    </div>
</div>
