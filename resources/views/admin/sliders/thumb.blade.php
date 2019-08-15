@if($slider->thumbnail_path != null)
<img src="{{ asset($slider->thumbnail_path) }}" alt="{{ $slider->title }}" class="attachment-img img-responsive" width="100">
@endif