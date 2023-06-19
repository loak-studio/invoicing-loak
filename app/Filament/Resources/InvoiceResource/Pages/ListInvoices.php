<?php

namespace App\Filament\Resources\InvoiceResource\Pages;

use App\Filament\Resources\InvoiceResource;
use App\Models\Invoice;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListInvoices extends ListRecords
{
    protected static string $resource = InvoiceResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Créer une facture'),
        ];
    }

    protected function getTitle(): string
    {
        return 'Gestion des factures émises';
    }

    protected function getTableEmptyStateIcon(): ?string
    {
        return 'heroicon-o-document-text';
    }

    protected function getTableEmptyStateHeading(): ?string
    {
        return 'Aucune facture enregistrée';
    }

    // Create a bug with forceDelete and restore action
    // protected function getTableQuery(): Builder
    // {
    //     return Invoice::orderBy('reference', 'desc');
    // }
}
