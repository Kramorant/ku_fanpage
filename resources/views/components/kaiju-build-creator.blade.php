{{--
    Kaiju Build Creator Component
    Props: $kaiju (with buildLevels and attacks relations loaded)
--}}
@php
    $buildLevelsKeyed = $kaiju->buildLevels->keyBy('level');
    $hasBuildData     = $kaiju->buildLevels->isNotEmpty();
    $speedRow         = $kaiju->speeds->first();
@endphp

@if($hasBuildData)
<div class="mt-4">
    <div class="rounded-3 overflow-hidden" style="background:#1a1a1a; border:1px solid #3a3a3a">

        <div class="px-3 pt-3 pb-2" style="border-bottom:1px solid #3a3a3a">
            <h5 class="mb-0 fw-bold" style="color:var(--ku-accent)">
                <i class="bi bi-sliders me-2"></i>Kaiju Build Creator
            </h5>
            <small class="text-secondary">Distribute up to 20 points across stats to preview your build</small>
        </div>

        <div class="p-3">
            <div class="d-flex justify-content-end mb-3">
                <span class="fw-bold fs-5">
                    <span id="bc-used" style="color:var(--ku-accent)">0</span><span class="text-secondary">/20</span>
                </span>
            </div>

            <div class="row g-3">
                {{-- LEFT: Stat bars --}}
                <div class="col-md-5">
                    @foreach([
                        ['key' => 'damage', 'label' => 'Damage', 'icon' => 'bi-lightning-fill'],
                        ['key' => 'speed',  'label' => 'Speed',  'icon' => 'bi-wind'],
                        ['key' => 'health', 'label' => 'Health', 'icon' => 'bi-heart-fill'],
                        ['key' => 'regen',  'label' => 'Regen',  'icon' => 'bi-arrow-repeat'],
                    ] as $stat)
                    <div class="mb-3 p-3 rounded-2"
                         id="bc-stat-{{ $stat['key'] }}"
                         style="background:#252525; cursor:pointer; transition:.15s"
                         onclick="bcSelectStat('{{ $stat['key'] }}')"
                         onmouseover="if(window.bcActiveStat !== '{{ $stat['key'] }}') this.style.background='#2a2a2a'"
                         onmouseout="if(window.bcActiveStat !== '{{ $stat['key'] }}') this.style.background='#252525'">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="fw-bold" style="color:var(--ku-text)">
                                <i class="bi {{ $stat['icon'] }} me-1" style="color:var(--ku-accent)"></i>
                                {{ $stat['label'] }}
                            </span>
                            <div class="d-flex gap-1 align-items-center">
                                <button type="button" class="btn btn-sm border-0 px-2 py-0 fw-bold"
                                        style="background:#1a1a1a; color:var(--ku-accent); font-size:1.1rem; line-height:1.5"
                                        onclick="event.stopPropagation(); bcAdjust('{{ $stat['key'] }}', -1)">−</button>
                                <span id="bc-count-{{ $stat['key'] }}" class="fw-bold px-1"
                                      style="color:var(--ku-accent); min-width:18px; text-align:center">0</span>
                                <button type="button" class="btn btn-sm border-0 px-2 py-0 fw-bold"
                                        style="background:#1a1a1a; color:var(--ku-accent); font-size:1.1rem; line-height:1.5"
                                        onclick="event.stopPropagation(); bcAdjust('{{ $stat['key'] }}', 1)">+</button>
                            </div>
                        </div>
                        <div class="d-flex gap-1" id="bc-dots-{{ $stat['key'] }}">
                            @for($i = 1; $i <= 10; $i++)
                            <div class="rounded-1"
                                 style="flex:1; height:20px; background:#3a3a3a; transition:.1s; cursor:pointer"
                                 data-stat="{{ $stat['key'] }}"
                                 data-val="{{ $i }}"
                                 onclick="event.stopPropagation(); bcSetStat('{{ $stat['key'] }}', {{ $i }})">
                            </div>
                            @endfor
                        </div>
                    </div>
                    @endforeach
                </div>

                {{-- RIGHT: Results --}}
                <div class="col-md-7">
                    <div class="p-3 rounded-2 h-100" style="background:#252525; min-height:220px">
                        <div id="bc-results">
                            <p class="text-secondary fst-italic mb-0" style="font-size:.9rem">
                                Select a stat on the left to see your build values.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-end mt-3">
                <button type="button" class="btn btn-sm btn-outline-secondary" onclick="bcReset()">
                    <i class="bi bi-arrow-counterclockwise me-1"></i>Reset
                </button>
            </div>
        </div>
    </div>
</div>

