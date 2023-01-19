<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Filament\Tables;
use Livewire\Component;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\DeleteAction;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Actions\RestoreAction;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Actions\DeleteBulkAction;
use AlperenErsoy\FilamentExport\Actions\FilamentExportHeaderAction;

class ListPost extends Component implements Tables\Contracts\HasTable
{
    use Tables\Concerns\InteractsWithTable;

    protected function getTableHeading(): string
    {
        return 'Post';
    }

    protected function getTableQuery(): Builder
    {
        return Post::query();
    }

    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('comments_count')->counts('comments')->sortable(),
            TextColumn::make('title')->sortable()->searchable(),
            TextColumn::make('slug')->sortable(),
            TextColumn::make('published_at')->date(),
        ];
    }

    protected function getTableActions(): array
    {
        return [
            Action::make('edit')->url(fn (Post $record): string => route('posts.edit', $record))->icon('heroicon-s-pencil'),
            DeleteAction::make(),
            RestoreAction::make()
        ];
    }

    protected function getTableBulkActions(): array
    {
        return [
            DeleteBulkAction::make()
        ];
    }

    protected function getTableFilters(): array
    {
        return [
            TrashedFilter::make(),
        ];
    }

    protected function getTableHeaderActions(): array
    {
        return [
            FilamentExportHeaderAction::make('Export')
                ->fileName(date('d-m-Y'))
                ->button(),
            Action::make('Add')
                ->icon('heroicon-s-plus')
                ->url(fn (): string => route('posts.create'))->openUrlInNewTab()
                ->button(),
            ];
    }

    public function render()
    {
        return view('livewire.table')->layout('layouts.app');
    }
}
