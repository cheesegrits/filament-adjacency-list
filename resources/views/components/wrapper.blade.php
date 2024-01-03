@props([
    'treeId',
    'items',
    'statePath',
    'itemActions',
    'addAction',
    'addable',
    'childrenKey',
    'deletable',
    'disabled',
    'editable',
    'startCollapsed',
    'itemStatePath',
    'labelKey',
    'reorderable',
    'maxDepth',
])

<div wire:key="tree-items-wrapper">
        <div
            class="space-y-2"
            data-sortable-container
            x-ignore
            ax-load
            ax-load-css="{{ \Filament\Support\Facades\FilamentAsset::getStyleHref('filament-adjacency-list-styles', 'saade/filament-adjacency-list') }}"
            ax-load-src="{{ \Filament\Support\Facades\FilamentAsset::getAlpineComponentSrc('filament-adjacency-list', 'saade/filament-adjacency-list') }}"
            x-data="FilamentAdjacencyList({
                treeId: @js($treeId),
                statePath: @js($statePath),
                disabled: @js($disabled),
                maxDepth: @js($maxDepth)
            })"
                >
@forelse($items as $uuid => $item)
    <x-filament-adjacency-list::item
        :tree-id="$treeId"
        :state-path="$statePath"
        :actions="$itemActions"
        :addable="$addable"
        :children-key="$childrenKey"
        :deletable="$deletable"
        :disabled="$disabled"
        :editable="$editable"
        :start-collapsed="$startCollapsed"
        :item="$item"
        :item-state-path="$statePath . '.' . $uuid"
        :label-key="$labelKey"
        :reorderable="$reorderable"
        :max-depth="$maxDepth"
    />
@empty
    <div @class([
                    'w-full bg-white rounded-lg border border-gray-300 px-3 py-2 text-left rtl:text-right',
                    'dark:bg-gray-900 dark:border-white/10',
                ])>
        {{ __('filament-adjacency-list::adjacency-list.items.empty') }}
    </div>
    @endforelse
    </div>
    </div>

    <div class="flex justify-end">
        @if ($addable)
            {{ $addAction(['statePath' => $statePath]) }}
        @endif
    </div>