<script>
(function() {
    const MAX_POINTS   = 20;
    const MAX_PER_STAT = 10;

    const buildData = @json($buildLevelsKeyed);
    const attacks   = @json($kaiju->attacks->map(fn($a) => ['name' => $a->name, 'damage_min' => $a->damage_min, 'damage_max' => $a->damage_max]));
    const speedRow  = @json($speedRow ? ['walking' => $speedRow->walking_min, 'sprinting' => $speedRow->sprinting_min, 'swimming' => $speedRow->swimming_min, 'flying' => $speedRow->flying_min] : null);

    let points = { damage: 0, speed: 0, health: 0, regen: 0 };
    window.bcActiveStat = 'damage';

    function totalUsed() {
        return Object.values(points).reduce((a, b) => a + b, 0);
    }

    function updateCounter() {
        const used = totalUsed();
        const el = document.getElementById('bc-used');
        el.textContent = used;
        el.style.color = used >= MAX_POINTS ? '#ff6b6b' : 'var(--ku-accent)';
    }

    function updateDots(stat) {
        const val = points[stat];
        document.querySelectorAll(`[data-stat="${stat}"]`).forEach((dot, i) => {
            dot.style.background = i < val ? 'var(--ku-accent)' : '#3a3a3a';
        });
        document.getElementById(`bc-count-${stat}`).textContent = val;
    }

    function updateHighlight() {
        ['damage','speed','health','regen'].forEach(s => {
            const el = document.getElementById(`bc-stat-${s}`);
            if (el) el.style.background = s === window.bcActiveStat ? '#2f2f2f' : '#252525';
        });
    }

    function getData(level) {
        return buildData[level] || null;
    }

    function renderResults() {
        const stat  = window.bcActiveStat;
        const level = points[stat];
        const data  = getData(level);
        let html    = '';

        const row = (icon, label, value) =>
            `<div class="d-flex justify-content-between align-items-center px-3 py-2 rounded-2 mb-1" style="background:#1a1a1a">
                <span class="text-secondary"><i class="bi ${icon} me-2"></i>${label}</span>
                <span class="fw-bold" style="color:var(--ku-accent)">${value}</span>
            </div>`;

        if (stat === 'damage') {
            if (!attacks.length) {
                html = '<p class="text-secondary fst-italic mb-0">No attacks available.</p>';
            } else {
                const mult = data ? (parseFloat(data.damage_multiplier) || 1.0) : 1.0;
                html = attacks.map(a =>
                    row('bi-lightning-fill', a.name,
                        `${(a.damage_min * mult).toFixed(2)} – ${(a.damage_max * mult).toFixed(2)}`)
                ).join('');
            }
        } else if (stat === 'speed') {
            const speeds = [
                { key: 'walking',   label: 'Walking',   icon: 'bi-person-walking' },
                { key: 'sprinting', label: 'Sprinting', icon: 'bi-lightning-fill' },
                { key: 'swimming',  label: 'Swimming',  icon: 'bi-water' },
                { key: 'flying',    label: 'Flying',    icon: 'bi-feather' },
            ];
            const rows = speeds
                .filter(sp => data && data[sp.key] != null)
                .map(sp => row(sp.icon, sp.label, `${parseFloat(data[sp.key]).toFixed(2)} u/s`));
            html = rows.length ? rows.join('') : '<p class="text-secondary fst-italic mb-0">No speed data for this level.</p>';
        } else if (stat === 'health') {
            html = (data && data.health != null)
                ? row('bi-heart-fill', 'Kaiju Health', parseFloat(data.health).toFixed(2))
                : '<p class="text-secondary fst-italic mb-0">No health data for this level.</p>';
        } else if (stat === 'regen') {
            const rows = [];
            if (data && data.health_regen != null) rows.push(row('bi-heart-fill',       'Health Regen', `${parseFloat(data.health_regen).toFixed(3)}%`));
            if (data && data.charge_regen != null) rows.push(row('bi-battery-charging', 'Charge Regen', `${parseFloat(data.charge_regen).toFixed(3)}%`));
            html = rows.length ? rows.join('') : '<p class="text-secondary fst-italic mb-0">No regen data for this level.</p>';
        }

        document.getElementById('bc-results').innerHTML = html;
    }

    window.bcSelectStat = function(stat) {
        window.bcActiveStat = stat;
        updateHighlight();
        renderResults();
    };

    window.bcSetStat = function(stat, val) {
        const current = points[stat];
        let newVal = current === val ? val - 1 : val;
        newVal = Math.max(0, Math.min(MAX_PER_STAT, newVal));
        const diff = newVal - current;
        if (diff > 0 && totalUsed() + diff > MAX_POINTS) return;
        points[stat] = newVal;
        updateDots(stat);
        updateCounter();
        if (window.bcActiveStat === stat) renderResults();
    };

    window.bcAdjust = function(stat, delta) {
        const current = points[stat];
        let newVal = Math.max(0, Math.min(MAX_PER_STAT, current + delta));
        const diff = newVal - current;
        if (diff > 0 && totalUsed() + diff > MAX_POINTS) return;
        points[stat] = newVal;
        updateDots(stat);
        updateCounter();
        if (window.bcActiveStat === stat) renderResults();
    };

    window.bcReset = function() {
        points = { damage: 0, speed: 0, health: 0, regen: 0 };
        ['damage','speed','health','regen'].forEach(s => updateDots(s));
        updateCounter();
        renderResults();
    };

    // Init
    updateHighlight();
    renderResults();
})();
</script>
@endif
