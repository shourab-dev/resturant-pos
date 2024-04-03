<?php

namespace App\Livewire\Utils\Campaign;

use App\Models\Campaign;
use Livewire\Component;

class AddCampaign extends Component
{

    public $name, $start_date, $end_date, $detail, $campaign_type = 'fixed', $amount, $discount_by = 'all', $productIds, $categoryIds, $editedId;

    function rules()
    {
        return [
            'name' => "required|min:3",
            'start_date' => 'nullable|after_or_equal:now',
            'end_date' => 'nullable|after_or_equal:start_date',
            'campaign_type' => 'required',
            'amount' => 'numeric',
            'discount_by' => 'required',

        ];
    }

    function messages()
    {
        return [
            'start_date.after_or_equal' => "Select today or a future dates",
            'end_date.after_or_equal' => "Select today or a future dates",
        ];
    }


    function storeOrUpdate()
    {
        if($this->productIds){
            dd($this->productIds);
        }

        dd('nothing');
        $this->validate();
        $campaign = Campaign::findOrNew($this->editedId);
        $campaign->name = $this->name;
        $campaign->detail = $this->detail;
        $campaign->start_date = $this->start_date;
        $campaign->end_date = $this->end_date;
        $campaign->type = $this->campaign_type;
        $campaign->amount = $this->amount;
        $campaign->discount_by = $this->discount_by;
        $campaign->save();

        

    }



    public function render()
    {
        return view('livewire.utils.campaign.add-campaign');
    }
}
