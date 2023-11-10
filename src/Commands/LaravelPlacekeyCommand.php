<?php

namespace Realtydev\LaravelPlacekey\Commands;

use Illuminate\Console\Command;

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
                case 'get':
                    $response = Placekey::getPlacekey($parameters);
                    break;
                case 'query':
                    $response = Placekey::getPlacekeyWithQueryId($parameters);
                    break;
                case 'address':
                    $response = Placekey::getPlacekeyForAddress($parameters);
                    break;
                case 'lineage':
                    $response = Placekey::getActivePlacekeyAndPredecessors($parameters);
                    break;
                default:
                    $this->error('Invalid action. Valid actions are get, query, address, lineage.');
                    return;
            }

            $this->info('Response from Placekey API:');
            $this->line(json_encode($response, JSON_PRETTY_PRINT));
        } catch (\Exception $e) {
            $this->error('Error interacting with Placekey API: ' . $e->getMessage());
        }
    }
}
