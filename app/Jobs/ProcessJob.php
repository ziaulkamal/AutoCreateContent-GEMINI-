<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Job as JobModel;

class ProcessJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $jobModel;

    /**
     * Create a new job instance.
     *
     * @param  \App\Models\Job  $jobModel
     * @return void
     */
    public function __construct(JobModel $jobModel)
    {
        $this->jobModel = $jobModel;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // Ambil data dari model job
        $url = $this->jobModel->url;
        $keyword = $this->jobModel->keyword;
        $status = $this->jobModel->status;

        // Implementasikan logika otomatisasi di sini
        // Misalnya, proses URL dengan keyword atau melakukan permintaan HTTP

        // Contoh implementasi sederhana:
        // $response = file_get_contents($url); // Mengambil konten dari URL
        // Log::info("Processing URL: $url with keyword: $keyword");

        // Setelah proses selesai, update status jika diperlukan
        $this->jobModel->update(['status' => true]); // Tandai sebagai diproses
    }
}

