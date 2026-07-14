<?php
declare(strict_types=1);

namespace App\Controller\Admin;

use App\Controller\AppController;

use AuditStash\Meta\RequestMetadata;
use Cake\Event\EventManager;
use Cake\Routing\Router;

/**
 * Application Controller
 *
 * @property \App\Model\Table\ApplicationTable $Application
 */
class ApplicationController extends AppController
{
	public function initialize(): void
	{
		parent::initialize();

		$this->loadComponent('Search.Search', [
			'actions' => ['index'],
		]);
	}
	
	public function beforeFilter(\Cake\Event\EventInterface $event)
	{
		parent::beforeFilter($event);
	}

	/*public function viewClasses(): array
    {
        return [JsonView::class];
		return [JsonView::class, XmlView::class];
    }*/
	
	public function json()
    {
		$this->viewBuilder()->setLayout('json');
        $this->set('application', $this->paginate());
        $this->viewBuilder()->setOption('serialize', 'application');
    }
	
	public function csv()
	{
		$this->response = $this->response->withDownload('application.csv');
		$application = $this->Application->find();
		$_serialize = 'application';

		$this->viewBuilder()->setClassName('CsvView.Csv');
		$this->set(compact('application', '_serialize'));
	}
	
	public function pdfList()
	{
		$this->viewBuilder()->enableAutoLayout(false); 
        $this->paginate = [
            'contain' => ['Users', 'Programs', 'Faculties'],
			'maxLimit' => 10,
        ];
		$application = $this->paginate($this->Application);
		$this->viewBuilder()->setClassName('CakePdf.Pdf');
		$this->viewBuilder()->setOption(
			'pdfConfig',
			[
				'orientation' => 'portrait',
				'download' => true, 
				'filename' => 'application_List.pdf' 
			]
		);
		$this->set(compact('application'));
	}
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
		$this->set('title', 'Application List');
		$this->paginate = [
			'maxLimit' => 10,
        ];
        $query = $this->Application->find('search', search: $this->request->getQueryParams())
            ->contain(['Users', 'Programs', 'Faculties']);
			//->where(['title IS NOT' => null])
        $application = $this->paginate($query);
		
		//count
		$this->set('total_application', $this->Application->find()->count());
		$this->set('total_application_archived', $this->Application->find()->where(['status' => 2])->count());
		$this->set('total_application_active', $this->Application->find()->where(['status' => 1])->count());
		$this->set('total_application_disabled', $this->Application->find()->where(['status' => 0])->count());
		
		//Count By Month
		$this->set('january', $this->Application->find()->where(['MONTH(created)' => date('1'), 'YEAR(created)' => date('Y')])->count());
		$this->set('february', $this->Application->find()->where(['MONTH(created)' => date('2'), 'YEAR(created)' => date('Y')])->count());
		$this->set('march', $this->Application->find()->where(['MONTH(created)' => date('3'), 'YEAR(created)' => date('Y')])->count());
		$this->set('april', $this->Application->find()->where(['MONTH(created)' => date('4'), 'YEAR(created)' => date('Y')])->count());
		$this->set('may', $this->Application->find()->where(['MONTH(created)' => date('5'), 'YEAR(created)' => date('Y')])->count());
		$this->set('jun', $this->Application->find()->where(['MONTH(created)' => date('6'), 'YEAR(created)' => date('Y')])->count());
		$this->set('july', $this->Application->find()->where(['MONTH(created)' => date('7'), 'YEAR(created)' => date('Y')])->count());
		$this->set('august', $this->Application->find()->where(['MONTH(created)' => date('8'), 'YEAR(created)' => date('Y')])->count());
		$this->set('september', $this->Application->find()->where(['MONTH(created)' => date('9'), 'YEAR(created)' => date('Y')])->count());
		$this->set('october', $this->Application->find()->where(['MONTH(created)' => date('10'), 'YEAR(created)' => date('Y')])->count());
		$this->set('november', $this->Application->find()->where(['MONTH(created)' => date('11'), 'YEAR(created)' => date('Y')])->count());
		$this->set('december', $this->Application->find()->where(['MONTH(created)' => date('12'), 'YEAR(created)' => date('Y')])->count());

		$query = $this->Application->find();

