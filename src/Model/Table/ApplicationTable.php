<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Application Model
 *
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\ProgramsTable&\Cake\ORM\Association\BelongsTo $Programs
 * @property \App\Model\Table\FacultiesTable&\Cake\ORM\Association\BelongsTo $Faculties
 *
 * @method \App\Model\Entity\Application newEmptyEntity()
 * @method \App\Model\Entity\Application newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Application> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Application get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Application findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Application patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Application> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Application|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Application saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Application>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Application>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Application>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Application> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Application>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Application>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Application>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Application> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ApplicationTable extends Table
{
    /**
     * Initialize method
     *
     * @param array<string, mixed> $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('application');
        $this->setDisplayField('company_name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Programs', [
            'foreignKey' => 'program_id',
        ]);
        $this->belongsTo('Faculties', [
            'foreignKey' => 'faculty_id',
        ]);
		$this->addBehavior('AuditStash.AuditLog');
		$this->addBehavior('Search.Search');
		$this->searchManager()
			->value('id')
            ->value('users_id')
            ->value('faculty_id')
            ->value('program_id')
				->add('search', 'Search.Like', [
					//'before' => true,
					//'after' => true,
					'fieldMode' => 'OR',
					'multiValue' => true,
					'multiValueSeparator' => '|',
					'comparison' => 'LIKE',
					'wildcardAny' => '*',
					'wildcardOne' => '?',
					'fields' => ['id'],
				]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        // $validator
        //     ->integer('user_id')
        //     ->notEmptyString('user_id');

        // $validator
        //     ->integer('program_id')
        //     ->allowEmptyString('program_id');

        // $validator
        //     ->integer('faculty_id')
        //     ->allowEmptyString('faculty_id');

        // $validator
        //     ->scalar('company_name')
        //     ->maxLength('company_name', 255)
        //     ->requirePresence('company_name', 'create')
        //     ->notEmptyString('company_name');

        // $validator
        //     ->scalar('company_street1')
        //     ->maxLength('company_street1', 255)
        //     ->requirePresence('company_street1', 'create')
        //     ->notEmptyString('company_street1');

        // $validator
        //     ->scalar('company_street2')
        //     ->maxLength('company_street2', 255)
        //     ->requirePresence('company_street2', 'create')
        //     ->notEmptyString('company_street2');

        // $validator
        //     ->scalar('company_postcode')
        //     ->maxLength('company_postcode', 255)
        //     ->requirePresence('company_postcode', 'create')
        //     ->notEmptyString('company_postcode');

        // $validator
        //     ->scalar('company_city')
        //     ->maxLength('company_city', 255)
        //     ->requirePresence('company_city', 'create')
        //     ->notEmptyString('company_city');

        // $validator
        //     ->scalar('company_state')
        //     ->maxLength('company_state', 255)
        //     ->requirePresence('company_state', 'create')
        //     ->notEmptyString('company_state');

        // $validator
        //     ->scalar('group_leader_name')
        //     ->maxLength('group_leader_name', 255)
        //     ->requirePresence('group_leader_name', 'create')
        //     ->notEmptyString('group_leader_name');

        // $validator
        //     ->scalar('group_leader_phone')
        //     ->maxLength('group_leader_phone', 255)
        //     ->requirePresence('group_leader_phone', 'create')
        //     ->notEmptyString('group_leader_phone');

        // $validator
        //     ->scalar('group_leader_email')
        //     ->maxLength('group_leader_email', 255)
        //     ->requirePresence('group_leader_email', 'create')
        //     ->notEmptyString('group_leader_email');

        // $validator
        //     ->integer('Team_member')
        //     ->requirePresence('Team_member', 'create')
        //     ->notEmptyString('Team_member');

        // $validator
        //     ->dateTime('date_interview')
        //     ->requirePresence('date_interview', 'create')
        //     ->notEmptyDateTime('date_interview');

        // $validator
        //     ->integer('status')
        //     ->allowEmptyString('status');

        // $validator
        //     ->scalar('method')
        //     ->maxLength('method', 255)
        //     ->requirePresence('method', 'create')
        //     ->notEmptyString('method');

        // $validator
        //     ->scalar('approval_status')
        //     ->maxLength('approval_status', 255)
        //     ->requirePresence('approval_status', 'create')
        //     ->notEmptyString('approval_status');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn(['user_id'], 'Users'), ['errorField' => 'user_id']);
        $rules->add($rules->existsIn(['program_id'], 'Programs'), ['errorField' => 'program_id']);
        $rules->add($rules->existsIn(['faculty_id'], 'Faculties'), ['errorField' => 'faculty_id']);

        return $rules;
    }
}
