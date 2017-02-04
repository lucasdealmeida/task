<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Tasks Controller
 *
 * @property \App\Model\Table\TasksTable $Tasks
 */
class TasksController extends AppController
{

    public $components = array('RequestHandler');

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        if (isset($this->request->query['type'])){
            $this->set('tasks', $this->Tasks->find('all')->where(['priority =' => 1]));
        }else{
            $this->set('tasks', $this->Tasks->find('all'));
        }
    }

    /**
     * View method
     *
     * @param string|null $id Task id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $this->set('task', $this->Tasks->get($id));
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $task = $this->Tasks->newEntity($this->request->data);
        $return = [];
        if ($task->errors()){
            $return = [
                'error' => true,
                'errors' => $task->errors(),
                '_serialize' => ['errors', 'error']
            ];
        }else{
            if ($this->Tasks->save($task)) {
                $error = false;
            } else {
                $error = true;
            }
            $return = [
                'error' => $error,
                'task' => $task,
                '_serialize' => ['error', 'task']
            ];
        }
        $this->set($return);
    }

    /**
     * Edit method
     *
     * @param string|null $id Task id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $return = [];
        $task = $this->Tasks->patchEntity($this->Tasks->get($id), $this->request->data);
        if ($task->errors()){
            $return = [
                'error' => true,
                'errors' => $task->errors(),
                '_serialize' => ['errors', 'error']
            ];
        }else{
            if ($this->Tasks->save($task)) {
                $error = false;
            } else {
                $error = true;
            }
            $return = [
                'error' => $error,
                'task' => $task,
                '_serialize' => ['error', 'task']
            ];
        }
        $this->set($return);
    }

    /**
     * Delete method
     *
     * @param string|null $id Task id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $task = $this->Tasks->get($id);
        $error = true;
        if ($this->Tasks->delete($task)){
            $error = false;
        }
        $this->set([
            'error' => $error,
            '_serialize' => ['error']
        ]);
    }

    public function cors(){
        $this->response->cors($this->request)
            ->allowOrigin(['*'])
            ->allowMethods(['GET', 'POST'])
            ->allowHeaders(['X-CSRF-Token'])
            ->maxAge(300)
            ->build();
    }
}
