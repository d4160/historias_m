@props(['errors'])

@if ($errors->any())
    <div {{ $attributes }}>
        <div class="message-box with-icon error">
            <div class="icon-box"><span class="icon fa fa-exclamation-triangle"></span></div>
            <p>{{ __('Whoops! Something went wrong.') }}</p>
            <a href="javascript:void(0);" class="close-btn"><span class="icon fa fa-times"></span></a>
        </div>

        <ul class="list-style-three">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
