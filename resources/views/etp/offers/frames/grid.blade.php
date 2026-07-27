
<section class="flex-col-34">
    <div class="flex-row-8 pad-x-5">
        <form method="GET" action="{{ url()->current() }}">
            <select class="input" name="sort" onchange="this.form.submit()">
                <option value="rating-asc" {{ request('sort') == 'rating-desc' ? 'selected' : '' }}>Популярные
                </option>
                <option value="date-asc" {{ request('sort') == 'date-asc' ? 'selected' : '' }}>Новые</option>
                <option value="price-asc" {{ request('sort') == 'price-asc' ? 'selected' : '' }}>Дешевые
                </option>
                <option value="price-desc" {{ request('sort') == 'price-desc' ? 'selected' : '' }}>Дорогие
                </option>
            </select>

            <select class="input" name="storage" onchange="this.form.submit()">
                <option value="6aba6955-a743-11eb-80bd-00155d588b1f" {{ request('storage') == '6aba6955-a743-11eb-80bd-00155d588b1f' ? 'selected' : '' }}>Основной</option>
                <option value="82fcc45e-539b-11ef-812c-00155d629f03" {{ request('storage') == '82fcc45e-539b-11ef-812c-00155d629f03' ? 'selected' : '' }}>Оптовый</option>
                <option value="190abd43-d1e0-11ed-80f1-00155d629f03" {{ request('storage') == '190abd43-d1e0-11ed-80f1-00155d629f03' ? 'selected' : '' }}>Омск</option>
            </select>

            @foreach (request()->except('sort', 'storage') as $name => $value)
                <input type="hidden" name="{{ $name }}" value="{{ $value }}">
            @endforeach
        </form>
    </div>

    <div class="row g-4">
        @foreach ($offers as $offer)
            <div class="col-6 col-md-4 col-lg-2">
                @component('etp.offers.frames.card', compact('offer'))
                @endcomponent
            </div>
        @endforeach
    </div>
</section>
