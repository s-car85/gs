<section class="text-center" id="gallery">
    <div class="container">
        {{--ARRAY CHUNK OVDE MOZDA LIMIT NA 8 SLIKA--}}
        {{--RED 1--}}
        @foreach ($galleries->chunk(4) as $chunk)
            <div class="d-flex justify-content-center flex-wrap flex-md-nowrap no-gutters">
                @foreach ($chunk as $gallery)
                    <div class="grid-item d-flex">
                        <a href="{{ asset('upload/'.$gallery->image ) }}" data-lightbox="image" data-title="{!! $gallery->title !!}" >
                            <img class="img-fluid" src="{{ asset('upload/'.$gallery->image ) }}" alt="" />
                        </a>
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>

    <!--/.container-->
</section>