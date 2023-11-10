<?php

namespace Realtydev\LaravelPlacekey\Commands;

use Illuminate\Console\Command;
use Realtydev\LaravelPlacekey\Services\PlacekeyService;

class LaravelPlacekeyCommand extends Command
{
    /**
     * The name and signature of the console command.x
     *
     * @var string
     */
    protected $signature = 'placekey:interact {action} {parameters*}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Interact with the Placekey API';

    protected $service;

    public function __construct(PlacekeyService $service)
    {
        parent::__construct();
        $this->service = $service;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $action = $this->argument('action');
        $parameters = $this->argument('parameters');

        try {
            switch ($action) {

                case 'coordinates':
                    if (is_array($parameters) && count($parameters) >= 2 && count($parameters) <= 5) {
                        $response = $this->service->getPlacekeyForCoordinates(...$parameters);
                    } else {
                        $this->error('Invalid parameters. The address action requires between 2 to 5 parameters.');

                        return;
                    }
                    break;
                case 'address':
                    if (is_array($parameters) && count($parameters) >= 2 && count($parameters) <= 5) {
                        $response = $this->service->getPlacekeyForAddress(...$parameters);
                    } else {
                        $this->error('Invalid parameters. The address action requires between 2 to 5 parameters.');

                        return;
                    }
                    break;
                case 'lineage':
                    if (is_array($parameters) && count($parameters) >= 2 && count($parameters) <= 5) {
                        $response = $this->service->getActivePlacekeyAndPredecessors(...$parameters);
                    } else {
                        $this->error('Invalid parameters. The address action requires between 2 to 5 parameters.');

                        return;
                    }
                    break;
                default:
                    $this->error('Invalid action. Valid actions are get, query, address, lineage.');

                    return;
            }

            $this->info('Response from Placekey API:');
            $this->line(json_encode($response, JSON_PRETTY_PRINT));
        } catch (\Exception $e) {
            $this->error('Error interacting with Placekey API: '.$e->getMessage());
        }
    }
}
