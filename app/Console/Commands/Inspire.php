<?php

namespace App\Console\Commands;

use Illuminate\Support\Facades\DB;
use Illuminate\Console\Command;
use Illuminate\Foundation\Inspiring;
use App\Models\SendStatus;
use App\Models\Review;
use App\User;
use Mail;
use App\Services\PayUService\Exception;

class Inspire extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'inspire';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Display an inspiring quote';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $statuses = SendStatus::where('status', 'waiting')->orderBy('id', 'ASC')->limit(10)->get();

        foreach ($statuses as $key => $status) {

            SendStatus::where('id', $status->id)->update([
                'status' => 'panding',
            ]);

            $review = Review::find($status->review_id);

            $user = User::find($status->user_id);
            if ($user && $review) {
                $data = array(
                    'email' => $user->email,
                    'name' => $user->name,
                    'review' => $review->review,
                    'phone' => $review->phone,
                    'client' => $review->client
                );

                // file_put_contents(__DIR__ . 'aal.txt', json_encode($data));

                try {
                    $res = Mail::send('emails.alert', ['data' => $data], function ($m) use ($data) {
                        $m->from('bortsov-dev@mail.ru', 'Black/White List');

                        $m->to($data['email'], $data['name'])->subject('Restore password');
                    });
                }
                catch (\Exception $e) {
                    $res = 0;
                }


                if ($res) {
                    SendStatus::where('id', $status->id)->update([
                        'status' => 'send'
                    ]);
                } else {
                    SendStatus::where('id', $status->id)->update([
                        'status' => 'error'
                    ]);
                }
            } else {
                 SendStatus::where('id', $status->id)->update([
                    'status' => 'error'
                ]); 
            }


        //$this->comment(PHP_EOL.Inspiring::quote().PHP_EOL);
        }
    }
}
