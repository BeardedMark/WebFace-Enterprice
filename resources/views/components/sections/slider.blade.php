<div class="flex-col-8">

    <div class="slider-container">
        @foreach ($section['items'] as $item)
            <div class="slider-slide" @if (!$loop->first) hidden @endif>

                @if (isset($section['parameters']['itemsTemplate']))
                    @component('components.frames.' . $section['parameters']['itemsTemplate'], $item)
                    @endcomponent
                @else
                    @component('components.frames.default', $item)
                    @endcomponent
                @endif

            </div>
        @endforeach
    </div>


    <div class="flex-row-5 jc-btw pad-13">

        <button class="icon" type="button" onclick="sliderPrev(this)">
            <img width="20" height="20"
                 src="https://img.icons8.com/fluency-systems-regular/20/back.png"
                 alt="prev" />
        </button>


        <div class="flex-row-5 jc-center slider-pagination">

            @foreach ($section['items'] as $item)
                <button
                    class="icon slider-dot"
                    type="button"
                    onclick="sliderTo(this, {{ $loop->index }})"
                >
                    {{ $loop->iteration }}
                </button>
            @endforeach

        </div>


        <button class="icon" type="button" onclick="sliderNext(this)">
            <img width="20" height="20"
                 src="https://img.icons8.com/fluency-systems-regular/20/forward--v1.png"
                 alt="next" />
        </button>

    </div>

</div>


<script>

function getSlider(button) {
    return button.closest('.flex-col-8').querySelector('.slider-container');
}


function showSlide(slider, index) {

    const slides = slider.children;

    [...slides].forEach((slide, i) => {
        slide.hidden = i !== index;
    });

}


function sliderNext(button) {

    const slider = getSlider(button);
    const slides = slider.children;

    let current = [...slides].findIndex(s => !s.hidden);

    let next = (current + 1) % slides.length;

    showSlide(slider, next);
}


function sliderPrev(button) {

    const slider = getSlider(button);
    const slides = slider.children;

    let current = [...slides].findIndex(s => !s.hidden);

    let prev = (current - 1 + slides.length) % slides.length;

    showSlide(slider, prev);
}


function sliderTo(button, index) {

    const slider = getSlider(button);

    showSlide(slider, index);

}

</script>
