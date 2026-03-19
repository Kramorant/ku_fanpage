{{--
    Kaiju Stats Component
    ─────────────────────
    Props expected:
      $kaiju  – Kaiju model with relations: baseStat, attacks (ordered), speeds (first)
--}}

@php
    $baseStat = $kaiju->baseStat;
    $speedRow = $kaiju->speeds->first();
@endphp

{{-- ─── Attack Detail Modals ────────────────────────────────────────────────── --}}
@foreach($kaiju->attacks as $attack)
<div class="modal fade" id="attackModal{{ $attack->id }}" tabindex="-1"
     aria-labelledby="attackModalLabel{{ $attack->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="background:#2a2a2a; border:1px solid #3a3a3a; color:#e0e0e0">
            <div class="modal-header" style="border-bottom:1px solid #3a3a3a">
                <h5 class="modal-title fw-bold" id="attackModalLabel{{ $attack->id }}"
                    style="color:var(--ku-accent)">
                    {{ $attack->name }}
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="d-flex flex-wrap gap-2 mb-3">
                    <span class="badge fs-6 px-3 py-2"
                          style="background:var(--ku-accent); color:#111; font-weight:700">
                        <i class="bi bi-lightning-fill me-1"></i>
                        {{ number_format($attack->damage_min, 2) }} – {{ number_format($attack->damage_max, 2) }} DMG
                    </span>

                    @if($attack->cooldown)
                    <span class="badge fs-6 px-3 py-2"
                          style="background:#2a2a2a; color:#e0e0e0; border:1px solid #3a3a3a; font-weight:600">
                        <i class="bi bi-hourglass-split me-1" style="color:var(--ku-accent)"></i>
                        {{ number_format($attack->cooldown, 2) }}s CD
                    </span>
                    @endif

                    @if($attack->charge_cost)
                    <span class="badge fs-6 px-3 py-2"
                          style="background:#2a2a2a; color:#e0e0e0; border:1px solid #3a3a3a; font-weight:600">
                        <i class="bi bi-battery-charging me-1" style="color:var(--ku-accent)"></i>
                        {{ number_format($attack->charge_cost, 2) }} Charge
                    </span>
                    @endif
                </div>
                @if($attack->description)
                    <p class="text-secondary mb-0">{{ $attack->description }}</p>
                @else
                    <p class="text-secondary fst-italic mb-0">No description available.</p>
                @endif
            </div>

        </div>
    </div>
</div>
@endforeach

