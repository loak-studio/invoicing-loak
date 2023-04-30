<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TaskResource\Pages;
use App\Models\Task;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ViewColumn;
use Illuminate\Database\Eloquent\Model;

class TaskResource extends Resource
{
    protected static ?string $model = Task::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $navigationGroup = 'Gestion de projet';

    protected static ?string $label = 'Tâche';

    protected static ?string $pluralLabel = 'Tâches';

    protected static ?string $navigationLabel = 'Tâches';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')
                    ->label('Titre')
                    ->columnSpanFull()
                    ->required(),
                Textarea::make('description')
                    ->label('Description')
                    ->columnSpanFull(),
                Select::make('status')
                    ->options([
                        'pending' => 'En attente',
                        'in_progress' => 'En cours',
                        'done' => 'Terminée',
                    ])
                    ->label('Statut')
                    ->default('pending')
                    ->disablePlaceholderSelection()
                    ->required(),
                Select::make('users')
                    ->label('Assignée à')
                    ->multiple()
                    ->relationship('users', 'name'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ViewColumn::make('users.avatar')
                    ->label('Assignée à')
                    ->view('filament.components.images-column'),
                TextColumn::make('title')
                    ->label('Titre'),
                SelectColumn::make('status')
                    ->label('Statut')
                    ->options([
                        'pending' => 'En attente',
                        'in_progress' => 'En cours',
                        'done' => 'Terminée',
                    ])
                    ->disablePlaceholderSelection(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->modalHeading(function (Model $record): string {
                        return 'Modifier la tâche : '.$record->title;
                    }),
                Tables\Actions\DeleteAction::make()
                    ->modalHeading(function (Model $record): string {
                        return 'Supprimer la tâche : '.$record->title;
                    }),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make()
                    ->modalHeading('Supprimer la sélection de tâches'),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageTasks::route('/'),
        ];
    }
}
