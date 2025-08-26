<div class="w-full">
    {{-- Comment Form --}}
    <livewire:coments-form :post="$model" />

    {{-- Comment List --}}
    <div class="mt-6">
        <livewire:comments-list :post="$model" wire:key='{{ "comments-list-$model->id" }}' />

    </div>
</div>
