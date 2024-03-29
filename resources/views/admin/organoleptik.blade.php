@extends('layouts.admin')

@section('css')
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
<link rel="stylesheet" href="//cdn.datatables.net/1.11.4/css/dataTables.bootstrap4.min.css">
@endsection

@section('content')
<script>
  document.title = "Organoleptik - Mpok Siti"
</script>
@if(session()->has('berhasilSimpan'))
    <script>
        alert('{{ session('berhasilSimpan') }}');
    </script>
@endif

<main class="col-md-9 ms-sm-auto col-lg-12 px-md-4">
  <div class="chartjs-size-monitor">
    <div class="chartjs-size-monitor-expand">
      <div class=""></div>
    </div>
    <div class="chartjs-size-monitor-shrink">
      <div class=""></div>
    </div>
  </div>
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2" style="font-weight:bold; color:#2E2A61;">Form Organoleptik</h1>
    
    <div class="d-flex">
      <div class="dropdown me-3">
        <a class="btn btn-secondary dropdown-toggle" style="background-color:#104E8B" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          Pilih No PPK
        </a>
    
        <ul class="dropdown-menu">
          @if(!isset($jenis))
            @foreach($list as $ppk)
            <li><a class="dropdown-item" href="{{route('admin.organoleptiks', ['id_ppk' => $ppk->id_ppk])}}">{{ $ppk->no_ppk }} - {{ $ppk->nm_trader }}</a></li>
            @endforeach
          @else
            @foreach($list as $ppk)
            <li><a class="dropdown-item" href="{{route('admin.NilaiOrganoleptik', ['id_ppk' => $ppk->id_ppk,'jenis'=>$jenis])}}">{{ $ppk->no_ppk }} - {{ $ppk->nm_trader }}</a></li>
            @endforeach
          @endif
        </ul>
      </div>

      @if (isset($header))
      <div class="dropdown">
        <a class="btn btn-secondary dropdown-toggle mx-2" style="background-color:#104E8B" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          Pilih Jenis
        </a>  
        <ul class="dropdown-menu">
          @if(isset($jenisform))
            @foreach($jenisform as $jnsform)
            <li><a class="dropdown-item" href="{{route('admin.NilaiOrganoleptik', ['id_ppk' => $id_ppk,'jenis'=>$jnsform->jenis])}}">{{ $jnsform->jenis }}</a></li>
            @endforeach
          @endif
        </ul>
      </div>
      @else
      <div class="dropdown">
        <button type="button" class="btn btn-secondary dropdown-toggle mx-2" style="background-color:#104E8B" data-toggle="modal" data-target="#exampleModal">Pilih Jenis</button>
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Peringatan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                Pilih No PPK terlebih dahulu!
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>

      </div>
      @endif


      @php
          $role = session('role');
      @endphp

                  

      @if ($role === 'Admin')
        <div class="dropdown">
          <a class="btn btn-secondary dropdown-toggle" style="background-color:#104E8B" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Edit Form
          </a>  
          <ul class="dropdown-menu">
            @if(isset($jenisform))
              @foreach($jenisform as $jnsform)
              <li><a class="dropdown-item" href="{{route('admin.editOrganoleptik', ['jenis'=>$jnsform->jenis])}}">{{ $jnsform->jenis }}</a></li>
              @endforeach
            @endif
            <li><a class="dropdown-item" href="{{route('admin.editOrganoleptik', ['jenis'=>'baru'])}}">Tambah Jenis Baru</a></li>
          </ul>
        </div>
      @else
        <a class="btn btn-secondary dropdown-toggle" style="background-color:#104E8B" role="button" aria-expanded="false" onclick="alert('Anda tidak memiliki izin untuk mengelola form penilaian organoleptik.');">
          Edit Form
        </a>  
      @endif


      

    </div>
    

    
  </div>
  <div class="d-flex justify-content-center flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
    <div class="card shadow w-100 responsive" style="margin: top 10px;">
      <div class="card-body" style="margin: top 10px;">
        <div class="mt-2 mb-4">
          @if (isset($header))
            <h6>Nama Perusahaan : {{ $header[0]->nm_trader }} </h6>
            <h6>Tanggal : {{ $header[0]->tgl_ppk }}</h6>
            <h6>No PPK/No Pengajuan : {{ $header[0]->no_ppk }}</h6>
            <h6>Jenis Contoh : @if(isset($jenis)){{ $jenis }}@endif</h6>
          @else
            <h6>Nama Perusahaan : </h6>
            <h6>Tanggal : </h6>
            <h6>No PPK/No Pengajuan : </h6>
            <h6>Jenis Contoh : </h6>
          @endif
        </div>
        
        <style type="text/css">
            table.tableizer-table {
                font-size: 12px;
                border: 1px solid #CCC; 
                font-family: Arial, Helvetica, sans-serif;
            } 
            .tableizer-table td {
                padding: 4px;
                margin: 3px;
                border: 1px solid #CCC;
            }
            .tableizer-table th {
                background-color: #104E8B; 
                color: #FFF;
                font-weight: bold;
            }
        </style>
        @if(isset($jenis))
        <form method="GET" action="{{route('admin.submitOrganoleptik', ['id_ppk' => $header[0]->id_ppk,'jenis'=>$jenis])}}"> 
          <table class="tableizer-table">
            <thead><tr class="tableizer-firstrow"><th class="text-center">Spesifikasi</th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th>Nilai</th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th></tr></thead><tbody>
             <tr><td></td><td></td><td>1</td><td>2</td><td>3</td><td>4</td><td>5</td><td>6</td><td>7</td><td>8</td><td>9</td><td>10</td><td>11</td><td>12</td><td>13</td><td>14</td><td>15</td><td>16</td><td>17</td><td>18</td><td>19</td><td>20</td><td>21</td><td>22</td><td>23</td><td>24</td></tr>
             @for ($table = 1; $table <= $jumlah; $table++)
             @php $parameter_value = "parameter" . $table; @endphp
             @php $nilai_value = "nilai" . $table; @endphp
             <tr>
              <td>{{ $parameter[0]->$parameter_value }}</td>
              <td>{{ $parameter[0]->$nilai_value }}</td>
              @if (isset($parameter[0]->$nilai_value))
                @for ($i = 1; $i <= 24; $i++)<td>
                  <input type="checkbox" name="a{{$table}}x{{$i}}"
                  @if ($table<=30)
                    @if (isset($check1))
                      @if($check1[0]->{"a".$table."x".$i}) checked @endif
                    @endif
                  @else
                    @if(isset($check2)) 
                      @if($check2[0]->{"a".$table."x".$i}) checked @endif
                    @endif
                  @endif
                  ></td>
                @endfor
              @else
                @for ($i = 1; $i <= 24; $i++)<td></td>@endfor
              @endif</tr>
            @endfor
            </tbody></table>
        <label class="mt-2">Petugas Karantina,</label>
        <input type="text" name="petugas" @if(isset($check1))value="{{$check1[0]->petugas}}" @endif required>
        <div class="text-left">
          <a class="btn btn-danger mt-4 mr-2" href="{{route('admin.resetOrganoleptik', ['id_ppk' => $header[0]->id_ppk,'jenis'=>$jenis])}}" id="reset-btn">Reset</a>
          <button type="submit" class="btn btn-secondary mt-4" style="background-color:#104E8B">Save</button>
          <a class="btn btn-secondary mt-4 ml-2" href="{{route('admin.printOrganoleptik', ['id_ppk' => $header[0]->id_ppk,'jenis'=>$jenis])}}">Print</a>
        </div>
      </form>

      
      @endif
      


      </div>
    </div>
  </div>
</main>
<script>
  document.getElementById("reset-btn").addEventListener("click", function(event){
      event.preventDefault(); // untuk mencegah redirect langsung saat klik link
      if(confirm("Apakah Anda yakin ingin mereset tabel ini?")){
          window.location.href = this.href; // redirect ke halaman reset jika dikonfirmasi
      }
  });
</script>

@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="//code.jquery.com/jquery-3.5.1.js"></script>
<script src="//cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
<script src="//cdn.datatables.net/1.11.4/js/dataTables.bootstrap4.min.js"></script>
<script src="//cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap4.min.js"></script>
<script>
  $(document).ready(function() {
    $('#tablePpk').DataTable({
      responsive: true,
    });

  });
</script>
@endpush