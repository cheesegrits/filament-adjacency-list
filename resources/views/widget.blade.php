{{--@php--}}
{{--    $heading     = $this->getHeading();--}}
{{--    $icon        = $this->getIcon();--}}
{{--    $collapsible = $this->getCollapsible();--}}
{{--    $treeId = $this->getId();--}}
{{--    $items = $this->getData();--}}
{{--    $statePath = $this->getStatePath();--}}
{{--    $itemActions = [--}}
{{--        $this->getAction('addChild'),--}}
{{--        $this->getAction('delete'),--}}
{{--        $this->getAction('edit'),--}}
{{--        $this->getAction('reorder')--}}
{{--    ];--}}
{{--    $addAction = $this->getAction('add');--}}
{{--@endphp--}}

<x-filament-widgets::widget>
{{--    <x-filament::section--}}
{{--        class="filament-adjacency-list-widget"--}}
{{--        :icon="$icon"--}}
{{--        :collapsible="$collapsible"--}}
{{--    >--}}
{{--        <x-slot name="heading">--}}
{{--            {{ $heading }}--}}
{{--        </x-slot>--}}

{{--        <div--}}
{{--            --}}{{--            {!! ($pollingInterval = $this->getPollingInterval()) ? "wire:poll.{$pollingInterval}=\"updateData\"" : '' !!}--}}
{{--        >--}}
{{--            <x-filament-adjacency-list::wrapper--}}
{{--                :tree-id="$treeId"--}}
{{--                :items="$items"--}}
{{--                :state-path="$statePathj"--}}
{{--                :itemActions="$itemActions"--}}
{{--                :addAction="$addAction"--}}
{{--                :addable="$this->isAddable()"--}}
{{--                :children-key="$getChildrenKey()"--}}
{{--                :deletable="$isDeletable()"--}}
{{--                :disabled="$isDisabled()"--}}
{{--                :editable="$isEditable()"--}}
{{--                :start-collapsed="$getStartCollapsed()"--}}
{{--                :label-key="$getLabelKey()"--}}
{{--                :reorderable="$isReorderable()"--}}
{{--                :max-depth="$getMaxDepth()"--}}
{{--            />--}}
{{--        </div>--}}
{{--    </x-filament::section>--}}

    <form wire:submit="create">
        {{ $this->form }}
    </form>

    <x-filament-actions::modals/>
</x-filament-widgets::widget>
