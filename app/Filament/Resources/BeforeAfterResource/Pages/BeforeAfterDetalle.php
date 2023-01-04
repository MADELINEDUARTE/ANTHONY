<?php

namespace App\Filament\Resources\BeforeAfterResource\Pages;

use App\Filament\Resources\BeforeAfterResource;
use App\Models\BeforeAfter;
use Filament\Resources\Pages\Page;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;
use Filament\Tables\Actions\BulkAction;
use Filament\Tables\Actions\Action;

class BeforeAfterDetalle extends Page implements Tables\Contracts\HasTable
{
    use Tables\Concerns\InteractsWithTable;

    protected static string $resource = BeforeAfterResource::class;

    public $fotos;

    protected static string $view = 'filament.resources.before-after-resource.pages.before-after-detalle';

    public function mount(BeforeAfter $record)
    {
        $this->record = $record;
    }

    protected function getTableQuery(): Builder 
    {
      return BeforeAfter::query()->groupBy('user_id')->where('subscription_programs_id',$this->record->subscription_programs_id);
    } 

    public function getTableColumns(): array
    {
        return [
          Tables\Columns\TextColumn::make('user.name')->label('Name')->sortable()->searchable(),
          Tables\Columns\TextColumn::make('user.last_name')->label('Lastname')->sortable()->searchable(),
        ];
    }

    protected function getTableActions(): array
    {
      // dd($this->record->user_id);

        return [
          Action::make('View')
          ->modalContent(view('filament.resources.before-after-resource.pages.before-after-modal'))
          ->mountUsing(function (BeforeAfter $record) {
            
            $this->fotos = BeforeAfter::where('user_id',$record->user_id)->where('subscription_programs_id',$this->record->subscription_programs_id)->get();

              $this->fotos  = $this->fotos->groupBy('type');
              $this->fotos = $this->fotos->all();

          })
          ->action(fn () => $this->user = $this->record->user_id)
        ];
    }

}
