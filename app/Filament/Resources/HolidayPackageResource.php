<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HolidayPackageResource\Pages;
use App\Filament\Resources\HolidayPackageResource\RelationManagers;
use App\Models\HolidayPackage;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Components\Split;
use Filament\Forms\Components\Textarea;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\TextInputColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use SplFileInfo;

class HolidayPackageResource extends Resource
{
    protected static ?string $model = HolidayPackage::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Section::make('Holiday Package')
                    ->description('')
                    ->schema([
                        TextInput::make('name'),
                        Select::make('category_id')
                            ->relationship('category', 'name'),
                        TextInput::make('description'),
                        TextInput::make('price')
                            ->numeric()
                            ->prefix('Rp.'),
                        TextInput::make('duration')->numeric()->suffix('day'),
                        Select::make('status')
                            ->options([
                                'active' => 'Active',
                                'inactive' => 'Inactive',
                            ]),
                        FileUpload::make('image_url')
                            ->image()
                            ->disk('package')->visibility('private')

                    ]),
                // ->columns(2),
                Section::make('Iteneraries')
                    ->schema([
                        Repeater::make('iteneraries')
                            ->relationship('itenerary')
                            ->schema([
                                TextInput::make('day_number')->numeric(),
                                TextInput::make('activity'),
                                Textarea::make('description')->rows(8),
                            ]),
                    ])
                // ->columns(2),


            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image_url')->disk('public')->getStateUsing(function ($record) {
                    // Pastikan URL yang benar digunakan
                    return asset('storage/images/' . $record->image_url);
                })->label('Image'),
                TextColumn::make('name'),
                TextColumn::make('category.name')->label('Category'),
                TextColumn::make('price')->prefix('Rp.'),
                TextColumn::make('duration')->suffix(' Day'),
                BadgeColumn::make('status')
                    ->colors([
                        'success' => 'active',
                        'danger' => 'inactive',
                    ])
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            // RelationManagers\IteneraryRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListHolidayPackages::route('/'),
            'create' => Pages\CreateHolidayPackage::route('/create'),
            'edit' => Pages\EditHolidayPackage::route('/{record}/edit'),
        ];
    }
}
