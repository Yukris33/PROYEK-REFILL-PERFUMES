<?php

namespace App\Http\Controllers;

use App\Models\BottleReturn;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BottleReturnController extends Controller
{
    public function show()
    {
        return view('return-botol');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'machine_location' => ['required', 'string', 'max:150'],
            'bottle_sizes' => ['required', 'array', 'min:1', 'max:3'],
            'bottle_sizes.*' => ['required', 'integer', 'in:20,30,50,100'],
        ]);

        $pointMap = [
            20 => 8,
            30 => 12,
            50 => 15,
            100 => 23,
        ];

        $sizes = array_map('intval', $validated['bottle_sizes']);

        $estimatedPoints = collect($sizes)->sum(function ($size) use ($pointMap) {
            return $pointMap[$size] ?? 0;
        });

        $return = DB::transaction(function () use ($validated, $sizes, $pointMap, $estimatedPoints) {
            $return = BottleReturn::create([
                'user_id' => Auth::id(),
                'return_code' => $this->generateReturnCode(),
                'machine_location' => $validated['machine_location'],
                'total_bottles' => count($sizes),
                'estimated_points' => $estimatedPoints,
                'awarded_points' => 0,
                'status' => 'pending',
                'notes' => 'Return request dibuat dari website. Menunggu QR discan dan validasi mesin.',
            ]);

            foreach ($sizes as $size) {
                $return->items()->create([
                    'bottle_size_ml' => $size,
                    'points' => $pointMap[$size],
                    'condition_status' => 'pending',
                    'sensor_status' => 'waiting',
                    'notes' => null,
                ]);
            }

            return $return;
        });

        return redirect()
            ->route('return.botol.status', $return->return_code)
            ->with('success', 'QR return berhasil dibuat. Status return masih pending.');
    }

    public function status($returnCode)
    {
        $return = BottleReturn::with('items')
            ->where('return_code', $returnCode)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        return view('return-botol-status', compact('return'));
    }

    public function markSuccess($returnCode)
    {
        $return = BottleReturn::with(['items', 'user'])
            ->where('return_code', $returnCode)
            ->firstOrFail();

        DB::transaction(function () use ($return) {
            /*
             * Kalau sudah success, jangan tambah poin lagi.
             * Ini mencegah double poin kalau tombol kepencet dua kali.
             */
            if ($return->status === 'success') {
                return;
            }

            $return->items()->update([
                'condition_status' => 'valid',
                'sensor_status' => 'detected',
                'updated_at' => now(),
            ]);

            $return->update([
                'status' => 'success',
                'awarded_points' => $return->estimated_points,
                'received_at' => $return->received_at ?? now(),
                'validated_at' => now(),
                'points_awarded_at' => now(),
                'notes' => 'Return berhasil. Botol valid dan poin sudah masuk ke akun user.',
            ]);

            $return->user->increment('points_balance', $return->estimated_points);

            DB::table('point_transactions')->insert([
                'user_id' => $return->user_id,
                'order_id' => null,
                'type' => 'bonus',
                'points' => $return->estimated_points,
                'description' => 'Bottle return reward ' . $return->return_code,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        });

        return back()->with('success', 'Return berhasil. Status success dan poin sudah masuk ke akun.');
    }

    public function markFailed($returnCode)
    {
        $return = BottleReturn::with('items')
            ->where('return_code', $returnCode)
            ->firstOrFail();

        DB::transaction(function () use ($return) {
            /*
             * Kalau sebelumnya sudah success, jangan boleh digagalkan dari flow ini,
             * karena poin sudah masuk.
             */
            if ($return->status === 'success') {
                return;
            }

            $return->items()->update([
                'condition_status' => 'invalid',
                'sensor_status' => 'not_detected',
                'updated_at' => now(),
            ]);

            $return->update([
                'status' => 'failed',
                'awarded_points' => 0,
                'validated_at' => now(),
                'points_awarded_at' => null,
                'notes' => 'Return gagal. Botol tidak valid atau tidak lolos sensor/quality check.',
            ]);
        });

        return back()->with('error', 'Return gagal. Status failed dan poin tidak masuk.');
    }

    private function generateReturnCode()
    {
        do {
            $code = 'RTN-SCENT-' . strtoupper(Str::random(6));
        } while (BottleReturn::where('return_code', $code)->exists());

        return $code;
    }
}