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
    <h1 class="h2" style="font-weight:bold; color:#2E2A61;">Edit Form Organoleptik</h1>
    <div class="d-flex">
        <a class="btn btn-secondary" style="background-color:#104E8B" href="/admin/organoleptik/" aria-expanded="false">
          Form Organoleptik
        </a>
    </div>
  </div>
  <div class="d-flex justify-content-center flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
    <div class="card shadow w-100 responsive" style="margin: top 10px;">
      <div class="card-body" style="margin: top 10px;">
        <div class="mt-2 mb-4">
            <h6>Nama Perusahaan : </h6>
            <h6>Tanggal : </h6>
            <h6>No PPK/No Pengajuan : </h6>
            <h6>Jenis Contoh : {{ $jenis }}</h6>
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
         <form method="GET" action="{{route('admin.editSubmitOrganoleptik', ['jenis'=>$jenis])}}"> 
        <table class="tableizer-table">
        <thead><tr class="tableizer-firstrow"><th class="text-center">Spesifikasi</th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th>Nilai</th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th></tr></thead><tbody>
         <tr><td></td><td></td><td>1</td><td>2</td><td>3</td><td>4</td><td>5</td><td>6</td><td>7</td><td>8</td><td>9</td><td>10</td><td>11</td><td>12</td><td>13</td><td>14</td><td>15</td><td>16</td><td>17</td><td>18</td><td>19</td><td>20</td><td>21</td><td>22</td><td>23</td><td>24</td></tr> 
         @for ($table = 1; $table <= 50; $table++)
         @php $parameter_value = "parameter" . $table; @endphp
         @php $nilai_value = "nilai" . $table; @endphp
         <tr><td><input type="text" name="1" size="75" @if(isset($parameter[0]->$parameter_value)) value="{{$parameter[0]->$parameter_value}}" @endif></td><td><input type="text" name="{{ $parameter[0]->$nilai_value }}" @if(isset($parameter[0]->$nilai_value)) value="{{$parameter[0]->$nilai_value}}" @endif size="1" pattern="[1-9]{1}"></td>@for ($i = 1; $i <= 24; $i++)<td></td>@endfor</tr>
         @endfor
        </tbody></table>
        



        <label class="mt-2 mb-4">Petugas Karantina,</label>
        <div class="text-left mt-4">
          <a class="btn btn-danger mt-4 mr-2" href="" id="reset-btn">Reset</a>
          <button type="submit" class="btn btn-secondary mt-4" style="background-color:#104E8B">Save</button>
        </div>
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

