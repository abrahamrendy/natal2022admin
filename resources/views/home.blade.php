@extends('adminlte::page')

@section('title', 'Dashboard')

@section('plugins.Datatables', true)

@section('plugins.DatatablesPlugins', true)

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <!-- CONTENT -->
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                @if($message = Session::get('success'))
                    <div class="alert alert-info alert-dismissible" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                      </button>
                      <strong>Success!</strong> {{ $message }}
                    </div>
                @endif
                <table id="example1" class=" table table-bordered table-striped dataTable dtr-inline" role="grid" aria-describedby="example1_info">
                  <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>E-mail</th>
                        <th>No. HP</th>
                        <th>Tanggal Lahir</th>
                        <th>Ibadah</th>
                        <th>QR Code</th>
                        <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                        $ct = 1;
                        if (isset($data)) {
                            foreach ($data as $item) {
                                echo "<tr><td>".$ct."</td>";
                                echo "<td>".$item->registrant_name."</td>";
                                echo "<td>".$item->email."</td>";
                                echo "<td>".$item->phone."</td>";
                                echo "<td>".$item->dob."</td>";
                                echo "<td>".$item->nama."</td>";
                                echo "<td style='text-align:center'><img src='".asset('img/qrcodes/'.$item->qr_code.'.jpg')."' width='50%' style='background-color:white; padding: 10px' alt=".$item->qr_code."></img><br>".$item->qr_code."</td>";
                                echo "<td>"."</td>";
                                echo '</tr>';
                                $ct++;
                            }
                        }
                    ?>
                  </tbody>
                  <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>E-mail</th>
                        <th>No. HP</th>
                        <th>Tanggal Lahir</th>
                        <th>Ibadah</th>
                        <th>QR Code</th>
                        <th>Action</th>
                    </tr>
                  </tfoot>
                </table>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        $(function () {
            $("#example1").DataTable({
              "responsive": true, "lengthChange": false, "autoWidth": false,
              "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
              "paging": true,
              "lengthChange": false,
              "searching": false,
              "ordering": true,
              "info": true,
              "autoWidth": false,
              "responsive": true,
            });
          });

        $( ".datepicker" ).daterangepicker({
          singleDatePicker: true,
          timePicker: true,
          timePicker24Hour: true,
          showDropdowns: true,
          drops: "auto",
          locale: {
            format: 'DD-MM-YYYY HH:mm'
          }
        });

        $( ".singledatepicker" ).daterangepicker({
          autoApply: true,
          singleDatePicker: true,
          showDropdowns: true,
          drops: "auto",
          locale: {
            format: 'DD-MM-YYYY'
          }
        });
    </script>
@stop