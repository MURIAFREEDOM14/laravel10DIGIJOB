@if ($message = Session::get('success'))
<div class="alert alert-success alert-block">
	{{-- <button type="button" class="close" data-dismiss="alert"></button>	 --}}
        <strong>{{ $message }}</strong>
</div>
@endif

@if ($message = Session::get('error'))
<div class="alert alert-danger alert-block">
	{{-- <button type="button" class="close" data-dismiss="alert"></button>	 --}}
        <strong>{{ $message }}</strong>
</div>
@endif

@if ($message = Session::get('warning'))
<div class="alert alert-warning alert-block">
	{{-- <button type="button" class="close" data-dismiss="alert"></button>	 --}}
	<strong>{{ $message }}</strong>
</div>
@endif

@if ($message = Session::get('info'))
<div class="alert alert-info alert-block">
	{{-- <button type="button" class="close" data-dismiss="alert"></button>	 --}}
	<strong>{{ $message }}</strong>
</div>
@endif

@if ($message = Session::get('no_found'))
<div class="alert alert-danger alert-block">
	<strong>{{ $message }}</strong>
</div>
@endif

@if ($errors->any())
<div class="alert alert-danger">
	{{-- <button type="button" class="close" data-dismiss="alert">×</button>	 --}}
	Maaf ada kolom yang tidak sesuai dengan data yang diisi, harap teliti kembali
</div>
@endif
<script type="text/javascript">
function name(params) {
	Swal.fire({
	icon: 'error',
	title: 'Oops...',
	text: 'Something went wrong!',
	footer: '<a href="">Why do I have this issue?</a>'
	})	
}
</script>