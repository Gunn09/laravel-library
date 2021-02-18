<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Spatie\PdfToImage\Pdf;
use Illuminate\Support\Facades\File;

class ProcessBook implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $name;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $pdf = new Pdf('images/'. $this->name);
        $pdf->saveImage('images/');
        // dd("done");
        // $imagick = new Imagick();
        // $imagick->readImage(public_path('images/PHP Objects, Patterns, and Practice - Fifth Edition.pdf'));
        // $imagick->writeImages(public_path('images/1.jpg', true));
        
        File::move('images/1.jpg', 'images/'.$this->name.'.jpg');
    }
}
