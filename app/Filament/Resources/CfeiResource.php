<?php

namespace App\Filament\Resources;

use App\Enums\AbuyogBarangay;
use App\Enums\Status;
use App\Filament\Resources\CfeiResource\Pages;
use App\Filament\Resources\CfeiResource\RelationManagers;
use App\Models\Cfei;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CfeiResource extends Resource
{
    protected static ?string $model = Cfei::class;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $modelLabel = 'CFEIs';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                ->schema([
                    Select::make('owner_id')
                        ->relationship('owner', 'name')
                        ->createOptionForm([
                            Section::make()
                                ->schema([
                                    TextInput::make('name')
                                        ->required(),
                                    TextInput::make('contact_phone')
                                        ->tel()
                                        ->label('Contact Phone'),
                                    Select::make('Address')
                                        ->options(AbuyogBarangay::class)
                                ])->columns(3),
                        ]),

                    TextInput::make('cfei_number')
                        ->label('CFEI Number'),
                    TextInput::make('construction_type')
                        ->label('Construction Type'),
                ])->columns(3),

                Section::make()
                ->schema([
                    DatePicker::make('date_applied')
                        ->label('Date Applied')
                        ->native(false)
                        ->displayFormat('M d Y'),
                    DatePicker::make('date_approved')
                        ->label('Date Approved')
                        ->native(false)
                        ->displayFormat('M d Y'),
                    Select::make('status')
                        ->options(Status::class)
                ])->columns(3)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('owner.name')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('cfei_number')
                    ->label('CFEI Number')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('construction_type')
                    ->label('Construction Type')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('date_applied')
                    ->label('Date Applied')
                    ->date('M d Y')
                    ->sortable(),
                TextColumn::make('date_approved')
                    ->label('Date Approved')
                    ->date('M d Y')
                    ->sortable(),
                TextColumn::make('status')
                    ->sortable()
                    ->searchable()
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options(Status::class)
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make()
                ])
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCfeis::route('/'),
            'create' => Pages\CreateCfei::route('/create'),
            'edit' => Pages\EditCfei::route('/{record}/edit'),
        ];
    }
}
