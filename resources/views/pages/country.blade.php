@extends('layout')

@section('content')
    <section class="countries-section">
        <h2>Các Lá Cờ Quốc Gia</h2>
        <div class="countries-container">
            @foreach ($countries->chunk(4) as $chunk)
                <div class="row">
                    @foreach ($chunk as $country)
                        <div class="country-item">
                            <img src="{{ asset($country['flag']) }}" alt="{{ $country['name'] }}" class="flag">
                            <span class="country-name">{{ $country['name'] }}</span>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>
    </section>

    <section class="hotline-section">
        <div class="hotline-container">
            @foreach ($hotlines as $key => $hotline)
                <div class="hotline-box {{ $key }}">
                    <h2 class="title" style="color: {{ $key == 'job_seeker' ? 'red' : 'cyan' }}">{{ $hotline['title'] }}</h2>
                    <p>{{ $hotline['support'] }}</p>
                    <p class="hotline-number">{{ $hotline['number'] }}</p>
                    <button class="btn">{{ $hotline['button_text'] }}</button>
                </div>
            @endforeach
        </div>
    </section>
@endsection

