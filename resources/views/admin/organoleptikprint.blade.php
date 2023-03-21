<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Print Organoleptik</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  </head>
  <body>
    
    <div class="d-flex justify-content-center flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
    <div class="card shadow w-100 responsive" style="margin: top 10px;">
      <div class="card-body" style="margin: top 10px;">
        <div class="mt-2 mb-4">
            <h5 class="text-center mt-4">BALAI BESAR KARANTINA IKAN PENGENDALIAN MUTU DAN KEAMANAN HASIL PERIKANAN JAKARTA I</h5>
            <h6 class="text-center mb-4">LEMBAR PENILAIAN SENSORI {{ $jenis }} DALAM RANGKA VERIFIKASI LAPANGAN MELALUI REMOTE STUFFING</h6>

            <h6 class="mt-4">Nama Perusahaan : {{ $header[0]->nm_trader }} </h6>
            <h6>Tanggal : {{ $header[0]->tgl_ppk }}</h6>
            <h6>No PPK/No Pengajuan : {{ $header[0]->no_ppk }}</h6>
            <h6>Jenis Contoh : @if(isset($jenis)){{ $jenis }}@endif</h6>
        </div>
        <style type="text/css">
            @media print {
                @page {
                    size: landscape;
                }
            }

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
                color: black;
            }
        </style>
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
        <p class="mt-2 pb-4">Petugas Karantina,</p>
        <p class="mt-4">{{ $check1[0]->petugas }}</p>
      </form>

      
      


      </div>
    </div>
  </div>
  <script type="text/javascript">
    window.print();
  </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  </body>
</html>