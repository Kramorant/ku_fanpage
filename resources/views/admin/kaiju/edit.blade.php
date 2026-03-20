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

        {{-- ── Health & Regen ──────────────────────────────────────────── --}}
        @php $baseStat = $kaiju->baseStat; @endphp
        <div class="card-ku p-4 rounded-3 mb-4">
            <h5 class="fw-bold mb-3" style="color:var(--ku-accent)">
                <i class="bi bi-heart-fill me-2"></i>Health &amp; Regen
            </h5>
            <div class="row g-3">
                <div class="col-md-3">
                    <label class="form-label text-secondary">Health Min</label>
                    <input type="number" step="0.01" name="health_min" class="form-control"
                           value="{{ old('health_min', $baseStat?->health_min ?? 0) }}" placeholder="0.00">
                </div>
                <div class="col-md-3">
                    <label class="form-label text-secondary">Health Max</label>
                    <input type="number" step="0.01" name="health_max" class="form-control"
                           value="{{ old('health_max', $baseStat?->health_max ?? 0) }}" placeholder="0.00">
                </div>
                <div class="col-md-3">
                    <label class="form-label text-secondary">Regen Min (%)</label>
                    <input type="number" step="0.01" name="regen_min" class="form-control"
                           value="{{ old('regen_min', $baseStat?->regen_min ?? 0) }}" placeholder="0.00">
                </div>
                <div class="col-md-3">
                    <label class="form-label text-secondary">Regen Max (%)</label>
                    <input type="number" step="0.01" name="regen_max" class="form-control"
                           value="{{ old('regen_max', $baseStat?->regen_max ?? 0) }}" placeholder="0.00">
                </div>
            </div>
        </div>

        {{-- ── Attacks ──────────────────────────────────────────────────── --}}
        <div class="card-ku p-4 rounded-3 mb-4" id="attacksSection">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <h5 class="fw-bold mb-0" style="color:var(--ku-accent)">
                    <i class="bi bi-lightning-fill me-2"></i>Attacks
                </h5>
                <button type="button" class="btn btn-ku btn-sm" onclick="addAttackRow()">
                    <i class="bi bi-plus-lg me-1"></i>Add Attack
                </button>
            </div>
            <div id="attackRows">
                @foreach($kaiju->attacks as $idx => $attack)
                <div class="row g-2 mb-3 align-items-end p-2 rounded-2"
                     style="background:#252525; border:1px solid #3a3a3a">
                    <div class="col-md-3">
                        <label class="form-label text-secondary small">Attack Name</label>
                        <input type="text" name="attacks[{{ $idx }}][name]"
                               class="form-control" value="{{ $attack->name }}" required>
                    </div>
                    <div class="col-md-1">
                        <label class="form-label text-secondary small">DMG Min</label>
                        <input type="number" step="0.01" name="attacks[{{ $idx }}][damage_min]"
                               class="form-control" value="{{ $attack->damage_min }}" placeholder="0.00">
                    </div>
                    <div class="col-md-1">
                        <label class="form-label text-secondary small">DMG Max</label>
                        <input type="number" step="0.01" name="attacks[{{ $idx }}][damage_max]"
                               class="form-control" value="{{ $attack->damage_max }}" placeholder="0.00">
                    </div>
                    <div class="col-md-1">
                        <label class="form-label text-secondary small">Cooldown (s)</label>
                        <input type="number" step="0.01" name="attacks[{{ $idx }}][cooldown]"
                               class="form-control" value="{{ $attack->cooldown }}" placeholder="0.00">
                    </div>
                    <div class="col-md-1">
                        <label class="form-label text-secondary small">Charge</label>
                        <input type="number" step="0.01" name="attacks[{{ $idx }}][charge_cost]"
                               class="form-control" value="{{ $attack->charge_cost }}" placeholder="0.00">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label text-secondary small">Description</label>
                        <input type="text" name="attacks[{{ $idx }}][description]"
                               class="form-control" value="{{ $attack->description }}">
                    </div>
                    <div class="col-md-1 text-end">
                        <button type="button" class="btn btn-outline-danger btn-sm"
                                onclick="this.closest('.row').remove(); checkEmpty();" title="Remove">
                            <i class="bi bi-trash"></i>
                        </button>
                    </div>
                </div>
                @endforeach
            </div>
            <p id="noAttacksMsg" class="text-secondary fst-italic mb-0"
               style="{{ $kaiju->attacks->isNotEmpty() ? 'display:none' : '' }}">
                No attacks yet. Click "Add Attack" to add one.
            </p>
        </div>

        {{-- ── Movement Speeds ──────────────────────────────────────────── --}}
        @php $speedRow = $kaiju->speeds->first(); @endphp
        <div class="card-ku p-4 rounded-3 mb-4">
            <h5 class="fw-bold mb-3" style="color:var(--ku-accent)">
                <i class="bi bi-wind me-2"></i>Movement Speeds
            </h5>
            @foreach([
                ['key' => 'walking',   'label' => 'Walking'],
                ['key' => 'sprinting', 'label' => 'Sprinting'],
                ['key' => 'swimming',  'label' => 'Swimming'],
            ] as $sp)
            <div class="row g-2 mb-2">
                <div class="col-md-2 d-flex align-items-end pb-1">
                    <span class="text-secondary">{{ $sp['label'] }}</span>
                </div>
                <div class="col-md-4">
                    <label class="form-label text-secondary small">Min (u/s)</label>
                    <input type="number" step="0.01" name="speed[{{ $sp['key'] }}_min]"
                           class="form-control"
                           value="{{ old("speed.{$sp['key']}_min", $speedRow?->{$sp['key'].'_min'} ?? 0) }}"
                           placeholder="0.00">
                </div>
                <div class="col-md-4">
                    <label class="form-label text-secondary small">Max (u/s)</label>
                    <input type="number" step="0.01" name="speed[{{ $sp['key'] }}_max]"
                           class="form-control"
                           value="{{ old("speed.{$sp['key']}_max", $speedRow?->{$sp['key'].'_max'} ?? 0) }}"
                           placeholder="0.00">
                </div>
            </div>
            @endforeach
            <div class="row g-2 mb-2">
                <div class="col-md-2 d-flex align-items-end pb-1">
                    <span class="text-secondary">Flying <small class="text-muted">(optional)</small></span>
                </div>
                <div class="col-md-4">
                    <label class="form-label text-secondary small">Min (u/s)</label>
                    <input type="number" step="0.01" name="speed[flying_min]"
                           class="form-control"
                           value="{{ old('speed.flying_min', $speedRow?->flying_min) }}"
                           placeholder="Leave blank if can't fly">
                </div>
                <div class="col-md-4">
                    <label class="form-label text-secondary small">Max (u/s)</label>
                    <input type="number" step="0.01" name="speed[flying_max]"
                           class="form-control"
                           value="{{ old('speed.flying_max', $speedRow?->flying_max) }}"
                           placeholder="Leave blank if can't fly">
                </div>
            </div>
        </div>

        {{-- ── Titles ──────────────────────────────────────────────── --}}
        <div class="card-ku p-4 rounded-3 mb-4">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <h5 class="fw-bold mb-0" style="color:var(--ku-accent)">
                    <i class="bi bi-trophy-fill me-2"></i>Titles
                </h5>
                <button type="button" class="btn btn-ku btn-sm" onclick="addTitleRow()">
                    <i class="bi bi-plus-lg me-1"></i>Add Title
                </button>
            </div>
            <div id="titleRows">
                @foreach($kaiju->titles as $idx => $title)
                <div class="row g-2 mb-3 align-items-end p-2 rounded-2"
                     style="background:#252525; border:1px solid #3a3a3a">
                    <div class="col-md-4">
                        <label class="form-label text-secondary small">Title Name</label>
                        <input type="text" name="titles[{{ $idx }}][name]"
                               class="form-control" value="{{ $title->name }}" required>
                    </div>
                    <div class="col-md-7">
                        <label class="form-label text-secondary small">Unlock Requirement</label>
                        <input type="text" name="titles[{{ $idx }}][requirement]"
                               class="form-control" value="{{ $title->requirement }}"
                               placeholder="How to unlock this title...">
                    </div>
                    <div class="col-md-1 text-end">
                        <button type="button" class="btn btn-outline-danger btn-sm"
                                onclick="this.closest('.row').remove(); checkTitlesEmpty();" title="Remove">
                            <i class="bi bi-trash"></i>
                        </button>
                    </div>
                </div>
                @endforeach
            </div>
            <p id="noTitlesMsg" class="text-secondary fst-italic mb-0"
               style="{{ $kaiju->titles->isNotEmpty() ? 'display:none' : '' }}">
                No titles yet. Click "Add Title" to add one.
            </p>
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
    let attackIndex = {{ $kaiju->attacks->count() }};

    function addAttackRow() {
        document.getElementById('noAttacksMsg').style.display = 'none';
        const idx = attackIndex++;
        const row = document.createElement('div');
        row.className = 'row g-2 mb-3 align-items-end p-2 rounded-2';
        row.style.cssText = 'background:#252525; border:1px solid #3a3a3a';
        row.innerHTML = `
            <div class="col-md-3">
                <label class="form-label text-secondary small">Attack Name</label>
                <input type="text" name="attacks[${idx}][name]" class="form-control" required>
            </div>
            <div class="col-md-1">
                <label class="form-label text-secondary small">DMG Min</label>
                <input type="number" step="0.01" name="attacks[${idx}][damage_min]" class="form-control" placeholder="0.00">
            </div>
            <div class="col-md-1">
                <label class="form-label text-secondary small">DMG Max</label>
                <input type="number" step="0.01" name="attacks[${idx}][damage_max]" class="form-control" placeholder="0.00">
            </div>
            <div class="col-md-1">
                <label class="form-label text-secondary small">Cooldown (s)</label>
                <input type="number" step="0.01" name="attacks[${idx}][cooldown]" class="form-control" placeholder="0.00">
            </div>
            <div class="col-md-1">
                <label class="form-label text-secondary small">Charge</label>
                <input type="number" step="0.01" name="attacks[${idx}][charge_cost]" class="form-control" placeholder="0.00">
            </div>
            <div class="col-md-4">
                <label class="form-label text-secondary small">Description</label>
                <input type="text" name="attacks[${idx}][description]" class="form-control">
            </div>
            <div class="col-md-1 text-end">
                <button type="button" class="btn btn-outline-danger btn-sm" onclick="this.closest('.row').remove(); checkEmpty();" title="Remove">
                    <i class="bi bi-trash"></i>
                </button>
            </div>`;
        document.getElementById('attackRows').appendChild(row);
    }

    function checkEmpty() {
        const rows = document.getElementById('attackRows').querySelectorAll('.row');
        document.getElementById('noAttacksMsg').style.display = rows.length === 0 ? '' : 'none';
    }

    let titleIndex = {{ $kaiju->titles->count() }};

    function addTitleRow() {
        document.getElementById('noTitlesMsg').style.display = 'none';
        const idx = titleIndex++;
        const row = document.createElement('div');
        row.className = 'row g-2 mb-3 align-items-end p-2 rounded-2';
        row.style.cssText = 'background:#252525; border:1px solid #3a3a3a';
        row.innerHTML = `
            <div class="col-md-4">
                <label class="form-label text-secondary small">Title Name</label>
                <input type="text" name="titles[${idx}][name]" class="form-control" required>
            </div>
            <div class="col-md-7">
                <label class="form-label text-secondary small">Unlock Requirement</label>
                <input type="text" name="titles[${idx}][requirement]" class="form-control" placeholder="How to unlock this title...">
            </div>
            <div class="col-md-1 text-end">
                <button type="button" class="btn btn-outline-danger btn-sm" onclick="this.closest('.row').remove(); checkTitlesEmpty();" title="Remove">
                    <i class="bi bi-trash"></i>
                </button>
            </div>`;
        document.getElementById('titleRows').appendChild(row);
    }

    function checkTitlesEmpty() {
        const rows = document.getElementById('titleRows').querySelectorAll('.row');
        document.getElementById('noTitlesMsg').style.display = rows.length === 0 ? '' : 'none';
    }
</script>
@endpush
