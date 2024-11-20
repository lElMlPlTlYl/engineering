<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\EventResource;
use App\Filament\Resources\PermitResource;
use App\Models\Event;
use App\Models\Permit;
use Filament\Widgets\Widget;
use Saade\FilamentFullCalendar\Data\EventData;
use Saade\FilamentFullCalendar\Widgets\FullCalendarWidget;

class CalendarWidget extends FullCalendarWidget
{
    //protected static string $view = 'filament.widgets.calendar-widget';
    public function fetchEvents(array $fetchInfo): array
    {
        return Permit::query()
            ->where('date_applied', '>=', $fetchInfo['start'])
            //->where('date_approved', '<=', $fetchInfo['end'])
            //->where('status', '==', $fetchInfo ['pending'])
            ->get()
            ->map(
                fn (Permit $event) => EventData::make()
                    ->id($event->id)
                    ->title($event->project_title)
                    ->start($event->date_applied)
                    //->end($event->date_approved)
                    ->url(
                        url: EventResource::getUrl(name: 'view', parameters: ['record' => $event]),
                        shouldOpenUrlInNewTab: true
                    )
            )
            ->toArray();
    }
}
