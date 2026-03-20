@props(['status'])

@php
    $badgeClass = match($status) {
        \App\Models\Room::STATUS_AVAILABLE => 'badge badge-success',
        \App\Models\Room::STATUS_OCCUPIED => 'badge badge-error',
        \App\Models\Room::STATUS_DIRTY => 'badge badge-warning',
        default => 'badge badge-outline'
    };
    
    $statusText = match($status) {
        \App\Models\Room::STATUS_AVAILABLE => 'Available',
        \App\Models\Room::STATUS_OCCUPIED => 'Occupied',
        \App\Models\Room::STATUS_DIRTY => 'Dirty',
        default => ucfirst($status)
    };
@endphp

<span class="{{ $badgeClass }}">{{ $statusText }}</span>
