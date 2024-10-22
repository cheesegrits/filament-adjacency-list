<?php

namespace Saade\FilamentAdjacencyList\Forms\Components\Actions;

use Filament\Forms\Form;
use Filament\Support\Enums\ActionSize;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Str;
use Saade\FilamentAdjacencyList\Forms\Components\Component;

class AddChildAction extends Action
{
    public static function getDefaultName(): ?string
    {
        return 'addChild';
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->iconButton()->icon('heroicon-o-plus')->color('gray');

        $this->label(fn (): string => __('filament-adjacency-list::adjacency-list.actions.add-child.label'));

        $this->size(ActionSize::ExtraSmall);

        $this->modalHeading(
            fn (Component $component): ?string => match ($component->hasModal()) {
                true => __('filament-adjacency-list::adjacency-list.actions.add-child.modal.heading'),
                default => null,
            }
        );

        $this->modalSubmitActionLabel(
            fn (Component $component): ?string => match ($component->hasModal()) {
                true => __('filament-adjacency-list::adjacency-list.actions.add-child.modal.actions.create'),
                default => null,
            }
        );

        $this->form(
            function (Component $component, Form $form): ?Form {
                if (! $component->hasModal()) {
                    return null;
                }

                $form = $component->getForm($form);

                if ($model = $component->getRelatedModel()) {
                    $form->model($model);
                }

                return $form;
            }
        );

        $this->action(function (Component $component, array $arguments): void {
            $parentRecord = $component->getRelatedModel() ? $component->getCachedExistingRecords()->get($arguments['cachedRecordKey']) : null;

            $this->process(function (Component $component, array $arguments, array $data): void {
                $statePath = $component->getRelativeStatePath($arguments['statePath']);
                $uuid = (string) Str::uuid();

                $items = $component->getState();

                data_set($items, ("$statePath." . $component->getChildrenKey() . ".$uuid"), [
                    $component->getLabelKey() => __('filament-adjacency-list::adjacency-list.items.untitled'),
                    $component->getChildrenKey() => [],
                    ...$data,
                ]);

                $component->state($items);
            }, ['parentRecord' => $parentRecord]);
        });

        $this->visible(
            fn (Component $component): bool => $component->isAddable()
        );

        $this->authorize(function (Component $component): bool {
            try {
                return \Filament\authorize('create', $component->getModel())->allowed();
            } catch (AuthorizationException $exception) {
                return $exception->toResponse()->allowed();
            }
        });
    }
}
