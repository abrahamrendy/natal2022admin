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
                        <th>Name</th>
                        <th>Value</th>
                        <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                        $ct = 1;
                        if (isset($data)) {
                            foreach ($data as $item) {
                                echo "<form method='POST' action='".route('submit_ibadah')."'><tr><td>".$ct."</td>";
                    ?>
                    @csrf
                    <?php
                                echo "<td>".$item->name."</td>";
                                echo '<td><select class="form-select" name="active_service" size="4" aria-label="size 4 select" style="width:100%">';
                                foreach ($ibadah as $tempIbadah) {
                                    if ($item->value == $tempIbadah->id) {
                                        $selected = "selected";
                                    } else {
                                        $selected = "";
                                    }
                                    echo "<option value='".$tempIbadah->id."' ".$selected.">".$tempIbadah->nama."</option>";
                                }
                                echo "</select></td>";
                                echo "<td style ='text-align:center'><button type = 'submit' class='btn btn-primary'>Submit"."</button></td>";
                                echo "<input type='hidden' value=".$item->id." name='id'>";
                                echo '</tr></form>';
                                $ct++;
                            }
                        }
                    ?>
                  </tbody>
                  <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Value</th>
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
    </script>
@stop