<?php

namespace App\Commands;

use App\Models\Queue;
use T4\Console\Command;
use T4\Mail\Sender;
use T4\Mvc\Application;
use T4\Mvc\View;
use T4\Core\Config;

class Mail
    extends Command
{
    public function actionSend()
    {
        $queue = Queue::find([
            'where'  => 'status = :status',
            'order'  => '__id ',
            'limit'  => '1',
            'params' => [':status' => Queue::STATUSES['NEW']]
        ]);

        if(empty($queue))
            exit(0);

        $mailer = new Sender();
        $view = new View('twig', ROOT_PATH_PROTECTED . '/Layouts/Mail/');

        if (false == $mailer->sendMail(
                [$queue->user->email, $queue->user->fullName],
                'Рассылка от ' . $this->app->config->domain,
                $view->render(Queue::TEMPLATES[$queue->template], json_decode($queue->content))
            )
        ) {
            $queue->status = Queue::STATUSES['ERROR'];
        } else {
            $queue->status = Queue::STATUSES['SENT'];
        };

        $queue->save();
    }
}
