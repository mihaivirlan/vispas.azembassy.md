@include('frontend.partials.header')
<section id="filter" class="border-bottom">
    <div class="container">
        <div class="flex-center">
            <div class="filter-date  filter-padding-top filter-items-margin-right">
                <input type="text" name="date" value="" placeholder="Date" class="pull-left no-focus datepicker">
                <button class="filter-date-btn filter-btn inline-block no-focus pull-left"></button>
            </div>
            <div class="filter-departure filter-padding-top  filter-items-margin-right pull-left">
                <input type="text" name="date" value="" placeholder="Departure" class="pull-left no-focus datepicker">
                <button class="filter-departure-btn filter-btn  inline-block no-focus"></button>
            </div>
            <div class="filter-children filter-padding-top filter-items-margin-right">
                <select id="soflow">
                    <!-- This method is nice because it doesn't require extra div tags, but it also doesn't retain the style across all browsers. -->
                    <option>Select an Option</option>
                    <option>Option 1</option>
                    <option>Option 2</option>
                </select>
            </div>
            <div class="pull-left filter-padding-top">
                <button class="filter-check-btn">
                    <a href="{{URL::route('booking')}}">Check Availability</a>
                </button>
            </div>
        </div>
    </div>
</section>






