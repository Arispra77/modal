<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.0.20/sweetalert2.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.0.20/sweetalert2.min.js"></script>

<script src="{{ asset('vendor/sweetalert/sweetalert.all.js') }}"></script>
<!-- Bootstrap JavaScript -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<div class="modal fade passwordChangeForm" id="passwordChangeForm{{ $item->Id_Job_SPK }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
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
               
              
                <form action="{{ route('tambah-data', $item->Id_Job_SPK) }}" method="POST" id="data-form">
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
                         
                           <a href="javascript:void(0);" onclick="submit_form()" class="btn btn-primary">save</a>
                                <button type="submit" class="btn btn-outline-success tombol-simpan" id="simpan-data">Save</button>
                               
                                <div style="margin-top: 20px;"></div>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            
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

<script type="text/javascript">
function submit_form(){
    var data = $('#data-form').serialize();
    url = '{{ route('tambah-data', $item->Id_Job_SPK) }}',
   // data//var Kode = modal.find('#Kode').val();
       // data//var Satuan = modal.find('#Satuan').val();
       // var realisasi_WP = modal.find('#realisasi_WP').val();
    $.ajax({
        method : 'POST',
        url : url,
        
        data : {
            Kode : $('#Kode').val(),
            realisasi_WP : $('#realisasi_WP').val(),
            Satuan:$('#satuan').val(),
        },
        success : function(data){
           $('#passwordChangeForm').reload();
            $('#passwordChangeForm').modal('show');
        }
        
    })
}

</script>


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