@if (!empty($section->sub_content))
    <section class="partner-section pb-100 bg--section">
        <div class="container">
            <div class="partner-slider owl-theme owl-carousel">
                @foreach ($section->sub_content as $item)
                    <div class="partner-item border">
                        <img src="{{getPhoto($item->image)}}" alt="brand">
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endif