        $expectedMonths = [];
        for ($i = 11; $i >= 0; $i--) {
            $expectedMonths[] = date('M-Y', strtotime("-$i months"));
        }

        $query->select([
            'count' => $query->func()->count('*'),
            'date' => $query->func()->date_format(['created' => 'identifier', "%b-%Y"]),
            'month' => 'MONTH(created)',
            'year' => 'YEAR(created)'
        ])
            ->where([
                'created >=' => date('Y-m-01', strtotime('-11 months')),
                'created <=' => date('Y-m-t')
            ])
            ->groupBy(['year', 'month'])
            ->orderBy(['year' => 'ASC', 'month' => 'ASC']);

        $results = $query->all()->toArray();

        $totalByMonth = [];
        foreach ($expectedMonths as $expectedMonth) {
            $found = false;
            $count = 0;

            foreach ($results as $result) {
                if ($expectedMonth === $result->date) {
                    $found = true;
                    $count = $result->count;
                    break;
                }
            }

            $totalByMonth[] = [
                'month' => $expectedMonth,
                'count' => $count
            ];
        }

        $this->set([
            'results' => $totalByMonth,
            '_serialize' => ['results']
        ]);

        //data as JSON arrays for report chart
        $totalByMonth = json_encode($totalByMonth);
        $dataArray = json_decode($totalByMonth, true);
        $monthArray = [];
        $countArray = [];
        foreach ($dataArray as $data) {
            $monthArray[] = $data['month'];
            $countArray[] = $data['count'];
        }

