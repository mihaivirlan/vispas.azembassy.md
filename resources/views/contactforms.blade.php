<div class="col-md-4 col-xs-12">
    <div id="contact-form">
        @if (session('message'))
            <div class=" alert alert-success">
                <ul>
                    <li>@lang('email.' . session('message')) </li>
                </ul>
            </div>
        @endif
        <br>
        {!!  Form::open(array('route' => 'contacts', 'method' => 'post'))   !!}
        <div class="form-group">
            <label for="">@lang('trans.name'):</label>
            <input type="text" name="name" placeholder="Nume"  class="form-control"
                   required data-validation-required-message="Please enter your name.">
        </div>
        <div class="form-group">
            <label for="">@lang('trans.email'):</label>
            <input type="email" class="form-control" placeholder="Email" id="email" name="email"
                   required data-validation-required-message="Please enter your email address.">
            <p class="help-block text-danger"></p>
        </div>
        <div class="form-group">
            <label for="">@lang('trans.message'):</label>
            <textarea rows="5" class="form-control" placeholder="Mesaj" id="mesaj"  name="mesaj"
                      required data-validation-required-message="Please enter a message."></textarea>
            <p class="help-block text-danger"></p>
        </div>
        <div class="form-group">
            <button>@lang('Submit')</button>
        </div>
        {!! Form::close()!!}
    </div>
</div>