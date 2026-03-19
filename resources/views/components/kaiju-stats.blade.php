{{--
    Kaiju Stats Component
    ─────────────────────
    Props expected:
      $kaiju  – Kaiju model with relations: stats, attacks (ordered), speeds (first), regen (first)
--}}

@php
    $strengthStat = $kaiju->stats->firstWhere('stat_type', 'strength');
    $speedStat    = $kaiju->stats->firstWhere('stat_type', 'speed');
    $healthStat   = $kaiju->stats->firstWhere('stat_type', 'health');
    $regenStat    = $kaiju->stats->firstWhere('stat_type', 'regen');
    $speedRow     = $kaiju->speeds->first();
    $regenRow     = $kaiju->regen->first();

    // Build PHP arrays to pass into Alpine as JSON
    $statsJson = [
        'strength' => [],
        'speed'    => [],
        'health'   => [],
        'regen'    => [],
    ];
    foreach (['strength', 'speed', 'health', 'regen'] as $type) {
        $stat = $kaiju->stats->firstWhere('stat_type', $type);
        for ($i = 1; $i <= 10; $i++) {
            $statsJson[$type][] = $stat ? (float)$stat->{"val_{$i}"} : 0;
        }
    }
@endphp

{{-- ─── Attack Detail Modal ──────────────────────────────────────────────── --}}
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
                <div class="d-flex align-items-center gap-3 mb-3">
                    <span class="badge fs-6 px-3 py-2"
                          style="background:var(--ku-accent); color:#111; font-weight:700">
                        <i class="bi bi-lightning-fill me-1"></i>
                        {{ number_format($attack->damage, 0) }} DMG
                    </span>
                </div>
                @if($attack->description)
                    <p class="text-secondary mb-0">{{ $attack->description }}</p>
                @else
                    <p class="text-secondary fst-italic mb-0">No description available.</p>
                @endif
            </div>
            <div class="modal-footer" style="border-top:1px solid #3a3a3a">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endforeach

{{-- ─── Main Stats Panel ─────────────────────────────────────────────────── --}}
<div
    x-data="{
        selectedStat: 'strength',
        levels: {
            strength: {{ $strengthStat?->current_level ?? 0 }},
            speed:    {{ $speedStat?->current_level    ?? 0 }},
            health:   {{ $healthStat?->current_level   ?? 0 }},
            regen:    {{ $regenStat?->current_level    ?? 0 }}
        },
        maxLevel: 10,
        statsValues: {{ Js::from($statsJson) }},

        selectStat(stat) {
            this.selectedStat = stat;
        },
        increment() {
            if (this.levels[this.selectedStat] < this.maxLevel) {
                this.levels[this.selectedStat]++;
            }
        },
        decrement() {
            if (this.levels[this.selectedStat] > 0) {
                this.levels[this.selectedStat]--;
            }
        },
        reset() {
            this.levels[this.selectedStat] = 0;
        },
        getStatValue(statType) {
            const lvl = this.levels[statType];
            if (lvl === 0) return '—';
            const arr = this.statsValues[statType];
            if (!arr) return '—';
            const val = arr[lvl - 1];
            return (val !== null && val !== undefined) ? Number(val).toLocaleString(undefined, {minimumFractionDigits: 0, maximumFractionDigits: 2}) : '—';
        }
    }"
    class="ku-stats-panel rounded-3 overflow-hidden"
    style="background:#1a1a1a; border:1px solid #3a3a3a"
