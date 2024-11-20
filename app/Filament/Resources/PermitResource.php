<?php

namespace App\Filament\Resources;

use App\Enums\AbuyogBarangay;
use App\Enums\Status;
use App\Filament\Resources\PermitResource\Pages;
use App\Filament\Resources\PermitResource\RelationManagers;
use App\Models\Permit;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
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

class PermitResource extends Resource
{
    protected static ?string $model = Permit::class;

    protected static ?string $navigationIcon = 'heroicon-o-home-modern';

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
                    TextInput::make('project_title')
                        ->label('Project Title'),
                ])->columns(2),

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
                ])->columns(3),

                Section::make()
                    ->schema([
                        TextInput::make('or_number')
                            ->label('O.R. Number'),
                        TextInput::make('area')
                            ->numeric(),
                        TextInput::make('project_cost')
                            ->numeric()
                            ->label('Project Cost'),
                        TextInput::make('civil_structural')
                            ->label('Civil Structural'),
                        TextInput::make('building_permit')
                            ->label('Building Permit'),
                        TextInput::make('electrical_permit')
                            ->label('Electrical Permit'),
                        TextInput::make('sanitary_permit')
                            ->label('Sanitary Permit'),
                        TextInput::make('architectural'),
                        TextInput::make('fencing_permit')
                            ->label('Fencing Permit'),
                    ])->columns(3),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('owner.name')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('project_title')
                    ->label('Project Title')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('or_number')
                    ->label('O.R. Number')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('area')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('project_cost')
                    ->label('Project Cost')
                    ->sortable(),
                TextColumn::make('civil_structural')
                    ->label('Civil Structural')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('date_applied')
                    ->label('Date Applied')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('date_approved')
                    ->label('Date Approved')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('status')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('building_permit')
                    ->label('Building Permit')
                    ->sortable()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('electrical_permit')
                    ->label('Electrical Permit')
                    ->sortable()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('sanitary_permit')
                    ->label('Sanitary Permit')
                    ->sortable()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('fencing_permit')
                    ->label('Fencing Permit')
                    ->sortable()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
            'index' => Pages\ListPermits::route('/'),
            'create' => Pages\CreatePermit::route('/create'),
            'edit' => Pages\EditPermit::route('/{record}/edit'),
        ];
    }
}
