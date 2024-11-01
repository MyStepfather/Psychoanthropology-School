<div class="my-container-border">
    <div class="padding-wrapper">
        <h1 class="teaching__header title_fz30">Учение</h1> 
        <div class="other-texts position-relative">
            <h2 class="other-texts__title title_fz18">
                {{$articleItem->name}}
            </h2>
            <h3 class="other-texts__subtitle title_fz12">
                {{$articleItem->description}}
            </h3>
            <img class="other-texts__img" src="{{ asset($articleItem->url) }}">
            <div class="other-texts__text">
                {!! $articleItem->text !!}
            </div>
            <a class="position-absolute top-0 end-0" href="{{ route('teaching.others') }}">
                <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <line x1="5.99504" y1="23.7004" x2="23.7921" y2="5.90327" stroke="#102F39" stroke-width="2"/>
                    <line x1="6.40242" y1="5.90324" x2="24.1995" y2="23.7003" stroke="#102F39" stroke-width="2"/>
                </svg>
            </a>
        </div>
    </div>    
</div>

