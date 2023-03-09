@extends('layouts.admin')

@section('css')
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
<link rel="stylesheet" href="//cdn.datatables.net/1.11.4/css/dataTables.bootstrap4.min.css">
@endsection

@section('content')
<script>
  document.title = "Stuffing Virtual - Mpok Siti"
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
      <div class="dropdown me-3 mx-2">
        <a class="btn btn-secondary dropdown-toggle" style="background-color:#104E8B" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          Pilih No PPK
        </a>
    
        <ul class="dropdown-menu">
          @foreach($list as $ppk)
          <li><a class="dropdown-item" href="{{route('admin.organoleptiks', ['id_ppk' => $ppk->id_ppk])}}">{{ $ppk->no_ppk }} - {{ $ppk->nm_trader }}</a></li>
          @endforeach
        </ul>
      </div>
    
      <div class="dropdown">
        <a class="btn btn-secondary dropdown-toggle" style="background-color:#104E8B" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          Pilih Jenis
        </a>
    
        <ul class="dropdown-menu">
          @foreach($list as $ppk)
          <li><a class="dropdown-item" href="{{route('admin.organoleptiks', ['id_ppk' => $ppk->id_ppk])}}">{{ $ppk->no_ppk }} - {{ $ppk->nm_trader }}</a></li>
          @endforeach
        </ul>
      </div>
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
            <h6>Jenis Contoh : </h6>
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
        {{-- <form method="GET" action="{{route('submitOrganoleptik', ['no_ppk' => $header[0]->no_ppk])}}"> --}}
        @if (isset($header))
        <form method="GET" action="{{route('admin.submitOrganoleptik', ['id_ppk' => $header[0]->id_ppk])}}"> 
        @endif

        @if (isset($check))
        <table class="tableizer-table">
        <thead><tr class="tableizer-firstrow"><th class="text-center">Spesifikasi</th><th>&nbsp;</th><th>&nbsp;</th><th>&nbsp;</th><th>&nbsp;</th><th>&nbsp;</th><th>&nbsp;</th><th>&nbsp;</th><th>&nbsp;</th><th>&nbsp;</th><th>&nbsp;</th><th>&nbsp;</th><th>&nbsp;</th><th>&nbsp;</th><th>&nbsp;</th><th>Nilai</th><th>&nbsp;</th><th>&nbsp;</th><th>&nbsp;</th><th>&nbsp;</th><th>&nbsp;</th><th>&nbsp;</th><th>&nbsp;</th><th>&nbsp;</th><th>&nbsp;</th><th>&nbsp;</th></tr></thead><tbody>
         <tr><td>&nbsp;</td><td>&nbsp;</td><td>1</td><td>2</td><td>3</td><td>4</td><td>5</td><td>6</td><td>7</td><td>8</td><td>9</td><td>10</td><td>11</td><td>12</td><td>13</td><td>14</td><td>15</td><td>16</td><td>17</td><td>18</td><td>19</td><td>20</td><td>21</td><td>22</td><td>23</td><td>24</td></tr>
         <tr><td>1 Kenampakan</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
         <tr><td>a Daging dada</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>  </td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
         <tr><td>Bentuk utuh, warna daging susu sangat cerah, bersih, sangat cemerlang, sangat menarik.</td><td>9</td>@for ($i = 1; $i <= 24; $i++)<td><input type="checkbox" name="A9{{$i}}" @if($check[0]->{"A9".$i}) checked @endif></td>@endfor</tr>
         <tr><td>Bentuk utuh, sedikit ada serpihan daging, warna daging putih susu cerah, sedikit sekali warna kekuningan, bersih, cemerlang, menarik,</td><td>7</td>@for ($i = 1; $i <= 24; $i++)<td><input type="checkbox" name="A7{{$i}}" @if($check[0]->{"A7".$i}) checked @endif></td>@endfor</tr>
         <tr><td>Tidak utuh, banyak serpihan daging, warna daging putih susu kusam, banyak warna kekuningan, tidak cemerlang, tidak menarik.</td><td>5</td>@for ($i = 1; $i <= 24; $i++)<td><input type="checkbox" name="A5{{$i}}" @if($check[0]->{"A5".$i}) checked @endif></td>@endfor</tr>
         <tr><td>Tidak utuh, banyak serpihan daging, warna daging sangat kusam, banyak warna kekuningan, tidak cemerlang, berlendir, tidak menarik.</td><td>3</td>@for ($i = 1; $i <= 24; $i++)<td><input type="checkbox" name="A3{{$i}}" @if($check[0]->{"A3".$i}) checked @endif></td>@endfor</tr>
         <tr><td>Tidak utuh, banyak serpihan daging, warna daging sangat kusam, banyak warna kekuningan, lendir tebal, tidak menarik.</td><td>1</td>@for ($i = 1; $i <= 24; $i++)<td><input type="checkbox" name="A1{{$i}}" @if($check[0]->{"A1".$i}) checked @endif></td>@endfor</tr>
         <tr><td>b Daging paha, capit dan kaki</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
         <tr><td>Warna daging kecoklatan sangat cerah, serpihan rata, bersih, sangat cemerlang, sangat menarik.</td><td>9</td>@for ($i = 1; $i <= 24; $i++)<td><input type="checkbox" name="B9{{$i}}" @if($check[0]->{"B9".$i}) checked @endif></td>@endfor</tr>
         <tr><td>Warna daging kecoklatan cerah, serpihan rata, bersih, cemerlang, menarik.</td><td>7</td>@for ($i = 1; $i <= 24; $i++)<td><input type="checkbox" name="B7{{$i}}" @if($check[0]->{"B7".$i}) checked @endif></td>@endfor</tr>
         <tr><td>Warna daging kecoklatan kusam, serpihan tidak rata, sedikit lendir, kurang cemerlang, tidak menarik.</td><td>5</td>@for ($i = 1; $i <= 24; $i++)<td><input type="checkbox" name="B5{{$i}}" @if($check[0]->{"B5".$i}) checked @endif></td>@endfor</tr>
         <tr><td>Warna  daging  kecoklatan  sangat  kusam,  serpihan tidak rata, lendir agak banyak, tidak cemerlang, tidak menarik.</td><td>3</td>@for ($i = 1; $i <= 24; $i++)<td><input type="checkbox" name="B3{{$i}}" @if($check[0]->{"B3".$i}) checked @endif></td>@endfor</tr>
         <tr><td>Warna daging kecoklatan sangat kusam, serpihan tidak rata, lendir tebal, tidak cemerlang, tidak menarik.</td><td>1</td>@for ($i = 1; $i <= 24; $i++)<td><input type="checkbox" name="B1{{$i}}" @if($check[0]->{"B1".$i}) checked @endif></td>@endfor</tr>
        </tbody></table>
        @else
        <table class="tableizer-table">
          <thead><tr class="tableizer-firstrow"><th class="text-center">Spesifikasi</th><th>&nbsp;</th><th>&nbsp;</th><th>&nbsp;</th><th>&nbsp;</th><th>&nbsp;</th><th>&nbsp;</th><th>&nbsp;</th><th>&nbsp;</th><th>&nbsp;</th><th>&nbsp;</th><th>&nbsp;</th><th>&nbsp;</th><th>&nbsp;</th><th>&nbsp;</th><th>Nilai</th><th>&nbsp;</th><th>&nbsp;</th><th>&nbsp;</th><th>&nbsp;</th><th>&nbsp;</th><th>&nbsp;</th><th>&nbsp;</th><th>&nbsp;</th><th>&nbsp;</th><th>&nbsp;</th></tr></thead><tbody>
           <tr><td>&nbsp;</td><td>&nbsp;</td><td>1</td><td>2</td><td>3</td><td>4</td><td>5</td><td>6</td><td>7</td><td>8</td><td>9</td><td>10</td><td>11</td><td>12</td><td>13</td><td>14</td><td>15</td><td>16</td><td>17</td><td>18</td><td>19</td><td>20</td><td>21</td><td>22</td><td>23</td><td>24</td></tr>
           <tr><td>1 Kenampakan</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
           <tr><td>a Daging dada</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>  </td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
           <tr><td>Bentuk utuh, warna daging susu sangat cerah, bersih, sangat cemerlang, sangat menarik.</td><td>9</td>@for ($i = 1; $i <= 24; $i++)<td><input type="checkbox" name="A9{{$i}}"></td>@endfor</tr>
           <tr><td>Bentuk utuh, sedikit ada serpihan daging, warna daging putih susu cerah, sedikit sekali warna kekuningan, bersih, cemerlang, menarik,</td><td>7</td>@for ($i = 1; $i <= 24; $i++)<td><input type="checkbox" name="A7{{$i}}"></td>@endfor</tr>
         <tr><td>Tidak utuh, banyak serpihan daging, warna daging putih susu kusam, banyak warna kekuningan, tidak cemerlang, tidak menarik.</td><td>5</td>@for ($i = 1; $i <= 24; $i++)<td><input type="checkbox" name="A5{{$i}}"></td>@endfor</tr>
         <tr><td>Tidak utuh, banyak serpihan daging, warna daging sangat kusam, banyak warna kekuningan, tidak cemerlang, berlendir, tidak menarik.</td><td>3</td>@for ($i = 1; $i <= 24; $i++)<td><input type="checkbox" name="A3{{$i}}"></td>@endfor</tr>
         <tr><td>Tidak utuh, banyak serpihan daging, warna daging sangat kusam, banyak warna kekuningan, lendir tebal, tidak menarik.</td><td>1</td>@for ($i = 1; $i <= 24; $i++)<td><input type="checkbox" name="A1{{$i}}"></td>@endfor</tr>
         <tr><td>b Daging paha, capit dan kaki</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
         <tr><td>Warna daging kecoklatan sangat cerah, serpihan rata, bersih, sangat cemerlang, sangat menarik.</td><td>9</td>@for ($i = 1; $i <= 24; $i++)<td><input type="checkbox" name="B9{{$i}}"></td>@endfor</tr>
         <tr><td>Warna daging kecoklatan cerah, serpihan rata, bersih, cemerlang, menarik.</td><td>7</td>@for ($i = 1; $i <= 24; $i++)<td><input type="checkbox" name="B7{{$i}}"></td>@endfor</tr>
         <tr><td>Warna daging kecoklatan kusam, serpihan tidak rata, sedikit lendir, kurang cemerlang, tidak menarik.</td><td>5</td>@for ($i = 1; $i <= 24; $i++)<td><input type="checkbox" name="B5{{$i}}"></td>@endfor</tr>
         <tr><td>Warna  daging  kecoklatan  sangat  kusam,  serpihan tidak rata, lendir agak banyak, tidak cemerlang, tidak menarik.</td><td>3</td>@for ($i = 1; $i <= 24; $i++)<td><input type="checkbox" name="B3{{$i}}"></td>@endfor</tr>
         <tr><td>Warna daging kecoklatan sangat kusam, serpihan tidak rata, lendir tebal, tidak cemerlang, tidak menarik.</td><td>1</td>@for ($i = 1; $i <= 24; $i++)<td><input type="checkbox" name="B1{{$i}}"></td>@endfor</tr>
          </tbody></table>
        @endif

        @if (isset($header))
        <div class="text-right"><a class="btn btn-danger mt-4 mr-2" href="{{route('admin.resetOrganoleptik', ['id_ppk' => $header[0]->id_ppk])}}" id="reset-btn">Reset</a><button type="submit" class="btn btn-secondary mt-4" style="background-color:#104E8B">Submit</button></div>
        @else
        <div class="text-right"><button type="button" class="btn btn-danger mt-4 mr-2" data-toggle="modal" data-target="#exampleModal">Reset</button><button type="button" class="btn btn-secondary mt-4" data-toggle="modal" data-target="#exampleModal" style="background-color:#104E8B">Submit</button></div>

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
                Pilih No PPK dan jenis terlebih dahulu!
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>
        @endif
      </form>

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