{{-- ─── Main Stats Panel ─────────────────────────────────────────────────── --}}
<div class="ku-stats-panel rounded-3 overflow-hidden"
     style="background:#1a1a1a; border:1px solid #3a3a3a">

    <div class="px-3 pt-3 pb-1" style="border-bottom:1px solid #3a3a3a">
        <h5 class="mb-0 fw-bold" style="color:var(--ku-accent)">
            <i class="bi bi-bar-chart-fill me-2"></i>Stats &amp; Abilities
        </h5>
    </div>

    {{-- ── Health & Regen ─────────────────────────────────────────────── --}}
    <div class="row g-0" style="border-bottom:1px solid #3a3a3a">
        <div class="col-md-6 p-3" style="border-right:1px solid #3a3a3a">
            <h6 class="fw-bold mb-2 text-uppercase" style="color:var(--ku-accent); font-size:.75rem; letter-spacing:.08em">
                <i class="bi bi-heart-fill me-1"></i>Health
            </h6>
            @if($baseStat)
            <div class="d-flex gap-4">
                <div>
                    <div class="text-secondary" style="font-size:.7rem">Min</div>
                    <div class="fw-bold" style="color:var(--ku-text); font-size:1.1rem">
                        {{ number_format($baseStat->health_min, 0) }}
                    </div>
                </div>
                <div>
                    <div class="text-secondary" style="font-size:.7rem">Max</div>
                    <div class="fw-bold" style="color:var(--ku-accent); font-size:1.1rem">
                        {{ number_format($baseStat->health_max, 0) }}
                    </div>
                </div>
            </div>
            @else
                <p class="text-secondary fst-italic mb-0">No data available.</p>
            @endif
        </div>
        <div class="col-md-6 p-3">
            <h6 class="fw-bold mb-2 text-uppercase" style="color:var(--ku-accent); font-size:.75rem; letter-spacing:.08em">
                <i class="bi bi-arrow-repeat me-1"></i>Regen
            </h6>
            @if($baseStat)
            <div class="d-flex gap-4">
                <div>
                    <div class="text-secondary" style="font-size:.7rem">Min</div>
                    <div class="fw-bold" style="color:var(--ku-text); font-size:1.1rem">
                        {{ number_format($baseStat->regen_min, 2) }}%
                    </div>
                </div>
                <div>
                    <div class="text-secondary" style="font-size:.7rem">Max</div>
                    <div class="fw-bold" style="color:var(--ku-accent); font-size:1.1rem">
                        {{ number_format($baseStat->regen_max, 2) }}%
                    </div>
                </div>
            </div>
            @else
                <p class="text-secondary fst-italic mb-0">No data available.</p>
            @endif
        </div>
    </div>

    {{-- ── Movement Speeds ─────────────────────────────────────────────── --}}
    <div class="p-3" style="border-bottom:1px solid #3a3a3a">
        <h6 class="fw-bold mb-3 text-uppercase" style="color:var(--ku-accent); font-size:.75rem; letter-spacing:.08em">
            <i class="bi bi-wind me-1"></i>Movement Speeds
        </h6>
        @if($speedRow)
        <div class="d-flex flex-column gap-2">
            @foreach([
                ['icon' => 'bi-person-walking', 'label' => 'Walking',   'min' => $speedRow->walking_min,   'max' => $speedRow->walking_max],
                ['icon' => 'bi-lightning-fill',  'label' => 'Sprinting', 'min' => $speedRow->sprinting_min, 'max' => $speedRow->sprinting_max],
                ['icon' => 'bi-water',           'label' => 'Swimming',  'min' => $speedRow->swimming_min,  'max' => $speedRow->swimming_max],
            ] as $sp)
            <div class="d-flex justify-content-between align-items-center px-3 py-2 rounded-2"
                 style="background:#252525">
                <span class="text-secondary">
                    <i class="bi {{ $sp['icon'] }} me-2"></i>{{ $sp['label'] }}
                </span>
                <span class="fw-bold" style="color:var(--ku-text)">
                    <span style="color:var(--ku-text)">{{ number_format($sp['min'], 2) }}</span>
                    <span class="text-secondary mx-1">–</span>
                    <span style="color:var(--ku-accent)">{{ number_format($sp['max'], 2) }}</span>
                    <small class="text-secondary fw-normal ms-1">u/s</small>
                </span>
            </div>
            @endforeach
            @if($speedRow->flying_min !== null)
            <div class="d-flex justify-content-between align-items-center px-3 py-2 rounded-2"
                 style="background:#252525">
                <span class="text-secondary">
                    <i class="bi bi-feather me-2"></i>Flying
                </span>
                <span class="fw-bold" style="color:var(--ku-text)">
                    <span style="color:var(--ku-text)">{{ number_format($speedRow->flying_min, 2) }}</span>
                    <span class="text-secondary mx-1">–</span>
                    <span style="color:var(--ku-accent)">{{ number_format($speedRow->flying_max, 2) }}</span>
                    <small class="text-secondary fw-normal ms-1">u/s</small>
                </span>
            </div>
            @endif
        </div>
        @else
            <p class="text-secondary fst-italic mb-0">No speed data available.</p>
        @endif
    </div>

    {{-- ── Attacks ──────────────────────────────────────────────────────── --}}
    <div class="p-3">
        <h6 class="fw-bold mb-3 text-uppercase" style="color:var(--ku-accent); font-size:.75rem; letter-spacing:.08em">
            <i class="bi bi-lightning-charge-fill me-1"></i>Attacks
        </h6>
        @if($kaiju->attacks->isEmpty())
            <p class="text-secondary fst-italic mb-0">No attacks recorded.</p>
        @else
            <div class="d-flex flex-column gap-2">
                @foreach($kaiju->attacks as $attack)
                <button
                    type="button"
                    class="d-flex justify-content-between align-items-center px-3 py-2 rounded-2 text-start w-100 border-0"
                    style="background:#252525; transition:.15s; cursor:pointer"
                    onmouseover="this.style.background='#2f2f2f'"
                    onmouseout="this.style.background='#252525'"
                    data-bs-toggle="modal"
                    data-bs-target="#attackModal{{ $attack->id }}"
                >
                    <span style="color:var(--ku-text); font-weight:600">{{ $attack->name }}</span>
                    <span class="badge ms-2" style="background:var(--ku-accent); color:#111">
                        {{ number_format($attack->damage_min, 0) }} – {{ number_format($attack->damage_max, 0) }}
                    </span>
                </button>
                @endforeach
            </div>
        @endif
    </div>

</div>{{-- /ku-stats-panel --}}

