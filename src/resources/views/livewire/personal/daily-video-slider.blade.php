<div>
    <div class="daily-video__slider">
        <div >
                <div class="daily-video__item">
                    <p class="daily-video__date">
                        {{ \Carbon\Carbon::parse($video->date)->locale('ru')->isoFormat('D MMMM YYYY') }}
                    </p>
                    <div class="daily-video__description">
                        <p class="daily-video__subtitle font-w">{{ $video->name }}</p>

                        {{-- кнопка Скачать в Моб версии--}}
                        <button class="daily-video__download hidden-for-desk">
                            <img src="./img/icons/download.svg" alt="">
                        </button>
                        {{-- кнопка Скачать в Desctop версии--}}
                        <div class="btn-download-audio">
                            <button class="daily-video__download">
                                <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M12.3922 6.82227C14.9422 7.04185 15.9835 8.35227 15.9835
                                                        11.221V11.3131C15.9835 14.4793 14.7156 15.7473 11.5493
                                                        15.7473H6.93807C3.77182 15.7473 2.50391 14.4793 2.50391
                                                        11.3131V11.221C2.50391 8.37352 3.53099 7.0631 6.03849 6.82935"
                                        stroke="#102F39" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M9.24805 2.87939V12.0027" stroke="#102F39"
                                          stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M11.6199 10.4229L9.24694 12.7958L6.87402 10.4229"
                                          stroke="#102F39" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </button>
                            <p class="font-w">Скачать аудио</p>
                        </div>
                    </div>
                    <div class="daily-video__video-wrapper">
                        {!! $video->url !!}
                        {{--                                        <img class="daily-video__play-ico" src="./img/icons/Play.svg" alt="">--}}
                        {{--                                        <img class="daily-video__video" src="./img/icons/test-video.png" alt="">--}}
                    </div>
                </div>

        </div>

        <div class="daily-video__nav">
            <button wire:click="decrementCurrentDay"
                class="daily-video__prev daily-video__nav-btn" type="button" >
                                    <span class="carousel-control-prev-icon daily-video__nav-icon"
                                          aria-hidden="true"></span>
                <span class="daily-video__nav-min">пред.</span>
                <span class="daily-video__nav-max">предыдущее</span>
            </button>
            <a href="{{ route('personal.daily-video.show') }}"><button class="font-w">Все беседы</button></a>
            <button wire:click="incrementCurrentDay"
                class="daily-video__next daily-video__nav-btn" type="button">
                <span class="daily-video__nav-min">след.</span>
                <span class="daily-video__nav-max">следующее</span>
                <span class="carousel-control-next-icon daily-video__nav-icon"
                      aria-hidden="true"></span>
            </button>
        </div>
    </div>
</div>
