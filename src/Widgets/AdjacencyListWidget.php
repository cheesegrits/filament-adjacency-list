<?php

namespace Saade\FilamentAdjacencyList\Widgets;

use Closure;
use Filament\Forms\Components\Group;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Widgets;
use Illuminate\Database\Eloquent\Model;
use Saade\FilamentAdjacencyList\Forms\Components\AdjacencyList;

class AdjacencyListWidget extends Widgets\Widget implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    public Model $model;

    protected static string $view = 'filament-adjacency-list::widget';

    protected static ?string $heading = null;

    protected static ?string $label = null;

    protected static ?string $fieldName = 'children';

    protected static ?string $icon = 'heroicon-o-list-bullet';

    protected static bool $startCollapsed = true;

    //    protected static string $customPath = 'tree_path';

    protected static string $keyLabel = 'label';

    protected static string $childrenKey = 'children';

    protected static string $relationshipName = 'descendants';

    protected static ?int $maxDepth = null;

    protected static bool $hasRulers = false;

    protected static bool $hasModal = true;

    protected static bool $editable = false;

    protected static bool $addable = false;

    protected static bool $deletable = false;

    protected static bool $reorderable = false;

    protected static bool $indentable = false;

    protected static bool $moveable = false;

    protected static bool $clickable = true;

    protected static ?array $pivotAttributes = null;

    protected static ?Closure $mutateRelationshipDataBeforeFill = null;

    protected static ?Closure $modifyRelationshipQueryUsing = null;

    public function mount(): void
    {
        $this->model = $this->getModel();

        $this->form->fill(
            $this->model->toArray()
        );
    }

    public function getModel(): ?Model
    {
        return $this->model;
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Group::make()
                    ->schema([
                        AdjacencyList::make($this->getFieldName())
                            ->label($this->getLabel())
                            ->mutateRelationshipDataBeforeFillUsing($this->getMutateRelationshipDataBeforeFillUsing())
                            ->relationship($this->getRelationshipName(), $this->getModifyRelationshipQueryUsing())
                            ->pivotAttributes($this->getPivotAttributes())
                            ->labelKey($this->getLabelKey())
                            ->childrenKey($this->getChildrenKey())
                            ->maxDepth($this->getMaxDepth())
                            ->hasRulers($this->getHasRulers())
                            ->collapsed($this->getStartCollapsed())
                            ->modal($this->getHasModal())
                            ->addable($this->getAddable())
                            ->editable($this->getEditable())
                            ->clickable($this->getClickable())
                            ->deletable($this->getDeletable())
                            ->reorderable($this->getReorderable())
                            ->indentable($this->getIndentable())
                            ->moveable($this->getMoveable())
                            ->editAction($this->getEditAction())
                            ->addAction($this->getAddAction())
                            ->addChildAction($this->getAddChildAction())
                            ->deleteAction($this->getDeleteAction())
                            ->reorderAction($this->getReorderAction())
                            ->indentAction($this->getIndentAction())
                            ->dedentAction($this->getDedentAction())
                            ->moveUpAction($this->getMoveUpAction())
                            ->moveDownAction($this->getMoveDownAction())
                            ->form($this->getFormSchema()),
                    ])
                    ->columns(1),

            ])
            ->statePath('data')
            ->model($this->model);
    }

    public function getFieldName(): string
    {
        return static::$fieldName;
    }

    public function getLabel(): ?string
    {
        return static::$label;
    }

    public function getStartCollapsed(): bool
    {
        return static::$startCollapsed;
    }

    protected function getHeading(): ?string
    {
        return static::$heading;
    }

    protected function getIcon(): ?string
    {
        return static::$icon;
    }

    protected function getHasModal(): bool
    {
        return static::$hasModal;
    }

    protected function getMaxDepth(): ?int
    {
        return static::$maxDepth;
    }

    protected function getRelationshipName(): string
    {
        return static::$relationshipName;
    }

    protected function getModifyRelationshipQueryUsing(): ?Closure
    {
        return static::$modifyRelationshipQueryUsing;
    }

    protected function getPivotAttributes(): ?array
    {
        return static::$pivotAttributes;
    }

    protected function getLabelKey(): string
    {
        return static::$keyLabel;
    }

    protected function getChildrenKey(): string
    {
        return static::$childrenKey;
    }

    protected function getHasRulers(): bool
    {
        return static::$hasRulers;
    }

    //    protected function getCustomPath(): string
    //    {
    //        return static::$customPath;
    //    }

    protected function getEditable(): bool
    {
        return static::$editable;
    }

    protected function getClickable(): bool
    {
        return static::$clickable;
    }

    protected function getAddable(): bool
    {
        return static::$addable;
    }

    protected function getDeletable(): bool
    {
        return static::$deletable;
    }

    protected function getReorderable(): bool
    {
        return static::$reorderable;
    }

    protected function getIndentable(): bool
    {
        return static::$indentable;
    }

    protected function getMoveable(): bool
    {
        return static::$moveable;
    }

    protected function getFormSchema(): ?array
    {
        return null;
    }

    protected function getMutateRelationshipDataBeforeFillUsing(): ?Closure
    {
        return static::$mutateRelationshipDataBeforeFill;
    }

    protected function getEditAction(): ?Closure
    {
        return null;
    }

    protected function getAddAction(): ?Closure
    {
        return null;
    }

    protected function getAddChildAction(): ?Closure
    {
        return null;
    }

    protected function getDeleteAction(): ?Closure
    {
        return null;
    }

    protected function getReorderAction(): ?Closure
    {
        return null;
    }

    protected function getIndentAction(): ?Closure
    {
        return null;
    }

    protected function getDedentAction(): ?Closure
    {
        return null;
    }

    protected function getMoveUpAction(): ?Closure
    {
        return null;
    }

    protected function getMoveDownAction(): ?Closure
    {
        return null;
    }
}
