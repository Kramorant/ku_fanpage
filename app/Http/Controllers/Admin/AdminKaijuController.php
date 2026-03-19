<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kaiju;
use App\Models\KaijuAttack;
use App\Models\KaijuRegen;
use App\Models\KaijuSpeed;
use App\Models\KaijuStat;
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
            'name'        => ['required', 'string', 'max:255'],
            'slug'        => ['required', 'string', 'max:255', 'unique:kaijus,slug'],
            'description' => ['nullable', 'string'],
            'image'       => ['nullable', 'image', 'max:4096'],
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
        $kaiju->load(['stats', 'attacks', 'speeds', 'regen']);

        return view('admin.kaiju.edit', compact('kaiju'));
    }

    public function update(Request $request, Kaiju $kaiju): RedirectResponse
    {
        $validated = $request->validate([
            'name'        => ['required', 'string', 'max:255'],
            'slug'        => ['required', 'string', 'max:255', 'unique:kaijus,slug,' . $kaiju->id],
            'description' => ['nullable', 'string'],
            'image'       => ['nullable', 'image', 'max:4096'],
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
        // Stats
        foreach (['strength', 'speed', 'health', 'regen'] as $type) {
            $statData = $request->input("stats.{$type}", []);
            $stat = $kaiju->stats()->firstOrNew(['stat_type' => $type]);
            $stat->current_level = $statData['current_level'] ?? 0;
            for ($i = 1; $i <= 10; $i++) {
                $stat->{"val_{$i}"} = $statData["val_{$i}"] ?? null;
            }
            $stat->kaiju_id = $kaiju->id;
            $stat->save();
        }

        // Attacks — delete all then recreate
        $kaiju->attacks()->delete();
        foreach ($request->input('attacks', []) as $idx => $atk) {
            if (empty($atk['name'])) {
                continue;
            }
            KaijuAttack::create([
                'kaiju_id'    => $kaiju->id,
                'name'        => $atk['name'],
                'damage'      => $atk['damage'] ?? 0,
                'description' => $atk['description'] ?? '',
                'order'       => $idx,
            ]);
        }

        // Speed
        $speedData = $request->input('speed', []);
        $speed = $kaiju->speeds()->firstOrNew([]);
        $speed->kaiju_id        = $kaiju->id;
        $speed->walking_speed   = $speedData['walking_speed'] ?? 0;
        $speed->sprinting_speed = $speedData['sprinting_speed'] ?? 0;
        $speed->swimming_speed  = $speedData['swimming_speed'] ?? 0;
        $speed->save();

        // Regen
        $regenData = $request->input('regen_data', []);
        $regen = $kaiju->regen()->firstOrNew([]);
        $regen->kaiju_id          = $kaiju->id;
        $regen->health_regen_pct  = $regenData['health_regen_pct'] ?? 0;
        $regen->charge_regen_pct  = $regenData['charge_regen_pct'] ?? 0;
        $regen->save();
    }
}
