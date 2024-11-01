<?php

namespace App\Http\Livewire\Personal\Modals;

use App\Actions\Notify\GroupChangesNotifyBuilder;
use Livewire\Component;

class GroupChange extends Component
{
    public $text;
    public $groupId;

    protected $listeners = ['groupChangesSelected'];


    public function groupChangesSelected($groupId)
    {
        $this->groupId = $groupId;
    }
    public function sendChanges(GroupChangesNotifyBuilder $groupChangesNotifyBuilder) {
        if(!$this->text) return;

        $data['groupId'] = $this->groupId;
        $data['text'] = $this->text;

        $groupChangesNotifyBuilder->handle($data);

        $this->dispatchBrowserEvent('closeChangesModal');
        $this->text = '';
    }

    public function render()
    {
        return view('livewire.personal.modals.group-change');
    }
}
