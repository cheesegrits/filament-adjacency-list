<?php

namespace Saade\FilamentAdjacencyList\Widgets;

use App\Models\Agencies\Agency;
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

    protected static ?string $icon = 'heroicon-o-list-bullet';

    protected static bool $collapsible = true;

    protected static bool $startCollapsed = true;

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
                        AdjacencyList::make('kiddies')
                            ->relationship('descendants')
                            ->pivotAttributes(['agency_tree_type_id' => 1])
                            ->labelKey('name')
Testing                            ->customPath('tree_path')
                            ->startCollapsed(true)
                            ->addable(false)
                            ->editable(false)
                            ->deletable(false)
                            ->reorderable(false),
                    ])
                    ->columns(1)

            ])
            ->statePath('data')
            ->model($this->model);
    }

//    protected function getData(): array
//    {
//        return $this->getStateFromRelatedRecords(
//            collect()
//        );
//    }

    /**
     * @return array<array<string, mixed>>
     */
//    protected function getStateFromRelatedRecords(Collection $records): array
//    {
//        if (! $records->count()) {
//            return [];
//        }
//
//        $state = [];
//
//        $path = $this->getPath();
//        //        $translatableContentDriver = $this->getLivewire()->makeFilamentTranslatableContentDriver();
//
//        $records
//            ->each(
//                function (Model $record) use (&$state, $path): void {
//                    $data = $record->attributesToArray();
//
//                    //                    $data = $this->mutateRelationshipDataBeforeFill($data);
//
//                    // Depending on the records order, a children can be created before its parent.
//                    // In this case, we need to merge the children with the parent data.
//                    $key = $record->{$path};
//
//                    if ($existing = data_get($state, $key)) {
//                        data_set($state, $key, array_merge($existing, $data));
//                    } else {
//                        data_set($state, $key, $data);
//                    }
//                }
//            );
//
//        return $state;
//    }

    public function getCollapsible(): bool
    {
        return static::$collapsible;
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
}
