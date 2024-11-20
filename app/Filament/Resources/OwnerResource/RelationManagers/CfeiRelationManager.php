<?php

namespace App\Filament\Resources\OwnerResource\RelationManagers;

use App\Enums\AbuyogBarangay;
use App\Enums\Status;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CfeiRelationManager extends RelationManager
{
    protected static string $relationship = 'cfei';

    public function form(Form $form): Form
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

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('owner_id')
            ->columns([
                TextColumn::make('owner.name'),
                TextColumn::make('cfei_number')
                    ->label('CFEI Number'),
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
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
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
}
