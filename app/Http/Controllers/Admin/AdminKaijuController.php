<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kaiju;
use App\Models\KaijuAttack;
use App\Models\KaijuBaseStat;
use App\Models\KaijuSpeed;
use App\Models\KaijuBuildLevel;
use App\Models\KaijuTitle;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class AdminKaijuController extends Controller
{
    public function index(): View
    {
        $kaijus = Kaiju::orderBy('name')->get();

        return view('admin.kaiju.index', compact('kaijus'));
    }

    public function create(): View
    {
        return view('admin.kaiju.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name'                    => ['required', 'string', 'max:255'],
            'slug'                    => ['required', 'string', 'max:255', 'unique:kaijus,slug'],
            'description'             => ['nullable', 'string'],
            'image'                   => ['nullable', 'image', 'max:4096'],
            'attacks.*.cooldown'      => ['nullable', 'numeric', 'min:0'],
            'attacks.*.charge_cost'   => ['nullable', 'numeric', 'min:0'],
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('kaijus', 'public');
        }

        $kaiju = Kaiju::create($validated);

        $this->syncRelations($request, $kaiju);

        return redirect()->route('admin.kaijus.edit', $kaiju)->with('success', 'Kaiju created.');
    }

    public function edit(Kaiju $kaiju): View
    {
        $kaiju->load(['baseStat', 'attacks', 'speeds', 'titles', 'buildLevels']);

        return view('admin.kaiju.edit', compact('kaiju'));
    }

    public function update(Request $request, Kaiju $kaiju): RedirectResponse
    {
        $validated = $request->validate([
            'name'                    => ['required', 'string', 'max:255'],
            'slug'                    => ['required', 'string', 'max:255', 'unique:kaijus,slug,' . $kaiju->id],
            'description'             => ['nullable', 'string'],
            'image'                   => ['nullable', 'image', 'max:4096'],
            'attacks.*.cooldown'      => ['nullable', 'numeric', 'min:0'],
            'attacks.*.charge_cost'   => ['nullable', 'numeric', 'min:0'],
        ]);

        if ($request->hasFile('image')) {
            if ($kaiju->image) {
                Storage::disk('public')->delete($kaiju->image);
            }
            $validated['image'] = $request->file('image')->store('kaijus', 'public');
        }

        $kaiju->update($validated);

        $this->syncRelations($request, $kaiju);

        return redirect()->route('admin.kaijus.edit', $kaiju)->with('success', 'Kaiju updated.');
    }

    public function destroy(Kaiju $kaiju): RedirectResponse
    {
        if ($kaiju->image) {
            Storage::disk('public')->delete($kaiju->image);
        }
        $kaiju->delete();

        return redirect()->route('admin.kaijus.index')->with('success', 'Kaiju deleted.');
    }

    private function syncRelations(Request $request, Kaiju $kaiju): void
    {
        // Base Stats (health & regen)
        KaijuBaseStat::updateOrCreate(
            ['kaiju_id' => $kaiju->id],
            [
                'health_min' => $request->input('health_min', 0),
                'health_max' => $request->input('health_max', 0),
                'regen_min'  => $request->input('regen_min', 0),
                'regen_max'  => $request->input('regen_max', 0),
            ]
        );

        // Attacks — delete all then recreate
        $kaiju->attacks()->delete();
        foreach ($request->input('attacks', []) as $idx => $atk) {
            if (empty($atk['name'])) {
                continue;
            }
            KaijuAttack::create([
                'kaiju_id'    => $kaiju->id,
                'name'        => $atk['name'],
                'damage_min'  => $atk['damage_min'] ?? 0,
                'damage_max'  => $atk['damage_max'] ?? 0,
                'cooldown'    => isset($atk['cooldown']) && $atk['cooldown'] !== '' ? $atk['cooldown'] : null,
                'charge_cost' => isset($atk['charge_cost']) && $atk['charge_cost'] !== '' ? $atk['charge_cost'] : null,
                'description' => $atk['description'] ?? '',
                'order'       => $idx,
            ]);
        }

        // Titles — delete all then recreate
        $kaiju->titles()->delete();
        foreach ($request->input('titles', []) as $idx => $title) {
            if (empty($title['name'])) continue;
            KaijuTitle::create([
                'kaiju_id'    => $kaiju->id,
                'name'        => $title['name'],
                'requirement' => $title['requirement'] ?? null,
                'order'       => $idx,
            ]);
        }

        // Speed
        KaijuSpeed::updateOrCreate(
            ['kaiju_id' => $kaiju->id],
            [
                'walking_min'   => $request->input('speed.walking_min', 0),
                'walking_max'   => $request->input('speed.walking_max', 0),
                'sprinting_min' => $request->input('speed.sprinting_min', 0),
                'sprinting_max' => $request->input('speed.sprinting_max', 0),
                'swimming_min'  => $request->input('speed.swimming_min', 0),
                'swimming_max'  => $request->input('speed.swimming_max', 0),
                'flying_min'    => $request->input('speed.flying_min') !== '' ? $request->input('speed.flying_min') : null,
                'flying_max'    => $request->input('speed.flying_max') !== '' ? $request->input('speed.flying_max') : null,
            ]
        );

        // Build Levels — upsert all 11 levels (0-10)
        foreach ($request->input('build', []) as $level => $vals) {
            KaijuBuildLevel::updateOrCreate(
                ['kaiju_id' => $kaiju->id, 'level' => (int)$level],
                [
                    'damage_multiplier' => isset($vals['damage_multiplier']) && $vals['damage_multiplier'] !== '' ? $vals['damage_multiplier'] : 1.0,
                    'walking'           => isset($vals['walking'])      && $vals['walking']      !== '' ? $vals['walking']      : null,
                    'sprinting'         => isset($vals['sprinting'])    && $vals['sprinting']    !== '' ? $vals['sprinting']    : null,
                    'swimming'          => isset($vals['swimming'])     && $vals['swimming']     !== '' ? $vals['swimming']     : null,
                    'flying'            => isset($vals['flying'])       && $vals['flying']       !== '' ? $vals['flying']       : null,
                    'health'            => isset($vals['health'])       && $vals['health']       !== '' ? $vals['health']       : null,
                    'health_regen'      => isset($vals['health_regen']) && $vals['health_regen'] !== '' ? $vals['health_regen'] : null,
                    'charge_regen'      => isset($vals['charge_regen']) && $vals['charge_regen'] !== '' ? $vals['charge_regen'] : null,
                ]
            );
        }
    }
}
