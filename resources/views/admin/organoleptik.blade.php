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
    <div class="dropdown">
      <a class="btn btn-secondary dropdown-toggle" style="background-color:#104E8B" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        Pilih No PPK
      </a>
    
      <ul class="dropdown-menu">
        @foreach($list as $ppk)
        <li><a class="dropdown-item" href="{{route('admin.organoleptiks', ['id_ppk' => $ppk->id_ppk])}}">{{ $ppk->no_ppk }} - {{ $ppk->nm_trader }}</a></li>
        @endforeach
      </ul>
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
         <tr><td>Bentuk utuh, warna daging susu sangat cerah, bersih, sangat cemerlang, sangat menarik.</td><td>9</td><td><input type="checkbox" name="A91" @if($check[0]->A91) checked @endif></td><td><input type="checkbox" name="A92" @if($check[0]->A92) checked @endif></td><td><input type="checkbox" name="A93" @if($check[0]->A93) checked @endif></td><td><input type="checkbox" name="A94" @if($check[0]->A94) checked @endif></td><td><input type="checkbox" name="A95" @if($check[0]->A95) checked @endif></td><td><input type="checkbox" name="A96" @if($check[0]->A96) checked @endif></td><td><input type="checkbox" name="A97" @if($check[0]->A97) checked @endif></td><td><input type="checkbox" name="A98" @if($check[0]->A98) checked @endif></td><td><input type="checkbox" name="A99" @if($check[0]->A99) checked @endif></td><td><input type="checkbox" name="A910" @if($check[0]->A910) checked @endif></td><td><input type="checkbox" name="A911" @if($check[0]->A911) checked @endif></td><td><input type="checkbox" name="A912" @if($check[0]->A912) checked @endif></td><td><input type="checkbox" name="A913" @if($check[0]->A913) checked @endif></td><td><input type="checkbox" name="A914" @if($check[0]->A914) checked @endif></td><td><input type="checkbox" name="A915" @if($check[0]->A915) checked @endif></td><td><input type="checkbox" name="A916" @if($check[0]->A916) checked @endif></td><td><input type="checkbox" name="A917" @if($check[0]->A917) checked @endif></td><td><input type="checkbox" name="A918" @if($check[0]->A918) checked @endif></td><td><input type="checkbox" name="A919" @if($check[0]->A919) checked @endif></td><td><input type="checkbox" name="A920" @if($check[0]->A920) checked @endif></td><td><input type="checkbox" name="A921" @if($check[0]->A921) checked @endif></td><td><input type="checkbox" name="A922" @if($check[0]->A922) checked @endif></td><td><input type="checkbox" name="A923" @if($check[0]->A923) checked @endif></td><td><input type="checkbox" name="A924" @if($check[0]->A924) checked @endif></td></tr>
         <tr><td>Bentuk utuh, sedikit ada serpihan daging, warna daging putih susu cerah, sedikit sekali warna kekuningan, bersih, cemerlang, menarik,</td><td>7</td><td><input type="checkbox" name="A71"></td><td><input type="checkbox" name="A72"></td><td><input type="checkbox" name="A73"></td><td><input type="checkbox" name="A74"></td><td><input type="checkbox" name="A75"></td><td><input type="checkbox" name="A76"></td><td><input type="checkbox" name="A77"></td><td><input type="checkbox" name="A78"></td><td><input type="checkbox" name="A79"></td><td><input type="checkbox" name="A710"></td><td><input type="checkbox" name="A711"></td><td><input type="checkbox" name="A712"></td><td><input type="checkbox" name="A713"></td><td><input type="checkbox" name="A714"></td><td><input type="checkbox" name="A715"></td><td><input type="checkbox" name="A716"></td><td><input type="checkbox" name="A717"></td><td><input type="checkbox" name="A718"></td><td><input type="checkbox" name="A719"></td><td><input type="checkbox" name="A720"></td><td><input type="checkbox" name="A721"></td><td><input type="checkbox" name="A722"></td><td><input type="checkbox" name="A723"></td><td><input type="checkbox" name="A724"></td></tr>
         <tr><td>Tidak utuh, banyak serpihan daging, warna daging putih susu kusam, banyak warna kekuningan, tidak cemerlang, tidak menarik.</td><td>5</td><td><input type="checkbox" name="A51"></td><td><input type="checkbox" name="A52"></td><td><input type="checkbox" name="A53"></td><td><input type="checkbox" name="A54"></td><td><input type="checkbox" name="A55"></td><td><input type="checkbox" name="A56"></td><td><input type="checkbox" name="A57"></td><td><input type="checkbox" name="A58"></td><td><input type="checkbox" name="A59"></td><td><input type="checkbox" name="A510"></td><td><input type="checkbox" name="A511"></td><td><input type="checkbox" name="A512"></td><td><input type="checkbox" name="A513"></td><td><input type="checkbox" name="A514"></td><td><input type="checkbox" name="A515"></td><td><input type="checkbox" name="A516"></td><td><input type="checkbox" name="A517"></td><td><input type="checkbox" name="A518"></td><td><input type="checkbox" name="A519"></td><td><input type="checkbox" name="A520"></td><td><input type="checkbox" name="A521"></td><td><input type="checkbox" name="A522"></td><td><input type="checkbox" name="A523"></td><td><input type="checkbox" name="A524"></td></tr>
         <tr><td>Tidak utuh, banyak serpihan daging, warna daging sangat kusam, banyak warna kekuningan, tidak cemerlang, berlendir, tidak menarik.</td><td>3</td><td><input type="checkbox" name="A31"></td><td><input type="checkbox" name="A32"></td><td><input type="checkbox" name="A33"></td><td><input type="checkbox" name="A34"></td><td><input type="checkbox" name="A35"></td><td><input type="checkbox" name="A36"></td><td><input type="checkbox" name="A37"></td><td><input type="checkbox" name="A38"></td><td><input type="checkbox" name="A39"></td><td><input type="checkbox" name="A310"></td><td><input type="checkbox" name="A311"></td><td><input type="checkbox" name="A312"></td><td><input type="checkbox" name="A313"></td><td><input type="checkbox" name="A314"></td><td><input type="checkbox" name="A315"></td><td><input type="checkbox" name="A316"></td><td><input type="checkbox" name="A317"></td><td><input type="checkbox" name="A318"></td><td><input type="checkbox" name="A319"></td><td><input type="checkbox" name="A320"></td><td><input type="checkbox" name="A321"></td><td><input type="checkbox" name="A322"></td><td><input type="checkbox" name="A323"></td><td><input type="checkbox" name="A324"></td></tr>
         <tr><td>Tidak utuh, banyak serpihan daging, warna daging sangat kusam, banyak warna kekuningan, lendir tebal, tidak menarik.</td><td>1</td><td><input type="checkbox" name="A11"></td><td><input type="checkbox" name="A12"></td><td><input type="checkbox" name="A13"></td><td><input type="checkbox" name="A14"></td><td><input type="checkbox" name="A15"></td><td><input type="checkbox" name="A16"></td><td><input type="checkbox" name="A17"></td><td><input type="checkbox" name="A18"></td><td><input type="checkbox" name="A19"></td><td><input type="checkbox" name="A110"></td><td><input type="checkbox" name="A111"></td><td><input type="checkbox" name="A112"></td><td><input type="checkbox" name="A113"></td><td><input type="checkbox" name="A114"></td><td><input type="checkbox" name="A115"></td><td><input type="checkbox" name="A116"></td><td><input type="checkbox" name="A117"></td><td><input type="checkbox" name="A118"></td><td><input type="checkbox" name="A119"></td><td><input type="checkbox" name="A120"></td><td><input type="checkbox" name="A121"></td><td><input type="checkbox" name="A122"></td><td><input type="checkbox" name="A123"></td><td><input type="checkbox" name="A124"></td></tr>
         <tr><td>b Daging paha, capit dan kaki</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
         <tr><td>Warna daging kecoklatan sangat cerah, serpihan rata, bersih, sangat cemerlang, sangat menarik.</td><td>9</td><td><input type="checkbox" name="B91"></td><td><input type="checkbox" name="B92"></td><td><input type="checkbox" name="B93"></td><td><input type="checkbox" name="B94"></td><td><input type="checkbox" name="B95"></td><td><input type="checkbox" name="B96"></td><td><input type="checkbox" name="B97"></td><td><input type="checkbox" name="B98"></td><td><input type="checkbox" name="B99"></td><td><input type="checkbox" name="B910"></td><td><input type="checkbox" name="B911"></td><td><input type="checkbox" name="B912"></td><td><input type="checkbox" name="B913"></td><td><input type="checkbox" name="B914"></td><td><input type="checkbox" name="B915"></td><td><input type="checkbox" name="B916"></td><td><input type="checkbox" name="B917"></td><td><input type="checkbox" name="B918"></td><td><input type="checkbox" name="B919"></td><td><input type="checkbox" name="B920"></td><td><input type="checkbox" name="B921"></td><td><input type="checkbox" name="B922"></td><td><input type="checkbox" name="B923"></td><td><input type="checkbox" name="B924"></td></tr>
         <tr><td>Warna daging kecoklatan cerah, serpihan rata, bersih, cemerlang, menarik.</td><td>7</td><td><input type="checkbox" name="B71"></td><td><input type="checkbox" name="B72"></td><td><input type="checkbox" name="B73"></td><td><input type="checkbox" name="B74"></td><td><input type="checkbox" name="B75"></td><td><input type="checkbox" name="B76"></td><td><input type="checkbox" name="B77"></td><td><input type="checkbox" name="B78"></td><td><input type="checkbox" name="B79"></td><td><input type="checkbox" name="B710"></td><td><input type="checkbox" name="B711"></td><td><input type="checkbox" name="B712"></td><td><input type="checkbox" name="B713"></td><td><input type="checkbox" name="B714"></td><td><input type="checkbox" name="B715"></td><td><input type="checkbox" name="B716"></td><td><input type="checkbox" name="B717"></td><td><input type="checkbox" name="B718"></td><td><input type="checkbox" name="B719"></td><td><input type="checkbox" name="B720"></td><td><input type="checkbox" name="B721"></td><td><input type="checkbox" name="B722"></td><td><input type="checkbox" name="B723"></td><td><input type="checkbox" name="B724"></td></tr>
         <tr><td>Warna daging kecoklatan kusam, serpihan tidak rata, sedikit lendir, kurang cemerlang, tidak menarik.</td><td>5</td><td><input type="checkbox" name="B51"></td><td><input type="checkbox" name="B52"></td><td><input type="checkbox" name="B53"></td><td><input type="checkbox" name="B54"></td><td><input type="checkbox" name="B55"></td><td><input type="checkbox" name="B56"></td><td><input type="checkbox" name="B57"></td><td><input type="checkbox" name="B58"></td><td><input type="checkbox" name="B59"></td><td><input type="checkbox" name="B510"></td><td><input type="checkbox" name="B511"></td><td><input type="checkbox" name="B512"></td><td><input type="checkbox" name="B513"></td><td><input type="checkbox" name="B514"></td><td><input type="checkbox" name="B515"></td><td><input type="checkbox" name="B516"></td><td><input type="checkbox" name="B517"></td><td><input type="checkbox" name="B518"></td><td><input type="checkbox" name="B519"></td><td><input type="checkbox" name="B520"></td><td><input type="checkbox" name="B521"></td><td><input type="checkbox" name="B522"></td><td><input type="checkbox" name="B523"></td><td><input type="checkbox" name="B524"></td></tr>
         <tr><td>Warna  daging  kecoklatan  sangat  kusam,  serpihan tidak rata, lendir agak banyak, tidak cemerlang, tidak menarik.</td><td>3</td><td><input type="checkbox" name="B31"></td><td><input type="checkbox" name="B32"></td><td><input type="checkbox" name="B33"></td><td><input type="checkbox" name="B34"></td><td><input type="checkbox" name="B35"></td><td><input type="checkbox" name="B36"></td><td><input type="checkbox" name="B37"></td><td><input type="checkbox" name="B38"></td><td><input type="checkbox" name="B39"></td><td><input type="checkbox" name="B310"></td><td><input type="checkbox" name="B311"></td><td><input type="checkbox" name="B312"></td><td><input type="checkbox" name="B313"></td><td><input type="checkbox" name="B314"></td><td><input type="checkbox" name="B315"></td><td><input type="checkbox" name="B316"></td><td><input type="checkbox" name="B317"></td><td><input type="checkbox" name="B318"></td><td><input type="checkbox" name="B319"></td><td><input type="checkbox" name="B320"></td><td><input type="checkbox" name="B321"></td><td><input type="checkbox" name="B322"></td><td><input type="checkbox" name="B323"></td><td><input type="checkbox" name="B324"></td></tr>
         <tr><td>Warna daging kecoklatan sangat kusam, serpihan tidak rata, lendir tebal, tidak cemerlang, tidak menarik.</td><td>1</td><td><input type="checkbox" name="B11"></td><td><input type="checkbox" name="B12"></td><td><input type="checkbox" name="B13"></td><td><input type="checkbox" name="B14"></td><td><input type="checkbox" name="B15"></td><td><input type="checkbox" name="B16"></td><td><input type="checkbox" name="B17"></td><td><input type="checkbox" name="B18"></td><td><input type="checkbox" name="B19"></td><td><input type="checkbox" name="B110"></td><td><input type="checkbox" name="B111"></td><td><input type="checkbox" name="B112"></td><td><input type="checkbox" name="B113"></td><td><input type="checkbox" name="B114"></td><td><input type="checkbox" name="B115"></td><td><input type="checkbox" name="B116"></td><td><input type="checkbox" name="B117"></td><td><input type="checkbox" name="B118"></td><td><input type="checkbox" name="B119"></td><td><input type="checkbox" name="B120"></td><td><input type="checkbox" name="B121"></td><td><input type="checkbox" name="B122"></td><td><input type="checkbox" name="B123"></td><td><input type="checkbox" name="B124"></td></tr>
        </tbody></table>
        @else
        <table class="tableizer-table">
          <thead><tr class="tableizer-firstrow"><th class="text-center">Spesifikasi</th><th>&nbsp;</th><th>&nbsp;</th><th>&nbsp;</th><th>&nbsp;</th><th>&nbsp;</th><th>&nbsp;</th><th>&nbsp;</th><th>&nbsp;</th><th>&nbsp;</th><th>&nbsp;</th><th>&nbsp;</th><th>&nbsp;</th><th>&nbsp;</th><th>&nbsp;</th><th>Nilai</th><th>&nbsp;</th><th>&nbsp;</th><th>&nbsp;</th><th>&nbsp;</th><th>&nbsp;</th><th>&nbsp;</th><th>&nbsp;</th><th>&nbsp;</th><th>&nbsp;</th><th>&nbsp;</th></tr></thead><tbody>
           <tr><td>&nbsp;</td><td>&nbsp;</td><td>1</td><td>2</td><td>3</td><td>4</td><td>5</td><td>6</td><td>7</td><td>8</td><td>9</td><td>10</td><td>11</td><td>12</td><td>13</td><td>14</td><td>15</td><td>16</td><td>17</td><td>18</td><td>19</td><td>20</td><td>21</td><td>22</td><td>23</td><td>24</td></tr>
           <tr><td>1 Kenampakan</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
           <tr><td>a Daging dada</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>  </td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
           <tr><td>Bentuk utuh, warna daging susu sangat cerah, bersih, sangat cemerlang, sangat menarik.</td><td>9</td><td><input type="checkbox" name="A91"></td><td><input type="checkbox" name="A92"></td><td><input type="checkbox" name="A93"></td><td><input type="checkbox" name="A94"></td><td><input type="checkbox" name="A95"></td><td><input type="checkbox" name="A96"></td><td><input type="checkbox" name="A97"></td><td><input type="checkbox" name="A98"></td><td><input type="checkbox" name="A99"></td><td><input type="checkbox" name="A910"></td><td><input type="checkbox" name="A911"></td><td><input type="checkbox" name="A912"></td><td><input type="checkbox" name="A913"></td><td><input type="checkbox" name="A914"></td><td><input type="checkbox" name="A915"></td><td><input type="checkbox" name="A916"></td><td><input type="checkbox" name="A917"></td><td><input type="checkbox" name="A918"></td><td><input type="checkbox" name="A919"></td><td><input type="checkbox" name="A920"></td><td><input type="checkbox" name="A921"></td><td><input type="checkbox" name="A922"></td><td><input type="checkbox" name="A923"></td><td><input type="checkbox" name="A924"></td></tr>
           <tr><td>Bentuk utuh, sedikit ada serpihan daging, warna daging putih susu cerah, sedikit sekali warna kekuningan, bersih, cemerlang, menarik,</td><td>7</td><td><input type="checkbox" name="A71"></td><td><input type="checkbox" name="A72"></td><td><input type="checkbox" name="A73"></td><td><input type="checkbox" name="A74"></td><td><input type="checkbox" name="A75"></td><td><input type="checkbox" name="A76"></td><td><input type="checkbox" name="A77"></td><td><input type="checkbox" name="A78"></td><td><input type="checkbox" name="A79"></td><td><input type="checkbox" name="A710"></td><td><input type="checkbox" name="A711"></td><td><input type="checkbox" name="A712"></td><td><input type="checkbox" name="A713"></td><td><input type="checkbox" name="A714"></td><td><input type="checkbox" name="A715"></td><td><input type="checkbox" name="A716"></td><td><input type="checkbox" name="A717"></td><td><input type="checkbox" name="A718"></td><td><input type="checkbox" name="A719"></td><td><input type="checkbox" name="A720"></td><td><input type="checkbox" name="A721"></td><td><input type="checkbox" name="A722"></td><td><input type="checkbox" name="A723"></td><td><input type="checkbox" name="A724"></td></tr>
         <tr><td>Tidak utuh, banyak serpihan daging, warna daging putih susu kusam, banyak warna kekuningan, tidak cemerlang, tidak menarik.</td><td>5</td><td><input type="checkbox" name="A51"></td><td><input type="checkbox" name="A52"></td><td><input type="checkbox" name="A53"></td><td><input type="checkbox" name="A54"></td><td><input type="checkbox" name="A55"></td><td><input type="checkbox" name="A56"></td><td><input type="checkbox" name="A57"></td><td><input type="checkbox" name="A58"></td><td><input type="checkbox" name="A59"></td><td><input type="checkbox" name="A510"></td><td><input type="checkbox" name="A511"></td><td><input type="checkbox" name="A512"></td><td><input type="checkbox" name="A513"></td><td><input type="checkbox" name="A514"></td><td><input type="checkbox" name="A515"></td><td><input type="checkbox" name="A516"></td><td><input type="checkbox" name="A517"></td><td><input type="checkbox" name="A518"></td><td><input type="checkbox" name="A519"></td><td><input type="checkbox" name="A520"></td><td><input type="checkbox" name="A521"></td><td><input type="checkbox" name="A522"></td><td><input type="checkbox" name="A523"></td><td><input type="checkbox" name="A524"></td></tr>
         <tr><td>Tidak utuh, banyak serpihan daging, warna daging sangat kusam, banyak warna kekuningan, tidak cemerlang, berlendir, tidak menarik.</td><td>3</td><td><input type="checkbox" name="A31"></td><td><input type="checkbox" name="A32"></td><td><input type="checkbox" name="A33"></td><td><input type="checkbox" name="A34"></td><td><input type="checkbox" name="A35"></td><td><input type="checkbox" name="A36"></td><td><input type="checkbox" name="A37"></td><td><input type="checkbox" name="A38"></td><td><input type="checkbox" name="A39"></td><td><input type="checkbox" name="A310"></td><td><input type="checkbox" name="A311"></td><td><input type="checkbox" name="A312"></td><td><input type="checkbox" name="A313"></td><td><input type="checkbox" name="A314"></td><td><input type="checkbox" name="A315"></td><td><input type="checkbox" name="A316"></td><td><input type="checkbox" name="A317"></td><td><input type="checkbox" name="A318"></td><td><input type="checkbox" name="A319"></td><td><input type="checkbox" name="A320"></td><td><input type="checkbox" name="A321"></td><td><input type="checkbox" name="A322"></td><td><input type="checkbox" name="A323"></td><td><input type="checkbox" name="A324"></td></tr>
         <tr><td>Tidak utuh, banyak serpihan daging, warna daging sangat kusam, banyak warna kekuningan, lendir tebal, tidak menarik.</td><td>1</td><td><input type="checkbox" name="A11"></td><td><input type="checkbox" name="A12"></td><td><input type="checkbox" name="A13"></td><td><input type="checkbox" name="A14"></td><td><input type="checkbox" name="A15"></td><td><input type="checkbox" name="A16"></td><td><input type="checkbox" name="A17"></td><td><input type="checkbox" name="A18"></td><td><input type="checkbox" name="A19"></td><td><input type="checkbox" name="A110"></td><td><input type="checkbox" name="A111"></td><td><input type="checkbox" name="A112"></td><td><input type="checkbox" name="A113"></td><td><input type="checkbox" name="A114"></td><td><input type="checkbox" name="A115"></td><td><input type="checkbox" name="A116"></td><td><input type="checkbox" name="A117"></td><td><input type="checkbox" name="A118"></td><td><input type="checkbox" name="A119"></td><td><input type="checkbox" name="A120"></td><td><input type="checkbox" name="A121"></td><td><input type="checkbox" name="A122"></td><td><input type="checkbox" name="A123"></td><td><input type="checkbox" name="A124"></td></tr>
         <tr><td>b Daging paha, capit dan kaki</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
         <tr><td>Warna daging kecoklatan sangat cerah, serpihan rata, bersih, sangat cemerlang, sangat menarik.</td><td>9</td><td><input type="checkbox" name="B91"></td><td><input type="checkbox" name="B92"></td><td><input type="checkbox" name="B93"></td><td><input type="checkbox" name="B94"></td><td><input type="checkbox" name="B95"></td><td><input type="checkbox" name="B96"></td><td><input type="checkbox" name="B97"></td><td><input type="checkbox" name="B98"></td><td><input type="checkbox" name="B99"></td><td><input type="checkbox" name="B910"></td><td><input type="checkbox" name="B911"></td><td><input type="checkbox" name="B912"></td><td><input type="checkbox" name="B913"></td><td><input type="checkbox" name="B914"></td><td><input type="checkbox" name="B915"></td><td><input type="checkbox" name="B916"></td><td><input type="checkbox" name="B917"></td><td><input type="checkbox" name="B918"></td><td><input type="checkbox" name="B919"></td><td><input type="checkbox" name="B920"></td><td><input type="checkbox" name="B921"></td><td><input type="checkbox" name="B922"></td><td><input type="checkbox" name="B923"></td><td><input type="checkbox" name="B924"></td></tr>
         <tr><td>Warna daging kecoklatan cerah, serpihan rata, bersih, cemerlang, menarik.</td><td>7</td><td><input type="checkbox" name="B71"></td><td><input type="checkbox" name="B72"></td><td><input type="checkbox" name="B73"></td><td><input type="checkbox" name="B74"></td><td><input type="checkbox" name="B75"></td><td><input type="checkbox" name="B76"></td><td><input type="checkbox" name="B77"></td><td><input type="checkbox" name="B78"></td><td><input type="checkbox" name="B79"></td><td><input type="checkbox" name="B710"></td><td><input type="checkbox" name="B711"></td><td><input type="checkbox" name="B712"></td><td><input type="checkbox" name="B713"></td><td><input type="checkbox" name="B714"></td><td><input type="checkbox" name="B715"></td><td><input type="checkbox" name="B716"></td><td><input type="checkbox" name="B717"></td><td><input type="checkbox" name="B718"></td><td><input type="checkbox" name="B719"></td><td><input type="checkbox" name="B720"></td><td><input type="checkbox" name="B721"></td><td><input type="checkbox" name="B722"></td><td><input type="checkbox" name="B723"></td><td><input type="checkbox" name="B724"></td></tr>
         <tr><td>Warna daging kecoklatan kusam, serpihan tidak rata, sedikit lendir, kurang cemerlang, tidak menarik.</td><td>5</td><td><input type="checkbox" name="B51"></td><td><input type="checkbox" name="B52"></td><td><input type="checkbox" name="B53"></td><td><input type="checkbox" name="B54"></td><td><input type="checkbox" name="B55"></td><td><input type="checkbox" name="B56"></td><td><input type="checkbox" name="B57"></td><td><input type="checkbox" name="B58"></td><td><input type="checkbox" name="B59"></td><td><input type="checkbox" name="B510"></td><td><input type="checkbox" name="B511"></td><td><input type="checkbox" name="B512"></td><td><input type="checkbox" name="B513"></td><td><input type="checkbox" name="B514"></td><td><input type="checkbox" name="B515"></td><td><input type="checkbox" name="B516"></td><td><input type="checkbox" name="B517"></td><td><input type="checkbox" name="B518"></td><td><input type="checkbox" name="B519"></td><td><input type="checkbox" name="B520"></td><td><input type="checkbox" name="B521"></td><td><input type="checkbox" name="B522"></td><td><input type="checkbox" name="B523"></td><td><input type="checkbox" name="B524"></td></tr>
         <tr><td>Warna  daging  kecoklatan  sangat  kusam,  serpihan tidak rata, lendir agak banyak, tidak cemerlang, tidak menarik.</td><td>3</td><td><input type="checkbox" name="B31"></td><td><input type="checkbox" name="B32"></td><td><input type="checkbox" name="B33"></td><td><input type="checkbox" name="B34"></td><td><input type="checkbox" name="B35"></td><td><input type="checkbox" name="B36"></td><td><input type="checkbox" name="B37"></td><td><input type="checkbox" name="B38"></td><td><input type="checkbox" name="B39"></td><td><input type="checkbox" name="B310"></td><td><input type="checkbox" name="B311"></td><td><input type="checkbox" name="B312"></td><td><input type="checkbox" name="B313"></td><td><input type="checkbox" name="B314"></td><td><input type="checkbox" name="B315"></td><td><input type="checkbox" name="B316"></td><td><input type="checkbox" name="B317"></td><td><input type="checkbox" name="B318"></td><td><input type="checkbox" name="B319"></td><td><input type="checkbox" name="B320"></td><td><input type="checkbox" name="B321"></td><td><input type="checkbox" name="B322"></td><td><input type="checkbox" name="B323"></td><td><input type="checkbox" name="B324"></td></tr>
         <tr><td>Warna daging kecoklatan sangat kusam, serpihan tidak rata, lendir tebal, tidak cemerlang, tidak menarik.</td><td>1</td><td><input type="checkbox" name="B11"></td><td><input type="checkbox" name="B12"></td><td><input type="checkbox" name="B13"></td><td><input type="checkbox" name="B14"></td><td><input type="checkbox" name="B15"></td><td><input type="checkbox" name="B16"></td><td><input type="checkbox" name="B17"></td><td><input type="checkbox" name="B18"></td><td><input type="checkbox" name="B19"></td><td><input type="checkbox" name="B110"></td><td><input type="checkbox" name="B111"></td><td><input type="checkbox" name="B112"></td><td><input type="checkbox" name="B113"></td><td><input type="checkbox" name="B114"></td><td><input type="checkbox" name="B115"></td><td><input type="checkbox" name="B116"></td><td><input type="checkbox" name="B117"></td><td><input type="checkbox" name="B118"></td><td><input type="checkbox" name="B119"></td><td><input type="checkbox" name="B120"></td><td><input type="checkbox" name="B121"></td><td><input type="checkbox" name="B122"></td><td><input type="checkbox" name="B123"></td><td><input type="checkbox" name="B124"></td></tr>
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
                Pilih No PPK terlebih dahulu!
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