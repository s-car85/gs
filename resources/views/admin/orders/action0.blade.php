@if(!$orders->shipp)
    {!! Form::checkbox('shipp', $orders->id,  $orders->shipp) !!}
@else
    <i class="fa fa-check" aria-hidden="true" style="color: green;font-size: 18px;"></i>
@endif
