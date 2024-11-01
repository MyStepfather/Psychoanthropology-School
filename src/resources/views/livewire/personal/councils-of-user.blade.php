<div>
    <div id="member" class="lk__group group">
        <h2 class="group__heading padding-wrapper">Члену Совета</h2>
        <div class="group__inner box_content" data-observer-targer="group-payment" style="margin-top: 15px">
            @foreach ($councilGroups as $councilGroup)
                <div class="group__settings mt-2" wire:click="groupSelected({{ $councilGroup->id }})">
                    <h2 class="group__title title_fz23_mob">{{ $councilGroup->name }}</h2>
                </div>
                <div class="accordion custom_plus group__accordion" id="accordionRegion">
                    @foreach ($councilGroup->towns as $town)
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <button style="font-size: 18px !important;"
                                    class="title_fz18_mob custom_plus accordion-button
                                    accordion-button--justify-position collapsed p-0"
                                    type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseRegion{{ $town->id }}"
                                    aria-expanded="true" aria-controls="collapseOne">
                                    {{ $town->name }}
                                </button>
                            </h2>
                            <div id="collapseRegion{{ $town->id }}"
                                class="accordion-collapse collapse custom_show"
                                aria-labelledby="headingOne" data-bs-parent="#accordionRegion1">
                                <div class="accordion-body p-0">
                                    <div class="stans_content">
                                        <ul class="groups-list">

                                            @foreach ($town->groups as $group)
                                                <li style="cursor: pointer" class="text_fz15_mob" role="button"
                                                    data-id-group="{{ $group->id }}"
                                                    wire:click="$emit('groupSelector', {{ $group->id }})"
                                                    data-bs-target="#coordinator_card">
                                                    {{ \App\Constants\GroupTypes::ALL_NAMES[$group->type] }},
                                                    {{ $group->coordinator->name_last }} {{ $group->coordinator->name_first }}
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>
    </div>
</div>
