<div>
    <x-modal title="New Campaign" name="campaign" width="600px">
        @slot('modalSlot')
        <livewire:utils.campaign.add-campaign/>
        @endslot
    </x-modal>
    <livewire:utils.title-wrapper title="Manage Campaigns" />

    <div class="container">
        <div class="text-end">
            <a href="#0" wire:click.prevent="$dispatch('open-modal', {name: 'campaign'})" class="main-btn primary-btn btn-sm square-btn btn-hover">
                Add Campaign
                <i class="lni lni-plus"></i>
            </a>
        </div>
    </div>
</div>