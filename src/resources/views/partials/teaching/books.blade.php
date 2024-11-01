<div class="my-container-border width-50">
    <div class="padding-wrapper">
        <h1 class="teaching__header title_fz30">Учение</h1> 
        <div class="books menu__teaching__content teaching__tab__content animate__animated animate__fadeIn">
            <h2 class="teaching__title title_fz18_mob">Книги</h2>
            <a href="{{ route('shop.books.show') }}" class="btn_white books__btn font-w">Посмотреть каталог книг</a>
            <div class=" books__regions">
                <h3 class="title_fz18">Список ответственных для заказа книг в регионах</h3>
                <ul class="books__list">
                    @foreach($bookManagers as $bookManager)
                        <li class="title_fz15_mob">{{$bookManager->name}}</li>
                        <li class="text_fz15_mob">{{$bookManager->user->name_first}} {{$bookManager->user->name_last}}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>    
</div>

