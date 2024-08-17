<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Services\ViaCep\ViaCepService;
use Illuminate\Console\Command;

class Playground extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:playground';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(ViaCepService $viaCep)
    {
        // dd($viaCep->zipCode()->getAddressByZipCode('68455742'));
        // $users = User::factory()->count(5)->create();

        // dd(ViaCep::zipCode()->getAddressByZipCode('68455742'));
    }
}