        $users = $this->Application->Users->find('list', limit: 200)->all();
		$programs = $this->Application->Programs->find('list', limit: 200)->all();
		$faculties = $this->Application->Faculties->find('list', limit: 200)->all();
        $this->set(compact('application', 'users', 'programs', 'faculties','monthArray', 'countArray'));
    }

    /**
     * View method
     *
     * @param string|null $id Application id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
		$this->set('title', 'Application Details');
        $applicationEntity = $this->Application->get($id, contain: ['Users', 'Programs', 'Faculties']);
        // $this->set(compact('applicationEntity'));
        
if ($this->request->is(['patch', 'post', 'put'])) {
            $applicationEntity = $this->Application->patchEntity($applicationEntity, $this->request->getData());
            
            if ($this->Application->save($applicationEntity)) {
                $this->Flash->success(__('The application has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The application could not be saved. Please, try again.'));
        }
		$users = $this->Application->Users->find('list', limit: 200)->all();
		$programs = $this->Application->Programs->find('list', limit: 200)->all();
		$faculties = $this->Application->Faculties->find('list', limit: 200)->all();
        $this->set(compact('applicationEntity', 'users', 'programs', 'faculties'));

       
    }

     public function pdf($id = null)
    {
		$this->viewbuilder()->enableAutoLayout(false);
        $applicationEntity = $this->Application->get($id, contain: ['Users', 'Programs', 'Faculties']);
        $this->viewbuilder()->setClassName('CakePdf.Pdf');
        $this->viewbuilder()->setOption(
            'pdfConfig',
            [
                'orientation' =>'potrait',
                'download'=>true,
                'filename'=>'Application_'.$id.'.pdf'
            ]
        );
        $this->set('applicationEntity',$applicationEntity);

    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
		$this->set('title', 'New Application');
		EventManager::instance()->on('AuditStash.beforeLog', function ($event, array $logs) {
			foreach ($logs as $log) {
				$log->setMetaInfo($log->getMetaInfo() + ['a_name' => 'Add']);
				$log->setMetaInfo($log->getMetaInfo() + ['c_name' => 'Application']);
				$log->setMetaInfo($log->getMetaInfo() + ['ip' => $this->request->clientIp()]);
				$log->setMetaInfo($log->getMetaInfo() + ['url' => Router::url(null, true)]);
				$log->setMetaInfo($log->getMetaInfo() + ['slug' => $this->Authentication->getIdentity('slug')->getIdentifier('slug')]);
			}
		});
        $applicationEntity = $this->Application->newEmptyEntity();
        if ($this->request->is('post')) {
            $applicationEntity = $this->Application->patchEntity($applicationEntity, $this->request->getData());
            $application->user_id = $this->Authentication->getIdentity('id')->getIdentifier('id');
            if ($this->Application->save($applicationEntity)) {
                $this->Flash->success(__('The application has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The application could not be saved. Please, try again.'));
        }
        $users = $this->Application->Users->find('list', ['limit' => 200])->all();
        //$programs = $this->Application->Programs->find('list', ['limit' => 200])->all();
        $programs = $this->Application->Programs->find('list', ['keyfield' =>'id','valueField'=> function($programs)
            {
                return $programs->code .':'. $programs->name;
            }
        ,'limit' => 200])->all();
        $faculties = $this->Application->Faculties->find('list', ['limit' => 200])->all();
        $this->set(compact('applicationEntity', 'users', 'programs', 'faculties'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Application id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
		$this->set('title', 'Application Edit');
		EventManager::instance()->on('AuditStash.beforeLog', function ($event, array $logs) {
			foreach ($logs as $log) {
				$log->setMetaInfo($log->getMetaInfo() + ['a_name' => 'Edit']);
				$log->setMetaInfo($log->getMetaInfo() + ['c_name' => 'Application']);
				$log->setMetaInfo($log->getMetaInfo() + ['ip' => $this->request->clientIp()]);
				$log->setMetaInfo($log->getMetaInfo() + ['url' => Router::url(null, true)]);
				$log->setMetaInfo($log->getMetaInfo() + ['slug' => $this->Authentication->getIdentity('slug')->getIdentifier('slug')]);
			}
		});
        $applicationEntity = $this->Application->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $applicationEntity = $this->Application->patchEntity($applicationEntity, $this->request->getData());
            if ($this->Application->save($applicationEntity)) {
                $this->Flash->success(__('The application has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The application could not be saved. Please, try again.'));
        }
		$users = $this->Application->Users->find('list', limit: 200)->all();
		$programs = $this->Application->Programs->find('list', limit: 200)->all();
		$faculties = $this->Application->Faculties->find('list', limit: 200)->all();
        $this->set(compact('applicationEntity', 'users', 'programs', 'faculties'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Application id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
		EventManager::instance()->on('AuditStash.beforeLog', function ($event, array $logs) {
			foreach ($logs as $log) {
				$log->setMetaInfo($log->getMetaInfo() + ['a_name' => 'Delete']);
				$log->setMetaInfo($log->getMetaInfo() + ['c_name' => 'Application']);
				$log->setMetaInfo($log->getMetaInfo() + ['ip' => $this->request->clientIp()]);
				$log->setMetaInfo($log->getMetaInfo() + ['url' => Router::url(null, true)]);
				$log->setMetaInfo($log->getMetaInfo() + ['slug' => $this->Authentication->getIdentity('slug')->getIdentifier('slug')]);
			}
		});
        $this->request->allowMethod(['post', 'delete']);
        $applicationEntity = $this->Application->get($id);
        if ($this->Application->delete($applicationEntity)) {
            $this->Flash->success(__('The application has been deleted.'));
        } else {
            $this->Flash->error(__('The application could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
	
	public function archived($id = null)
    {
		$this->set('title', 'Application Edit');
		EventManager::instance()->on('AuditStash.beforeLog', function ($event, array $logs) {
			foreach ($logs as $log) {
				$log->setMetaInfo($log->getMetaInfo() + ['a_name' => 'Archived']);
				$log->setMetaInfo($log->getMetaInfo() + ['c_name' => 'Application']);
				$log->setMetaInfo($log->getMetaInfo() + ['ip' => $this->request->clientIp()]);
				$log->setMetaInfo($log->getMetaInfo() + ['url' => Router::url(null, true)]);
				$log->setMetaInfo($log->getMetaInfo() + ['slug' => $this->Authentication->getIdentity('slug')->getIdentifier('slug')]);
			}
		});
        $application = $this->Application->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $application = $this->Application->patchEntity($application, $this->request->getData());
			$application->status = 2; //archived
            if ($this->Application->save($application)) {
                $this->Flash->success(__('The application has been archived.'));

				return $this->redirect($this->referer());
            }
            $this->Flash->error(__('The application could not be archived. Please, try again.'));
        }
        $this->set(compact('application'));
    }
}
