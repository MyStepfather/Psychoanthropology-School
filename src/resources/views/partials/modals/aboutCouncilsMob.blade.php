<div class="modal fade modal-lg" id="popup_structure-rus" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content custom_modal  mt-5">
            <div class="modal-header d-flex justify-content-between mt-2 pb-0 ">
                <h2 class="title_fz23_mob">
                    Россия
                </h2>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-0">
                <div class="box_content mb-5 pt-0">
                    <div class="collaps_body mt-5">
                        @foreach ($councils as $council)
                            @if ($council->parent_id == 1)
                                <div class="accordion custom_plus box_content box_content-green bcg-about" id="accordionCenter{{ $council->id }}">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingOne">
                                            <button class="title_fz18_mob accordion-button accordion-button--justify-position collapsed p-0" type="button" data-bs-toggle="collapse" data-bs-target="#collapseCenter{{ $council->id }}" aria-expanded="true" aria-controls="collapseOne">
                                                {{ $council->name }}
                                            </button>
                                        </h2>
                                        <div id="collapseCenter{{ $council->id }}" class="accordion-collapse collapse show custom_show" aria-labelledby="headingOne" data-bs-parent="#accordionCenter{{ $council->id }}">
                                            <div class="accordion-body p-0">
                                                <h3 class="title_fz12_mob mt-1">
                                                    {{ implode(', ', $council->towns->pluck('name')->toArray()) }}
                                                </h3>
                                                @foreach ($council->users as $user)
                                                    <div class="structure-school__person mt-3">
                                                        <div class="structure-school__icon-person">
                                                            <img src="{{ asset('img/icons/profile-circle.svg') }}" alt="">
                                                        </div>
                                                        {{ $user->name }}
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>                                
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>                
        </div>         
    </div>
</div>
