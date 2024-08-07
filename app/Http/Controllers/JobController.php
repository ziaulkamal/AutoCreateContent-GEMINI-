<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ContentController;
use App\Jobs\ProcessJob;
use App\Models\Job;
use Illuminate\Http\Request;

class JobController extends ContentController
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validasi request
        $request->validate([
            'keyword' => 'required|string',
            'url' => 'required|url',
            'status' => 'nullable|boolean', // Status optional dan default-nya false
        ]);

           // Cek apakah keyword sudah ada
        $existingJob = Job::where('keyword', $request->input('keyword'))->first();

        if ($existingJob) {
            // Jika keyword sudah ada, kembalikan response yang sesuai
            return response()->json(['message' => 'Keyword already exists.'], 400);
        }

        // Simpan data ke database jika keyword belum ada
        $job = Job::firstOrCreate([
            'keyword' => $request->input('keyword'),
            'url' => $request->input('url'),
            'status' => $request->input('status', false),
        ]);

        // Dispatch job untuk proses otomatisasi
        // ProcessJob::dispatch($job);

        return response()->json(['message' => 'Job created and dispatched.']);
    }

    public function renderKeywords() {
        $data = Job::where('status', true)
            ->orderBy('id', 'asc')
            ->first();

        $this->generate($query);
        $data->status = false;
        $data->save();
        return false;
    }
}
