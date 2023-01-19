<?php

namespace App\Http\Livewire;

use Filament\Forms;
use App\Models\Post;
use Livewire\Component;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\MarkdownEditor;
use Icetalker\FilamentTableRepeater\Forms\Components\TableRepeater;

class EditPost extends Component implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;

    public Post $post;
    public bool $creating = false;

    public function mount(): void
    {
        if (!isset($this->post)) {
            $this->creating = true;
            $this->post = new Post();
        }
        $this->form->fill($this->post->toArray());
    }

    protected function getFormModel(): Post
    {
        return $this->post;
    }

    protected function getFormContext()
    {
        if ($this->creating) {
            return 'create';
        } else {
            return 'edit';
        }
    }

    protected function getFormSchema(): array
    {
        return [
            Card::make()
            ->schema([
                TextInput::make('title')->required(),
                TextInput::make('slug')->required(),
                MarkdownEditor::make('content'),
                DatePicker::make('published_at')
            ]),
            TableRepeater::make('comments')->label('Comments')
                ->disableItemMovement()
                ->createItemButtonLabel('Add comment')
                ->relationship('comments')
                ->schema([
                    TextInput::make('title')->required(),
                    TextInput::make('content'),
                    Toggle::make('is_visible')->label('Visible'),
                ]),

            ];
    }

    public function submit(): void
    {
        if ($this->creating) {
            $this->post = Post::create($this->form->getState());
            $this->form->model($this->post)->saveRelationships();
            Notification::make()->title('Post created')->success()->send();
            redirect(route('posts.edit', $this->post));
        } else {
            $this->post->update($this->form->getState());
            Notification::make()->title('Post updated')->success()->send();
        }
    }

    public function render()
    {
        return view('livewire.form')->layout('layouts.app');
    }
}
