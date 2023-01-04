<x-filament::page>
<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Error iste, quasi voluptatibus aliquam repellendus aspernatur corrupti quas ullam sint itaque distinctio nesciunt rem laboriosam. Perspiciatis, nobis aperiam officia dolor eaque?</p>



@if(isset($this->fotos['before']))
	<h2>Before</h2>
	<div class="columns-3 d-flex">
		@foreach($this->fotos['before'] as $key => $value)
			<img class="" src="{{ asset('storage').'/'.$value['url_foto'] }}" />
			{{-- {{ $value['url_foto'] }} --}}
		@endforeach
	</div>
@endif

@if(isset($this->fotos['after']))
<h2>After</h2>
	<div class="columns-3 d-flex">
		@foreach($this->fotos['after'] as $key => $value)
			<img class="" src="{{ asset('storage').'/'.$value['url_foto'] }}" />
		@endforeach
	<div class="columns-3">
@endif
</x-filament::page>

<style>
	.d-flex{
		display: flex;
		justify-content: space-around;
	}
	img{
		max-width: 300px;
    	height: 100%;
	}
</style>	