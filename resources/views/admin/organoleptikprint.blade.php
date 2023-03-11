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
            @if($jenis=='Daging Rajungan Pasteu')
            <h5 class="text-center mt-4">BALAI BESAR KARANTINA IKAN PENGENDALIAN MUTU DAN KEAMANAN HASIL PERIKANAN JAKARTA I</h5>
            <h6 class="text-center mb-4">LEMBAR PENILAIAN SENSORI DAGING RAJUNGAN DALAM RANGKA VERIFIKASI LAPANGAN MELALUI REMOTE STUFFING</h6>
            @else

            @endif
          @if (isset($header))
            <h6 class="mt-4">Nama Perusahaan : {{ $header[0]->nm_trader }} </h6>
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
        @if($jenis=='Daging Rajungan Pasteu')
        <table class="tableizer-table">
        <thead><tr class="tableizer-firstrow"><th class="text-center">Spesifikasi</th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th>Nilai</th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th></tr></thead><tbody>
         <tr><td></td><td></td><td>1</td><td>2</td><td>3</td><td>4</td><td>5</td><td>6</td><td>7</td><td>8</td><td>9</td><td>10</td><td>11</td><td>12</td><td>13</td><td>14</td><td>15</td><td>16</td><td>17</td><td>18</td><td>19</td><td>20</td><td>21</td><td>22</td><td>23</td><td>24</td></tr>
         <tr><td>1 Kenampakan</td>@for ($i = 1; $i <= 25; $i++)<td></td>@endfor</tr>
         <tr><td>a Daging dada</td>@for ($i = 1; $i <= 25; $i++)<td></td>@endfor</tr>
         <tr><td>Bentuk utuh, warna daging susu sangat cerah, bersih, sangat cemerlang, sangat menarik.</td><td>9</td>@for ($i = 1; $i <= 24; $i++)<td><input type="checkbox" name="A9{{$i}}" @if (isset($check)) @if($check[0]->{"A9".$i}) checked @endif @endif></td>@endfor</tr>
         <tr><td>Bentuk utuh, sedikit ada serpihan daging, warna daging putih susu cerah, sedikit sekali warna kekuningan, bersih, cemerlang, menarik,</td><td>7</td>@for ($i = 1; $i <= 24; $i++)<td><input type="checkbox" name="A7{{$i}}" @if (isset($check)) @if($check[0]->{"A7".$i}) checked @endif @endif></td>@endfor</tr>
         <tr><td>Tidak utuh, banyak serpihan daging, warna daging putih susu kusam, banyak warna kekuningan, tidak cemerlang, tidak menarik.</td><td>5</td>@for ($i = 1; $i <= 24; $i++)<td><input type="checkbox" name="A5{{$i}}" @if (isset($check)) @if($check[0]->{"A5".$i}) checked @endif @endif></td>@endfor</tr>
         <tr><td>Tidak utuh, banyak serpihan daging, warna daging sangat kusam, banyak warna kekuningan, tidak cemerlang, berlendir, tidak menarik.</td><td>3</td>@for ($i = 1; $i <= 24; $i++)<td><input type="checkbox" name="A3{{$i}}" @if (isset($check)) @if($check[0]->{"A3".$i}) checked @endif @endif></td>@endfor</tr>
         <tr><td>Tidak utuh, banyak serpihan daging, warna daging sangat kusam, banyak warna kekuningan, lendir tebal, tidak menarik.</td><td>1</td>@for ($i = 1; $i <= 24; $i++)<td><input type="checkbox" name="A1{{$i}}" @if (isset($check)) @if($check[0]->{"A1".$i}) checked @endif @endif></td>@endfor</tr>
         <tr><td>b Daging paha, capit dan kaki</td>@for ($i = 1; $i <= 25; $i++)<td></td>@endfor</tr>
         <tr><td>Warna daging kecoklatan sangat cerah, serpihan rata, bersih, sangat cemerlang, sangat menarik.</td><td>9</td>@for ($i = 1; $i <= 24; $i++)<td><input type="checkbox" name="B9{{$i}}" @if (isset($check)) @if($check[0]->{"B9".$i}) checked @endif @endif></td>@endfor</tr>
         <tr><td>Warna daging kecoklatan cerah, serpihan rata, bersih, cemerlang, menarik.</td><td>7</td>@for ($i = 1; $i <= 24; $i++)<td><input type="checkbox" name="B7{{$i}}" @if (isset($check)) @if($check[0]->{"B7".$i}) checked @endif @endif></td>@endfor</tr>
         <tr><td>Warna daging kecoklatan kusam, serpihan tidak rata, sedikit lendir, kurang cemerlang, tidak menarik.</td><td>5</td>@for ($i = 1; $i <= 24; $i++)<td><input type="checkbox" name="B5{{$i}}" @if (isset($check)) @if($check[0]->{"B5".$i}) checked @endif @endif></td>@endfor</tr>
         <tr><td>Warna  daging  kecoklatan  sangat  kusam,  serpihan tidak rata, lendir agak banyak, tidak cemerlang, tidak menarik.</td><td>3</td>@for ($i = 1; $i <= 24; $i++)<td><input type="checkbox" name="B3{{$i}}" @if (isset($check)) @if($check[0]->{"B3".$i}) checked @endif @endif></td>@endfor</tr>
         <tr><td>Warna daging kecoklatan sangat kusam, serpihan tidak rata, lendir tebal, tidak cemerlang, tidak menarik.</td><td>1</td>@for ($i = 1; $i <= 24; $i++)<td><input type="checkbox" name="B1{{$i}}" @if (isset($check)) @if($check[0]->{"B1".$i}) checked @endif @endif></td>@endfor</tr>
        </tbody></table>

        @elseif($jenis=='Daging Kerang Beku')
        <table class="tableizer-table">
          <thead><tr class="tableizer-firstrow"><th class="text-center">Spesifikasi</th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th>Nilai</th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th></tr></thead><tbody>
           <tr><td></td><td></td><td>1</td><td>2</td><td>3</td><td>4</td><td>5</td><td>6</td><td>7</td><td>8</td><td>9</td><td>10</td><td>11</td><td>12</td><td>13</td><td>14</td><td>15</td><td>16</td><td>17</td><td>18</td><td>19</td><td>20</td><td>21</td><td>22</td><td>23</td><td>24</td></tr>
           <tr><td>A. Dalam Keadaan Beku</td>@for ($i = 1; $i <= 25; $i++)<td></td>@endfor</tr>
           <tr><td>1. Lapisan es</td>@for ($i = 1; $i <= 25; $i++)<td></td>@endfor</tr>
           <tr><td>Rata, bening, cukup tebal pada seluruh permukaan dilapisi es.</td><td>9</td>@for ($i = 1; $i <= 24; $i++)<td><input type="checkbox" name="A9{{$i}}" @if (isset($check)) @if($check[0]->{"A9".$i}) checked @endif @endif></td>@endfor</tr>
           <tr><td>Rata, bening, cukup tebal ada bagian yang terbuka 10%</td><td>9</td>@for ($i = 1; $i <= 24; $i++)<td><input type="checkbox" name="A8{{$i}}" @if (isset($check)) @if($check[0]->{"A8".$i}) checked @endif @endif></td>@endfor</tr>
           <tr><td>Tidak rata, bagian yang terbuka, sebanyak 20%-30%.</td><td>7</td>@for ($i = 1; $i <= 24; $i++)<td><input type="checkbox" name="A7{{$i}}" @if (isset($check)) @if($check[0]->{"A7".$i}) checked @endif @endif></td>@endfor</tr>
           <tr><td>Tidak rata, bagian yang terbuka, sebanyak 40%-50%.</td><td>9</td>@for ($i = 1; $i <= 24; $i++)<td><input type="checkbox" name="A6{{$i}}" @if (isset($check)) @if($check[0]->{"A6".$i}) checked @endif @endif></td>@endfor</tr>
           <tr><td>Banyak bagian yang terbuka 60%-70%.</td><td>5</td>@for ($i = 1; $i <= 24; $i++)<td><input type="checkbox" name="A5{{$i}}" @if (isset($check)) @if($check[0]->{"A5".$i}) checked @endif @endif></td>@endfor</tr>
           <tr><td>Banyak bagian yang terbuka 80%-90%.</td><td>3</td>@for ($i = 1; $i <= 24; $i++)<td><input type="checkbox" name="A3{{$i}}" @if (isset($check)) @if($check[0]->{"A3".$i}) checked @endif @endif></td>@endfor</tr>
           <tr><td>Tidak terdapat lapisan es pada permukaan produk.</td><td>1</td>@for ($i = 1; $i <= 24; $i++)<td><input type="checkbox" name="A1{{$i}}" @if (isset($check)) @if($check[0]->{"A1".$i}) checked @endif @endif></td>@endfor</tr>
           <tr><td>2. Pengeringan (dehidrasi)</td>@for ($i = 1; $i <= 25; $i++)<td></td>@endfor</tr>
           <tr><td>Tidak ada pengeringan pada  permukaan produk</td><td>9</td>@for ($i = 1; $i <= 24; $i++)<td><input type="checkbox" name="B9{{$i}}" @if (isset($check)) @if($check[0]->{"B9".$i}) checked @endif @endif></td>@endfor</tr>
           <tr><td>Sedikit mengalami pengeringan pada permukaan produk 10%.</td><td>9</td>@for ($i = 1; $i <= 24; $i++)<td><input type="checkbox" name="B8{{$i}}" @if (isset($check)) @if($check[0]->{"B8".$i}) checked @endif @endif></td>@endfor</tr>
           <tr><td>Pengeringan mulai jelas pada permukaan produk 20%-30%.</td><td>7</td>@for ($i = 1; $i <= 24; $i++)<td><input type="checkbox" name="B7{{$i}}" @if (isset($check)) @if($check[0]->{"B7".$i}) checked @endif @endif></td>@endfor</tr>
           <tr><td>Pengeringan banyak pada permukaan produk 40%-50%.</td><td>9</td>@for ($i = 1; $i <= 24; $i++)<td><input type="checkbox" name="B6{{$i}}" @if (isset($check)) @if($check[0]->{"B6".$i}) checked @endif @endif></td>@endfor</tr>
           <tr><td>Banyak bagian produk yang tampak mengering 60%-70%. </td><td>5</td>@for ($i = 1; $i <= 24; $i++)<td><input type="checkbox" name="B5{{$i}}" @if (isset($check)) @if($check[0]->{"B5".$i}) checked @endif @endif></td>@endfor</tr>
           <tr><td>Banyak bagian produk yang tampak mengering 80%-90%.</td><td>3</td>@for ($i = 1; $i <= 24; $i++)<td><input type="checkbox" name="B3{{$i}}" @if (isset($check)) @if($check[0]->{"B3".$i}) checked @endif @endif></td>@endfor</tr>
           <tr><td>Seluruh bagian luar produk tampak mengering</td><td>1</td>@for ($i = 1; $i <= 24; $i++)<td><input type="checkbox" name="B1{{$i}}" @if (isset($check)) @if($check[0]->{"B1".$i}) checked @endif @endif></td>@endfor</tr>
           <tr><td>3. Perubahan warna (diskolorasi) </td>@for ($i = 1; $i <= 25; $i++)<td></td>@endfor</tr>
           <tr><td>Belum mengalami perubahan warna pada permukaan produk. </td><td>9</td>@for ($i = 1; $i <= 24; $i++)<td><input type="checkbox" name="C9{{$i}}" @if (isset($check)) @if($check[0]->{"C9".$i}) checked @endif @endif></td>@endfor</tr>
           <tr><td>Sedikit mengalami perubahan warna pada permukaan produk 10%.</td><td>9</td>@for ($i = 1; $i <= 24; $i++)<td><input type="checkbox" name="C8{{$i}}" @if (isset($check)) @if($check[0]->{"C8".$i}) checked @endif @endif></td>@endfor</tr>
           <tr><td>Agak banyak mengalami perubahan warna pada permukaan produk 20%-30%.</td><td>7</td>@for ($i = 1; $i <= 24; $i++)<td><input type="checkbox" name="C7{{$i}}" @if (isset($check)) @if($check[0]->{"C7".$i}) checked @endif @endif></td>@endfor</tr>
           <tr><td>Banyak mengalami perubahan warna pada permukaan produk 40%-50%. </td><td>9</td>@for ($i = 1; $i <= 24; $i++)<td><input type="checkbox" name="C6{{$i}}" @if (isset($check)) @if($check[0]->{"C6".$i}) checked @endif @endif></td>@endfor</tr>
           <tr><td>Perubahan warna hampir menyeluruh pada permukaan produk 60%-70%.</td><td>5</td>@for ($i = 1; $i <= 24; $i++)<td><input type="checkbox" name="C5{{$i}}" @if (isset($check)) @if($check[0]->{"C5".$i}) checked @endif @endif></td>@endfor</tr>
           <tr><td>Perubahan warna hampir menyeluruh pada permukaan produk 80%-90%.</td><td>3</td>@for ($i = 1; $i <= 24; $i++)<td><input type="checkbox" name="C3{{$i}}" @if (isset($check)) @if($check[0]->{"C3".$i}) checked @endif @endif></td>@endfor</tr>
           <tr><td>Perubahan warna menyeluruh pada permukaan produk</td><td>1</td>@for ($i = 1; $i <= 24; $i++)<td><input type="checkbox" name="C1{{$i}}" @if (isset($check)) @if($check[0]->{"C1".$i}) checked @endif @endif></td>@endfor</tr>
           
          </tbody></table>


        @endif
        <p class="mt-2 pb-4">Petugas Karantina,</p>
        <p class="mt-4">{{ $check[0]->petugas }}</p>
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