>
    <div class="px-3 pt-3 pb-1" style="border-bottom:1px solid #3a3a3a">
        <h5 class="mb-0 fw-bold" style="color:var(--ku-accent)">
            <i class="bi bi-bar-chart-fill me-2"></i>Stats &amp; Abilities
        </h5>
    </div>

    <div class="row g-0" style="min-height:340px">
        {{-- ── LEFT PANEL: stat rows ────────────────────────────────────── --}}
        <div class="col-md-6 p-3" style="border-right:1px solid #3a3a3a">

            {{-- Stat rows: Strength, Speed, Health, Regen --}}
            @foreach([
                ['key' => 'strength', 'label' => 'Strength', 'icon' => 'bi-lightning-charge-fill'],
                ['key' => 'speed',    'label' => 'Speed',    'icon' => 'bi-wind'],
                ['key' => 'health',   'label' => 'Health',   'icon' => 'bi-heart-fill'],
                ['key' => 'regen',    'label' => 'Regen',    'icon' => 'bi-arrow-repeat'],
            ] as $row)
            <div
                class="stat-row d-flex align-items-center gap-2 p-2 mb-2 rounded-2"
                style="cursor:pointer; transition:.15s"
                :style="selectedStat === '{{ $row['key'] }}'
                    ? 'background:#2a2a2a; border:1px solid var(--ku-accent); outline:none'
                    : 'background:#222; border:1px solid transparent'"
                @click="selectStat('{{ $row['key'] }}')"
            >
                {{-- Label --}}
                <div style="width:80px; font-size:.8rem; font-weight:600"
                     :style="selectedStat === '{{ $row['key'] }}' ? 'color:var(--ku-accent)' : 'color:#aaa'">
                    <i class="bi {{ $row['icon'] }} me-1"></i>{{ $row['label'] }}
                </div>

                {{-- 10 level boxes --}}
                <div class="d-flex gap-1 flex-grow-1">
                    @for($box = 1; $box <= 10; $box++)
                    <div
                        class="rounded-1 flex-grow-1"
                        style="height:18px; transition:.15s"
                        :style="levels['{{ $row['key'] }}'] >= {{ $box }}
                            ? 'background:var(--ku-accent); box-shadow: 0 0 4px rgba(255,193,7,.5)'
                            : 'background:#3a3a3a'"
                    ></div>
                    @endfor
                </div>

                {{-- Current level number --}}
                <div style="width:24px; text-align:right; font-size:.75rem; font-weight:700"
                     :style="selectedStat === '{{ $row['key'] }}' ? 'color:var(--ku-accent)' : 'color:#666'">
                    <span x-text="levels['{{ $row['key'] }}']"></span>
                </div>
            </div>
            @endforeach

            {{-- ── Level selector bar ──────────────────────────────────── --}}
            <div class="d-flex align-items-center gap-2 mt-3 pt-2"
                 style="border-top:1px solid #3a3a3a">
                {{-- Reset X button --}}
                <button
                    @click="reset()"
                    class="btn btn-sm fw-bold px-2 py-1"
                    style="background:#3a3a3a; color:#e0e0e0; border:1px solid #555; min-width:28px"
                    title="Reset to 0">✕
                </button>

                {{-- Mini boxes showing current level --}}
                <div class="d-flex gap-1 flex-grow-1">
                    @for($box = 1; $box <= 10; $box++)
                    <div
                        class="rounded-1 flex-grow-1"
                        style="height:14px; cursor:pointer; transition:.15s"
                        :style="levels[selectedStat] >= {{ $box }}
                            ? 'background:var(--ku-accent)'
                            : 'background:#3a3a3a'"
                        @click="levels[selectedStat] = {{ $box }}"
                        title="Set level {{ $box }}"
                    ></div>
                    @endfor
                </div>

                {{-- Decrement --}}
                <button
                    @click="decrement()"
                    class="btn btn-sm fw-bold px-2 py-1"
                    style="background:#3a3a3a; color:#e0e0e0; border:1px solid #555; min-width:28px"
                    :disabled="levels[selectedStat] <= 0">−
                </button>

                {{-- Increment --}}
                <button
                    @click="increment()"
                    class="btn btn-sm fw-bold px-2 py-1"
                    style="background:#3a3a3a; color:var(--ku-accent); border:1px solid #555; min-width:28px"
                    :disabled="levels[selectedStat] >= maxLevel">+
                </button>
            </div>
        </div>

        {{-- ── RIGHT PANEL: contextual info ────────────────────────────── --}}
        <div class="col-md-6 p-3">

            {{-- ── STRENGTH → Attacks list ─────────────────────────────── --}}
            <div x-show="selectedStat === 'strength'" x-transition>
                <h6 class="fw-bold mb-3" style="color:var(--ku-accent)">
                    <i class="bi bi-lightning-charge-fill me-1"></i>Attacks
                </h6>
                @if($kaiju->attacks->isEmpty())
                    <p class="text-secondary fst-italic">No attacks recorded.</p>
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
                                {{ number_format($attack->damage, 0) }}
                            </span>
                        </button>
                        @endforeach
                    </div>
                @endif
            </div>

            {{-- ── SPEED → Walking / Sprinting / Swimming ──────────────── --}}
            <div x-show="selectedStat === 'speed'" x-transition>
                <h6 class="fw-bold mb-3" style="color:var(--ku-accent)">
                    <i class="bi bi-wind me-1"></i>Movement Speeds
                </h6>
                @if($speedRow)
                <div class="d-flex flex-column gap-2">
                    @foreach([
                        ['icon' => 'bi-person-walking', 'label' => 'Walking',   'val' => $speedRow->walking_speed],
                        ['icon' => 'bi-lightning-fill',  'label' => 'Sprinting', 'val' => $speedRow->sprinting_speed],
                        ['icon' => 'bi-water',           'label' => 'Swimming',  'val' => $speedRow->swimming_speed],
                    ] as $sp)
                    <div class="d-flex justify-content-between align-items-center px-3 py-2 rounded-2"
                         style="background:#252525">
                        <span class="text-secondary">
                            <i class="bi {{ $sp['icon'] }} me-2"></i>{{ $sp['label'] }}
                        </span>
                        <span class="fw-bold" style="color:var(--ku-accent)">
                            {{ number_format($sp['val'], 1) }} <small class="text-secondary fw-normal">u/s</small>
                        </span>
                    </div>
                    @endforeach
                </div>
                @else
                    <p class="text-secondary fst-italic">No speed data available.</p>
                @endif
            </div>

            {{-- ── HEALTH → base health at selected level ──────────────── --}}
            <div x-show="selectedStat === 'health'" x-transition>
                <h6 class="fw-bold mb-3" style="color:var(--ku-accent)">
                    <i class="bi bi-heart-fill me-1"></i>Health
                </h6>
                <div class="d-flex justify-content-between align-items-center px-3 py-2 rounded-2"
                     style="background:#252525">
                    <span class="text-secondary">Base HP (lv <span x-text="levels.health"></span>)</span>
                    <span class="fw-bold fs-5" style="color:var(--ku-accent)"
                          x-text="getStatValue('health')"></span>
                </div>
                <p class="text-secondary small mt-2">
                    Adjust the level with the controls on the left to see how health scales.
                </p>
            </div>

            {{-- ── REGEN → health % + charge % ─────────────────────────── --}}
            <div x-show="selectedStat === 'regen'" x-transition>
                <h6 class="fw-bold mb-3" style="color:var(--ku-accent)">
                    <i class="bi bi-arrow-repeat me-1"></i>Regeneration
                </h6>
                @if($regenRow)
                <div class="d-flex flex-column gap-2">
                    <div class="d-flex justify-content-between align-items-center px-3 py-2 rounded-2"
                         style="background:#252525">
                        <span class="text-secondary">
                            <i class="bi bi-heart-pulse me-2"></i>Health Regen
                        </span>
                        <span class="fw-bold" style="color:var(--ku-accent)">
                            {{ number_format($regenRow->health_regen_pct, 2) }}%
                            <small class="text-secondary fw-normal">/ s</small>
                        </span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center px-3 py-2 rounded-2"
                         style="background:#252525">
                        <span class="text-secondary">
                            <i class="bi bi-battery-charging me-2"></i>Charge Regen
                        </span>
                        <span class="fw-bold" style="color:var(--ku-accent)">
                            {{ number_format($regenRow->charge_regen_pct, 2) }}%
                            <small class="text-secondary fw-normal">/ s</small>
                        </span>
                    </div>
                </div>
                @else
                    <p class="text-secondary fst-italic">No regeneration data available.</p>
                @endif
            </div>

        </div>{{-- /right panel --}}
    </div>{{-- /row --}}
</div>{{-- /x-data --}}
