@if ($message = Session::get('success'))
<div class="alert alert-success alert-block" id="alert">
	{{-- <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>	 --}}
        <strong>{{ $message }}</strong>
</div>
@endif

@if ($message = Session::get('error'))
<div class="alert alert-danger alert-block" id="alert">
	{{-- <button type="button" class="close" data-dismiss="alert"></button>	 --}}
        <strong>{{ $message }}</strong>
</div>
@endif

@if ($message = Session::get('warning'))
<div class="alert alert-warning alert-block" id="alert">
	{{-- <button type="button" class="close" data-dismiss="alert"></button>	 --}}
	<strong>{{ $message }}</strong>
</div>
@endif

@if ($message = Session::get('info'))
<div class="alert alert-info alert-block" id="alert">
	{{-- <button type="button" class="close" data-dismiss="alert"></button>	 --}}
	<strong>{{ $message }}</strong>
</div>
@endif

@if ($message = Session::get('no_found'))
<div class="alert alert-danger alert-block" id="alert">
	<strong>{{ $message }}</strong>
</div>
@endif

@if ($errors->any())
<div class="alert alert-danger alert-block" id="alert">
	{{-- <button type="button" class="close" data-dismiss="alert">×</button>	 --}}
	Maaf ada kolom yang tidak sesuai dengan data yang diisi, harap teliti kembali
</div>
@endif

<script type="text/javascript">
setTimeout(() => {
	const alert = document.getElementById('alert');
	alert.style.display = 'none';
}, 5000);
</script>