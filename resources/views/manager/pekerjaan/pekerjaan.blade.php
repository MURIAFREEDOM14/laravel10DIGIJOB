@extends('layouts.manager')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card mt-4">
                    <div class="card-header">
                        <div class="float-left">Data Pekerjaan</div>
                        <div class="float-right"><a class="btn btn-primary" href="/manager/tambah_pekerjaan">Tambah Data Pekerjaan</a></div>
                    </div>
                    <div class="card-body">
                        <form action="/manager/pekerjaan" method="POST">
                            @csrf
                            <div class="input-group">
                                <select name="id_pekerjaan" class="form-control" id="">
                                    <option value="">-- Pilih Pekerjaan --</option>
                                    @foreach ($pekerjaan as $item)
                                        <option value="{{$item->nama_pekerjaan}}" @if ($id_pekerjaan == $item->nama_pekerjaan)
                                            selected
                                        @endif>{{$item->nama_pekerjaan}}</option>
                                    @endforeach
                                </select>
                                <select name="negara_id" class="form-control" id="">
                                    <option value="">-- Pilih Negara --</option>
                                    @foreach ($negara as $item)
                                        <option value="{{$item->negara}}" @if ($negara_id == $item->negara)
                                            selected
                                        @endif>{{$item->negara}}</option>
                                    @endforeach
                                </select>
                                <button type="submit" class="btn btn-primary">Cari</button>
                            </div>
                        </form>
                        <hr>
                        <div class="table-responsive">
                            <table id="basic-datatables" class="display table table-striped table-hover">
                                <thead>
                                    <tr class="text-center">
                                        <th style="width: 1px;"><b class="bold">No</b></th>
                                        <th><b class="bold">Nama Pekerjaan</b></th>
                                        <th style="width: 1px;"><b class="bold">Syarat Umur</b></th>
                                        <th style="width: 1px;"><b class="bold">Syarat Kelamin</b></th>
                                        <th><b class="bold">Negara</b></th>
                                        <th><b class="bold">Aksi</b></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data_kerja as $item)
                                        <tr class="text-center">
                                            <td style="width: 1px"><b class="bold">{{$loop->iteration}}</b></td>
                                            <td style="width: 1px"><b class="bold">{{$item->nama_pekerjaan}}</b></td>
                                            <td><b class="bold">{{$item->syarat_umur}}</b></td>
                                                @if ($item->syarat_kelamin == "MF")
                                                   <td><b class="bold">Laki-laki & Perempuan</b></td> 
                                                @elseif ($item->syarat_kelamin == "F")
                                                    <td><b class="bold">Perempuan</b></td>
                                                @else
                                                    <td><b class="bold">Laki-laki</b></td>     
                                                @endif
                                            <td><b class="bold">{{$item->negara}}</b></td>
                                            <td>
                                                <a class="btn btn-warning" href="/manager/edit_pekerjaan/{{$item->id_pekerjaan}}"><i class="fa fa-edit"></i></a>
                                                <a class="btn btn-danger" href="/manager/hapus_pekerjaan/{{$item->id_pekerjaan}}"><i class="fa fa-times"></i></a>
                                            </td>
                                        </tr>                                        
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script >
		$(document).ready(function() {
			$('#basic-datatables').DataTable({
			});

			$('#multi-filter-select').DataTable( {
				"pageLength": 5,
				initComplete: function () {
					this.api().columns().every( function () {
						var column = this;
						var select = $('<select class="form-control"><option value=""></option></select>')
						.appendTo( $(column.footer()).empty() )
						.on( 'change', function () {
							var val = $.fn.dataTable.util.escapeRegex(
								$(this).val()
								);

							column
							.search( val ? '^'+val+'$' : '', true, false )
							.draw();
						} );

						column.data().unique().sort().each( function ( d, j ) {
							select.append( '<option value="'+d+'">'+d+'</option>' )
						} );
					} );
				}
			});

			// Add Row
			$('#add-row').DataTable({
				"pageLength": 5,
			});

			var action = '<td> <div class="form-button-action"> <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task"> <i class="fa fa-edit"></i> </button> <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Remove"> <i class="fa fa-times"></i> </button> </div> </td>';

			$('#addRowButton').click(function() {
				$('#add-row').dataTable().fnAddData([
					$("#addName").val(),
					$("#addPosition").val(),
					$("#addOffice").val(),
					action
					]);
				$('#addRowModal').modal('hide');

			});
		});
	</script>
@endsection