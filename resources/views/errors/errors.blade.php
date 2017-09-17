@if(isset($errors) && count($errors->all()) > 0)
    <div class="alert alert-danger fade in alert-error" id="alert-message">
        <a class="close" href="#" data-dismiss="alert">x</a>
        <ul style="list-style-type: none">
            @foreach($errors->all('<li>:message</li>') as $message)
                {!! $message !!}
            @endforeach
        </ul>
    </div>
@endif