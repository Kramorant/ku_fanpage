@extends('layouts.app')

@section('title', 'Edit ' . $kaiju->name)

@section('content')
<div class="container" style="max-width:900px">
    <div class="d-flex align-items-center gap-3 mb-4">
        <a href="{{ route('admin.kaijus.index') }}" class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-arrow-left"></i>
        </a>
        <h1 class="fw-bold mb-0" style="color:var(--ku-accent)">Edit: {{ $kaiju->name }}</h1>
    </div>

    <form method="POST" action="{{ route('admin.kaijus.update', $kaiju) }}" enctype="multipart/form-data">
        @csrf @method('PUT')

        {{-- ── Basic Info ──────────────────────────────────────────────── --}}
        <div class="card-ku p-4 rounded-3 mb-4">
            <h5 class="fw-bold mb-3" style="color:var(--ku-accent)">Basic Info</h5>
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label text-secondary">Name *</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                           value="{{ old('name', $kaiju->name) }}" required>
                    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label text-secondary">Slug *</label>
                    <input type="text" name="slug" class="form-control @error('slug') is-invalid @enderror"
                           value="{{ old('slug', $kaiju->slug) }}" required>
                    @error('slug')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-12">
                    <label class="form-label text-secondary">Description</label>
                    <textarea name="description" rows="4" class="form-control">{{ old('description', $kaiju->description) }}</textarea>
                </div>
                <div class="col-md-6">
                    <label class="form-label text-secondary">Image</label>
                    <input type="file" name="image" class="form-control" accept="image/*">
                    @if($kaiju->image)
                    <div class="mt-2">
                        <img src="{{ Storage::url($kaiju->image) }}" height="60"
                             class="rounded" alt="current image">
                        <small class="text-secondary ms-2">Current image</small>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- ── Stats ───────────────────────────────────────────────────── --}}
        @foreach([
            ['key' => 'strength', 'label' => 'Strength', 'icon' => 'bi-lightning-charge-fill'],
            ['key' => 'speed',    'label' => 'Speed',    'icon' => 'bi-wind'],
            ['key' => 'health',   'label' => 'Health',   'icon' => 'bi-heart-fill'],
            ['key' => 'regen',    'label' => 'Regen',    'icon' => 'bi-arrow-repeat'],
        ] as $statDef)
        @php
            $stat = $kaiju->stats->firstWhere('stat_type', $statDef['key']);
        @endphp
        <div class="card-ku p-4 rounded-3 mb-4">
            <h5 class="fw-bold mb-3" style="color:var(--ku-accent)">
                <i class="bi {{ $statDef['icon'] }} me-2"></i>{{ $statDef['label'] }} Stat
            </h5>
            <div class="row g-2 mb-3">
                <div class="col-md-3">
                    <label class="form-label text-secondary small">Current Level (0–10)</label>
                    <input type="number" name="stats[{{ $statDef['key'] }}][current_level]"
                           class="form-control" min="0" max="10"
                           value="{{ old("stats.{$statDef['key']}.current_level", $stat?->current_level ?? 0) }}">
                </div>
            </div>
            <div class="row g-2">
                @for($i = 1; $i <= 10; $i++)
                <div class="col-6 col-md-2">
                    <label class="form-label text-secondary small">Val {{ $i }}</label>
                    <input type="number" step="0.01"
                           name="stats[{{ $statDef['key'] }}][val_{{ $i }}]"
                           class="form-control"
                           value="{{ old("stats.{$statDef['key']}.val_{$i}", $stat?->{"val_{$i}"} ?? '') }}"
                           placeholder="0.00">
                </div>
                @endfor
            </div>
        </div>
        @endforeach

        {{-- ── Attacks ──────────────────────────────────────────────────── --}}
        <div class="card-ku p-4 rounded-3 mb-4" x-data="attacksManager()" x-init="init()">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <h5 class="fw-bold mb-0" style="color:var(--ku-accent)">
                    <i class="bi bi-lightning-fill me-2"></i>Attacks
                </h5>
                <button type="button" class="btn btn-ku btn-sm" @click="addAttack()">
                    <i class="bi bi-plus-lg me-1"></i>Add Attack
                </button>
            </div>

            <template x-for="(atk, idx) in attacks" :key="idx">
                <div class="row g-2 mb-3 align-items-end p-2 rounded-2"
                     style="background:#252525; border:1px solid #3a3a3a">
                    <div class="col-md-4">
                        <label class="form-label text-secondary small">Attack Name</label>
                        <input type="text" :name="`attacks[${idx}][name]`"
                               class="form-control" x-model="atk.name" required>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label text-secondary small">Damage</label>
                        <input type="number" step="0.01" :name="`attacks[${idx}][damage]`"
                               class="form-control" x-model="atk.damage" placeholder="0.00">
                    </div>
                    <div class="col-md-5">
                        <label class="form-label text-secondary small">Description</label>
                        <input type="text" :name="`attacks[${idx}][description]`"
                               class="form-control" x-model="atk.description">
                    </div>
                    <div class="col-md-1 text-end">
                        <button type="button" class="btn btn-outline-danger btn-sm"
                                @click="removeAttack(idx)" title="Remove">
                            <i class="bi bi-trash"></i>
                        </button>
                    </div>
                </div>
            </template>

            <p x-show="attacks.length === 0" class="text-secondary fst-italic mb-0">
                No attacks yet. Click "Add Attack" to add one.
            </p>
        </div>

        {{-- ── Speed ────────────────────────────────────────────────────── --}}
        @php $speedRow = $kaiju->speeds->first(); @endphp
        <div class="card-ku p-4 rounded-3 mb-4">
            <h5 class="fw-bold mb-3" style="color:var(--ku-accent)">
                <i class="bi bi-wind me-2"></i>Movement Speeds
            </h5>
            <div class="row g-3">
                @foreach([
                    ['field' => 'walking_speed',   'label' => 'Walking Speed (u/s)'],
                    ['field' => 'sprinting_speed',  'label' => 'Sprinting Speed (u/s)'],
                    ['field' => 'swimming_speed',   'label' => 'Swimming Speed (u/s)'],
                ] as $sp)
                <div class="col-md-4">
                    <label class="form-label text-secondary">{{ $sp['label'] }}</label>
                    <input type="number" step="0.01" name="speed[{{ $sp['field'] }}]"
                           class="form-control"
                           value="{{ old("speed.{$sp['field']}", $speedRow?->{$sp['field']} ?? '') }}"
                           placeholder="0.00">
                </div>
                @endforeach
            </div>
        </div>

        {{-- ── Regen ────────────────────────────────────────────────────── --}}
        @php $regenRow = $kaiju->regen->first(); @endphp
        <div class="card-ku p-4 rounded-3 mb-4">
            <h5 class="fw-bold mb-3" style="color:var(--ku-accent)">
                <i class="bi bi-arrow-repeat me-2"></i>Regeneration
            </h5>
            <div class="row g-3">
                <div class="col-md-4">
                    <label class="form-label text-secondary">Health Regen (%/s)</label>
                    <input type="number" step="0.01" name="regen_data[health_regen_pct]"
                           class="form-control"
                           value="{{ old('regen_data.health_regen_pct', $regenRow?->health_regen_pct ?? '') }}"
                           placeholder="0.00">
                </div>
                <div class="col-md-4">
                    <label class="form-label text-secondary">Charge Regen (%/s)</label>
                    <input type="number" step="0.01" name="regen_data[charge_regen_pct]"
                           class="form-control"
                           value="{{ old('regen_data.charge_regen_pct', $regenRow?->charge_regen_pct ?? '') }}"
                           placeholder="0.00">
                </div>
            </div>
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-ku fw-bold px-4">
                <i class="bi bi-floppy-fill me-1"></i>Save Changes
            </button>
            <a href="{{ route('admin.kaijus.index') }}" class="btn btn-outline-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
function attacksManager() {
    return {
        attacks: @json($kaiju->attacks->map(fn($a) => ['name' => $a->name, 'damage' => $a->damage, 'description' => $a->description])),
        init() {},
        addAttack() {
            this.attacks.push({ name: '', damage: '', description: '' });
        },
        removeAttack(idx) {
            this.attacks.splice(idx, 1);
        }
    };
}
</script>
@endpush
