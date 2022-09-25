<?php

namespace App\Console\Commands;

use App\Services\AdvertiserService;
use Illuminate\Console\Command;

class NotifyAdvertisers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'advertisers:notify';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Notify advertisers who have ads the next day as a remainder.';

    private AdvertiserService $advertiserService;

    public function __construct(AdvertiserService $advertiserService)
    {
        parent::__construct();
        $this->advertiserService = $advertiserService;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        $this->advertiserService->notifyAdvertisersWithUpcomingAds();
    }
}
