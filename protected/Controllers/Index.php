<?php

namespace App\Controllers;

use App\Models\Queue;
use App\Models\User;
use T4\Mvc\Controller;

class Index
    extends Controller
{

    public function actionDefault()
    {
        $data = json_decode(file_get_contents('php://input'));

        if (empty(User::findByPK($data->user))) {
            header('HTTP/1.1 404 User Not Found');
            exit(0);
        }
        if (empty(Queue::TEMPLATES[$data->template])) {
            header('HTTP/1.1 404 Mail Template Not Found');
            exit(0);
        }

        $queue = new Queue();
        $queue->fill($data);
        $queue->content = json_encode($queue->content, JSON_UNESCAPED_UNICODE);
        $queue->status = Queue::STATUSES['NEW'];
        $queue->save();

        echo json_encode(['queue number' => $queue->Pk]);
        exit(0);
    }

    public function actionStatus(int $id)
    {
        $queue = Queue::findByPK($id);
        if (empty($queue)) {
            header('HTTP/1.1 404 Not Found');
            exit(0);
        }
        echo json_encode(['queue status' => Queue::findByPK($id)->getStatusTitle()]);
        exit(0);
    }

}