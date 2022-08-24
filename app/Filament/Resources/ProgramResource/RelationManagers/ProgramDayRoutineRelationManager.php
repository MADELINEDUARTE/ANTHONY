<?php

namespace App\Filament\Resources\ProgramResource\RelationManagers;

use App\Models\Program;
use App\Models\ProgramDay;
use App\Models\ProgramDayRoutine;
use App\Models\Status;
use App\Models\User;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\HasManyRelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Support\Facades\Auth;
use Filament\Facades\Filament;
use Illuminate\Support\Facades\Session;
use Livewire\TemporaryUploadedFile;
use Illuminate\Support\Str;

class ProgramDayRoutineRelationManager extends HasManyRelationManager
{
    
    protected static string $relationship = 'details_program_day_routine';

    protected static ?string $recordTitleAttribute = 'title';

    protected static ?string $title = 'Program Days Routine';
    protected static ?string $label = 'Program Days Routine';

    

    public static function form(Form $form): Form
    {
        
        //dd($form);
        //dd($this->all());
        
        $v = ProgramDay::where('program_id',Session::get('program_id_hidden'))->get();
        $optiosDR = [];
        foreach ($v as $key => $value) {
             $optiosDR[$value->id] = $value->name. ' '.$value->number;
        }
       
        return $form
            ->schema([
                                
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->label('Title')
                    ->afterStateUpdated(function ($state,callable $set) {
                        //$set('slug',Str::slug($state));
                        session()->forget('hidden_title');
                        session(['hidden_title' => Str::slug($state)]);
                    } )
                    ->default('')
                    ->helperText('Your full title, including any notation.')
                    ->maxLength(255),

                Forms\Components\FileUpload::make('video')->disk('public')
                ->directory('programs/day/routine/video')
                ->visibility('public')
                ->imagePreviewHeight('200')
                ->getUploadedFileNameForStorageUsing(function (TemporaryUploadedFile $file): string {
                    //return "modatex-chile";
                    return (string) "realworld-program-day-routine-video-".Str::random(40).".".$file->extension();
                })
                //->preserveFilenames()
                ->label('Video'),
                //->required(), 

                Forms\Components\TextInput::make('sets')
                    ->label('Sets')
                    ->required()
                    ->numeric(),

                    Forms\Components\TextInput::make('repetitions')
                    ->label('Repetitions')
                    ->required(),
                    //->numeric(),

                    Forms\Components\Select::make('program_day_id')
                    ->label('Program Day')
                    ->options($optiosDR)
                    ->required(),
                    

                    /*Forms\Components\Select::make('program_day_id')
                    ->label('Program Day')
                    ->required()
                    ->options(function(Program $program){

                        
                            return ProgramDay::where('program_id',$program->id)->pluck('name', 'id')->toArray();
                        
                    }),
                    */
                    
                    

                    /*
                    Forms\Components\BelongsToSelect::make('program_day_id')
                    ->relationship('program_day', 'name')
                    ->required()
                    ->label('Program Day'),  
                    */
                    

                    
                    Forms\Components\Select::make('status_id')
                    ->label('Status')
                    ->options(Status::where('id','>',0)->pluck('description', 'id'))
                    /*->disablePlaceholderSelection()*/
                    ->required(),
                
                    Forms\Components\Select::make('user_id')
                    ->label('Usuario')
                    ->options(User::where('id',Auth::user()->id)->pluck('name', 'id'))
                    ->default(Auth::user()->id)
                    ->disablePlaceholderSelection()
                    ->required(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->sortable()->searchable()->label('Id'),
                Tables\Columns\TextColumn::make('program_day.name')->sortable()->searchable()->label('Day'),
                Tables\Columns\TextColumn::make('program_day.number')->sortable()->searchable()->label('Number Week'),
                Tables\Columns\TextColumn::make('title')->sortable()->searchable()->label('Title'),
                Tables\Columns\TextColumn::make('sets')->sortable()->searchable()->label('Sets'),
                Tables\Columns\TextColumn::make('repetitions')->sortable()->searchable()->label('Repetitions'),
            ])
            ->filters([
                //
            ]);
    }


    /*
    protected function beforeFill(): void
    {
        
        session()->forget('hidden_title');
        session(['hidden_title' => Str::slug($this->record->title)]);
    } 
    */  


    


}
